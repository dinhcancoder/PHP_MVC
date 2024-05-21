<?php extract($data['category']) ?>
<div class="category-edit">
  <div class="titlebar">Admin / Danh mục / Sửa danh mục</div>
  <div class="form-group">
    <label for="" class="form-name">Tên danh mục</label>
    <div class="form-error"></div>
    <input type="text" id="categoryName" class="form-input" value="<?= $category_name ?>">
  </div>
  <div class="control">
    <a class="btn--add HandlerEdit" CategoryID="<?= $category_id ?>">Sửa danh mục</a>
  </div>
</div>