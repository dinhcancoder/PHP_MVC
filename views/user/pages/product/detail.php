<?php
extract($data['product']);
?>
<input type="text" hidden class="ProductID" ProductID="<?= $product_id ?>">
<div class="product-detail">
  <div class="container">
    <div class="detail">
      <div class="detail-image">
        <img src="<?= $product_image ?>" alt="">
        <p style="text-align: center; font-weight: 500; color: #4a6cf7; margin-top: 15px; cursor: pointer;">Xem thêm ảnh</p>
      </div>
      <div class="detail-product">
        <div class="detail-name"><?= $product_name ?></div>
        <div class="detail-info">
          <div class="detail-status">
            <div>
              <img src="<?= PUBLIC_PATH ?>/images/icons/boxes.svg" style="width: 17.5px; height: 17.5px;" alt=""> Tình trạng:
            </div>
            <?php
            if ($inventory != 0) {
            ?>
              <span style="color: #29b474;">Còn hàng</span>
            <?php
            } else {
            ?>
              <span style="color: #dc3545;">Hết hàng</span>
            <?php
            }
            ?>
          </div>
          <div class="detail-category">
            <div><img src="<?= PUBLIC_PATH ?>/images/icons/tag.svg" style="width: 17.5px; height: 17.5px;" alt=""> Danh mục:</div>
            <div>
              <a class="underline"><?= $data['category']['category_name'] ?></a>
            </div>
          </div>
        </div>
        <div class="detail-price">
          <div class="detail-priceNew">
            <span><?= number_format(($product_price - ($product_price * $product_discount / 100)), 0, ",", ".") ?>đ</span>
            <img src="<?= PUBLIC_PATH ?>/images/icons/bell.svg" style="width: 20px; height: 20px; opacity: .35; cursor: pointer;" alt="">
            <div class="favorite" ProductID="<?= $product_id ?>">
              <svg style="width: 20px; height: 20px; opacity: .35;cursor: pointer;" class="od Hb Ba ie" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path>
              </svg>
            </div>
          </div>
          <?php
          if ($product_discount != 0) {
          ?>
            <div class="detail-priceOld">
              <span><?= number_format($product_price, 0, ",", ".") ?>đ</span>
              <div class="product-priceDiscount">-<?= $product_discount ?> %</div>
            </div>
          <?php
          }
          ?>
        </div>
        <div class="detail-pay">
          <?php
          if ($inventory != 0) {
          ?>
            <button class="BuyNow" ProductID="<?= $product_id ?>" UserID="<?= $userID ?>"><img src="<?= BASE_URL ?>/public/images/icons/pay.svg" style="height: 17.5px;" alt=""> Mua ngay</button>
            <button class="AddToCart" ProductID="<?= $product_id ?>" UserID="<?= $userID ?>"><svg class="od Cb Da" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                <path d="M551.991 64H144.28l-8.726-44.608C133.35 8.128 123.478 0 112 0H12C5.373 0 0 5.373 0 12v24c0 6.627 5.373 12 12 12h80.24l69.594 355.701C150.796 415.201 144 430.802 144 448c0 35.346 28.654 64 64 64s64-28.654 64-64a63.681 63.681 0 0 0-8.583-32h145.167a63.681 63.681 0 0 0-8.583 32c0 35.346 28.654 64 64 64 35.346 0 64-28.654 64-64 0-18.136-7.556-34.496-19.676-46.142l1.035-4.757c3.254-14.96-8.142-29.101-23.452-29.101H203.76l-9.39-48h312.405c11.29 0 21.054-7.869 23.452-18.902l45.216-208C578.695 78.139 567.299 64 551.991 64zM208 472c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm256 0c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm23.438-200H184.98l-31.31-160h368.548l-34.78 160z"></path>
              </svg> Thêm vào giỏ hàng
            </button>
          <?php
          } else {
          ?>
            <button style="border: none; color: white; outline: none;"><img src="<?= BASE_URL ?>/public/images/icons/bell1.svg" style="height: 17.5px;" alt=""> Thông báo khi có hàng</button>
          <?php
          }
          ?>
        </div>
      </div>
      <div class="detail-other">
        <h3>Giới thiệu bạn bè</h3>
        <p>Bạn bè được giảm 5% giá sản phẩm và bạn nhận hoa hồng vĩnh viễn.</p>
        <div>
          <input type="text" value="https://kanisdevfpt.edu.vn/tai-khoan-prime-gaming">
          <button>
            <svg class="od Cb Da" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
              <path d="M433.941 65.941l-51.882-51.882A48 48 0 0 0 348.118 0H176c-26.51 0-48 21.49-48 48v48H48c-26.51 0-48 21.49-48 48v320c0 26.51 21.49 48 48 48h224c26.51 0 48-21.49 48-48v-48h80c26.51 0 48-21.49 48-48V99.882a48 48 0 0 0-14.059-33.941zM266 464H54a6 6 0 0 1-6-6V150a6 6 0 0 1 6-6h74v224c0 26.51 21.49 48 48 48h96v42a6 6 0 0 1-6 6zm128-96H182a6 6 0 0 1-6-6V54a6 6 0 0 1 6-6h106v88c0 13.255 10.745 24 24 24h88v202a6 6 0 0 1-6 6zm6-256h-64V48h9.632c1.591 0 3.117.632 4.243 1.757l48.368 48.368a6 6 0 0 1 1.757 4.243V112z"></path>
            </svg>
          </button>
          <button>
            <svg class="od Cb Da" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
              <path d="M414.9 31.11L270.9 495.1C266.1 507.8 253.5 514.8 240.9 510.9C228.2 506.1 221.1 493.5 225.1 480.9L369.1 16.89C373 4.226 386.5-2.852 399.1 1.077C411.8 5.006 418.9 18.45 414.9 31.11V31.11zM504.4 118.5L632.4 238.5C637.3 243 640 249.4 640 255.1C640 262.6 637.3 268.1 632.4 273.5L504.4 393.5C494.7 402.6 479.6 402.1 470.5 392.4C461.4 382.7 461.9 367.6 471.6 358.5L580.9 255.1L471.6 153.5C461.9 144.4 461.4 129.3 470.5 119.6C479.6 109.9 494.7 109.4 504.4 118.5V118.5zM168.4 153.5L59.09 255.1L168.4 358.5C178.1 367.6 178.6 382.7 169.5 392.4C160.4 402.1 145.3 402.6 135.6 393.5L7.585 273.5C2.746 268.1 0 262.6 0 255.1C0 249.4 2.746 243 7.585 238.5L135.6 118.5C145.3 109.4 160.4 109.9 169.5 119.6C178.6 129.3 178.1 144.4 168.4 153.5V153.5z"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="detail-description">
    <div class="container">
      <div class="detail-ly">
        <div class="detail-note">
          <p><span style="color:#e74c3c"><em><strong>**Lưu Ý:</strong></em></span></p>
          <ul>
            <li><strong>Đơn hàng của quý khách sẽ được xử lý trong vòng tối đa 3h.</strong></li>
            <li><strong>AccountShop sẽ tiến hành đăng nhập vào tài khoản của bạn và nâng cấp.</strong></li>
            <li><strong>Hạn sử dụng của sản phẩm không cộng dồn khi mua số lượng nhiều sản phẩm.</strong></li>
          </ul>
        </div>
        <div class="detail-desc" style="padding: 25px">
          <?= $description  ?>
        </div>
      </div>
    </div>
  </div>
  <div class="comment">
    <div class="container">
      <div class="comment-title">Bình luận</div>
      <div class="comment-desc">Thời gian phản hồi trung bình: 5 phút!</div>
      <textarea class="comment-content" placeholder="Nhập nội dung bình luận"></textarea>
      <div class="comment-error"></div>
      <div class="comment-btn">
        <?php
        if (is_numeric($userID)) {
        ?>
          <button id="comment-send" ProductID="<?= $data['product']['product_id'] ?>">
            <svg class="od Cb Da" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
              <path d="M446.7 98.6l-67.6 318.8c-5.1 22.5-18.4 28.1-37.3 17.5l-103-75.9-49.7 47.8c-5.5 5.5-10.1 10.1-20.7 10.1l7.4-104.9 190.9-172.5c8.3-7.4-1.8-11.5-12.9-4.1L117.8 284 16.2 252.2c-22.1-6.9-22.5-22.1 4.6-32.7L418.2 66.4c18.4-6.9 34.5 4.1 28.5 32.2z"></path>
            </svg> Gửi bình luận
          </button>
        <?php
        } else {
        ?>
          <button id="comment-login">
            <svg class="od Cb Da" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
              <path d="M446.7 98.6l-67.6 318.8c-5.1 22.5-18.4 28.1-37.3 17.5l-103-75.9-49.7 47.8c-5.5 5.5-10.1 10.1-20.7 10.1l7.4-104.9 190.9-172.5c8.3-7.4-1.8-11.5-12.9-4.1L117.8 284 16.2 252.2c-22.1-6.9-22.5-22.1 4.6-32.7L418.2 66.4c18.4-6.9 34.5 4.1 28.5 32.2z"></path>
            </svg> Đăng nhập để bình luận
          </button>
        <?php
        }
        ?>
      </div>
      <div class="comment-list">
      </div>
    </div>
  </div>
  <div class="detail-related" style="padding-bottom: 40px;">
    <div class="container">
      <h3>Các sản phẩm liên quan</h3>
      <div id="related" class="product-list">
        <?php
        foreach ($data['products'] as $product) {
          extract($product); ?>
          <div class="product-item">
            <div class="product-image">
              <img src="<?= $product_image ?>" alt="">
            </div>
            <a href="<?= BASE_URL ?>/product/detail/<?= $product_id ?>/<?= $category_id ?>" class="product-name underline"><?= $product_name ?></a>
            <div class=" product-price">
              <div class="product-priceNew"><?= number_format(($product_price - ($product_price * $product_discount / 100)), 0, ",", ".") ?>đ</div>
              <?php
              if ($product_discount != 0) {
              ?>
                <div class="product-priceOld"><?= number_format($product_price, 0, ",", ".") ?>đ</div>
                <div class="product-priceDiscount">-<?= $product_discount ?>%</div>
              <?php
              }
              ?>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</div>