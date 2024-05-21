<?php

class Routes
{
  protected $controller = "Home_Controller";
  protected $action = "Index";
  protected $params = [];

  public function __construct()
  {
    $arrUrl = $this->Handler_Url();

    if (file_exists(MVC_PATH . "/controllers/{$arrUrl[0]}_Controller.php")) {
      $this->controller = ucfirst($arrUrl[0]) . "_Controller";
      unset($arrUrl[0]);
    }

    require MVC_PATH . "/controllers/{$this->controller}.php";
    $this->controller = new $this->controller;

    if (!empty($arrUrl[1])) {
      if (method_exists($this->controller, $arrUrl[1])) {
        $this->action = ucfirst($arrUrl[1]);
      }
      unset($arrUrl[1]);
    }

    $this->params = $arrUrl ? array_values($arrUrl) : [];

    call_user_func_array([$this->controller, $this->action], $this->params);
  }

  public function Handler_Url()
  {
    $url = isset($_GET['url']) ? $_GET['url'] : "";
    $url = explode("/", filter_var(rtrim($url, "/"), FILTER_SANITIZE_URL));
    return $url;
  }
}
