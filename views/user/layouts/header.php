<header class="header">
  <!--  -->
  <div class="header-bg1">
    <div class="container">
      <div class="header-topbar">
        <a href="" class="underline">Tài khoản OpenAI - ChatGPT (Có sẵn 18$)</a>
        <div>
          <a href="" class="header-link">
            <div class="header-icon">
              <img src="<?= PUBLIC_PATH ?>/images/icons/book.svg" style="width: 15px;">
            </div>
            <label class="underline">Hướng dẫn mua hàng</label>
          </a>
          <a href="" class="header-link">
            <div class="header-icon">
              <img src="<?= PUBLIC_PATH ?>/images/icons/badge-percent.svg" style="width: 16.5px;">
            </div>
            <label class="underline">Ưu đãi khách hàng</label>
          </a>
          <a href="" class="header-link">
            <div class="header-icon">
              <img src="<?= PUBLIC_PATH ?>/images/icons/phone.svg" style="width: 17px;">
            </div>
            <label class="underline">Thông tin liên hệ</label>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!--  -->
  <div class="header-bg2">
    <div class="container">
      <div class="header-main">
        <!--  -->
        <div class="header-navbar">
          <a href="" class="header-logo">
            <img src="https://cdn.divineshop.vn/static/b1402e84a947ed36cebe9799e47f61c2.svg" alt="" style="width: 49px; height: 49px;">
            <h4>Account Shop</h4>
          </a>
          <div class="header-search">
            <div class="search">
              <input type="text" placeholder="Tìm kiếm sản phẩm" id="search">
              <button id="searchFilter"><img src="<?= PUBLIC_PATH ?>/images/icons/search.svg" style="width: 17.5px; filter: invert(1);"></button>
            </div>
            <ul class="search-suggest" id="suggest">
              <li><a href="" class="underline">Tài khoản OpenAI - ChatGPT (Có sẵn 5$)</a></li>
              <li><a href="" class="underline">Vẽ tranh siêu đỉnh bằng AI với Midjourney</a></li>
              <li><a href="" class="underline">Phần mềm thiết kế AĐôBe Full App</a></li>
              <li><a href="" class="underline">Nâng cấp AutoDesk</a></li>
              <li><a href="" class="underline">Gia hạn Youtube Premium</a></li>
              <li><a href="" class="underline">Tài khoản Netflix Premium</a></li>
              <li><a href="" class="underline">Windows, Office bản quyền</a></li>
              <li><a href="" class="underline">QuillBot Premium</a></li>
            </ul>
          </div>
          <div class="header-account">
            <?php
            if ($account != []) {
            ?>
              <div class="account-avatar">
                <img src="<?= BASE_URL ?>/public/images/uploads/<?= $account['avatar'] ?>" alt="">
              </div>
              <div class="account-user">
                <a><?= $account['fullname'] ?></a>
              </div>
              <div class="account-control">
                <li style="padding: 10px 0 5px 10px; display: flex; flex-direction: column; gap: 10px 0">
                  <p style="cursor: auto;">Số dư tài khoản</p>
                  <span style="display: flex; align-items: center; gap: 0 8px; color: #4a6cf7;">
                    <div class="money" moneyold="<?= $account['money'] ?>"><?= number_format($account['money'], 0, ",", ".") ?>đ</div>
                    <div style="width: 15px; height: 15px; display: flex; justify-content: center; align-items: center; border: 1px solid #4a6cf7; border-radius: 50%;"><ion-icon name="add-outline" style="font-size: 12px;"></ion-icon></div>
                  </span>
                </li>
                <li><a href="http://localhost/mvc/account">Quản lý tài khoản</a></li>
                <?php
                if ($account['position'] == 1) {
                ?>
                  <li><a href="http://localhost/mvc/admin">Quản trị viên</a></li>
                <?php
                }
                ?>
                <li><a id="logout">Đăng xuất</a></li>
              </div>
            <?php
            } else {
            ?>
              <div class="b1">
                <img src="<?= PUBLIC_PATH ?>/images/icons/user.svg" style="width: 17.5px; filter: invert(1);">
              </div>
              <div class="b2">
                <a>Đăng nhập</a>
                <div style="margin: 0 7px;">/</div>
                <a>Đăng ký</a>
              </div>
            <?php
            }
            ?>
          </div>
          <a href="cart" class="header-cart" style="cursor: pointer;">
            <img src="<?= PUBLIC_PATH ?>/images/icons/cart.svg" style="width: 20px; filter: invert(1);">
            <label>Giỏ hàng</label>
            <span><?= $countCart ?></span>
          </a>
        </div>
        <!--  -->
        <div class="header-highlight">
          <a href="" class="header-link">
            <div class="header-icon">
              <img src="<?= PUBLIC_PATH ?>/images/icons/eye.svg" style="width: 19px;">
            </div>
            <label class="underline">Sản phẩm bạn vừa xem</label>
          </a>
          <a href="" class="header-link">
            <div class="header-icon">
              <img src="<?= PUBLIC_PATH ?>/images/icons/hot.svg" style="width: 13px;">
            </div>
            <label class="underline">Sản phẩm mua nhiều</label>
          </a>
          <a href="" class="header-link">
            <div class="header-icon">
              <img src="<?= PUBLIC_PATH ?>/images/icons/sale.svg" style="width: 15px;">
            </div>
            <label class="underline">Sản phẩm khuyến mãi</label>
          </a>
          <a href="" class="header-link">
            <div class="header-icon">
              <img src="<?= PUBLIC_PATH ?>/images/icons/map.svg" style="width: 19px;">
            </div>
            <label class="underline">Đại lý giao dịch</label>
          </a>
          <a href="" class="header-link">
            <div class="header-icon">
              <img src="<?= PUBLIC_PATH ?>/images/icons/pay.svg" style="width: 19px;">
            </div>
            <label class="underline">Hình thức thanh toán</label>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!--  -->
  <div class="header-bot">
    <div class="container">
      <div class="header-botlayout">
        <a href="">
          <img src="<?= PUBLIC_PATH . "/images/icons/bars.svg" ?>" alt="">
          Danh mục sản phẩm
        </a>
        <div class="header-botList">
          <li>
            <img src="<?= PUBLIC_PATH . "/images/icons/bot1.svg" ?>" alt="">
            <a class="underline">Thủ thuật & Tin tức</a>
          </li>
          <li>
            <img src="<?= PUBLIC_PATH . "/images/icons/bot2.svg" ?>" alt="">
            <a class="underline">Giới thiệu bạn bè</a>
          </li>
          <li>
            <img src="<?= PUBLIC_PATH . "/images/icons/bot3.svg" ?>" alt="">
            <a class="underline">Liên hệ hợp tác</a>
          </li>
          <li>
            <img src="<?= PUBLIC_PATH . "/images/icons/bot4.svg" ?>" alt="">
            <a class="underline">Ưu đãi khách hàng VIP</a>
          </li>
        </div>
      </div>
    </div>
  </div>
</header>