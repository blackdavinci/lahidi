@extends('template')

@section('title',$engagement->intitule)

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h4><small>Promesse / <span class="text-capitalize">{{$engagement->categorie->type}}</span> / {{$engagement->categorie->designation}} / {{$engagement->secteur->nom}}</small></h4>
		</div>
		<div class="col-md-12">
			<h3><strong>{{$engagement->intitule}}</strong></h3>
		</div>
		<div class="col-md-12">
			<p>{{$engagement->description}}</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
		<script id="dsq-count-scr" src="//lahidiorg.disqus.com/count.js" async></script>
		@include('guest.disqus')
		</div>
	</div>
@endsection