<?php
class DB
{
  private static $instance = NULL;
  private function __construct()
  {
  }
  public static function getInstance()
  {
    if (!isset(self::$instance)) {
      try {
        self::$instance = new PDO('mysql:host=localhost;dbname=cgv_cinema', 'root', '');
        self::$instance->exec("SET NAMES 'utf8'");
        self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $ex) {
        die($ex->getMessage());
      }
    }
    return self::$instance;
  }
}