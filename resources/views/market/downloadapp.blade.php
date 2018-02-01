@extends('layouts.app')

@section('title', env('APP_NAME'). ' Mobile Apps')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@section('styles')
<link href="{{ asset('/css/download.css?q=874') }}" rel="stylesheet">
<link rel="stylesheet" href="/build/css/intlTelInput.css">
@endsection

@section('content')
 
<div class="body loaded">
	<div id="wrapper-inner">
		<div class="main">
			<section id="banner-page" class="app-page">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-xs-12">
							<h1 class="download-subtitle">Search or apply or chat or buy & sell securely</h1>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-xs-12">
							<h2 class="download-subtitle">Connect, call & videocall, list & sell, browse & buy, refer & earn unlimited</h2> 
							<h1 class="download-title">Get the App on the go. <span>FREE</span></h1>
							<div class="app-store-badges">
								<a href="#" class="appstore-link" target="_blank">Download</a>
								<a href="#" class="google-play-link" target="_blank">Download</a>
							</div>
							<div class="instructions">
								<p class="instructions-sms active">Enter your number and we'll text you a link to download the app!</p>
							</div>
							<div class="form-wrapper">
								<form id="form-sms" action="" class="active">
									<div class="fields-container clearfix">
										<div class="field-wrapper phone-number-wrapper">
											<input type="tel" name="phone-number" id="phone-number" class="form-control">
										</div>
										<div class="field-action-wrapper">
											<button type="submit" class="btn btn-submit">Text me the link</button>
										</div>
									</div> 
								</form>
								<div class="field field-error">
									Something went wrong. Please check your phone number and try again.
								</div>
							</div>
							<div class="available-devices clearfix">
								<p>Available for</p>
								<ul>
									<li>
										<img src="/css/icon-iphone-x.png" alt="iphone">
										<p>iPhone</p>
									</li>
									<li>
										<img src="/css/icon-ipad.png" alt="ipad">
										<p>iPad</p>
									</li>
									<li>
										<img src="/css/icon-phone-android.png" alt="android">
										<p>Android</p>
									</li>
								</ul>
							</div>
							<div class="clause">
								<p class="clause-sms active">Standard messaging and data fees may apply.</p>
								<p class="clause-email">Your email address will not be stored or used for any other purposes.</p>
							</div>
						</div>
						<div class="mobile-devices"></div>
					</div>
				</div>
			</section>
		</div>
		<div class="app-curve">
			<img src="https://about.canva.com/wp-content/themes/canvaabout/img/canva-app/app-curve.svg" alt="">
		</div>
		<div class="content-info features">
			<div class="container">
				<div class="container-key-features">
					<div class="row">
						<div class="col-sm-6 col-sm-offset-6 text-center">
							<h2 class="donwload-subtitle">Unique Integrated Tools</h2>
							<p class="content-integrated">Our app and platform includes propertary software products that provides a safe environment for search, communication and transactions</p>
							<a href="#" class="btn btn-below">Download below</a>
						</div>
					</div>
					<div class="ipad-devices">
					</div>
				</div>
			</div>
			<div class="features-navigation">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 col-xs-12">
							<div class="row">
								<div class="col-sm-3 col-xs-6">
									<div class="wrapper-feature">
										<div class="feature-icon">
										</div>
										<div class="feature-content">
											<h4 class="feature-title">Shop & ship safely</h4>
										</div>
									</div>
								</div>
								<div class="col-sm-3 col-xs-6">
									<div class="wrapper-feature">
										<div class="feature-icon">
											<i class="icon icon-sell-fast"></i>
										</div>
										<div class="feature-content">
											<h4 class="feature-title">Sell fast</h4>
										</div>
									</div>
								</div>
								<div class="col-sm-3 col-xs-6">
									<div class="wrapper-feature">
										<div class="feature-icon">
											<i class="icon icon-sell-fast"></i>
										</div>
										<div class="feature-content">
											<h4 class="feature-title">Buy easily</h4>
										</div>
									</div>
								</div>
								<div class="col-sm-3 col-xs-6">
									<div class="wrapper-feature">
										<div class="feature-icon">
											<i class="icon icon-sell-fast"></i>
										</div>
										<div class="feature-content">
											<h4 class="feature-title">Pay securely</h4>
										</div>
									</div>
								</div>
								<div class="col-sm-3 col-xs-6">
									<div class="wrapper-feature">
										<div class="feature-icon">
											<i class="icon icon-sell-fast"></i>
										</div>
										<div class="feature-content">
											<h4 class="feature-title">Connect socially</h4>
										</div>
									</div>
								</div>
								<div class="col-sm-3 col-xs-6">
									<div class="wrapper-feature">
										<div class="feature-icon">
											<i class="icon icon-sell-fast"></i>
										</div>
										<div class="feature-content">
											<h4 class="feature-title">Chat, call & videocall</h4>
										</div>
									</div>
								</div>
								<div class="col-sm-3 col-xs-6">
									<div class="wrapper-feature">
										<div class="feature-icon">
											<i class="icon icon-sell-fast"></i>
										</div>
										<div class="feature-content">
											<h4 class="feature-title">Refer & earn unlimited</h4>
										</div>
									</div>
								</div>
								<div class="col-sm-3 col-xs-6">
									<div class="wrapper-feature">
										<div class="feature-icon">
											<i class="icon icon-sell-fast"></i>
										</div>
										<div class="feature-content">
											<h4 class="feature-title">Trusted support</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<script src="/build/js/intlTelInput.js"></script>
<script>
	$("#phone-number").intlTelInput();
</script>
@endsection