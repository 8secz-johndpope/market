@extends('layouts.app')

@section('title', env('APP_NAME').' | Uber')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
 <link href="{{asset('/css/company-profile2.css?q=874')}}" rel="stylesheet">
 <link href="{{ asset('/css/css/font-awesome.min.css?q=874') }}" rel="stylesheet">
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
				<a href="/companies/uber/people/brian&#10;&#10;" data-person-id="182" data-person-short-name="brian" data-person-position="0">
					<div class="spotlight grid_1_2">
						<img src="https://assets.themuse.com/uploaded/companies/61/people/182-small.jpg?v=None" alt="Brian McMullen, Community Management Specialist - Uber Careers">
						<div class="spotlight-about">
							<div class="spotlight-name">Brian McMullen</div>
							<div class="spotlight-title">Community Management Specialist</div>
							<div class="spotlight-clicktomeet">
								Click to meet Brian 
								<i class="fa fa-long-arrow-right"></i>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-sm-4">
				<a href="/companies/uber/people/swathy&#10;&#10;" data-person-id="184" data-person-short-name="swathy" data-person-position="1">
					<div class="spotlight grid_1_2">
						<img src="https://assets.themuse.com/uploaded/companies/61/people/184-small.jpg?v=None" alt="Swathy Prithivi, Operations &amp; Logistics Manager - Uber Careers">
						<div class="spotlight-about">
						<div class="spotlight-name">Swathy Prithivi</div>
						<div class="spotlight-title">Operations &amp; Logistics Manager</div>
						<div class="spotlight-clicktomeet">
							Click to meet Swathy 
							<i class="fa fa-long-arrow-right"></i>
						</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-sm-4">
				<a href="/companies/uber/people/jess&#10;&#10;" data-person-id="183" data-person-short-name="jess" data-person-position="2">
					<div class="spotlight grid_1_2">
						<img src="https://assets.themuse.com/uploaded/companies/61/people/183-small.jpg?v=None" alt="Jess Stanton, Software Engineer - Uber Careers">
						<div class="spotlight-about">
						<div class="spotlight-name">Jess Stanton</div>
						<div class="spotlight-title">Software Engineer</div>
						<div class="spotlight-clicktomeet">
							Click to meet Jess 
							<i class="fa fa-long-arrow-right"></i>
						</div>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<div data-widget-id="2267" class="widget insight video grid_1_2 " data-muse-widget-name="video">
					<iframe src="//player.vimeo.com/video/53834658?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1" width="320" height="440" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
				</div>
				<div data-widget-id="2268" class="widget insight grid_1 " data-muse-widget-name="insight">
					<div class="insight-image">
						<img src="https://assets.themuse.com/uploaded/companies/61/widgets/2268.jpg?v=None" alt="Careers - Office Life
					 The White Unicorn">
					</div>
					<div class="insight-body">
						<div class="insight-date">Office Life</div>
						<div class="insight-title">The White Unicorn</div>
						<div class="insight-text">For Uber fans, the “White Unicorn” has become the stuff of San Francisco legends. The elusive white car—the only one in Uber’s all-black fleet—accomplishes Herculean feats, having even whisked one woman off her feet to a surprise engagement party. When not busy playing matchmaker, though, the Unicorn and its faithful driver, Sofian, can be found deftly battling rush-hour traffic on San Francisco’s winding streets, getting Uber users to their destinations.</div>
					</div>
				</div>
				<div data-widget-id="2269" class="widget  " data-muse-widget-name="help_wanted_dynamic">
					<a href="/jobs?company=Uber" target="_blank">
						<div class="help-wanted">
							<div class="help-wanted-title">We're Hiring</div>
							<div class="help-wanted-job">Check out open jobs at Uber</div>
							<div class="help-wanted-location"></div>
							<div class="help-wanted-footer"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-sm-4">
				<div data-widget-id="2270" class="widget insight grid_1 " data-muse-widget-name="insight">
					<div class="insight-image">
						<img src="https://assets.themuse.com/uploaded/companies/61/widgets/2270.jpg?v=None" alt="Careers - What Uber Does Uber 101">
					</div>
					<div class="insight-body">
						<div class="insight-date">What Uber Does
						</div>
						<div class="insight-title">Uber 101
						</div>
						<div class="insight-text">Fasten your seat belts: Uber is an on-demand car service that’s shaking up the transportation systems in 20 cities (and growing) around the world. Customers use the Uber app, website, or text message service to connect with the nearest available driver. Customers can choose which kind of vehicle they want—from basic taxis to snazzy limousines to hybrid vehicles—and have their ride show up within minutes of their request.</div>
					</div>
				</div>
				<div data-widget-id="2271" class="widget insight video grid_1_2 " data-muse-widget-name="video">
					<iframe src="//player.vimeo.com/video/53833676?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1" width="320" height="440" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
				</div>
			</div>
			<div class="col-sm-4">
				<div data-widget-id="2274" class="widget  widget-col-2" data-muse-widget-name="social_facebook">
					<a href="https://www.facebook.com/uber" target="_blank">
						<div class="social social-facebook grid_1">
							<div class="social-container">
								<div class="social-title">Uber on Facebook
								</div>
								<div class="social-body">Choice is a beautiful thing! Now offering a SUV option in Dallas; your whole posse can show up together in style.</div>
								<div class="social-footer"></div>
							</div>
						</div>
					</a>
				</div>
				<div data-widget-id="2273" class="widget  widget-col-2" data-muse-widget-name="social_twitter">
					<a href="https://twitter.com/uber" target="_blank">
						<div class="social social-twitter grid_1">
							<div class="social-container">
								<div class="social-title">‏@Uber </div>
								<div class="social-body">Go NYC! RT @Uber_NYC: Subways may be closed but we're up! We have some cars available at the moment, and see more coming online. </div>
								<div class="social-footer"></div>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection