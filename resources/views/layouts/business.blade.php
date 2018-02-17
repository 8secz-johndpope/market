<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    @php
        $date = new Datetime();
        $dateMs = $date->getTimestamp();
    @endphp
    <link href="{{ asset("/css/extra.css?q=$dateMs") }}" rel="stylesheet">
    <link href="{{ asset('/css/css/font-awesome.min.css?q=874') }}" rel="stylesheet">
    @yield('styles')
    <meta name="theme-color" content="#000000">
    <meta name="msapplication-navbutton-color" content="#000000">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#000000">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-alpha.2/classic/ckeditor.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script src="https://js.braintreegateway.com/js/braintree-2.32.1.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>

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
@yield('styles')
</head>
<body class="">
<input type="hidden" id="amazon-region" value="{{env('AWS_REGION')}}">
<input type="hidden" id="amazon-account-id" value="{{env('AWS_ACCOUNT_ID')}}">
<input type="hidden" id="amazon-web-bucket" value="{{env('AWS_WEB_IMAGE_BUCKET')}}">
<input type="hidden" id="amazon-cv-bucket" value="{{env('AWS_CV_IMAGE_BUCKET')}}">
<input type="hidden" id="amazon-identity-pool-id" value="{{env('AWS_IDENTITY_POOL_ID')}}">
<input type="hidden" id="amazon-cognito-role" value="{{env('AWS_COGNITO_ROLE')}}">
<input type="hidden" id="amazon-web-bucket-url" value="{{env('AWS_WEB_IMAGE_URL')}}">
<input type="hidden" id="amazon-cv-bucket-url" value="{{env('AWS_CV_IMAGE_URL')}}">
<audio id="notify-tune" controls style="display: none">
    <source src="/css/y.ogg" type="audio/ogg">
    <source src="/css/y.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>
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
                <a class="navbar-brand" href="/"><img class="icon-small" src="/css/ggg-business.png"></a>
                    @else
                    <a class="navbar-brand" href="/"><img class="icon-small" src="/css/ggg-text.png"></a>

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
                            @include('market.dropdown-nav')
                            <!-- <div class="dropdown-menu options-user" role="menu">
                                <div class="list-menu-common">
                                    <div class="title-list">
                                        <span class="nav-link nav-color">Your account</span>
                                    </div>
                                    <ul>
                                        <li><a class="nav-link nav-color" href="/user/manage/ads"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;Manage My Ads</a> </li>
                                        <li><a class="nav-link nav-color" href="/user/ad/create"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Post an Ad</a> </li>
                                        <li>
                                            <a class="nav-link nav-color" href="/user/manage/images"><span class="glyphicon glyphicon-camera"></span>&nbsp;&nbsp;Images</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="/user/manage/orders"><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;Orders</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="/business/manage/details"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;My Details</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="/user/manage/favorites"><span class="glyphicon glyphicon-heart"></span>&nbsp;&nbsp;Favorites</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="/user/manage/alerts"><span class="glyphicon glyphicon-bell"></span>&nbsp;&nbsp;Search Alerts</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="/business/manage/support"><span class="fa fa-envelope"></span> &nbsp;&nbsp; Support</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                               <span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp; Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                <div class="list-menu-common">
                                    <div class="title-list">
                                        <span class="nav-link nav-color">Invoices</span>
                                    </div>
                                    <ul>
                                        <li>
                                            <a class="nav-link nav-color" href="/user/manage/contacts"><span class="glyphicon glyphicon-open-file"></span>&nbsp;&nbsp;Send Invoice</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="/user/manage/invoices"><span class="glyphicon glyphicon-alert"></span>&nbsp;&nbsp;Unpaid Invoice</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="/user/manage/invoices"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Paid Invoice</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="/user/manage/invoices"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Pending Invoices</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="#"><span class="fa fa-cloud-download"></span>&nbsp;&nbsp;Download Invoice CSV/Excel</a>
                                        </li>
                                    </ul>
                                </div>
                                @if(Auth::user()->contract!==null)
                                <div class="list-menu-common">
                                    <div class="title-list">
                                        <span>Your business</span>
                                    </div>
                                    <ul>
                                        <li>
                                            <a class="nav-link nav-color" href="/business/manage/company"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Company</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="/business/manage/finance"><span class="glyphicon glyphicon-gbp"></span> &nbsp;&nbsp;Financials</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="/business/manage/metrics"><span class="glyphicon glyphicon-stats"></span> &nbsp;&nbsp;Metrics</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="/user/manage/applications"><span class="glyphicon glyphicon-list-alt"></span> &nbsp;&nbsp;Recruitment Portal</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="/user/manage/motors"><span class="fa fa-car"></span> &nbsp;&nbsp;Motors Portal</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="#"><span class="fa fa-building"></span> &nbsp;&nbsp;Properties Portal</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="#"><span class="glyphicon glyphicon-tag"></span> &nbsp;&nbsp;For Sales Portal</a>
                                        </li>
                                    </ul>
                                </div>
                                @endif
                                <div class="list-menu-common">
                                    <div class="title-list">
                                        <span class="nav-link nav-color">Chat Centre</span>
                                    </div>
                                    <ul>
                                        <li>
                                            <a class="nav-link nav-color" href="/user/manage/messages"><span class="fa fa-commenting"></span> &nbsp;&nbsp;Messages</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="/user/manage/contacts"><span class="fa fa-address-book"></span> &nbsp;&nbsp;Contacts</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="/user/groups/create"><span class="fa fa-users"></span> &nbsp;&nbsp;New Group</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="#"><span class="fa fa-reply-all"></span> &nbsp;&nbsp;New Broadcast</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="#"><span class="fa fa-comments-o"></span> &nbsp;&nbsp;New Conversation</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="#"><span class="fa fa-money"></span> &nbsp;&nbsp;Share your Balance</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="#"><span class="fa fa-paperclip"></span> &nbsp;&nbsp;Attachment</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="#"><span class="fa fa-cog"></span> &nbsp;&nbsp;Settings</a>
                                        </li>
                                         <li>
                                            <a class="nav-link nav-color" href="#"><span class="fa fa-user-circle"></span> &nbsp;&nbsp;Profile</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="list-menu-common">
                                    <div class="title-list">
                                        <span class="nav-link nav-color">sWallet</span>
                                    </div>
                                    <ul>
                                        <li>
                                            <a class="nav-link nav-color" href="#">Balance</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="list-menu-common">
                                    <div class="title-list">
                                        <span class="nav-link nav-color">Our Offers</span>
                                    </div>
                                    <ul>
                                        <li>
                                            <span class="nav-link nav-offer">We do not have offers at the moment</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>-->
                        </li>

                    @endif

                    @if (!Auth::guest())

                        <li class="dropdown messages-nav"><a href="/user/manage/messages"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span > <span  class="glyphicon glyphicon-envelope"></span>    <span class="button__badge" style="display: none" id="message-notification">1</span></span><span class="caret"></span></a>
                            <ul class="dropdown-menu all-menu-messages list-group" role="menu">
                                @foreach(Auth::user()->rooms as $room)
                                    <li class="list-group-item">
                                        @if($room->last_message())
                                        <a href="/user/manage/messages/{{$room->id}}">
                                            <div class="message-inside">
                                                <span class="message-username">{{$room->last_message()->user->name}}</span>
                                                <span class="title-advert">{{$room->title}}</span>
                                                <p class="@if($room->unread===1) unread-message @endif">{{$room->last_message()->message}}</p>
                                                
                                            </div>
                                        </a>
                                        @endif
                                    </li>
                                @endforeach
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
            <div class="cell col-md-8 col-xs-12 footer-copy col-md-offset-2 text-center">
                All rights reserved. Copyright &copy; 2017 <span class="company-rights">{{env('APP_NAME')}}</span>
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
    /*$(".favroite-icon").click(function (e) {
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


    });*/
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
<script src="{{env('APP_URL')}}/js/jquery.autocomplete.js"></script>
<script src="{{env('APP_URL')}}/js/aws-sdk.js"></script>
<script src="{{env('APP_URL')}}/js/load.js"></script>
<script src="{{env('APP_URL')}}/js/multi-upload.js"></script>

<script src="{{env('APP_URL')}}/js/contract.js"></script>
@if (!Auth::guest())
    <script>
        var token = '{{$user->access_token}}' ;

        var exampleSocket;
        reconnect();
        function reconnect() {
            exampleSocket = new WebSocket("wss://{{env('APP_HOST')}}:8443", { keepAlive: 60, protocol: "protocolOne"});
            exampleSocket.onopen = function (event) {



                exampleSocket.send(JSON.stringify({'token': token}));

            };
            exampleSocket.onmessage = function (event) {
                console.log(event.data);
                var object = JSON.parse(event.data);
                if(object.message)
                {
                    document.getElementById('notify-tune').play();
                    $('#message-notification').show();

                }
                if(typeof got_message === "function")
                got_message(event.data)


            }
            exampleSocket.onclose = function (event) {
                console.log(event.data);
                reconnect();


            }
        }
    </script>
    @endif
</body>
</html>