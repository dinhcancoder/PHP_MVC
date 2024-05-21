<?php

class Account_Model extends Database
{
  public function Register($fullname, $user, $password, $email)
  {
    $password = md5($password);
    $sql = "INSERT INTO user (fullname, user, password, email, avatar) VALUES (?, ?, ?, ?, ?)";
    return $this->execute($sql, $fullname, $user, $password, $email, "avatar.png");
  }

  public function AddUser($fullname, $user, $password, $email, $phone, $address, $avatar, $position, $money)
  {
    if (isset($_FILES[$avatar])) {
      $this->uploadFile($avatar, PUBLIC_PATH . "/images/uploads/");
    } else {
      $avatar = "avatar.png";
    }
    $password = md5($password);
    $sql = "INSERT INTO user (fullname, user, password, email, phone, address, avatar, position, money) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    return $this->execute($sql, $fullname, $user, $password, $email, $phone, $address, $avatar, $position, $money);
  }

  public function Update($fullname, $phone, $address, $avatar, $avatarOld, $user_id)
  {
    if (isset($_FILES[$avatar])) {
      $avatar = $this->uploadFile($avatar, PUBLIC_PATH . "/images/uploads/");
    } else {
      $avatar = $avatarOld;
    }
    $sql = "UPDATE user SET fullname = ?, phone = ?, address = ?, avatar = ? WHERE user_id = ?";
    return $this->execute($sql, $fullname, $phone, $address, $avatar, $user_id);
  }

  public function AccountEdit($fullname, $user, $password, $email, $phone, $address, $avatar, $avatarOld, $position, $money, $UserID)
  {
    if (isset($_FILES[$avatar])) {
      $avatar = $this->uploadFile($avatar, PUBLIC_PATH . "/images/uploads/");
    } else {
      $avatar = $avatarOld;
    }

    $sql = "UPDATE user SET fullname = ?, user = ?, password = ?, email = ?, phone = ?, address = ?, avatar = ?, position = ?, money = ? WHERE user_id = ?";

    return $this->execute($sql, $fullname, $user, $password, $email, $phone, $address, $avatar, $position, $money, $UserID);
  }

  public function FavoriteAdd($ProductID, $UserID)
  {
    $sql = "INSERT INTO favorite (product_id, user_id) VALUES (?, ?)";
    return $this->execute($sql, $ProductID, $UserID);
  }

  public function FavoriteDelete($ProductID, $UserID)
  {
    $sql = "DELETE FROM favorite WHERE product_id = ? AND user_id = ?";
    return $this->execute($sql, $ProductID, $UserID);
  }

  public function FavoriteSelectByUserID($UserID)
  {
    $sql = "SELECT * FROM favorite tb1 JOIN product tb2 ON tb1.product_id = tb2.product_id WHERE tb1.user_id = ?";
    return $this->queryAll($sql, $UserID);
  }

  public function FavoriteRemove($FavoriteID)
  {
    $sql = "DELETE FROM favorite WHERE favorite_id = ?";
    return $this->execute($sql, $FavoriteID);
  }

  public function Login($user, $password)
  {
    $sql = "SELECT * FROM user WHERE (email = '$user' OR user = '$user')";
    $userData =  $this->queryOne($sql);
    if ($userData && (md5($password) === $userData['password'])) {
      return $userData;
    }
  }

  public function SelectByID($UserID)
  {
    $sql = "SELECT * FROM user WHERE user_id = ?";
    return $this->queryOne($sql, $UserID);
  }

  public function SelectByEmailOrFullname($user)
  {
    $sql = "SELECT * FROM user WHERE (email = '$user' OR user = '$user')";
    return $this->queryOne($sql);
  }

  public function ChangePassword($Password, $UserID)
  {
    $sql = "UPDATE user SET password = ? WHERE user_id = ?";
    return $this->execute($sql, $Password, $UserID);
  }

  public function Forget($user, $password)
  {
    $password = md5($password);
    $sql = "UPDATE user SET password = ? WHERE (email = '$user' OR user = '$user')";
    return $this->execute($sql, $password);
  }

  // Tất cả tài khoản
  public function SelectAll()
  {
    $sql = "SELECT * FROM user ORDER BY user_id DESC";
    return $this->queryAll($sql);
  }

  public function DeleteAccountByID($UserID)
  {
    $sql = "DELETE FROM user WHERE user_id = ?";
    return $this->execute($sql, $UserID);
  }

  public function MinusMoney($Anmount, $UserID)
  {
    $sql = "UPDATE user SET money = (money - ?) WHERE user_id = ?";
    return $this->execute($sql, $Anmount, $UserID);
  }

  public function HistoryNew($OrderID, $UserID, $Money)
  {
    $sql = "INSERT INTO history (order_id, user_id, money) VALUES (?, ?, ?)";
    return $this->execute($sql, $OrderID, $UserID, $Money);
  }

  public function HistorySelectByUserID($UserID)
  {
    $sql = "SELECT o.code, o.date, o.time, o.anmount, h.money FROM history h JOIN orders o ON h.order_id = o.order_id JOIN user u ON h.user_id = u.user_id WHERE u.user_id = ? ORDER BY history_id DESC";
    return $this->queryAll($sql, $UserID);
  }
}
