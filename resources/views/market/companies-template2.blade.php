@extends('layouts.app')

@section('title', env('APP_NAME').' | Uber')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
 <link href="{{asset('/css/company-profile2.css?q=874')}}" rel="stylesheet">
 <div class="body">
	<div class="container">
		<div class="row">
			<!-- div info-content -->
			<div class="col-sm-8">
				<div class="title-block">
					<h1>We are<br><div class="big-title">UBER</div></h1>
				</div>
				<div class="btn-row">
					<a class="see-job blue-solid-button-xs" href="/jobs/uber" alt="Uber Careers - See Our Jobs">See Our Jobs</a>
					<a class="next-company lt-grey-solid-button-xs" alt="Uber Careers - Next Company" href="/random/company">Next Company</a>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="logo-block">
					<a href="/companies/uber"><img src="https://assets.themuse.com/uploaded/companies/61/small_logo.png?v=None" alt="Uber Careers"></a>
				</div>
				<div class="metadata">
					<ul>
						<li class="field_company_type">
							<i class="fa fa-home" aria-hidden="true"></i>
							<a href="/companies?company_industry=Travel%20and%20Hospitality">Travel and Hospitality</a>
						</li>
						<li class="field_company_size">
							<i class="fa fa-user" aria-hidden="true"></i>
							<a href="/companies/?company_size=Large Size">Large Size</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-8">
				<a href="/companies/uber/offices">
					<div class="grid_2_2">
						<img src="https://pilbox.themuse.com/image.jpg?url=https%3A%2F%2Fassets.themuse.com%2Fuploaded%2Fcompanies%2F61%2Fpages%2F674%2Ff1.jpg%3Fv%3DNone&amp;h=960&amp;w=1300" class="share-base" alt="Uber Careers">
						<div class="text-lower-right gradient"><h2>Our Office</h2></div>
					</div>
				</a>
			</div>
			<div class="col-sm-4">
				<div class="grid_1_1">
					<img src="https://pilbox.themuse.com/image.jpg?url=https%3A%2F%2Fassets.themuse.com%2Fuploaded%2Fcompanies%2F61%2Fpages%2F674%2Ff2.jpg%3Fv%3DNone&amp;h=235&amp;w=320" alt="Uber Careers">
					<div class="text-lower-right gradient">
						<p>We work &amp; ride in San Francisco</p>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="grid_1_1">
					<img src="https://pilbox.themuse.com/image.jpg?url=https%3A%2F%2Fassets.themuse.com%2Fuploaded%2Fcompanies%2F61%2Fpages%2F674%2Ff3.jpg%3Fv%3DNone&amp;h=235&amp;w=320" alt="Uber Careers">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
			</div>
			<div class="col-sm-4">
			</div>
			<div class="col-sm-4">
			</div>
		</div>
	</div>
</div>
@endsection