@extends('template-admin')
@section('header-title') 
	Liste des etats 
	<span class="label label-default pull-right">{{$nombre_etat}}</span>
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
	@include('errors.required-errors')

		<!-- Modal de d'ajout d'engagement -->
		<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		  {!! Form::open(['method' =>'POST','route' =>['etat.store']]) !!}
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Nouvel etat</h4>
		      </div>
		      <div class="modal-body">
		      <div class="row">
		      	<div class="col-md-12">
		      	  <div class="form-group">
		      	    <label for="designation">Désignation</label>
		      	   <input type="text" class="form-control" id="designation" placeholder="Désignation de l'etat" name="designation">
		      	  </div>
		      	  <div class="form-group">
		      	    <label for="img">Visuel de l'état</label>
		      	   <input type="text" class="form-control" id="img" placeholder="Visuel de l'etat" name="img">
		      	  </div>
		      	  <div class="form-group">
		      	    <label for="note">Description</label>
		      	    <textarea name="description" class="form-control" id="description" placeholder="Description de l'etat">
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
		<div class="table-responsiv">
			<form>
				<table class="table table-striped table-bordered table-hover dataTables-c" id="categorieTable" width="100%" cellpadding="0">
					<thead>
						<tr>
							<th>
								<input  type="checkbox" name="layout" id="1" value="option" ng-model="allselect">
							</th>
							<th>Désignation</th>
							<th>Visuel</th>
							<th>Description</th>
							<th>Edit.</th>
							<th>Supp.</th>
						</tr>
					</thead>
					<tbody>
						@foreach($etats as $etat)
						<tr>
							<td>
								<input  type="checkbox" name="layout" id="1" value=""  ng-checked="allselect">
							</td>
							<td data-search="{{$etat->designation}}">{{$etat->designation}}</td>
							<td align="center"><i class="fa {{$etat->img}}" aria-hidden="true"></i></td>
							<td> @if($etat->description==null)
								 <i>Aucune description</i>
								@else {{$etat->description}} @endif
							</td>
							<td class="">
								<a href="" class="btn-action" data-toggle="modal" data-target="#editModal{{$etat->id}}">
									<i class="fa fa-edit fa-1x" aria-hidden="true"></i>
								</a>
							</td>
							<td>
								<a href="" class="btn-action" data-toggle="modal" data-target="#deleteModal{{$etat->id}}">
									<i class="fa fa-trash fa-1x" aria-hidden="true"></i>
								</a>
							</td>
						</tr>
						<!-- Modal de confirmation de suppression d'engagement -->
						<div class="modal fade" id="deleteModal{{$etat->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Suppression de l'état</h4>
						      </div>
						      <div class="modal-body">
						        Voulez-vous vraimment supprimer l'état <strong>{{$etat->designation}}</strong> ?
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
						        <div class="pull-right" style="margin-left:5px;">
							        {!! Form::open(['method' =>'delete','route' =>['etat.destroy',$etat->id]]) !!}
							        	<input type="hidden" name="action" value='suppression'/>
							        	{!! Form::submit('Supprimer',['class'=>'btn btn-danger'])!!}
							      	{!! Form::close() !!}
						      	</div>
						      </div>
						    </div>
						  </div>
						</div>

						<!-- Modal de modification d'appréciation -->
						<div class="modal fade" id="editModal{{$etat->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						  {!! Form::open(['method' =>'PUT','route' =>['etat.update',$etat->id]]) !!}
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Modification de l'état</h4>
						      </div>
						      <div class="modal-body">
						      <div class="row">
						      <div class="col-md-12">
						        <div class="form-group">
						          <label for="designation">Désignation</label>
						         <input type="text" class="form-control" id="designation" name="designation" 
						         value="{{$etat->designation}}">
						        </div>
						        <div class="form-group">
						          <label for="designation">Visuel de l'état</label>
						         <input type="text" class="form-control" id="img" name="img" value="{{$etat->img}}">
						        </div>
						        <div class="form-group">
						          <label for="note">Description</label>
						          <textarea name="description" class="form-control" id="description" value="{{$etat->description}}"></textarea> 
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