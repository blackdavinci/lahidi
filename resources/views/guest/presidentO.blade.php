@extends('template-guest')

@section('title','Promesses du président')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h2>Promesses du Président</h2>
		</div>
		<div class="col-md-12">
			<form class="form-inline">
			  <div class="form-group col-md-2">
			    <label class="sr-only" for="exampleInputEmail3">Catégorie</label>
			    <select name="categorie" id="categorie" class="form-control" >
			    	<option value="">Aucun</option>
			    	@foreach($categorie as $categorie)
			    		<option value="{{$categorie->designation}}">{{$categorie->designation}}</option>
			    	@endforeach
			    </select>
			  </div>
			  <div class="form-group col-md-5">
			    <label class="sr-only" for="exampleInputPassword3">Secteur</label>
			    <select name="secteur" id="secteur" class="form-control" >
			    	<option value="">Aucun</option>
			    	@foreach($secteurs as $secteur)
			   			<option value="{{$secteur->nom}}">{{$secteur->nom}}</option>
			   		@endforeach
			    </select>
			  </div>
			  <div class="form-group col-md-3">
			   <label class="sr-only" for="exampleInputPassword3">Etat</label>
			   <select name="etat" id="etat" class="form-control" >
			   	<option value="">Aucun</option>
			   	@foreach($etats as $etat)
			   		<option value="{{$etat->designation}}">{{$etat->designation}}</option>
			   	@endforeach
			   </select>
			  </div>
			
			  <button type="submit" class="btn btn-default text-uppercase">Valider</button>
			</form>
		</div>
		<p>&nbsp;</p>
		<div class="col-md-12">
			<table class="table table-nobordered" style="border:0px solid transparent">
				<tbody>
				@foreach($categories as $categorie)
					@foreach($categorie->engagements as $engagement)
						<tr>
							<td>{{$categorie->designation}}</td>
							<td>{{$engagement->intitule}}</td>
							
								@foreach($engagement->etats as $etats)
								<td>
									<p class="pull-right"><i class="fa {{$etats->img}} fa-3x" aria-hidden="true"></i><p>
								</td>
								@endforeach
						</tr>
						<tr>
							<td></td>
							<td>
								@foreach($engagement->etats as $etat)
									<h4><i class="fa {{$etat->img}} fa-3x" aria-hidden="true"></i></h4>
									@foreach($commentaires as $commentaire)

										@if($commentaire->engagement_etat_id==$etat->pivot->id)
											<h4>
												{{$commentaire->titre}}
											</h4>
											<p>{{$commentaire->contenu}}</p>
											
										@endif
									@endforeach
								@endforeach
							</td>
							<td></td>
						</tr>
						<tr>
							
						</tr>
					@endforeach
				@endforeach
				</tbody>
			</table>
			@foreach($categories as $categorie)
				@foreach($categorie->engagements as $engagement)
				@endforeach
			@endforeach
			<div class="col-md-4"></div>
		</div>
	</div>
@endsection