<?php

class Product_Model extends Database
{
  public function Add($CategoryID, $ProductName, $Image, $ImageDefault, $Inventory, $Price, $Discount, $Date, $Special, $Description)
  {
    if (isset($_FILES[$Image])) {
      $Image = $this->uploadFile($Image, PUBLIC_PATH . "/images/uploads/");
    } else {
      $Image = $ImageDefault;
    }

    $sql = "INSERT INTO product (product_name, product_image, product_price, product_discount, special, date, description, inventory, category_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    return $this->execute($sql, $ProductName, $Image, $Price, $Discount, $Special, $Date, $Description, $Inventory, $CategoryID);
  }

  public function List()
  {
    $sql = "SELECT * FROM product ORDER BY product_id DESC";
    return $this->queryAll($sql);
  }

  public function Delete($ProductID)
  {
    $sql = "DELETE FROM product WHERE product_id = ?";
    return $this->execute($sql, $ProductID);
  }

  public function Update($ProductID, $CategoryID, $ProductName, $Image, $ImageDefault, $Inventory, $Price, $Discount, $Date, $Special, $Description)
  {
    if (isset($_FILES[$Image])) {
      $Image = $this->uploadFile($Image, PUBLIC_PATH . "/images/uploads/");
    } else {
      $Image = $ImageDefault;
    }

    $sql = "UPDATE product SET product_name = ?, product_image = ?, product_price = ?, product_discount = ?, special = ?, date = ?, description = ?, inventory = ?, category_id = ? WHERE product_id = ?";
    return $this->execute($sql, $ProductName, $Image, $Price, $Discount, $Special, $Date, $Description, $Inventory, $CategoryID, $ProductID);
  }

  public function SelectByID($ProductID)
  {
    $sql = "SELECT * FROM product WHERE product_id = ?";
    return $this->queryOne($sql, $ProductID);
  }

  public function SelectByCategory($CategorID, $ProductID)
  {
    $sql = "SELECT * FROM product WHERE category_id = ? AND product_id != ?";
    return $this->queryAll($sql, $CategorID, $ProductID);
  }

  public function UpdateView($ProductID)
  {
    $sql = "UPDATE product SET view = view + 1 WHERE product_id = ?";
    return $this->execute($sql, $ProductID);
  }

  public function SelectTop($number)
  {
    $sql = "SELECT * FROM product WHERE view > 0 ORDER BY view DESC LIMIT 0, $number";
    return $this->queryAll($sql, $number);
  }

  public function Special()
  {
    $sql = "SELECT * FROM product WHERE special = 1";
    return $this->queryAll($sql);
  }

  public function SelectTopView()
  {
    $sql = "SELECT * FROM product ORDER BY view DESC";
    return $this->queryAll($sql);
  }

  public function ProductSelectCategory($CategoryID)
  {
    $sql = "SELECT * FROM category WHERE category_id = ?";
    return $this->queryOne($sql, $CategoryID);
  }

  public function MinusInvetory($ProductID, $Quantity)
  {
    $sql = "UPDATE product SET inventory = inventory - ? WHERE product_id = ?";
    return $this->execute($sql, $Quantity, $ProductID);
  }

  public function ProductSelectAllCategory($CategorID)
  {
    $sql = "SELECT * FROM product WHERE category_id = ?";
    return $this->queryAll($sql, $CategorID);
  }
}
