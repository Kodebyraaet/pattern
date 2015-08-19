# Kodebyraaet Pattern for Laravel 5

The base for the repository pattern we use in Kodebyraaet.

## Installation

Install composer dependency.

    composer require kodebyraaet/pattern

### Create the file `App\Data\Repository.php` (the namespace may differ):
```php
<?php namespace App\Data;

use Kodebyraaet\Pattern\BaseRepository;

class Repository extends BaseRepository
{

}
```

### Create the file `App\Data\RepositoryInterface.php` (namespace may differ):
```php
<?php namespace App\Data;

use Kodebyraaet\Pattern\BaseRepositoryInterface;

interface RepositoryInterface extends BaseRepositoryInterface
{
    
}
```

Check out [Kodebyraaet Generators](https://github.com/Kodebyraaet/generators) for a easier way to create the structure that extends this repository pattern.