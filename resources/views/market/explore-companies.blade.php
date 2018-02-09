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
					<div class="row">
						<div class="col-sm-8">
							<h1 class="main-title">Explore Companies</h1>
					        <h2>Browse offices before you apply.</h2>
				    	</div>
				    	<div class="col-sm-4">
				    		<p>We think company culture is pretty important. We show you inside offices before you apply to make sure you'll love working there.</p>
				    	</div>
				    </div>
		    	</div>
	            <div class="recruiter-directory-main-content-logos row">
	            	<div class="col-sm-10 col-sm-offset-1">
	            		<div class="row">
			            	@foreach($companies as $company)
			            	@if($loop->index == 6)
			            		<div class="col-sm-12 container-immediate text-center">
				            		<h2 class="immediate-title">
				            			SOME LATEST JOBS YOU MIGHT LIKE
				            		</h2>
				            		<div class="row">
					            		<div class="col-sm-4 col-sm-offset-4 container-actions-immediate">
					            			<a href="/jobs/uk" class="btn btn-see-jobs">SEE JOBS</a>
					            		</div>
				            		</div>
			            		</div>
			            	@endif
			            	<div class="col-sm-4 text-center">
			            		<div class="profile">
				            		<div class="profile-thumb">
				            			<a href="#" class="profile-link">
				            				<img class="profile-img" src="{{env('AWS_WEB_IMAGE_URL')}}/{{$company->logo}}">
				            			</a>
				            		</div>
				            		<div class="subtitle">
				            			<a href="#">{{$company->name}}</a>
				            			<span class="count-jobs-company">
				            				@if(isset($company->user))
				            					({{count($company->user->adverts)}})
				            				@else
				            					(0)
				            				@endif
				            			</span>
				            		</div>
				            		<div class="alert-container">
				            			<div>
											<a aria-label="company-alert" href="#" class="company-alert">
												<i aria-hidden="true" class="icon icon-bell"></i>
											</a>
										</div>
				            		</div>
				            		<div class="favorite-container">
										<div>
											<div class="favor">
												<i aria-hidden="true" class="heart-empty favroite-icon" data-id="{{$company->id}}"></i>
												<span class="favor-text">SAVE</span>
											</div>
										</div>
		            				</div>
			            		</div>
			            	</div>

			            	@endforeach
		            	</div>
	            	</div>
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