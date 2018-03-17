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
 
<div class="body background-body loaded search-cvs-page">
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
				<div class="col-md-12 block-grey">
					<header class="heading-container">
						<h3>Profile & CV Search features</h3>
						<hr>
					</header>
					<div class="row cvsearch-benefits">
						<article class="col-md-4">
							<h4>Access Multiple Profiles & CVs</h4>
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
									<li class="is-active">•</li>
									<li>•</li>
									<li>•</li>
									<li>•</li>
									<li>•</li>
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
			</div>
		</div>
	</section>
	<section class="cvsearch-prices">
		<div class="container">
			<div class="row">
				<div class="col-md-12 block-grey">
					<header class="heading-container">
						<h3>Profile & CV Search prices</h3>
					</header>
					<div class="profilesearch-price-table">
						<div class="row">
							<div class="col-md-3">
								<table>
									<tbody>
										<tr>
											<p class="profilesearch-type">
												Profile & CV Search
												<br>
												1 day 
											</p>
											<p class="profilesearch-cost">
												£35
												<span>+ VAT</span> 
											</p>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td>
												<a class="btn btn-primary">Buy now</a>
											</td>
										</tr>
									</tfoot>
								</table>
							</div>
							<div class="col-md-3">
								<table>
									<tbody>
										<tr>
											<p class="profilesearch-type">
												Profile & CV Search
												<br>
												1 week 
											</p>
											<p class="profilesearch-cost">
												£150
												<span>+ VAT</span> 
											</p>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td>
												<a class="btn btn-primary">Buy now</a>
											</td>
										</tr>
									</tfoot>
								</table>
							</div>
							<div class="col-md-3">
								<table>
									<tbody>
										<tr>
											<p class="profilesearch-type">
												Profile & CV Search
												<br>
												1 month 
											</p>
											<p class="profilesearch-cost">
												£500
												<span>+ VAT</span> 
											</p>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td>
												<a class="btn btn-primary">Buy now</a>
											</td>
										</tr>
									</tfoot>
								</table>
							</div>
							<div class="col-md-3">
								<table>
									<tbody>
										<tr>
											<p class="profilesearch-type">
												Profile & CV Search
												<br>

												<br>
												12 month 
											</p>
											<p class="profilesearch-cost">
												Credit Contract 
												<span>90 days credit</span> 
											</p>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td>
												<a class="btn btn-primary">Buy now</a>
											</td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

@endsection