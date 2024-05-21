<form id="loginForm">
  <div class="account-layout">
    <div class="account-form">
      <p class="account-desc">Đăng nhập để theo dõi đơn hàng, lưu danh sách sản phẩm yêu thích và nhận nhiều ưu đãi hấp dẫn</p>
      <div class="test"></div>
      <div class="account-group">
        <input type="text" placeholder="Email hoặc tên đăng nhập" name="email" id="email">
        <span class="account-error"></span>
      </div>
      <div class="account-group">
        <input type="password" placeholder="Mật khẩu" name="password" id="password">
        <div class="eye">
          <ion-icon name='eye-off-outline'></ion-icon>
        </div>
      </div>
      <a class="underline forgot">Bạn quên mật khẩu?</a>
      <button id="login">Đăng nhập</button>
      <span class="account-other">Hoặc đăng nhập bằng</span>
      <div class="account-icons">
        <img src="https://cdn.divineshop.vn/static/0b314f30be0025da88c475e87a222e5a.svg" alt="">
        <img src="https://cdn.divineshop.vn/static/4ba68c7a47305b454732e1a9e9beb8a1.svg" alt="">
      </div>
    </div>
    <div class="account-svg">
      <img src="https://cdn.divineshop.vn/static/368e705d45bfc8742aa9d20dbcf4c78c.svg" alt="">
    </div>
  </div>
</form>
<script>
  $("#loginForm").validate({
    rules: {
      "email": {
        required: true,
      },
      "password": {
        required: true,
      }
    },
    messages: {
      "email": {
        required: "Trường này không được để trống!",
      },
      "password": {
        required: "Vui lòng nhập mật khẩu!",
      },
    },
    submitHandler: function() {
      $.ajax({
        url: "http://localhost/mvc/account/Login",
        type: "post",
        data: {
          email: $("#email").val(),
          password: $("#password").val()
        },
        success: function(data) {
          console.log(data);
          if (data == "error") {
            $(".account-error").text("Tài khoản hoặc mật khẩu không chính xác");
          } else {
            window.location.href = window.location.href;
          }
        }
      })
    }
  })
</script>