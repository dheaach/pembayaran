<?php defined('BASEPATH') OR exit('No direct script access allowed');

 public $dynamicDB;

 public function switch_database($dbname, $user, $pass) {

  $this->dynamicDB = array(
  'dsn'  => 'mysql:host=localhost; dbname='.$dbname.'; charset=utf8;',
  'hostname' => 'localhost',
  'username' => $user,
  'password' => $pass
  );

  return $dynamicDB;
 }