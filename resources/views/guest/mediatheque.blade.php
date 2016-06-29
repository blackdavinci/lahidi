@extends('template')

@section('title','Mediathèque')

@section('content')
<div class="col-md-8">
	<div class="row">
		<div class="col-md-12"><h4 ><strong>Vidéos</strong></h4></div>
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
	</div>
	<div class="row">
		<div class="col-md-12"><h4 ><strong>Audios</strong></h4></div>
		@foreach($audios as $audio)
			<div class="col-md-4">
				<div class="col-md-12">
					<audio controls>
					  <source src="{{$audio->lien}}" type="audio/mpeg">
					</audio>
				</div>
				<div class=""><h5 class="medium-h5"><strong>{{$audio->titre}}</strong></h5></div>
			</div>
		@endforeach
		<div class="col-md-12">
			<div class="col-md-4">
			<iframe width="500" height="100" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/269233259&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>
			</div>
			<div class="12"><h5 class="medium-h5"><strong>{{$video->titre}}</strong></h5></div>


		</div>
	</div>
</div>
<div class="col-md-4">
	<div class=""><h4 ><strong>Derniers articles</strong></h4></div>
	<div class="col-md-12"  id="cadre-article">
		@foreach($articles as $article)
			<div class="col-md-12">
				<h5 class="text-justify"><strong><a href="{{route('guest.article',$article->slug)}}">{{$article->titre}}</a></strong></h5>
				<p class="text-justify">
				{{substr($article->contenu,0,100)}}..
				<a href="{{route('guest.article',$article->slug)}}" class="pull-right"><strong>Lire plus</strong></a>
				</p>
			</div>
		@endforeach
	</div>
</div>
@endsection