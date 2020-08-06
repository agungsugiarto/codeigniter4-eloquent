<?php

namespace Fluent\Models;

use Illuminate\Database\Capsule\Manager;

class DB extends Manager
{
    protected $driver;

    public function __construct()
    {
        parent::__construct();

        switch (config('Database')->default['DBDriver']) {
            case 'MySQLi':
                $this->driver = 'mysql';
                break;
            case 'postgre':
                $this->driver = 'pgsql';
                break;
            case 'SQLite3':
                $this->driver = 'sqlite';
                break;
            default:
                $this->driver = 'mysql';
                break;
        }

        $this->addConnection([
            'driver'    => $this->driver, 
            'host'      => config('Database')->default['hostname'],
            'port'      => config('Database')->default['port'],
            'database'  => config('Database')->default['database'], 
            'username'  => config('Database')->default['username'], 
            'password'  => config('Database')->default['password'], 
            'charset'   => config('Database')->default['charset'],  
            'collation' => config('Database')->default['DBCollat'], 
            'prefix'    => config('Database')->default['DBPrefix'],
            'strict'    => config('Database')->default['strictOn'],
            'schema'    => config('Database')->connect()->schema ?? 'public'
        ]);

        $this->setAsGlobal();

        $this->bootEloquent();
    }
}
