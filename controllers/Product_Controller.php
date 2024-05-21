<?php

class Product_Controller extends Controller
{
  // public function Detail($ProductID, $CategoryID)
  // {
  //   $page = isset($_POST['page']) ? $_POST['page'] : 1;
  //   $this->Load_Model("base");
  //   $this->Load_Model("product");
  //   $ProductModel = new Product_Model;
  //   $BaseModel = new Base_Model;
  //   $ProductModel->UpdateView($ProductID);
  //   $products = $ProductModel->SelectByCategory($CategoryID, $ProductID);
  //   $this->Load_View("user/layout", ["page" => "product/detail", "product" => $ProductModel->SelectByID($ProductID), "products" => $BaseModel->Paginate($products, $page, 4), "category" => $ProductModel->ProductSelectCategory($CategoryID)]);
  // }
  public function Detail($ProductID)
  {
    $page = isset($_POST['page']) ? $_POST['page'] : 1;
    $this->Load_Model("base");
    $this->Load_Model("product");
    // $this->Load_Model("account");

    $ProductModel = new Product_Model;
    $BaseModel = new Base_Model;

    $ProductModel->UpdateView($ProductID);
    $listProduct = $ProductModel->SelectByID($ProductID);
    $CategoryID = $listProduct['category_id'];

    $products = $ProductModel->SelectByCategory($CategoryID, $ProductID);

    $this->Load_View("user/layout", ["page" => "product/detail", "product" => $listProduct, "products" => $BaseModel->Paginate($products, $page, 4), "category" => $ProductModel->ProductSelectCategory($CategoryID)]);
  }
}
