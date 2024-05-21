<?php

class Cart_Controller extends Controller
{
  public function Index()
  {
    $this->Load_View("user/layout", ["page" => "cart/index"]);
  }

  public function AddToCart()
  {
    $this->Load_Model("product");
    $ProductModel = new Product_Model;

    $ProductID = $_POST['ProductID'];
    $UserID = $_POST['UserID'];

    $product = $ProductModel->SelectByID($ProductID);
    $product['quantity'] = 1;

    $exists = false;

    if (isset($_SESSION['cart'][$UserID]) && is_array($_SESSION['cart'][$UserID])) {
      foreach ($_SESSION['cart'][$UserID] as $key => $item) {
        if ($item['product_id'] == $ProductID) {
          // Sản phẩm đã tồn tại, cập nhật số lượng
          $_SESSION['cart'][$UserID][$key]['quantity'] += 1;
          $exists = true;
          break;
        }
      }
    }

    // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm sản phẩm mới
    if (!$exists) {
      $_SESSION['cart'][$UserID][] = $product;
    }

    $countCart = 0;
    foreach ($_SESSION['cart'][$UserID] as $product) {
      $countCart += $product['quantity'];
    }

    echo $countCart;
  }

  public function RemoveCartItem()
  {
    $ItemID = $_POST['ItemID'];
    $UserID = $_POST['UserID'];

    unset($_SESSION['cart'][$UserID][$ItemID]);

    echo $this->CountCart($UserID);
  }

  // Đếm số lượng sản phẩm trong giỏ 
  public function CountCart($userID)
  {
    $countCart = 0;
    foreach ($_SESSION['cart'][$userID] as $product) {
      $countCart += $product['quantity'];
    }
    return $countCart;
  }

  public function UpdateQuantity($dir)
  {
    $UserID = $_POST['UserID'];
    $Key = $_POST['Key'];
    $check = true;

    if ($dir == "plus") {
      $_SESSION['cart'][$UserID][$Key]['quantity'] += 1;
    } else if ($dir == "minus") {
      if ($_SESSION['cart'][$UserID][$Key]['quantity'] > 1) {
        $_SESSION['cart'][$UserID][$Key]['quantity'] -= 1;
      } else {
        $check = false;
      }
    }
    if ($check) {
      echo $this->CountCart($UserID);
    } else {
      echo $check;
    }
  }

  // Trang thanh toán
  public function Pay()
  {
    $Email = $_POST['Email'];
    $UserID = is_numeric($_POST['UserID']) ? $_POST['UserID'] : 0;
    $cart = $_SESSION['cart'][$UserID];
    $Method = "Chuyển khoản ngân hàng";
    $Status = 0;
    $Date = date("Y-m-d");
    $Time = date("H:i:s");
    $Anmount = 0;
    $Subtotal = 0;
    $randomCode = substr(str_shuffle('0123456789'), 0, 6);

    if ($UserID == 0) {
      $cart = $_SESSION['cart']["guest"];
    }

    foreach ($cart as $item) {
      extract($item);
      $Anmount += (($product_price - ($product_price * $product_discount / 100))) * $quantity;
    }

    $TransactionFee  = $Anmount * (5 / 100);
    $Subtotal = $Anmount + $TransactionFee;

    $this->Load_Model("order");
    $OrderModel = new Order_Model;

    $OrderModel->Add($randomCode, $UserID, $Subtotal, $TransactionFee, $Method, $Status, $Date, $Time, $randomCode, $Email);

    $_SESSION['orders'][$UserID][$randomCode][] = $cart;

    foreach ($_SESSION['orders'][$UserID][$randomCode] as $list) {
      $subtotal = 0;
      foreach ($list as $product) {
        extract($product);
        $product_price = $product_price - ($product_price * $product_discount / 100);
        $subtotal = $product_price * $quantity;
        $OrderModel->Detail($randomCode, $product_id, $product_price, $quantity, $subtotal);
      }
    }

    $UserID == 0 ? $_SESSION['cart']['guest'] = [] : $_SESSION['cart'][$UserID] = [];
    $this->Load_Page("user/pages/cart/pay", ["cart" => $cart, "UserID" => $UserID, "anmount" => $Anmount, "discount" => $TransactionFee]);
  }

  // Thanh toán bằng số dư
  public function PayMoney()
  {
    $UserID = $_POST['UserID'];
    $Money = $_POST['Money'];
    $OTP = substr(str_shuffle('0123456789'), 0, 6);

    $this->Load_Model("account");
    $this->Load_Model("base");
    $AccountModel = new Account_Model;
    $BaseModel = new Base_Model;

    $user = $AccountModel->SelectByID($UserID);
    $fullname = $user['fullname'];
    $email = $user['email'];

    $html = "
    <!DOCTYPE html>
    <html lang='en'>
      <head>
        <meta charset='UTF-8' />
        <meta http-equiv='X-UA-Compatible' content='IE=edge' />
        <meta name='viewport' content='width=device-width, initial-scale=1.0' />
        <link rel='preconnect' href='https://fonts.googleapis.com' />
        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin />
        <link
          href='https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,300;1,400&display=swap'
          rel='stylesheet'
        />
        <title>Template SendMailer</title>
      </head>
      <body
        style='
          font-size: 16px;
          font-weight: 400;
          line-height: 1.9;
          font-family: \'Roboto\', sans-serif;
        '
      >
        <div class='show' style='padding: 45px; background-color: #f5f5f5'>
          <div style='background-color: #fff; padding: 45px'>
            <div
              class='title'
              style='
                text-align: center;
                padding: 28px 0;
                color: white;
                background-color: #4a6cf7;
                border-radius: 5px;
                font-size: 32px;
                font-weight: 600;
                letter-spacing: 0.3px;
                border-bottom: 1px solid rgba(0, 0, 0, 0.12);
                margin-bottom: 15px;
              '
            >
              Xác nhận mã OTP
            </div>
            <div class='body'>
              <h1 style='font-weight: 600; font-size: 24px'>
                Xin chào, $fullname
              </h1>
              <p style='margin-top: 15px; font-size: 16px'>
                Bạn vừa nhận được mã OTP xác nhận tại Account Shop.
              </p>
              <span
                style='
                  display: inline-block;
                  color: #2579f2;
                  border: 2px solid rgba(37, 121, 242, 0.5);
                  padding: 2px 15px;
                  border-radius: 5px;
                  font-weight: 600;
                  margin-top: 15px;
                  font-size: 24px;
                  letter-spacing: 1px;
                '
                >$OTP</span
              >
              <p style='margin-top: 15px; font-size: 16px'>
                Nếu bạn không thực hiện yêu cầu này xin vui lòng bỏ qua nó hoặc nếu
                cần hỗ trợ hãy liên hệ với chúng tôi ngay.
              </p>
              <p style='margin-top: 15px; font-size: 16px'>
                Trân trọng <br />
                Account Shop
              </p>
            </div>
          </div>
          <p style='text-align: center; margin-top: 25px; font-size: 16px'>
            Hotline hỗ trợ: 0373 405 375
          </p>
        </div>
      </body>
    </html>";
    $headers = array(
      "MIME-Version: 1.0",
      "Content-type:text/html;charset=UTF-8"
    );

    $BaseModel->SendMail($email, "Confirm OTP", $html, $headers);

    if (isset($UserID)) { ?>
      <div style="grid-column: 2 span; padding-bottom: 120px;">
        <h1 style="font-size: 25px;font-weight: 500;text-align: center;margin: 10px 0 15px 0;letter-spacing: .2px;">Nhập mã xác thực</h1>
        <p style="text-align: center;">Vui lòng nhập mã OTP được gửi tới email của bạn</p>
        <div style="display: flex; justify-content: center;">
          <div>
            <input id="ValueOTP" type="text" placeholder="Mã xác thực OTP" style="display: block;margin-top: 15px;border: 1px solid #ddd;padding: 12px;border-radius: 5px;width: 312px;">
            <span class="OTPError" style="display: block; margin: 8px 0 15px 0; color: #dc3545;"></span>
          </div>
        </div>
        <button id="ConfirmOTP" OTP="<?= $OTP ?>" UserID="<?= $UserID ?>" Money="<?= $Money ?>" style="display: block;margin: 0 auto;background: #4a6cf7;color: white;width: 312px;padding: 12px 0;border-radius: 5px;font-weight: 500;">Xác nhận</button>
      </div>
    <?php
    }
  }

  public function Bill()
  {
    $UserID = $_POST['UserID'];
    $cart = $_SESSION['cart'][$UserID];
    $Method = "Số dư tài khoản";
    $Status = 1;
    $Date = date("Y-m-d");
    $Time = date("H:i:s");
    $Anmount = 0;
    $randomCode = substr(str_shuffle('0123456789'), 0, 6);

    $this->Load_Model("product");
    $this->Load_Model("account");
    $this->Load_Model("order");

    $OrderModel = new Order_Model;
    $AccountModel = new Account_Model;
    $ProductModel = new Product_Model;

    $this->Load_Page("user/pages/cart/bill");

    foreach ($cart as $item) {
      extract($item);
      $Anmount += (($product_price - ($product_price * $product_discount / 100))) * $quantity;
      $ProductModel->MinusInvetory($product_id, $quantity);
    }

    $user = $AccountModel->SelectByID($UserID);

    $OrderModel->Add($randomCode, $UserID, $Anmount, 0, $Method, $Status, $Date, $Time, $randomCode, $user['email']);
    $AccountModel->HistoryNew($randomCode, $UserID, ($user['money'] - $Anmount));

    $_SESSION['orders'][$UserID][$randomCode][] = $cart;

    foreach ($_SESSION['orders'][$UserID][$randomCode] as $list) {
      $subtotal = 0;
      foreach ($list as $product) {
        extract($product);
        $product_price = $product_price - ($product_price * $product_discount / 100);
        $subtotal = $product_price * $quantity;
        $OrderModel->Detail($randomCode, $product_id, $product_price, $quantity, $subtotal);
      }
    }

    $AccountModel->MinusMoney($Anmount, $UserID);
    $user = $AccountModel->SelectByID($UserID);
    $_SESSION['account'] = $user;

    // Order id chính là mã randmcode
    $OrderID = $randomCode;

    $Order = $OrderModel->OrderByID($OrderID);
    $DetailList = $OrderModel->DetailByOrderID($OrderID);
    $ProductList = $ProductModel->List();

    $_SESSION['cart'][$UserID] = [];

    $this->Load_Page("user/pages/account/bill", ["detaillist" => $DetailList, "productlist" => $ProductList, "orderid" => $OrderID, "order" => $Order]);
  }

  public function CancelBill()
  {
    $OrderID = $_POST['OrderID'];

    $this->Load_Model("order");
    $this->Load_Model("product");

    $OrderModel = new Order_Model;
    $ProductModel = new Product_Model;

    $OrderModel->ChangeStatus($OrderID, 2);

    $Order = $OrderModel->OrderByID($OrderID);
    $DetailList = $OrderModel->DetailByOrderID($OrderID);
    $ProductList = $ProductModel->List();

    $this->Load_Page("user/pages/account/bill", ["detaillist" => $DetailList, "productlist" => $ProductList, "orderid" => $OrderID, "order" => $Order]);
  }

  // Load trang giỏ hàng
  public function LoadCart()
  {
    // ID người dùng || guest
    $userID = $_POST['UserID'];
    // Số lượng sản phẩm trong giỏ hàng
    $countCart = $this->CountCart($userID);
    // Tài khoản người dùng
    $account = isset($_SESSION['account']) ? $_SESSION['account'] : [];
    // Giỏ hàng
    $cart = isset($_SESSION['cart'][$userID]) ? $_SESSION['cart'][$userID] : [];

    if (true) { ?>
      <div class="cart-content">
        <?php
        if (!empty($cart)) {
        ?>
          <h3>Giỏ hàng <span>(<?= $countCart ?> sản phẩm)</span></h3>
          <?php
          $subtotal = 0;
          foreach ($cart as $key => $product) {
            extract($product);
            $subtotal += ($product_price - ($product_price * $product_discount / 100)) * $quantity;
          ?>
            <div class="cart-item">
              <div class="cart-image">
                <img src="<?= $product_image ?>" alt="">
              </div>
              <div class="cart-group">
                <div class="cart-infoItem">
                  <h6 class="underline"><a href="product/detail/<?= $product_id ?>"><?= $product_name ?></a></h6>
                  <div class="cart-quantity">
                    <span id="minus" UserID="<?= $userID ?>" Key="<?= $key ?>">-</span>
                    <span><?= $quantity ?></span>
                    <span id="plus" UserID="<?= $userID ?>" Key="<?= $key ?>">+</span>
                  </div>
                  <div class="cart-price">
                    <div class="price-new"><?= number_format(($product_price - ($product_price * $product_discount / 100)), 0, ",", ".") ?>đ</div>
                    <?php
                    if ($product_discount != 0) {
                    ?>
                      <div class="price-old">
                        <span>-<?= $product_discount ?>%</span>
                        <p><?= number_format($product_price, 0, ",", ".") ?>đ</p>
                      </div>
                    <?php
                    }
                    ?>
                  </div>
                </div>
                <div class="cart-status">
                  <div>
                    <a><svg style="height: 17.5px;" class="od Cb Da" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M509.5 184.6L458.9 32.8C452.4 13.2 434.1 0 413.4 0H98.6c-20.7 0-39 13.2-45.5 32.8L2.5 184.6c-1.6 4.9-2.5 10-2.5 15.2V464c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V199.8c0-5.2-.8-10.3-2.5-15.2zM32 199.8c0-1.7.3-3.4.8-5.1L83.4 42.9C85.6 36.4 91.7 32 98.6 32H240v168H32v-.2zM480 464c0 8.8-7.2 16-16 16H48c-8.8 0-16-7.2-16-16V232h448v232zm0-264H272V32h141.4c6.9 0 13 4.4 15.2 10.9l50.6 151.8c.5 1.6.8 3.3.8 5.1v.2z"></path>
                      </svg> Tình trạng: <span style="color: #29b474;">Còn hàng</span></a>
                  </div>
                  <div class="cart-remove RemoveCartItem" ItemID="<?= $key ?>">
                    <svg style="fill: #dc3545; height: 17.5px;" class="od Cb Da" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                      <path d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path>
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          <?php
          }
          ?>
        <?php
        } else {
        ?>
          <div class="cart-empty">
            <h4>Giỏ hàng trống</h4>
            <p>Thêm sản phẩm vào giỏ và quay lại trang này để thanh toán nha bạn</p>
            <div class="img">
              <img src="https://cdn.divineshop.vn/static/4e0db8ffb1e9cac7c7bc91d497753a2c.svg" alt="">
            </div>
          </div>
        <?php
        }
        ?>
      </div>
      <div class="cart-right">
        <ul class="list1">
          <li>Bạn có mã giới thiệu <svg class="od b Hb Ba oa fe" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
              <path d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z"></path>
            </svg>
          </li>
          <li>Bạn có mã ưu đãi <svg class="od b Hb Ba oa fe" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
              <path d="M96 224c53 0 96-43 96-96s-43-96-96-96S0 75 0 128s43 96 96 96zm0-144c26.5 0 48 21.5 48 48s-21.5 48-48 48-48-21.5-48-48 21.5-48 48-48zm192 208c-53 0-96 43-96 96s43 96 96 96 96-43 96-96-43-96-96-96zm0 144c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm93.9-381.2L57.2 475c-2.3 3.1-5.9 5-9.7 5H12c-9.6 0-15.3-10.7-10-18.7L327.2 37c2.3-3.1 5.9-5 9.7-5H372c9.6 0 15.3 10.8 9.9 18.8z"></path>
            </svg>
          </li>
          <li>Bạn muốn tặng cho bạn bè <svg class="od b Hb Ba oa fe" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
              <path d="M464 144h-26.1c6.2-12.1 10.1-25.5 10.1-40 0-48.5-39.5-88-88-88-41.6 0-68.5 21.3-103 68.3-34.5-47-61.4-68.3-103-68.3-48.5 0-88 39.5-88 88 0 14.5 3.8 27.9 10.1 40H48c-26.5 0-48 21.5-48 48v128c0 8.8 7.2 16 16 16h16v107.4c0 29 23.6 52.6 52.6 52.6h342.8c29 0 52.6-23.6 52.6-52.6V336h16c8.8 0 16-7.2 16-16V192c0-26.5-21.5-48-48-48zM232 448H84.6c-2.5 0-4.6-2-4.6-4.6V336h112v-48H48v-96h184v256zm-78.1-304c-22.1 0-40-17.9-40-40s17.9-40 40-40c22 0 37.5 7.6 84.1 77l2 3h-86.1zm122-3C322.5 71.6 338 64 360 64c22.1 0 40 17.9 40 40s-17.9 40-40 40h-86.1l2-3zM464 288H320v48h112v107.4c0 2.5-2 4.6-4.6 4.6H280V192h184v96z"></path>
            </svg>
          </li>
        </ul>
        <ul class="list2">
          <li>Tổng giá trị phải thanh toán <span><?= isset($subtotal) ? number_format($subtotal, 0, ",", ".") : 0 ?>đ</span></li>
          <?php
          if (is_numeric($userID) && !empty($cart)) {
          ?>
            <li>Số dư hiện tại <span><?= number_format($account['money'], 0, ",", ".") ?>đ</span></li>
          <?php
          } else if (empty($cart)) {
          ?>
            <li>Số dư sau khi thanh toán <span>0đ</span></li>
          <?php
          } else if (!empty($cart)) {
          ?>
            <li>Số dư hiện tại <span>0đ</span></li>
          <?php
          }
          ?>
          <?php
          if (isset($subtotal) && is_numeric($userID)) {
          ?>
            <li>Số tiền cần nạp thêm <span><?= $account['money'] >= $subtotal ? 0 : number_format(($subtotal - $account['money']), 0, ",", ".") ?>đ</span></li>
          <?php
          } else if (!empty($cart)) {
          ?>
            <li>Số tiền cần nạp thêm <span><?= number_format($subtotal, 0, ",", ".") ?>đ</span></li>
          <?php
          }
          ?>
        </ul>
        <?php
        if (is_numeric($userID) && !empty($cart) && $account['money'] >= $subtotal) {
        ?>
          <button class="pay" id="PayNow" style=" background-color: #2579f2;"><img src="https://cdn.divineshop.vn/static/b1402e84a947ed36cebe9799e47f61c2.svg" alt=""> Thanh toán ngay</button>
          <div class="cart-confirm cart-confirm1">
            <button class="PayConfirm" id="PayMoney" UserID="<?= $userID ?>" Money="<?= $subtotal ?>"><img src="public/images/icons/pay.svg" alt="" style="filter: invert(1);"> Xác nhận thanh toán
            </button>
            <a class="back1" style="display: flex; align-items: center; gap: 8px; justify-content: end; color: #2579f2; font-weight: 500; margin-top: 15px; cursor: pointer;"><svg fill="#2579f2" style="width: 17.5px; height: 17.5px;" class="od Cb Da" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                <path d="M238.475 475.535l7.071-7.07c4.686-4.686 4.686-12.284 0-16.971L50.053 256 245.546 60.506c4.686-4.686 4.686-12.284 0-16.971l-7.071-7.07c-4.686-4.686-12.284-4.686-16.97 0L10.454 247.515c-4.686 4.686-4.686 12.284 0 16.971l211.051 211.05c4.686 4.686 12.284 4.686 16.97-.001z"></path>
              </svg> Trở về giỏ hàng
            </a>
          </div>
        <?php
        } else if (is_numeric($userID) && !empty($cart)) {
        ?>
          <button class="pay" id="NapMoney" style="background-color: #2579f2;"><img src="https://cdn.divineshop.vn/static/b1402e84a947ed36cebe9799e47f61c2.svg" alt=""> Nạp tiền vào tài khoản</button>
        <?php
        } else if (!empty($cart)) {
        ?>
          <button class="pay" id="RequiredLogin" style="background-color: #2579f2;"><img src="https://cdn.divineshop.vn/static/b1402e84a947ed36cebe9799e47f61c2.svg" alt=""> Đăng nhập để thanh toán</button>
        <?php
        }
        ?>
        <?php
        if (!empty($cart)) {
        ?>
          <p class="pay" style="display: flex; justify-content: center; margin: 10px 0; color: #6b7280;">Quét mã. Thanh toán. Không cần nạp tiền.</p>
          <button class="pay" id="PayMoMo" style="background-color: #ae2070;"><img src="https://cdn.divineshop.vn/static/b77a2122717d76696bd2b87d7125fd47.svg" alt=""> Mua siêu tốc với Mono</button>
          <div class="cart-confirm cart-confirm2">
            <button class="PayConfirm" id="PayConfirm" UserID="<?= $userID ?>"><img src="public/images/icons/pay.svg" alt="" style="filter: invert(1);"> Xác nhận thanh toán
            </button>
            <a class="back2" style="display: flex; align-items: center; gap: 8px; justify-content: end; color: #2579f2; font-weight: 500; margin-top: 15px; cursor: pointer;"><svg fill="#2579f2" style="width: 17.5px; height: 17.5px;" class="od Cb Da" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                <path d="M238.475 475.535l7.071-7.07c4.686-4.686 4.686-12.284 0-16.971L50.053 256 245.546 60.506c4.686-4.686 4.686-12.284 0-16.971l-7.071-7.07c-4.686-4.686-12.284-4.686-16.97 0L10.454 247.515c-4.686 4.686-4.686 12.284 0 16.971l211.051 211.05c4.686 4.686 12.284 4.686 16.97-.001z"></path>
              </svg> Trở về giỏ hàng
            </a>
          </div>
        <?php
        }
        ?>
      </div>
<?php
    }
  }
}
