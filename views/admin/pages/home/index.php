<?php
$TotalRevenue = 0;
foreach ($data['TotalRevenue'] as $total) {
  $TotalRevenue += $total['daily_revenue'];
}
?>
<div class="dashboard">
  <div class="dashboard-statistical">
    <div class="dashboard-box">
      <div class="l">
        <h2><?= $data['ProductCount'] ?></h2>
        <span>Số lượng sản phẩm</span>
      </div>
      <div class="r">
        <i class="fas fa-box-open"></i>
      </div>
    </div>
    <div class="dashboard-box">
      <div class="l">
        <h2><?= $data['AccountCount'] ?></h2>
        <span>Khách hàng</span>
      </div>
      <div class="r">
        <i class="fas fa-user"></i>
      </div>
    </div>
    <div class="dashboard-box">
      <div class="l">
        <h2><?= $data['OrderCount'] ?></h2>
        <span>Đơn hàng</span>
      </div>
      <div class="r">
        <i class="fab fa-shopify"></i>
      </div>
    </div>
    <div class="dashboard-box">
      <div class="l">
        <h2 class="l"><?= number_format($TotalRevenue, 0, ",", ".") ?>đ</h2>
        <span>Tồng doanh thu</span>
      </div>
      <div class="r">
        <i class="far fa-money-bill-alt"></i>
      </div>
    </div>
  </div>
</div>