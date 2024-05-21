<?php
// Tài khoản người dùng
$account = isset($_SESSION['account']) ? $_SESSION['account'] : [];
$avatar = $account['avatar'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <base href="http://localhost/mvc/admin/">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Ckeditor -->
  <script src="//cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
  <!-- Charts -->
  <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
  <title>Dashboard</title>
</head>

<style>
  <?= require PUBLIC_PATH . "/css/admin.css" ?>
</style>

<body>

  <!-- Layout -->
  <div class="admin-layout">
    <!-- Sidebar -->
    <aside class="admin-aside">
      <?php require ADMIN_PATH . "/layouts/sidebar.php"; ?>
    </aside>
    <!-- Content -->
    <article class="admin-content">
      <!-- Navi -->
      <nav>
        <?php require ADMIN_PATH . "/layouts/navbar.php"; ?>
      </nav>
      <!-- Load Content -->
      <main id="main-content">
        <?php require ADMIN_PATH . "/pages/{$data['page']}.php"; ?>
      </main>
    </article>
    <!-- Modal -->
    <?php require ADMIN_PATH . "/layouts/modal.php" ?>
  </div>

  <!-- ion-icon -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <!-- Jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <!-- Jquery Validate -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
  <!-- Js -->
  <script>
    <?= require PUBLIC_PATH . "/js/ajax.js" ?>
  </script>
</body>

</html>