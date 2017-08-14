<!DOCTYPE html>
<html lang="en-US">
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
	<body class="">
		<header>
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					        <span class="sr-only">Toggle navigation</span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
				     	</button>
				      <a class="navbar-brand" href="#"><img class="icon" src="css/logo.png">Sumra</a>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
					        <li><a href="#">Help</a></li>
					        <li><a href="#">Store</a></li>
					        <li><a href="#">Login</a></li>
					        <li><a href="#">Sign Up</a></li>
					        <li><a href="#">Sumra for Business</a></li>
				      	</ul>
				    </div><!-- /.navbar-collapse -->
				</div>
			</nav>
			<div class="row search">
				<div class="col-lg-3">
				</div>
    			<div class="col-lg-6">
    				<form class="navbar-form" action="/search/">
        				<div class="form-group col-lg-12">
								<input type="text" class="form-control input-lg" name="keyword" placeholder="Search for...">
								<div class="input-group col-lg-4 input-group-lg">
							      	<input type="text" class="form-control" placeholder="Post Code" >
							      	<span class="input-group-btn">
							     		<button class="btn btn-default" type="button">Go!</button>
							      	</span>
							    </div>
						</div>
					</form>
				</div><!-- /.col-lg-6 -->
				<div class="col-lg-3 app-stores">
						
				</div>
			</div>
		</header>
		<section class="categories">
			<div class ="row">
		 	@foreach($base as $cat)
		 		<div class="col-md-6 col-lg-2">
			 		<div class="panel panel-primary {{$cat->class}}">
			 			<div class="panel-heading">
			 				<img class="icon-category" src="css/icons/{{$cat->slug}}.png">
			 				<h1>{{$cat->title}}</h1>
			 			</div>
			 			<div class="panel-body .visible-md-*">
						 	<ul>
						 	@foreach($cat->children as $child)
						 		<li><a href="{{$child->slug}}">{{$child->title}}</a></li>
						 	@endforeach
						 	@if($cat->hasMore)
						 		<div class="read-more">
						 			<a href="#">more..</a>
						 		</div>
						 	@endif
						 	</ul>
						 </div>
					 </div>
				 </div>
		 	@endforeach
		</section>
		<section class="spotligth">
			<div class="row">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					    <li data-target="#myCarousel" data-slide-to="1"></li>
					    <li data-target="#myCarousel" data-slide-to="2"></li>
					</ol>
				<!-- Wrapper for slides -->
				<div class="carousel-inner">
				    <div class="item active">
				    	@foreach($spl1 as $spl)
				    		<div class="col-lg-2">
					    		<div class="panel panel-primary {{$cat->class}}">
						 			<div class="panel-heading" style="background-image:url(https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{ count($spl['images'])>0?$spl['images'][0]:"1000006.jpg"}});"">
						 			</div>
						 			<div class="panel-body .visible-md-*">
						 				<h3 class="">{{$spl['title']}}</h3>
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
				    		<div class="col-lg-2">
					    		<div class="panel panel-primary {{$cat->class}}">
						 			<div class="panel-heading" style="background-image:url(https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{ count($spl['images'])>0?$spl['images'][0]:"1000006.jpg"}});"">
						 			</div>
						 			<div class="panel-body .visible-md-*">
						 				<h3 class="">{{$spl['title']}}</h3>
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
				    		<div class="col-lg-2">
					    		<div class="panel panel-primary {{$cat->class}}">
						 			<div class="panel-heading" style="background-image:url(https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{ count($spl['images'])>0?$spl['images'][0]:"1000006.jpg"}});"">
						 			</div>
						 			<div class="panel-body .visible-md-*">
						 				<h3 class="">{{$spl['title']}}</h3>
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
				    		<div class="col-lg-2">
					    		<div class="panel panel-primary {{$cat->class}}">
						 			<div class="panel-heading" style="background-image:url(https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{ count($spl['images'])>0?$spl['images'][0]:"1000006.jpg"}});"">
						 			</div>
						 			<div class="panel-body .visible-md-*">
						 				<h3 class="">{{$spl['title']}}</h3>
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
		</section>
	</body>
</html>