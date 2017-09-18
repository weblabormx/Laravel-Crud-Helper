# Laravel-Crud-Helper
Project to help anyone to make a crud on Laravel easier

### Features
- Views created easily

## Installation
- With composer run `composer require weblabormx/laravel-crud-helper` 
- Modify AppServiceProvider and add the next code
```php
use WeblaborMX\LaravelCrudHelper\Services;

class AppServiceProvider extends ServiceProvider
{
    use Services;

    public function boot()
    {
        $this->addServices();            
    }
```

## Documentation

### Improved Model
Extending the model to this class will allow to
- save updated by and created by fields automatically
- scope last (To get the last one) and order (to order for newer first) added
- get title and primary url field
- creator_user and updater_user relationship

```php
use WeblaborMX\LaravelCrudHelper\ImprovedModel;

class Account extends Model
{
    use ImprovedModel;

    protected $title_field = 'name';
```

- You will need to add in your migration the next fields to work well.
```php
$table->integer('updated_by')->nullable();
$table->integer('created_by')->nullable();
```

### Controllers
Controllers will help you to make all the functions of a resource, to implement you will need to add the next code in the controller

You will need to add some fields
- $module - Name of the module, with this will detect Model, Url, directory of views and more
- $base (Default admin) - Base of url
- $request (Optional) - Name of the class for making request
```php
use WeblaborMX\LaravelCrudHelper\BaseController;

class AccountController extends BaseController
{

    protected $module = 'account';
    protected $request = 'App\Http\Requests\AccountRequest';

    function __construct() {
        $this->load();
    }

}
```

### New blade functions
#### If Route exists
```php
@route('admin.test')
	Enter if exists that view
@endroute
```

### Views
Views will be added by default, but you will need to have two files in $base/$module:
- partial-form - The Form with the fields to use
- partial-index - The table to show in index

You will be able to change the another views adding some files in $base/$module named:
- create
- edit
- index
- show

You can create scripts.blade file to add javascript in create and edit views.