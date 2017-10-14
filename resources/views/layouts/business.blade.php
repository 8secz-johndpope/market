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

    <nav class="navbar navbar-inverse">
        <div class="container-fluid" style="background: black">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                @if(Auth::user()->contract!==null)
                <a class="navbar-brand" href="/"><img class="icon-small" src="/css/sumra-business.png"></a>
                    @else
                    <a class="navbar-brand" href="/"><img class="icon-small" src="/css/sumra-text.png"></a>

                @endif

            </div>
            <div class="business-drop collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Store</a></li>
                    @if (Auth::guest())
                        <li><a href="/login">Login</a></li>
                        <li><a href="/register">Sign Up</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Hello, {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/user/manage/ads"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;Manage My Ads</a> </li>
                                <li>
                                    <a class="nav-link nav-color" href="/user/manage/orders"><span class="glyphicon glyphicon-credit-card"></span> &nbsp;&nbsp; Orders</a>
                                </li>
                                <li>
                                    <a class="nav-link nav-color" href="/user/manage/messages"><span class="glyphicon glyphicon-envelope"></span> &nbsp;&nbsp; Messages</a>
                                </li>
                                <li>
                                    <a class="nav-link nav-color" href="/business/manage/details"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp; My Details</a>
                                </li>
                                @if($user->contract!==null)
                                    <li>
                                        <a class="nav-link nav-color" href="/business/manage/company"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp; Company</a>
                                    </li>
                                    <li>
                                        <a class="nav-link nav-color" href="/business/manage/finance"><span class="glyphicon glyphicon-gbp"></span> &nbsp;&nbsp; Financials</a>
                                    </li>
                                    <li>
                                        <a class="nav-link nav-color" href="/business/manage/metrics"><span class="glyphicon glyphicon-stats"></span> &nbsp;&nbsp; Metrics</a>
                                    </li>
                                @endif
                                <li>
                                    <a class="nav-link nav-color" href="/user/manage/favorites"><span class="glyphicon glyphicon-heart"></span> &nbsp;&nbsp; Favorites</a>
                                </li>
                                <li>
                                    <a class="nav-link nav-color" href="/user/manage/alerts"><span class="glyphicon glyphicon-alert"></span> &nbsp;&nbsp; Search Alerts</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       <span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp; Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>

                    @endif
                    <li><a class="post-advert" href="/user/ad/create"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Post an Ad</a> </li>

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
    $(".favroite-icon").click(function (e) {
        e.preventDefault();

        var id = $(this).data('id');
        if($(this).hasClass('glyphicon-heart')){
            $(this).addClass('glyphicon-heart-empty');
            $(this).removeClass('glyphicon-heart');

            axios.post('/user/list/unfavorite', {
                id:id
            })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });

        }else{
            $(this).addClass('glyphicon-heart');
            $(this).removeClass('glyphicon-heart-empty');
            axios.post('/user/list/favorite', {
                id:id
            })
                .then(function (response) {
                    console.log(response);

                })
                .catch(function (error) {
                    console.log(error);
                    document.location.href='/login';
                });
        }


    });
    $(".search-alert-check").click(function(){
        var id=$(this).val();
        axios.get('/user/toggle/alert/'+id, {
            id:id
        })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
    });

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