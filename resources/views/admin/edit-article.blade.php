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
						<div class="col-md-12">
						<div class="table-responsive">
						{!! Form::open(['method' =>'PUT','route' =>['pw-admin-article.update',$article->id]]) !!}
							<table class="table table-nobordered table-nobordered-top table-stripe" id="tablearticle">
								<tbody>
									<tr><td class="titlearticle"><h4>Type</h4></td></tr> 
									<tr><td class="dataarticle">{{$article->type}}</td></tr>
									<tr><td class="titlearticle"><h4>Titre</h4></td></tr> 
									<tr><td class="dataarticle">{{$article->titre}}</td></tr>
									<tr><td class="titlearticle"><h4>Description</h4></td></tr> 
									<tr><td class="dataarticle">{{$article->contenu}}</td></tr>
									<tr><td class="titlearticle"><h4>Lien</h4></td></tr> 
									<tr>
										<td class="dataarticle">
											@if($article->lien==null) 
												<i>Aucun lien</i>
											@else 
												{{$article->lien}}
											@endif
										</td>
									</tr>
									<tr><td class="titlearticle"><h4>Source</h4></td></tr> 
									<tr><td>{{$article->source}}</td></tr>
									<tr><td class="titlearticle"><h4>Note</h4></td></tr>
									 <tr><td class="dataarticle">{{$article->note}}</td></tr>
								</tbody>
							</table>
							{!! Form::close() !!}
						</div>
						</div>

					</div>

					<!-- TAB ETATS ENAGEMENT -->
					
			</div>
		</div><!--/.panel-->
	</div>
@endsection