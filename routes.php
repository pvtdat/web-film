<?php
$controllers = array(
  'admin' => ['login', 'register', 'dashboard'],
  'pages' => ['home', 'error_400', 'error_403', 'error_404', 'error_500', 'error_502', 'error_204'],
  'movie' => ['theatermovies', 'singlemovies', 'newseries', 'newmovies', 'cartoon', 'kinhdi', 'searching', 'watchingmovie', 'watchingtrailer']
);

if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
  $controller = 'pages';
  $action = 'error_404';
}

include_once('controllers/' . $controller . '_controller.php');
$klass = str_replace('_', '', ucwords($controller, '_')) . 'Controller';
$controller = new $klass;
$controller->$action();