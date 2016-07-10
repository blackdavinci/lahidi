<!DOCTYPE html>
<html ng-app="lahidiApp">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>

<!-- Bootstrap Core CSS -->
{!! Html::style('css/bootstrap.min.css') !!}

<!-- Custom CSS -->
{!! Html::style('css/styles.css') !!}
{!! Html::style('css/sb-admin-2.cs') !!}
{!! Html::style('css/custom.css') !!}

{{-- Bootstrap Datepicker CSS --}}
{!! Html::style('css/bootstrap-datepicker3.css') !!}

<!-- Magic-Check CSS -->
{!! Html::style('css/magic-check.css') !!}

<!-- DataTables CSS -->
{!! Html::style('css/dataTables.bootstrap.css') !!}

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
    

<!--Icons-->
{!! HTML::script('js/lumino.glyphs.js') !!}


</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">LAHIDI BACK-OFFICE</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> {{ Auth::user()->name }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profil</a></li>
							<li><a href="{{ url('/logout') }}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Déconnexion</a></li>
						</ul>
					</li>
				</ul>
	
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
			<li class="@if($active=='dashboard') active @endif">
				<a href="{{route('pw-admin-dashboard.index')}}"><i class="fa fa-tachometer" aria-hidden="true"></i> Tableau de bord</a>
			</li>
			<li class="@if($active=='engagement') active @endif">
				<a href="{{route('pw-admin-engagement.index')}}"><i class="fa fa-reorder" aria-hidden="true"></i> Engagements</a>
			</li>
			<li class="@if($active=='categorie') active @endif">
				<a href="{{route('pw-admin-categorie.index')}}"><i class="fa fa-tasks" aria-hidden="true"></i> Catégories</a>
			</li>
			<li class="@if($active=='secteur') active @endif">
				<a href="{{route('pw-admin-secteur.index')}}"><i class="fa fa-pie-chart" aria-hidden="true"></i> Secteurs</a>
			</li>
			<li class="@if($active=='etat') active @endif">
				<a href="{{route('pw-admin-etat.index')}}"><i class="fa fa-bar-chart" aria-hidden="true"></i> Etats</a>
			</li>
			<li class="@if($active=='artcile') active @endif">
				<a href="{{route('pw-admin-article.index')}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Articles</a>
			</li>
			<li class="@if($active=='user') active @endif">
				<a href="{{route('pw-admin-user.index')}}"><i class="fa fa-users" aria-hidden="true"></i> Utilisateurs</a>
			</li>
		</ul>

	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-12">
					<h2 class="page-header">@yield('header-title')</h2>
				</div>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			@yield('head-box-info')
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-md-12" id="page-menu">
				@yield('page-menu')
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-md-12" id="page-content">
				@yield('content')
			</div>
		</div>
		
								
		<div class="row">
			<div class="col-md-8" id="footer-sidebar-left">
				@yield('footer-sidebar-left')
			</div><!--/.col-->
			
			<div class="col-md-4" id="footer-sidebar-right">
				@yield('footer-sidebar-right')			
			</div><!--/.col-->
		</div><!--/.row-->

	</div>	<!--/.main-->

	<!-- jQuery -->
	{!! HTML::script('js/jquery-1.12.3.js') !!}
	
	<!-- Bootstrap Core JavaScript -->
	{!! HTML::script('js/bootstrap.min.js') !!}

	<!-- Metis Menu Plugin JavaScript -->
	{!! HTML::script('js/metisMenu.min.js') !!}

	<!-- Custom Theme JavaScript -->
	{!! HTML::script('js/sb-admin-2.js') !!}

	<!-- ChartsJS Javascript -->
	{!! HTML::script('js/Chart.min.js') !!}

	<!-- DataTables Javascript -->
	{{-- {!! HTML::script('js/datatables.min.js') !!} --}}
	{!! HTML::script('js/jquery.dataTables.js') !!}
	{!! HTML::script('js/dataTables.bootstrap.min.js') !!}
	{!! HTML::script('js/dataTables.responsive.js') !!}
	{!! HTML::script('js/dataTables.autoFill.js') !!}
	{!! HTML::script('js/autoFill.bootstrap.js') !!}


	<!-- AngularJS core JavaScript
	================================================== -->
	{!! HTML::script('js/angular.min.js') !!}
	{!! HTML::script('js/app.js') !!}

	{{-- Bootstrap Datepicker JS --}}
	{!! HTML::script('js/bootstrap-datepicker.min.js') !!}
	{!! HTML::script('js/locales/bootstrap-datepicker.fr.min.js') !!}
	
	
	<!-- Custom  Javascript Function -->
	{!! HTML::script('js/custom-function.js') !!}
	
	@yield('script')
	
</body>

</html>
