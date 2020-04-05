@extends('simplelayout');

@section('content')
<div id="sidebar">
			<ul class="style1">
				@forelse($articles as $article)
				<li class="first">
					<h3><a href="{{ route('articles.show', $article}}">{{$article->title}}</a></h3>
					<p>{{$article->body}}</p>
				</li>

				@empty
					<p>No relevant Articles Yet. </p>
				@endforelse
			</ul>
		</div>
@endsection