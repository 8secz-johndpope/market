@extends('layouts.recruiters')

@section('title', env('APP_NAME').' | Contact - Template Uber')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@section('content')
 <link href="{{ asset('/css/css/font-awesome.min.css?q=874') }}" rel="stylesheet">
 <link href="{{asset('/css/template-job.css?q=874')}}" rel="stylesheet">
 <div class="body">
	<div class="container-fluid">
		<div class="row header-container">
			<div class="col-sm-12">
				<div id="top-image" class="bg-image">
					<h1>Safety Lead UKI</h1>
					<div class="ctas text-center">
						<a class="tm-bright-blue-round-button apply-external hidden-xs" href="https://careers-uber.icims.com/jobs/34729/safety-lead-uki/job?iis=The+Muse&amp;iisn=The+Muse&amp;mode=job" target="_blank" alt="Safety Lead UKI - Apply Now">
							Apply Now 
							<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="white-container">
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="job-side-section sidebar-content">
						<a id="company-logo-link" href="/companies/uber">
							<img class="company-logo" src="https://assets.themuse.com/uploaded/companies/61/small_logo.png?v=None" alt="Safety Lead UKI">
						</a>
						<a id="company-name-link" class="company-link visible-xs see-more-link" href="/companies/uber">
							Uber
							<span aria-hidden="true" class="no-wrap-space">
								<i aria-hidden="true" class="fa fa-long-arrow-right"></i>
							</span>
						</a>
						<p class="hidden-xs">
							Uber is your on-demand private driver. Request a ride at any time, to wherever you’re going, with Uber’s iPhone and Android apps.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection