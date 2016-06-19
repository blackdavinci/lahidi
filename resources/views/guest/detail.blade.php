@extends('template-guest')

@section('title','Promesses du président')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h2>Toutes les promesses \<small> Agriculture</small></h2>
		</div>
		<div class="col-md-12">
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
		<script id="dsq-count-scr" src="//lahidiorg.disqus.com/count.js" async></script>
		@include('guest.disqus')
		</div>
	</div>
@endsection