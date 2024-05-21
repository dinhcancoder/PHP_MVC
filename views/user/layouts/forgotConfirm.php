<div id="forgotConfirm">
  <div class="account-head">
    <div>
      <a style="color: black;">Nhập mã xác thực</a>
    </div>
    <ion-icon name="close-outline" class="account-close md hydrated" role="img" aria-label="close outline"></ion-icon>
  </div>
  <div class="account-layout" style="align-items: flex-start;">
    <div class="account-form">
      <p class="account-desc">Vui lòng nhập mã OTP được gửi tới email của bạn để xác thực</p>
      <div class="test"></div>
      <div class="account-group">
        <input type="text" placeholder="Mã xác thực" name="otp" id="otp">
        <div class="account-error"></div>
      </div>
      <button id="confirm-otp" OTP="<?= $data['otp'] ?>" Password="<?= $data['password'] ?>" User="<?= $data['user'] ?>">Xác nhận</button>
    </div>
    <div class="account-svg">
      <img src="https://cdn.divineshop.vn/static/368e705d45bfc8742aa9d20dbcf4c78c.svg" alt="">
    </div>
  </div>
</div>