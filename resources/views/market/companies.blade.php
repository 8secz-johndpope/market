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
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="sub-heading">	
							<h1>
								Search Recruiters
							</h1>
							<h2>Over 1,000 the best companies. Find yours.</h2>
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
									<div>
										<div class="location-wrapper">
											<form class="landing-location-filter">
												<input type="search" placeholder="Location" id="job_locationautocomplete" autocomplete="off" tabindex="2" aria-label="location input">
												<div aria-hidden="true" class="autocomplete-wrapper">
												</div>
											</form>
										</div>
									</div>
									<a href="#">Search</a>
									<a class="show-all-jobs" href="#">
										<p>Show Me All Jobs</p>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12">
				<div class="search-companies">
					<div class="search-companies-center">
						<div class="search-companies-wrap">
							<ul class="nav nav-tabs">
								<li class="active">
									<a href="#search-companies" data-toggle="tab">Employers</a>
								</li>
								<li>
									<a href="#search-companies" data-toggle="tab">Recruitment Agencies</a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="search-companies-search fade in">
									<h2>Search Employers</h2>
									<form action="">
										<input type="text" name="q" value="" placeholder="Employer Name">
										<input type="submit" value="Search Employers">
									</form>
									<h3>Employers Directory A-Z</h3>
									<ul class="search-companies-az">
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
</div>
@endsection