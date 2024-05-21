<div>
  <div class="titlebar">Admin / Bình luận / Chi tiết bình luận</div>
  <div class="search">
    <input type="text" placeholder="Tìm kiếm...">
  </div>
  <table class="table">
    <thead>
      <tr>
        <th>STT</th>
        <th>Người bình luận</th>
        <th>Nội dung bình luận</th>
        <th>Ngày bình luận</th>
        <th>Thời gian</th>
        <th>Chức năng</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $stt = 0;
      foreach ($data['list'] as $detail) {
        extract($detail);
      ?>
        <tr>
          <td><?= $stt++ ?></td>
          <td>
            <?php
            foreach ($data['user'] as $key => $user) {
              if ($user['user_id'] == $user_id) {
                echo $user['user'];
              }
            }
            ?>
          </td>
          <td><?= $content ?></td>
          <td><?= $date ?></td>
          <td><?= $time ?></td>
          <td>
            <div>
              <a class="DeleteComment" ProductID="<?= $product_id ?>" Table="<?= str_contains($content, "@") ? "repcomment" : "comment" ?>" CMID="<?= str_contains($content, "@") ? $repcm_id : $comment_id ?>" style="color: #dc3545;">Xóa <ion-icon name="trash-outline"></ion-icon></a>
            </div>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>