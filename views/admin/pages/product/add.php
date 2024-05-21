<div class="productAdd">
  <div class="titlebar">Admin / Sản phẩm / Thêm sản phẩm</div>
  <div class="grid grid-col-3">
    <div class="form-group">
      <label for="" class="form-name">Danh mục</label>
      <select id="CategoryName" class="form-input">
        <?php
        foreach ($data['categories'] as $row) {
          extract($row);
        ?>
          <option value="<?= $category_id ?>"><?= $category_name ?></option>
        <?php
        }
        ?>
      </select>
    </div>
    <div class="form-group">
      <label for="" class="form-name">Tên sản phẩm</label>
      <input type="text" id="ProductName" class="form-input">
      <div class="form-error"></div>
    </div>
    <div class="form-group">
      <label for="" class="form-name">Hình ảnh</label>
      <input type="file" id="ProductImage" class="form-input">
      <div class="form-error"></div>
    </div>
    <div class="form-group">
      <label for="" class="form-name">Tồn kho</label>
      <input type="text" id="Inventory" class="form-input">
      <div class="form-error"></div>
    </div>
    <div class="form-group">
      <label for="" class="form-name">Đơn giá</label>
      <input type="text" id="ProductPrice" class="form-input">
      <div class="form-error"></div>
    </div>
    <div class="form-group">
      <label for="" class="form-name">Giảm giá</label>
      <input type="text" id="ProductDiscount" class="form-input" placeholder="%">
      <div class="form-error"></div>
    </div>
    <div class="form-group">
      <label for="" class="form-name">Đặc biệt</label>
      <div class="form-input">
        <input type="radio" id="normal" name="ProductSpecial" checked value="0"> <label for="normal" style="margin-right: 15px; cursor: pointer;">Bình thường</label>
        <input id="special" type="radio" name="ProductSpecial" value="1"> <label for="special" style="cursor: pointer;">Đặc biệt</label>
      </div>
      <div class="form-error"></div>
    </div>
    <div class="form-group">
      <label for="" class="form-name">Ngày nhập</label>
      <input type="date" id="ProductDate" class="form-input">
      <div class="form-error"></div>
    </div>
    <div class="form-group">
      <label for="" class="form-name">Lượt xem</label>
      <input type="text" class="form-input disabled" disabled value="0">
      <div class="form-error"></div>
    </div>
    <textarea name="editor1"></textarea>
    <div class="control">
      <a class="btn--add" id="HandlerProductAdd">Thêm sản phẩm</a>
    </div>
  </div>
</div>
<script>
  CKEDITOR.replace("editor1");
</script>