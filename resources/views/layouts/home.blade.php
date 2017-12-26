<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="{{ asset('/css/base.css?q=432') }}" rel="stylesheet">
    <link href="{{ asset('/css/extra.css?q=874') }}" rel="stylesheet">
    <link href="{{ asset('/css/css/font-awesome.min.css?q=874') }}" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>

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

        body {
            /* font: 1em/1.67 'Open Sans', Arial, Sans-serif; */
            margin: 0;
            /*background: #e9e9e9;*/
        }

        .masonry { /* Masonry container */
            column-count: 3;
            column-gap: 1em;
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

    </style>

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
    <nav class="navbar navbar-default">
        <div class="container-fluid top">
            <div class="row">
                <div class="col-lg-2 col-md-3 navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{env('APP_URL')}}/">
                        <img class="icon-small-h" src="/css/ic_launcher1.png">
                        <img class="icon" src="/css/ggg-text.png">
                    </a>
                </div>
                 <div class="header-download col-2 col-md-3 col-lg-2 col-lg-offset-2 hidden-xs hidden-sm">
                            <div class="center-block">
                                <img class="img-responsive" src="/css/googleplayx233.png">
                            </div>
                            <div class="center-block">
                                <img class="img-responsive" src="/css/appstorex233.png">
                            </div>
                            <!-- <div class="center-block">
                            </div> -->
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
                                Hello, {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu options-user" role="menu">
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
                                            <a class="nav-link nav-color" href="/user/manage/messages"><span class="glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;Messages</a>
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
                                            <a class="nav-link nav-color" href="#"><span class="glyphicon glyphicon-open-file"></span>&nbsp;&nbsp;Send Invoice</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="#"><span class="glyphicon glyphicon-alert"></span>&nbsp;&nbsp;Unpaid Invoice</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="#"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Paid Invoice</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="#"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Pending Invoices</a>
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
                                            <a class="nav-link nav-color" href="/user/manage/applications"><span class="glyphicon glyphicon-list-alt"></span> &nbsp;&nbsp;Your Jobs Applications</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="#"><span class="fa fa-car"></span> &nbsp;&nbsp;Your Motors</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="#"><span class="fa fa-building"></span> &nbsp;&nbsp;Your Properties</a>
                                        </li>
                                        <li>
                                            <a class="nav-link nav-color" href="#"><span class="glyphicon glyphicon-tag"></span> &nbsp;&nbsp;Your Sales</a>
                                        </li>
                                    </ul>
                                </div>
                                @endif
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
                            </div>
                        </li>
                        @endif
                        @if (!Auth::guest())

                            <li class="dropdown messages-nav"><a href="/user/manage/messages"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <span > <span  class="glyphicon glyphicon-envelope"></span>    <span class="button__badge" style="display: none" id="message-notification">1</span></span><span class="caret"></span></a>
                                <ul class="dropdown-menu all-menu-messages list-group" role="menu">
                                    @foreach(Auth::user()->rooms as $room)
                                        <li class="list-group-item">
                                            <a href="/user/manage/messages/{{$room->id}}">{{$room->title}}</a>
                                            @if($room->last_message())
                                            <div class="message-inside">
                                                <p class="@if($room->unread===1) unread-message @endif">{{$room->last_message()->message}}</p>
                                                <span class="message-username">{{$room->last_message()->user->name}}</span>
                                            </div>
                                            @endif

                                        </li>
                                    @endforeach
                                </ul>

                            </li>
                        @endif
                        <li><a class="btn btn-info bussines" role="button" href="/user/contract/pricing">{{env('APP_NAME')}} for Business</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </div>
    </nav>
<div class="container-fluid background-body">
     <div class="row">
            <div class="col-sm-10 col-md-12">
            <form class="navbar-form" action="/searchform" id="mainform">
                @foreach($input as $key=>$value)
                    @if($key!=='q'&&$key!=='lat'&&$key!=='lng')
                        <input type="hidden" name="{{$key}}" value="{{$value}}">
                    @endif
                @endforeach
                    <input type="hidden" id="min_lat" name="min_lat" value="-99">
                    <input type="hidden" id="min_lng" name="min_lng" value="-99">
                    <input type="hidden" id="max_lat" name="max_lat" value="99">
                    <input type="hidden" id="max_lng" name="max_lng" value="99">
                    <input type="hidden" id="location_slug" name="slug" value="{{$location->slug}}">

                <div class="main-search-div">
                    <div class="main-first-div inline-block-div">
                        <div class="main-cat-div inline-block-div">
                            <select name="search_category" class="form-control" id="search_category">
                                @if($category->id!==0&&$category->parent_id!==0)
                                    <option value="{{$category->slug}}">{{$category->title}}</option>

                                @endif
                                <option value="all">All</option>
                                @foreach($base as $cat)
                                    <option value="{{$cat->slug}}" @if($category->slug===$cat->slug) selected @endif>{{$cat->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="main-q-div inline-block-div">
                            <input type="text" class="form-control" id="autocomplete" name="q" placeholder="SEARCH" value="@if(isset($input['q'])) {{$input['q']}} @endif">
                        </div>
                    </div>
                    <div class="main-second-div inline-block-div">
                        <div class="main-location-div inline-block-div">
                            <input type="text" id="pac-input" class="form-control" placeholder="Location" name="location" value="@if($location->id!==0) @if($type==='location') {{$location->title}} @else {{$postcode->postcode}} @endif @endif" required>
                        </div>
                        <div class="main-go-div inline-block-div">
							<button class="btn btn-primary" type="submit" id="submitform">Go</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>

</header>


<section>
    @yield('content')

</section>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <img id="footer_top_logo" class="img-responsive" title="" alt="" src="/css/ggg-text.png">
            </div>

            <div class="col-md-3 col-xs-5 col-xs-offset-1 col-md-offset-2">
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
            <div class="col-md-3 col-xs-5 col-xs-offset-1 col-md-offset-0">
                <div class="col">
                    <h4>Experience</h4>
                    <ul>
                        <li><a href="/growth" title="Growth">Growth</a></li>
                        <li><a href="/responsibility" title="Responsibility">Responsibility</a></li>
                        <li><a href="/security" title="Security">Security</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-xs-5 col-xs-offset-1 col-md-offset-0">
                <div class="col">
                    <h4>Help</h4>
                    <ul>
                        <li><a href="/help" title="Help">Topics</a></li>
                        <li><a href="/faq" title="F.A.Q.">F.A.Q.</a></li>
                        <li><a href="/delivery" title="Delivery">Delivery</a></li>
                        <li><a href="/promote-ad" title="Promote Ad">Promote Ad</a></li>
                        <li><a href="/contact-us" title="Contact Us">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-xs-5 col-xs-offset-1 col-md-offset-2">
                <div class="col">
                    <h4>Commitment</h4>
                    <ul>
                        <li><a href="/privacy-policy" title="Privacy policy">Privacy policy</a></li>
                        <li><a href="/cookies-policy" title="Cookies policy">Cookies policy</a></li>
                        <li><a href="/terms-of-use" title="Terms of Use">Terms of Use</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-xs-5 col-xs-offset-1 col-md-offset-0">
                <div class="col">
                    <h4>Partnerships</h4>
                    <ul>
                        <li><a href="/corporate-partners" title="Corporate partners">Corporate partners</a></li>
                        <li><a href="/education-partners" title="Education partners">Education partners</a></li>
                        <li><a href="/brand-partners" title="Brand partners">Brand partners</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-xs-5 col-xs-offset-1 col-md-offset-0">
                <div class="col">
                    <h4>Press & Opportunities</h4>
                    <ul>
                        <li><a href="/careers" title="Careers">Careers</a></li>
                        <li><a href="/press" title="Press">Press</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="col">
                    <img  class="img-responsive  footer_logo" src="/css/ic_launcher2.png" />
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="copyright style-1">
    <div class="container">
        <div class="row">
            <div class="cell">
                <p>All rights reserved. Copyright &copy; 2017 <span class="company-rights">{{env('APP_NAME')}}</span><p>
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

/*
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.Autocomplete(input);
        searchBox.setComponentRestrictions(
            {'country': ['gb']});
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('place_changed', function() {
            var place = searchBox.getPlace();
            console.log(place);

            var lat = document.getElementById('lat');
            var lng = document.getElementById('lng');
            var min_lat = document.getElementById('min_lat');
            var min_lng = document.getElementById('min_lng');
            var max_lat = document.getElementById('max_lat');
            var max_lng = document.getElementById('max_lng');
            lat.value=place.geometry.location.lat();
            lng.value=place.geometry.location.lng();
            min_lat.value = place.geometry.viewport.f.b;
            max_lat.value = place.geometry.viewport.f.f;
            min_lng.value = place.geometry.viewport.b.b;
            max_lng.value = place.geometry.viewport.b.f;
            $("#submitform").click();
        });
        */
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWhXNJ7VlpNA64oFdUU4pmq3YLZC6Xqd4&libraries=places&callback=initAutocomplete"
        async defer></script>
<script src="{{env('APP_URL')}}/js/jquery.autocomplete.js"></script>
<script src="https://images.apple.com/v/apple-tv/c/built/scripts/head.built.js" type="text/javascript" charset="utf-8"></script>
<script data-src="https://images.apple.com/v/apple-tv/c/built/scripts/webgl-externals.built.js" type="text/javascript" charset="utf-8" async="true" class="webgl-externals"></script>
<script src="{{env('APP_URL')}}/js/three.js"></script>
<script src="{{env('APP_URL')}}/js/built.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-lazyload/8.2.0/lazyload.min.js"></script>
<script>
    new LazyLoad();
</script>

<script>
    window.axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
    };
    $('#autocomplete').autocomplete({
        paramName :'q',
        serviceUrl: '/api/suggest',
        onSelect: function (suggestion) {
            $("#autocomplete").val(suggestion.val);
            $('#search_category').append($('<option>', {
                value: suggestion.slug,
                text : suggestion.category
            }));
            $("#search_category").val(suggestion.slug);
            $("#submitform").click();
         //   window.location.href = "{{env('APP_URL')}}/"+suggestion.slug+"?q="+suggestion.value
            // alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
        }
    });
    $("#pac-input").autocomplete({
        paramName :'q',
        serviceUrl: '/api/lsuggest',
        onSelect: function (suggestion) {
            $("#location_slug").val(suggestion.slug);
            $("#submitform").click();
            //   window.location.href = "{{env('APP_URL')}}/"+suggestion.slug+"?q="+suggestion.value
            // alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
        }
    });


</script>
<script>
    $(".filter-button").click(function () {
        console.log($(".all-filters").css('visibility'));
        if ($(".all-filters").is(':visible')) {
            $(".all-filters").hide();
            $(".products").show();
            $("footer").show();
            $(".copyright").show();
            $(this).html('Filter');

        }else{
            $(".all-filters").show();
            $(".products").hide();
            $("footer").hide();
            $(".copyright").hide();

            $(this).html('Close');

        }
    });
    /*$(".favroite-icon").click(function (e) {
        e.preventDefault();

        var id = $(this).data('id');
        if($(this).hasClass('heart')){
            $(this).addClass('heart-empty');
            $(this).removeClass('heart');
            $(this).next().css('display', 'block');

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
            $(this).addClass('heart');
            $(this).removeClass('heart-empty');
            $(this).next().css('display', 'none');
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
</script>
@yield('scripts')
@if (!Auth::guest())
    <script>
        var token = '{{Auth::user()->access_token}}' ;

        var exampleSocket;
        reconnect();
        function reconnect() {
            exampleSocket = new WebSocket("wss://{{env('APP_HOST')}}:8080", "protocolOne");
            exampleSocket.onopen = function (event) {



                exampleSocket.send(JSON.stringify({'token': token}));

            };
            exampleSocket.onmessage = function (event) {
                //console.log(event.data);
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
                //console.log(event.data);
                reconnect();


            }
        }
    </script>
@endif
</body>
</html>