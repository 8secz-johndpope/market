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
				      <a class="navbar-brand" href="#"><img class="icon" src="css/logo.png"></a>
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
    				<form class="navbar-form navbar-left">
        				<div class="form-group">
								<input type="text" class="form-control .input-lg" placeholder="Search for...">
								<div class="input-group col-lg-2">
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
		 		<div class="col-md-6 col-lg-1">
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
		</section>
	</body>
</html>