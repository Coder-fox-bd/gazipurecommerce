<!-- Humberger Begin -->
<div id="mySidenav" class="sidenav">
	<div id="mySidenav-wrape" class="sidenav__menu__wrapper">
      <span class="hello-span white cursor-pointer">
		@guest
			@if (Route::has('login'))
				<a href="{{ route('login') }}" class="pl-3 text-light">
					<div class="icon sidebar-icon rounded-circle border"><span ></span><i class="fa fa-user"></i></div>
					Hello, Sign in
				</a>
			@endif
		@else
			<div class="pl-3 text-light">
				<div class="icon sidebar-icon rounded-circle border"><span ></span><i class="fa fa-user"></i></div>
				Hello, {{ Auth::user()->name }}
			</div>
		@endguest
      </span>
	  	<a href="javascript:void(0)" class="closebtn pt-2 white" onclick="closeNav()">&times;</a>
      <div class="wrapper">
          <div class="sidebar">
              <ul class="mobile-nav px-0">
					<a href="#"><li><i class="fas fa-home"></i>Home</li></a>
					<a href="#"><li><i class="fas fa-home"></i>Your Orders</li></a>
					<a href="#"><li><i class="fas fa-home"></i>Your List</li></a>
					<a href="#"><li><i class="fas fa-home"></i>Your Account</li></a>
					<li data-toggle="collapse" href="#collapseExample" role="button"
					aria-expanded="false" aria-controls="collapseExample">
					   <span>Shop by category</span>
					   <i class="fa fa-chevron-right float-right mt-1 js-rotate-if-collapsed"></i>
					</li>
              </ul>
              <div class="collapse bg-light rounded" id="collapseExample">
                <ul class="pl-0 ml-0">
					@foreach($categories as $category)
					@if (count($category->children) > 0)
						<li data-toggle="collapse" href="#multiCollapse" role="button"
						aria-expanded="false" aria-controls="#multiCollapse" data-target="#multiCollapse{{ $category->id }}">
							<span>{{ $category->name }}</span>
							<i class="fa fa-chevron-right float-right mt-1 js-rotate-if-collapsed"></i>
						</li>
						<div class="collapse bg-light-gray rounded" id="multiCollapse{{ $category->id }}">
							<ul class="px-0">
							@foreach($category->children as $childCategory)
								<a href="{{ route('category.show', $childCategory->slug) }}"><li>{{ $childCategory->name }}</li></a>
							@endforeach
							</ul>
						</div>
					@else
						<a href="{{ route('category.show', $category->slug) }}"><li>{{ $category->name }}</li></a>
					@endif
				  @endforeach
                </ul>
              </div>
			  
              <ul class="pc-nav px-0">
				  @foreach($categories as $category)
					@if (count($category->children) > 0)
						<li data-toggle="collapse" href="#multiCollapse" role="button"
						aria-expanded="false" aria-controls="#multiCollapse" data-target="#multiCollapse{{ $category->id }}">
							<span>{{ $category->name }}</span>
							<i class="fa fa-chevron-right float-right mt-1 js-rotate-if-collapsed"></i>
						</li>
						<div class="collapse bg-light-gray rounded" id="multiCollapse{{ $category->id }}">
							<ul class="px-0">
							@foreach($category->children as $childCategory)
								<a href="{{ route('category.show', $childCategory->slug) }}"><li>{{ $childCategory->name }}</li></a>
							@endforeach
							</ul>
						</div>
					@else
						<a href="{{ route('category.show', $category->slug) }}"><li>{{ $category->name }}</li></a>
					@endif
				  @endforeach
              </ul>
            <div class="social_media">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
				document.getElementById('logout-form').submit();">
				<i class="fas fa-sign-out-alt mr-1"></i>Sign Out</a>

				<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
					@csrf
				</form>
            </div>  
          </div>
      </div>
	</div>
</div>
<!-- Humberger End -->

<header id="navbar_top" class="section-header nav-color-main nav-text-color">

	<section class="header-main">
		<div class="container-fluid">
			<div class="row align-items-center">
				<div class="col-lg-2 col-10 order-md-1 order-2 p-l-0">
					<a href="/" class="brand-wrap">
						<img class="logo" src="{{ asset('storage/'.config('settings.site_logo')) }}">
					</a> <!-- brand-wrap.// -->
					<div class="widget-header d-md-none mr-2 float-right">
						<a href="{{ route('shoping-cart') }}" class="icon icon-sm"><i class="fa fa-shopping-cart"></i></a>
						@livewire('user.cart')
					</div>
				</div>
				<div class="col-lg-6 col-sm-12 order-md-2 order-3">
					@livewire('user.search')
				</div> <!-- col.// -->		
				<div class="col-lg-4 col-sm-6 col-2 order-md-2 order-1">
					<div class="d-none d-md-block">
						<div class="widgets-wrap float-md-right">
							<div class="widget-header mr-3">
								<a href="{{ route('shoping-cart') }}" class="icon icon-sm rounded-circle border icon-hover"><i class="fa fa-shopping-cart"></i></a>
								@livewire('user.cart')
							</div>
							<div class="widget-header icontext">
								<a href="#" class="icon icon-sm rounded-circle border icon-hover"><i class="fa fa-user"></i></a>
								<div class="text text-white">
									<span class="text-muted">Welcome!</span>
									<div> 
										@guest
											@if (Route::has('login'))
											<div> 
												<a href="{{ route('login') }}">Sign in</a> |  
												<a href="{{ route('register') }}"> Register</a>
											</div>
											@endif
										@else
											<a id="navbarDropdown" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
												{{ Auth::user()->name }}
											</a>
		
											<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
												<a class="dropdown-item" href="{{ route('logout') }}"
												onclick="event.preventDefault();
																document.getElementById('logout-form').submit();">
													{{ __('Logout') }}
												</a>
		
												<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
													@csrf
												</form>
											</div>
										@endguest
									</div>
								</div>
							</div>
						</div> <!-- widgets-wrap.// -->
					</div>
					<div class="d-md-none">
						<div class="humberger__open float-right" onclick="openNav()">
							<i class="fa fa-bars"></i>
						</div>
					</div>
				</div> <!-- col.// -->
			</div> <!-- row.// -->
		</div> <!-- container-fluid.// -->
	</section> <!-- header-main .// -->
</header>
<nav class="navbar navbar-main navbar-expand-lg nav-color-sub fixed d-none d-md-block">
  <div class="container-fluid">
      <ul class="navbar-nav">
      	<li class="nav-item" id="flip">
          <a class="nav-link pl-0" onclick="openNav()"><strong> <i class="fa fa-bars"></i> &nbsp  All category</strong></a>
        </li>
		<li class="nav-item has-submenu">
			<a class="nav-link" href="{{ route('shop') }}">Shop</a>
		</li>
		@foreach($categories->where('featured', 1)->take(8) as $category)
		<li class="nav-item has-submenu">
			<a class="nav-link" href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
		</li>
		@endforeach
      </ul>
  </div> <!-- container-fluid .// -->
</nav>