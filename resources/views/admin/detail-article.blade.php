@extends('template-admin')
@section('header-title') 
	{{$article->titre}}
@endsection

@section('page-menu')
	<ul>
		<li><h4 class="btn-action-menu"><a href="" class="btn btn-danger">Supprimmer</a></h4></li>
		<li>
			<h4 class="btn-action-menu">
				<a href="{{route('pw-admin-article.edit',$article->id)}}" class="btn btn-primary" >Modifier</a>
			</h4>
		</li>
	</ul>
@endsection

@section('content')
	<div class="col-md-12 ">
		<div class="panel panel-default">
			<div class="panel-body tabs">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#article" data-toggle="tab" class="text-uppercase"><b>Fiche article</b></a></li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane fade in active" id="article">
				
				
						<!-- Tableau d'information de l'article -->
						<div class="col-md-8">
							<div class="table-responsive">
								<table class="table table-nobordered table-nobordered-top table-striped" id="tableEngagement">
									<tbody>
										<tr><td class="titleEngagement"><h4>Type</h4></td></tr> 
										<tr><td class="dataEngagement text-capitalize">{{$article->type}}</td></tr>
										<tr><td class="titleEngagement"><h4>Titre</h4></td></tr> 
										<tr><td class="dataEngagement">{{$article->titre}}</td></tr>
										<tr><td class="titleEngagement"><h4>Description</h4></td></tr> 
										<tr><td class="dataEngagement">{{$article->contenu}}</td></tr>
										<tr><td class="titleEngagement"><h4>Lien</h4></td></tr> 
										<tr>
											<td class="dataEngagement">
												@if($article->lien==null) 
													<i>Aucun lien</i>
												@else 
													{{$article->lien}}
												@endif
											</td>
										</tr>
										
									</tbody>
								</table>
							</div>
						</div>
						{{-- Fichiers joints --}}
						<div class="col-md-4">
							@if(!empty($article->image))
								<div class="col-md-12">
									<div class="col-md-12"><h4 ><strong>Image</strong></h4></div>
									<div class="col-md-12">
									{!! Html::image('images/uploads/'.$article->image) !!}
									</div>
								</div>
							@endif
							@if($article->type=="video" && !empty($article->lien))
								<div class="col-md-12">
									<div class="col-md-12"><h4 ><strong>Vidéo</strong></h4></div>
									<div class="col-md-12">
										<div class="embed-responsive embed-responsive-4by3">
									    	<iframe class="embed-responsive-item" src="//www.youtube.com/embed/{{$article->lien}}"></iframe>
										</div>
									</div>
								</div>
							@endif
							@if($article->type=="audio")
								<div class="col-md-12">
									<div class="col-md-12">
										<h4 >
										<strong>
											Audio
											@if(strpos($article->lien,"mixcloud")==true)
												Mixcloud
											@else
												SoundCloud
											@endif
										</strong>
										</h4>
									</div>
									@if(strpos($article->lien,"mixcloud")==false)
										<div class="col-md-12">
											<iframe width="200" height="210" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/{{$article->audio}}&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>
										</div>
									@else
										<div class="col-md-12">
											<iframe width="100%" height="210" src="https://www.mixcloud.com/widget/iframe/?feed=https%3A%2F%2Fwww.mixcloud.com%2F{{$article->audio}}2F&light=1" frameborder="0"></iframe>
										</div>
									@endif

								</div>
							@endif
							@if(!empty($article->doc))
								<div class="col-md-12">
									<div class="col-md-12"><h4 ><strong>Rapports</strong></h4></div>

								</div>
							@endif

						</div>
					<br/>
					</div>

					<!-- TAB ETATS ENAGEMENT -->
					
			</div>
		</div><!--/.panel-->
	</div>
@endsection