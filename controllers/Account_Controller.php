<?php

class Account_Controller extends Controller
{
  public function Index()
  {
    $this->Load_View("user/layout", ["page" => "account/index"]);
  }

  public function Info()
  {
    $this->Load_Page("user/pages/account/info");
  }

  // Lịch sử giao dịch
  public function History()
  {
    $UserID = $_POST['UserID'];
    $this->Load_Model("account");
    $AccountModel = new Account_Model;

    $history = $AccountModel->HistorySelectByUserID($UserID);

    $this->Load_Page("user/pages/account/history", ["list" => $history]);
  }

  // Đơn hàng
  public function Order()
  {
    $UserID = $_POST['UserID'];

    $this->Load_Model("order");
    $OrderModel = new Order_Model;

    $listOrder = $OrderModel->SelectByUserID($UserID);
    $this->Load_Page("user/pages/account/order", ["list" => $listOrder]);
  }

  // Chi tiết đơn hàng
  public function OrderDetail()
  {
    $OrderID = $_POST['OrderID'];

    $this->Load_Model("order");
    $this->Load_Model("product");

    $OrderModel = new Order_Model;
    $ProductModel = new Product_Model;

    $Order = $OrderModel->OrderByID($OrderID);
    $DetailList = $OrderModel->DetailByOrderID($OrderID);
    $ProductList = $ProductModel->List();

    $this->Load_Page("user/pages/account/orderdetail", ["detaillist" => $DetailList, "productlist" => $ProductList, "orderid" => $OrderID, "order" => $Order]);
  }

  // Hủy đơn hàng
  public function OrderCancel()
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

    $this->Load_Page("user/pages/account/orderdetail", ["detaillist" => $DetailList, "productlist" => $ProductList, "orderid" => $OrderID, "order" => $Order]);
  }

  // Mua lại đơn hàng
  public function OrderReset()
  {
    $UserID = $_POST['UserID'];
    $OrderID = $_POST['OrderID'];
    $this->Load_Model("order");
    $OrderModel = new Order_Model;

    $ListOrder = $OrderModel->DetailByOrderID($OrderID);

    $this->Load_Model("product");
    $ProductModel = new Product_Model;

    foreach ($ListOrder as $orderItem) {
      extract($orderItem);

      $ProductID = $product_id;
      $quantity = $quantity; // Số lượng từ đơn hàng

      $productData = $ProductModel->SelectByID($ProductID);
      $productData['quantity'] = $quantity; // Gán số lượng từ đơn hàng

      $exists = false;

      if (isset($_SESSION['cart'][$UserID]) && is_array($_SESSION['cart'][$UserID])) {
        foreach ($_SESSION['cart'][$UserID] as $key => $item) {
          if ($item['product_id'] == $ProductID) {
            // Sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
            $_SESSION['cart'][$UserID][$key]['quantity'] += $quantity;
            $exists = true;
            break;
          }
        }
      }

      // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm sản phẩm mới
      if (!$exists) {
        $_SESSION['cart'][$UserID][] = $productData;
      }
    }
  }


  // Yêu thích
  public function Favorite()
  {
    // Tài khoản người dùng
    $UserID = $_SESSION['account']['user_id'];

    $this->Load_Model("account");
    $AccountModel = new Account_Model;

    $ListFavorite = $AccountModel->FavoriteSelectByUserID($UserID);
    $this->Load_Page("user/pages/account/favorite", ["list" => $ListFavorite]);
  }

  public function HandlerFavorite($dir)
  {
    $UserID = $_POST['UserID'];
    $ProductID = $_POST['ProductID'];

    $this->Load_Model("account");
    $AccountModel = new Account_Model;

    if ($dir == "add") {
      $AccountModel->FavoriteAdd($ProductID, $UserID);
    } else if ($dir == "delete") {
      $AccountModel->FavoriteDelete($ProductID, $UserID);

      $UserID = $_SESSION['account']['user_id'];
      $ListFavorite = $AccountModel->FavoriteSelectByUserID($UserID);
      $this->Load_Page("user/pages/account/favorite", ["list" => $ListFavorite]);
    }
  }

  public function Comment()
  {
    $UserID = $_SESSION['account']['user_id'];
    $this->Load_Model("comment");
    $CommentModel = new Comment_Model;

    $ListCmt = $CommentModel->CommentByUser($UserID);

    $this->Load_Page("user/pages/account/comment", ["list" => $ListCmt]);
  }

  public function Update()
  {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $avatar = "avatar";
    $avatarOld = $_POST['avatarOld'];

    $this->Load_Model("account");
    $object = new Account_Model;

    $object->Update($fullname, $phone, $address, $avatar, $avatarOld, $id);
    $user = $object->SelectByID($id);

    $_SESSION['account'] = $user;

    $this->Info();
  }


  public function Password()
  {
    $this->Load_Page("user/pages/account/password");
  }

  // Đổi mật khẩu mới
  public function handlerChangePass()
  {
    $UserID = $_POST['UserID'];
    $PassOld = $_POST['PassOld'];
    $PassNew = $_POST['PassNew'];
    $PassConfirm = $_POST['PassConfirm'];

    $this->Load_Model("account");
    $AccountModel = new Account_Model;

    if (empty($PassOld)) {
      echo "error1";
    } else {
      $User = $AccountModel->SelectByID($UserID);
      if ($User['password'] != md5($PassOld)) {
        echo "error1-1";
      } else {
        if (empty($PassNew)) {
          echo "error2";
        } else {
          if (empty($PassConfirm)) {
            echo "error3";
          } else  if ($PassConfirm != $PassNew) {
            echo "error3-1";
          } else {
            $PassNew = md5($PassNew);
            $AccountModel->ChangePassword($PassNew, $UserID);
          }
        }
      }
    }
  }

  public function LoadLogin()
  {
    $this->Load_Page("user/layouts/login");
  }

  public function LoadRegister()
  {
    $this->Load_Page("user/layouts/register");
  }

  public function LoadForgot()
  {
    $this->Load_Page("user/layouts/forgot");
  }

  public function Forgot()
  {
    $user = $_POST['email'];
    $password = $_POST['password'];
    $email = "";

    $this->Load_Model("account");
    $this->Load_Model("base");
    $AccountModel = new Account_Model;
    $BaseModel = new Base_Model;
    $userAccount = $AccountModel->SelectByEmailOrFullname($user);

    $fullname = $userAccount['fullname'];
    $OTP = substr(str_shuffle('0123456789'), 0, 6);

    if ($userAccount) {
      $this->Load_Page("user/layouts/forgotConfirm", ["otp" => $OTP, "password" => $password, "user" => $user]);
      if (str_contains($user, "@")) {
        $email = $user;
      } else {
        $email = $userAccount['email'];
      }
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
                Yêu cầu đặt lại mật khẩu
              </div>
              <div class='body'>
                <h1 style='font-weight: 600; font-size: 24px'>
                  Xin chào, $fullname
                </h1>
                <p style='margin-top: 15px; font-size: 16px'>
                  Bạn vừa nhận được mã OTP xác nhận đặt lại mật khẩu tại Account Shop.
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
      $BaseModel->SendMail($email, "Confirm Number Code", $html, $headers);
    } else {
      echo "notfound";
    }
  }

  public function HandlerForgotPassword()
  {
    $User = $_POST['User'];
    $Password = $_POST['Password'];

    $this->Load_Model("account");
    $AccountModel = new Account_Model;

    $AccountModel->Forget($User, $Password);
  }

  public function Register()
  {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $user = $_POST['user'];
    $password = $_POST['password'];

    $this->Load_Model("account");
    $AccountModel = new Account_Model;

    $AccountModel->Register($fullname, $user, $password, $email);
  }

  public function Login()
  {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $this->Load_Model("account");
    $AccountModel = new Account_Model;

    $account = $AccountModel->Login($email, $password);

    if (!$account) {
      echo "error";
    } else {
      $_SESSION['account'] = $account;

      $UserID = $account['user_id'];
      if (is_numeric($UserID)) {
        $GuestCart = $_SESSION['cart']['guest'];
        $_SESSION['cart']['guest'] = [];

        if (isset($_SESSION['cart'][$UserID]) && is_array($_SESSION['cart'][$UserID])) {
          foreach ($GuestCart as $GuestProduct) {
            $ProductFound = false;
            foreach ($_SESSION['cart'][$UserID] as &$UserProduct) {
              if ($UserProduct['product_id'] === $GuestProduct['product_id']) {
                $UserProduct['quantity'] += $GuestProduct['quantity'];
                $ProductFound = true;
                break;
              }
            }
            if (!$ProductFound) {
              $_SESSION['cart'][$UserID][] = $GuestProduct;
            }
          }
        } else {
          $_SESSION['cart'][$UserID] = $GuestCart;
        }
      }
    }
  }

  public function Logout()
  {
    unset($_SESSION['account']);
  }
}
