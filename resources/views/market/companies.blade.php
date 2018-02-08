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
				<div class="recruiter-directory-main-content-title">
		            <h1 class="main-title">All hiring now</h1>
		        </div>
	            <div class="recruiter-directory-main-content-logos row">
	            	@foreach($companies as $company)
	            	<div class="col-sm-4 text-center">
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
</div>
@endsection