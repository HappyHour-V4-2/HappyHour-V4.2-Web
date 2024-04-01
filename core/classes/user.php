<?php

  class User {
    protected $pdo;
    protected $state_csv = false;
    public function __construct($pdo)
    {
      $this->pdo = $pdo;
    }

    public function checkInput($var)
    {
      $var = htmlspecialchars($var);
      $var = trim($var);
      $var = stripcslashes($var);
      return $var;
    }    

    public function getRealUserIp()
    {
       if ( !empty( $_SERVER['HTTP_CLIENT_IP'] ) )
      {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
      }
      elseif( !empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) )
      //to check ip passed from proxy
      {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
      }
      else
      {
        $ip = $_SERVER['REMOTE_ADDR'];
      }
      return $ip;
    }

}
?>