<?php

class Admin_Controller extends Controller
{
  public function Index()
  {
    $this->Load_Model("product");
    $this->Load_Model("account");
    $this->Load_Model("order");

    $ProductModel = new Product_Model;
    $AccountModel = new Account_Model;
    $OrderModel = new Order_Model;

    $ProductCount = count($ProductModel->List());
    $AccountCount = count($AccountModel->SelectAll());
    $OrderCount = count($OrderModel->List());
    $TotalRevenue = $OrderModel->RevenueStatistics();

    $this->Load_View("admin/layout", ["page" => "home/index", "ProductCount" => $ProductCount, "AccountCount" => $AccountCount, "OrderCount" => $OrderCount, "TotalRevenue" => $TotalRevenue]);
  }

  // Dashboard
  public function Dashboard()
  {
    $this->Load_Model("product");
    $this->Load_Model("account");
    $this->Load_Model("order");

    $ProductModel = new Product_Model;
    $AccountModel = new Account_Model;
    $OrderModel = new Order_Model;

    $ProductCount = count($ProductModel->List());
    $AccountCount = count($AccountModel->SelectAll());
    $OrderCount = count($OrderModel->List());
    $TotalRevenue = $OrderModel->RevenueStatistics();

    $this->Load_Page("admin/pages/home/index", ["page" => "home/index", "ProductCount" => $ProductCount, "AccountCount" => $AccountCount, "OrderCount" => $OrderCount, "TotalRevenue" => $TotalRevenue]);
  }

  // Hiển thị form thêm danh mục
  public function ViewCategoryAdd()
  {
    $this->Load_Page("admin/pages/category/add");
  }

  // Xử lý thêm danh mục
  public function HandlerCategoryAdd()
  {
    if (isset($_POST['CategoryName'])) {
      $Category_Name = $_POST['CategoryName'];
      $this->Load_Model("category");
      $CategoryModel = new Category_Model;
      $CategoryModel->Add($Category_Name);
    }
  }

  // Danh sách danh mục
  public function CategoryList()
  {
    $this->Load_Model("category");
    $CategoryModel = new Category_Model;
    $this->Load_Page("admin/pages/category/list", ["listCategory" => $CategoryModel->List()]);
  }

  // Xử lý xóa danh mục
  public function CategoryDelete()
  {
    $CategoryID = $_POST['CategoryID'];

    $this->Load_Model("category");
    $CategoryModel = new Category_Model;
    $CategoryModel->Delete($CategoryID);

    $this->Load_Page("admin/pages/category/list", ["listCategory" => $CategoryModel->List()]);
  }

  // Hiển thị form sửa danh mục
  public function ViewCategoryEdit()
  {
    $CategoryID = $_POST['CategoryID'];

    $this->Load_Model("category");
    $CategoryModel = new Category_Model;

    $this->Load_Page("admin/pages/category/edit", ["category" => $CategoryModel->SelectByID($CategoryID)]);
  }

  // Xử lý sửa danh mục
  public function HandlerCategoryEdit()
  {
    $CategoryID = $_POST['CategoryID'];
    $CategoryName = $_POST['CategoryName'];

    $this->Load_Model("category");
    $CategoryModel = new Category_Model;
    $CategoryModel->Edit($CategoryID, $CategoryName);

    $this->Load_Page("admin/pages/category/list", ["listCategory" => $CategoryModel->List()]);
  }

  // Hiển thị form thêm sản phẩm
  public function ViewProductAdd()
  {
    $this->Load_Model("category");
    $object = new Category_Model;
    $this->Load_Page("admin/pages/product/add", ["categories" => $object->List()]);
  }

  // Xử lý thêm sản phẩm
  public function HandlerProductAdd()
  {
    $CategoryID = $_POST['CategoryName'];
    $ProductName = $_POST['ProductName'];
    $ProductImage = "ProductImage";
    $ImageDefault = "default.png";
    $Inventory = $_POST['Inventory'];
    $ProductPrice = $_POST['ProductPrice'];
    $ProductDiscount = $_POST['ProductDiscount'];
    $ProductDate = $_POST['ProductDate'];
    $ProductSpecial = $_POST['ProductSpecial'];
    $Description = $_POST['Description'];

    $this->Load_Model("product");
    $ProductModel = new Product_Model;

    $ProductModel->Add($CategoryID, $ProductName, $ProductImage, $ImageDefault, $Inventory, $ProductPrice, $ProductDiscount, $ProductDate, $ProductSpecial, $Description);

    $this->Load_Page("admin/pages/product/list", ["listProduct" => $ProductModel->List()]);
  }

  // Hiển thị danh sách sản phẩm
  public function ProductList()
  {
    $this->Load_Model("product");
    $ProductModel = new Product_Model;
    $this->Load_Page("admin/pages/product/list", ["listProduct" => $ProductModel->List()]);
  }

  // Xử lý xóa sản phẩm
  public function HandlerProductDelete()
  {
    $ProductID = $_POST['ProductID'];

    $this->Load_Model("product");
    $ProductModel = new Product_Model;

    $ProductModel->Delete($ProductID);

    $this->Load_Page("admin/pages/product/list", ["listProduct" => $ProductModel->List()]);
  }

  // Hiển thị form sửa sản phẩm
  public function LoadProductEdit()
  {

    $ProductID = $_POST['ProductID'];

    $this->Load_Model("category");
    $this->Load_Model("product");

    $obCategory = new Category_Model;
    $obProduct = new Product_Model;

    $Product = $obProduct->SelectByID($ProductID);

    $this->Load_Page("admin/pages/product/edit", ["categories" => $obCategory->List(), "product" => $Product]);
  }

  // Xử lý sửa sản phẩm
  public function HandlerProductEdit()
  {
    $ProductID = $_POST['ProductID'];
    $CategoryID = $_POST['CategoryName'];
    $ProductName = $_POST['ProductName'];
    $ProductImage = "ProductImage";
    $ImageDefault = "default.png";
    $Inventory = $_POST['Inventory'];
    $ProductPrice = $_POST['ProductPrice'];
    $ProductDiscount = $_POST['ProductDiscount'];
    $ProductDate = $_POST['ProductDate'];
    $ProductSpecial = $_POST['ProductSpecial'];
    $Description = $_POST['Description'];

    $this->Load_Model("product");
    $ProductModel = new Product_Model;

    $ProductModel->Update($ProductID, $CategoryID, $ProductName, $ProductImage, $ImageDefault, $Inventory, $ProductPrice, $ProductDiscount, $ProductDate, $ProductSpecial, $Description);

    $this->Load_Page("admin/pages/product/list", ["listProduct" => $ProductModel->List()]);
  }

  // Tài khoản
  // Danh sách tài khoản
  public function AccountList()
  {
    $this->Load_Model("account");
    $AccountModel = new Account_Model;

    $this->Load_Page("admin/pages/account/list", ["list" => $AccountModel->SelectAll()]);
  }

  // Hiển thị form thêm người dùng
  public function AccountAdd()
  {
    $this->Load_Page("admin/pages/account/add");
  }

  // Xử lý thêm người dùng
  public function HandlerAccountAdd()
  {
    $Fullname = $_POST['Fullname'];
    $User = $_POST['User'];
    $Password = $_POST['Password'];
    $Email = $_POST['Email'];
    $Phone = $_POST['Phone'];
    $Address = $_POST['Address'];
    $Avatar = "Avatar";
    $Position = $_POST['Position'];
    $Money = $_POST['Money'];

    $this->Load_Model("account");
    $AccountModel = new Account_Model;

    $AccountModel->AddUser($Fullname, $User, $Password, $Email, $Phone, $Address, $Avatar, $Position, $Money);

    $this->Load_Page("admin/pages/account/list", ["list" => $AccountModel->SelectAll()]);
  }

  // Xử lý xóa tài khoản người dùng 
  public function HandlerAccountDelete()
  {
    $UserID = $_POST['UserID'];

    $this->Load_Model("account");
    $AccountModel = new Account_Model;

    $AccountModel->DeleteAccountByID($UserID);

    $this->Load_Page("admin/pages/account/list", ["list" => $AccountModel->SelectAll()]);
  }

  // Hiển thị form sửa thông tin tài khoản (user)
  public function ViewAccountEdit()
  {
    $UserID = $_POST['UserID'];

    $this->Load_Model("account");
    $AccountModel = new Account_Model;

    $this->Load_Page("admin/pages/account/edit", ["user" => $AccountModel->SelectByID($UserID)]);
  }

  // Sửa thông tin tài khoản
  public function HandlerAccountEdit()
  {
    $UserID = $_POST['UserID'];
    $Fullname = $_POST['Fullname'];
    $User = $_POST['User'];
    $Password = $_POST['Password'];
    $PasswordOld = $_POST['PasswordOld'];
    $Password = $Password === $PasswordOld ? $PasswordOld : md5($Password);
    $Email = $_POST['Email'];
    $Phone = $_POST['Phone'];
    $Address = $_POST['Address'];
    $Avatar = "Avatar";
    $AvatarOld = $_POST['AvatarOld'];
    $Position = $_POST['Position'];
    $Money = $_POST['Money'];

    $this->Load_Model("account");
    $AccountModel = new Account_Model;

    $AccountModel->AccountEdit($Fullname, $User, $Password, $Email, $Phone, $Address, $Avatar, $AvatarOld, $Position, $Money, $UserID);

    $this->Load_Page("admin/pages/account/list", ["list" => $AccountModel->SelectAll()]);
  }

  // Thống kê
  public function Statistical()
  {
    $this->Load_Model("base");
    $this->Load_Model("order");

    $BaseModel = new Base_Model;
    $OrderModel = new Order_Model;

    $data = $BaseModel->statisticalProduct();
    $data2 = $OrderModel->RevenueStatistics();

    $this->Load_Page("admin/pages/statistical/index", ["data" => $data, "data2" => $data2]);
  }

  // Bình luận
  public function Comment()
  {
    $this->Load_Model("comment");
    $CommentModel = new Comment_Model;

    $ListComment = $CommentModel->Comment();
    $this->Load_Page("admin/pages/comment/list", ["list" => $ListComment]);
  }

  // Chi tiết bình luận
  public function DetailComment()
  {
    $ProductID = $_POST['ProductID'];

    $this->Load_Model("comment");
    $this->Load_Model("account");
    $CommentModel = new Comment_Model;
    $Account = new Account_Model;

    $listDetail = $CommentModel->CommentByProductJOIN($ProductID);
    $ListUser = $Account->SelectAll();
    $this->Load_Page("admin/pages/comment/detail", ["list" => $listDetail, "user" => $ListUser]);
  }

  // Xóa bình luận 
  public function DeleteComment()
  {
    $ID = $_POST['ID'];
    $ProductID = $_POST['ProductID'];
    $Table = $_POST['Table'];

    $this->Load_Model("comment");
    $this->Load_Model("account");
    $CommentModel = new Comment_Model;
    $Account = new Account_Model;

    $CommentModel->CommentDelete($ID, $Table);
    $listDetail = $CommentModel->CommentByProductJOIN($ProductID);
    $ListUser = $Account->SelectAll();

    $this->Load_Page("admin/pages/comment/detail", ["list" => $listDetail, "user" => $ListUser]);
  }

  // Đơn hàng
  public function Order()
  {
    $this->Load_Model("order");
    $this->Load_Model("account");
    $OrderModel = new Order_Model;
    $AccountModel = new Account_Model;

    $list = $OrderModel->List();
    $listUser = $AccountModel->SelectAll();

    $this->Load_Page("admin/pages/order/index", ["list" => $list, "listUser" => $listUser]);
  }

  // Chi tiết đơn hàng
  public function OrderDetail()
  {
    $OrderID = $_POST['OrderID'];
    $this->Load_Model("order");
    $this->Load_Model("product");
    $OrderModel = new Order_Model;
    $ProductModel = new Product_Model;

    $OrderDetail = $OrderModel->DetailByOrderID($OrderID);
    $ProductList = $ProductModel->List();

    $this->Load_Page("admin/pages/order/detail", ["orderdetail" => $OrderDetail, "productlist" => $ProductList]);
  }

  // Thay đổi trạng thái đơn hàng
  public function ChangeStatusOrder()
  {
    $OrderID = $_POST['OrderID'];
    $Status = $_POST['Status'];
    // Tên đăng nhập tài khoản
    $Username = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@'), 0, 6);
    // Mật khẩu đăng nhập
    $Password = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@'), 0, 6);

    $this->Load_Model("order");
    $this->Load_Model("account");

    $OrderModel = new Order_Model;
    $AccountModel = new Account_Model;

    $OrderModel->ChangeStatus($OrderID, $Status);

    $order = $OrderModel->OrderByID($OrderID);

    $list = $OrderModel->List();
    $listUser = $AccountModel->SelectAll();

    if ($Status == 1 && $order['anmount'] != 0) {
      $email = $order['email'];

      $this->Load_Model("base");
      $BaseModel = new Base_Model;

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
                  background-color: #4a6cf7;
                  color: #fff;
                  font-size: 32px;
                  font-weight: 600;
                  letter-spacing: 0.3px;
                  border-bottom: 1px solid rgba(0, 0, 0, 0.12);
                  border-radius: 5px;
                  margin-bottom: 15px
                '
              >
                Đơn hàng mới #$OrderID
                <span style='display: block; font-weight: 400; font-size: 16px;'>Cảm ơn bạn đã quan tâm sản phẩm của Account Shop.</span>
              </div>
              <div class='body'>
                <h1 style='font-weight: 600; font-size: 24px'>
                  Thông tin chi tiết đơn hàng #$OrderID
                </h1>
                <p style='margin-top: 15px; font-size: 16px'>
                  Đơn hàng của bạn đã được nhận và sẽ được xử lý ngay khi bạn xác nhận thanh toán.
                </p>
                <ul style='list-style: none; font-size: 16px; font-weight: 600'>
                  <li style='padding: 5px 0'>Tên đăng nhập: <span style='color: #4a6cf7'>$Username</span></li>
                  <li style='padding: 5px 0'>Mật khẩu: <span style='color: #4a6cf7'>$Password</span></li>
                </ul>
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
      $BaseModel->SendMail($email, "Order information (account) #$OrderID", $html, $headers);
    }

    $this->Load_Page("admin/pages/order/index", ["list" => $list, "listUser" => $listUser]);
  }
}
