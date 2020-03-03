<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// //Wild cards are things that would have a unique id {post}
// Route::get('/posts/{post}', function ($post) {

//     //Imitate the database with posts
    // $posts = [
    //     'my-first-post' => 'Hello, this is my first blog post',
    //     'my-second-post' => 'Wowee, my second blog post!'
    // ];

    // //if the wildcard doesn't exist, go to error 404
    // if(!array_key_exists($post, $posts)){
    //     abort(404, 'Sorry, not found');
    // }

    // //return the view the post info
    // return view('posts', [
    //     'post' => $posts[$post]
    // ]);
// });

Route::get('/posts/{post}', 'PostController@show');
