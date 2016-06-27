@extends('template')

@section('title','Promesses du président')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h2>Toutes les promesses \<small>  </small></h2>
		</div>
		<div class="col-md-12">
			 {!! Form::open(['method' =>'POST','route' =>['guest.promessesfilter']]) !!}
			  <div class="form-group col-md-2">
			    <label class="sr-only" for="exampleInputEmail3">Catégorie</label>
			    <select name="categorie" id="categorie" class="form-control" >
			    	<option value="">Aucun</option>
			    	@foreach($categorie as $categorie)
			    		<option value="{{$categorie->id}}">{{$categorie->designation}}</option>
			    	@endforeach
			    </select>
			  </div>
			  <div class="form-group col-md-5">
			    <label class="sr-only" for="exampleInputPassword3">Secteur</label>
			    <select name="secteur" id="secteur" class="form-control" >
			    	<option value="">Aucun</option>
			    	@foreach($secteurs as $secteur)
			   			<option value="{{$secteur->id}}">{{$secteur->nom}}</option>
			   		@endforeach
			    </select>
			  </div>
			  <div class="form-group col-md-3">
			   <label class="sr-only" for="exampleInputPassword3">Etat</label>
			   <select name="etat" id="etat" class="form-control" >
			   	<option value="">Aucun</option>
			   	@foreach($etats as $etat)
			   		<option value="{{$etat->id}}">{{$etat->designation}}</option>
			   	@endforeach
			   </select>
			  </div>
			
			  <button type="submit" class="btn btn-default text-uppercase">Valider</button>
			 {!! Form::close() !!}
		</div>
		<p>&nbsp;</p>
		<div class="col-md-12">
			
			@foreach($engagements as $engagement)
				<div class="row" style="margin-bottom: 0px;">
				{{--*/ $i=0 /*--}}
				
				<div class="row ligne-engagement ">
					<a data-toggle="collapse" href="#comment{{$engagement->id}}" aria-expanded="false" aria-controls="collapseExample">
					<div class="col-md-8 cadre-engagement-home">
					<div class="col-md-12 ">
						<div class="col-md-12 type-engagement">
							<h5 class="text-uppercase pull-left">
								<strong>{{$engagement->categorie->designation}}</strong>
							</h5>
							<h5 class="text-uppercase pull-right label label-warning " style="color:white">
								{{$engagement->secteur->nom}}
							</h5>

						</div>
						<div class="col-md-12 intitule-engagement">
							<p style="font-size:16px">{{$engagement->intitule}}</p>
						</div>
						<div class="col-md-12">
							<h5><span class="text-uppercase"><strong>Source :</strong></span> {{$engagement->source}}</h5>
						</div>
					</div>
					</div>
					</a>
					<div class="col-md-4">
					@if(count($engagement->etats) != 0)
						<div class="col-md-8 etat-engagement">
							<div class="col-md-12">
							@foreach($engagement->etats as $etats)
								<div class="col-md-4">
								<a href="#" data-toggle="tooltip" title="{{$etats->designation}}">
									<i class="fa {{$etats->img}} fa-2x text-info" aria-hidden="true" title="{{$etats->designation}}"></i>
								</a>
								</div>
							@endforeach
							</div>
						</div>
					@endif
					</div>
				</div>
				<div class="row ligne-commentaire collapse"  id="comment{{$engagement->id}}">
					<div class="col-md-7 col-md-offset-1 ">
					<div class="col-md-12 cadre-commentaire"> 
						@foreach($engagement->etats as $etat)
						<div class="col-md-12">
							<h4>
								<span class="label label-info">
									<i class="fa {{$etat->img}} fa-1x" aria-hidden="true"></i> {{$etat->designation}}
								</span>
							</h4>
						</div>
							@foreach($commentaires as $commentaire)
								@if($commentaire->engagement_etat_id==$etat->pivot->id)
								<div class="col-md-12 ">
									{{--*/ $i=1 /*--}}
									<h4>
										{{$commentaire->titre}}
									</h4>
									<p>{{$commentaire->contenu}}</p>
								</div>
								@endif
							@endforeach
						@endforeach
							<div class="col-md-12 btn-ligne-detail">
								<p>
									<a href="{{route('guest.engagementDetail',$engagement->slug)}}" class="btn btn-danger" role="button" >En savoir plus &raquo;</a>
								</p>
							</div>
						</div>
					</div>
				</div>
				@if($i==1)
					<!-- <div class="row">
						<div class="col-md-12 btn-ligne-detail">
							<p>
								<a class="btn btn-default" role="button" >Détails &raquo;</a>
							</p>
						</div>
					</div> -->
				@endif
				</div>
			@endforeach
			<div class="col-md-4"></div>
		</div>
	</div>
	@foreach($engagements as $engagement)
		{{$engagement->engagement_etat}}
	@endforeach
	{{ $engagements->links() }}


@endsection

  <!-- Bootstrap Core JavaScript -->
   		<script type="text/javascript" src="js/bootstrap.min.js"></script>