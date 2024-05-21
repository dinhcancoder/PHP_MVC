<?php

class Base_Controller extends Controller
{

  public function More($page)
  {
    $this->Load_Model("base");
    $this->Load_Model("product");

    $BaseModel = new Base_Model;
    $ProductModel = new Product_Model;

    $products = $ProductModel->SelectTopView();
    $products = $BaseModel->Paginate($products, $page, 8);

    if (count($products) < 8) {
      echo "<script>$('#MoreProductHighlight label').html('')</script>";
    }

    if (!empty($products)) {
      foreach ($products as $product) {
        extract($product);
        $this->HTMLProductItem($product_image, $product_id, $product_name, $product_price, $product_discount, $inventory);
      }
    }
  }


  // HTML của Item sản phẩm
  public function HTMLProductItem($product_image, $product_id, $product_name, $product_price, $product_discount, $inventory)
  {
    if (true) { ?>
      <div class="product-item <?= $inventory == 0 ? "inventory" : "" ?>">
        <div class="product-image">
          <img src="<?= $product_image ?>" alt="">
        </div>
        <a href="product/detail/<?= $product_id ?>" class="product-name underline"><?= $product_name ?></a>
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
  }

  // Trả về kết quả tìm kiếm
  public function Search($table, $columName)
  {
    $value = $_POST['searchValue'];
    $this->Load_Model("base");
    $object = new Base_Model;
    $listSearch = $object->Search($table, $columName, $value);

    if (!empty($listSearch)) {
      foreach ($listSearch as $row) {
        extract($row);
      ?>
        <li><a href="product/detail/<?= $product_id ?>/<?= $category_id ?>" class="underline"><?= $product_name ?></a></li>
      <?php
      }
    } else {
      echo "<span style='color: #333'>Không tìm thấy từ khóa: $value</span>";
    }
  }

  // Xử lý filter
  public function Filter()
  {
    $category = isset($_POST['category']) ? $_POST['category'] : "";
    $priceMin = isset($_POST['priceMin']) ? $_POST['priceMin'] : "";
    $priceMax = isset($_POST['priceMax']) ? $_POST['priceMax'] : "";
    $sort = isset($_POST['sort']) ? $_POST['sort'] : "";
    $value = isset($_POST['value']) ? $_POST['value'] : "";
    $this->Load_Model("base");
    $object = new Base_Model;
    $filter = $object->ShowSearch($category, $priceMin, $priceMax, $sort, $value);
    if (!empty($filter)) {
      ?>
      <?php
      foreach ($filter as $f) {
        extract($f);
        $this->HTMLProductItem($product_image, $product_id, $product_name, $product_price, $product_discount, $inventory);
      }
      ?>
    <?php
    } else {
    ?>
      <div class="filter-empty">
        <h3>Không có sản phẩm phù hợp với tìm kiếm!</h3>
        <p>Bạn có thể thử từ khóa đơn giản hơn hoặc liên hệ với hỗ trợ.</p>
        <div class="img">
          <img src="https://cdn.divineshop.vn/static/b1d68ae70c17522557b7ac822a0fe731.svg" alt="">
        </div>
      </div>
<?php
    }
  }

  // Trả về danh sách sản phẩm tìm thấy
  public function ShowFilter()
  {
    $this->Load_Model("category");
    $object = new Category_Model;
    $this->Load_Page("user/pages/global/filter", ["categories" => $object->List()]);
  }
}
