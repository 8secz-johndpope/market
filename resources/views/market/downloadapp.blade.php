@extends('layouts.app')

@section('title', env('APP_NAME'). ' Mobile Apps')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@section('styles')
<link href="{{ asset('/css/download.css?q=874') }}" rel="stylesheet">
@endsection

@section('content')
 
<div class="body">
<div class="container">
	<div class="row hidden-xs">
		 <div class="col-md-6 col-sm-12">
		 	<div class="nav-back">
		 	<a href="{{ url()->previous()}}"> < Go back to advert</a>
		 	</div>
		 </div>
	</div>
	<div class="row">
		<div class="col-md-6 col-sm-12 main-header">
			<div class="main-container">
				<div class="content-header">
					<img src="/img/buyer-seller.jpg" class="visible-xs">
					<img src="/img/iphone2.png" class="hidden-xs">
				</div>
			</div>
		</div>
		<div class="col-md-6 col-sm-12 visible-xs">
		 	<div class="nav-back">
		 	<a href="{{ url()->previous()}}"> < Go back to advert</a>
		 	</div>
		 </div>
		<div class="col-md-6 col-sm-12 main-body">
			<div class="main-container">
				<div class="content-top">
					<img src="/css/ic_launcher1.png" class="logo hidden-xs">
					<h1>The {{ env('APP_NAME') }} APP</h1>
					<h2>Connect, search, find, buy - <span>get it on the go</span></h2>
					<div class="visible-xs">
						<div class="stores-buttons">
							<a href="#" title="{{ env('APP_NAME') }} app for iPhone">
								<img src="/css/appstorex233.png" alt="Available on the Apple Store">
							</a>
							<a href="#" title="{{ env('APP_NAME') }} app for Android">
								<img src="/css/googleplayx233.png" alt="Get it on Google Play">
							</a>
						</div>
					</div>
					<p>Whichever way you connect with {{ env('APP_NAME') }}, it is always there for you.</p>
				</div>
				<div class="content-middle">
					<div>
						<h2>Anytime -</h2>
						<p>{{ env('APP_NAME') }} is always open, wherever you are.</p>
					</div>
					<div>
						<h2>Find -</h2>
						<p>All it takes is a few clicks to discover a world of opportunity on your doorstep</p>
					</div>
					<div>
						<h2>Connect -</h2>
						<p>Found something you like? Send a message, make a call or videocall and await a speedy response.</p>
					</div>
					<div>
						<h2>Sell -</h2>
						<p>Post and ad directly from your smart phone, and let the buyers come to you.</p>
					</div>
					<div>
						<h2>Share -</h2>
						<p>Link your items to social media quickly and conveniently, and spread the word.</p>
					</div>
					<div>
						<h2>Manage -</h2>
						<p>Search, save and sync, so you never miss out on a deal again.</p>
					</div>
					<div>
						<h2>Simple -</h2>
						<p>It takes seconds to access the most straightforward marketplace you'll find.</p>
					</div>
					<p class="highlight">
						On Android, iPhone and iPad. Just tap and go.
					</p>
				</div>
				<div class="stores-buttons hidden-xs">
					<a href="#" title="{{ env('APP_NAME') }} app for iPhone">
						<img src="/css/appstorex233.png" alt="Available on the Apple Store">
					</a>
					<a href="#" title="{{ env('APP_NAME') }} app for Android">
						<img src="/css/googleplayx233.png" alt="Get it on Google Play">
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection