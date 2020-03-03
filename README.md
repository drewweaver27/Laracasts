# Laracasts
My journal for the CIS 401 Laracasts assignments

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