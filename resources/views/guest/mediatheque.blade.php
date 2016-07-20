@extends('template')

@section('title','Mediathèque')

@section('content')
<div class="col-md-12">
	<div class="row">
		<div class="col-md-12"><h4 ><strong>Vidéos</strong></h4></div>
		@if(count($videos)!=0)
			@foreach($videos as $video)
			<div class="col-md-6 media-frame">
				<div class="col-md-6">
					<div class="12">
						<div class="embed-responsive embed-responsive-4by3">
					    	<iframe class="embed-responsive-item" src="//www.youtube.com/embed/{{$video->video}}"></iframe>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="12"><h5 class="medium-h5"><strong>{{$video->titre}}</strong></h5></div>
					<p>
					{{$video->contenu}}
					</p>
				</div>
			</div>
			@endforeach
		@endif
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="solidline"></div>
		</div>			
	</div>
	<div class="row">
		<div class="col-md-12"><h4 ><strong>Audios</strong></h4></div>
		@if(count($audios)!=0)
			@foreach($audios as $audio)
				<div class="col-md-4 media-frame">
					<div class="col-md-12">
						@if(strpos($audio->lien,"mixcloud")==false)
								<iframe width="100%" height="210" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/{{$audio->audio}}&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>
							
						@else
							
								<iframe width="100%" height="210" src="https://www.mixcloud.com/widget/iframe/?feed=https%3A%2F%2Fwww.mixcloud.com%2F{{$audio->audio}}2F&light=1" frameborder="0"></iframe>
							
						@endif
						
					</div>
					<div class="col-md-12">
						<h5 class="medium-h5"><strong>{{$audio->titre}}</strong></h5>
						<p>{{$audio->contenu}}</p>
					</div>
				</div>
			@endforeach
		@endif
		<div class="col-md-4">


		</div>
	</div>
</div>

@endsection