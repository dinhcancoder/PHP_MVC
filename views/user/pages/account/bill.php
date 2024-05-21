<div style="display: flex; justify-content: space-between; align-items: center; grid-column: 2 span;">
  <div class="account-title">Chi tiết đơn hàng <span>#<?= $data['orderid'] ?></span></div>
  <?php
  if ($data['order']['status'] == 0) {
  ?>
    <a class="btn-order" id="order-cancel" style="color: #dc3545;" OrderID="<?= $data['order']['order_id'] ?>">
      <svg style="height: 17.5px; fill: #dc3545;" class="od Cb Da" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
        <path d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path>
      </svg> Hủy đơn hàng</a>
  <?php
  } else {
  ?>
    <a class="btn-order order-reset" style="color: #2579f2;" OrderID="<?= $data['order']['order_id'] ?>">
      <svg style="height: 17.5px; fill: #2579f2;" class="od Cb Da" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
        <path d="M551.991 64H144.28l-8.726-44.608C133.35 8.128 123.478 0 112 0H12C5.373 0 0 5.373 0 12v24c0 6.627 5.373 12 12 12h80.24l69.594 355.701C150.796 415.201 144 430.802 144 448c0 35.346 28.654 64 64 64s64-28.654 64-64a63.681 63.681 0 0 0-8.583-32h145.167a63.681 63.681 0 0 0-8.583 32c0 35.346 28.654 64 64 64s64-28.654 64-64c0-18.136-7.556-34.496-19.676-46.142l1.035-4.757c3.254-14.96-8.142-29.101-23.452-29.101H203.76l-9.39-48h312.405c11.29 0 21.054-7.869 23.452-18.902l45.216-208C578.695 78.139 567.299 64 551.991 64zM464 424c13.234 0 24 10.766 24 24s-10.766 24-24 24-24-10.766-24-24 10.766-24 24-24zm-256 0c13.234 0 24 10.766 24 24s-10.766 24-24 24-24-10.766-24-24 10.766-24 24-24zm279.438-152H184.98l-31.31-160h368.548l-34.78 160zM272 200v-16c0-6.627 5.373-12 12-12h32v-32c0-6.627 5.373-12 12-12h16c6.627 0 12 5.373 12 12v32h32c6.627 0 12 5.373 12 12v16c0 6.627-5.373 12-12 12h-32v32c0 6.627-5.373 12-12 12h-16c-6.627 0-12-5.373-12-12v-32h-32c-6.627 0-12-5.373-12-12z"></path>
      </svg> Mua lại đơn hàng</a>
  <?php
  }
  ?>
</div>
<div class="account-describe">Hiển thị thông tin các sản phẩm bạn đã mua tại Account Shop</div>
<div class="account-hr"></div>
<div class="order-detail">
  <div class="order-info">
    <div>
      <div class="order-title">Thông tin đơn hàng</div>
      <ul>
        <li>Mã đơn hàng: <span>#<?= $data['orderid'] ?></span></li>
        <li>Ngày tạo: <span><?= $data['order']['date'] ?></span></li>
        <li>Thời gian: <span><?= $data['order']['time'] ?></span></li>
        <li>Trạng thái đơn hàng:
          <?php
          if ($data['order']['status'] == 0) {
          ?>
            <span style="color: #e98b11;">Đang xử lý</span>
          <?php
          } else if ($data['order']['status'] == 1) {
          ?>
            <span style="color: #29b474;">Đã xử lý</span>
          <?php
          } else {
          ?>
            <span style="color: #dc3545;">Đã hủy</span>
          <?php
          }
          ?>
        </li>
        <li>Người nhận: <span><?= $data['order']['email'] ?></span></li>
        <li>Hình thức thanh toán: <span><?= $data['order']['method'] ?></span></li>
      </ul>
    </div>
    <div>
      <div class="order-title">Giá trị đơn hàng</div>
      <ul>
        <li>Thành tiền: <span><?= number_format(($data['order']['anmount'] - $data['order']['transactionfee']), 0, ",", ".") ?>đ</span></li>
        <li>Phí giao dịch: <span><?= number_format($data['order']['transactionfee'], 0, ",", ".") ?>đ <?= $data['order']['transactionfee'] != 0 ? "(5%)" : "" ?></span></li>
        <li>Tổng thành tiền: <span><?= number_format($data['order']['anmount'], 0, ",", ".") ?>đ</span></li>
      </ul>
    </div>
  </div>
</div>
<div class="account-hr"></div>
<div style="display: flex; flex-direction: column; gap: 10px 0">
  <?php
  foreach ($data['detaillist'] as $product) {
    extract($product);
  ?>
    <div class="detail1-product">
      <div class="detail1-image">
        <img src="
        <?php foreach ($data['productlist'] as $item) {
          if ($product_id == $item['product_id']) {
            echo $item['product_image'];
            break;
          }
        }
        ?>" alt="">
      </div>
      <div class="detail1-sp">
        <a href="product/detail/<?= $product_id ?>" class="name underline">
          <?php
          foreach ($data['productlist'] as $item) {
            if ($product_id == $item['product_id']) {
              echo $item['product_name'];
              break;
            }
          }
          ?>
        </a>
        <div class="quantity">Số lượng: <span><?= $quantity ?></span></div>
        <span><?= number_format($price, 0, ",", ".") ?>đ</span>
      </div>
    </div>
  <?php
  }
  ?>
</div>