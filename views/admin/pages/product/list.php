<div class="product">
  <div class="titlebar">Admin / Sản phẩm / Danh sách sản phẩm</div>
  <div class="search">
    <input type="text" placeholder="Tìm kiếm...">
  </div>
  <table class="table">
    <thead>
      <tr>
        <th>STT</th>
        <th>Tên sản phẩm</th>
        <th>Đơn giá</th>
        <th>Giảm giá</th>
        <th>Tồn kho</th>
        <th>Tình trạng</th>
        <th>Chức năng</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $stt = 0;
      foreach ($data['listProduct'] as $row) {
        extract($row); ?>
        <tr>
          <td><?= $stt++ ?></td>
          <td><?= $product_name ?></td>
          <td><?= number_format($product_price) ?>đ</td>
          <td><?= $product_discount ?>%</td>
          <td><?= $inventory ?></td>
          <td><?= $inventory != 0 ? "Còn hàng" : "<span style='color: rgb(255, 55, 55)'>Hết hàng</span>" ?></td>
          <td>
            <div>
              <a class="EditProduct" ProductID="<?= $product_id ?>">Sửa <ion-icon name="create-outline" role="img" class="md hydrated"></ion-icon></a>
              <a class="DeleteProduct" ProductID="<?= $product_id ?>">Xóa <ion-icon name="close-outline" role="img" class="md hydrated"></ion-icon></a>
            </div>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>