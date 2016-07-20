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
				<div class="col-md-12 text-center hidden-xs" id="chrono">	
					<div class="col-md-12"><h4><strong>Fin de mandat dans</strong></h4></div>
					<div class="col-md-6 col-md-offset-3 " >
						<script type="application/javascript">

						var myCountdownTest = new Countdown({
							year: 2020,
							month	: 0, 
							day		: 0,
							width	: 500, 
							height	: 70,
							numbers		: 	{
								font 	: "Open Sans, sans-serif",
								color	: "#d9534f",
								bkgd	: "#FFFFFF",
								fontSize : 200,
								rounded	: 0.15,				// percentage of size 
								
								},
							labels	:	{
                             	font  	: "Open Sans, sans-serif",
	                            color 	: "#000000",
	                            offset : 0, // Number of pixels to push the labels down away from numbers. 
	                            textScale 	: 1, // Percentage of size
	                            weight	: "bold"	// < - no comma on last item!
                         },
							hideLine	: true								
														 	
						});



						</script>
					</div>
					<br/>
					{{--*/ /*--}}
				</div>
			</div>
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
					 <div class="col-md-12">
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
			<div id="test" class="col-md-12 " ></div>

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
					<a  data-toggle="collapse" href="#comment{{$engagement->id}}" aria-expanded="false" aria-controls="collapseExample" >
					<div class="col-md-12 cadre-engagement-home">
					<div class="row">
						<div class="col-md-12 type-engagement">
							<h5 class="text-uppercase pull-left"><strong>{{$engagement->categorie->designation}}</strong>
							</h5>
							<h5>
								@foreach($engagement->etats as $etat)
								
								<i class="fa {{$etat->img}} fa-1x text-info stateInbox pull-right" aria-hidden="true" title="{{$etat->designation}}"></i>
								
								@endforeach
							</h5>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 intitule-engagement">
							<p style="font-size:16px">{{$engagement->intitule}}</p>
						</div>
						<div class="col-md-12">
							<h5><span class="text-uppercase"><strong>Source :</strong></span> {{$engagement->source}}</h5>
						</div>
					</div>
					</div>
					</a>
				</div>
				<div class="row ligne-commentaire collapse"  id="comment{{$engagement->id}}">
					<div class="col-md-7 col-md-offset-1 ">
					<div class="col-md-12 cadre-commentaire"> 
						@foreach($engagement->etats as $etat)
						<div class="col-md-12">
							<h4>
								<span class="label label-info">
									<i class="fa {{$etat->img}} fa-1x" aria-hidden="true"></i> {{$etat->designation}}
								</span>
							</h4>
						</div>
							@foreach($commentaires as $commentaire)
								@if($commentaire->engagement_etat_id==$etat->pivot->id)
								<div class="col-md-12 ">
									{{--*/ $i=1 /*--}}
									<h4>
										{{$commentaire->titre}}
									</h4>
									<p>{{$commentaire->contenu}}</p>
								</div>
								@endif
							@endforeach
						@endforeach
							<div class="col-md-12 btn-ligne-detail">
								<p>
									<a href="{{route('guest.engagementDetail',$engagement->slug)}}" class="btn btn-danger" role="button" >En savoir plus &raquo;</a>
								</p>
							</div>
						</div>
					</div>
				</div>
		@endforeach
	</div>

	<div class="col-md-4" id="cadre-tweet">
		<div class=""><h4 ><strong>Sur Twitter </strong></h4></div>
		<div class="col-md-12"  id="ligne-tweet">
			<a class="twitter-timeline"  href="https://twitter.com/hashtag/LAHIDI" data-widget-id="748512020505497600">Tweets sur #LAHIDI</a>
			            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
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
		<div class="col-md-4">
			<div class="section-head-title"><h4 ><strong><i class="fa fa-file-pdf-o" aria-hidden="true"></i>Documents et  Rapports MOSSEP</strong></h4></div>
			<div class="col-md-12"  id="cadre-rapport">
				@foreach($docs as $doc)
					<div class="col-md-12">
						<h5 class="text-justify">
						<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
						<strong><a href="{{route('guest.article',$doc->slug)}}">{{$doc->titre}}</a></strong>
						</h5>
						<p class="text-justify">
						{{substr($doc->contenu,0,100)}}..
						<a href="{{route('guest.article',$doc->slug)}}" class="pull-right"><strong>Lire plus</strong></a>
						</p>
					</div>
				@endforeach
			</div>
			{{--*/ var_dump(__DIR__)/*--}}
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="solidline"></div>
		</div>			
	</div>
	<div class="row">
		<div class="col-md-12 aligncenter">
			<h3 class="title">What people <strong>saying</strong> about us</h3>
			<div class="blankline30"></div>

			<ul class="bxslider">
				<li>
					<blockquote>
						Aliquam a orci quis nisi sagittis sagittis. Etiam adipiscing, justo quis feugiat.Suspendisse eu erat quam. Vivamus porttitor eros quis nisi lacinia sed interdum lorem vulputate. Aliquam a orci quis nisi sagittis sagittis. Etiam adipiscing, justo quis feugiat
					</blockquote>
					<div class="testimonial-autor">
						<img src="img/dummies/testimonial/1.png" alt="" />
						<h4>Hillary Doe</h4>
						<a href="#">www.companyname.com</a>
					</div>
				</li>
				<li>
					<blockquote>
						Aliquam a orci quis nisi sagittis sagittis. Etiam adipiscing, justo quis feugiat.Suspendisse eu erat quam. Vivamus porttitor eros quis nisi lacinia sed interdum lorem vulputate. Aliquam a orci quis nisi sagittis sagittis. Etiam adipiscing, justo quis feugiat
					</blockquote>
					<div class="testimonial-autor">
						<img src="img/dummies/testimonial/2.png" alt="" />
						<h4>Michael Doe</h4>
						<a href="#">www.companyname.com</a>
					</div>
				</li>
				<li>
					<blockquote>
						Aliquam a orci quis nisi sagittis sagittis. Etiam adipiscing, justo quis feugiat.Suspendisse eu erat quam. Vivamus porttitor eros quis nisi lacinia sed interdum lorem vulputate. Aliquam a orci quis nisi sagittis sagittis. Etiam adipiscing, justo quis feugiat
					</blockquote>
					<div class="testimonial-autor">
						<img src="img/dummies/testimonial/3.png" alt="" />
						<h4>Mark Donovan</h4>
						<a href="#">www.companyname.com</a>
					</div>
				</li>
				<li>
					<blockquote>
						Aliquam a orci quis nisi sagittis sagittis. Etiam adipiscing, justo quis feugiat.Suspendisse eu erat quam. Vivamus porttitor eros quis nisi lacinia sed interdum lorem vulputate. Aliquam a orci quis nisi sagittis sagittis. Etiam adipiscing, justo quis feugiat
					</blockquote>
					<div class="testimonial-autor">
						<img src="img/dummies/testimonial/4.png" alt="" />
						<h4>Marry Doe Elliot</h4>
						<a href="#">www.companyname.com</a>
					</div>
				</li>
			</ul>

		</div>	
		
	</div>

	<!-- End Section -->
	
	<div class="row">
		<div class="col-md-12">
			<div class="solidline"></div>
		</div>			
	</div>
	
	
	<!-- Section Mediathèque -->

	<div class="row">
		<div class="col-md-12">
			<div class=""><h4 class=""><strong>Mediathèque</strong></h4></div>
			@if(count($videos)!=0)
			<div class="row">
				<div class="col-md-12">
					<div class=""><h5 class="medium-h5"><strong>Vidéos</strong></h5></div>
					@foreach($videos as $video)
					<div class="col-md-3">
						<div class="12">
							<div class="embed-responsive embed-responsive-4by3">
						    	<iframe class="embed-responsive-item" src="//www.youtube.com/embed/{{$video->video}}"></iframe>
							</div>
						</div>
						<div class="col-md-12">
							<h5 class="medium-h5 text-left">{{$video->titre}}</h5>
						</div>
					</div>
					@endforeach
				</div>
			</div>
			@endif
			@if(count($audios)!=0)
			<div class="row">
				<div class="col-md-12">
					<div class=""><h5 class=""><strong>Audios</strong></h5></div>
					@foreach($audios as $audio)
					<div class="col-md-3">
						<div class="12">
							@if(strpos($audio->lien,"mixcloud")==false)
									<iframe width="100%" height="210" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/{{$audio->audio}}&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>
								
							@else
								
									<iframe width="100%" height="210" src="https://www.mixcloud.com/widget/iframe/?feed=https%3A%2F%2Fwww.mixcloud.com%2F{{$audio->audio}}2F&light=1" frameborder="0"></iframe>
								
							@endif
						</div>
						<div class="col-md-12">
							<h5 class="medium-h5 text-left">{{$audio->titre}}</h5>
						</div>
					</div>
					@endforeach
				</div>
			</div>
			@endif
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 text-center">
			<a href="{{route('guest.media')}}" class="btn btn-theme ">
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
			<div class="col-md-2">
				<div class=" box flyLeft">
					<img src="images/parteners/ablogui.jpg" height="60" class="pull-left" />
					<h5 class="text-uppercase"><strong>Association <br/>des Blogueurs <br/> de Guinée</strong></h5>
				</div>
			</div>
			<div class="col-md-2">
				<div class="box flyLeft">
					<img src="images/parteners/lm.jpg" height="80" class="pull-left" />
				</div>
			</div>
			<div class="col-md-2">
				<div class="box flyLeft">
					<img src="images/parteners/mossep.jpg" height="90" class="pull-left" />
				</div>
			</div>
			<div class="col-md-2">
				<div class="box flyRight">
					<img src="images/parteners/ccb.jpg" height="90" class="pull-left" />
				</div>
			</div>
			<div class="col-md-2">
				<div class="box flyRight">
					<img src="images/parteners/lejepad.jpg" height="90" class="pull-left" />
				</div>
			</div>
			<div class="col-md-2">
				<div class="box flyRight" style="padding-top:15px">
					<img src="images/parteners/osiwa.png" height="50" class="pull-left" />
				</div>
			</div>
			
		</div>
	</div>
@endsection