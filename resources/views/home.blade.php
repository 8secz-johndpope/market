<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.home')

@section('title', 'Buy and Sell | '. env('APP_NAME'))

@section('sidebar')
	@parent

	<p>This is appended to the master sidebar.</p>
@endsection

@section('content')
		<section class="construction-wrapper">
			<div class="container">
				<div class="row ">
					<div class="col-xs-12 text-center">
			 			<div class="constrution-container">
			 				<h1>Sorry! This website is still under construction</h1>
			 				<h2 class="alert">No payments or transactions are permitted</h2>
			 			</div>
			 		</div>
				</div>
			</div>
		</section>
		<section class="categories background-body">
    			<div class="container">
    				<div class="row box-rose">
			 	<!-- @foreach($base as $cat)
			 		<div class="col-xs-6 col-sm-3 col-lg-2">
				 		<div class="panel panel-primary {{$cat->class}}">
				 			<div class="panel-heading">
				 				<a href="/{{$cat->slug}}">
				 					<div class="center-block">
				 						<img class="icon-category" src="css/icons/{{$cat->slug}}.png?76755">
				 					</div>
				 					<h1>{{$cat->title}}</h1>
				 				</a>
				 			</div>
				 			<div class="panel-body hidden-xs">
							 	<ul>
							 	@foreach($cat->children as $child)
							 		<li><a href="{{$child->slug}}">{{$child->title}}</a></li>
							 	@endforeach
							 	<div class="read-more">
							 		<a href="#" class="btn btn-info" role="button">more..</a>
							 	</div>
							 	</ul>
							 </div>
						 </div>
					 </div>
			 		@endforeach -->
			 		<div class="col-xs-6 col-sm-3 col-lg-2">
				 		<div class="panel panel-primary category-0">
				 			<div class="panel-heading">
				 				<a href="/cars-vans-motorbikes">
				 					<div class="center-block">
				 						<img class="icon-category" src="css/icons/cars-vans-motorbikes.png?76755">
				 					</div>
				 					<h1>Motors</h1>
				 				</a>
				 			</div>
				 			<div class="panel-body hidden-xs">
							 	<ul>
							 		<li><a href="cars">Cars</a></li>
							 		<li><a href="motorbikes-scooters">Motorbikes</a></li>
							 		<li><a href="motors-accessories">Accessories</a></li>
							 		<!-- <li><a href="campervans-motorhomes">Campervans &amp; Motorhomes</a></li> -->
							 		<li><a href="caravans">Caravans</a></li>
							 		<li><a href="vans">Vans</a></li>
							 		<li><a href="trucks">Trucks</a></li>
							 		<!-- <li><a href="other-vehicles">Other Vehicles</a></li>
							 		<li><a href="motors-parts">Parts</a></li> -->
							 		<div class="read-more">
							 			<a href="/more/1000000000" class="btn btn-info" role="button">more..</a>
							 		</div>
							 	</ul>
							</div>
						 </div>
					 </div>
					 <div class="col-xs-6 col-sm-3 col-lg-2">
				 		<div class="panel panel-primary category-1">
				 			<div class="panel-heading">
				 				<a href="/for-sale">
				 					<div class="center-block">
				 						<img class="icon-category" src="css/icons/for-sale.png?76755">
				 					</div>
				 					<h1>For Sale</h1>
				 				</a>
				 			</div>
				 			<div class="panel-body hidden-xs">
							 	<ul>
							 		<li><a href="phones">Mobile Phones</a></li>
							 		<li><a href="computers-software">Computers</a></li>
							 		<li><a href="home-garden">Home & Garden</a></li>
							 		<li><a href="baby-kids-stuff">Baby &amp; Kids</a></li>
							 		<li><a href="sports-leisure-travel">Sports</a></li>
							 		<li><a href="clothing">Clothes</a></li>
							 		<div class="read-more">
							 			<a href="/more/2000000000" class="btn btn-info" role="button">more..</a>
							 		</div>
							 	</ul>
							 </div>
						 </div>
					 </div>
					 <div class="col-xs-6 col-sm-3 col-lg-2">
				 		<div class="panel panel-primary category-2">
				 			<div class="panel-heading">
				 				<a href="/flats-houses">
				 					<div class="center-block">
				 						<img class="icon-category" src="css/icons/flats-houses.png?76755">
				 					</div>
				 					<h1>Property</h1>
				 				</a>
				 			</div>
				 			<div class="panel-body hidden-xs">
							 	<ul>
							 		<li><a href="property-for-sale">For Sale</a></li>
							 		<li><a href="property-to-rent">To Rent</a></li>
							 		<li><a href="commercial">Commercial</a></li>
							 		<li><a href="property-to-share">To Share</a></li>
							 		<li><a href="garage-parking">Parking &amp; Garage</a></li>
							 		<li><a href="holiday-rentals">Holiday Rentals</a></li>
							 		<div class="read-more">
							 			<a href="/more/3000000000" class="btn btn-info" role="button">more..</a>
							 		</div>
							 	</ul>
							 </div>
						 </div>
					 </div>
					 <div class="col-xs-6 col-sm-3 col-lg-2">
				 		<div class="panel panel-primary category-3">
				 			<div class="panel-heading">
				 				<a href="/jobs">
				 					<div class="center-block">
				 						<img class="icon-category" src="css/icons/jobs.png?76755">
				 					</div>
				 					<h1>Jobs</h1>
				 				</a>
				 			</div>
				 			<div class="panel-body hidden-xs">
							 	<ul>
							 		<li><a href="jobs">All Lastest Jobs</a></li>
							 		<li><a href="jobs/london">All London Jobs</a></li>
							 		<li><a href="general-jobs">General jobs</a></li>
							 		<li><a href="/jobs/uk?job_contract_type=permanent">Permanent Jobs</a></li>
							 		<li><a href="/jobs/uk?hours=weekends">Weekend Jobs</a></li>
							 		<li><a href="#">All Recruiters</a></li>
								 	<div class="read-more">
								 		<a href="/more/4000000000" class="btn btn-info" role="button">more..</a>
								 	</div>
							 	</ul>
							 </div>
						 </div>
					 </div>
					 <div class="col-xs-6 col-sm-3 col-lg-2">
				 		<div class="panel panel-primary category-4">
				 			<div class="panel-heading">
				 				<a href="/business-services">
				 					<div class="center-block">
				 						<img class="icon-category" src="css/icons/business-services.png?76755">
				 					</div>
				 					<h1>Services</h1>
				 				</a>
				 			</div>
				 			<div class="panel-body hidden-xs">
							 	<ul>
							 		<li><a href="health-beauty-services">Health & Beauty</a></li>
							 		<li><a href="tuition-lessons">Classes</a></li>
							 		<li><a href="building-home-removal-services">Construction</a></li>
							 		<li><a href="motoring-services">Motoring</a></li>
							 		<li><a href="property-shipping-services">Maintenance</a></li>
							 		<li><a href="wedding-services">Weddings</a></li>
								 	<div class="read-more">
								 		<a href="/more/5000000000" class="btn btn-info" role="button">more..</a>
								 	</div>
							 	</ul>
							 </div>
						 </div>
					 </div>
					 <div class="col-xs-6 col-sm-3 col-lg-2">
				 		<div class="panel panel-primary category-5">
				 			<div class="panel-heading">
				 				<a href="/community">
				 					<div class="center-block">
				 						<img class="icon-category" src="css/icons/community.png?76755">
				 					</div>
				 					<h1>Community</h1>
				 				</a>
				 			</div>
				 			<div class="panel-body hidden-xs">
							 	<ul>
							 		<li><a href="music-bands-musicians-djs">Music & Bands</a></li>
							 		<li><a href="classes">Classes</a></li>
							 		<li><a href="events-gigs-nightlife">Events</a></li>
							 		<li><a href="sports-teams-partners">Sports Teams</a></li>
							 		<li><a href="groups-associations">Associations</a></li>
							 		<li><a href="travel-travel-partners">Travel</a></li>
								 	<div class="read-more">
								 		<a href="/more/6000000000" class="btn btn-info" role="button">more..</a>
								 	</div>
							 	</ul>
							 </div>
						 </div>
					 </div>
					 <div class="col-xs-6 col-sm-3 col-lg-2">
				 		<div class="panel panel-primary category-6">
				 			<div class="panel-heading">
				 				<a href="/pets">
				 					<div class="center-block">
				 						<img class="icon-category" src="css/icons/pets.png?76755">
				 					</div>
				 					<h1>Pets</h1>
				 				</a>
				 			</div>
				 			<div class="panel-body hidden-xs">
							 	<ul>
							 		<li><a href="pet-equipment-accessories">Equipment &amp; Accessories</a></li>
							 		<li><a href="pets-missing-lost-found">Missing, Lost &amp; Found</a></li>
							 		<li><a href="pets-for-sale">Pets for Sale</a></li>
								 	<div class="read-more">
								 		<a href="/more/7000000000" class="btn btn-info" role="button">more..</a>
								 	</div>
							 	</ul>
							 </div>
						 </div>
					 </div>
			 	</div>
			 	<div class="row box-rose">
			 		<div class="col-xs-12 col-sm-4 border-rose-right">
			 			<a href="#spotlight">
			 				All Spotlight
			 			</a>
			 		</div>
			 		<div class="col-xs-12 col-sm-4 border-rose-right">
			 			<a href="#">Popular Searches</a>
			 		</div>
			 		<div class="col-xs-12 col-sm-4">
			 			<a href="#">Lastest Listings</a>
			 		</div>
			 	</div>
		 	</div>
		</section>
		<section class="row-color gold">
			<div class="container">
				<div class="row menu">
					<div class="col-xs-3 col-sm-3 col-md-4">
						<img class="img-left" src="css/section-gold1.png">
					</div>
					<div class="col-xs-8 col-sm-8 col-md-4">
						<h2>{{env('APP_NAME')}} is safe, free and trusted</h2>
					</div>
					<div class="col-md-4 hidden-xs hidden-sm">
						<img class="img-right" src="css/section-gold2.png">
					</div>
				</div>
			</div>
		</section>
		<section class="spotligth background-body" id="spotlight">
			<div class="container">
				<div class="row box-rose">
                        <div class="title col-lg-12">
                            <h2>Spotlight</h2>
                        </div>
							@for ($i = 0; $i < count($spotlight); $i++)
						    		<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
						    			<a href="/p/{{$spotlight[$i]['category']}}/{{$spotlight[$i]['source_id']}}">
							    		<div class="panel panel-primary">
								 			<div class="panel-heading" style="background-image:url('{{env('AWS_WEB_IMAGE_URL')}}/{{ count($spotlight[$i]['images'])>0?$spotlight[$i]['images'][0]:"noimage.png"}}');">
								 			</div>
								 			<div class="panel-body">
								 				<h3 class="text">{{$spotlight[$i]['title']}}</h3>
											 	@if($spotlight[$i]['meta']['price']>=0)
			                                            <div class="items-box-price font-5">£	{{$spotlight[$i]['meta']['price']/100}}{{isset($spotlight[$i]['meta']['price_frequency']) ? $spotlight[$i]['meta']['price_frequency']:''}}
			                                            </div>
			                                   @endif
											</div>
										</div>
										</a>
									</div>
						    @endfor
						</div>
					</div>
		</section>
		<section class="features">
			<div class="container">
				<div class="row">
					<div class="col-xs-8 col-sm-6 col-md-6 col-lg-4 col-xs-offset-2 col-sm-offset-0">
						<figure>
							<img src="css/peace-of-mind-uk.svg">
						</figure>
						<h2>TRUSTED</h2>
						<p>We’ll give you discounts and credits for being better buyers & sellers</p>
					</div>
					<div class="col-xs-8 col-sm-6 col-md-6 col-lg-4 col-xs-offset-2 col-sm-offset-0">
						<figure>
							<img src="css/icons/commision.svg">
						</figure>
						<h2>0% Commission</h2>
						<p>What you see is what you get, no hidden fees on our purchase prices</p>
					</div>
					<div class="col-xs-8 col-sm-6 col-md-6 col-lg-4 col-xs-offset-2 col-sm-offset-0">
						<figure>
							<img src="css/icons/free-shipping.svg">
						</figure>
						<h2>FREE SHIPPING</h2>
						<p>You can get unlimited FREE Two-Day Shipping</p>
					</div>
					<div class="col-xs-8 col-sm-6 col-md-6 col-lg-4 col-xs-offset-2 col-sm-offset-0">
						<figure>
							<img src="css/icons/verified.svg">
						</figure>
						<h2>VERIFIED</h2>
						<p>Our sellers and buyers are verified by our system</p>
					</div>
					<div class="col-xs-8 col-sm-6 col-md-6 col-lg-4 col-xs-offset-2 col-sm-offset-0">
						<figure>
							<img src="css/icons/free-uk.svg">
						</figure>
						<h2>FREE LISTINGS</h2>
						<p>Our buyer guarantee means you'll get refunded if something goes wrong</p>
					</div>
					<div class="col-xs-8 col-sm-6 col-md-6 col-lg-4 col-xs-offset-2 col-sm-offset-0">
						<figure>
							<img src="css/icons/return.svg">
						</figure>
						<h2>FREE RETURNS</h2>
						<p>You’ll always hear back from our customer services within 24 hours</p>
					</div>
				</div>
			</div>
		</section>
		<section class="social-media">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-xs-12 col-md-5 col-lg-6 store">
							<h2>Download</h2>
							<div class="stores">
								<div class="center-block"><a href=""><img class="img-responsive center-block" src="css/icons/android.svg"><h3>Android Phone</h3></a></div>
								<div class="center-block"><a href=""><img class="img-responsive center-block" src="css/icons/apple.svg"><h3>Apple Phone</h3></a></div>
								<!-- <div class="center-block"><a href=""><img class="img-responsive center-block" src="css/icons/windows.png"><h3>Windows Desktop</h3></a></div>-->
							</div>
					</div>
					<div class="col-xs-10 col-md-5 col-lg-3 col-xs-offset-1 col-md-offset-2 col-lg-offset-3">
							<h2>Follow us</h2>
							<div class=" media">
								<div class="center-block"><a href=""><img class="img-responsive" src="css/icons/facebook.svg"></a></div>
								<div class="center-block"><a href=""><img class="img-responsive" src="css/icons/twitter.svg"></a></div>
								<div class="center-block"><a href=""><img class="img-responsive" src="css/icons/instagram.png"></a></div>
								<div class="center-block"><a href=""><img class="img-responsive" src="css/icons/pinterest.svg"></a></div>
								<div class="center-block"><a href=""><img class="img-responsive" src="css/icons/email.svg"></a></div>

							</div>
					</div>
				</div>
			</div>
		</section>
@endsection
