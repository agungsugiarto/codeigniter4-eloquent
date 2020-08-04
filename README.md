# The Illuminate Database package for CodeIgniter 4

[![Latest Version](https://img.shields.io/github/release/agungsugiarto/codeigniter4-inspiring.svg)](https://github.com/agungsugiarto/codeigniter4-inspiring/releases)
[![Total Downloads](https://poser.pugx.org/agungsugiarto/codeigniter4-inspiring/downloads)](https://packagist.org/packages/agungsugiarto/codeigniter4-inspiring)
[![License](https://poser.pugx.org/agungsugiarto/codeigniter4-inspiring/license)](https://packagist.org/packages/agungsugiarto/codeigniter4-inspiring)
[![test](https://github.com/agungsugiarto/codeigniter4-inspiring/workflows/inspiring%20build/badge.svg)](https://github.com/agungsugiarto/codeigniter4-inspiring/actions)

[Notepad++ easter egg quotes](http://en.wikipedia.org/wiki/Notepad%2B%2B#Easter_egg) and have a lot more inspiration.

![](.github/carbon.png?raw=true)
## Instalation

Include this package via Composer:

```console
composer require agungsugiarto/codeigniter4-eloquent
```

## Setup services eloquent
Open App\Controllers\BaseController.php

add `service(eloquent);` on function initController
```php
//--------------------------------------------------------------------
// Preload any models, libraries, etc, here.
//--------------------------------------------------------------------
// E.g.:
// $this->session = \Config\Services::session();

service(eloquent);
```
## Usage

Example model
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    protected $table = 'authors';
    protected $primaryKey = 'id';
}

```

### How to use in controller
```php
<?php 

namespace App\Controllers;

use App\Models\Authors;
use Fluent\Models\DB;

class Home extends BaseController
{
	public function index()
	{
		return $this->response->setJSON([
			'data'   => Authors::all(),
			'sample' => DB::table('authors')->skip(1)->take(100)->get(),
		]);
	}
}

```

## More info usefull link docs laravel
- [Database: Getting Started](https://laravel.com/docs/7.x/database)

- [Eloquent: Getting Started](https://laravel.com/docs/7.x/eloquent)

## License

This package is free software distributed under the terms of the [MIT license](LICENSE.md).
