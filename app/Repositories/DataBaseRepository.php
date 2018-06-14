<?php

namespace App\Repositories;

use PDO;
use PDOException;
use Config;
use Artisan;

class DataBaseRepository {

	private $username;
	private $password;
	private $host;
	private $port;

	public function __construct() {
	  $this->username =  env('DB_USERNAME');
	  $this->password =  env('DB_PASSWORD');
	  $this->host =  env('DB_HOST');
	  $this->port =  env('DB_PORT');
	}

    public function create($data) {
    	$database = "bd_".md5($data['username'].microtime());
    try {
        $conn = new PDO("pgsql:host=$this->host;port=$this->port",$this->username, $this->password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE $database";
        $conn->exec($sql);
        } catch (PDOException $exception) {
        return 500;
        }

 Config::set('database.connections.tenant', array(
            'driver'    => 'pgsql',
            'host'      => 'localhost',
            'database'  => $database,
            'username'  => 'postgres',
            'password'  => 'root',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ));
 
 $config_tenant = Config::get('database.connections.tenant');
 Artisan::call('migrate', array('--database' => 'tenant'));
 return $config_tenant;
  }

}