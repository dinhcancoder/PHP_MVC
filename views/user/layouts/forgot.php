<form id="forgotForm">
  <div class="account-head">
    <div>
      <a style="color: black;">Đặt lại mật khẩu</a>
    </div>
    <ion-icon name="close-outline" class="account-close md hydrated" role="img" aria-label="close outline"></ion-icon>
  </div>
  <div class="account-layout">
    <div class="account-form">
      <p class="account-desc">Bạn vui lòng hoàn tất các thông tin xác thực bên dưới để chúng tôi đặt lại mật khẩu cho tài khoản của bạn</p>
      <div class="test"></div>
      <div class="account-group">
        <input type="text" placeholder="Email hoặc tên đăng nhập" name="email" id="email">
        <div class="account-error"></div>
      </div>
      <div class="account-group">
        <input type="password" placeholder="Mật khẩu mới" name="password" id="password">
      </div>
      <div class="account-group">
        <input type="password" placeholder="Nhập lại mật khẩu mới" name="confirm-password" id="confirm-password">
      </div>
      <button id="forgot">Đặt lại mật khẩu</button>
    </div>
    <div class="account-svg">
      <img src="https://cdn.divineshop.vn/static/c92dc142033ca6a66cda62bc0aec491b.svg" alt="">
    </div>
  </div>
</form>
<script>
  $("#forgotForm").validate({
    rules: {
      "email": {
        required: true,
      },
      "password": {
        required: true,
        minlength: 8
      },
      "confirm-password": {
        equalTo: "#password",
        minlength: 8
      }
    },
    messages: {
      "email": {
        required: "Trường này không được để trống!",
      },
      "password": {
        required: "Trường này không được để trống!",
        minlength: "Hãy nhập ít nhất 8 ký tự"
      },
      "confirm-password": {
        equalTo: "Mật khẩu xác nhận không chính xác",
        minlength: "Hãy nhập ít nhất 8 ký tự"
      }
    },
    submitHandler: function() {
      $.ajax({
        url: "account/Forgot",
        type: "post",
        data: {
          email: $("#email").val(),
          password: $("#password").val()
        },
        success: function(data) {
          if (data == "notfound") {
            $(".account-error").text("Email không tồn tại trong hệ thống");
          } else {
            $("#account-content").html(data);
          }
        }
      })
    }
  })
</script>