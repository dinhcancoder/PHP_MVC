<div class="sidebar">
  <ul class="sidebar-list">
    <li>
      <?php
      foreach ($data['categories'] as $category) {
        extract($category); ?>
        <a class="categoryFillter" CategoryID="<?= $category_id ?>" style="cursor: pointer;">
          <div class="sidebar-icon">
            <img src="<?= $icon ?>" alt="">
          </div>
          <?= $category_name ?>
        </a>
      <?php
      }
      ?>
    </li>
  </ul>
</div>