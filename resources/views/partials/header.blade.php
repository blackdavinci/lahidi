<div class="row nomargin">
	<div class="col-md-3">
		<div class="logo">
			<a href="{{route('guest.accueil')}}"><img src="images/logo.jpg" alt="" width="60" /></a>
		</div>
	</div>
	<div class="col-md-9" >
	<div class="navbar navbar-static-top" id="frame-top-menu">
		<div class="navigation" id="top-menu">
			<nav>
			<ul class=" navbar-nav nav topnav ">
				<li class="@if($active=='home') active @endif">
				<a href="{{route('guest.accueil')}}"><i class="fa fa-home fa-fw"></i> Accueil </a>
				</li>
				<li  class="@if($active=='promesses') active @endif">
					<a href="{{route('guest.promesses')}}">Toutes les promesses </a>
				</li>
				<li class="@if($active=='media') active @endif">
				<a href="{{route('guest.media')}}">Médiathèque</a>
				</li>
				<li class="@if($active=='langue') active @endif">
				<a href="{{route('guest.langues')}}">Langues</a>
				</li>
				<li class="@if($active=='blog') active @endif" >
				<a href="{{route('guest.blog')}}">Blog</a>
				</li>
				<li class="@if($active=='rapports') active @endif">
				<a href="{{route('guest.rapports')}}">Rapport MOSSEP </a>
				</li>
			</ul>
			</nav>
		</div>
		<!-- end navigation -->
	</div>
</div>
</div>