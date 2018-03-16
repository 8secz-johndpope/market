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
			<p>Headhunt the candidates that you need</p>
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
						<article class="col-md-4"></article>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

@endsection