<?php

class Db_manager
{
    var $connections = array();
    var $ci;

    function __construct()
    {
        $this->ci =& get_instance();
    }

    function get_connection($db_name,$host,$port,$username,$password)
    {
        // connection exists? return it
        if (isset($this->connections[$db_name])) 
        {
            return $this->connections[$db_name];
       }
       else
       {
        // create connection. return it.
        // $host = '192.168.100.76';
        // $port = '3306';
        // $db_name = 'madura';
        // $username = 'adm_fhs';
        // $password = 'fhsoftware2018';

        $config_db = array(
            'dsn'  => 'mysql:host='.$host.':'.$port.'; dbname='.$db_name.'; charset=utf8;',
            'username' => $username,
            'password' => $password,
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
            $this->connections[$db_name] = $this->ci->load->database($config_db, true);
            return $this->connections[$db_name];
        }
    }

    function test_connection($db_name,$host,$port,$username,$password)
    {
        // create connection. return it.
        // $host = '192.168.100.76';
        // $port = '3306';
        // $db_name = 'madura';
        // $username = 'adm_fhs';
        // $password = 'fhsoftware2018';
        if(($db_name OR $host OR $port OR $username OR $password) != ''){
            $config_db = array(
                'dsn'  => 'mysql:host='.$host.':'.$port.'; dbname='.$db_name.'; charset=utf8;',
                'username' => $username,
                'password' => $password,
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
        
            $this->connections[$db_name] = $this->ci->load->database($config_db, false,true);
            
            if($this->ci->db->initialize()) 
            {
                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
        
    }

    function close_connection($db_name) {
        if (isset($this->connections[$db_name])) {
            $this->connections[$db_name]->close();
            unset($this->connections[$db_name]); // Optionally, remove the closed connection from the connections array
        }
    }
}