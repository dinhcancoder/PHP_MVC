<form id="registerForm">
  <div class="account-layout">
    <div class="account-form">
      <p class="account-desc">Đăng ký để theo dõi đơn hàng, lưu danh sách sản phẩm yêu thích và nhận nhiều ưu đãi hấp dẫn</p>
      <div class="account-group">
        <input type="text" placeholder="Họ và tên" name="fullname" id="fullname">
      </div>
      <div class="account-group">
        <input type="text" placeholder="Email" name="email" id="email">
      </div>
      <div class="account-group">
        <input type="text" placeholder="Tên đăng nhập" name="user" id="user">
      </div>
      <div class="account-group">
        <input type="password" placeholder="Mật khẩu" name="password" id="password">
        <div class="eye">
          <ion-icon name='eye-off-outline'></ion-icon>
        </div>
      </div>
      <div class="account-group">
        <input type="password" placeholder="Nhập lại mật khẩu" name="confirm-password" id="confirm-password">
        <div class="eye">
          <ion-icon name='eye-off-outline'></ion-icon>
        </div>
      </div>
      <div class="account-confirm">
        <input type="checkbox" id="checkbox" name="agree" checked>
        <label for="checkbox">Tôi đồng ý nhận thông tin marketing mới từ Account Shop.</label>
      </div>
      <button>Tạo tài khoản</button>
    </div>
    <div class="account-svg">
      <img src="https://cdn.divineshop.vn/static/235dccb09069e3d4eebc6227236f9dc2.svg" alt="">
    </div>
  </div>
  </div>
</form>
<script>
  $("#registerForm").validate({
    rules: {
      "fullname": {
        required: true,
      },
      "email": {
        required: true,
        email: true,
      },
      "user": {
        required: true,
      },
      "password": {
        required: true,
        minlength: 8
      },
      "confirm-password": {
        equalTo: "#password",
        minlength: 8
      },
    },
    messages: {
      "fullname": {
        required: "Vui lòng nhập họ và tên",
      },
      "email": {
        required: "Vui lòng nhập email",
        email: "Email không hợp lệ",
      },
      "user": {
        required: "Vui lòng nhập username",
      },
      "password": {
        required: "Vui lòng nhập password",
        minlength: "Hãy nhập ít nhất 8 ký tự"
      },
      "confirm-password": {
        equalTo: "Mật khẩu xác nhận không chính xác",
        minlength: "Hãy nhập ít nhất 8 ký tự"
      }
    },
    submitHandler: function() {
      $.ajax({
        url: "http://localhost/mvc/account/Register",
        type: "post",
        data: {
          fullname: $("#fullname").val(),
          email: $("#email").val(),
          user: $("#user").val(),
          password: $("#password").val()
        },
        success: function() {
          $(".account-layout").load("mvc/views/user/layouts/login.php");
          $("#login").addClass("account-active");
          $("#register").removeClass("account-active");

          function myAlert(content) {
            $("#alert").css("right", "22px");
            $("#alert-content").text(content);
            setTimeout(function() {
              $("#alert").css("right", "-100%");
            }, 2000);
          }

          myAlert("Tạo tài khoản thành công");
        }
      })
    }
  });
</script>