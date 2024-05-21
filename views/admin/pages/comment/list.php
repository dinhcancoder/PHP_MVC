<div>
  <div class="titlebar">Admin / Bình luận / Danh sách bình luận</div>
  <div class="search">
    <input type="text" placeholder="Tìm kiếm...">
  </div>
  <table class="table">
    <thead>
      <tr>
        <th>STT</th>
        <th>Tên sản phẩm</th>
        <th>Số bình luận</th>
        <th>Ngày cũ nhất</th>
        <th>Ngày mới nhất</th>
        <th>Chức năng</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $stt = 0;
      foreach ($data['list'] as $comment) {
        extract($comment);
      ?>
        <tr>
          <td><?= $stt++ ?></td>
          <td><?= $product_name ?></td>
          <td><?= $quantity ?></td>
          <td><?= $dateOld ?></td>
          <td><?= $dateNew ?></td>
          <td>
            <div>
              <a id="DetailComment" ProductID="<?= $product_id ?>" style="color: rgb(255, 95, 32);">Chi tiết <ion-icon name="alert-outline"></ion-icon></a>
            </div>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>