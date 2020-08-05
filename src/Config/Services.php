<?php

namespace Fluent\Config;

use CodeIgniter\Config\BaseService as CoreServices;
use Fluent\Models\DB;

class Services extends CoreServices
{
    public static function eloquent($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('eloquent');
        }

        return new DB();
    }
}