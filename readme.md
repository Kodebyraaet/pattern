# Kodebyraaet Pattern for Laravel 5

The base for the repository pattern we use in Kodebyraaet.

## Installation

Install composer dependency.

    composer require kodebyraaet/pattern
    
Add the Service Provider to the config/app.php file.

    Kodebyraaet\Pattern\BaseRepositoryServiceProvider::class,

### Create the base repositories

If you have the [Kodebyraaet Generators](https://github.com/Kodebyraaet/generators) installed you can just run the following command:

    php artisan make:base-repository
    
Or you can do it manually:

##### Create the file `App\Data\Repository.php` (the namespace may differ):
```php
<?php namespace App\Data;

use Kodebyraaet\Pattern\BaseRepository;

class Repository extends BaseRepository
{

}
```

##### Create the file `App\Data\RepositoryInterface.php` (namespace may differ):
```php
<?php namespace App\Data;

use Kodebyraaet\Pattern\BaseRepositoryInterface;

interface RepositoryInterface extends BaseRepositoryInterface
{
    
}
```

## How to use
Check out [Kodebyraaet Generators](https://github.com/Kodebyraaet/generators) for a easier way to create the structure that extends this repository pattern.
