# Working Time using Laravel 9

Repository of use for developing and studying web systems using Laravel Framework 9.

# How to run this project

You can basically clone the project or download it so it can be used and run the following command.

```
composer install
```
After that.

```
copy .env.example for .env and configuration database(MySQL, Postgres or Sqlite)
```
Run.
```
"php artisan migrate"
```
To create the system database, with the .env file pre-configured with the database already installed

## Application features

- Authentication and authorization (Users) 
- Register work time
- Calculate worked time
- Reports (comming...)

## Running tests

```
vendor/bin/phpunit --testdox
```

## Technologies used in the project

 - [Laravel](https://laravel.com/)
 - [PHP 8](https://www.php.net/)
 - [Composer](https://getcomposer.org/)
