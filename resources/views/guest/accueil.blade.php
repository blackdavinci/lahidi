@extends('template')

@section('title','Accueil')

@section('content')
<!-- Line Breaker variables -->
{{--*/ $i=0; $j=0; $c=0; /*--}}
	<!-- Section Charts -->
	<div class="row">
		<div class="col-md-12">
			<div ng-controller="graphController as graph">
			<div class="row">
				<div class="col-md-4">
					<div class="col-md-12">
						<h4 class="text-upperscase text-center ">
							<span class="label label-theme">
								<b> Nombre de promesses : {{$nbre_engagements}}</b>
							</span>
						</h4>
					</div>
					<div class="box flyLeft">
						<div id="source"></div>
					</div>
					<h4 class="text-upperscase text-center ">
						<span class="label label-theme"><b>Promesses par source</b></span>
					</h4>
				</div>
				<div class="col-md-8" >
					 <div class="col-md-12 text-center">
				    	<a class="text-uppercase" href="" ng-click="graph.setTab(2)" ng-show="graph.isSet(1)">		<span class="label label-danger">Afficher par secteur</span>
				    	</a>
				    	<a class="text-uppercase " href="" ng-click="graph.setTab(1)" ng-show="graph.isSet(2)">
				    		<span class="label label-danger">Afficher par verdict</span>
				    	</a>
				    </div>
					<div class="col-md-12 box flyRight">
						<div id="etat" class="col-md-12 " ng-show="graph.isSet(1)"></div>
					    <div id="secteur" class="col-md-12 " ng-show="graph.isSet(2)"></div>
					 </div> <!-- /.col-md-4 --> 
					 <div class="col-md-12" style="border:1px solid red; marign-top:20px">
					     <h4 class="text-upperscase text-center" ng-show="graph.isSet(1)">
					     	<span class="label label-theme"><b>Promesses par verdict</b></span>
					     </h4>
					     <h4 class="text-upperscase text-center" ng-show="graph.isSet(2)">
					 		<span class="label label-theme"><b>Promesses par secteur</b></span>
					 	</h4>
					 </div>
				</div>
				</div>
				
			</div>
			</div>
		</div>

	<div class="row">
		<div class="col-md-12">
			<div class="solidline"></div>
		</div>			
	</div>
	<!-- Section Promesses -->
	
	<div class="row">
	
		<div class="col-md-8">
			<div class=""><h4 ><strong>Actualité des promesses</strong></h4></div>
			@foreach($engagements as $engagement)
				{{--*/ $i++ /*--}}
				<div class="col-md-12 ligne-engagement ">
					<a data-toggle="collapse" href="#comment{{$engagement->id}}" aria-expanded="false" aria-controls="collapseExample">
					<div class="col-md-12 cadre-engagement-home">
					
						<div class="col-md-12 type-engagement">
							<h5 class="text-uppercase pull-left"><strong>{{$engagement->categorie->designation}}</strong>
							</h5>
							<h5>
								@foreach($engagement->etats as $etat)
								<a href="#" data-toggle="tooltip" title="{{$etat->designation}}">
									<i class="fa {{$etat->img}} fa-1x text-info stateInbox pull-right" aria-hidden="true" title="{{$etat->designation}}"></i>
								</a>
								@endforeach
							</h5>
						</div>
						<div class="col-md-12 intitule-engagement">
							<p style="font-size:16px">{{$engagement->intitule}}</p>
						</div>
						<div class="col-md-12">
							<h5><span class="text-uppercase"><strong>Source :</strong></span> {{$engagement->source}}</h5>
						</div>
					
					</div>
					</a>
				</div>
		@endforeach
	</div>

	<div class="col-md-4">
		<div class=""><h4 ><strong>Twiiter LAHIDI</strong></h4></div>
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
	
	</div>
	<div class="row">
		<div class="col-md-12 text-center">
			<a href="{{route('guest.promesses')}}" class="btn btn-theme ">
				<span class="text-uppercase">Toutes les promesses</span>
			</a>
		</div>
	</div><!-- End Section -->
	
	<div class="row">
		<div class="col-md-12">
			<div class="solidline"></div>
		</div>			
	</div>

	<!-- Section Articles -->
	
	<div class="row">
	
		<div class="col-md-8">
			<div class=""><h4 ><strong>Derniers articles</strong></h4></div>
			@foreach($articles as $article)
				<div class="col-md-4">
					<div class="12">
						<img src="{{$article->image}}"
					</div>
					<div class="col-md-12">
						<h5 class="medium-h5 text-left">{{$article->titre}}</h5>
					</div>
				</div>
			@endforeach
	</div>

	<div class="col-md-4">
		<div class=""><h4 ><strong>Rapport MOSSEP</strong></h4></div>
		<div class="col-md-12"  id="cadre-article">
			@foreach($docs as $doc)
				<div class="col-md-12">
					<h5 class="text-justify">
						<strong><a href="{{route('guest.article',$doc->slug)}}">{{$doc->titre}}</a></strong>
					</h5>
					
				</div>
			@endforeach
		</div>
	</div>
	
	</div>
	<div class="row">
		<div class="col-md-12 text-center">
			<a href="{{route('guest.promesses')}}" class="btn btn-theme ">
				<span class="text-uppercase">Toutes les promesses</span>
			</a>
		</div>
	</div><!-- End Section -->
	
	<div class="row">
		<div class="col-md-12">
			<div class="solidline"></div>
		</div>			
	</div>
	
	<!-- Section Articles -->

	<div class="row">
		<div class="col-md-12">
			<div class=""><h4 class=""><strong>Mediathèque</strong></h4></div>
			<div class="row">
				<div class="col-md-12">
					<div class=""><h5 class="medium-h5"><strong>Vidéos</strong></h5></div>
					@foreach($videos as $video)
					<div class="col-md-3">
						<div class="12">
							<div class="embed-responsive embed-responsive-4by3">
						    	<iframe class="embed-responsive-item" src="//www.youtube.com/embed/{{$video->lien}}"></iframe>
							</div>
						</div>
						<div class="col-md-12">
							<h5 class="medium-h5 text-left">{{$video->titre}}</h5>
						</div>
					</div>
					@endforeach
					<div class="row">
						<div class="col-md-12">
							<div class="solidline"></div>
						</div>			
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class=""><h5 class=""><strong>Audios</strong></h5></div>
					@foreach($audios as $audio)
					<div class="col-md-3">
						<div class="12">
							<div class="embed-responsive embed-responsive-4by3">
						    	<iframe class="embed-responsive-item" src="//www.youtube.com/embed/{{$audio->lien}}"></iframe>
							</div>
						</div>
						<div class="col-md-12">
							<h5 class="medium-h5 text-left">{{$audio->titre}}</h5>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 text-center">
			<a href="{{route('guest.promesses')}}" class="btn btn-theme ">
				<span class="text-uppercase ">Tous les médias</span>
			</a>
		</div>
	</div><!-- End Section -->

	<div class="row">
		<div>
			<div class="solidline"></div>
		</div>				
	</div>

	<!-- Section Mediathèque -->

	

@endsection

@section('content-bottom')
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-4">
				<div class="box flyLeft">
					<img src="images/parteners/ablogui.jpg" height="120" />
				</div>
			</div>
			<div class="col-md-4">
				<div class="box flyIn">
					<img src="images/parteners/osiwa.png" height="100" />
				</div>
			</div>
			<div class="col-md-4">
				<div class="box flyRight">
					<img src="images/parteners/ablogui.jpg" height="120" class="pull-right" />
				</div>
			</div>
			
		</div>
	</div>
@endsection