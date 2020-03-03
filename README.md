# Laracasts
My journal for the CIS 401 Laracasts assignments

- [Laracast 1 - Prerequisets](#laracast-1---prerequisets)
    + [1. The control flow at a glance](#1-the-control-flow-at-a-glance)
    + [2. Install PHP, MySQL, and Composer](#2-install-php--mysql--and-composer)
    + [3. Install Laravel Installer](#3-install-laravel-installer)
    + [4. Laravel Valet Setup – Mac only, does not apply](#4-laravel-valet-setup---mac-only--does-not-apply)
- [Laracast 2 - Routing](#laracast-2---routing)
    + [1. Basic Routing and Views](#1-basic-routing-and-views)
    + [2. Pass Request Data to Views](#2-pass-request-data-to-views)
    + [3. Route Wildcards](#3-route-wildcards)
    + [4. Routing Controllers](#4-routing-controllers)
- [Laracast 3 - Database Access](#laracast-3---database-access)

## Laracast 1 - Prerequisets 

#### 1. The control flow at a glance 
Request -> routes -> controller -> load necessary info for the response -> view loads the html 
#### 2. Install PHP, MySQL, and Composer 
#### 3. Install Laravel Installer 
* Create new Laravel project 
   `Laravel new projectName` 
* Run on the php artisan local server  
   `php artisan serve` 
#### 4. Laravel Valet Setup – Mac only, does not apply 

## Laracast 2 - Routing 

#### 1. Basic Routing and Views
* To register routes for the app, go to routes/web.php
* When the user makes a get request, a view is loaded in response 
* Views are stored in the resources directory 
* Routes can return things other than views such as simple strings or JSON 
* The forward slash when defining a route is optional 
* Blade is the templating engine for Laravel 
* A get request:
        ```Route::get('/endpointName', function () {     
            return view('nameOfTheView'); 
            }); 
        ```
#### 2. Pass Request Data to Views
* To pass data through the url to the endpoint (/?name=Drew)
```
Route::get('/', function () {     
    $name = request('name'); 
    return view('welcome',[         
        'name' => $name     
    ]); 
});
``` 
* or inline the variable 
```
Route::get('/', function() [
    return view('welcome', [
        'name' => request('name')
    ]);
]);
```
* in the html, use `{{name}}`

#### 3. Route Wildcards
```
//Wildcards are things that would have a unique id
Route::get('/posts/{post}', function ($post) { 
    //Imitate the database with posts     
    $posts = [         
        'my-first-post' => 'Hello, this is my first blog post',         
        'my-second-post' => 'Wowee, my second blog post!'     
    ]; 

     //if the wildcard doesn't exist, go to error 404     
    if(!array_key_exists($post, $posts)){         
         abort(404, 'Sorry, not found');     
    } 
 
    //return the view called posts with the post info     
    return view('posts', [         
        'post' => $posts[$post]     
    ]); 
}); 
```
 
#### 4. Routing Controllers
* controllers are in app/http/Controllers
* Route to the controller
    `Route::get('/posts/{post}', 'PostController@show');`
* The controller -> PostController.php
```
<?php     
namespace App\Http\Controllers;     
class PostController{         
    function show($post){             
        $posts = [                 
            'my-first-post' => 'Hello, this is my first blog post',                 
            'my-second-post' => 'Wowee, my second blog post!'             
        ];             
            //if the wildcard doesn't exist, go to error 404             
        if(!array_key_exists($post, $posts)){                 
            abort(404, 'Sorry, not found');             
        }                
        //return the view the post info             
        return view('posts', [                 
            'post' => $posts[$post]             
        ]);         
    } 
?> 
```

## Laracast 3 - Database Access
* Make sure the DB_Connection is set to mysql in the env file.  
* To access the database, import the database class (use db) 
* To make a call to the database from the route in a controller with the Post eloquent model 
```
Return view (‘posts’ , [ 
    ‘post’ => Post::where(‘slug’, $slug)->firstOrFail() 
]);
``` 
* `FirstOrFail()` will try to find the first record or it will throw an error 404 
* To make the model: php artisan make:model Post 
* Create a table with a migration 
    - `Php artisan make:migration create_posts_table` 
    - The `up()` function are all things we want to add 
        - `$table->text(‘body’)` 
    - The `down()` function are things to drop if need be 
    - To migrate -> `php artisan migrate` 
    - To revert -> `php artisan migrate:rollback` 
* To make a multple files at once, review the help to choose which flags to use. `Php artisan help make:model` 
* If you construct a full query, `all()` won’t work, just use get 
* `Php artisan tinker` to sandbox from the command line 
* Use the models kind of like objects 
    - To mark an assignment complete, make a complete function that marks the assignment 
complete and the call it whenever you want to complete an assignment 

## Laracast 4 - Views

#### 1. Layout Pages
* Create a layout page in resources/views -> layout.blade.php
* Move the _structure_ out of the welcome.blade.php but leave the content
* in welcome.blade.php 
    - `@import ('layout')`
    - wrap html with `@section('content')` and `@endsection`
* in layout.blade.php, in the body, `@yield('content')` 
    - you can create as many yields as you want, ex:
        ```
        @yield('header')
        @yield('content')
        @yield('footer')
        ```
* to create more templates, create `filename.blade.php` and then `@import('layout')

#### 2. Integrate a Site Template
* https://templated.co/simplework
* assets go in the public directory
    - create css folder
    - update styles to `css/default.css`
* Only have stuff in the blade files that I want to be visible

#### 3. Set an active navigation link
* `<li class="{{ Request::path() === 'about' ? 'current_page_item' : ''}}><a .....>About</a></li>`

#### 4. Asset Compilation with Laravel Mix and webpack
If vanilla Js or CSS is being used, it can go in public. If a JS library (npm, vue) or SASS or something else is being used that requires a build process, it goes in the resources. 
* webpack.mix.js is Laravels built-in webpack file. It takes an intake and output directory. 
* npm is included (YAY!) so and we have some dependencies included that have yet to be installed, so lets install them