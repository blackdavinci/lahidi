<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en" ng-app="lahidiApp">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Plateforme de suivi et d'évaluation des promesses du Président Alpha Condé et celles de son Gouvernement." />
    <meta name="author" content="ABLOGUI (Association des Blogueurs de Guinée)" />

    
    <!-- Bootstrap Core & Custom CSS -->
	{!! Html::style('css/bootstrap.min.css') !!}
	{!! Html::style('css/custom-template.css') !!}
	{!! Html::style('css/custom-guest.css') !!}

	<!-- Eterna CSS -->
    <link href="css/eterna/bootstrap.cs" rel="stylesheet" />
    <link href="css/eterna/bootstrap-responsive.cs" rel="stylesheet" />
	<link href="css/eterna/flexslider.css" rel="stylesheet" />
	<link href="css/eterna/prettyPhoto.css" rel="stylesheet" />
	<link href="css/eterna/camera.css" rel="stylesheet" />
	<link href="css/eterna/jquery.bxslider.css" rel="stylesheet" />
	<link href="css/eterna/style.css" rel="stylesheet" />

	<!-- Theme skin -->
	<link href="css/eterna/color/default.css" rel="stylesheet" />
	
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
     {!! Html::script("http://html5shim.googlecode.com/svn/trunk/html5.js") !!}
    <![endif]-->

   <!-- Custom Fonts -->
	{!! Html::style('css/font-awesome.css') !!}

	<!-- Charts JS -->
	<script src="js/eterna/jquery.js"></script>
	<script src="http://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/data.js"></script>
	<script src="https://code.highcharts.com/modules/drilldown.js"></script>
    
</head>

<body>

<!-- options panel -->


<div id="wrapper">

	
	<!-- start header -->
	<header>	
		<div class="container" id="container-margin">
			@include('partials.header')
		</div>
	</header>	
	<!-- end header -->
	
	<!-- section featured -->
	<section id="featured">

			@include('partials.slider1')

	</section>
	<!-- /section featured -->
	
	<section id="content">
		<div class="container">

			@yield('content')			
			
		</div>
	</section>

	
	<section id="works">
		<div class="container">
			@yield('content-bottom')	
		</div>
	</section>
	
	<footer>
		<div class="container">
			@include('partials.footer')
		</div>			
	</footer>
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up fa fa-square fa fa-bglight fa fa-2x active"></i></a>	

  <!-- HighCharts Script -->
@if($active=='home')
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $(function () {
             $('#source').highcharts(
             
                 {!! json_encode($sourceChart) !!}
             );

             $('#secteur').highcharts(
                 {!! json_encode($secteurChart) !!}
             );

             $('#etat').highcharts(
                 {!! json_encode($etatChart) !!}
             );
      });
    });
  </script>
@endif

    <!-- javascript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/eterna/jquery.js"></script>
    	<script src="js/eterna/jquery.easing.1.3.js"></script>
    	 	
    	<script src="js/eterna/modernizr.custom.js"></script>
    	<script src="js/eterna/toucheffects.js"></script>
    	<script src="js/eterna/google-code-prettify/prettify.js"></script>	
    	<script src="js/eterna/jquery.bxslider.min.js"></script> 
    	<script src="js/eterna/camera/camera.js"></script>
    	<script src="js/eterna/camera/setting.js"></script>
    	
    	<script src="js/eterna/jquery.prettyPhoto.js"></script>
    	<script src="js/eterna/portfolio/jquery.quicksand.js"></script> 
    	<script src="js/eterna/portfolio/setting.js"></script> 	
    	<script src="js/eterna/jquery.tweet.js"></script> 

    	<!-- Bootstrap Core JavaScript -->
    	<script type="text/javascript" src="js/jquery-1.12.3.js"></script>
   		<script type="text/javascript" src="js/bootstrap.min.js"></script>

    	<!-- AngularJS core JavaScript
		================================================== -->
		<script type="text/javascript" src="js/angular.min.js"></script>
		<script type="text/javascript" src="js/app.js"></script>
		

    	<script src="js/eterna/jquery.flexslider.js"></script> 
    	<script src="js/eterna/animate.js"></script>
    	<script src="js/eterna/inview.js"></script>
    	<script src="js/eterna/custom.js"></script>
	

    	<script src="js/eterna/jquery.cookie.js"></script>
    	<script src="colorpicker/js/colorpicker.js"></script>
    	<script src="js/eterna/optionspanel.js"></script>
   	
   		
   		

   		

   		<!-- Custom  Javascript Function -->
   		{!! Html::script('js/custom-function.js') !!}
	
</body>
</html>