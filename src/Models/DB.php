<?php

namespace Fluent\Models;

use CodeIgniter\Config\Services;
use CodeIgniter\HTTP\URI;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Pagination\Paginator;

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

        Paginator::currentPathResolver(function () {
            return current_url();
        });

        Paginator::currentPageResolver(function ($pageName = 'page') {
            $page = Services::request()->getVar($pageName);

            if (filter_var($page, FILTER_VALIDATE_INT) !== false && (int) $page >= 1) {
                return (int) $page;
            }

            return 1;
        });

        Paginator::queryStringResolver(function (URI $request) {
            return $request->getQuery();
        });
    }
}
