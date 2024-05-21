<div class="container">
  <div class="cart-statuss">
    <span class="active">Giỏ hàng</span>
    <span>Xác nhận</span>
    <span>Thanh toán</span>
  </div>
  <div class="cart">
  </div>
  <div class="email-pay">
    <h3>Nhập email mua hàng của bạn</h3>
    <div class="content">
      <div class="gr">
        <input type="text" placeholder="" id="emailConfirm">
        <label for="">Email mua hàng</label>
      </div>
      <span style="color: #dc3545; display: block; margin-top: 8px;" class="errorConfirmEmailPay"></span>
      <p><span style="color: #dc3545;">Lưu ý</span>: Hãy nhập chính xác địa chỉ email của bạn vì email này sẽ được dùng để nhận thông tin đơn hàng khi bạn thanh toán thành công.
      </p>
      <div class="btn">
        <button id="isConfirmPay" UserID="<?= $userID ?>">Xác nhận</button>
        <button id="CloseConfirm">Hủy</button>
      </div>
    </div>
  </div>
</div>