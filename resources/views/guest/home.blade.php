@extends('template-guest')

@section('title','Accueil')


@section('content')
	<!-- Three columns of text below the carousel -->
	<div class="row">
	  <div class="col-lg-5">
	      <div id="source" ></div>
	  </div><!-- /.col-lg-4 -->
	  <div class="col-lg-7" ng-controller="graphController as graph">
	    <div id="etat" class="col-md-11" ng-show="graph.isSet(1)"></div>
	    <div id="secteur" class="col-md-11" ng-show="graph.isSet(2)"></div>
	    <div class="col-md-1">
	    	<a class="btn-show-graph text-uppercase" href="" ng-click="graph.setTab(2)" ng-show="graph.isSet(1)">Afficher par secteur</a>
	    	<a class="btn-show-graph text-uppercase" href="" ng-click="graph.setTab(1)" ng-show="graph.isSet(2)">Afficher par etat</a>
	    </div>

	  </div> <!-- /.col-lg-4 -->
	  <div class="col-lg-6">
	     <div id="secteu" ></div>
	  </div><!-- /.col-lg-4 -->
	  
	</div><!-- /.row -->


	<!-- START THE FEATURETTES -->

	<hr class="featurette-divider">

	<div class="row featurette">
	  <div class="col-md-4">
	  	
	  </div>
	  <div class="col-md-4">
	  	
	  </div>
	  <div class="col-md-4">
	  	
	  </div>
	</div>

	<hr class="featurette-divider">

	<div class="row featurette">
	  <div class="col-md-7">
	    <h2 class="featurette-heading"><span class="text-muted">It'll blow your mind.</span></h2>
	    <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
	  </div>
	  <div class="col-md-5">
	  
	  
	  </div>
	</div>

	<hr class="featurette-divider">

	<div class="row featurette">
	  <div class="col-md-7 col-md-push-5">
	    <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
	    <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
	  </div>
	  <div class="col-md-5 col-md-pull-7">
	    <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
	  </div>
	</div>

	<hr class="featurette-divider">

	<div class="row featurette">
	  <div class="col-md-7">
	    <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
	    <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
	  </div>
	  <div class="col-md-5">
	    <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
	  </div>
	</div>

	<hr class="featurette-divider">

	<!-- /END THE FEATURETTES -->
@endsection

@include('footer')