<?php
// Tài khoản người dùng
$account = isset($_SESSION['account']) ? $_SESSION['account'] : [];
$userID = isset($account['user_id']) ? $account['user_id'] : "guest";
// var_dump($_SESSION['orders']);
// Giỏ hàng SESSION
$cart = isset($_SESSION['cart'][$userID]) ? $_SESSION['cart'][$userID] : [];
// Đếm số lượng sản phẩm trong giỏ hàng
$countCart = 0;
foreach ($cart as $product) {
  $countCart += $product['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <base href="http://localhost/mvc/">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <title>layout View</title>
</head>

<style>
  <?= require PUBLIC_PATH . "/css/style.css" ?>
</style>

<body>

  <!--  -->
  <input type="text" hidden id="UserID" UserID="<?= $userID ?>">
  <!--  -->
  <input type="text" hidden id="CountCart" CountCart="<?= $countCart ?>">

  <?php
  // Header
  require USER_PATH . "/layouts/header.php" ?>
  <!-- Main -->
  <main id="client-content">
    <?php require USER_PATH . "/pages/{$data['page']}.php"; ?>
  </main>
  <!-- Footer -->
  <?php require USER_PATH . "/layouts/footer.php"; ?>

  <div class="account">
    <div class="account-head">
      <div>
        <a id="login" class="account-active">Đăng nhập</a>
        <a id="register">Đăng ký</a>
      </div>
      <ion-icon name="close-outline" class="account-close"></ion-icon>
    </div>
    <div id="account-content"></div>
  </div>
  <div class="opacity"></div>
  <div class="opacity1"></div>
  <div id="alert">
    <div id="alert-svg">
      <svg class="od Cb ib Yb be" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
        <path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path>
      </svg>
    </div>
    <div id="alert-content"></div>
  </div>
  <div class="modal-confirm">
    <div class="modal-title">Thông báo !</div>
    <div class="modal-contentConfirm"></div>
    <div class="modal-btn">
      <a class="modal-link-confirm">Xác nhận</a>
      <a class="modal-link-cancel">Hủy bỏ</a>
    </div>
  </div>
  <div class="scrollToTop">
    <ion-icon name="arrow-up-outline"></ion-icon>
  </div>
  <!-- Jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <!-- Jquery Validate -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
  <!-- Js -->
  <script>
    <?= require PUBLIC_PATH . "/js/app.js" ?>
  </script>

</body>

</html>