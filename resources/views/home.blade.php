<!DOCTYPE html>
<html lang="en-US">
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sumra') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</head>
	<body class="">
		<header>
			<div class="top hidden-xs">
				<div class="row">
					<div class="col">
						<img class="icon" src="css/sumra-text.png">
					</div>
				</div>
			</div>
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					        <span class="sr-only">Toggle navigation</span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
				     	</button>
				      <a class="navbar-brand" href="#"><img class="icon" src="css/ic_launcher1.png"></a>
				      <div class="col-2 col-md-8 col-lg-5 pull-right hidden-xs hidden-sm">
						<div class="center-block">
							<img class="img-responsive" src="css/googleplayx233.png">
						</div>
						<div class="center-block">
							<img class="img-responsive" src="css/appstorex233.png">
						</div>
						<div class="center-block">
							<img class="img-responsive" src="css/windowsx233.png">
						</div>
					  </div>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
					        <li><a href="#">Help</a></li>
					        <li><a href="#">Store</a></li>
					        <li><a href="#">Login</a></li>
					        <li><a href="#">Sign Up</a></li>
					        <li><a class="btn btn-info bussines" role="button" href="#">Sumra for Business</a></li>
				      	</ul>
				    </div><!-- /.navbar-collapse -->
				</div>
			</nav>
			<div class="row search">
				<div class="col-sm-1 col-md-1 col-lg-2 hidden-xs">
				</div>
    			<div class="col-xs-12 col-sm-10 col-md-10 col-lg-8">
    				<form class="navbar-form" action="/search/">
        				<div class="form-group col-md-12 col-lg-12">
								<input type="text" class="form-control input-lg" name="keyword" placeholder="SEARCH">
								<div class="input-group col-sm-4 col-md-3 col-lg-3 col-xl-2 input-group-lg">
							      	<input type="text" class="form-control" placeholder="POST CODE" >
							      	<span class="input-group-btn">
							     		<button class="btn btn-default" type="submit">Go</button>
							      	</span>
							    </div>
						</div>
					</form>
				</div><!-- /.col-lg-6 -->
			</div>
		</header>
		<section class="categories">
			<div class="container">
				<div class ="row">
			 	@foreach($base as $cat)
			 		<div class="col-xs-6 col-sm-3 col-md-3 col-lg-2">
				 		<div class="panel panel-primary {{$cat->class}}">
				 			<div class="panel-heading">
				 				<img class="icon-category" src="css/icons/{{$cat->slug}}.png">
				 				<h1>{{$cat->title}}</h1>
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
				<div class="row">
					<div class="center-block">
						<ul class="tabs-simple list-inline">
							<li><a class="tabs-simple-tab all-spot" href="">All Spotlight</a></li>
							<li><a class="tabs-simple-tab pop-se" href="">Popular Searches</a></li>
						</ul>
					</div>
					<div class="tabs-simple-bar">
						<div class="tabs-simple-bar-mask"></div>
					</div>
					<div id="myCarousel-xs" class="carousel slide visible-xs" data-ride="carousel">
						<!-- Indicators 
						<ol class="carousel-indicators">
							<li data-target="#myCarousel-xs" data-slide-to="0" class="active"></li>
						    <li data-target="#myCarousel-xs" data-slide-to="1"></li>
						    <li data-target="#myCarousel-xs" data-slide-to="2"></li>
						    <li data-target="#myCarousel-xs" data-slide-to="3"></li>
						</ol>
						<!-- Wrapper for slides -->
						<div class="carousel-inner ">
							<!-- small devices -->
							@for ($i = 0; $i < count($spotlight); $i++)
							<div class="item">
									@for ($j = 0; $j < 2; $i++,$j++)
						    		<div class="col-xs-6 col-md-4 col-lg-2">
							    		<div class="panel panel-primary">
								 			<div class="panel-heading" style="background-image:url(https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{ count($spotlight[$i]['images'])>0?$spotlight[$i]['images'][0]:"1000006.jpg"}});"">
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
						    <div class="item active">
						    	@foreach($spl1 as $spl)
						    		<div class="col-sm-4 col-md-4 col-lg-2">
							    		<div class="panel panel-primary">
								 			<div class="panel-heading" style="background-image:url(https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{ count($spl['images'])>0?$spl['images'][0]:"1000006.jpg"}});"">
								 			</div>
								 			<div class="panel-body">
								 				<h3 class="text">{{$spl['title']}}</h3>
											 	@if($spl['meta']['price']>=0)
			                                            <div class="items-box-price font-5">£	{{$spl['meta']['price']/100}}{{isset($spl['meta']['price_frequency']) ? $spl['meta']['price_frequency']:''}}
			                                            </div>
			                                   @endif
											</div>
										</div>
									</div>
						    	@endforeach
						    </div>
						    <div class="item">
						    	@foreach($spl2 as $spl)
						    		<div class="col-sm-4 col-md-4 col-lg-2">
							    		<div class="panel panel-primary">
								 			<div class="panel-heading" style="background-image:url(https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{ count($spl['images'])>0?$spl['images'][0]:"1000006.jpg"}});"">
								 			</div>
								 			<div class="panel-body">
								 				<h3 class="text">{{$spl['title']}}</h3>
								 				@if($spl['meta']['price']>=0)
			                                            <div class="items-box-price font-5">£	{{$spl['meta']['price']/100}}{{isset($spl['meta']['price_frequency']) ? $spl['meta']['price_frequency']:''}}
			                                            </div>
			                                   @endif
											 	
											</div>
										</div>
									</div>
						    	@endforeach
						    </div>
						    <div class="item">
						    	@foreach($spl3 as $spl)
						    		<div class="col-sm-4 col-md-4 col-lg-2">
							    		<div class="panel panel-primary">
								 			<div class="panel-heading" style="background-image:url(https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{ count($spl['images'])>0?$spl['images'][0]:"1000006.jpg"}});"">
								 			</div>
								 			<div class="panel-body">
								 				<h3 class="text">{{$spl['title']}}</h3>
											 	@if($spl['meta']['price']>=0)
			                                            <div class="items-box-price font-5">£	{{$spl['meta']['price']/100}}{{isset($spl['meta']['price_frequency']) ? $spl['meta']['price_frequency']:''}}
			                                            </div>
			                                   @endif
											</div>
										</div>
									</div>
						    	@endforeach  
						    </div>
						    <div class="item">
						    	@foreach($spl4 as $spl)
						    		<div class="col-sm-4 col-md-4 col-lg-2">
							    		<div class="panel panel-primary">
								 			<div class="panel-heading" style="background-image:url(https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{ count($spl['images'])>0?$spl['images'][0]:"1000006.jpg"}});"">
								 			</div>
								 			<div class="panel-body">
								 				<div class="text">
								 					<h3 class="">{{$spl['title']}}</h3>
								 				</div>
											 	@if($spl['meta']['price']>=0)
			                                            <div class="items-box-price font-5">£	{{$spl['meta']['price']/100}}{{isset($spl['meta']['price_frequency']) ? $spl['meta']['price_frequency']:''}}
			                                            </div>
			                                   @endif
											</div>
										</div>
									</div>
						    	@endforeach  
						    </div>
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
						<p>What you see is what you get, no hidden fees on our purchase prices</p>
					</div>
					<div class="col-xs-8 col-sm-6 col-md-6 col-lg-4 col-xs-offset-2 col-sm-offset-0">
						<figure>
							<img src="css/icons/verified.svg">
						</figure>
						<h2>VERIFIED</h2>
						<p>Our buyer guarantee means you'll get refunded if something goes wrong</p>
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
		<footer>
		    <div class="container">
		        <div class="row">
		            <div class="col-md-12">
		                <img id="footer_top_logo" class="img-responsive" title="" alt="" src="css/sumra-text.png">
		            </div>

		            <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-2">
		                <div class="col">
		                    <h4>Company</h4>
		                    <ul>
		                        <li><a href="/about-us" title="About us">About us</a></li>
		                        <li><a href="/history/about" title="Company History">Company History</a></li>
		                        <li><a href="/contact-us" title="Contact us">Contact us</a></li>
		                        <!--<li></li>-->
		                    </ul>
		                </div>
		            </div>
		            <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-0">
		                <div class="col">
		                    <h4>Discover</h4>
		                    <ul>
		                        <li><a href="/why-us" title="Why Us">Why Us</a></li>
		                        <li><a href="/our-programs" title="Our programmes">Our academic programmes</a></li>
		                        <li><a href="/our-teaching-methods" title="Our teaching methods">Our teaching methods</a></li>
		                    </ul>
		                </div>
		            </div>
		            <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-0">
		                <div class="col">
		                    <h4>Experience</h4>
		                    <ul>
		                        <li><a href="/growth" title="Growth">Growth</a></li>
		                        <li><a href="/responsibility" title="Responsibility">Responsibility</a></li>
		                        <li><a href="/security" title="Security">Security</a></li>
		                    </ul>
		                </div>
		            </div>
		            <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-0">
		                <div class="col">
		                    <h4>Resources</h4>
		                    <ul>
		                        <li><a href="/faq" title="F.A.Q.">F.A.Q.</a></li>
		                        <li><a href="/help" title="Help">Help</a></li>
		                        <li><a href="/how-it-works" title="How it works">How it works</a></li>
		                    </ul>
		                </div>
		            </div>
		        </div>
		        <div class="row">
		            <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-2">
		                <div class="col">
		                    <h4>Commitment</h4>
		                    <ul>
		                        <li><a href="/privacy-policy" title="Privacy policy">Privacy policy</a></li>
		                        <li><a href="/cookies-policy" title="Cookies policy">Cookies policy</a></li>
		                        <li><a href="/terms-of-use" title="Terms of Use">Terms of Use</a></li>
		                    </ul>
		                </div>
		            </div>
		            <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-0">
		                <div class="col">
		                    <h4>Partnerships</h4>
		                    <ul>
		                        <li><a href="/corporate-partners" title="Corporate partners">Corporate partners</a></li>
		                        <li><a href="/education-partners" title="Education partners">Education partners</a></li>
		                        <li><a href="/brand-partners" title="Brand partners">Brand partners</a></li>
		                    </ul>
		                </div>
		            </div>
		            <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-0">
		                <div class="col">
		                    <h4>Press & Opportunities</h4>
		                    <ul>
		                        <li><a href="/careers" title="Careers">Careers</a></li>
		                        <li><a href="/press" title="Press">Press</a></li>
		                    </ul>
		                </div>
		            </div>
		            <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-0">
		                <div class="col">
		                    <img  class="img-responsive  footer_logo" src="/css/ic_launcher1.png" />
		                </div>
		            </div>
		        </div>
		    </div>
		</footer>
		<div class="copyright style-1">
		   <div class="container">
		        <div class="row">
		            <div class="cell col-lg-4 col-md-8 col-xs-12 footer-copy col-md-offset-2 col-lg-offset-4">
		                All rights reserved. Copyright &copy; 2017 <span class="company-rights">SUMRA</span>
		            </div>
		        </div>
		    </div>
		</div>
	</body>
</html>