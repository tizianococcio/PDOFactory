<?php

class DatabaseConfig
{
	private $db;

    private $default = array(
        'datasource' 	=> 'Database/Mysql',
        'persistent' 	=> false,
        'host' 			=> 'localhost',
        'login' 		=> 'finlabs_dbadmlco',
        'password' 		=> 'h62YdDfP-L)9qW2_K=?',
        'database' 		=> 'finlabs_lco',
        'prefix' 		=> ''
    );

    public function __construct()
    {
    	$this->db = $this->default;
    }

    
    public function getHost()
    {
    	return $this->db['host'];
    }

    public function getUser()
    {
    	return $this->db['login'];
    }

    public function getPassword()
    {
    	return $this->db['password'];
    }

    public function getDatabase()
    {
    	return $this->db['database'];
    }
}