@extends('layouts.app')

@section('title', env('APP_NAME'). ' CV Search | Find Employee & Worker CVs')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@php
    $date = new Datetime();
    $dateMs = $date->getTimestamp();
@endphp
@section('styles')
<link href="{{ asset("/css/cv-prices.css?q=$dateMs") }}" rel="stylesheet">
<link rel="stylesheet" href="/build/css/intlTelInput.css">
@endsection

@section('content')
 
<div class="body loaded search-cvs-page">
	<section class="top-block">
		<div class="bg-image">
			<h1>Profile & CV Search</h1>
			<div class="ctas text-center">
				<p>Headhunt the candidates that you need</p>
			</div>
		</div>
	</section>
	<section class="cvsearch-features">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<header class="heading-container">
						<h3>Profile & CV Search features</h3>
						<hr>
					</header>
					<div class="row cvsearch-benefits">
						<article class="col-md-4">
							<h4>Access to 10.1 million Profiles & CVs</h4>
							<p>Target by Skills, job title, salary, location, education and more</p>
						</article>
						<article class="col-md-4">
							<h4>Preview candidates</h4>
							<p>Preview a candidate's profile before viewing their Profile</p>
						</article>
						<article class="col-md-4">
							<h4>Stay updated</h4>
							<p>Be the first to know about new candidates with daily email alerts</p>
						</article>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 profilesearch-example-container">
					<div class="profilesearch-desktop">
						<div class="profilesearch-web">
							<div class="profilesearch-web-wrapper">
								<img class="screenshot" src="">
							</div>
						</div>
						<div class="profilesearch-zoom">
							<span>&nbsp;</span>
						</div>
						<ul class="profilesearch-page-selector">
							<li></li>
							<li></li>
							<li></li>
							<li></li>
							<li></li>
						</ul>
						<div class="profilesearch-description">
							<header>
								<p class="lense-header">View CVs</p>
							</header>
							<p class="lense-description">
								Save CVs as Word or PDF documents & view candidate profiles online. You can access up to 100 new candidate CVs per day.
							</p>
						</div>
						<span class="prev">previous</span>
						<span class="next">Next</span>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="cvsearch-prices">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<header class="heading-container">
						<h3>Profile & CV Search prices</h3>
					</header>
					<div class="profilesearch-price-table">
						<div class="row">
							<div class="col-md-3">
								
							</div>
							<div class="col-md-3"></div>
							<div class="col-md-3"></div>
							<div class="col-md-3"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

@endsection