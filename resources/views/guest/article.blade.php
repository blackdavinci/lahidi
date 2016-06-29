@extends('template')

@section('title',$article->titre)

@section('content')
	<div class="row">
		@if(!empty($article->image))
			<div class="col-md-12">
				<img src="files/img/{{$article->image}}" />
			</div>
		@endif
			<div class="col-md-12">
				<div class=""><h4 ><strong>{{$article->titre}}</strong></h4></div>
				<p class="text-justify">{{$article->contenu}}</p>
			</div>
		<div class="row">
			<div class="col-md-12">
			<script id="dsq-count-scr" src="//lahidiorg.disqus.com/count.js" async></script>
			@include('guest.disqus')
			</div>
		</div>
@endsection