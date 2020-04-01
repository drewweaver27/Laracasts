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

    public function show(Article $article){
        //show single
        return view('articles.show', ['article' => $article]);
    }

    public function create(){
        //shows a view to create a new resource
        return view('articles.create');
    }

    public function store(){
        //Persist the new resource
        // dump(request()->all());
        Article::create($this->validateArticle());

        return redirect('/articles');
    }

    public function edit(Article $article){
        //show a view to edit an item
        return view('articles.edit', compact('article'));
    }

    public function update(Article $article){
        //persist edited resource
        Article::update($this->validateArticle());

        return redirect(route('articles.show', $article));

    }

    protected function validateArticle(){
        return request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required'
        ]);
    }

    public function destory(){
        //delete the resource
    }
}
