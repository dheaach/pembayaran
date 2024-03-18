<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dynamic extends CI_Controller {
 public $dynamicDB;

 public function __construct() {
  parent::__construct();
 }

 public function index() {
  //Somehow retrieve the following information from user.
  $host='192.168.100.76';
  $user='adm_fhs';
  $pass='fhsoftware2018';
  $dbname='madura1';
  $port='3306';
  // End of retrieval information from user.

  $this->dynamicDB = array(
   'dsn'  => "mysql:host=".$host.":".$port."; dbname=".$dbname."; charset=utf8;",
    'username' => $user,
    'password' => $pass,   
    'dbdriver' => 'pdo',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => FALSE,
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
  );

  $this->load->model('dynm_model');
  $result = $this->dynm_model->select($this->dynamicDB);
  var_dump($result);
 }
 public function dbchange($db)
 {
   if($db=='madura'){
      $host='158.140.172.233';
      $user='web_access';
      $pass='fhsoftware2019';
      $dbname='madura';
      $port='3306';
      // End of retrieval information from user.

      $this->dynamicDB = array(
       'dsn'  => "mysql:host=".$host.":".$port."; dbname=".$dbname."; charset=utf8;",
        'username' => $user,
        'password' => $pass,   
        'dbdriver' => 'pdo',
        'dbprefix' => '',
        'pconnect' => FALSE,
        'db_debug' => FALSE,
        'cache_on' => FALSE,
        'cachedir' => '',
        'char_set' => 'utf8',
        'dbcollat' => 'utf8_general_ci',
        'swap_pre' => '',
        'encrypt' => FALSE,
        'compress' => FALSE,
        'stricton' => FALSE,
        'failover' => array(),
        'save_queries' => TRUE
      );
   }elseif ($db == 'madura1') {
     $host='192.168.100.76';
      $user='adm_fhs';
      $pass='fhsoftware2018';
      $dbname='madura1';
      $port='3306';
      // End of retrieval information from user.

      $this->dynamicDB = array(
       'dsn'  => "mysql:host=".$host.":".$port."; dbname=".$dbname."; charset=utf8;",
        'username' => $user,
        'password' => $pass,   
        'dbdriver' => 'pdo',
        'dbprefix' => '',
        'pconnect' => FALSE,
        'db_debug' => FALSE,
        'cache_on' => FALSE,
        'cachedir' => '',
        'char_set' => 'utf8',
        'dbcollat' => 'utf8_general_ci',
        'swap_pre' => '',
        'encrypt' => FALSE,
        'compress' => FALSE,
        'stricton' => FALSE,
        'failover' => array(),
        'save_queries' => TRUE
      );
   }
   $this->load->model('dynm_model');
   
   $result = $this->dynm_model->select($this->dynamicDB);

   print("<pre>".print_r($result,true)."</pre>");
   // var_dump($result);
 }
}