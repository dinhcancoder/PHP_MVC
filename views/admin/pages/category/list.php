<div class="category-list">
  <div class="titlebar">Admin / Danh mục / Danh sách danh mục</div>
  <div class="search">
    <input type="text" placeholder="Tìm kiếm...">
  </div>
  <table class="table">
    <thead>
      <tr>
        <th>STT</th>
        <th>Tên danh mục</th>
        <th>Chức năng</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $stt = 0;
      foreach ($data['listCategory'] as $row) {
        $stt++;
        extract($row);
      ?>
        <tr>
          <td><?= $stt ?></td>
          <td><?= $category_name ?></td>
          <td>
            <div>
              <a class="Edit" CategoryID="<?= $category_id ?>">Sửa <ion-icon name="create-outline"></ion-icon></a>
              <a class="Delete" CategoryID="<?= $category_id ?>">Xóa <ion-icon name="close-outline"></ion-icon></i></a>
            </div>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>