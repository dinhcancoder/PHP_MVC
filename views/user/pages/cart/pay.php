<?php
$anmount = $data['anmount'];
$discount = $data['discount'];
$subtotal = $anmount + $discount;
?>
<div class="pays">
  <div class="pays-head">
    <div class="img">
      <img src="https://cdn.divineshop.vn/image/catalog/Logo-bank/Momo.png?hash=1604888771" alt="">
    </div>
    <div class="b1">
      <h3>Nạp số dư trực tiếp bằng Momo Payment</h3>
      <p>Nạp Dcoin tự động liên kết với Momo, hoàn thành tức thì. Phí 5%</p>
    </div>
  </div>
  <div class="pays-info">
    <span>Số tiền: <?= number_format($anmount, 0, ",", ".") ?>đ</span>
    <span>Phí giao dịch: <?= number_format($discount, 0, ",", ".") ?>đ (5%)</span>
    <span>Tổng tiền: <?= number_format($subtotal, 0, ",", ".") ?>đ</span>
  </div>
  <div class="pays-instruct">
    <div class="pays-qr">
      <img src="https://chart.googleapis.com/chart?cht=qr&chld=L|1&choe=UTF-8&chs=250x250&chl=momo%3A%2F%2Fapp%3Faction%3DpayWithApp%26isScanQR%3Dtrue%26serviceType%3Dqr%26sid%3DTU9NT1hGUE4yMDE5MDUzMHxNTTExNDI0NDk%26v%3D3.0" alt="">
    </div>
    <div class="pays-content">
      <h3>Thực hiện theo hướng dẫn sau để thanh toán:</h3>
      <ul>
        <li><span>Bước 1</span>: Mở ứng dụng <span>MoMo</span> để thanh toán</li>
        <li><span>Bước 2</span>: Chọn <span>"Thanh toán"</span> và quét mã QR hướng dẫn này</li>
        <li><span>Bước 3</span>: Hoàn tất các bước thanh toán theo hướng dẫn và đợi Account Shop xử lý trong giây lát</li>
      </ul>
    </div>
  </div>
</div>