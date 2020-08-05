<?php

namespace Fluent\Models;

use CodeIgniter\Config\Config;
use Illuminate\Database\Capsule\Manager;

class DB extends Manager
{
    protected $driver;

    public function __construct(Manager $capsule, Config $config)
    {
        parent::__construct();

        switch ($config::get('Database')->default['DBDriver']) {
            case 'MySQLi':
                $this->driver = 'mysql';
                break;
            case 'Postgre':
                $this->driver = 'pgsql';
                break;
            case 'SQLite3':
                $this->driver = 'sqlite';
                break;
            default:
                $this->driver = 'mysql';
                break;
        }

        $capsule->addConnection([
            'driver'    => $this->driver, 
            'host'      => $config::get('Database')->default['hostname'],
            'port'      => $config::get('Database')->default['port'],
            'database'  => $config::get('Database')->default['database'], 
            'username'  => $config::get('Database')->default['username'], 
            'password'  => $config::get('Database')->default['password'], 
            'charset'   => $config::get('Database')->default['charset'],  
            'collation' => $config::get('Database')->default['DBCollat'], 
            'prefix'    => $config::get('Database')->default['DBPrefix'],
            'strict'    => $config::get('Database')->default['strictOn'],
            'schema'    => 'public',
        ]);

        $capsule->setAsGlobal();

        $capsule->bootEloquent();
    }
}
