<?php

class Home_Controller extends Controller
{
  public function Index()
  {
    // Model
    $this->Load_Model("base");
    $BaseModel = new Base_Model;
    // Controller
    $this->Load_View("user/layout", ["page" => "home/index", "categories" => $BaseModel->selectAll("category")]);
  }
}
