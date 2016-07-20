@extends('template')

@section('title',$article->titre)

@section('content')
	<div class="row">
		@if(!empty($article->image))
			<div class="col-md-12">
				<img src="files/img/{{$article->image}}" />
			</div>
		@endif
			<div class="col-md-10">
				<div class=""><h4 ><strong>{{$article->titre}}</strong></h4></div>
				<p class="text-justify">{{$article->contenu}}</p>
			</div>
			@if(!empty($article->doc))
				<div class="col-md-2">
					<a class="btn btn-danger btn-sm" href="{{route('guest.download',$article->doc)}}">
					  <i class="fa fa-download"></i> Télécharger
					 </a>
					 
				</div>
			@endif
		</div>
		<div class="row">
			<div class="col-md-10">
				{{-- <script id="dsq-count-scr" src="//lahidiorg.disqus.com/count.js" async></script>
				@include('guest.disqus') --}}
				@include('guest.facebook')
			</div>
		</div>
@endsection