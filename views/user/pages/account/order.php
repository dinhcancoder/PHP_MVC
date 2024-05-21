<div class="account-title">Lịch sử đơn hàng</div>
<div class="account-describe">Hiển thị thông tin các sản phẩm bạn đã mua tại Account Shop</div>
<div class="account-hr"></div>
<?php
if (!empty($data['list'])) {
?>
  <div class="account-filter account-filter-5">
    <div>
      <input type="text" placeholder="">
      <label for="">Mã đơn hàng</label>
    </div>
    <div>
      <input type="text" placeholder="">
      <label for="">Số tiền từ</label>
    </div>
    <div>
      <input type="text" placeholder="">
      <label for="">Số tiền đến</label>
    </div>
    <div>
      <input type="date" placeholder="">
      <label for="">Từ ngày</label>
    </div>
    <div>
      <input type="date" placeholder="">
      <label for="">Đến ngày</label>
    </div>
  </div>
  <div class="account-table">
    <table>
      <thead>
        <tr>
          <th>Thời gian</th>
          <th>Mã đơn hàng</th>
          <th>Sản phẩm</th>
          <th>Tổng tiền</th>
          <th>Trạng thái</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($data['list'] as $order) {
          extract($order);
        ?>
          <tr>
            <td><?= $date . " " . $time ?></td>
            <td>#<?= $code ?></td>
            <td class="flex">
              <?= $_SESSION['orders'][$user_id][$code][0][0]['product_name']; ?>
              <span style="margin-left: 5px;">...</span>
            </td>
            <td><?= number_format($anmount, 0, ",", ".") ?>đ</td>
            <?php
            if ($status == 0) {
            ?>
              <td style="color: #e98b11;">Đang xử lý</td>
            <?php
            } else if ($status == 1) {
            ?>
              <td style="color: #29b474;">Đã xử lý</td>
            <?php
            } else if ($status == 2) {
            ?>
              <td style="color: #dc3545;">Đã hủy</td>
            <?php
            }
            ?>
            <td class="underline orderdetail" OrderID="<?= $order_id ?>" style="cursor: pointer; color: #2579f2;">Chi tiết</td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
<?php
} else {
?>
  <img style="width: 232.7px; height: 252px;" src="https://cdn.divineshop.vn/static/4e0db8ffb1e9cac7c7bc91d497753a2c.svg" alt="">
<?php
}
?>