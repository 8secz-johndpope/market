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
								<div class="filters-tab">
									<ul class="nav nav-tabs">
										<li class="active">
											<a data-toggle="tab" href="#tab-employers">Employers</a>
										</li>
										<li>
											<a data-toggle="tab" href="#tab-recruiters">Recruiters</a>
										</li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane fade in active" id="tab-employers">
											<div class="filter-wrapper clearfix">
												<div class="keyword-wrapper">
													<div>
														<form action="/companies/employers" id="form-search-employer">
															<div class="keyword-input">
																<input aria-label="keyword input" type="search" placeholder="Keywords or Company Name" name="q">
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
												<h2>Employers Directory A-Z</h2>
												<ul class="search-companies-az clearfix">
													<li><a href="/companies/employers/0-9">0-9</a></li>
													<li><a href="/companies/employers/A">A</a></li>
													<li><a href="/companies/employers/B">B</a></li>
													<li><a href="/companies/employers/C">C</a></li>
													<li><a href="/companies/employers/D">D</a></li>
													<li><a href="/companies/employers/E">E</a></li>
													<li><a href="/companies/employers/F">F</a></li>
													<li><a href="/companies/employers/G">G</a></li>
													<li><a href="/companies/employers/H">H</a></li>
													<li><a href="/companies/employers/I">I</a></li>
													<li><a href="/companies/employers/J">J</a></li>
													<li><a href="/companies/employers/K">K</a></li>
													<li><a href="/companies/employers/L">L</a></li>
													<li><a href="/companies/employers/M">M</a></li>
													<li><a href="/companies/employers/N">N</a></li>
													<li><a href="/companies/employers/O">O</a></li>
													<li><a href="/companies/employers/P">P</a></li>
													<li><a href="/companies/employers/Q">Q</a></li>
													<li><a href="/companies/employers/R">R</a></li>
													<li><a href="/companies/employers/S">S</a></li>
													<li><a href="/companies/employers/T">T</a></li>
													<li><a href="/companies/employers/U">U</a></li>
													<li><a href="/companies/employers/V">V</a></li>
													<li><a href="/companies/employers/W">W</a></li>
													<li><a href="/companies/employers/Y">Y</a></li>
													<li><a href="/companies/employers/Z">Z</a></li>
												</ul>
											</div>
										</div>
										<div class="tab-pane fade" id="tab-recruiters">
											<div class="filter-wrapper clearfix">
												<div class="keyword-wrapper">
													<div>
														<form>
															<div class="keyword-input">
																<input aria-label="keyword input" type="search" placeholder="Keywords or Recruiters Name">
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
												<h2>Recruitment Agencies Directory A-Z</h2>
												<ul class="search-companies-az clearfix">
													<li><a href="/companies/recruiters/0-9">0-9</a></li>
													<li><a href="/companies/recruiters/A">A</a></li>
													<li><a href="/companies/recruiters/B">B</a></li>
													<li><a href="/companies/recruiters/C">C</a></li>
													<li><a href="/companies/recruiters/D">D</a></li>
													<li><a href="/companies/recruiters/E">E</a></li>
													<li><a href="/companies/recruiters/F">F</a></li>
													<li><a href="/companies/recruiters/G">G</a></li>
													<li><a href="/companies/recruiters/H">H</a></li>
													<li><a href="/companies/recruiters/I">I</a></li>
													<li><a href="/companies/recruiters/J">J</a></li>
													<li><a href="/companies/recruiters/K">K</a></li>
													<li><a href="/companies/recruiters/L">L</a></li>
													<li><a href="/companies/recruiters/M">M</a></li>
													<li><a href="/companies/recruiters/N">N</a></li>
													<li><a href="/companies/recruiters/O">O</a></li>
													<li><a href="/companies/recruiters/P">P</a></li>
													<li><a href="/companies/recruiters/Q">Q</a></li>
													<li><a href="/companies/recruiters/R">R</a></li>
													<li><a href="/companies/recruiters/S">S</a></li>
													<li><a href="/companies/recruiters/T">T</a></li>
													<li><a href="/companies/recruiters/U">U</a></li>
													<li><a href="/companies/recruiters/V">V</a></li>
													<li><a href="/companies/recruiters/W">W</a></li>
													<li><a href="/companies/recruiters/Y">Y</a></li>
													<li><a href="/companies/recruiters/Z">Z</a></li>
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
		</div>
	</div>
	<div class="top-searches-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="top-searches">
						<h3>top-searches</h3>
						<ul>
							@foreach($firstCompanies as $company)
							<li><a href="#">{{$company->name}}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	@if(!isset($companies))
	<div class="container">
		<div class="row block">
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
				<a href="/jobs/uk">
					<div class="recruiter-feature-box immediate">
						<div class="bg-image">
							<div class="title-copy">
								<h3>Latest Vacancies</h3>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="row block">
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
				<div class="recruiter-feature-box showcased-companies">
					<div class="bg-image">
						<div class="title-copy">
							<h3>Showcased Companies</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@else
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="search-companies-result-title">
					<h1>Recruitment starting with {{$letter}}</h1>
					@if($companies->count() > 0)
						<p>{{$companies->total()}} Recruiters</p>
					@else
						<p>Sorry, there are no recruitment agencies found for {{$letter}}</p>
					@endif
				</div>
			</div>
			@if($companies->count() > 0)
			<div class="col-xs-12">
				<div class="companies-wrapper">
					<div class="row">
						@foreach($companies as $company)
						@if($loop->index == 8)
							<div class="col-xs-12 let-us-help-wrapper container-emailme">
								<div class="let-us-help-content">
									<div class="">
								        <div class="container-emailme-header text-center">
								        	<h3>Let Us Help With Your Search</h3>
								        </div>
								        <div class="container-emailme-form text-center">
								            <p>Submit and sit back. We'll send you opportunities you'll actually love and some helpful advice to help make the search stress free.</p>
								            <div class="row">
								                <div class="col-sm-offset-3 col-sm-6">
								                    <form action="" id="sendme-search">
								                        <div class="form-group">
								                            <div class="input-group">
								                                <span class="input-group-addon" id="email-sendme">Email</span>
								                                <input type="text" class="form-control" placeholder="example@email.com" aria-describedby="email-sendme">
								                            </div>
								                        </div>
								                        <!-- <div class="form-group">
								                            <input type="tel" id="phone-number-1" class="form-control" placeholder="00447777777777" aria-describedby="phone-sendme">
								                        </div>-->
								                        <div class="form-group">
								                            <input type="submit" name="submit-sendme" class="btn btn-submit">
								                        </div>
								                    </form>
								                </div>
								            </div>
								            <small>By clicking Submit, you accept our <a>Terms & Conditions</a>, <a>Privacy policy</a> and consent to messages</small>
								        </div>
								    </div>
								</div>
							</div>
						@endif
						<div class="col-sm-3">
							<div class="profile">
			            		<div class="profile-thumb">
			            			<a href="#" class="profile-link">
			            				<img class="profile-img" src="{{env('AWS_WEB_IMAGE_URL')}}/{{$company->logo}}">
			            			</a>
			            		</div>
			            		<div class="subtitle text-center">
			            			<a href="#">{{$company->name}}</a>
			            			<span class="count-jobs-company">
			            				@if(isset($company->user))
			            					({{$company->user->countAdverts()}})
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
				<div class="pagination-container">
	            	<div class="pagination-new">
	            		{{ $companies->links()}}
	            	</div>
	            </div>
			</div>
			@endif
		</div>
	</div>
	@endif
	<!-- </div> -->
</div>
<script>
	$('.filter-search-button').click(function(e){
		e.preventDefault();
		$('#form-search-employer').submit();
	});
</script>
@endsection