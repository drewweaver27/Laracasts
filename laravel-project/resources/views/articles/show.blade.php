@extends('simplelayout');

@section('content')
<div id="content">
			<div class="title">
				<h2>{{$article->title}}</h2>
			</div>
				
			<p><img src="/images/banner.jpg" alt="" class="image image-full" /> </p>
			<p>{{$article->body}} </p>
			
</div>
@endsection