@extends('simplelayout');

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
@endsection

@section('content')
<div class="wrapper">
    <div class="container" id="page">
        <h1 class="heading has-text-weight-bold is-size-4">Update Article</h1>
        
        <form method="POST" action="/articles/{{articles->id}}">
            @csrf
            @method('PUT')
            <div class="field">
                <label for="title" class="label">Title</label>

                <div class="control">
                    <input type="text" class="input" name="title" id="title" value="{{$article->title}}">
                </div>
            </div>

            <div class="field">
                <label for="excerpt" class="label">Excerpt</label>

                <div class="control">
                    <textarea name="excerpt" id="excerpt" class="textarea" value="{{$article->excerpt}}"></textarea>
                </div>
            </div>

            <div class="field">
                <label for="body" class="label">Body</label>

                <div class="control">
                    <textarea name="body" id="body" class="textarea" value="{{$article->body}}"></textarea>
                </div>
            </div>

            <div class="field is-grouped">
                <div class="control">
                    <button class="button is-link" type="submit">Submit</button>
                </div>
            </div>  
    </div>
</div>
@endsection