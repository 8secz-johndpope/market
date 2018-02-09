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
 <div class="body background-body">
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="recruiter-dirtectory-posted-by">
					<h4 class="title-aside-content">Post by</h4>
					<ul class="list-aside-content">
						<li>
		                    <a href="#" class="selected">All</a>
		                </li>
		                <li>
		                    <a href="#" class="">Direct Employers</a>
		                </li>
		                <li>
		                    <a href="#" class="">Recruitment Agencies</a>
		                </li>
					</ul>
				</div>
				<div class="recruiter-dirtectory-specialism">
					<h4 class="title-aside-content">Filter by Specialism</h4>
					<ul class="list-aside-content">
						@foreach($sectors as $sector)
						<li>
			                <a href="#" class="selected">{{$sector->title}}</a>
			            </li>
						@endforeach
					</ul>
				</div>
			</div>
			<div class="recruiter-directory-main-content col-sm-9">
				<div class="row">
					<div class="col-sm-8">
						<div class="recruiter-directory-main-content-title">
				            <h1 class="main-title">Explore Companies</h1>
				            <h2>Browse offices before you apply.</h2>
				        </div>
			    	</div>
			    	<div class="col-sm-4">
			    		<p>We think company culture is pretty important. We show you inside offices before you apply to make sure you'll love working there.</p>
			    	</div>
		    	</div>
	            <div class="recruiter-directory-main-content-logos row">
	            	@foreach($companies as $company)
	            	<div class="col-sm-3 text-center">
	            		<div class="profile">
		            		<div class="profile-thumb">
		            			<a href="#" class="profile-link">
		            				<img class="profile-img" src="{{env('AWS_WEB_IMAGE_URL')}}/{{$company->logo}}">
		            			</a>
		            		</div>
		            		<div class="subtitle">
		            			<a href="#">{{$company->name}}</a>
		            			<span class="count-jobs-company">(0)</span>
		            		</div>
	            		</div>
	            	</div>
	            	@endforeach
	            </div>
	            <div class="pagination-container">
	            	<div class="pagination-new">
	            		{{ $companies->links()}}
	            	</div>
	            </div>
			</div>
		</div>
	</div>
	<div class="container-search-section-title">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">	
					<h1 class="search-section-title">
						Search Recruiters
					</h1>
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