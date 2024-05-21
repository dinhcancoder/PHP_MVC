<div class="account-title">Bình luận của tôi</div>
<div class="account-describe">Bình luận và trả lời mà bạn đã viết trên Divine Shop
</div>
<div class="account-hr"></div>
<?php
if (!empty($data['list'])) {
?>
  <div class="account-filter account-filter-3">
    <div>
      <input type="text" placeholder="">
      <label for="">Nội dung</label>
    </div>
    <div>
      <input type="date" placeholder="">
      <label for="">Từ ngày</label>
    </div>
    <div>
      <input type="date" placeholder="">
      <label for="">Đến ngày</label>
    </div>
  </div>
  <div class="account-table">
    <table>
      <thead>
        <tr>
          <th style="width: 300px;">Thời gian</th>
          <th style="width: 435px;">Nội dung bình luận</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($data['list'] as $comment) {
          extract($comment);
          // preg_replace() biểu thức chính quy
          $content = preg_replace('/@(\S+)/', '', $content);
        ?>
          <tr>
            <td><?= $date . "  " . $time ?></td>
            <td><?= $content ?></td>
            <td class="underline" style="cursor: pointer; color: #2579f2;"><a href="product/detail/<?= $product_id ?>">Chi tiết</a></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
<?php
} else {
?>
  <img style="width: 232.7px; height: 252px;" src="https://cdn.divineshop.vn/static/4e0db8ffb1e9cac7c7bc91d497753a2c.svg" alt="">
<?php
}
?>