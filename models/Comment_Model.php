<?php

class Comment_Model extends Database
{
  public function CommentAdd($UserID, $ProductID, $Content, $Date, $Time)
  {
    $sql = "INSERT INTO comment (user_id, product_id, content, date, time) VALUES (?, ?, ?, ?, ?)";
    return $this->execute($sql, $UserID, $ProductID, $Content, $Date, $Time);
  }

  public function CommentByUser($UserID)
  {

    $sql = "SELECT comment_id, content, date, time, product_id
            FROM comment
            WHERE user_id = ?

            UNION

            SELECT comment_id, content, date, time, product_id
            FROM repcomment
            WHERE user_id = ?";

    return $this->queryAll($sql, $UserID, $UserID);
  }

  public function CommentByProduct($ProductID)
  {
    $sql = "SELECT * FROM comment WHERE product_id = ? ORDER BY comment_id DESC";
    return $this->queryAll($sql, $ProductID);
  }

  public function CommentByProductJOIN($ProductID)
  {
    // chúng ta đã thêm một cột với giá trị NULL trong phần SELECT của bảng comment để đảm bảo rằng số cột của cả hai phần SELECT trong UNION là như nhau.
    $sql = "SELECT comment_id, content, date, time, product_id, user_id, NULL as repcm_id
            FROM comment
            WHERE product_id = ?

            UNION

            SELECT comment_id, content, date, time, product_id, user_id, repcm_id
            FROM repcomment
            WHERE product_id = ?";
    /* SELECT comment.comment_id, comment.content, comment.date, comment.time, comment.product_id, comment.user_id, repcomment.repcm_id
    FROM comment
    LEFT JOIN repcomment ON comment.product_id = repcomment.product_id
    WHERE comment.product_id = ?; */

    return $this->queryAll($sql, $ProductID, $ProductID);
  }

  public function AddCommentRep($UserID, $Content, $Date, $Time, $CommentID, $ProductID)
  {
    $sql = "INSERT INTO repcomment (user_id, content, date, time, comment_id, product_id) VALUES (?, ?, ?, ?, ?, ?)";
    return $this->execute($sql, $UserID, $Content, $Date, $Time, $CommentID, $ProductID);
  }

  public function SelectRepCmt()
  {
    $sql = "SELECT * FROM comment tb1 INNER JOIN repcomment tb2 ON tb1.comment_id = tb2.comment_id";
    return $this->queryAll($sql);
  }

  public function CommentDelete($CommentID, $Table)
  {
    $id = "";
    if ($Table == "comment") {
      $id = "comment_id";
    } else {
      $id = "repcm_id";
    }

    $sql = "DELETE FROM $Table WHERE $id = ?";
    return $this->execute($sql, $CommentID);
  }

  public function CommentEdit($UserID, $Tabel, $Content)
  {
    $sql = "UPDATE $Tabel SET content = ? WHERE user_id = ?";
    return $this->execute($sql, $Content, $UserID);
  }

  public function Comment()
  {
    $sql = "SELECT tb2.product_id, tb2.product_name,
        COUNT(DISTINCT tb1.comment_id) + COUNT(DISTINCT tb3.repcm_id) AS quantity,
        MAX(tb1.date) as dateNew,
        MIN(tb1.date) as dateOld,
        MIN(tb1.time) as time
        FROM comment tb1
        JOIN product tb2 ON tb1.product_id = tb2.product_id
        LEFT JOIN repcomment tb3 ON tb1.comment_id = tb3.comment_id
        GROUP BY tb2.product_id, tb2.product_name
        HAVING quantity > 0";

    return $this->queryAll($sql);
  }
}
