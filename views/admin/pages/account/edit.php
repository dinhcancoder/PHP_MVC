<?php extract($data['user']) ?>
<div class="account-form">
  <div class="titlebar">Admin / Tài khoản / Sửa tài khoản</div>
  <div class="grid grid-col-3">
    <div class="form-group">
      <label for="" class="form-name">Họ và tên</label>
      <input type="text" class="form-input" id="fullname" value="<?= $fullname ?>">
      <div class="form-error"></div>
    </div>
    <div class="form-group">
      <label for="" class="form-name">Tên đăng nhập</label>
      <input type="text" class="form-input" id="user" value="<?= $user ?>">
      <div class="form-error"></div>
    </div>
    <div class="form-group">
      <label for="" class="form-name">Mật khẩu</label>
      <input type="password" class="form-input" id="password" value="<?= $password ?>">
      <input type="text" hidden id="passwordOld" value="<?= $password ?>">
      <div class="form-error"></div>
    </div>
    <div class="form-group">
      <label for="" class="form-name">Email</label>
      <input type="text" class="form-input" id="email" value="<?= $email ?>">
      <div class="form-error"></div>
    </div>
    <div class="form-group">
      <label for="" class="form-name">Số điện thoại</label>
      <input type="text" class="form-input" id="phone" value="<?= $phone ?>">
      <div class="form-error"></div>
    </div>
    <div class="form-group">
      <label for="" class="form-name">Địa chỉ</label>
      <input type="text" class="form-input" id="address" value="<?= $address ?>">
      <div class="form-error"></div>
    </div>
    <div class="form-group">
      <label for="" class="form-name">Avatar</label>
      <input type="file" class="form-input" id="avatar">
      <input type="text" id="avatarOld" hidden value="<?= $avatar ?>">
      <div class="form-error"></div>
    </div>
    <div class="form-group">
      <label for="" class="form-name">Chức vụ</label>
      <select id="position" class="form-input">
        <option value="0" <?php if ($position == 0) echo "selected" ?>>Member</option>
        <option value="1" <?php if ($position == 1) echo "selected" ?>>Admin</option>
      </select>
    </div>
    <div class="form-group">
      <label for="" class="form-name">Số dư</label>
      <input type="text" class="form-input" id="money" value="<?= $money ?>">
      <div class="form-error"></div>
    </div>
  </div>
  <div class="control">
    <a class="btn--add" id="HandlerAccountAdd" UserID="<?= $user_id ?>">Cập nhật</a>
  </div>
</div>