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
						<li class=" people-list active">
							<a href="/companies/uber/people/jess">
							Meet Jess</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="subnav-jobs"><a href="/company-jobs/c-uber-jobs">Jobs</a></li>
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
					<h1>Meet Uber's<br><div class="big-title">JESS STANTON</div></h1>
				</div>
				<div class="btn-row">
					<a class="lt-grey-border-button-xs" href="/companies/uber/people/brian">Next Person</a>
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
							<a href="/companies?company_industry=Travel and Hospitality&amp;filter=true">Travel and Hospitality</a>
						</li>
						<li class="field_job_type">
							<i class="fa fa-pencil" aria-hidden="true"></i>
							<a href="/jobs/q-Engineering-jobs">Engineering</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="company-wrapper">
			<div class="row">
				<div id="person">
					<div class="col-sm-12">
						<div class="spotlight grid_3_2 person-tile video">
							<a href="http://vimeo.com/53825152">
								<img src="https://assets.themuse.com/uploaded/companies/61/people/183-large.jpg?v=None" class="share-base" alt="Jess Stanton, Software Engineer - Uber Careers">
								<div class="person-content desktop text-left transluscent-black">
									<div class="person-name">Jess Stanton</div>
									<div class="person-position">Software Engineer</div>
									<div class="person-bio">Jess codes the software behind the Uber experience. She works hard to develop and test features, mentor new engineers, and deploy code that supports the infrastructure of Uber’s international products.</div>
									<div class="person-video">
										<img src="https://www.themuse.com/static/images/shared/playhead.png?v=cdd46bfc49626ae93cd7e91a28a0affb02ee3a1ff0ea45c49e32bbef12be32de">
										<div class="video-text">Hear from Jess</div>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<div data-widget-id="2244" class="widget insight video grid_1_2 " data-muse-widget-name="video">
						<a href="http://vimeo.com/53825153">
							<div class="playhead-overlay">
								<img src="https://www.themuse.com/static/images/white_playhead.png?v=83d7a8492a9fb5ac116accc9aefed38ff98b72c24eb3a5464f6d5d83d3e89f30" alt="click to play video">
							</div>
							<img src="https://assets.themuse.com/uploaded/companies/61/widgets/2244.jpg?v=None" alt="video thumbnail image">
							<div class="text-bottom">
								<div class="video-text">Programming Was In My Genes</div>
							</div>
						</a>
					</div>
					<div data-widget-id="2245" class="widget insight grid_1 " data-muse-widget-name="insight">
						<div class="insight-image">
							<img src="https://assets.themuse.com/uploaded/companies/61/widgets/2245.jpg?v=None" alt="Careers - Office Culture A Cohesive Crew">
						</div>
						<div class="insight-body">
							<div class="insight-date">Office Culture
							</div>
							<div class="insight-title">A Cohesive Crew
							</div>
							<div class="insight-text">Uber runs like a well-oiled machine because its run by a tight-knit crew. Beyond informal happy hours, the team makes a point to organize group events—like its six-week dodgeball season. Recently, employees took a weekend day-cay to Napa Valley for a wine tasting trip where, in true Uber spirit, they enjoyed a day in the sun sipping and socializing.</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div data-widget-id="2246" class="widget insight grid_1 " data-muse-widget-name="insight">
						<div class="insight-image">
							<img src="https://assets.themuse.com/uploaded/companies/61/widgets/2246.jpg?v=None" alt="Careers - What Jess Does Software Engineer">
						</div>
						<div class="insight-body">
							<div class="insight-date">What Jess Does
							</div>
							<div class="insight-title">Software Engineer
							</div>
							<div class="insight-text">Jess’s morning formally starts at 11 AM with the daily stand-up meeting, where she checks in with her focus group and goes over the day’s objectives. After lunch with co-workers, she spends a good part of her time working to internationalize Uber’s products. She and her team are currently busy translating the products and creating systems that’ll work across international lines, preparing for Uber to conquer the world.</div>
						</div>
					</div>
					<div data-widget-id="2247" class="widget insight video grid_1_2 " data-muse-widget-name="video">
						<a href="http://vimeo.com/53825151">
							<div class="playhead-overlay">
								<img src="https://www.themuse.com/static/images/white_playhead.png?v=83d7a8492a9fb5ac116accc9aefed38ff98b72c24eb3a5464f6d5d83d3e89f30" alt="click to play video">
							</div>
							<img src="https://assets.themuse.com/uploaded/companies/61/widgets/2247.jpg?v=None" alt="video thumbnail image">
							<div class="text-bottom">
								<div class="video-text">Creating A Feel-Good Situation </div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-sm-4">
					<div data-widget-id="2248" class="widget  widget-col-2" data-muse-widget-name="social_twitter">
						<a href="https://twitter.com/tiny_mouse" target="_blank">
							<div class="social social-twitter grid_1">
								<div class="social-container">
									<div class="social-title">@tiny_mouse
									</div>
									<div class="social-body">I flippin' love working for @Uber! #PrivateSailor hats are the best way to brighten this engineer's day! http://instagr.am/p/QXt7d2jdx-/</div>
									<div class="social-footer"></div>
								</div>
							</div>
						</a>
					</div>
					<div data-widget-id="2249" class="widget  widget-col-2" data-muse-widget-name="quote_yellow">
						<div class="quote quote-yellow">
							<div class="quote-yellow-top">&nbsp;</div>
							<div class="quote-yellow-side">&nbsp;</div>
							<div class="quote-body">
								“I really love the happiness and goodwill that comes from Uber. People just get excited about it.”
								<div class="quote-source">
									<div class="quote-author"></div>
									<div class="quote-author-position"></div>
								</div>
							</div>
							<div class="quote-yellow-side">&nbsp;</div>
							<img alt="“I really love the happiness and goodwill that comes from Uber. People just get excited about it.”" class="quote-bottom" src="https://www.themuse.com/static/images/quote_yellow_bottom.png?v=5a8a4600d998f7e1d0553d8062fda1c17cb42d2914e76ac96acfb8e679b683e9">
						</div>
					</div>
					<div data-widget-id="2251" class="widget  widget-col-2" data-muse-widget-name="quote_blue">
						<div class="quote quote-blue">
							<div class="quote-blue-top">&nbsp;</div>
							<div class="quote-blue-side">&nbsp;</div>
							<div class="quote-body">
								“We’re a boisterous company. We have a lot of fun.”
								<div class="quote-source">
									<div class="quote-author"></div>
									<div class="quote-author-position"></div>
								</div>
							</div>
							<div class="quote-blue-side">&nbsp;</div>
							<img alt="“We’re a boisterous company. We have a lot of fun.”" class="quote-bottom" src="https://www.themuse.com/static/images/quote_blue_bottom.png?v=e5ef6d0e53ae08e56d593d5aba61bca8d2185a5bdec00b6eb967c5b6da13a41f">
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
		var vHeight = 440;
		var vWidth = 320;
		console.log($(this).closest('.person-tile'));
		if($(this).closest('.person-tile').length > 0){
			vHeight = 480;
			vWidth = 980;
		}
		var hrefVideo = $(this).attr('href');
		var lastIndex = hrefVideo.lastIndexOf('/') + 1;
		var idVideo = hrefVideo.substr(lastIndex, hrefVideo.length);
		var parent = $(this).parent();
		this.remove();

		parent.append("<iframe src=\"//player.vimeo.com/video/" + idVideo + "?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1\" width=\"" + vWidth+ "\" height=\"" + vHeight +"\" frameborder=\"0\" webkitallowfullscreen=\"\" mozallowfullscreen=\"\" allowfullscreen=\"\"></iframe>");
	});
</script>
@endsection