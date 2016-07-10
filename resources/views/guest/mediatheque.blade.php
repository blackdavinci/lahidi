@extends('template')

@section('title','Mediathèque')

@section('content')
<div class="col-md-12">
	<div class="row">
		<div class="col-md-12"><h4 ><strong>Vidéos</strong></h4></div>
		@if(count($videos)!=0)
			@foreach($videos as $video)
			<div class="col-md-12">
				<div class="col-md-5">
					<div class="12">
						<div class="embed-responsive embed-responsive-4by3">
					    	<iframe class="embed-responsive-item" src="//www.youtube.com/embed/{{$video->lien}}"></iframe>
						</div>
					</div>
				</div>
				<div class="col-md-7">
					<div class="12"><h5 class="medium-h5"><strong>{{$video->titre}}</strong></h5></div>
					<p>
					{{$video->contenu}}
						Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
					</p>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="solidline"></div>
					</div>			
				</div>
			</div>
			@endforeach
		@endif
	</div>
	<div class="row">
		<div class="col-md-12"><h4 ><strong>Audios</strong></h4></div>
		@if(count($audios)!=0)
			@foreach($audios as $audio)
				<div class="col-md-4" style="margin-right:5px">
					<div class="col-md-12">
						<iframe width="350" height="300" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/{{$audio->lien}}&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>
						<h5 class="medium-h5"><strong>{{$audio->titre}}</strong></h5>
					</div>
					
				</div>
			@endforeach
		@endif
		<div class="col-md-4">
			<iframe width="100%" height="400" src="https://www.mixcloud.com/widget/iframe/?feed=https%3A%2F%2Fwww.mixcloud.com%2FAblogui%2Femission-de-tamata-fm-consacr%25C3%25A9-%25C3%25A0-lahidi%2F&light=1" frameborder="0"></iframe>
		</div>
	</div>
</div>

@endsection