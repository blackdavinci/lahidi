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
    <meta name="Cissé Ousmane" content="ABLOGUI (Association des Blogueurs de Guinée)" />

    
    <!-- Bootstrap Core & Custom CSS -->
	{!! Html::style('css/bootstrap.min.css') !!}
	{!! Html::style('css/carousel.css') !!}

	{!! Html::style('css/custom-template.css') !!}
	{!! Html::style('css/custom-guest.css') !!}

	<!-- Eterna CSS -->
    {{-- {!! Html::style("css/eterna/bootstrap.cs") !!}
    {!! Html::style("css/eterna/bootstrap-responsive.css") !!}
	{!! Html::style("css/eterna/flexslider.css") !!}
	{!! Html::style("css/eterna/prettyPhoto.css") !!}
	{!! Html::style("css/eterna/camera.css") !!}
	{!! Html::style("css/eterna/jquery.bxslider.css") !!} --}}
	{!! Html::style("css/eterna/style.css") !!}

	<!-- Theme skin -->
	{!! Html::style("css/eterna/color/default.css") !!}
	
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
     {!! Html::script("http://html5shim.googlecode.com/svn/trunk/html5.js") !!}
    <![endif]-->

   <!-- Custom Fonts -->
	{!! Html::style('css/font-awesome.css') !!}

	<!-- Charts JS -->
	@yield('head')
	{!! Html::script("js/jquery-1.12.3.js") !!}
	{!! Html::script("js/highcharts/highcharts.js") !!}
	{!! Html::script("js/highcharts/modules/data.js") !!}
	{!! Html::script("js/highcharts/modules/drilldown.js") !!}
	{!! Html::script("http://maps.google.com/maps/api/js?sensor=false") !!}
	{!! Html::script("js/jquery.gmap.min.js") !!}

</head>

<body>

<!-- options panel -->

<div id="wrapper">

	
	<!-- start header -->
	<header>	
		<div class="container" id="container-margin">
			<div class="row nomargin">
			<a href="{{route('guest.accueil')}}">
				<div class="col-md-4">
					<div class="col-md-3">
					
						<div class="logo">
						{!! Html::image('images/logo.jpg','logo LAHIDI',array('width' => 60)) !!}
						</div>
					</div>
					<div class="col-md-9 text-center" >
						<h5><strong>Plateforme de suivi et d'évaluation des promesses du Président et de son Gouvernement</strong></h5>
					</div>
				</div>
			</a>
				@include('partials.header')
			</div>
		</div>
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

	
	<section id="work">
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
<a href="#" class="scrollup"><i class="fa fa-angle-up fa fa-square fa fa-bglight fa fa-2x active bt-theme"></i></a>	

  <!-- HighCharts Script -->
<script type="text/javascript">
	// Map Script 
	$('#location').gMap({
	    address: "Guinée",
	    zoom: 6,
	    markers:[
	        {
	            latitude: 9.548155,
	            longitude: -13.673995,
	            html: "<b>ABLOGUI</b>",
	            popup: true
	        }
	    ]
	});
</script>

@include('footer')
    <!-- javascript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        {!! Html::script("js/jquery-1.12.3.js") !!}
        {{-- {!! Html::script("js/eterna/jquery.js") !!} --}}
    	{{-- {!! Html::script("js/eterna/jquery.easing.1.3.js") !!}
    	 	
    	{!! Html::script("js/eterna/modernizr.custom.js") !!}
    	{!! Html::script("js/eterna/toucheffects.js") !!}
    	{!! Html::script("js/eterna/google-code-prettify/prettify.js") !!}	
    	{!! Html::script("js/eterna/jquery.bxslider.min.js") !!} 
    	{!! Html::script("js/eterna/camera/camera.js") !!}
    	{!! Html::script("js/eterna/camera/setting.js") !!}
    	
    	{!! Html::script("js/eterna/jquery.prettyPhoto.js") !!}
    	{!! Html::script("js/eterna/portfolio/jquery.quicksand.js") !!} 
    	{!! Html::script("js/eterna/portfolio/setting.js") !!} 	
    	{!! Html::script("js/eterna/jquery.tweet.js") !!} --}} 

    	<!-- Bootstrap Core JavaScript -->
    	{{-- {!! Html::script("js/jquery-1.12.3.js") !!} --}}
   		{!! Html::script("js/bootstrap.min.js") !!}

    	<!-- AngularJS core JavaScript
		================================================== -->
		{!! Html::script("js/angular.min.js") !!}
		{!! Html::script("js/app.js") !!}
		

    	{!! Html::script("js/eterna/jquery.flexslider.js") !!} 
    	{!! Html::script("js/eterna/animate.js") !!}
    	{!! Html::script("js/eterna/inview.js") !!}
    	{!! Html::script("js/eterna/custom.js") !!}
	

    	{!! Html::script("js/eterna/jquery.cookie.js") !!}
    	{!! Html::script("colorpicker/js/colorpicker.js") !!}
    	{!! Html::script("js/eterna/optionspanel.js") !!}
   	
   		
   		

   		

   		<!-- Custom  Javascript Function -->
   		{!! Html::script('js/custom-function.js') !!}
	
</body>
</html>