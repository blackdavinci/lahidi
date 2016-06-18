@extends('template-admin')
@section('header-title') 
	 Détail engagement
@endsection

@section('page-menu')
	<ul>
		<li>
			<h4 class="btn-action-menu">
				<a href="" class="btn btn-success" data-toggle="modal" data-target="#etatModal">Ajouter un verdict</a>
			</h4>
		</li>
		<li>
			<h4 class="btn-action-menu">
				<a href="" class="btn btn-warning" data-toggle="modal" data-target="#edittModal">Supprimer</a>
			</h4>
		</li>
		<li><h4 class="btn-action-menu"><a href="{{route('engagement.edit'))}}" class="btn btn-danger">Modifier</a></h4></li>
		<li>
			<h4 class="btn-action-menu">
				<a href="" class="btn btn-primary" data-toggle="modal" data-target="#addComment">Ajouter un commentaire</a>
			</h4>
		</li>
	</ul>
@endsection

@section('content')
	<div class="col-md-12 ">
		<div class="panel panel-default">
			<div class="panel-body tabs">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#fiche" data-toggle="tab">Fiche</a></li>
					<li><a href="#comments" data-toggle="tab">Commentaires</a></li>
				</ul>

				<div class="tab-content">
						<!-- Tableau de liste des engagements -->
						<div class="table-responsive">
						 {!! Form::open(['method' =>'POST','route' =>['engagement.importExcel'], 'files' => true]) !!}
							<table class="table table-nobordered table-nobordered-top" >
								<tbody>
									<tr><td><h4>Intitulé</h4></td></tr> <tr><td>{{$engagement->intitule}}</td></tr>
									
									<tr><td><h4>Description</h4></td></tr> 
									<tr>
										<td>
											@if($engagement->description==null) 
												<i>Aucune description</i>
											@else 
												{{$engagement->description}}
											@endif
										</td>
									</tr>
									<tr><td><h4>Catégorie</h4></td></tr> <tr><td>{{$engagement->categorie->designation}}</td></tr>
									<tr><td><h4>Secteur</h4></td></tr> <tr><td>{{$engagement->secteur->nom}}</td></tr>
									<tr><td><h4>Localité</h4></td></tr> 
									<tr>
										<td>
											@if($engagement->localite==null) 
												<i>Aucune localité</i>
											@else 
												{{$engagement->localite}}
											@endif
										</td>
									</tr><td><h4>Période de réalisation</h4></td></tr>
									<tr>
										<td>
											{{$engagement->date_debut}} 
											<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
											{{$engagement->date_fin}}
										</td>
									</tr>
									<tr><td><h4>Source</h4></td></tr> <tr><td>{{$engagement->source}}</td></tr>
									<tr><td><h4>Note</h4></td></tr> <tr><td>{{$engagement->note}}</td></tr>
									<tr><td>{!! Form::submit('Mettre à jour',['class'=>'btn btn-success'])!!}</td></tr>
									
								</tbody>
							</table>
						{!! Form::close() !!}
						</div>
					</div>
					<div class="tab-pane fade" id="comments">
						<h4>Tab 2</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget rutrum purus. Donec hendrerit ante ac metus sagittis elementum. Mauris feugiat nisl sit amet neque luctus, a tincidunt odio auctor. </p>
					</div>
				</div>
			</div>
		</div><!--/.panel-->
	</div>
@endsection