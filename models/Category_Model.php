<?php

class Category_Model extends Database
{
  public function Add($Category_Name)
  {
    $sql = "INSERT INTO category (category_name) VALUES (?)";
    return $this->execute($sql, $Category_Name);
  }

  public function List()
  {
    $sql = "SELECT * FROM category";
    return $this->queryAll($sql);
  }

  public function Delete($Category_ID)
  {
    $sql = "DELETE FROM category WHERE category_id = ?";
    return $this->execute($sql, $Category_ID);
  }

  public function Edit($CategorID, $CategoryName)
  {
    $sql = "UPDATE category SET category_name = ? WHERE category_id = ?";
    return $this->execute($sql, $CategoryName, $CategorID);
  }

  public function SelectByID($CategorID)
  {
    $sql = "SELECT * FROM category WHERE category_id = ?";
    return $this->queryOne($sql, $CategorID);
  }
}
