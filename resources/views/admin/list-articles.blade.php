@extends('template-admin')
@section('header-title') 
	Liste des articles
	<span class="label label-default pull-right">{{$nombre_article}}</span>
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
		 <form class="" role="form" method="POST" action="{{route('article.store')}}" files="ture">
		                {{ csrf_field() }}
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Nouvel article</h4>
		      </div>
		      <div class="modal-body">
		      <div class="row">
		      	<div class="col-md-12">
			      	<div class="form-group">
			      	<div class="form-group">
			      	  <label for="titre">Type</label>
			      	 <select class="form-control" name="type" ng-model="type">
			      	 	<option value="article">Article</option>
			      	 	<option value="audio" >Audio</option>
			      	 	<option value="blog">Blog</option>
			      	 	<option value="doc" >Rapport</option>
			      	 	<option value="video" >Vidéo</option>
			      	 </select>
			      	</div>
			      	<div class="form-group">
			      	  <label for="titre">Titre</label>
			      	 <input type="text" class="form-control" id="titre" placeholder="Titre de l'article" name="titre">
			      	</div>
			      	
			      	<div class="form-group">
			      	  <label for="note">Contenu</label>
			      	  <textarea name="contenu" class="form-control" id="contenu"></textarea> 
			      	</div>
			      	<div class="form-group" ng-show="type='article' || type='audio' || type='video' || type='blog'">
			      		<label for="lien">Lien URL</label>
			      	<input type="text" id="lien" name="lien" class="form-control" placeholder="Lien URL relatif à l'article">
			      	</div>
			      	<div class="form-group" ng-show="type== 'article'">
			      		<label for="image">Image</label>
			      		<input type="file" id="image" name="image" class="form-control">
			      	</div>
			      	
			      	<div class="form-group" ng-show="type== 'doc'">
			      		<label for="image">Document</label>
			      		<input type="file" id="doc" name="doc" class="form-control">
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
		</div>
				<!-- Tableau de liste des engagements -->
				<div class="table-responsiv">
					<form>
						<table class="table table-striped table-bordered table-hover dataTables-c" id="articleTable" width="100%" cellpadding="0">
							<thead>
								<tr>
									<th>
										<input  type="checkbox" name="layout" id="1" value="option" ng-model="allselect">
									</th>
									<th>Titre</th>
									<th>Contenu</th>
									<th>Lien</th>
									<th >Edit.</th>
									<th>Supp.</th>
								</tr>
							</thead>
							<tbody>
								@foreach($articles as $article)
								<tr>
									<td>
										<input  type="checkbox" name="layout" id="1" value=""  ng-checked="allselect">
									</td>
									<td data-search="{{$article->titre}}">
										<a href="{{route('article.show',$article->id)}}">{{$article->titre}}</a>
									</td>
									<td>{{substr($article->contenu,0,30)}}..</td>
									<td> @if($article->lien==null)
										 <i>Aucun lien URL associé</i>
										@else {{$article->lien}} @endif
									</td>
									<td class="">
										<a href="" class="btn-action" data-toggle="modal" data-target="#editModal{{$article->id}}">
											<i class="fa fa-edit fa-1x" aria-hidden="true"></i>
										</a>
									</td>
									<td>
										<a href="" class="btn-action" data-toggle="modal" data-target="#deleteModal{{$article->id}}">
											<i class="fa fa-trash fa-1x" aria-hidden="true"></i>
										</a>
									</td>
								</tr>
								<!-- Modal de confirmation de suppression d'engagement -->
								<div class="modal fade" id="deleteModal{{$article->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        <h4 class="modal-title" id="myModalLabel">Suppression de article</h4>
								      </div>
								      <div class="modal-body">
								        Voulez-vous vraimment supprimer le article <strong>{{$article->designation}}</strong> ?
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
								        <div class="pull-right" style="margin-left:5px;">
									        {!! Form::open(['method' =>'delete','route' =>['article.destroy',$article->id]]) !!}
									        	<input type="hidden" name="action" value='suppression'/>
									        	{!! Form::submit('Supprimer',['class'=>'btn btn-danger'])!!}
									      	{!! Form::close() !!}
								      	</div>
								      </div>
								    </div>
								  </div>
								</div>

								<!-- Modal de modification d'appréciation -->
								<div class="modal fade" id="editModal{{$article->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								  <div class="modal-dialog">
								  {!! Form::open(['method' =>'PUT','route' =>['article.update',$article->id]]) !!}
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        <h4 class="modal-title" id="myModalLabel">Modification de article</h4>
								      </div>
								      <div class="modal-body">
								      <div class="row">
								      <div class="col-md-12">
								        <div class="form-group">
								          <label for="intitule">Désignation</label>
								         <input type="text" class="form-control" id="designation" name="designation" 
								         value="{{$article->designation}}">
								        </div>
								        <div class="form-group">
								          <label for="note">Description</label>
								          <textarea name="description" class="form-control" id="description" value="{{$article->description}}"></textarea> 
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