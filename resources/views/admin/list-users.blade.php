@extends('template-admin')
@section('header-title') 
	Liste des utilisateur
	<span class="label label-default pull-right">{{$nombre_user}}</span>
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
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Nouveau utilisateur</h4>
		      </div>
		      <div class="modal-body">
		      <div class="row">
		      	<div class="col-md-12">
		      		<form class="form-horizontal" role="form" method="POST" action="{{route('pw-admin-user.store')}}">
		      		    {{ csrf_field() }}

		      		    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		      		        <label class="col-md-4 control-label">Nom & Prénom(s)</label>

		      		        <div class="col-md-6">
		      		            <input type="text" class="form-control" name="name" value="{{ old('name') }}">

		      		            @if ($errors->has('name'))
		      		                <span class="help-block">
		      		                    <strong>{{ $errors->first('name') }}</strong>
		      		                </span>
		      		            @endif
		      		        </div>
		      		    </div>

		      		    <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
		      		        <label class="col-md-4 control-label">Rôle</label>

		      		        <div class="col-md-6">
		      		            <select name="role" class="form-control">
		      		            	<option value="admin">Administrateur</option>
		      		            	<option value="collect" selected>Collecteur</option>
		      		            </select>

		      		            @if ($errors->has('role'))
		      		                <span class="help-block">
		      		                    <strong>{{ $errors->first('role') }}</strong>
		      		                </span>
		      		            @endif
		      		        </div>
		      		    </div>

		      		    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		      		        <label class="col-md-4 control-label">E-Mail</label>

		      		        <div class="col-md-6">
		      		            <input type="email" class="form-control" name="email" value="{{ old('email') }}">

		      		            @if ($errors->has('email'))
		      		                <span class="help-block">
		      		                    <strong>{{ $errors->first('email') }}</strong>
		      		                </span>
		      		            @endif
		      		        </div>
		      		    </div>

		      		    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
		      		        <label class="col-md-4 control-label">Mot de passe</label>

		      		        <div class="col-md-6">
		      		            <input type="password" class="form-control" name="password">

		      		            @if ($errors->has('password'))
		      		                <span class="help-block">
		      		                    <strong>{{ $errors->first('password') }}</strong>
		      		                </span>
		      		            @endif
		      		        </div>
		      		    </div>

		      		    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
		      		        <label class="col-md-4 control-label">Confirmer Mot de passe</label>

		      		        <div class="col-md-6">
		      		            <input type="password" class="form-control" name="password_confirmation">

		      		            @if ($errors->has('password_confirmation'))
		      		                <span class="help-block">
		      		                    <strong>{{ $errors->first('password_confirmation') }}</strong>
		      		                </span>
		      		            @endif
		      		        </div>
		      		    </div>

		      		    <div class="form-group">
		      		        <div class="col-md-6 col-md-offset-4">
		      		            <button type="submit" class="btn btn-success">
		      		                Enregister
		      		            </button>
		      		        </div>
		      		    </div>
		      		</form>		      	 
		      	</div>  
			  </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
		        <div class="pull-right" style="margin-left:5px;">
		      	</div>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- Tableau de liste des engagements -->
		<div class="table-responsiv">
			<form>
				<table class="table table-striped table-bordered table-hover dataTables-c" id="userTable" width="100%" cellpadding="0">
					<thead>
						<tr>
							<th>
								<input  type="checkbox" name="layout" id="1" value="option" ng-model="allselect">
							</th>
							<th>Nom & Prénom(s)</th>
							<th>Identifiant</th>
							<th>Rôle</th>
							<th>Etat</th>
							<th >Edit.</th>
							<th>Supp.</th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $user)
						<tr>
							<td>
								<input  type="checkbox" name="layout" id="1" value=""  ng-checked="allselect">
							</td>
							<td data-search="{{$user->name}}">{{$user->name}}</td>
							<td>{{$user->email}}</td>
							<td> @if($user->role=='admin')
								 <i>Administrateur</i>
								@else 
									<i>Collecteur</i>
								@endif
							</td>
							<td>
								@if($user->active==1)
									<i>Actif</i>
								@else
									<i>Non actif</i>
								@endif
							</td>
							<td class="">
								<a href="" class="btn-action" data-toggle="modal" data-target="#editModal{{$user->id}}">
									<i class="fa fa-edit fa-1x" aria-hidden="true"></i>
								</a>
							</td>
							<td>
								<a href="" class="btn-action" data-toggle="modal" data-target="#deleteModal{{$user->id}}">
									<i class="fa fa-trash fa-1x" aria-hidden="true"></i>
								</a>
							</td>
						</tr>
						<!-- Modal de confirmation de suppression d'engagement -->
						<div class="modal fade" id="deleteModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Suppression de user</h4>
						      </div>
						      <div class="modal-body">
						        Voulez-vous vraimment supprimer le user <strong>{{$user->designation}}</strong> ?
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
						        <div class="pull-right" style="margin-left:5px;">
							        {!! Form::open(['method' =>'delete','route' =>['pw-admin-user.destroy',$user->id]]) !!}
							        	<input type="hidden" name="action" value='suppression'/>
							        	{!! Form::submit('Supprimer',['class'=>'btn btn-danger'])!!}
							      	{!! Form::close() !!}
						      	</div>
						      </div>
						    </div>
						  </div>
						</div>

						
						@endforeach
					</tbody>
				</table>
			</form>
		</div>
	</div>
@endsection