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
			
			@foreach($engagements as $engagement)
				
				{{--*/ $i=0 /*--}}
				<div class="row ligne-engagement">
					<div class="col-md-2 type-engagement">{{$engagement->categorie->designation}}</div>
					<div class="col-md-6 intitule-engagement">{{$engagement->intitule}}</div>
					<div class="col-md-4 etat-engagement">
						@foreach($engagement->etats as $etats)
							<div class="col-md-3">
								<i class="fa {{$etats->img}} fa-3x" aria-hidden="true"></i>
							</div>
						@endforeach
					</div>
				</div>
				<div class="row ligne-commentaire">
					<div class="col-md-6 col-md-offset-2 well">
						@foreach($engagement->etats as $etat)
							<h4><i class="fa {{$etat->img}} fa-3x" aria-hidden="true"></i></h4>
							@foreach($commentaires as $commentaire)
								@if($commentaire->engagement_etat_id==$etat->pivot->id)
									{{--*/ $i=1 /*--}}
									<h4>
										{{$commentaire->titre}}
									</h4>
									<p>{{$commentaire->contenu}}</p>
									
								@endif
							@endforeach
						@endforeach
					</div>
				</div>
				@if($i==1)
					<div class="row">
						<div class="col-md-12">
							<p><a class="btn btn-default" href="#" role="button">En savoir plus &raquo;</a></p>
						</div>
					</div>
				@endif
				
			@endforeach
			<div class="col-md-4"></div>
		</div>
	</div>
	@foreach($engagements as $engagement)
		{{$engagement->engagement_etat}}
	@endforeach
	{{ $engagements->links() }}
@endsection