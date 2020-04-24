<?php

class Router {
  public $routes = [
    'GET'  => [],
    'POST' => []
  ];

  public function get($uri, $controller){
    $this->routes['GET'][$uri] = $controller;
  }

  public function post($uri, $controller){
    $this->routes['POST'][$uri] = $controller;
  }

  public static function load($file){
    $router = new self;
    require $file;
    return $router;
  }

  public function direct($uri, $request_type){
    if(array_key_exists($uri, $this->routes[$request_type])){
      return $this->routes[$request_type][$uri];
    }
    throw new Exception('Could not find routes');
  }
}