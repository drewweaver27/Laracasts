<?php

    namespace App\Http\Controllers;

    use DB;
    use App\Post;

    class PostController extends Controller{

        function show($slug){
            // dd($post);
            //return the view the post inf
            return view('posts', [
                'post' => Post::where('slug', $slug)->firstOrFail()
            ]);
        }
    }

?> 