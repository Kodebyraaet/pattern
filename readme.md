# Kodebyraaet Pattern for Laravel 5 and Lumen

The base for the repository pattern we use in Kodebyraaet.

## Installation

Install composer dependency.

    composer require kodebyraaet/pattern

If you are using Laravel add the Service Provider to the config/app.php file.

    Kodebyraaet\Pattern\BaseRepositoryServiceProvider::class,

If you are using Lumen add the Service Provider to the bootstrap/app.php file.

    $app->register(Kodebyraaet\Pattern\BaseRepositoryServiceProvider::class);

### Create the base repositories

If you have the [Kodebyraaet Generators](https://github.com/Kodebyraaet/generators) installed you can just run the following command:

    php artisan make:base-repository

Or you can do it manually:

##### Create the file `App\Entities\Repository.php` (the namespace may differ):
```php
<?php

namespace App\Entities;

use Kodebyraaet\Pattern\BaseRepository;

class Repository extends BaseRepository
{

}
```

##### Create the file `App\Entities\RepositoryInterface.php` (namespace may differ):
```php
<?php

namespace App\Entities;

use Kodebyraaet\Pattern\BaseRepositoryInterface;

interface RepositoryInterface extends BaseRepositoryInterface
{

}
```

## How to use
Check out [Kodebyraaet Generators](https://github.com/Kodebyraaet/generators) for a easier way to create the structure that extends this repository pattern.
