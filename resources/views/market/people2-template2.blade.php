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
						<li class=" people-list active">
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
					<h1>Meet Uber's<br><div class="big-title">SWATHY PRITHIVI</div></h1>
				</div>
				<div class="btn-row">
					<a class="lt-grey-border-button-xs" href="/companies/uber/people/jess">Next Person</a>
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
							<a href="/jobs/q-Operations-jobs">Operations</a>
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
							<a href="http://vimeo.com/54040719">
								<img src="https://assets.themuse.com/uploaded/companies/61/people/184-large.jpg?v=None" class="share-base" alt="Swathy Prithivi, Operations &amp; Logistics Manager - Uber Careers">
								<div class="person-content desktop text-right transluscent-black">
									<div class="person-name">Swathy Prithivi</div>
									<div class="person-position">Operations &amp; Logistics Manager</div>
									<div class="person-bio">Swathy is part of the team that is the driving force behind Uber’s transportation options. She helps sign up the drivers, makes sure the vehicles run smoothly, and tackles any logistical bumps along the road.</div>
									<div class="person-video">
										<img src="https://www.themuse.com/static/images/shared/playhead.png?v=cdd46bfc49626ae93cd7e91a28a0affb02ee3a1ff0ea45c49e32bbef12be32de">
										<div class="video-text">Hear from Swathy</div>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<div data-widget-id="2252" class="widget insight video grid_1_2 " data-muse-widget-name="video">
						<a href="http://vimeo.com/53830893">
							<div class="playhead-overlay">
								<img src="https://www.themuse.com/static/images/white_playhead.png?v=83d7a8492a9fb5ac116accc9aefed38ff98b72c24eb3a5464f6d5d83d3e89f30" alt="click to play video">
							</div>
							<img src="https://assets.themuse.com/uploaded/companies/61/widgets/2252.jpg?v=None" alt="video thumbnail image">
							<div class="text-bottom">
								<div class="video-text">Customer Stories &amp; Driver Stories</div>
							</div>
						</a>
					</div>
					<div data-widget-id="2253" class="widget insight grid_1 " data-muse-widget-name="insight">
						<div class="insight-image">
							<img src="https://assets.themuse.com/uploaded/companies/61/widgets/2253.jpg?v=None" alt="Careers - Office Life The Uber Cocktail">
						</div>
						<div class="insight-body">
							<div class="insight-date">Office Life
							</div>
							<div class="insight-title">The Uber Cocktail
							</div>
							<div class="insight-text">Swathy finds Uber’s innovative culture and startup ethos intoxicating. Team members are encouraged to “fail fast,” learn lessons, and move on. Great ideas, like the on-demand ice cream truck, can start out as a suggestion and quickly come to life—creating living, breathing, and extremely popular new product lines. These seemingly crazy ideas—that other companies might probably scoff off—thrive at Uber and keep the company innovative and its employees inspired. </div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div data-widget-id="2254" class="widget insight grid_1 " data-muse-widget-name="insight">
						<div class="insight-image">
							<img src="https://assets.themuse.com/uploaded/companies/61/widgets/2254.jpg?v=None" alt="Careers - What Swathy Does Operations &amp; Logistics Manager">
						</div>
						<div class="insight-body">
							<div class="insight-date">What Swathy Does
							</div>
							<div class="insight-title">Operations &amp; Logistics Manager
							</div>
							<div class="insight-text">Swathy kicks off her morning by interviewing new drivers and partners while everyone’s still at his or her freshest. Afterward, a good chunk of her day is devoted to inspecting Uber’s vehicles and meeting with the San Francisco team to discuss how to improve car quality. She then wraps up her work by digging into data and looking for areas of potential growth that’ll enable Uber to keep customers satisfied and entice new ones to give Uber a try. </div>
						</div>
					</div>
					<div data-widget-id="2255" class="widget insight video grid_1_2 " data-muse-widget-name="video">
						<a href="http://vimeo.com/53830894">
							<div class="playhead-overlay">
								<img src="https://www.themuse.com/static/images/white_playhead.png?v=83d7a8492a9fb5ac116accc9aefed38ff98b72c24eb3a5464f6d5d83d3e89f30" alt="click to play video">
							</div>
							<img src="https://assets.themuse.com/uploaded/companies/61/widgets/2255.jpg?v=None" alt="video thumbnail image">
							<div class="text-bottom">
								<div class="video-text">Engineering Uber’s Success</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-sm-4">
					<div data-widget-id="2256" class="widget  widget-col-2" data-muse-widget-name="social_twitter">
						<a href="https://twitter.com/swathyprithivi" target="_blank">
							<div class="social social-twitter grid_1">
								<div class="social-container">
									<div class="social-title">@swathyprithivi
									</div>
									<div class="social-body">"Every vehicle with a commercial license plate will one day be Uber-ized." @naval http://bit.ly/TQps6E</div>
									<div class="social-footer"></div>
								</div>
							</div>
						</a>
					</div>
					<div data-widget-id="2258" class="widget  widget-col-2" data-muse-widget-name="quote_green">
						<div class="quote quote-green">
							<div class="quote-green-top">&nbsp;</div>
							<div class="quote-green-side">&nbsp;</div>
							<div class="quote-body">
								“I was a massive Uber user months before I joined. I joked that I had to join Uber for financial reasons—I was spending so much of my money on Uber, I thought why not join them?”
								<div class="quote-source">
									<div class="quote-author"></div>
									<div class="quote-author-position"></div>
								</div>
							</div>
							<div class="quote-green-side">&nbsp;</div>
							<img alt="“I was a massive Uber user months before I joined. I joked that I had to join Uber for financial reasons—I was spending so much of my money on Uber, I thought why not join them?”" class="quote-bottom" src="https://www.themuse.com/static/images/quote_green_bottom.png?v=b075c27b5205eefaca5afe5c7dab5a4ddd9f8e2ec3d9489a6fe048d8856d0311">
						</div>
					</div>
					<div data-widget-id="2259" class="widget  widget-col-2" data-muse-widget-name="quote_blue">
						<div class="quote quote-blue">
							<div class="quote-blue-top">&nbsp;</div>
							<div class="quote-blue-side">&nbsp;</div>
							<div class="quote-body">
								“We have a saying: We give our riders high-fives and our drivers hugs. We treat people across the company well.”
								<div class="quote-source">
									<div class="quote-author"></div>
									<div class="quote-author-position"></div>
								</div>
							</div>
							<div class="quote-blue-side">&nbsp;</div>
							<img alt="“We have a saying: We give our riders high-fives and our drivers hugs. We treat people across the company well.”" class="quote-bottom" src="https://www.themuse.com/static/images/quote_blue_bottom.png?v=e5ef6d0e53ae08e56d593d5aba61bca8d2185a5bdec00b6eb967c5b6da13a41f">
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
		if($(this).closest('.person-tile').length > 0){
			vHeight = 480;
			vWidth = 980;
			console.log('is title');	
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