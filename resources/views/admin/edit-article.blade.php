@extends('template-admin')
@section('header-title') 
	{{$article->titre}}
@endsection

@section('page-menu')
	<ul>
		<li><h4 class="btn-action-menu"><a href="{{route('pw-admin-article.show',$article->id)}}" class="btn btn-danger">Annuler</a></h4></li>
		
	</ul>
@endsection

@section('content')
	<div class="col-md-12 ">
		<div class="panel panel-default">
			<div class="panel-body tabs">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#article" data-toggle="tab" class="text-uppercase"><b>Modification article</b></a></li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane fade in active" id="article">
						<!-- Tableau d'information de l'article -->
						{!! Form::open(['method' =>'PUT','route' =>['pw-admin-article.update',$article->id],'files' => true]) !!}
							<div class="col-md-8">
								<div class="table-responsive">
									<table class="table table-nobordered table-nobordered-top table-stripe" id="tableEngagement">
										<tbody>
											<tr><td class="titleEngagement"><h4>Type</h4></td></tr> 
											<tr>
												<td class="dataEngagement text-capitalize">
													{{$article->type}}
													<input type="hidden" name="type" value="{{$article->type}}">
												</td>
											</tr>
											<tr><td class="titleEngagement"><h4>Titre</h4></td></tr> 
											<tr>
												<td class="dataEngagement">
													<input type="text" class="form-control" id="titre" 
													value="{{$article->titre}}" name="titre">
													
												</td>
											</tr>
											<tr><td class="titleEngagement"><h4>Description</h4></td></tr> 
											<tr>
												<td class="dataEngagement">
													<textarea name="contenu" class="form-control" id="contenu">{{$article->contenu}}</textarea> 
													
												</td>
											</tr>
											<tr>
											<td class="titleEngagement"><h4>Lien</h4></td></tr> 
											<tr>
												<td class="dataEngagement">
													<input type="text" id="lien" name="lien" class="form-control" value="{{$article->lien}}">
												</td>
											</tr>
											
										</tbody>
									</table>
								</div>
							</div>
							{{-- Fichiers joints --}}
							<div class="col-md-4">
								@if($article->type=="article")
									<div class="col-md-12">
										<div class="col-md-12"><h4 ><strong>Image</strong></h4></div>
										<div class="col-md-12">
											{!! Html::image('images/uploads/'.$article->image) !!}
										</div>
										<div class="col-md-12">
											<input type="file" id="image" name="image" class="form-control">
										</div>
										
									</div>
								@endif
								@if($article->type=="audio" )
									<div class="col-md-12">
										<div class="col-md-12">
											<h4 >
											<strong>
												Audio
												@if(strpos($article->lein,"mixcloud")==true)
													Mixcloud
												@else
													SoundCloud
												@endif
											</strong>
											</h4>
										</div>
										@if(strpos($article->lein,"mixcloud")==false)
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
								
								@if($article->type=="doc")
									<div class="col-md-12">
										<div class="col-md-12"><h4 ><strong>Rapports</strong></h4></div>
										<div class="col-md-12">
											
										</div>
										<div class="col-md-12">
											<input type="file" id="doc" name="doc" class="form-control">
										</div>
										
									</div>
								@endif

							</div>
							<div class="row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-success text-uppercase">Enregistrer</button>
								</div>
							</div>
							
						{!! Form::close() !!}
					</div>

					<!-- TAB ETATS ENAGEMENT -->
					<br/>
			</div>
		</div><!--/.panel-->
	</div>
@endsection