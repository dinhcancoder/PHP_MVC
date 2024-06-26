<script>
  let categoryName = localStorage.getItem("CategoryName") || "Tất cả";
  document.getElementById("category").innerText = categoryName;
</script>
<div class="filter">
  <div class="container">
    <div class="filter-title">Lọc sản phẩm</div>
    <div class="filter-condition">
      <div class="filter-box">
        <div class="filter-flex">
          <label class="filter-name">Danh mục</label>
          <div class="select-value" value="" id="category">Tất cả</div>
        </div>
        <ion-icon name="chevron-down-outline"></ion-icon>
        <div class="select">
          <div class="option" value="">Tất cả</div>
          <?php
          foreach ($data['categories'] as $row) {
            extract($row);
          ?>
            <div class="option" value="<?= $category_id ?>"><?= $category_name ?></div>
          <?php
          }
          ?>
        </div>
      </div>
      <div class="filter-group">
        <span>Mức giá</span>
        <div>
          <div class="btn">
            <input type="text" id="priceMin" placeholder="">
            <label for="">Mức giá từ</label>
          </div>
          -
          <div class="btn">
            <input type="text" id="priceMax" placeholder="">
            <label for="">Mức giá đến</label>
          </div>
        </div>
      </div>
      <div class="filter-box">
        <div class="filter-flex">
          <label class="filter-name">Sắp xếp</label>
          <div class="select-value" value="" id="sort">Mặc định</div>
        </div>
        <ion-icon name="chevron-down-outline"></ion-icon>
        <div class="select">
          <div class="option" value="">Mặc định</div>
          <div class="option" value="6">Còn hàng</div>
          <div class="option" value="5">Sản phẩm giảm giá</div>
          <div class="option" value="1">Giá thấp đến cao</div>
          <div class="option" value="2">Giá cao đến thấp</div>
          <div class="option" value="3">Từ A đến Z</div>
          <div class="option" value="4">Từ Z đến A</div>
        </div>
      </div>
    </div>
    <div class="filter-reset underline">
      <svg class="od Cb Da" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
        <path d="M492 8h-10c-6.627 0-12 5.373-12 12v110.627C426.929 57.261 347.224 8 256 8 123.228 8 14.824 112.338 8.31 243.493 7.971 250.311 13.475 256 20.301 256h10.016c6.353 0 11.646-4.949 11.977-11.293C48.157 132.216 141.097 42 256 42c82.862 0 154.737 47.077 190.289 116H332c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h160c6.627 0 12-5.373 12-12V20c0-6.627-5.373-12-12-12zm-.301 248h-10.015c-6.352 0-11.647 4.949-11.977 11.293C463.841 380.158 370.546 470 256 470c-82.608 0-154.672-46.952-190.299-116H180c6.627 0 12-5.373 12-12v-10c0-6.627-5.373-12-12-12H20c-6.627 0-12 5.373-12 12v160c0 6.627 5.373 12 12 12h10c6.627 0 12-5.373 12-12V381.373C85.071 454.739 164.777 504 256 504c132.773 0 241.176-104.338 247.69-235.493.339-6.818-5.165-12.507-11.991-12.507z"></path>
      </svg>
      Khôi phục bộ lọc
    </div>
    <div class="product">
      <div class="product-list show-filter"></div>
    </div>
  </div>
</div>