<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');

class Mysql extends PDO
{
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $charset;
    private $driver;


    public function __construct($host, $dbname, $username, $password, $charset = 'utf8', $driver)
    {
      try {
          parent::__construct('mysql:host=' . $host . ';dbname=' . $dbname, $username, $password);
          $this->dbName = $dbname;
          $this->query('SET CHARACTER SET ' . $charset);
          $this->query('SET NAMES ' . $charset);
          $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      } catch (PDOException $e) {
          $this->showError($e);
      }
    }

}


 ?>
