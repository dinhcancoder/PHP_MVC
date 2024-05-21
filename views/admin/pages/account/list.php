<div class="product">
  <div class="titlebar">Admin / Tài khoản / Danh sách tài khoản</div>
  <div class="search">
    <input type="text" placeholder="Tìm kiếm...">
  </div>
  <table class="table">
    <thead>
      <tr>
        <th>STT</th>
        <th>Họ và tên</th>
        <th>Avatar</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Địa chỉ</th>
        <th>Chức vụ</th>
        <th>Chức năng</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $stt = 0;
      foreach ($data['list'] as $user) {
        extract($user);
      ?>
        <tr>
          <td><?= $stt++ ?></td>
          <td><?= $fullname ?></td>
          <td>
            <div class="avatar">
              <img src="<?= BASE_URL . "/public/images/uploads/" . $avatar ?>" alt="">
            </div>
          </td>
          <td><?= $email ?></td>
          <td><?= !empty($phone) ? $phone : "Chưa cập nhật" ?></td>
          <td><?= !empty($address) ? $address : "Chưa cập nhật" ?></td>
          <td><?= $position == 1 ? "Admin" : "Member" ?></td>
          <td>
            <div>
              <a id="EditAccount" UserID="<?= $user_id ?>">Sửa <ion-icon name="create-outline" role="img" class="md hydrated"></ion-icon></a>
              <a id="HandlerAccountDelete" UserID="<?= $user_id ?>">Xóa <ion-icon name="close-outline" role="img" class="md hydrated"></ion-icon></a>
            </div>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>