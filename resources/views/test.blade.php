<Html>
<!DOCTYPE html>
<html ng-app="lahidiApp">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')Test Page</title>

  <!-- Bootstrap Core CSS -->
  {!! Html::style('css/bootstrap.min.css') !!}

  <!-- Custom CSS -->
  {!! Html::style('css/carousel.css') !!}
  {!! Html::style('css/custom-guest.css') !!}


  <!-- Magic-Check CSS -->
  {!! Html::style('css/magic-check.css') !!}

  <!-- Custom Fonts -->
  {!! Html::style('css/font-awesome.css') !!}

  <!-- DatePicker CSS -->
  {!! Html::style('css/bootstrap-datepicker3.min.css') !!}


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

  {!! Html::style('css/datepicker3.css') !!}
  <!-- GoogleCharts & Highcharts JS -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="js/jquery-1.12.3.js"></script>
    {!! Html::script('js/highcharts/highcharts.js') !!}
  <!--   <script src="http://code.highcharts.com/highcharts.js"></script>
 -->
    
  </head>
  <body>
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-4">
          <div id="source" ></div>
      </div>
      <div class="col-md-4">
          <div id="secteur" ></div>
      </div>
      <div class="col-md-4">
          <div id="etat" ></div>
      </div>
    </div>
    
  </div>
  
  
     <!-- jQuery -->
     
    <script type="text/javascript">
      jQuery(document).ready(function($) {
        $(function () {
               $('#source').highcharts(
                   {!! json_encode($sourceChart) !!}
               );

               $('#secteur').highcharts(
                   {!! json_encode($sourceChart) !!}
               );

               $('#etat').highcharts(
                   {!! json_encode($sourceChart) !!}
               );
        })
      });
    </script>
  
    <!-- jQuery -->
    {!! Html::script('js/jquery-1.12.3.js') !!}
    
    <!-- Bootstrap Core JavaScript -->
    {!! Html::script('js/bootstrap.min.js') !!}

    <!-- ChartsJS Javascript -->
    {!! Html::script('js/Chart.min.js') !!}

    <!-- AngularJS core JavaScript
    ================================================== -->
    {!! Html::script('js/angular.min.js') !!}
    {!! Html::script('js/app.js') !!}
    {!! Html::script('js/bootstrap-datepicker.min.js') !!}
    {!! Html::script('js/locales/bootstrap-datepicker.fr.min.js') !!}
    
    <!-- Custom  Javascript Function -->
    {!! Html::script('js/custom-function.js') !!}
    

   
  </body>
</Html>