<?php

class Controller
{
  public function Load_Model($model_name)
  {
    $model_name = ucfirst($model_name) . "_Model";
    require MVC_PATH . "/models/{$model_name}.php";
  }

  public function Load_View($view_name, $data = [])
  {
    $view_name = ucfirst($view_name) . "_View";
    require MVC_PATH . "/views/{$view_name}.php";
  }

  public function Load_Page($view_name, $data = [])
  {
    require MVC_PATH . "/views/{$view_name}.php";
  }
}
