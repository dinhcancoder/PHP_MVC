<?php

class Database
{
  protected $dbname = "duan";
  protected $host = "localhost";
  protected $username = "root";
  protected $password = "";

  public function connect()
  {
    try {
      $conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
      // cho phép ném ngoại lệ (exception) khi có lỗi xảy ra trong quá trình thao tác với cơ sở dữ liệu.
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      // Nếu có ngoại lệ (exception) xảy ra trong quá trình kết nối, câu lệnh catch (PDOException $e
      echo $e->getMessage();
    }
    return $conn;
  }

  public function execute($sql)
  {
    $sql_args = array_slice(func_get_args(), 1);

    try {
      $conn = $this->connect();
      $stmt = $conn->prepare($sql);
      $stmt->execute($sql_args);
    } catch (PDOException $e) {
      throw $e;
    } finally {
      unset($conn);
    }
  }

  public function queryAll($sql)
  {
    $sql_args = array_slice(func_get_args(), 1);

    try {
      $conn = $this->connect();
      $stmt = $conn->prepare($sql);
      $stmt->execute($sql_args);
      $rows = $stmt->fetchAll();
      return $rows;
    } catch (PDOException $e) {
      throw $e;
    } finally {
      unset($conn);
    }
  }

  public function queryOne($sql)
  {
    $sql_args = array_slice(func_get_args(), 1);

    try {
      $conn = $this->connect();
      $stmt = $conn->prepare($sql);
      $stmt->execute($sql_args);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return $row;
    } catch (PDOException $e) {
      throw $e;
    } finally {
      unset($conn);
    }
  }

  public function queryValue($sql)
  {
    $sql_args = array_slice(func_get_args(), 1);
    try {
      $conn = $this->connect();
      $stmt = $conn->prepare($sql);
      $stmt->execute($sql_args);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return array_values($row)[0];
    } catch (PDOException $e) {
      throw $e;
    } finally {
      unset($conn);
    }
  }

  function uploadFile($fileName, $target_dir)
  {
    $file_name = $_FILES[$fileName]['name'];
    $target_path = $target_dir . $file_name;
    move_uploaded_file($_FILES[$fileName]['tmp_name'], $target_path);
    return $file_name;
  }
}
