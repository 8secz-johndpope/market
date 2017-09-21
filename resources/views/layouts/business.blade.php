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
    <link href="{{ asset('/css/base.css?q=34') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">

    <link href="{{ asset('/css/extra.css?q=43') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script src="https://js.braintreegateway.com/js/braintree-2.32.1.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>

    <script src="/js/main.js"></script>
    <style>
        .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
        .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
        .autocomplete-selected { background: #F0F0F0; }
        .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
        .autocomplete-group { padding: 2px 5px; }
        .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
        .bold-category{
            font-weight: bold;
            font-style: italic;
        }
        span.extra-title {
            font-weight: bold;
        }
        .location-selected{
            display: none;
        }
        .row-images img{
            width: 100%;
        }
        a.select-category-link {
            float: right;
        }
        span.extra-large {
            font-size: 25px;
        }
        .manual-category-panel,.selected-category-panel,.selected-location-panel,.all-panels{
            display: none;
        }
        span.span-urgent, span.span-featured,span.span-spotlight,span.span-shipping {

            color: white;
            padding: 2px;
            width: 100px;
            display: inline-block;
            text-align: center;
            border-radius: 5px;
            font-weight: bold;
        }
        span.select-category {
            font-weight: bold;
        }
        span.suggest-title {
            font-weight: bold;
        }
        span.span-urgent{
            background: #ec4231;
        }
        span.span-featured{
            background: #3997ba;
        }
        span.span-spotlight{
            background: #5cb74c;
        }
        span.span-shipping{
            background: #286090;
        }
        .grayborder{
            border: solid 1px gray;
        }
        .height100{
            height: 50px;
            padding: 10px;
        }
        .selected-location, .selected-extras, .ad-title{
            margin-top: 20px;
        }
        .main-category {
            width: 14.28%;
            float: left;
            height: 100px;
            border: 1px solid gray;
            text-align: center;
            vertical-align: middle;
            line-height: 100px;
            cursor: pointer;
        }
        .floatright {
            float: right;
        }
        .buttons{
            margin-top: 150px;
        }
        .nomargin{
            margin: 0px;
        }
        .nopadding{
            padding: 0px;
        }

        body {
            /* font: 1em/1.67 'Open Sans', Arial, Sans-serif; */
            margin: 0;
            background: #e9e9e9;
        }
        .sub-category {

            border: 1px solid gray;
            padding: 0px;
            overflow-x: scroll;
        }
        #map {
            height: 400px;
            width: 100%;
        }
        .masonry { /* Masonry container */
            column-count: 3;
            column-gap: 1em;
        }
        .category-title{
            font-size: 20px;
            margin-left: 10px;
            font-weight: bold;

        }

        .item { /* Masonry bricks or child elements */
            background-color: #eee;
            display: inline-block;
            margin: 0 0 1em;
            width: 100%;
        }
        .wrapper {
            width: 95%;
            margin: 3em auto;
        }

        .masonry {
            margin: 1.5em 0;
            padding: 0;
            -moz-column-gap: 1.5em;
            -webkit-column-gap: 1.5em;
            column-gap: 1.5em;
            font-size: .85em;
        }

        .item {
            display: inline-block;
            background: #fff;
            padding: 1em;
            margin: 0 0 1.5em;
            width: 100%;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-shadow: 2px 2px 4px 0 #ccc;
        }


        @media only screen and (min-width: 300px) {
            .masonry {
                -moz-column-count: 2;
                -webkit-column-count: 2;
                column-count: 2;
            }
        }



        @media only screen and (min-width: 900px) {
            .masonry {
                -moz-column-count: 3;
                -webkit-column-count: 3;
                column-count: 3;
            }
        }

        @media only screen and (min-width: 1100px) {
            .masonry {
                -moz-column-count: 4;
                -webkit-column-count: 4;
                column-count: 4;
            }
        }

        @media only screen and (min-width: 1280px) {
            .wrapper {
                width: 1260px;
            }
        }
        .description, .meta, .mapframe{
            margin-top: 30px;
        }
        .mapframe{
            margin-bottom: 30px;
        }
        .meta-bold{
            font-weight: bold;
        }


    </style>

</head>
<body class="">
<header>

    <nav class="navbar navbar-default">
        <div class="container-fluid" style="background: black">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><img class="icon" src="/css/sumra-business.png"></a>

            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Store</a></li>
                    @if (Auth::guest())
                        <li><a href="/login">Login</a></li>
                        <li><a href="/register">Sign Up</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/user/manage/ads">Manage My Ads</a> </li>
                                <li><a href="/user/manage/orders">Orders</a> </li>
                                <li><a href="/user/manage/buying">Buying</a> </li>
                                <li><a href="/user/manage/favorites">Favorites</a> </li>
                                <li><a href="/user/manage/details">My Details</a> </li>
                                <li><a href="/user/ads/post">Post an Ad</a> </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>

</header>


<section>
    @yield('content')

</section>

<div class="copyright style-1">
    <div class="container">
        <div class="row">
            <div class="cell col-lg-4 col-md-8 col-xs-12 footer-copy col-md-offset-2 col-lg-offset-4">
                All rights reserved. Copyright &copy; 2017 <span class="company-rights">SUMRA</span>
            </div>
        </div>
    </div>
</div>
<script>
    // This example adds a search box to a map, using the Google Place Autocomplete
    // feature. People can enter geographical searches. The search box will return a
    // pick list containing a mix of places and predicted search terms.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    function initAutocomplete() {


        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        if(input) {
            var searchBox = new google.maps.places.Autocomplete(input);
            searchBox.setComponentRestrictions(
                {'country': ['gb']});
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener('place_changed', function () {
                var place = searchBox.getPlace();
                console.log(place);

                var lat = document.getElementById('lat');
                var lng = document.getElementById('lng');
                lat.value = place.geometry.location.lat();
                lng.value = place.geometry.location.lng();

            });
        }

    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWhXNJ7VlpNA64oFdUU4pmq3YLZC6Xqd4&libraries=places&callback=initAutocomplete"
        async defer></script>
<script src="https://sumra.net/js/jquery.autocomplete.js"></script>
<script src="https://sumra.net/js/aws-sdk.js"></script>
<script src="https://sumra.net/js/load.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://sumra.net/js/contract.js"></script>

</body>
</html>