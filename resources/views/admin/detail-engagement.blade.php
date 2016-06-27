@extends('template-admin')
@section('header-title') 
	 Détail engagement
@endsection
@section('page-menu')

<!-- Menu Fiche  -->
<div class="col-md-12 sub-menu">
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
		<li><h4 class="btn-action-menu"><a href="{{route('engagement.edit',$engagement->id)}}" class="btn btn-danger" id="edit-btn">Modifier</a></h4></li>
		
	</ul>
</div>

@endsection
@section('content')
	<div class="col-md-12 ">
		<div class="panel panel-default">
			<div class="panel-body tabs">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#fiche" data-toggle="tab" class="text-uppercase"><b>Fiche engagement</b></a></li>
					<li><a href="#etats" data-toggle="tab" class="text-uppercase"><b>Etats </b> <span class="badge">{{$engagement->etats_count}}</span</a></li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane fade in active" id="fiche">
					
						<!-- Modal d'ajout d'etat -->
						<div class="modal fade" id="etatModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						  {!! Form::open(['method' =>'POST','route' =>['engagement.etat',$engagement->id]]) !!}
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Nouvel etat</h4>
						      </div>
						      <div class="modal-body">
						      <div class="row">
						      	<div class="col-md-12">
						      	<div class="form-group">
						      	  <label for="etat">Etat</label>
						      	 	<select name="etat_id" id="etat" class="form-control" >
						      	 		<option value="0">Aucun</option>
						      	 		@foreach($etats as $etat)
						      	 			<option value="{{$etat->id}}" @foreach($engagement->etats as $etats)@if($etat->id==$etats->id) disabled class="text-danger" @endif @endforeach>
						      	 			{{$etat->designation}}
						      	 			</option>
						      	 		@endforeach		
						      	 	</select>
						      	</div>
						      	  <div class="form-group">
						      	    <label for="titre">Titre commentaire</label>
						      	   <input type="text" class="form-control" id="titre" placeholder="Titre du commenatire" name="titre_commentaire">
						      	  </div>
						      	  <div class="form-group">
						      	    <label for="commentaire">Commentaire</label>
						      	    <textarea name="commentaire" class="form-control" id="commentaire" placeholder="Commentaire de l'état"></textarea> 
						      	  </div>
						      	</div>  
							  </div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
						        <div class="pull-right" style="margin-left:5px;">
							        {!! Form::submit('Ajouter',['class'=>'btn btn-success'])!!}
						      	</div>
						      </div>
						    </div>
						    {!! Form::close() !!}
						  </div>
						</div>

						<!-- Tableau d'information de l'engagement -->
						<div class="col-md-12">
						<div class="table-responsive">
						{!! Form::open(['method' =>'PUT','route' =>['engagement.update',$engagement->id]]) !!}
							<table class="table table-nobordered table-nobordered-top table-stripe" id="tableEngagement">
								<tbody>
									
									<tr><td class="titleEngagement"><h4>Intitulé</h4></td></tr> 
									<tr><td class="dataEngagement">{{$engagement->intitule}}</td></tr>
									<tr><td class="titleEngagement"><h4>Description</h4></td></tr> 
									<tr>
										<td class="dataEngagement">
											@if($engagement->description==null) 
												<i>Aucune description</i>
											@else 
												{{$engagement->description}}
											@endif
										</td>
									</tr>
									<tr><td class="titleEngagement"><h4>Catégorie</h4></td></tr>
									 <tr><td class="dataEngagement text-success">{{$engagement->categorie->designation}}</td></tr>
									<tr><td class="titleEngagement"><h4>Secteur</h4></td></tr> 
									<tr><td class="dataEngagement">{{$engagement->secteur->nom}}</td></tr>
									<tr><td class="titleEngagement"><h4>Localité</h4></td></tr> 
									<tr>
										<td class="dataEngagement">
											@if($engagement->localite==null) 
												<i>Aucune localité</i>
											@else 
												{{$engagement->localite}}
											@endif
										</td>
									</tr><td class="titleEngagement"><h4>Période de réalisation</h4></td></tr>
									<tr>
										<td class="dataEngagement">
											{{$engagement->date_debut}} 
											<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
											{{$engagement->date_fin}}
										</td>
									</tr>
									<tr><td class="titleEngagement"><h4>Source</h4></td></tr> 
									<tr><td>{{$engagement->source}}</td></tr>
									<tr><td class="titleEngagement"><h4>Note</h4></td></tr>
									 <tr><td class="dataEngagement">{{$engagement->note}}</td></tr>
								</tbody>
							</table>
							{!! Form::close() !!}
						</div>
						</div>

					</div>

					<!-- TAB ETATS ENAGEMENT -->
					<div class="tab-pane fade" id="etats">
						<!-- Tableau d'information des etats de l'engagement -->
						<div class="col-md-12">
						@foreach($engagement->etats as $etat)
						<div class="row">
							<div class="col-md-6">
								<a data-toggle="collapse" href="#collapseExample{{$etat->id}}" aria-expanded="false" aria-controls="collapseExample">
								  <h4 >
								  	<span class="label label-primary">
									  	{{$etat->designation}}
									  	<i class="fa {{$etat->img}} fa-1x" aria-hidden="true"></i>
									</span>
								  </h4>
								</a>
							</div>
							<div class="col-md-2">
								<a href="#" data-toggle="modal" data-target="#addComment{{$etat->pivot->id}}">
						 			<i class="fa fa-commenting fa-1x" aria-hidden="true"></i>
						 		</a>
							</div>
							
							<div class="col-md-2">
								<a href="#" data-toggle="modal" data-target="#deleteComment{{$etat->id}}">
						 			<i class="fa fa-trash fa-1x" aria-hidden="true"></i>
						 		</a>
							</div>
						</div>
						
						<div class="row">
							<div class=" col-md-12 collapse" id="collapseExample{{$etat->id}}">
							  <div class="well">
							    @foreach($commentaires as $commentaire)
							    	@if($commentaire->engagement_etat_id == $etat->pivot->id)
							    	<div class="row">
								    	<div class="col-md-6">
								    		<h4>{{$commentaire->titre}}</h4>
								    	</div>
								    	<div class="col-md-2">
											<a href="#" data-toggle="modal" data-target="#editComment{{$commentaire->id}}">
									 			<i class="fa fa-pencil fa-1x" aria-hidden="true"></i>
									 		</a>
										</div>
										<div class="col-md-2">
											<a href="#" data-toggle="modal" data-target="#deleteComment{{$commentaire->id}}">
									 			<i class="fa fa-trash fa-1x" aria-hidden="true"></i>
									 		</a>
										</div>
							    	</div>
							    	<div class="row">
								    	<div class="col-md-12">
								    		<p>{{$commentaire->contenu}}</p>
								    	</div>
							    	</div>
							    	<!-- Modal d'ajout d'etat -->
							    	<div class="modal fade" id="editComment{{$commentaire->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							    	  <div class="modal-dialog">
							    	  {!! Form::open(['method' =>'PUT','route' =>['commentaire.update',$commentaire->id]]) !!}
							    	  	
							    	    <div class="modal-content">
							    	      <div class="modal-header">
							    	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							    	        <h4 class="modal-title" id="myModalLabel">Modification commentaire {{$commentaire->id}}</h4>
							    	      </div>
							    	      <div class="modal-body">
							    	      <div class="row">
							    	      	<div class="col-md-12">
							    	      	  <div class="form-group">
							    	      	    <label for="titre">Titre commentaire</label>
							    	      	   <input type="text" class="form-control" id="titre" value="{{$commentaire->titre}}" name="titre">
							    	      	  </div>
							    	      	  <div class="form-group">
							    	      	    <label for="contenu">Commentaire</label>
							    	      	    <textarea name="contenu" class="form-control" id="contenu">{{$commentaire->contenu}}</textarea> 
							    	      	  </div>
							    	      	</div>  
							    		  </div>
							    	      </div>
							    	      <div class="modal-footer">
							    	        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
							    	        <div class="pull-right" style="margin-left:5px;">
							    		        {!! Form::submit('Enregistrer',['class'=>'btn btn-success'])!!}
							    	      	</div>
							    	      </div>
							    	    </div>
							    	    {!! Form::close() !!}
							    	  </div>
							    	</div>
							    	@endif
							    @endforeach
							  </div>
							</div>
						</div>

						<!-- Modal d'ajout d'etat -->
						<div class="modal fade" id="addComment{{$etat->pivot->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						  {!! Form::open(['method' =>'POST','route' =>['commentaire.store']]) !!}
						  	{!!Form::hidden('engagement_etat_id',$etat->pivot->id)!!}
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Nouveau commentaire</h4>
						      </div>
						      <div class="modal-body">
						      <div class="row">
						      	<div class="col-md-12">
						      	<div class="form-group">
						      	  <label for="etat">Etat</label>
						      	 	<input type="text" class="form-control" value="{{$etat->designation}}" disabled>	
						      	</div>
						      	  <div class="form-group">
						      	    <label for="titre">Titre commentaire</label>
						      	   <input type="text" class="form-control" id="titre" placeholder="Titre du commenatire" name="titre">
						      	  </div>
						      	  <div class="form-group">
						      	    <label for="contenu">Commentaire</label>
						      	    <textarea name="contenu" class="form-control" id="contenu" placeholder="Commentaire de l'état"></textarea> 
						      	  </div>
						      	</div>  
							  </div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
						        <div class="pull-right" style="margin-left:5px;">
							        {!! Form::submit('Ajouter',['class'=>'btn btn-success'])!!}
						      	</div>
						      </div>
						    </div>
						    {!! Form::close() !!}
						  </div>
						</div>
						@endforeach
						</div>
					</div>
				</div>
			</div>
		</div><!--/.panel-->
	</div>
@endsection