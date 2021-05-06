<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="max-age=604800" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>@yield('title')</title>

<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">

<!-- Bootstrap4 files-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

<!-- Font awesome 5 -->
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<!-- custom style -->
<link href="user/css/ui.css" rel="stylesheet" type="text/css"/>
<link href="user/css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)" />
<link rel="stylesheet" href="user/css/style.css">

</head>
<body>
  
<!-- Humberger Begin -->
<div id="mySidenav" class="sidenav">
	<div id="mySidenav-wrape" class="sidenav__menu__wrapper">
      <span class="hello-span white cursor-pointer">
        <a href="#" class="pl-3">
        <a class="icon sidebar-icon rounded-circle border"><span ></span><i class="fa fa-user"></i></a>
        Hello, Sign in</a>
      </span>
	  	<a href="javascript:void(0)" class="closebtn pt-2 white" onclick="closeNav()">&times;</a>
      <div class="wrapper">
          <div class="sidebar">
              <ul class="mobile-nav px-0">
                  <li><a href="#"><i class="fas fa-home"></i>Home</a></li>
                  <li><a href="#"><i class="fas fa-shopping-bag"></i>Your Orders</a></li>
                  <li><a href="#"><i class="fas fa-list-ul"></i>Your List</a></li>
                  <li><a href="#"><i class="fas fa-user"></i>Your Account</a></li>
                  <li><a  data-toggle="collapse" href="#collapseExample" role="button"
                     aria-expanded="false" aria-controls="collapseExample">
                     <i class="fas fa-building"></i>Shop by Department</a>
                  </li>
              </ul>
              <div class="collapse" id="collapseExample">
                <ul class="px-0">
                  <li><a href="#">Mobile</a></li>
                  <li><a href="#">Headphone</a></li>
                  <li><a href="#">Computer</li>
                  <li><a href="#">Fashion</a></li>
                  <li><a href="#">Beauty</a></li>
                </ul>
              </div>
              <ul class="pc-nav px-0">
                  <li><a href="#">Mobile</a></li>
                  <li><a href="#">Headphone</a></li>
                  <li><a href="#">Computer</li>
                  <li><a href="#">Fashion</a></li>
                  <li><a href="#">Beauty</a></li>
              </ul>
          <div class="social_media">
                <a href="#"><i class="fas fa-sign-out-alt mr-1"></i>Sign Out</a>
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
				<a href="http://bootstrap-ecommerce.com" class="brand-wrap">
					<img class="logo" src="user/images/logo.png">
				</a> <!-- brand-wrap.// -->
				<div class="widget-header d-md-none mr-2 float-right">
					<a href="#" class="icon icon-sm"><i class="fa fa-shopping-cart"></i></a>
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
							<a href="#" class="icon icon-sm rounded-circle border icon-hover"><i class="fa fa-shopping-cart"></i></a>
							<span class="badge badge-pill badge-danger notify">0</span>
						</div>
						<div class="widget-header icontext">
							<a href="#" class="icon icon-sm rounded-circle border icon-hover"><i class="fa fa-user"></i></a>
							<div class="text">
								<span class="text-muted">Welcome!</span>
								<div> 
									<a href="#">Sign in</a> |  
									<a href="#"> Register</a>
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
          <a class="nav-link" href="#">Fashion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Supermarket</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Electronics</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Baby &amp Toys</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Fitness sport</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Clothing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Furnitures</a>
        </li>
      </ul>
  </div> <!-- container-fluid .// -->
</nav>
<!-- </header> section-header.// -->

<!-- Page Content -->
@yield('content')

<!-- ========================= FOOTER ========================= -->
<footer class="section-footer border-top bg-white shadow-top">
	<div class="container">
		<section class="footer-top padding-y">
			<div class="row">
				<aside class="col-md col-6">
					<h6 class="title">Brands</h6>
					<ul class="list-unstyled">
						<li> <a href="#">Adidas</a></li>
						<li> <a href="#">Puma</a></li>
						<li> <a href="#">Reebok</a></li>
						<li> <a href="#">Nike</a></li>
					</ul>
				</aside>
				<aside class="col-md col-6">
					<h6 class="title">Company</h6>
					<ul class="list-unstyled">
						<li> <a href="#">About us</a></li>
						<li> <a href="#">Career</a></li>
						<li> <a href="#">Find a store</a></li>
						<li> <a href="#">Rules and terms</a></li>
						<li> <a href="#">Sitemap</a></li>
					</ul>
				</aside>
				<aside class="col-md col-6">
					<h6 class="title">Help</h6>
					<ul class="list-unstyled">
						<li> <a href="#">Contact us</a></li>
						<li> <a href="#">Money refund</a></li>
						<li> <a href="#">Order status</a></li>
						<li> <a href="#">Shipping info</a></li>
						<li> <a href="#">Open dispute</a></li>
					</ul>
				</aside>
				<aside class="col-md col-6">
					<h6 class="title">Account</h6>
					<ul class="list-unstyled">
						<li> <a href="#"> User Login </a></li>
						<li> <a href="#"> User register </a></li>
						<li> <a href="#"> Account Setting </a></li>
						<li> <a href="#"> My Orders </a></li>
					</ul>
				</aside>
				<aside class="col-md">
					<h6 class="title">Social</h6>
					<ul class="list-unstyled">
						<li><a href="#"> <i class="fab fa-facebook"></i> Facebook </a></li>
						<li><a href="#"> <i class="fab fa-twitter"></i> Twitter </a></li>
						<li><a href="#"> <i class="fab fa-instagram"></i> Instagram </a></li>
						<li><a href="#"> <i class="fab fa-youtube"></i> Youtube </a></li>
					</ul>
				</aside>
			</div> <!-- row.// -->
		</section>	<!-- footer-top.// -->

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
<!-- ========================= FOOTER END // ========================= -->
<!-- scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.19/jquery.touchSwipe.min.js"></script>
<!-- custom javascript -->
<script src="user/js/nav.js" type="text/javascript"></script>
<script src="user/js/carousel.js" type="text/javascript"></script>

</body>
</html>