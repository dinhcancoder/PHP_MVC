<?php

class Comment_Controller extends Controller
{
  public function AddComment()
  {
    $Content = $_POST['CommentContent'];
    $ProductID = $_POST['ProductID'];
    $UserID = $_POST['UserID'];
    $Date = date("Y-m-d");
    $Time = date("H:i:s");

    $this->Load_Model("comment");
    $CommentModel = new Comment_Model;

    $CommentModel->CommentAdd($UserID, $ProductID, $Content, $Date, $Time);
  }

  public function RepCmt()
  {
    $Content = $_POST['Content'];
    $Date = date("Y-m-d");
    $Time = date("H:i:s");
    $CommentID = $_POST['CommentID'];
    $UserID = $_POST['UserID'];
    $ProductID = $_POST['ProductID'];

    $this->Load_Model("comment");
    $CommentModel = new Comment_Model;

    $CommentModel->AddCommentRep($UserID, $Content, $Date, $Time, $CommentID, $ProductID);
  }

  public function DeleteComment()
  {
    $CommentID = $_POST['CommentID'];
    $Table = $_POST['Table'];

    $this->Load_Model("comment");
    $CommentModel = new Comment_Model;

    $CommentModel->CommentDelete($CommentID, $Table);
  }

  public function EditComment()
  {
    $UserID = $_POST['UserID'];
    $Table = $_POST['Table'];
    $Content = $_POST['Content'];

    $this->Load_Model("comment");
    $CommentModel = new Comment_Model;

    $CommentModel->CommentEdit($UserID, $Table, $Content);
  }

  public function LoadComment()
  {
    $this->Load_Model("account");
    $this->Load_Model("comment");

    $AccountModel = new Account_Model;
    $CommentModel = new Comment_Model;

    $UserID = $_POST['UserID'];
    $ProductID = $_POST['ProductID'];

    $ListComment = $CommentModel->CommentByProduct($ProductID);
    $ListRepCmt = $CommentModel->SelectRepCmt();
    $UserAvatar = isset($AccountModel->SelectByID($UserID)['avatar']) ? $AccountModel->SelectByID($UserID)['avatar'] : "";

    foreach ($ListComment as $comment) {
      extract($comment);
      $Account = $AccountModel->SelectByID($user_id);
?>
      <div class="comment-user">
        <div class="user-main">
          <div class="user-avatar">
            <img src="public/images/uploads/<?= $Account['avatar'] ?>" alt="">
          </div>
          <div class="user-info">
            <h3 style="display: flex; align-items: center; gap: 10px;"><?= $Account['position'] == 1 ? "ADMIN - " . $Account['fullname'] : $Account['fullname'] ?>
              <?php
              if ($Account['position'] == 1) {
              ?>
                <svg style="width: 17.5px; height: 17.5px; fill: #2579f2;" class="od Cb Da ge" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path d="M512 256c0-37.7-23.7-69.9-57.1-82.4 14.7-32.4 8.8-71.9-17.9-98.6-26.7-26.7-66.2-32.6-98.6-17.9C325.9 23.7 293.7 0 256 0s-69.9 23.7-82.4 57.1c-32.4-14.7-72-8.8-98.6 17.9-26.7 26.7-32.6 66.2-17.9 98.6C23.7 186.1 0 218.3 0 256s23.7 69.9 57.1 82.4c-14.7 32.4-8.8 72 17.9 98.6 26.6 26.6 66.1 32.7 98.6 17.9 12.5 33.3 44.7 57.1 82.4 57.1s69.9-23.7 82.4-57.1c32.6 14.8 72 8.7 98.6-17.9 26.7-26.7 32.6-66.2 17.9-98.6 33.4-12.5 57.1-44.7 57.1-82.4zm-144.8-44.25L236.16 341.74c-4.31 4.28-11.28 4.25-15.55-.06l-75.72-76.33c-4.28-4.31-4.25-11.28.06-15.56l26.03-25.82c4.31-4.28 11.28-4.25 15.56.06l42.15 42.49 97.2-96.42c4.31-4.28 11.28-4.25 15.55.06l25.82 26.03c4.28 4.32 4.26 11.29-.06 15.56z"></path>
                </svg>
              <?php
              }
              ?>
            </h3>
            <span>Bình luận vào <?= $date ?> <?= $time ?></span>
            <div class="user-contentCm content-comment">
              <?= $content ?>
            </div>
            <?php
            if ($UserID == $Account['user_id']) {
            ?>
              <div class="control">
                <a class="EditComment" table="comment" style="color: #2579f2;">Sửa bình luận</a>
                <a class="DeleteComment" CommentID="<?= $comment_id ?>" style="color: #dc3545; margin-left: 15px;">Xóa</a>
              </div>
            <?php
            } else {
            ?>
              <div class="control">
                <?php
                if ($UserID != "guest") {
                ?>
                  <a class="RepComment" style="color: #2579f2;">Trả lời</a>
                <?php
                }
                ?>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
        <?php
        foreach ($ListRepCmt as $RepCmt) {
          if ($comment_id == $RepCmt['comment_id']) {
            $UserRepCmt = $AccountModel->SelectByID($RepCmt['user_id']);
        ?>
            <div class="comment-rep">
              <div class="img2">
                <img src="<?= BASE_URL ?>/public/images/uploads/<?= $UserRepCmt['avatar'] ?>" alt="">
              </div>
              <div class="info2">
                <div style="display: flex; align-items: center; gap: 10px">
                  <h3><?= $UserRepCmt['position'] == 1 ? "ADMIN - " . $UserRepCmt['fullname'] : $UserRepCmt['fullname'] ?>
                    <?php
                    if ($UserRepCmt['position'] == 1) {
                    ?>
                      <svg class="od Cb Da ge" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M512 256c0-37.7-23.7-69.9-57.1-82.4 14.7-32.4 8.8-71.9-17.9-98.6-26.7-26.7-66.2-32.6-98.6-17.9C325.9 23.7 293.7 0 256 0s-69.9 23.7-82.4 57.1c-32.4-14.7-72-8.8-98.6 17.9-26.7 26.7-32.6 66.2-17.9 98.6C23.7 186.1 0 218.3 0 256s23.7 69.9 57.1 82.4c-14.7 32.4-8.8 72 17.9 98.6 26.6 26.6 66.1 32.7 98.6 17.9 12.5 33.3 44.7 57.1 82.4 57.1s69.9-23.7 82.4-57.1c32.6 14.8 72 8.7 98.6-17.9 26.7-26.7 32.6-66.2 17.9-98.6 33.4-12.5 57.1-44.7 57.1-82.4zm-144.8-44.25L236.16 341.74c-4.31 4.28-11.28 4.25-15.55-.06l-75.72-76.33c-4.28-4.31-4.25-11.28.06-15.56l26.03-25.82c4.31-4.28 11.28-4.25 15.56.06l42.15 42.49 97.2-96.42c4.31-4.28 11.28-4.25 15.55.06l25.82 26.03c4.28 4.32 4.26 11.29-.06 15.56z"></path>
                      </svg>
                    <?php
                    }
                    ?>
                  </h3>
                  <span style="color: #6b7280;"><?= $RepCmt['date'] ?> <?= $RepCmt['time'] ?></span>
                </div>
                <div class="comment-tag content-comment"><?= $RepCmt['content'] ?></div>
                <?php
                if ($UserID == $RepCmt['user_id']) {
                ?>
                  <div class="control">
                    <a class="EditComment" table="repcomment" style="color: #2579f2;">Sửa bình luận</a>
                    <a class="DeleteRepCmt" CommentID="<?= $RepCmt['repcm_id'] ?>" style="color: #dc3545; margin-left: 15px;">Xóa</a>
                  </div>
                <?php
                } else {
                ?>
                  <div class="control">
                    <?php
                    if ($UserID != "guest") {
                    ?>
                      <a class="RepComment" style="color: #2579f2;">Trả lời</a>
                    <?php
                    }
                    ?>
                  </div>
                <?php
                }
                ?>
              </div>
            </div>
        <?php
          }
        }
        ?>
        <div class="comment-send">
          <div class=" img2">
            <img src="<?= BASE_URL ?>/public/images/uploads/<?= $UserAvatar ?>" alt="">
          </div>
          <div class="send-tag">
            <input type="text" value="">
            <div class="svg" UserID="<?= $UserID ?>" CommentID="<?= $comment_id ?>">
              <svg class="od Db wa" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M446.7 98.6l-67.6 318.8c-5.1 22.5-18.4 28.1-37.3 17.5l-103-75.9-49.7 47.8c-5.5 5.5-10.1 10.1-20.7 10.1l7.4-104.9 190.9-172.5c8.3-7.4-1.8-11.5-12.9-4.1L117.8 284 16.2 252.2c-22.1-6.9-22.5-22.1 4.6-32.7L418.2 66.4c18.4-6.9 34.5 4.1 28.5 32.2z"></path>
              </svg>
            </div>
          </div>
          <span class="CloseRepCmt" style="font-size: 23px; color: #dc3545; cursor: pointer;"><ion-icon name="close-outline"></ion-icon></span>
        </div>
        <div class="comment-edit">
          <div class=" img2">
            <img src="<?= BASE_URL ?>/public/images/uploads/<?= $UserAvatar ?>" alt="">
          </div>
          <div class="send-tag">
            <input type="text">
            <div class="svg icon" UserID="<?= $UserID ?>" CommentID="<?= $comment_id ?>">
              <svg class="od Db wa" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M446.7 98.6l-67.6 318.8c-5.1 22.5-18.4 28.1-37.3 17.5l-103-75.9-49.7 47.8c-5.5 5.5-10.1 10.1-20.7 10.1l7.4-104.9 190.9-172.5c8.3-7.4-1.8-11.5-12.9-4.1L117.8 284 16.2 252.2c-22.1-6.9-22.5-22.1 4.6-32.7L418.2 66.4c18.4-6.9 34.5 4.1 28.5 32.2z"></path>
              </svg>
            </div>
          </div>
          <span class="CloseRepCmt" style="font-size: 23px; color: #dc3545; cursor: pointer;"><ion-icon name="close-outline"></ion-icon></span>
        </div>
      </div>
<?php
    }
  }
}
