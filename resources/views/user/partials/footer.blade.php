<!-- ========================= FOOTER ========================= -->
<footer class="section-footer border-top bg-white shadow-top">
	<div class="container">
		<section class="footer-top padding-y">
			<div class="row">
				<aside class="col-md col-6">
					<h6 class="title">Brands</h6>
					<ul class="list-unstyled">
						@foreach($brands as $brand)
						<li> <a href="{{ route('brand', $brand->slug ) }}">{{ $brand->name }}</a></li>
						@endforeach
					</ul>
				</aside>
				<aside class="col-md col-6">
					<h6 class="title">Company</h6>
					<ul class="list-unstyled">
						<li> <a href="{{ route('about-us') }}">About us</a></li>
						{{-- <li> <a href="#">Career</a></li> --}}
						<li> <a href="{{ route('privacy-policy') }}">Privacy policy</a></li>
						<li> <a href="#">Terms and conditions</a></li>
						{{-- <li> <a href="#">Sitemap</a></li> --}}
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
						<li> <a href="/login"> User Login </a></li>
						<li> <a href="/register"> User register </a></li>
						<li> <a href="/account"> Account Setting </a></li>
						<li> <a href="account/orders"> My Orders </a></li>
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
			<div class="col-md-3">
				<p class="text-muted"> &copy <script>document.write(new Date().getFullYear());</script> {{ config('settings.site_name') }} </p>
			</div>
			<div class="col-md-7 text-md-center">
				<span  class="px-2">{{ config('settings.default_email_address') }}</span>
				{{-- <span  class="px-2">+879-332-9375</span>
				<span  class="px-2">Street name 123, Avanue abc</span> --}}
			</div>
			<div class="col-md-2 text-md-right text-muted">
				<i class="fab fa-lg fa-cc-visa"></i>
				<i class="fab fa-lg fa-cc-paypal"></i>
				<i class="fab fa-lg fa-cc-mastercard"></i>
			</div>
		</section>
	</div><!-- //container-fluid -->
</footer>