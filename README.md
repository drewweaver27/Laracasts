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
        ``` 
        Route::get('/endpointName', function () {     return view('nameOfTheView'); }); 
        ```
 
