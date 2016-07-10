@extends('template-admin')
@section('header-title') 
	Liste des secteurs
	<span class="label label-default pull-right">{{$nombre_secteur}}</span>
@endsection

@section('page-menu')
	<ul>
		<li><h4 class="btn-action-menu"><a href="" class="btn btn-danger">Supprimmer</a></h4></li>
		<li>
			<h4 class="btn-action-menu">
				<a href="" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Ajouter</a>
			</h4>
		</li>
	</ul>
@endsection

@section('content')
	<div class="col-md-12">

		<!-- Modal de d'ajout d'engagement -->
		<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		  {!! Form::open(['method' =>'POST','route' =>['pw-admin-secteur.store']]) !!}
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Nouveau secteur</h4>
		      </div>
		      <div class="modal-body">
		      <div class="row">
		      	<div class="col-md-12">
		      	  <div class="form-group">
		      	    <label for="intitule">Nom</label>
		      	   <input type="text" class="form-control" id="nom" placeholder="Nom du secteur" name="nom">
		      	  </div>
		      	  <div class="form-group">
		      	    <label for="note">Description</label>
		      	    <textarea name="description" class="form-control" id="description" placeholder="Description du secteur">
		      	    </textarea> 
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
		<!-- Tableau de liste des engagements -->
		<div class="table-responsive">
			<form>
				<table class="table table-striped table-bordered table-hover dataTables-c" id="secteurTable" width="100%" cellpadding="0">
					<thead>
						<tr>
							<th>
								<input  type="checkbox" name="layout" id="1" value="option" ng-model="allselect">
							</th>
							<th>Nom</th>
							<th>Description</th>
							<th>Code secteur</th>
							<th>Edit.</th>
							<th>Supp.</th>
						</tr>
					</thead>
					<tbody>
						@foreach($secteurs as $secteur)
						<tr>
							<td>
								<input  type="checkbox" name="layout" id="1" value=""  ng-checked="allselect">
							</td>
							<td  data-search="{{$secteur->nom}}">{{$secteur->nom}}</td>
							<td>{{$secteur->id}}</td>
							<td> @if($secteur->description==null)
								 <i>Aucune description</i>
								@else {{$secteur->description}} @endif
							</td>
							<td class="">
								<a href="" class="btn-action" data-toggle="modal" data-target="#editModal{{$secteur->id}}">
									<i class="fa fa-edit fa-1x" aria-hidden="true"></i>
								</a>
							</td>
							<td>
								<a href="" class="btn-action  @if($etat->id==23) disabled @endif" data-toggle="modal" data-target="#deleteModal{{$secteur->id}}">
									<i class="fa fa-trash fa-1x" aria-hidden="true"></i>
								</a>
							</td>
						</tr>
						<!-- Modal de confirmation de suppression d'engagement -->
						<div class="modal fade" id="deleteModal{{$secteur->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Suppression de secteur</h4>
						      </div>
						      <div class="modal-body">
						        Voulez-vous vraimment supprimer le secteur <strong>{{$secteur->nom}}</strong> ?
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
						        <div class="pull-right" style="margin-left:5px;">
							        {!! Form::open(['method' =>'delete','route' =>['pw-admin-secteur.destroy',$secteur->id]]) !!}
							        	<input type="hidden" name="action" value='suppression'/>
							        	{!! Form::submit('Supprimer',['class'=>'btn btn-danger'])!!}
							      	{!! Form::close() !!}
						      	</div>
						      </div>
						    </div>
						  </div>
						</div>

						<!-- Modal de modification d'appréciation -->
						<div class="modal fade" id="editModal{{$secteur->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						  {!! Form::open(['method' =>'PUT','route' =>['pw-admin-secteur.update',$secteur->id]]) !!}
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Modification de secteur</h4>
						      </div>
						      <div class="modal-body">
						      <div class="row">
						      <div class="col-md-12">
						        <div class="form-group">
						          <label for="intitule">Nom</label>
						         <input type="text" class="form-control" id="nom" placeholder="Nom du secteur" name="nom" 
						         value="{{$secteur->nom}}">
						        </div>
						        <div class="form-group">
						          <label for="note">Description</label>
						          <textarea name="description" class="form-control" id="description"  value="{{$secteur->description}}"></textarea> 
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
						@endforeach
					</tbody>
				</table>
			</form>
		</div>
	</div>
@endsection