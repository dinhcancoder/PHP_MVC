<?php $account = $_SESSION['account'] ? $_SESSION['account'] : [] ?>
<div class="account-title" style="margin-bottom: 20px;">Tổng quan</div>
<input type="text" hidden id="GetUserID" UserID="<?= $account['user_id'] ?>">
<div class="account-info">
  <div class="b1">
    <label for="">Tên đăng nhập</label>
    <span><?= $account['user'] ?></span>
  </div>
  <div class="b1">
    <label for="">Email</label>
    <span><?= $account['email'] ?></span>
  </div>
  <div class="b1">
    <label for="">Họ và tên</label>
    <span><?= $account['fullname'] ?></span>
  </div>
  <div class="b1">
    <label for="">Nhóm khách hàng</label>
    <span><?= $account['position'] == 1 ? "Admin" : "Member" ?></span>
  </div>
  <div class="b1">
    <label for="">Số điện thoại</label>
    <span><?= $account['phone'] != "" ? $account['phone'] : "Chưa cập nhật" ?></span>
  </div>
  <div class="b1">
    <label for="">Địa chỉ</label>
    <span><?= $account['address'] != "" ? $account['address'] : "Chưa cập nhật" ?></span>
  </div>
  <div class="b1">
    <label for="">Số dư</label>
    <span><?= number_format($account['money'], 0, ",", ".") ?>đ</span>
  </div>
</div>
<div class="account-image">
  <div class="avatar">
    <div class="img">
      <input type="text" hidden id="GetAvatar" GetAvatar="<?= $account['avatar'] ?>">
      <img src="<?= BASE_URL ?>/public/images/uploads/<?= $account['avatar'] ?>" alt="">
    </div>
    <input type="file" hidden id="avatar">
    <a id="openChooseAvatar">Sửa ảnh đại diện</a>
  </div>
  <div class="desc">
    <span>Vui lòng chọn ảnh nhỏ hơn 5MB</span>
    <span>Chọn hình ảnh phù hợp, không phản cảm</span>
  </div>
</div>
<div class="account-title" style="margin-bottom: 18px;">Cá nhân</div>
<div class="account-update">
  <div class="account-gr">
    <input type="text" placeholder="" value="<?= $account['fullname'] ?>" id="fullname">
    <label for="">Họ và tên</label>
  </div>
  <div class="account-gr">
    <input type="text" placeholder="" value="<?= $account['email'] ?>" disabled style="background-color: #f6f6f6; outline-color: #f6f6f6;">
    <label for="">Email</label>
  </div>
  <div class="account-gr">
    <input type="text" placeholder="" id="phone" value="<?= $account['phone'] == "" ? "" : $account['phone'] ?>">
    <label for="">Số điện thoại</label>
  </div>
  <div class="account-gr">
    <input type="text" placeholder="" id="address" value="<?= $account['address'] == "" ? "" : $account['address'] ?>">
    <label for="">Địa chỉ</label>
  </div>
  <button id="updateAccount">Lưu thay đổi</button>
</div>