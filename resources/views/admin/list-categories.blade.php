@extends('template-admin')
@section('header-title') 
	Liste des categories
	<span class="label label-default pull-right">{{$nombre_categorie}}</span>
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
		  {!! Form::open(['method' =>'POST','route' =>['pw-admin-categorie.store']]) !!}
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Nouvelle categorie</h4>
		      </div>
		      <div class="modal-body">
		      <div class="row">
		      	<div class="col-md-12">
			      	<div class="form-group">
			      	  <label for="type">Type</label>
			      	 	<select name="type" id="type" class="form-control" >
			      	 		<option value="Président">Président</option>
			      	 		<option value="Gouvernement">Gouvernement</option>
			      	 	</select>
			      	</div>
		      	  <div class="form-group">
		      	    <label for="intitule">Désignation</label>
		      	   <input type="text" class="form-control" id="designation" placeholder="Désignation de la catégorie" name="designation">
		      	  </div>
		      	  <div class="form-group">
		      	    <label for="note">Description</label>
		      	    <textarea name="description" class="form-control" id="description" placeholder="Description d la catégorie">
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
				<table class="table table-striped table-bordered table-hover dataTables-c" id="categorieTable" width="100%" cellpadding="0">
					<thead>
						<tr>
							<th>
								<input  type="checkbox" name="layout" id="1" value="option" ng-model="allselect">
							</th>
							<th>Type</th>
							<th>Désignation</th>
							<th>Code catégorie</th>
							<th>Description</th>
							<th >Edit.</th>
							<th>Supp.</th>
						</tr>
					</thead>
					<tbody>
						@foreach($categories as $categorie)
						<tr>
							<td>
								<input  type="checkbox" name="layout" id="1" value=""  ng-checked="allselect">
							</td>
							<td>@if($categorie->type=='Président')Président @else Gouvernement @endif</td>
							<td data-search="{{$categorie->designation}}">{{$categorie->designation}}</td>
							<td>{{$categorie->id}}</td>
							<td> @if($categorie->description==null)
								 <i>Aucune description</i>
								@else {{$categorie->description}} @endif
							</td>
							<td class="">
								<a href="" class="btn-action" data-toggle="modal" data-target="#editModal{{$categorie->id}}">
									<i class="fa fa-edit fa-1x" aria-hidden="true"></i>
								</a>
							</td>
							<td>
								<a href="" class="btn-action @if(Auth::user()->role!='amdin') disabled @endif" data-toggle="modal" data-target="#deleteModal{{$categorie->id}}">
									<i class="fa fa-trash fa-1x" aria-hidden="true"></i>
								</a>
							</td>
						</tr>
						<!-- Modal de confirmation de suppression d'engagement -->
						<div class="modal fade" id="deleteModal{{$categorie->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Suppression de categorie</h4>
						      </div>
						      <div class="modal-body">
						        Voulez-vous vraimment supprimer le categorie <strong>{{$categorie->designation}}</strong> ?
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
						        <div class="pull-right" style="margin-left:5px;">
							        {!! Form::open(['method' =>'delete','route' =>['pw-admin-categorie.destroy',$categorie->id]]) !!}
							        	<input type="hidden" name="action" value='suppression'/>
							        	{!! Form::submit('Supprimer',['class'=>'btn btn-danger'])!!}
							      	{!! Form::close() !!}
						      	</div>
						      </div>
						    </div>
						  </div>
						</div>

						<!-- Modal de modification d'appréciation -->
						<div class="modal fade" id="editModal{{$categorie->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						  {!! Form::open(['method' =>'PUT','route' =>['pw-admin-categorie.update',$categorie->id]]) !!}
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Modification de categorie</h4>
						      </div>
						      <div class="modal-body">
						      <div class="row">
						      <div class="col-md-12">
						      	<div class="form-group">
						      	  <label for="type">Type</label>
						      	 	<select name="type" id="type" class="form-control" >
						      	 		<option value="Président" @if($categorie->type=='Président') selected 
						      	 		@endif>Président</option>
						      	 		<option value="Gouvernement" @if($categorie->type=='Gouvernement') selected @endif>Gouvernement</option>
						      	 	</select>
						      	</div>
						        <div class="form-group">
						          <label for="intitule">Désignation</label>
						         <input type="text" class="form-control" id="designation" name="designation" 
						         value="{{$categorie->designation}}">
						        </div>
						        <div class="form-group">
						          <label for="note">Description</label>
						          <textarea name="description" class="form-control" id="description">{{$categorie->description}}</textarea> 
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
		</div>
	</div>
@endsection