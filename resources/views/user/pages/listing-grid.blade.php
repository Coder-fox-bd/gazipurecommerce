@extends('user.layouts.user_one')

@section('title', $category->name)

@section('content')
<!-- ========================= SECTION PAGETOP ========================= -->
<div class="container-fluid">
	<nav>
		<ol class="breadcrumb text-white">
			<li class="breadcrumb-item"><a href="/">Home</a></li>
			@if($category->parent)
				<li class="breadcrumb-item"><a href="{{ route('category.show', $category->parent->slug) }}">{{ $category->parent->name }}</a></li>
			@endif
			<li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
		</ol>  
	</nav>
</div>
<!-- ========================= SECTION INTRO END// ========================= -->

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
<div class="container-fluid">

<div class="row">
	<aside class="col-md-3">
		
<div class="right-border">
	<article class="filter-group">
		<header class="card-header">
			<a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true">
				<i class="icon-control fa fa-chevron-down"></i>
				<h6 class="title">Product type</h6>
			</a>
		</header>
		<div class="filter-content collapse show" id="collapse_1">
			<div class="card-body">
				<form class="pb-3">
				<div class="input-group">
				  <input type="text" class="form-control" placeholder="Search">
				  <div class="input-group-append">
				    <button class="btn btn-light" type="button"><i class="fa fa-search"></i></button>
				  </div>
				</div>
				</form>
				
				<ul class="list-menu">
				<li><a href="#">People  </a></li>
				<li><a href="#">Watches </a></li>
				<li><a href="#">Cinema  </a></li>
				<li><a href="#">Clothes  </a></li>
				<li><a href="#">Home items </a></li>
				<li><a href="#">Animals</a></li>
				<li><a href="#">People </a></li>
				</ul>

			</div> <!-- card-body.// -->
		</div>
	</article> <!-- filter-group  .// -->
	<article class="filter-group">
		<header class="card-header">
			<a href="#" data-toggle="collapse" data-target="#collapse_2" aria-expanded="true">
				<i class="icon-control fa fa-chevron-down"></i>
				<h6 class="title">Brands </h6>
			</a>
		</header>
		<div class="filter-content collapse show" id="collapse_2" >
			<div class="card-body">
				<label class="custom-control custom-checkbox">
				  <input type="checkbox" checked="" class="custom-control-input">
				  <div class="custom-control-label">Mercedes  
				  	<b class="badge badge-pill badge-light float-right">120</b>  </div>
				</label>
				<label class="custom-control custom-checkbox">
				  <input type="checkbox" checked="" class="custom-control-input">
				  <div class="custom-control-label">Toyota 
				  	<b class="badge badge-pill badge-light float-right">15</b>  </div>
				</label>
				<label class="custom-control custom-checkbox">
				  <input type="checkbox" checked="" class="custom-control-input">
				  <div class="custom-control-label">Mitsubishi 
				  	<b class="badge badge-pill badge-light float-right">35</b> </div>
				</label>
				<label class="custom-control custom-checkbox">
				  <input type="checkbox" checked="" class="custom-control-input">
				  <div class="custom-control-label">Nissan 
				  	<b class="badge badge-pill badge-light float-right">89</b> </div>
				</label>
				<label class="custom-control custom-checkbox">
				  <input type="checkbox" class="custom-control-input">
				  <div class="custom-control-label">Honda 
				  	<b class="badge badge-pill badge-light float-right">30</b>  </div>
				</label>
	</div> <!-- card-body.// -->
		</div>
	</article> <!-- filter-group .// -->
	<article class="filter-group">
		<header class="card-header">
			<a href="#" data-toggle="collapse" data-target="#collapse_3" aria-expanded="true">
				<i class="icon-control fa fa-chevron-down"></i>
				<h6 class="title">Price range </h6>
			</a>
		</header>
		<div class="filter-content collapse show" id="collapse_3">
			<div class="card-body">
				<input type="range" class="custom-range" min="0" max="100000" value="30000" name="" oninput="updateTextInput(this.value);">
				<div class="form-row">
				<div class="form-group col-md-6">
				  <label>Min</label>
				  <input class="form-control" value="0" type="number">
				</div>
				<div class="form-group text-right col-md-6">
				  <label>Max</label>
				  <input class="form-control" id="range-output" value="30000" type="number">
				</div>
				</div> <!-- form-row.// -->
				<a class="square_btn_5 btn-block cursor-pointer">Apply</a>
			</div><!-- card-body.// -->
		</div>
	</article> <!-- filter-group .// -->
	<article class="filter-group">
		<header class="card-header">
			<a href="#" data-toggle="collapse" data-target="#collapse_4" aria-expanded="true">
				<i class="icon-control fa fa-chevron-down"></i>
				<h6 class="title">Sizes </h6>
			</a>
		</header>
		<div class="filter-content collapse show" id="collapse_4" >
			<div class="card-body">
			  <label class="checkbox-btn">
			    <input type="checkbox">
			    <span class="btn btn-light"> XS </span>
			  </label>

			  <label class="checkbox-btn">
			    <input type="checkbox">
			    <span class="btn btn-light"> SM </span>
			  </label>

			  <label class="checkbox-btn">
			    <input type="checkbox">
			    <span class="btn btn-light"> LG </span>
			  </label>

			  <label class="checkbox-btn">
			    <input type="checkbox">
			    <span class="btn btn-light"> XXL </span>
			  </label>
		</div><!-- card-body.// -->
		</div>
	</article> <!-- filter-group .// -->
	<article class="filter-group">
		<header class="card-header">
			<a href="#" data-toggle="collapse" data-target="#collapse_5" aria-expanded="false">
				<i class="icon-control fa fa-chevron-down"></i>
				<h6 class="title">More filter </h6>
			</a>
		</header>
		<div class="filter-content collapse in" id="collapse_5" >
			<div class="card-body">
				<label class="custom-control custom-radio">
				  <input type="radio" name="myfilter_radio" checked="" class="custom-control-input">
				  <div class="custom-control-label">Any condition</div>
				</label>

				<label class="custom-control custom-radio">
				  <input type="radio" name="myfilter_radio" class="custom-control-input">
				  <div class="custom-control-label">Brand new </div>
				</label>

				<label class="custom-control custom-radio">
				  <input type="radio" name="myfilter_radio" class="custom-control-input">
				  <div class="custom-control-label">Used items</div>
				</label>

				<label class="custom-control custom-radio">
				  <input type="radio" name="myfilter_radio" class="custom-control-input">
				  <div class="custom-control-label">Very old</div>
				</label>
			</div><!-- card-body.// -->
		</div>
	</article> <!-- filter-group .// -->
</div> <!-- card.// -->

	</aside> <!-- col.// -->
	<main class="col-md-9">

<header class="border-bottom mb-4 pb-3">
		<div class="form-inline">
			<span class="mr-md-auto">32 Items found </span>
			<select class="mr-2 form-control">
				<option>Latest items</option>
				<option>Trending</option>
				<option>Most Popular</option>
				<option>Cheapest</option>
			</select>
		</div>
</header><!-- sect-heading -->

<div class="row">
	@forelse($category->products as $product)
	<div class="col-md-4">
		<figure class="card card-product-grid">
			<div class="row">
				<div class="col-md-12 col-5 p-r-0 center-responsive">
					<div class="img-wrap img-fluid center"> 
						<span class="badge badge-danger"> NEW </span>
						@if ($product->images->count() > 0)
						<img src="{{ asset('storage/'.$product->images->first()->images) }}">
						@else
						<img src="https://via.placeholder.com/176" alt="">
						@endif
					</div> <!-- img-wrap.// -->
				</div>
				<div class="col-md-12 col-7 p-l-0">
					<figcaption class="info-wrap">
						<h6 class="a-size-mini spacing-none line-clamp-4">
							<a href="{{ route('product.show', $product->slug) }}" class="a-color on-hover">
								<span class="a-size-base-plus a-text-normal">
									{{ $product->name }}
								</span>
							</a>
						</h6>
						
						
						<div class="rating-wrap">
							<ul class="rating-stars">
								<li style="width:100%" class="stars-active"> 
									<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
								</li>
								<li>
									<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
								</li>
							</ul>
							<span class="label-rating text-muted"> 34 reviws</span>
						</div>
						@if($product->special_price)
						<div class="price mt-1">{{ $product->special_price }}</div> <!-- price-wrap.// -->
						<div class="price-old mt-1"><span class="line-through">{{ $product->price }}</span><span class="ml-2">-25%</span></div> <!-- price-wrap.// -->
						@else
						<div class="price mt-1">{{ $product->price }}</div> <!-- price-wrap.// -->
						@endif
						<a href="#" class="square_btn_4 btn-block"><i
							class="fas fa-shopping-cart pr-2"></i>Add to cart </a>
					</figcaption>
				</div>
			</div>
		</figure>
	</div> <!-- col.// -->
	@empty
	<p>No Products found in {{ $category->name }}.</p>
	@endforelse
	

	<div class="col-md-4">
		<figure class="card card-product-grid">
			<div class="row">
				<div class="col-md-12 col-5 p-r-0 center-responsive">
					<div class="img-wrap img-fluid center"> 
						<img src="images/items/2.jpg">
					</div> <!-- img-wrap.// -->
				</div>
				<div class="col-md-12 col-7 p-l-0">
					<figcaption class="info-wrap">
						<h6 class="a-size-mini spacing-none line-clamp-4">
							<a href="#" class="a-color on-hover">
								<span class="a-size-base-plus a-text-normal">
									ReleTech P400 1TB M.2 PCIe 2280 NVMe Interface Internal Solid State Drive 3D-NAND Technology Gen3 x4 NVMe PC SSD Up to 3,500 MB/s (1TB)
									ReleTech P400 1TB M.2 PCIe 2280 NVMe Interface Internal Solid State Drive 3D-NAND Technology Gen3 x4 NVMe PC SSD Up to 3,500 MB/s (1TB)
								</span>
							</a>
						</h6>
						
						
						<div class="rating-wrap">
							<ul class="rating-stars">
								<li style="width:100%" class="stars-active"> 
									<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
								</li>
								<li>
									<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
								</li>
							</ul>
							<span class="label-rating text-muted"> 34 reviws</span>
						</div>
						<div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
						<div class="price-old mt-1"><span class="line-through">$189.00</span><span class="ml-2">-25%</span></div> <!-- price-wrap.// -->
						<a href="#" class="square_btn_4 btn-block"><i
							class="fas fa-shopping-cart pr-2"></i>Add to cart </a>
					</figcaption>
				</div>
			</div>
		</figure>
	</div> <!-- col.// -->

	<div class="col-md-4">
		<figure class="card card-product-grid">
			<div class="row">
				<div class="col-md-12 col-5 p-r-0 center-responsive">
					<div class="img-wrap img-fluid center"> 
						<img src="images/items/3.jpg">
					</div> <!-- img-wrap.// -->
				</div>
				<div class="col-md-12 col-7 p-l-0">
					<figcaption class="info-wrap">
						<h6 class="a-size-mini spacing-none line-clamp-4">
							<a href="#" class="a-color on-hover">
								<span class="a-size-base-plus a-text-normal">
									ReleTech P400 1TB M.2 PCIe 2280 NVMe Interface Internal Solid State Drive 3D-NAND Technology Gen3 x4 NVMe PC SSD Up to 3,500 MB/s (1TB)
									ReleTech P400 1TB M.2 PCIe 2280 NVMe Interface Internal Solid State Drive 3D-NAND Technology Gen3 x4 NVMe PC SSD Up to 3,500 MB/s (1TB)
								</span>
							</a>
						</h6>
						
						
						<div class="rating-wrap">
							<ul class="rating-stars">
								<li style="width:100%" class="stars-active"> 
									<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
								</li>
								<li>
									<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
								</li>
							</ul>
							<span class="label-rating text-muted"> 34 reviws</span>
						</div>
						<div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
						<div class="price-old mt-1"><span class="line-through">$189.00</span><span class="ml-2">-25%</span></div> <!-- price-wrap.// -->
						<a href="#" class="square_btn_4 btn-block"><i
							class="fas fa-shopping-cart pr-2"></i>Add to cart </a>
					</figcaption>
				</div>
			</div>
		</figure>
	</div> <!-- col.// -->

	<div class="col-md-4">
		<figure class="card card-product-grid">
			<div class="row">
				<div class="col-md-12 col-5 p-r-0 center-responsive">
					<div class="img-wrap img-fluid center"> 
						<img src="images/items/4.jpg">
					</div> <!-- img-wrap.// -->
				</div>
				<div class="col-md-12 col-7 p-l-0">
					<figcaption class="info-wrap">
						<h6 class="a-size-mini spacing-none line-clamp-4">
							<a href="#" class="a-color on-hover">
								<span class="a-size-base-plus a-text-normal">
									ReleTech P400 1TB M.2 PCIe 2280 NVMe Interface Internal Solid State Drive 3D-NAND Technology Gen3 x4 NVMe PC SSD Up to 3,500 MB/s (1TB)
									ReleTech P400 1TB M.2 PCIe 2280 NVMe Interface Internal Solid State Drive 3D-NAND Technology Gen3 x4 NVMe PC SSD Up to 3,500 MB/s (1TB)
								</span>
							</a>
						</h6>
						
						
						<div class="rating-wrap">
							<ul class="rating-stars">
								<li style="width:100%" class="stars-active"> 
									<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
								</li>
								<li>
									<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
								</li>
							</ul>
							<span class="label-rating text-muted"> 34 reviws</span>
						</div>
						<div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
						<div class="price-old mt-1"><span class="line-through">$189.00</span><span class="ml-2">-25%</span></div> <!-- price-wrap.// -->
						<a href="#" class="square_btn_4 btn-block"><i
							class="fas fa-shopping-cart pr-2"></i>Add to cart </a>
					</figcaption>
				</div>
			</div>
		</figure>
	</div> <!-- col.// -->

	<div class="col-md-4">
		<figure class="card card-product-grid">
			<div class="row">
				<div class="col-md-12 col-5 p-r-0 center-responsive">
					<div class="img-wrap img-fluid center"> 
						<span class="badge badge-danger"> NEW </span>
						<img src="images/items/5.jpg">
					</div> <!-- img-wrap.// -->
				</div>
				<div class="col-md-12 col-7 p-l-0">
					<figcaption class="info-wrap">
						<h6 class="a-size-mini spacing-none line-clamp-4">
							<a href="#" class="a-color on-hover">
								<span class="a-size-base-plus a-text-normal">
									ReleTech P400 1TB M.2 PCIe 2280 NVMe Interface Internal Solid State Drive 3D-NAND Technology Gen3 x4 NVMe PC SSD Up to 3,500 MB/s (1TB)
									ReleTech P400 1TB M.2 PCIe 2280 NVMe Interface Internal Solid State Drive 3D-NAND Technology Gen3 x4 NVMe PC SSD Up to 3,500 MB/s (1TB)
								</span>
							</a>
						</h6>
						
						
						<div class="rating-wrap">
							<ul class="rating-stars">
								<li style="width:100%" class="stars-active"> 
									<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
								</li>
								<li>
									<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
								</li>
							</ul>
							<span class="label-rating text-muted"> 34 reviws</span>
						</div>
						<div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
						<div class="price-old mt-1"><span class="line-through">$189.00</span><span class="ml-2">-25%</span></div> <!-- price-wrap.// -->
						<a href="#" class="square_btn_4 btn-block"><i
							class="fas fa-shopping-cart pr-2"></i>Add to cart </a>
					</figcaption>
				</div>
			</div>
		</figure>
	</div> <!-- col.// -->

	<div class="col-md-4">
		<figure class="card card-product-grid">
			<div class="row">
				<div class="col-md-12 col-5 p-r-0 center-responsive">
					<div class="img-wrap img-fluid center"> 
						<img src="images/items/6.jpg">
					</div> <!-- img-wrap.// -->
				</div>
				<div class="col-md-12 col-7 p-l-0">
					<figcaption class="info-wrap">
						<h6 class="a-size-mini spacing-none line-clamp-4">
							<a href="#" class="a-color on-hover">
								<span class="a-size-base-plus a-text-normal">
									ReleTech P400 1TB M.2 PCIe 2280 NVMe Interface Internal Solid State Drive 3D-NAND Technology Gen3 x4 NVMe PC SSD Up to 3,500 MB/s (1TB)
									ReleTech P400 1TB M.2 PCIe 2280 NVMe Interface Internal Solid State Drive 3D-NAND Technology Gen3 x4 NVMe PC SSD Up to 3,500 MB/s (1TB)
								</span>
							</a>
						</h6>
						
						
						<div class="rating-wrap">
							<ul class="rating-stars">
								<li style="width:100%" class="stars-active"> 
									<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
								</li>
								<li>
									<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
								</li>
							</ul>
							<span class="label-rating text-muted"> 34 reviws</span>
						</div>
						<div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
						<div class="price-old mt-1"><span class="line-through">$189.00</span><span class="ml-2">-25%</span></div> <!-- price-wrap.// -->
						<a href="#" class="square_btn_4 btn-block"><i
							class="fas fa-shopping-cart pr-2"></i>Add to cart </a>
					</figcaption>
				</div>
			</div>
		</figure>
	</div> <!-- col.// -->

	<div class="col-md-4">
		<figure class="card card-product-grid">
			<div class="row">
				<div class="col-md-12 col-5 p-r-0 center-responsive">
					<div class="img-wrap img-fluid center"> 
						<img src="images/items/7.jpg">
					</div> <!-- img-wrap.// -->
				</div>
				<div class="col-md-12 col-7 p-l-0">
					<figcaption class="info-wrap">
						<h6 class="a-size-mini spacing-none line-clamp-4">
							<a href="#" class="a-color on-hover">
								<span class="a-size-base-plus a-text-normal">
									ReleTech P400 1TB M.2 PCIe 2280 NVMe Interface Internal Solid State Drive 3D-NAND Technology Gen3 x4 NVMe PC SSD Up to 3,500 MB/s (1TB)
									ReleTech P400 1TB M.2 PCIe 2280 NVMe Interface Internal Solid State Drive 3D-NAND Technology Gen3 x4 NVMe PC SSD Up to 3,500 MB/s (1TB)
								</span>
							</a>
						</h6>
						
						
						<div class="rating-wrap">
							<ul class="rating-stars">
								<li style="width:100%" class="stars-active"> 
									<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
								</li>
								<li>
									<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
								</li>
							</ul>
							<span class="label-rating text-muted"> 34 reviws</span>
						</div>
						<div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
						<div class="price-old mt-1"><span class="line-through">$189.00</span><span class="ml-2">-25%</span></div> <!-- price-wrap.// -->
						<a href="#" class="square_btn_4 btn-block"><i
							class="fas fa-shopping-cart pr-2"></i>Add to cart </a>
					</figcaption>
				</div>
			</div>
		</figure>
	</div> <!-- col.// -->

	<div class="col-md-4">
		<figure class="card card-product-grid">
			<div class="row">
				<div class="col-md-12 col-5 p-r-0 center-responsive">
					<div class="img-wrap img-fluid center"> 
						<span class="badge badge-danger"> NEW </span>
						<img src="images/items/5.jpg">
					</div> <!-- img-wrap.// -->
				</div>
				<div class="col-md-12 col-7 p-l-0">
					<figcaption class="info-wrap">
						<h6 class="a-size-mini spacing-none line-clamp-4">
							<a href="#" class="a-color on-hover">
								<span class="a-size-base-plus a-text-normal">
									ReleTech P400 1TB M.2 PCIe 2280 NVMe Interface Internal Solid State Drive 3D-NAND Technology Gen3 x4 NVMe PC SSD Up to 3,500 MB/s (1TB)
									ReleTech P400 1TB M.2 PCIe 2280 NVMe Interface Internal Solid State Drive 3D-NAND Technology Gen3 x4 NVMe PC SSD Up to 3,500 MB/s (1TB)
								</span>
							</a>
						</h6>
						
						
						<div class="rating-wrap">
							<ul class="rating-stars">
								<li style="width:100%" class="stars-active"> 
									<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
								</li>
								<li>
									<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
								</li>
							</ul>
							<span class="label-rating text-muted"> 34 reviws</span>
						</div>
						<div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
						<div class="price-old mt-1"><span class="line-through">$189.00</span><span class="ml-2">-25%</span></div> <!-- price-wrap.// -->
						<a href="#" class="square_btn_4 btn-block"><i
							class="fas fa-shopping-cart pr-2"></i>Add to cart </a>
					</figcaption>
				</div>
			</div>
		</figure>
	</div> <!-- col.// -->

	<div class="col-md-4">
		<figure class="card card-product-grid">
			<div class="row">
				<div class="col-md-12 col-5 p-r-0 center-responsive">
					<div class="img-wrap img-fluid center"> 
						<span class="badge badge-danger"> NEW </span>
						<img src="images/items/3.jpg">
					</div> <!-- img-wrap.// -->
				</div>
				<div class="col-md-12 col-7 p-l-0">
					<figcaption class="info-wrap">
						<h6 class="a-size-mini spacing-none line-clamp-4">
							<a href="#" class="a-color on-hover">
								<span class="a-size-base-plus a-text-normal">
									ReleTech P400 1TB M.2 PCIe 2280 NVMe Interface Internal Solid State Drive 3D-NAND Technology Gen3 x4 NVMe PC SSD Up to 3,500 MB/s (1TB)
									ReleTech P400 1TB M.2 PCIe 2280 NVMe Interface Internal Solid State Drive 3D-NAND Technology Gen3 x4 NVMe PC SSD Up to 3,500 MB/s (1TB)
								</span>
							</a>
						</h6>
						
						
						<div class="rating-wrap">
							<ul class="rating-stars">
								<li style="width:100%" class="stars-active"> 
									<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
								</li>
								<li>
									<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
								</li>
							</ul>
							<span class="label-rating text-muted"> 34 reviws</span>
						</div>
						<div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
						<div class="price-old mt-1"><span class="line-through">$189.00</span><span class="ml-2">-25%</span></div> <!-- price-wrap.// -->
						<a href="#" class="square_btn_4 btn-block"><i
							class="fas fa-shopping-cart pr-2"></i>Add to cart </a>
					</figcaption>
				</div>
			</div>
		</figure>
	</div> <!-- col.// -->

	<div class="col-md-4">
		<figure class="card card-product-grid">
			<div class="row">
				<div class="col-md-12 col-5 p-r-0 center-responsive">
					<div class="img-wrap img-fluid center"> 
						<span class="badge badge-danger"> NEW </span>
						<img src="images/items/6.jpg">
					</div> <!-- img-wrap.// -->
				</div>
				<div class="col-md-12 col-7 p-l-0">
					<figcaption class="info-wrap">
						<h6 class="a-size-mini spacing-none line-clamp-4">
							<a href="#" class="a-color on-hover">
								<span class="a-size-base-plus a-text-normal">
									ReleTech P400 1TB M.2 PCIe 2280 NVMe Interface Internal Solid State Drive 3D-NAND Technology Gen3 x4 NVMe PC SSD Up to 3,500 MB/s (1TB)
									ReleTech P400 1TB M.2 PCIe 2280 NVMe Interface Internal Solid State Drive 3D-NAND Technology Gen3 x4 NVMe PC SSD Up to 3,500 MB/s (1TB)
								</span>
							</a>
						</h6>
						
						
						<div class="rating-wrap">
							<ul class="rating-stars">
								<li style="width:100%" class="stars-active"> 
									<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
								</li>
								<li>
									<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
								</li>
							</ul>
							<span class="label-rating text-muted"> 34 reviws</span>
						</div>
						<div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
						<div class="price-old mt-1"><span class="line-through">$189.00</span><span class="ml-2">-25%</span></div> <!-- price-wrap.// -->
						<a href="#" class="square_btn_4 btn-block"><i
							class="fas fa-shopping-cart pr-2"></i>Add to cart </a>
					</figcaption>
				</div>
			</div>
		</figure>
	</div> <!-- col.// -->

	<div class="col-md-4">
		<figure class="card card-product-grid">
			<div class="row">
				<div class="col-md-12 col-5 p-r-0 center-responsive">
					<div class="img-wrap img-fluid center"> 
						<span class="badge badge-danger"> NEW </span>
						<img src="images/items/5.jpg">
					</div> <!-- img-wrap.// -->
				</div>
				<div class="col-md-12 col-7 p-l-0">
					<figcaption class="info-wrap">
						<h6 class="a-size-mini spacing-none line-clamp-4">
							<a href="#" class="a-color on-hover">
								<span class="a-size-base-plus a-text-normal">
									ReleTech P400 1TB M.2 PCIe 2280 NVMe Interface Internal Solid State Drive 3D-NAND Technology Gen3 x4 NVMe PC SSD Up to 3,500 MB/s (1TB)
									ReleTech P400 1TB M.2 PCIe 2280 NVMe Interface Internal Solid State Drive 3D-NAND Technology Gen3 x4 NVMe PC SSD Up to 3,500 MB/s (1TB)
								</span>
							</a>
						</h6>
						
						
						<div class="rating-wrap">
							<ul class="rating-stars">
								<li style="width:100%" class="stars-active"> 
									<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
								</li>
								<li>
									<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
								</li>
							</ul>
							<span class="label-rating text-muted"> 34 reviws</span>
						</div>
						<div class="price mt-1">$179.00</div> <!-- price-wrap.// -->
						<div class="price-old mt-1"><span class="line-through">$189.00</span><span class="ml-2">-25%</span></div> <!-- price-wrap.// -->
						<a href="#" class="square_btn_4 btn-block"><i
							class="fas fa-shopping-cart pr-2"></i>Add to cart </a>
					</figcaption>
				</div>
			</div>
		</figure>
	</div> <!-- col.// -->

	
</div> <!-- row end.// -->


<nav class="mt-4" aria-label="Page navigation sample">
  <ul class="pagination">
    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>

	</main> <!-- col.// -->

</div>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

<!-- ========================= FOOTER ========================= -->
<footer class="section-footer border-top padding-y">
	<div class="container">
		<p class="float-md-right"> 
			&copy Copyright 2019 All rights reserved
		</p>
		<p>
			<a href="#">Terms and conditions</a>
		</p>
	</div><!-- //container -->
</footer>
<!-- ========================= FOOTER END // ========================= -->
@endsection

@section('js')
<script>
	function updateTextInput(val) {
          document.getElementById('range-output').value=val; 
    }
</script>
@endsection
