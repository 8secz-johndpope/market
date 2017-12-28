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
					<div data-widget-id="2260" class="widget insight video grid_1_2 " data-muse-widget-name="video">
						<a href="http://vimeo.com/53830892">
							<div class="playhead-overlay">
								<img src="https://www.themuse.com/static/images/white_playhead.png?v=83d7a8492a9fb5ac116accc9aefed38ff98b72c24eb3a5464f6d5d83d3e89f30" alt="click to play video">
							</div>
							<img src="https://assets.themuse.com/uploaded/companies/61/widgets/2260.jpg?v=None" alt="video thumbnail image">
							<div class="text-bottom">
								<div class="video-text">A Place for Good Ideas</div>
							</div>
						</a>
					</div>
					<div data-widget-id="2261" class="widget insight grid_1 " data-muse-widget-name="insight">
						<div class="insight-image">
							<img src="https://assets.themuse.com/uploaded/companies/61/widgets/2261.jpg?v=None" alt="Careers - Office Culture Work Friends and Watering Holes">
						</div>
						<div class="insight-body">
							<div class="insight-date">Office Culture
							</div>
							<div class="insight-title">Work Friends and Watering Holes
							</div>
							<div class="insight-text">Uber employees love coming to work not only to connect users to great transportation, but also to connect and socialize with their own awesome co-workers. Day and night, the Uber team makes time to hang out: Workdays are interspersed with casual games of ping-pong or foosball, and happy hour at the local watering hole is an opportunity never missed. </div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div data-widget-id="2262" class="widget insight grid_1 " data-muse-widget-name="insight">
						<div class="insight-image">
							<img src="https://assets.themuse.com/uploaded/companies/61/widgets/2262.jpg?v=None" alt="Careers - Office Life Happy Users, Happy Drivers">
						</div>
						<div class="insight-body">
							<div class="insight-date">Office Life
							</div>
						<div class="insight-title">Happy Users, Happy Drivers
						</div>
							<div class="insight-text">Satisfaction is king at Uber, and one of the company’s priorities is to make sure both customers and drivers have a great experience with Uber. The car-booking experience gives users easy access to fast, clean, upscale rides—but what’s more, Uber also makes sure it’s easy for drivers to earn extra money by providing rides to Uber customers and keeps track of their satisfaction with Uber riders.</div>
						</div>
					</div>
					<div data-widget-id="2263" class="widget insight video grid_1_2 " data-muse-widget-name="video">
						<a href="http://vimeo.com/53823637">
							<div class="playhead-overlay">
								<img src="https://www.themuse.com/static/images/white_playhead.png?v=83d7a8492a9fb5ac116accc9aefed38ff98b72c24eb3a5464f6d5d83d3e89f30" alt="click to play video">
							</div>
							<img src="https://assets.themuse.com/uploaded/companies/61/widgets/2263.jpg?v=None" alt="video thumbnail image">
							<div class="text-bottom">
								<div class="video-text">Mariachis on the Move</div>
							</div>
						</a>
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
						<a href="https://twitter.com/uber" target="_blank">
							<div class="social social-twitter grid_1">
								<div class="social-container">
									<div class="social-title">@Uber
									</div>
									<div class="social-body">RT @TechCrunch: Uber Spins Its Latest Variation On Car Rides: DJs On Party Buses In Chicago http://tcrn.ch/NTv1zn&nbsp; by @ingridlunden </div>
									<div class="social-footer"></div>
								</div>
							</div>
						</a>
					</div>
					<div data-widget-id="2265" class="widget  widget-col-2" data-muse-widget-name="quote_blue">
						<div class="quote quote-blue">
							<div class="quote-blue-top">&nbsp;</div>
							<div class="quote-blue-side">&nbsp;</div>
							<div class="quote-body">
								“You want to be exposed to as much as possible, as early on as possible in your career. You get that at Uber.”
								<div class="quote-source">
									<div class="quote-author">-Ryan
									</div>
									<div class="quote-author-position">Head of Operations</div>
								</div>
							</div>
							<div class="quote-blue-side">&nbsp;</div>
							<img alt="“You want to be exposed to as much as possible, as early on as possible in your career. You get that at Uber.”" class="quote-bottom" src="https://www.themuse.com/static/images/quote_blue_bottom.png?v=e5ef6d0e53ae08e56d593d5aba61bca8d2185a5bdec00b6eb967c5b6da13a41f">
						</div>
					</div>
					<div data-widget-id="2266" class="widget  widget-col-2" data-muse-widget-name="quote_green">
						<div class="quote quote-green">
							<div class="quote-green-top">&nbsp;</div>
							<div class="quote-green-side">&nbsp;</div>
							<div class="quote-body">
								“I wanted to work with a company who’s solving problems that’re so fascinating that I keep thinking about them even after I leave work.”
								<div class="quote-source">
									<div class="quote-author">-Swathy
									</div>
									<div class="quote-author-position">Operations &amp; Logistics Manager
									</div>
								</div>
							</div>
							<div class="quote-green-side">&nbsp;</div>
							<img alt="“I wanted to work with a company who’s solving problems that’re so fascinating that I keep thinking about them even after I leave work.”" class="quote-bottom" src="https://www.themuse.com/static/images/quote_green_bottom.png?v=b075c27b5205eefaca5afe5c7dab5a4ddd9f8e2ec3d9489a6fe048d8856d0311">
						</div>
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
<script>
	$('.video a').click(function(e){
		e.preventDefault();
		var hrefVideo = $(this).attr('href');
		var lastIndex = hrefVideo.lastIndexOf('/') + 1;
		var idVideo = hrefVideo.substr(lastIndex, hrefVideo.length);
		console.log(idVideo);
		var parent = $(this).parent();
		this.remove();
		parent.append("<iframe src=\"//player.vimeo.com/video/" + idVideo + "?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1\" width=\"320\" height=\"440\" frameborder=\"0\" webkitallowfullscreen=\"\" mozallowfullscreen=\"\" allowfullscreen=\"\"></iframe>");
	});
</script>
@endsection