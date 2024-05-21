<div class="admin-navbar">
  <div class="navbar">
    <a class="navbar-logo">
      <img src="https://cdn.divineshop.vn/static/b1402e84a947ed36cebe9799e47f61c2.svg" alt="" style="width: 49px; height: 49px;">
      <h4>Account Shop</h4>
    </a>
    <div class="userFixed">
      <div>
        <div class="userFixed-avatar">
          <img src="<?= BASE_URL ?>/public/images/uploads/<?= $avatar ?>" alt="">
        </div>
        <div>
          <h3><?= $account['fullname'] ?></h3>
          <span>Admin</span>
        </div>
      </div>
      <a href="<?= BASE_URL ?>"><i class="fas fa-sign-out-alt fa-rotate-180"></i></a>
    </div>
    <!-- <div class="navbar-user">
    </div> -->
    <ul class="navbar-list">
      <div class="navbar-group">
        <a class="navbar-link active bg-active" id="Dashboard">
          <div class="navbar-flex">
            <i class="fas fa-tachometer-alt"></i>
            Bảng điều khiển
          </div>
        </a>
      </div>
      <div class="navbar-group">
        <a class="navbar-link">
          <div class="navbar-flex">
            <i class="fas fa-th-large"></i>
            Danh mục
          </div>
          <i class="fas fa-chevron-right" style="font-size: 13px;"></i>
        </a>
        <ul class="navbar-submenu">
          <li><a id="CategoryAdd"><i class="fas fa-circle" style="font-size: 6px;"></i> Thêm danh mục</a></li>
          <li><a id="CategoryList"><i class="fas fa-circle" style="font-size: 6px;"></i> Danh sách danh mục</a></li>
        </ul>
      </div>
      <div class="navbar-group">
        <a class="navbar-link">
          <div class="navbar-flex">
            <i class="fas fa-archive"></i>
            Sản phẩm
          </div>
          <i class="fas fa-chevron-right" style="font-size: 13px;"></i>
        </a>
        <ul class="navbar-submenu">
          <li><a id="ProductAdd"><i class="fas fa-circle" style="font-size: 6px;"></i> Thêm sản phẩm</a></li>
          <li><a id="ProductList"><i class="fas fa-circle" style="font-size: 6px;"></i> Danh sách sản phẩm</a></li>
        </ul>
      </div>
      <div class="navbar-group">
        <a class="navbar-link">
          <div class="navbar-flex">
            <i class="fas fa-user"></i>
            Tài khoản
          </div>
          <i class="fas fa-chevron-right" style="font-size: 13px;"></i>
        </a>
        <ul class="navbar-submenu">
          <li><a id="AccountAdd"><i class="fas fa-circle" style="font-size: 6px;"></i> Thêm người dùng</a></li>
          <li><a id="AccountList"><i class="fas fa-circle" style="font-size: 6px;"></i> Danh sách người dùng</a></li>
        </ul>
      </div>
      <div class="navbar-group">
        <a class="navbar-link" id="Order">
          <div class="navbar-flex">
            <i class="fas fa-shopping-cart"></i>
            Đơn hàng
          </div>
        </a>
      </div>
      <div class="navbar-group">
        <a class="navbar-link">
          <div class="navbar-flex">
            <i class="fas fa-newspaper"></i>
            Bài viết
          </div>
        </a>
      </div>
      <div class="navbar-group" id="Comment">
        <a class="navbar-link">
          <div class="navbar-flex">
            <i class="fas fa-comment"></i>
            Bình luận
          </div>
        </a>
      </div>
      <div class="navbar-group">
        <a class="navbar-link" id="Statistical">
          <div class="navbar-flex">
            <i class="fas fa-table"></i>
            Thống kê
          </div>
        </a>
      </div>
    </ul>
  </div>
</div>