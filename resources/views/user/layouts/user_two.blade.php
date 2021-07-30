<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="max-age=604800" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">

<title>@yield('title') - {{ config('settings.site_name') }}</title>
@include('user.partials.styles')
@yield('css')
</head>
<body>
  
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
					<a href="/"><li><i class="fas fa-home"></i>Home</li></a>
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
					<span class="badge badge-pill badge-danger notify">0</span>
				</div>
			</div>
			<div class="col-lg-6 col-sm-12 order-md-2 order-3">
				<form action="#" class="search">
					<div class="input-group w-100">
					    <input type="text" class="form-control" placeholder="Search">
					    <div class="input-group-append">
					      <button class="btn search-btn" type="submit">
					        <i class="fa fa-search"></i>
					      </button>
					    </div>
				    </div>
				</form> <!-- search-wrap .end// -->
			</div> <!-- col.// -->		
			<div class="col-lg-4 col-sm-6 col-2 order-md-2 order-1">
				<div class="d-none d-md-block">
					<div class="widgets-wrap float-md-right">
						<div class="widget-header mr-3">
							<a href="{{ route('shoping-cart') }}" class="icon icon-sm rounded-circle border icon-hover"><i class="fa fa-shopping-cart"></i></a>
							<span class="badge badge-pill badge-danger notify">0</span>
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

<!-- Page Content -->
@yield('content')

<!-- ========================= FOOTER ========================= -->
<footer class="section-footer border-top bg-white shadow-top">
		<section class="footer-bottom border-top row">
			<div class="col-md-2">
				<p class="text-muted"> &copy <script>document.write(new Date().getFullYear());</script> Company name </p>
			</div>
			<div class="col-md-8 text-md-center">
				<span  class="px-2">info@pixsellz.io</span>
				<span  class="px-2">+879-332-9375</span>
				<span  class="px-2">Street name 123, Avanue abc</span>
			</div>
			<div class="col-md-2 text-md-right text-muted">
				<i class="fab fa-lg fa-cc-visa"></i>
				<i class="fab fa-lg fa-cc-paypal"></i>
				<i class="fab fa-lg fa-cc-mastercard"></i>
			</div>
		</section>
	</div><!-- //container-fluid -->
</footer>
@include('user.partials.scripts')
@yield('js')
</body>
</html>