<div class="order-detail">
  <div class="titlebar">Admin / Thanh toán / Chi tiết hóa đơn</div>
  <div class="search">
    <input type="text" placeholder="Tìm kiếm...">
  </div>
  <table class="table">
    <thead>
      <tr>
        <th>STT</th>
        <th>Tên sản phẩm</th>
        <th>Giá tiền</th>
        <th>Số lượng</th>
        <th>Thành tiền</th>
        <th>Chức năng</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $stt = 0;
      foreach ($data['orderdetail'] as $list) {
        extract($list);
      ?>
        <tr>
          <td><?= $stt++ ?></td>
          <td>
            <?php
            foreach ($data['productlist'] as $item) {
              if ($product_id == $item['product_id']) {
                echo $item['product_name'];
                break;
              }
            }
            ?>
          </td>
          <td><?= number_format($price, 0, ",", ".") ?>đ</td>
          <td><?= $quantity ?></td>
          <td><?= number_format($subtotal, 0, ",", ".") ?>đ</td>
          <td>
            <div>
              <a>Xóa <ion-icon name="trash-outline"></ion-icon></a>
            </div>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>