@extends('simplelayout');

@section('content')
<div id="sidebar">
			<ul class="style1">
				@foreach($articles as $article)
				<li class="first">
					<h3><a href="{{ route('articles.show', $article}}">{{$article->title}}</a></h3>
					<p>{{$article->body}}</p>
				</li>
				@endforeach
			</ul>
		</div>
@endsection