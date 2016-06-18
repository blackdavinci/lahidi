<!DOCTYPE html>
<html ng-app="lahidiApp">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>

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
    


  </head>
<!-- NAVBAR
================================================== -->
  <body>
    <div class="navbar-wrapper">
      <div class="container">

        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">LAHIDI</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="@if($active=='home') active @endif">
                    <a href="{{route('guest.accueil')}}">Accueil</a>
                </li>
                <li class="@if($active=='promesses') active @endif">
                    <a href="{{route('guest.president')}}">Toutes les promesses</a>
                </li>
                <li class="@if($active=='media') active @endif"><a href="{{route('guest.mediatheque')}}">Médiathèque</a></li>
                <li class="@if($active=='langue') active @endif">
                    <a href="{{route('guest.langues')}}">Langues</a>
                </li>
                <li class="@if($active=='blog') active @endif"><a href="{{route('guest.forum')}}">Blog</a></li>
                 <li class="@if($active=='rapports') active @endif"><a href="{{route('guest.rapports')}}">Rapports MOSSEP</a></li>
              </ul>
            </div>
          </div>
        </nav>

      </div>
    </div>


    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img class="first-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Example headline.</h1>
              <p>Note: If you're viewing this page via a <code>file://</code> URL, the "next" and "previous" Glyphicon buttons on the left and right might not load/display properly due to web browser security rules.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="second-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Another example headline.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="third-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>One more for good measure.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">
        @yield('content')
     


      <!-- FOOTER -->
      <footer>
        @yield('footer')
        <p class="pull-right">&nbsp;| <a href="#"> Haut</a></p>
        <p class="pull-right">Un projet de <a href="http:\\www.ablogui.com">l'Association des Blogueurs de Guinée</a></p>
        <p>&copy; 2016 LAHIDI. &middot; <a href="#">Condition générale</a> &middot; <a href="#">Terms</a></p>
      </footer>

    </div><!-- /.container -->


   <!-- jQuery -->
   {!! HTML::script('js/jquery-1.12.3.js') !!}
   
   <!-- Bootstrap Core JavaScript -->
   {!! HTML::script('js/bootstrap.min.js') !!}

   <!-- ChartsJS Javascript -->
   {!! HTML::script('js/Chart.min.js') !!}

   <!-- AngularJS core JavaScript
   ================================================== -->
   {!! HTML::script('js/angular.min.js') !!}
   {!! HTML::script('js/app.js') !!}
   {!! HTML::script('js/bootstrap-datepicker.min.js') !!}
   {!! HTML::script('js/locales/bootstrap-datepicker.fr.min.js') !!}
   
   
   {!! HTML::script('js/easypiechart.js') !!}

   <!-- Custom  Javascript Function -->
   {!! HTML::script('js/custom-function.js') !!}
  </body>
</html>
