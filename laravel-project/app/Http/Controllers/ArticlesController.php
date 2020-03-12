<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{

    public function index(){
        //Render list
        $articles = Article::latest()->get();

        return view('articles.index', ['articles' => $articles]);
    }

    public function show($id){
        //show single
        $article = Article::find($id);

        return view('articles.show', ['article' => $article]);
    }

    public function create(){
        //shows a view to create a new resource
        return view('articles.create');
    }

    public function store(){
        //Persist the new resource
        // dump(request()->all());
        request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required'
        ]);

        $article = new Article();
        $article->title = request('title');
        $article->excerpt = request('excerpt');
        $article->body = request('body');

        $article->save();

        return redirect('/articles');
    }

    public function edit($id){

        $article = Article::find($id);
        //show a view to edit an item
        return view('articles.edit', compact('article'));
    }

    public function update($id){
        //persist edited resource
        request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required'
        ]);
        $article = Article::find($id);
        $article->title = request('title');
        $article->excerpt = request('excerpt');
        $article->body = request('body');
        $article->save();

        return redirect('articles/' . $article->$id);

    }

    public function destory(){
        //delete the resource
    }
}
