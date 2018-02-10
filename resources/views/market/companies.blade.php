@extends('layouts.app')

@section('title', env('APP_NAME'))

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@php
    $date = new Datetime();
    $dateMs = $date->getTimestamp();
@endphp
@section('content')
 <link href="{{asset("/css/companies.css?q=$dateMs")}}" rel="stylesheet">
 <div class="body background-body page-companies">
	<div class="top-hero-section">
		<div class="bg-image">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-12">
						<div class="sub-heading">	
							<h1>
								Search Recruiters
							</h1>
							<h2>Over 10,000 of the best recruiters. Find yours.</h2>
							<div class="filters-jobs">
								<div class="filter-wrapper clearfix">
									<div class="keyword-wrapper">
										<div>
											<form>
												<div class="keyword-input">
													<input aria-label="keyword input" type="search" placeholder="Keywords or Company Name">
													<div aria-hidden="true" class="autocomplete-wrapper">
													</div>
												</div>
											</form>
										</div>
									</div>
									<a href="#" class="tm-brighter-blue-square-button filter-search-button">Search</a>
									<a class="show-all-jobs" href="/explore-companies">
										<p>Show Me All Companies</p>
									</a>
								</div>
								<div class="directory-companies-wrapper">
									<h2>Directory A-Z</h2>
									<ul class="search-companies-az clearfix">
										<li><a href="">0-9</a></li>
										<li><a href="">A</a></li>
										<li><a href="">B</a></li>
										<li><a href="">C</a></li>
										<li><a href="">D</a></li>
										<li><a href="">E</a></li>
										<li><a href="">F</a></li>
										<li><a href="">G</a></li>
										<li><a href="">H</a></li>
										<li><a href="">I</a></li>
										<li><a href="">J</a></li>
										<li><a href="">K</a></li>
										<li><a href="">L</a></li>
										<li><a href="">M</a></li>
										<li><a href="">N</a></li>
										<li><a href="">O</a></li>
										<li><a href="">P</a></li>
										<li><a href="">Q</a></li>
										<li><a href="">R</a></li>
										<li><a href="">S</a></li>
										<li><a href="">T</a></li>
										<li><a href="">U</a></li>
										<li><a href="">V</a></li>
										<li><a href="">W</a></li>
										<li><a href="">Y</a></li>
										<li><a href="">Z</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="top-searches-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="top-searches">
						<h3>top-searches</h3>
						<ul>
							@foreach($companies as $company)
							<li><a href="#">{{$company->name}}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<a href="#">
						<div class="recruiter-feature-box featured">
							<div class="bg-image">
								<div class="title-copy">
									<h3>Featured Recruiters</h3>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="col-sm-6">
					<a href="#">
						<div class="recruiter-feature-box immediate">
							<div class="bg-image">
								<div class="title-copy">
									<h3>Immediate Start Vacancies</h3>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="recruiter-feature-box most-jobs">
						<div class="bg-image">
							<div class="title-copy">
								<div class="title-copy">
									<h3>Recruiters With Most Jobs</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="recruiter-feature-box">
						<div class="bg-image">
							<div class="title-copy">
								<h3>Showcased Companies</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection