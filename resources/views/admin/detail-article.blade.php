@extends('template-admin')
@section('header-title') 
	{{$article->titre}}
@endsection

@section('page-menu')
	<ul>
		<li><h4 class="btn-action-menu"><a href="" class="btn btn-danger">Supprimmer</a></h4></li>
		<li>
			<h4 class="btn-action-menu">
				<a href="" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Modifier</a>
			</h4>
		</li>
	</ul>
@endsection

@section('content')
	<div class="col-md-12 ">
		<div class="panel panel-default">
			<div class="panel-body tabs">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#fiche" data-toggle="tab" class="text-uppercase"><b>Fiche</b></a></li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane fade in active" id="fiche">
				
					<!-- Modal de modification d'article -->
					    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					      <div class="modal-dialog">
					      {!! Form::open(['method' =>'POST','route' =>['pw-admin-article.update',$article->id],'files'=>true]) !!}
					        <div class="modal-content">
					          <div class="modal-header">
					            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					            <h4 class="modal-title" id="myModalLabel">Modification d'article</h4>
					          </div>
					          <div class="modal-body">
					          <div class="row">
					            <div class="col-md-12">
					              <div class="form-group">
					              <div class="form-group">
					                <label for="titre">Titre</label>
					               <input type="text" class="form-control" id="titre"  name="titre" value="{{$article->titre}}">
					              </div>
					              <div class="form-group">
					                <label for="note">Contenu</label>
					                <textarea name="contenu" class="form-control" id="contenu">{{$article->contenu}}</textarea> 
					              </div>
					              <div class="form-group">
					                <label for="lien">Lien URL</label>
					              <input type="text" id="lien" name="lien" class="form-control"  value="{{$article->lien}}">
					              </div>
					              <div class="form-group">
					                <label for="image">Image</label>
					                <input type="file" id="image" name="image" class="form-control">
					              </div>
					              <div class="form-group">
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
						<!-- Tableau d'information de l'article -->
						<div class="col-md-12">
						<div class="table-responsive">
						{!! Form::open(['method' =>'PUT','route' =>['pw-admin-article.update',$article->id]]) !!}
							<table class="table table-nobordered table-nobordered-top table-stripe" id="tablearticle">
								<tbody>
									<tr><td class="titlearticle"><h4>Titre</h4></td></tr> 
									<tr><td class="dataarticle">{{$article->titre}}</td></tr>
									<tr><td class="titlearticle"><h4>Description</h4></td></tr> 
									<tr><td>{{$article->contenu}}</td></tr>
									<tr><td class="titlearticle"><h4>Type</h4></td></tr> 
									<tr>
										<td class="dataarticle">
											@if($article->localite==null) 
												<i>Aucune localité</i>
											@else 
												{{$article->localite}}
											@endif
										</td>
									</tr><td class="titlearticle"><h4>Période de réalisation</h4></td></tr>
									<tr>
										<td class="dataarticle">
											{{$article->date_debut}} 
											<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
											{{$article->date_fin}}
										</td>
									</tr>
									<tr><td class="titlearticle"><h4>Source</h4></td></tr> 
									<tr><td>{{$article->source}}</td></tr>
									<tr><td class="titlearticle"><h4>Note</h4></td></tr>
									 <tr><td class="dataarticle">{{$article->note}}</td></tr>
								</tbody>
							</table>
							{!! Form::close() !!}
						</div>
						</div>

					</div>

					<!-- TAB ETATS ENAGEMENT -->
					
			</div>
		</div><!--/.panel-->
	</div>
@endsection