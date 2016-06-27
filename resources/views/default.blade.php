<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en" ng-app="lahidiApp">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Your page description here" />
    <meta name="author" content="" />

    <!-- Bootstrap Core & Custom CSS -->
	{!! Html::style('css/bootstrap.min.css') !!}
	{!! Html::style('css/custom-template.css') !!}

    <!-- css -->
	<link href="css/eterna/flexslider.css" rel="stylesheet" />
	<link href="css/eterna/prettyPhoto.css" rel="stylesheet" />
	<link href="css/eterna/camera.css" rel="stylesheet" />
	<link href="css/eterna/jquery.bxslider.css" rel="stylesheet" />
	<link href="css/eterna/cslider.css" rel="stylesheet" />
	<link href="css/eterna/style.css" rel="stylesheet" />

	<!-- Theme skin -->
	<link href="css/eterna/color/default.css" rel="stylesheet" />
	
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      {!! Html::script("http://html5shim.googlecode.com/svn/trunk/html5.js") !!}
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png" />
    <link rel="shortcut icon" href="ico/favicon.png" />

    <!-- Custom Fonts -->
	{!! Html::style('css/font-awesome.css') !!}

	<!-- Charts JS -->
	{!! Html::script("http://code.highcharts.com/highcharts.js") !!}
	{!! Html::script("https://code.highcharts.com/modules/data.js") !!}
	{!! Html::script("https://code.highcharts.com/modules/drilldown.js") !!}

</head>

<body>

<div id="wrapper">

	
	<!-- start header -->
	<header>		
		@include('partials.header')
	</header>	
	<!-- end header -->
	
	<!-- section featured -->
	<section id="featured">
		@include('partials.slider')
	</section>
	<!-- /section featured -->
	
	<section id="content">
		<div class="container">
			@yield('content')
		</div>
	</section>

	
	<footer>
		@include('partials.footer')		
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
      })
    });
  </script>
@endif
    
    <!-- javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    {!! Html::script("js/eterna/jquery.js") !!}
	{!! Html::script("js/eterna/jquery.easing.1.3.js") !!}
	{!! Html::script("js/bootstrap.min.js") !!}
	 	
	{!! Html::script("js/eterna/modernizr.custom.js") !!}
	{!! Html::script("js/eterna/toucheffects.js") !!}
	{!! Html::script("js/eterna/google-code-prettify/prettify.js") !!}	
	{!! Html::script("js/eterna/jquery.bxslider.min.js") !!} 
	<!-- parallax slider -->
	{!! Html::script("js/eterna/modernizr.custom.28468.js") !!}
	{!! Html::script("js/eterna/jquery.cslider.js") !!}
	
	{!! Html::script("js/eterna/jquery.prettyPhoto.js") !!}
	{!! Html::script("js/eterna/portfolio/jquery.quicksand.js") !!} 
	{!! Html::script("js/eterna/portfolio/setting.js") !!} 	
	{!! Html::script("js/eterna/jquery.tweet.js") !!} 

	{!! Html::script("js/eterna/jquery.flexslider.js") !!} 
	{!! Html::script("js/eterna/animate.js") !!}
	{!! Html::script("js/eterna/inview.js") !!}
	{!! Html::script("js/eterna/custom.js") !!}
<script>
	$(function() {
		$('#da-slider').cslider();
	});
</script>

</body>
</html>