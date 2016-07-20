@extends('template-admin')
@section('header-title') 
	 Modification d'engagement
@endsection
@section('page-menu')

<!-- Menu Fiche  -->
<div class="col-md-12 sub-menu">
	<ul>
		<li>
			<h4 class="btn-action-menu">
			<a href="{{route('pw-admin-engagement.show',$engagement->id)}}" class="btn btn-danger">Annuler</a>
			</h4>
		</li>
	</ul>
</div>

@endsection

@section('content')
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body tabs">
				<ul class="nav nav-tabs">
					<li class="active text-uppercase"><a href="#modification" data-toggle="tab"><b>Modification d'Engagement</b></a></li>
				</ul>
		
				<div class="tab-content">
					{{-- Tab Fiche Engagement --}}
					<div class="tab-pane fade in active" id="modification">
						<div class="row">
							<div class="col-md-12">
							<div class="table-responsive">
							{!! Form::open(['method' =>'PUT','route' =>['pw-admin-engagement.update',$engagement->id]]) !!}
							  <table class="table table-nobordered table-nobordered-top table-stripe" id="tableEngagement">
							    <tbody>
							      
							      <tr><td class="titleEngagement"><h4>Intitulé</h4></td></tr> 
							      <tr><td class="dataEngagement"><input type="text" class="form-control" id="intitule" name="intitule" value="{{$engagement->intitule}}"></td></tr>
							      <tr><td class="titleEngagement"><h4>Description</h4></td></tr> 
							      <tr>
							        <td class="dataEngagement">
							         	<textarea name="description" class="form-control" id="description" rows="5">{{$engagement->description}}</textarea>
							        </td>
							      </tr>
							      <tr><td class="titleEngagement"><h4>Catégorie</h4></td></tr>
							       <tr>
							       	<td class="dataEngagement text-success">
							       		<select name="categorie_id" id="secteur" class="form-control" >
							       			@foreach($categories as $categorie)
							       				<option value="{{$categorie->id}}" @if($engagement->categorie_id == $categorie->id) selected @endif>{{$categorie->designation}}</option>
							       			@endforeach	
							       		</select>
							       	</td>
							       </tr>
							      <tr><td class="titleEngagement"><h4>Secteur</h4></td></tr> 
							      <tr>
							      	<td class="dataEngagement">
							      		<select name="secteur_id" id="secteur" class="form-control" >
							      			@foreach($secteurs as $secteur)
							      				<option value="{{$secteur->id}}" @if($engagement->secteur_id == $secteur->id) selected @endif>{{$secteur->nom}}</option>
							      			@endforeach		
							      		</select>
							      	</td>
							      	</tr>
							      <tr><td class="titleEngagement"><h4>Localité</h4></td></tr> 
							      <tr>
							        <td class="dataEngagement"> 
							            <input type="text" class="form-control" id="localite" value="{{$engagement->localite}}" name="localite">
							        </td>
							      </tr><td class="titleEngagement"><h4>Période de réalisation</h4></td></tr>
							      <tr>
							        <td class="dataEngagement">
							          <div class="input-daterange input-group" id="datepicker">
							              <input type="text" class="input-sm form-control" name="date_debut" value="{{$engagement->date_debut}}"/>
							              <span class="input-group-addon">Au</span>
							              <input type="text" class="input-sm form-control" name="date_fin"  value="{{$engagement->date_fin}}"/>
							          </div>
							        </td>
							      </tr>
							      <tr><td class="titleEngagement"><h4>Source</h4></td></tr> 
							      <tr>
							      	<td>
							      		<input type="text" class="form-control" id="source" value="{{$engagement->source}}" name="source">
							      	</td>
							      </tr>
							      <tr><td class="titleEngagement"><h4>Note</h4></td></tr>
							       <tr>
							       	<td class="dataEngagement">
							       		<textarea name="note" class="form-control" id="note" >{{$engagement->note}}</textarea> 
							       	</td>
							       </tr>
							       <tr>
							       	<td>
							       		<button type="submit" class="btn btn-success text-uppercase">Enregistrer</button>
							       	</td>
							       </tr>
							    </tbody>
							  </table>
							  {!! Form::close() !!}
							</div>						

							</div>
						</div>
					</div>
					{{-- End Engagement --}}

					
				</div>
			</div>
		</div><!--/.panel-->
	</div>
@endsection