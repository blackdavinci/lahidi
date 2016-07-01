
	<div class="col-md-8 text-right" >
	<div class="navbar navbar-static-top" id="frame-top-menu">
		<div class="navigation" id="top-menu">
			<nav>
			<ul class=" navbar-nav nav topnav hidden-xs hidden-sm" style="padding-top:5px">
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
				<a href="http://www.blog.lahidi.org/index.php/category/langues-nationales/">Langues</a>
				</li>
				<li class="@if($active=='blog') active @endif" >
				<a href="http://www.blog.lahidi.org">Blog</a>
				</li>
				<li class="@if($active=='participer') active @endif">
				<a href="{{route('guest.participer')}}">Participez </a>
				</li>
			</ul>
			</nav>
		</div>
		<!-- end navigation -->
	</div>
</div>
