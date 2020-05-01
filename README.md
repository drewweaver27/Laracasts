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
- [Laracast 4 - Views](#laracast-4---views)
    + [1. Layout Pages ](#1-layout-pages)
    + [2. Integrate a Site Template](#2-integrate-a-site-template)
    + [3. Set an active navigation link](#3-set-an-active-navigation-link)
    + [4. Asset compilation with Laravel mix and Webpack](#4-asset-compilation-with-laravel-mix-and-webpack)
    + [5. Render Dynamic Data](#5-Render-Dynamic-Data)
    + [6. Render Dynamic Data P2](#6-Render-Dynamic-Data-P2)
- [Laracast 5 - Forms](#laracast-5---forms)
- [Laracast 6 - Controller Techniques](#laracast-6---Controller-Techniques)
- [Laracast 7 - Eloquent](#laracast-7---Eloquent)
- [Laracast 8 - Authentication](#laracast-8---Authentication)
- [Laracast 9 - Core Conceptes](#laracast-9---Core-Concepts)
- [Laracast 10 - Mail](#laracast-10---Mail)
- [Laracast 11 - Notifications](#Laracast-11---Notifications)

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
* we can use this for things like SASS

#### 5. Render Dynamic Data
1. `php artisan make:model Article -m` to make a new model and migration
2. in create_articles_table, add fields and then artisan mirgrate
3. create some articles with artisan tinker
4. display them with a Route
5. To get a certian number of results `$article = App\Article::take(2)->get(); return $article; `
6. To paginate`$article = App\Article::paginate(2) return $article; `
7. To get in order from oldest to newest `$article = App\Article::latest('optional_timestamp')->get(); return $article; `
8. Heres the route for this section on the homepage
    ```
        Route::get('/', function (){
        return view ('welcome', [
            //since we made only one, lets just use all
            'articles' => App\Article::all()
        ]);
    });
    ```
9. Heres the view code 
    ```
    <div id="sidebar">
			<ul class="style1">
				@foreach($articles as $article)
				<li class="first">
					<h3>{{$article->title}}</h3>
					<p><a href="#">{{$article->body}}</a></p>
				</li>
				@endforeach
            </ul>
    ```

#### 6. Render Dynamic Data P2
1. Create a new route to an article page
    `Route::get('/articles/{article}', 'ArticlesController@show');`
2. Add a controller and its show function
    ```
    <?php
    namespace App\Http\Controllers;

    use App\Article;
    use Illuminate\Http\Request;

    class ArticlesController extends Controller
    {
        public function show($id){
            $article = Article::find($id);

            return view('articles.show', ['article' => $article]);
        }
    }
    ?>
    ```
3. Add to the view 

## Laracast 5 - Forms 

#### 1. The Seven Restful Controller Actions
## Holy cow my CSS has gotten all messed up and views are all mix-matched

    1. `Index()` gets a list
    2. `show()` shows a particular item
    3. `create()` create a new resource
    4. `store()` a way to persist data
    5. `edit()` a way to edit data
    6. `update()` persist the update/edit
    7. `destory()` delete a resource

* to make all of these functions when creating a new controller, `php artisan make:controller ControllerName -r -m`
* -r creates it with all the functions, -m ties it to a model

#### 2. Restful Routing

* GET - display 
* POST - create a new resource 
* PUT - update a resource
* DELETE - delete a resource

#### 3. Form Handling

* Order matters in routing, make sure the routes are in the right order when looking at wildcards
* looking into a folder, do `folderName.file`
* always add `@csrf`


#### 4. Forms That Submit PUT Requests

* use the `return view('articles.edit', compact('article'));` instead of `return view('articles.show', ['article' => $article]);`
* to do a put, `form method="POST"` and add `@method('PUT')`

#### 5. Form Validation Essentials

* To validate in the controller
    ```       
    request()->validate([
    'title' => 'required',
    'excerpt' => 'required',
    'body' => 'required'
    ]);
    ```
* in the view
    ```
    <div class="control">
        <input type="text" 
        class="input @error('title') is-danger @enderror" 
        name="title" 
        id="title"
        value="{{ old('title') }} ">

        @error('title')
            <p class="help is-danger">{{$errors->first('title')}}</p>
        @enderror
    </div>
    ```

## Laracast 6 - Controller Techniques
#### 1. Leverage Route Model Binding
* we can refactor by removing this line `$article = Article::find($id);` and changing the methods to take an article
`public function update(Article $article)`. The wildcard must be the same name in the route or else it won't work

#### 2. Reduce Duplication 
* To reduce the duplication of code and made things more reusable, we can create a validation function and move the validation code so it can be reused through a function call.
    ```
    protected function validateArticle(){
        return request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required'
        ]);
    }
    ```
We can then call this function to create - `Article::create($this->validateArticle());` or update - `Article::update($this->validateArticle());`

* The protected fields will have to be changed in the model to allow this. `protected guarded = [];`

#### 3. Consider Named Routes
* As a better naming practice, you can give a name to routes so the uri can be changed without having to go change all of the other hardcoded instances of throughout the app `Route::get('/articles/{article}', 'ArticlesController@show')->name('articles.show');`

* This can be accessed by `<a href="{{ route('articles.show', $article}}">{{$article->title}}</a>`

* The redirect gets changed to `return redirect(route('articles.show', $article));`

## Laracast 7 - Eloquent

#### 1. Basic Eloquent Relationships

* hasOne
* hasMany
* belongsTo
* belongsToMany
* morphMany
* morphToMany

#### 2. Understanding Foreign Keys and Database Factories

* Factories can be used to create dummy data for a database easily 
 - in php artisan tinker, run `factory(App\ClassName::class)->create(['optionalArtibute' => 'Value']);`
* To make a factory, `php artisan make:factory FactoryName`
* To require referential integrity 
    ```
    $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
    ```
* Example, get the author of an article
    ```
     public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

    ```

#### 3. Many to Many Relationships with Linking Tables

 * To do a many to many relationship, we have to create an intermediate linking table to bridge the gap between each table. In the example, to link the tags table and the article table, create a article_tag table and link the ids

 #### 4. Display Tags Under Each Article

```
    if(request('tag')){
        $articles = Tag::where('name', request('tag'))->firstOrFail()->articles();
    }else{
        $articles = Article::latest()->get();
    }
```

#### 5. Attatch and Validate Many-To-Many inserts

* 1. In the create function
    ```
        return view('articles.create', [
            'tags' => Tag::all()
        ]);
    ```
* 2. In the store function 
    ```
        $this->validateArticle();

        $article = new Article(request(['title', 'excerpt', 'body']));
        $article->user_id = 1;
        $article->save();

        $article->tags()->attach(request('tags'));

        return redirect(route('articles.index'));
    ```

* 3. In the validation function
    ```
        return request()->validate([
            'title'=> 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'tags' => 'exists:tags,id'
        ]);
    ```

## Laracast 8 - Authentication

Laracast comes with authentication built in. To use authentication, install laravel/ui with composer, and then use php artisan ui with the --auth flag. Laravel UI also allows for using a front-end framework like bootstrap, vue or react. All that's left to do is connect to the database and run the prebuilt mirgrations and authentication is all set up. To use the reset email feature, emailing will have to be set up in the env file. For testing purposes, emails can be sent to a log file

## Laracast 9 - Core-Concepts

#### 1. Collections 

- When things have a many-to-many relationship, they are returned as a "collection"
- You can make a collection in tinker using the "collect" command and give it an array
- Collections have a bunch of builtin methods (map, filter, merge, flatten, etc.)
- Collection methods can be chained `filter()->map()`

#### 2. CSRF Attacks, with Examples

- CSRF = Cross-site Request Forgery
- Laravel has built in CSRF managment with the @csrf directive

#### 3. Service Container Fundamentals

- Containers store services
- Uses binding and keys

#### 4. Automatically Resolve Dependancies 

- Laravel can look down many layers of classes to see what can be instantiated/created
- This is confusing, and he knows it is too. 
- You can do this in the AppServiceProvider

#### 5. Laravel Facades Demystified

- Facades proxy to an underlying class

#### 6. Service Providers are the Missing Piece

- Each component has it's own service provider
- You can use service providers and facades together
- You can register new services in the AppServiceProvider

## Laracast 10 - Mail

#### 1. Send Raw Mail

- We can use the Mail facade to send a raw email. 
- *** Restart development server after changing env variables ***

#### 2. Simulate an Inbox using Mailtrap

- `php artisan make:mail`creates a new "mailable" object
- you can use views to create html emails, and then use them in the mailable class

#### 3. Send Email Using Markdown Templates

- In the mailable, change view to markdown
- You can use `php artisan make:mail Name --markdown=directory` to automatically make a markdown mailable 
- To add styles, use `php artisan vendor:publish --tag=laravel-mail` 
- You can create your own css in themes, and then go into config/mail and change the theme from default to the new theme name

#### 4. Notifications VS. Mailables

- To make notifications when a user does something (like process a payment), we can use the notifcation facade instead of Mail
- `php artisan make:notification NotificationName`
##### - ***Mine can be reached by going to localhost/notify/create, or through the "notifications" in the navigation bar***


## Laracast 11 - Notifications

#### 1. Database Notifications
- Notifications can go through many channels like email, slack, SMS as well as being stored in the database for retreival later
- Laravel has built in notification table migrations
- Data about the notification goes in the array in the ToArray function in the notification file
- Notifications are usually tied to users who are notifiable
- Notification data are able to be accessed as keys to the array
- When you fetch the notification collection, you get a custom collection (DatabaseNotification Collection) that can be used to mark notifications read and unread without having to make queries in a loop
- You can use "higher order TAP" where you want to call a method on a variable that returns void

#### 2. Send SMS Notifications in 5 minutes
- requires nexmo (account and composer package)
- sent-from number needs to be setup in config/services
- add the channel to notifications and the toNexmo method
- get user phone number from the user model
- you can setup user preferences and decide to use the nexmo channel based on a per-user situtation
