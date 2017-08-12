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
		<section class="categories">
		 	@foreach($base as $cat)
		 		<div class="panel panel-primary {{$cat->class}}">
		 			<div class="panel-heading">
		 				<img class="icon" src="css/icons/{{$cat->slug}}.png">
		 				<h1>{{$cat->title}}</h1>
		 			</div>
		 			<div class="panel-body">
					 	<ul>
					 	@foreach($cat->children as $child)
					 		<li><a>{{$child->title}}</a></li>
					 	@endforeach
					 		<div class="read-more">
					 			<a href="#">more..</a>
					 		</div>
					 	</ul>
					 </div>
				 </div>
		 	@endforeach
		</section>
		<section class="spotligth">
		</section>
	</body>
</html>