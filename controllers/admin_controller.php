<?php
require_once ('controllers/dashboard_controller.php');
class AdminController extends DashBoardController
{
  function __construct()
  {
    $this->folder = 'admin';
  }

  public function login()
  {
    $this->render('login');
  }

  public function register()
  {
    $this->render('register');
  }

  public function dashboard()
  {
    $this->render('dashboard');
  }
}