@extends('layouts.recruiters')

@section('title', env('APP_NAME').' | Uber')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@section('second-navbar')
<link href="{{ asset('/css/css/font-awesome.min.css?q=874') }}" rel="stylesheet">
<div class="row subnav-block top-nav fixed">
	<div class="col-sm-12">
		<ul class="profiles-subnav">
			<li class="dropdown-wrapper">
				<a href="/companies/uber">About</a>
			</li>
			<li class="dropdown-wrapper ">
				<a class="dropdown-link" href="/companies/uber/office" data-toggle="dropdown">Offices <i class="fa fa-caret-down"></i></a>
				<ul class="subnav-dropdown">
					<li class="active">
						<a href="/companies/uber/office/uber">San Francisco, CA</a>
					</li>
					<li class="">
						<a href="/companies/uber/office/london">London, United Kingdom</a>
					</li>
				</ul>
			</li>
			<li class="dropdown-wrapper ">
				<a class="subnav-people dropdown-link" href="#" data-toggle="dropdown">People <i class="fa fa-caret-down"></i></a>
				<div class="people-dropdown" style="width: 110%">
					<ul class="subnav-dropdown">
						<li class=" people-list">
							<a href="/companies/uber/people/brian">
							Meet Brian</a>
						</li>
						<li class=" people-list">
							<a href="/companies/uber/people/swathy">
							Meet Swathy</a>
						</li>
						<li class=" people-list">
							<a href="/companies/uber/people/jess">
							Meet Jess</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="subnav-jobs"><a href="/jobs/c-uber-jobs">Jobs</a></li>
		</ul>
	</div>	
</div>
@endsection
@section('content')
 <link href="{{asset('/css/company-profile2.css?q=874')}}" rel="stylesheet">
 
 <div class="body">
	<div class="container company-profile-styling">
		<div class="row">
			<!-- div info-content -->
			<div class="col-sm-8">
				<div class="title-block">
					<h1>The San Francisco, CA Office at<br><div class="big-title">UBER</div></h1>
				</div>
				<div class="btn-row">
					<a class="see-job blue-solid-button-xs" href="/jobs/uber" alt="Uber Careers - See Our Jobs">See Our Jobs</a>
					<a class="next-company lt-grey-solid-button-xs" alt="Uber Careers - Next Company" href="/random/company">SEE LONDON, UNITED KINGDOM</a>
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
						<li class="field_company_location">
							<i class="fa fa-map-marker" aria-hidden="true"></i>
							<a href="/companies?office_location=San Francisco, CA">San Francisco, CA</a>
							|
							<a href="/companies?office_location=Chicago, IL">Chicago, IL</a>
							|
							<a href="/companies?office_location=London, United Kingdom">London, United Kingdom</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="company-wrapper">
			<div class="row">
				<div class="col-sm-12">
					<div class="spotlight grid_3_2 video">
						<img src="https://assets.themuse.com/uploaded/companies/61/office/61/f1.jpg?v=None" class="share-base" alt="person photo">
						<div class="text-bottom">
							<div class="feature-text">
							Uber’s offices are located in San Francisco.
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<div data-widget-id="10314" class="widget insight video grid_1_2 " data-muse-widget-name="video">
						<img data-cfsrc="https://assets.themuse.com/uploaded/companies/61/widgets/10314.jpg?v=None" src="https://assets.themuse.com/uploaded/companies/61/widgets/10314.jpg?v=None">
						<div class="text-bottom">
							<div class="video-text">Jumping For Joy: Uber’s Employees Love Working In London</div>
						</div>
					</div>
					<div data-widget-id="10315" class="widget insight grid_1 " data-muse-widget-name="insight">
						<div class="insight-image">
							<img data-cfsrc="https://assets.themuse.com/uploaded/companies/61/widgets/10315.jpg?v=None" alt="Careers - Office Life London Calling" src="https://assets.themuse.com/uploaded/companies/61/widgets/10315.jpg?v=None">
						</div>
						<div class="insight-body">
							<div class="insight-date">Office Life
							</div>
							<div class="insight-title">London Calling
							</div>
							<div class="insight-text">Uber’s employees love working in London. The U.K. capital has a lot to offer—including a rich cultural history and a vibrant arts community. With so much to see and do, it’s no wonder Uber’s employees are always smiling. Luckily for them, the feeling’s mutual: Uber’s list of London regulars is growing rapidly, with riders ranging from savvy students to esteemed celebs.</div>
						</div>
					</div>
					<div data-widget-id="10316" class="widget  " data-muse-widget-name="help_wanted_dynamic">
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
					<div data-widget-id="10317" class="widget insight grid_1 " data-muse-widget-name="insight">
						<div class="insight-image"><img data-cfsrc="https://assets.themuse.com/uploaded/companies/61/widgets/10317.jpg?v=None" alt="Careers - Uber in the World
						 Look Out, London
						" src="https://assets.themuse.com/uploaded/companies/61/widgets/10317.jpg?v=None"></div>
						<div class="insight-body">
							<div class="insight-date">Uber in the World
							</div>
							<div class="insight-title">Look Out, London
							</div>
							<div class="insight-text">London’s the most visited city in the world—so it’s only fitting that it’s one of Uber’s first international locations. With Uber, anyone can traverse London’s streets, often at prices up to 50% cheaper than the city’s local black cabs. Some of Uber’s favorite London spots? Though the list is ever-changing, Duck &amp; Waffle and the Tower of London are currently tied for the top.</div>
						</div>
					</div>
					<div data-widget-id="10318" class="widget insight video grid_1_2 " data-muse-widget-name="video">
						<img data-cfsrc="https://assets.themuse.com/uploaded/companies/61/widgets/10318.jpg?v=None" src="https://assets.themuse.com/uploaded/companies/61/widgets/10318.jpg?v=None">
						<div class="text-bottom">
							<div class="video-text">Uber Nights On The Town: Exploring London’s Streets In Style</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div data-widget-id="10319" class="widget insight grid_1 widget-col-2" data-muse-widget-name="map">
						<a href="http://maps.google.com/maps?saddr=&amp;daddr=405 Howard St., San Francisco CA 94105" target="_blank">
							<img src="http://maps.googleapis.com/maps/api/staticmap?center=405+Howard+St.%2C+San+Francisco+CA+94105&amp;markers=color%3Ablue%7C405+Howard+St.%2C+San+Francisco+CA+94105&amp;sensor=false&amp;size=320x235&amp;zoom=15">
							<div class="text-bottom transluscent-black">
								<div class="map-text">
								Take Me to the Uber Office!</div>
							</div>
						</a>
					</div>
					<div data-widget-id="10320" class="widget  widget-col-2" data-muse-widget-name="social_twitter">
						<a href="https://twitter.com/Uber_LDN" target="_blank">
							<div class="social social-twitter grid_1">
								<div class="social-container">
									<div class="social-title">@Uber_LDN
									</div>
									<div class="social-body">Bored at work? Our full drone-view video of #UberIceCream2014 is ready to watch!
									</div>
									<div class="social-footer">http://youtu.be/zqPcadfc-Mw </div>
								</div>
							</div>
						</a>
					</div>
					<div data-widget-id="10323" class="widget  widget-col-2" data-muse-widget-name="social_facebook">
						<a href="https://www.facebook.com/uber" target="_blank">
							<div class="social social-facebook grid_1">
								<div class="social-container">
									<div class="social-title">Uber on Facebook
									</div>
									<div class="social-body">We're teaming up with AT&amp;T to keep you moving in cities around the world. Read more on our blog!</div>
									<div class="social-footer"></div>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="area-title">Meet people at Uber</div>
				<div id="people-listing">
					<div class="col-sm-4">
						<a href="/companies/uber/people/brian&#10;&#10;" data-person-id="182" data-person-short-name="brian" data-person-position="0">
							<div class="spotlight grid_1_2">
								<img src="https://assets.themuse.com/uploaded/companies/61/people/182-small.jpg?v=None" alt="Brian McMullen, Community Management Specialist - Uber Careers">
								<div class="spotlight-about">
									<div class="spotlight-name">Brian McMullen</div>
									<div class="spotlight-title">Community Management Specialist</div>
									<div class="spotlight-clicktomeet">Click to meet Brian 
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
									<div class="spotlight-clicktomeet">Click to meet Swathy 
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
									<div class="spotlight-clicktomeet">Click to meet Jess 
										<i class="fa fa-long-arrow-right"></i>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection