# Laravel-Crud-Helper
Project to help anyone to make a crud on Laravel easier

### Features
- Views created easily

## Installation
- With composer run `composer require weblabormx/laravel-crud-helper` 

## Documentation

### Dependencies
This package include `Laracast/Flash` package, so, you should add `@include('flash::message')` code in your view to show the messages

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
- `$module` - Name of the module, with this will detect Model, Url, directory of views and more
- `$base` (Default admin) - Base of url
- `$request_base` (Optional) - The base directory of the request, by default is `App\Http\Requests\` 
- `$request` (Optional) - Base Name of the class for making request, by default is `$request_base.$request` 
- `$view_base` (Optional) - The base directory of views, by default is the same as `$base` 
- `$views_directory` (Optional) - The directory of the view, by default is `$view_base.'.'.$module` 

```php
use WeblaborMX\LaravelCrudHelper\BaseController;

class AccountController extends Controller
{
	use BaseController;

    protected $module = 'account';
    protected $request = 'App\Http\Requests\AccountRequest';

    function __construct() {
        $this->load();
    }

}
```

#### Redirections
By default the controller redirects with the next values
```php
$redirects = [
    'store' => $this->url,
    'update' => 'back', // Return back
    'destroy' => $this->url
];
```
You are able to change it adding the `protected $redirects` attribute in the controller

### Repositories
This help you to add create and update functions to your repository. (of course, you are able to add it too)

```php
use WeblaborMX\LaravelCrudHelper\BaseRepository;

class SuscriptionRepository
{
	use BaseRepository;
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

You can customize the default views publishing them with `php artisan vendor:publish --provider="WeblaborMX\LaravelCrudHelper\CrudHelperProvider"`, it will be add it in vendor folder.

#### Components
This package include some components you can use only calling the view
- `laravel-crud-helper::errors` - To print the founded errors
- `laravel-crud-helper::box`
- `laravel-crud-helper::index-table`
- `laravel-crud-helper::module-header`
- `laravel-crud-helper::navs`
- `laravel-crud-helper::show-variables`