<?php

namespace Fluent\Models;

use CodeIgniter\Config\Services;
use Fluent\Pagination\ViewBridge;
use Illuminate\Events\Dispatcher;
use Illuminate\Pagination\Cursor;
use Illuminate\Container\Container;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Facade;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Pagination\CursorPaginator;

class DB extends Manager
{
    protected $driver;

    public function __construct(Container $container = null)
    {
        parent::__construct($container);

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
            case 'SQLSRV':
                $this->driver = 'sqlsrv';
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

        $this->getContainer()->singleton('events', function ($app) {
            return new Dispatcher($this->getContainer());
        });

        $this->getContainer()->singleton('db', function ($app) {
            return $this->getDatabaseManager();
        });

        $this->setAsGlobal();

        $this->bootEloquent();

        Paginator::$defaultView = config('Eloquent')->defaultView;

        Paginator::$defaultSimpleView = config('Eloquent')->simpleDefaultView;

        Paginator::viewFactoryResolver(function () {
            return new ViewBridge();
        });

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

        Paginator::queryStringResolver(function () {
            return Services::uri()->getQuery();
        });

        CursorPaginator::currentCursorResolver(static function ($cursorName = 'cursor') {
            return Cursor::fromEncoded(Services::request()->getVar($cursorName));
        });

        Facade::clearResolvedInstances();
        Facade::setFacadeApplication($this->getContainer());
    }
}
