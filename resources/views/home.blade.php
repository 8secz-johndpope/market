<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.home')

@section('title', 'Page Title')

@section('sidebar')
	@parent

	<p>This is appended to the master sidebar.</p>
@endsection

@section('content')
		<section class="categories">
			<div class="container">
				<div class ="row">
			 	@foreach($base as $cat)
			 		<div class="col-xs-6 col-sm-3 col-md-3 col-lg-2">
				 		<div class="panel panel-primary {{$cat->class}}">
				 			<div class="panel-heading">
				 				<a href="/{{$cat->slug}}">
				 					<div class="center-block">
				 						<img class="icon-category" src="css/icons/{{$cat->slug}}.png">
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
			 		@endforeach
			 	</div>
		 	</div>
		</section>
		<section class="spotligth">
			<div class="container">
				<div class="row menu">
					<div class="center-block">
						<h2>SUMRA Free and Trusted</h2>
						<div class="tabs-simple-bar">
							<div class="tabs-simple-bar-mask"></div>
						</div>
						<ul class="tabs-simple list-inline">
							<li><a class="tabs-simple-tab all-spot" href="#">All Spotlight</a></li>
							<li><a class="tabs-simple-tab pop-se" href="#">Popular Searches</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div id="myCarousel-xs" class="carousel slide visible-xs" data-ride="carousel">
						<!-- Indicators 
						<ol class="carousel-indicators">
							<li data-target="#myCarousel-xs" data-slide-to="0" class="active"></li>
						    <li data-target="#myCarousel-xs" data-slide-to="1"></li>
						    <li data-target="#myCarousel-xs" data-slide-to="2"></li>
						    <li data-target="#myCarousel-xs" data-slide-to="3"></li>
						    <li data-target="#myCarousel-xs" data-slide-to="4"></li>
						    <li data-target="#myCarousel-xs" data-slide-to="5"></li>
						    <li data-target="#myCarousel-xs" data-slide-to="6"></li>
						    <li data-target="#myCarousel-xs" data-slide-to="7"></li>
						    <li data-target="#myCarousel-xs" data-slide-to="8"></li>
						    <li data-target="#myCarousel-xs" data-slide-to="9"></li>
						    <li data-target="#myCarousel-xs" data-slide-to="10"></li>
						    <li data-target="#myCarousel-xs" data-slide-to="11"></li>
						</ol>
						<!-- Wrapper for slides -->
						<div class="carousel-inner ">
							<!-- small devices -->
							@for ($i = 0; $i < count($spotlight); $i++)
							<div class="item">
									@for ($j = 0; $j < 2 && $i < count($spotlight); $i++,$j++)
						    		<div class="col-xs-6 col-md-4 col-lg-2">
						    			<a href="#">
								    		<div class="panel panel-primary">
									 			<div class="panel-heading" style="background-image:url('https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{ count($spotlight[$i]['images'])>0?$spotlight[$i]['images'][0]:"1000006.jpg"}}');">
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
									@php
										$i--;
									@endphp
						    </div>
						    @endfor
						</div>
						<a class="left carousel-control" href="#myCarousel-xs" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left"></span>
						    <span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#myCarousel-xs" data-slide="next">
						    <span class="glyphicon glyphicon-chevron-right"></span>
						    <span class="sr-only">Next</span>
						</a>
					</div>
					<!-- end small devices -->
					<div id="myCarousel" class="carousel slide hidden-xs" data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators">
							<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						    <li data-target="#myCarousel" data-slide-to="1"></li>
						    <li data-target="#myCarousel" data-slide-to="2"></li>
						    <li data-target="#myCarousel" data-slide-to="3"></li>
						</ol> 
						<div class="carousel-inner">
							@for ($i = 0; $i < count($spotlight); $i++)
						    <div class="item">
						    	@for ($j = 0; $j < 6 && $i < count($spotlight); $i++,$j++)
						    		<div class="col-sm-4 col-md-4 col-lg-2">
							    		<div class="panel panel-primary">
								 			<div class="panel-heading" style="background-image:url('https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{ count($spotlight[$i]['images'])>0?$spotlight[$i]['images'][0]:"1000006.jpg"}}');">
								 			</div>
								 			<div class="panel-body">
								 				<h3 class="text">{{$spotlight[$i]['title']}}</h3>
											 	@if($spotlight[$i]['meta']['price']>=0)
			                                            <div class="items-box-price font-5">£	{{$spotlight[$i]['meta']['price']/100}}{{isset($spotlight[$i]['meta']['price_frequency']) ? $spotlight[$i]['meta']['price_frequency']:''}}
			                                            </div>
			                                   @endif
											</div>
										</div>
									</div>
						    	@endfor
						    	@php
										$i--;
								@endphp
						    </div>
						    @endfor
						</div>
						<!-- Left and right controls -->
						<a class="left carousel-control" href="#myCarousel" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left"></span>
						    <span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#myCarousel" data-slide="next">
						    <span class="glyphicon glyphicon-chevron-right"></span>
						    <span class="sr-only">Next</span>
						</a>
					</div>
				</div>
			</div>
		</section>
		<section class="row-color black">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 img left">
						<img src="css/section-black.png">
					</div>
					<div class="col-lg-4">
					</div>
					<div class="col-lg-4 img right">
						<img src="css/section-black2.png">
					</div>
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
		<section class="row-color white">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 img left">
						<img src="css/section-white1.png">
					</div>
					<div class="col-lg-4">
					</div>
					<div class="col-lg-4 img right">
						<img src="css/section-white2.png">
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
								<div class="center-block"><a href=""><img class="img-responsive center-block" src="css/icons/windows.png"><h3>Windows Desktop</h3></a></div>
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
