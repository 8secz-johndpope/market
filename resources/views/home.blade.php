{{$this->i = 0}}
<!DOCTYPE html>
<html lang="en-US">
	<head>
	    <meta charset="utf-8">

	    <meta name="viewport" content="width=device-width, initial-scale=1">

	    <title>{{$last}} - Sumra:  Buy Safe,Sell Safe</title>
	    <meta name="description" content="Cargocategory.description.sub_category">


	    <meta property="og:type" content="website">
	    <meta property="og:site_name" content="Mercari: Anyone can buy & sell">
	    <meta property="og:title" content="Cargo - Mercari: Anyone can buy &amp; sell">
	    <meta property="og:description" content="Cargocategory.description.sub_category">
	    <meta property="og:url" content="/category/322/">
	    <meta property="og:image" content="/assets/img/common/us/ogp.png">

	    <meta property="al:ios:app_name" content="Mercari">
	    <meta property="al:ios:app_store_id" content="896130944">
	    <meta property="al:android:app_name" content="Mercari">
	    <meta property="al:android:package" content="com.mercariapp.mercari">

	    <meta name="twitter:card" content="app">
	    <meta name="twitter:site" content="@mercari_app">
	    <meta name="twitter:title" content="Cargo">
	    <meta name="twitter:description" content="Cargocategory.description.sub_category">
	    <meta name="twitter:image" content="/assets/img/common/us/ogp.png">

	    <meta name="twitter:app:country" content="us">
	    <meta name="twitter:app:name:iphone" content="Mercari">
	    <meta name="twitter:app:name:ipad" content="Mercari">
	    <meta name="twitter:app:name:googleplay" content="Mercari">
	    <meta name="twitter:app:id:iphone" content="896130944">
	    <meta name="twitter:app:id:ipad" content="896130944">
	    <meta name="twitter:app:id:ipad" content="896130944">
	    <meta name="twitter:app:id:googleplay" content="com.mercariapp.mercari">

	    <meta name="format-detection" content="telephone=no">

	    <link rel="canonical" href="/category/322/">


	    <link rel="next" href="/category/322/?page=2">


	    <link href="/css/app.css?3198405465" rel="stylesheet">

	    <link rel="apple-touch-icon" sizes="180x180" href="https://sumra.net/favicons/apple-touch-icon.png">
	    <link rel="icon" type="image/png" href="https://sumra.net/favicons/favicon-32x32.png" sizes="32x32">
	    <link rel="icon" type="image/png" href="https://sumra.net/favicons/favicon-16x16.png" sizes="16x16">
	    <link rel="manifest" href="https://sumra.net/favicons/manifest.json">
	    <link rel="mask-icon" href="https://sumra.net/favicons/safari-pinned-tab.svg" color="#5bbad5">


	    <meta name="msapplication-TileColor" content="#ffc40d">
	    <meta name="msapplication-TileImage" content="//www-mercari-com.akamaized.net/mstile-144x144.png?1224156651">
	    <meta name="theme-color" content="#ea352d">
	    <link rel="apple-touch-icon-precomposed" href="//www-mercari-com.akamaized.net/apple-touch-icon-precomposed.png?1224156651">
	    <link rel="apple-touch-icon" sizes="57x57" href="//www-mercari-com.akamaized.net/apple-touch-icon-57x57.png?1224156651">
	    <link rel="apple-touch-icon" sizes="60x60" href="//www-mercari-com.akamaized.net/apple-touch-icon-60x60.png?1224156651">
	    <link rel="apple-touch-icon" sizes="72x72" href="//www-mercari-com.akamaized.net/apple-touch-icon-72x72.png?1224156651">
	    <link rel="apple-touch-icon" sizes="76x76" href="//www-mercari-com.akamaized.net/apple-touch-icon-76x76.png?1224156651">
	    <link rel="apple-touch-icon" sizes="114x114" href="//www-mercari-com.akamaized.net/apple-touch-icon-114x114.png?1224156651">
	    <link rel="apple-touch-icon" sizes="120x120" href="//www-mercari-com.akamaized.net/apple-touch-icon-120x120.png?1224156651">
	    <link rel="apple-touch-icon" sizes="144x144" href="//www-mercari-com.akamaized.net/apple-touch-icon-144x144.png?1224156651">
	    <link rel="apple-touch-icon" sizes="152x152" href="//www-mercari-com.akamaized.net/apple-touch-icon-152x152.png?1224156651">
	    <link rel="apple-touch-icon" sizes="180x180" href="//www-mercari-com.akamaized.net/apple-touch-icon-180x180.png?1224156651">

	    <link rel="alternate" href="android-app://com.mercariapp.mercari/mercariapp/search/openResults?item_category_id=322&amp;item_category_name=Cargo" />

	</head>
	<body class="">
		<section class="categories">
		 	@foreach($base as $b)
		 		<div class="category">
		 			<h1>{{$categories[$b]["title"]}}</h1>
		 		
				 	@if(isset($children[$b]))
					 	<ul>
					 	@foreach($children[$b] as $child)
					 		<li>{{$categories[$child]['title']}}</li>
					 	<?php	
					 		$this->i++;
					 		if($this->i == 9)
					 			break;
					 	?>
					 	</ul>
					 	@endforeach
					@endif
				 </div>
		 	@endforeach
			<h1>Let server udpate{{$categories["boxing-martial-arts-punch-bags"]["title"]}}</h1>
		</section>
		<section class="spotligth">
		</section>
	</body>
</html>