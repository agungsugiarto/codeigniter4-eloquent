<?php

namespace Fluent\Config;

use CodeIgniter\Config\BaseService as CoreServices;
use CodeIgniter\Config\Config;
use Fluent\Models\DB;
use Illuminate\Database\Capsule\Manager;

class Services extends CoreServices
{
    public static function eloquent($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('eloquent');
        }

        return new DB(new Manager, new Config);
    }
}