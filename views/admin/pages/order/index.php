<div class="order">
  <div class="titlebar">Admin / Đơn hàng / Danh sách đơn hàng</div>
  <div class="search">
    <input type="text" placeholder="Tìm kiếm...">
  </div>
  <table class="table">
    <thead>
      <tr>
        <th>STT</th>
        <th>Tên người dùng</th>
        <th>Mã đơn hàng</th>
        <th>Tổng đơn hàng</th>
        <th>Hình thức thanh toán</th>
        <th>Trạng thái đơn hàng</th>
        <th>Ngày</th>
        <th>Chức năng</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $stt = 0;
      foreach ($data['list'] as $pay) {
        extract($pay);
      ?>
        <tr>
          <td><?= $stt++ ?></td>
          <td>
            <?php
            foreach ($data['listUser'] as $user) {
              if ($user_id == $user['user_id']) {
                echo $user['fullname'];
                break;
              }
            }
            ?>
          </td>
          <td>#<?= $code ?></td>
          <td><?= number_format($anmount, 0, ",", ".") ?>đ</td>
          <td><?= $method ?></td>
          <td>
            <div class="dropdown <?= $status == 1 ? "pointer-events" : "" ?>">
              <?php
              if ($status == 0) {
              ?>
                <div class="input-status" style="color: rgb(255, 95, 32);">Đang chờ xử lý</div>
              <?php
              } else if ($status == 1) {
              ?>
                <div class="input-status" style="color: #29b474;">Đã thanh toán</div>
              <?php
              } else if ($status == 2) {
              ?>
                <div class="input-status" style="color: #dc3545;">Đã hủy đơn hàng</div>
              <?php
              }
              ?>
              <div class="select">
                <div Status="0" OrderID="<?= $order_id ?>" style="color: rgb(255, 95, 32);;">Đang chờ xác nhận</div>
                <div Status="1" OrderID="<?= $order_id ?>" style="color: #29b474;">Đã thanh toán</div>
                <div Status="2" OrderID="<?= $order_id ?>" style="color: #dc3545;">Hủy đơn hàng</div>
              </div>
            </div>
          </td>
          <td><?= $date ?></td>
          <td>
            <div>
              <a class="OrderDetail" OrderID="<?= $order_id ?>" style="color: rgb(99, 55, 255);">Chi tiết <ion-icon name="alert-outline"></ion-icon></a>
            </div>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>