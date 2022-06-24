<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## <u>Installation Steps</u>

 - composer create-project laravel/laravel directory_name => Laravel installations
 - npm install => installing additional packages
 - npm run dev => compiling those packages
 - set database 
   - CREATE DATABASE your_db_name CHARACTER SET utf8mb4;
   - CREATE USER 'your_db_username'@'localhost' IDENTIFIED BY 'your_password';
   - GRANT ALL PRIVILEGES ON your_db_name.* TO 'your_db_username'@'localhost';
   - enter db name, user, password and server in your .env file
 - set your local environment 
   - set vhost on your Apache (in httpd-vhost.conf file) for expense-manager.test, for example
   - add expense-manager.test to your local host file (located in C:\Windows\System32\drivers\etc) - Notepad or whatever must be run with administrator privileges
 - php artisan optimize
 - php artisan migrate

## <u>Additional settings</u>

- Debugbar => composer require barryvdh/laravel-debugbar --dev
- Laravel Breeze, for basic auth stuff like login and registration => composer require laravel/breeze --dev
- If there's an issue with "Syntax error or access violation: 1071 Specified key was too long" add <b>Schema::defaultStringLength(191)</b> to boot() method in app/Providers/AppServiceProvider.php
  - Add also 'use Illuminate\Support\Facades\Schema;'
