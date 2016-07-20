@extends('template')

@section('title',$engagement->intitule)

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h4><small>Promesse / <span class="text-capitalize">{{$engagement->categorie->type}}</span> / {{$engagement->categorie->designation}} / {{$engagement->secteur->nom}}</small></h4>
		</div>
		<div class="col-md-8">
			<div class="col-md-12" style="border-bottom:1px solid #cccccc; margin-bottom:10px">
				<h3><strong>{{$engagement->intitule}}</strong></h3>
				<p class="detail-info"><span class=" detail-info-title text-uppercase"><strong>Source :</strong></span> {{$engagement->source}}</p>
			</div>
			<div class="col-md-12">
				@if($engagement->description!=null)
					<p class="detail-description-txt">{{$engagement->description}}</p>
				@else
					<p class="detail-description-txt"><i>Aucune description actuelle</i></p>
				@endif
			</div>
			<div class="col-md-12">
				<div class="col-md-"> 
					@foreach($engagement->etats as $etat)
					<div class="col-md-12">
						<h4 class="etat-size-icon">
							<span class="label label-warning">
								<i class="fa {{$etat->img}} fa-1x" aria-hidden="true"></i> {{$etat->designation}}
							</span>
						</h4>
					</div>
						@foreach($commentaires as $commentaire)
							@if($commentaire->engagement_etat_id==$etat->pivot->id)
							<div class="col-md-12 ">
								{{--*/ $i=1 /*--}}
								<h4 class="txt-comment-titre">
									<strong>{{$commentaire->titre}}</strong>
								</h4>
								<p class="txt-comment-contenu">{{$commentaire->contenu}}</p>
								<br/>
							</div>
							@endif
						@endforeach
					@endforeach
				</div>
			</div>
			<div class="col-md-12">
				<br/>
				<p class="detail-info"><span class=" detail-info-title text-uppercase"><strong>Note :</strong>
				</span>@if($engagement->note!=null) {{$engagement->note}} @else <i>Aucune note</i> @endif</p>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="solidline"></div>
				</div>			
			</div>
			
			<div class="col-md-12">
				<div class="col-xs-2">
					<div class="fb-share-button" data-href="http://lahidi.org/detail-promesse/{{$engagement->slug}}" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Flahidi.org%2F&amp;src=sdkpreparse">Share</a></div>
				</div>
				<div class="col-xs-2">
					<a class="twitter-share-button"
					 
					  data-size="large"
					  data-url="http://lahidi.org/detail-promesse/{{$engagement->slug}}"
					  data-via="LahidiGn"
					  data-related="twitterapi,twitter"
					  data-hashtags="kibaro"
					  data-text="Votre message de partage">
					Partager
					</a>
				</div>
			</div>
			<div class="col-md-12">
				@include('guest.facebook')
			</div>
		</div>
		<div class="col-md-4">
			<div class="section-head-title"><h4 ><strong><i class="fa fa-newspaper-o" aria-hidden="true"></i> Actu des promesses</strong></h4></div>
			<div class="col-md-12"  id="cadre-rapport">
				@foreach($engagements as $engagementactu)
					<div class="col-md-12">
						<h5 class="text-justify text-warning">
						<b><a href="{{route('guest.article',$engagementactu->slug)}}">{{$engagementactu->intitule}}</a></b>
						</h5>
						<h5>
							@foreach($engagementactu->etats as $etat)
								<i class="fa {{$etat->img}} fa-2x text-info stateInbox pull-left" aria-hidden="true" title="{{$etat->designation}}"></i>
							@endforeach
						</h5>
						<p class="text-justify clear ">
						{{substr($engagementactu->description,0,100)}}..
						</p>
					</div>
				@endforeach
			</div>
		</div>
	</div>
	<div class="row">
		<br/>
		<div class="col-md-12">
		{{-- <script id="dsq-count-scr" src="//lahidiorg.disqus.com/count.js" async></script>
		@include('guest.disqus') --}}
		</div>
	</div>
@endsection