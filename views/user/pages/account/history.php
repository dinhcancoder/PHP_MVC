<div class="account-title">Lịch sử giao dịch</div>
<div class="account-describe">Hiển thị tất cả các giao dịch bạn dã thực hiện tại Divine Shop
</div>
<div class="account-hr"></div>
<?php
if (empty($data['list'])) {
?>
  <img style="width: 232.7px; height: 252px;" src="https://cdn.divineshop.vn/static/4e0db8ffb1e9cac7c7bc91d497753a2c.svg" alt="">
<?php
} else {
?>
  <div class="account-filter account-filter-5">
    <div>
      <input type="text" placeholder="">
      <label for="">Mô tả</label>
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
  <div class="account-history">
    <div class="account-table">
      <table>
        <thead>
          <tr>
            <th style="min-width: 172px;">Thời gian</th>
            <th style="width: 100%;">Mô tả</th>
            <th style="min-width: 90px;">Số tiền</th>
            <th style="min-width: 90px;">Số dư</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($data['list'] as $item) {
            extract($item);
          ?>
            <tr>
              <td><?= $date . " " . $time ?></td>
              <td>Số ID đơn hàng: #<?= $code ?></td>
              <td style="color: #dc3545;">-<?= number_format($anmount, 0, ",", ".") ?>đ</td>
              <td><?= number_format($money, 0, ",", ".") ?>đ</td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
<?php
}
?>