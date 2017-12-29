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
						<li class=" people-list active">
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
					<div data-widget-id="2236" class="widget insight video grid_1_2 " data-muse-widget-name="video">
						<a href="http://vimeo.com/53825150">
							<div class="playhead-overlay">
								<img src="https://www.themuse.com/static/images/white_playhead.png?v=83d7a8492a9fb5ac116accc9aefed38ff98b72c24eb3a5464f6d5d83d3e89f30" alt="click to play video">
							</div>
							<img src="https://assets.themuse.com/uploaded/companies/61/widgets/2236.jpg?v=None" alt="video thumbnail image">
							<div class="text-bottom">
								<div class="video-text">Fancy Fridays</div>
							</div>
						</a>
					</div>
					<div data-widget-id="2237" class="widget insight grid_1 " data-muse-widget-name="insight">
						<div class="insight-image">
							<img src="https://assets.themuse.com/uploaded/companies/61/widgets/2237.jpg?v=None" alt="Careers - Brian’s Story Friendly Suggestions">
						</div>
						<div class="insight-body">
							<div class="insight-date">Brian’s Story
							</div>
							<div class="insight-title">Friendly Suggestions
							</div>
							<div class="insight-text">When Brian graduated from journalism school, he was on a quest to find a career that would let him flex his writing muscles and fuel his interest in marketing. Through a friend’s suggestion, he discovered Uber—and found the opportunity really fit the bill. Uber thought so, too, and jumped to offer him a role managing relationships with Uber’s diverse community, where he now thrives.</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div data-widget-id="2238" class="widget insight grid_1 " data-muse-widget-name="insight">
						<div class="insight-image">
							<img src="https://assets.themuse.com/uploaded/companies/61/widgets/2238.jpg?v=None" alt="Careers - What Brian Does Community Management Specialist ">
						</div>
						<div class="insight-body">
							<div class="insight-date">What Brian Does
							</div>
							<div class="insight-title">Community Management Specialist </div>
							<div class="insight-text">Brian gets into the office between 8 AM and 9 AM and kicks off the day by tackling customer support questions. He then digs in to marketing and PR efforts to keep users up-to-date on all the cool things Uber has in store—from Mariachis-for-rent to the launch of a new Uber city—and also works with the Driver Ops Team to make sure Uber is delivering the high-quality service users have come to expect.</div>
						</div>
					</div>
					<div data-widget-id="2239" class="widget insight video grid_1_2 " data-muse-widget-name="video">
						<a href="http://vimeo.com/53823638">
							<div class="playhead-overlay">
								<img src="https://www.themuse.com/static/images/white_playhead.png?v=83d7a8492a9fb5ac116accc9aefed38ff98b72c24eb3a5464f6d5d83d3e89f30" alt="click to play video">
							</div>
							<img src="https://assets.themuse.com/uploaded/companies/61/widgets/2239.jpg?v=None" alt="video thumbnail image">
							<div class="text-bottom">
								<div class="video-text">Merging Technology &amp; Real Life</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-sm-4">
					<div data-widget-id="2240" class="widget  widget-col-2" data-muse-widget-name="social_twitter">
						<a href="https://twitter.com/bmansayswhat" target="_blank">
							<div class="social social-twitter grid_1">
								<div class="social-container">
									<div class="social-title">@bmansayswhat
									</div>
									<div class="social-body">My TAXI driver was awesome this morning and stoked to be on @Uber. http://blog.uber.com/2012/10/17/taxi-is-arriving-in-san-francisco/&nbsp;…</div>
									<div class="social-footer"></div>
								</div>
							</div>
						</a>
					</div>
					<div data-widget-id="2241" class="widget  widget-col-2" data-muse-widget-name="quote_blue">
						<div class="quote quote-blue">
							<div class="quote-blue-top">&nbsp;</div>
							<div class="quote-blue-side">&nbsp;</div>
							<div class="quote-body">
								“It’s easy to look at Uber and say ‘it’s a tech company.’ But really what it is is a tech company with a real-world logistical side to it.”
								<div class="quote-source">
									<div class="quote-author"></div>
									<div class="quote-author-position"></div>
								</div>
							</div>
							<div class="quote-blue-side">&nbsp;</div>
							<img alt="“It’s easy to look at Uber and say ‘it’s a tech company.’ But really what it is is a tech company with a real-world logistical side to it.”" class="quote-bottom" src="https://www.themuse.com/static/images/quote_blue_bottom.png?v=e5ef6d0e53ae08e56d593d5aba61bca8d2185a5bdec00b6eb967c5b6da13a41f">
						</div>
					</div>
					<div data-widget-id="2242" class="widget  widget-col-2" data-muse-widget-name="quote_green">
						<div class="quote quote-green">
							<div class="quote-green-top">&nbsp;</div>
							<div class="quote-green-side">&nbsp;</div>
							<div class="quote-body">
							“Everyone’s very passionate about the product and it hardly ever feels like work.”
							<div class="quote-source">
							<div class="quote-author"></div>
							<div class="quote-author-position"></div>
							</div>
						</div>
						<div class="quote-green-side">&nbsp;</div>
						<img alt="“Everyone’s very passionate about the product and it hardly ever feels like work.”" class="quote-bottom" src="https://www.themuse.com/static/images/quote_green_bottom.png?v=b075c27b5205eefaca5afe5c7dab5a4ddd9f8e2ec3d9489a6fe048d8856d0311">
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