<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">

    <!-- Styles -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">

    <link href="{{ asset('/css/extra.css?q=43') }}" rel="stylesheet">
    <link href="{{ asset('/css/css/font-awesome.min.css?q=874') }}" rel="stylesheet">
    @yield('styles')
    <meta name="theme-color" content="#000000">
    <meta name="msapplication-navbutton-color" content="#000000">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#000000">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-alpha.2/classic/ckeditor.js"></script>

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



</header>


<nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="background-color: #000;">
    <!-- Brand/logo -->
    <a class="navbar-brand" href="#">
        <img src="/css/ic_launcher1.png" alt="logo" style="width:40px;">
    </a>

    <!-- Links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="/">{{env('APP_NAME')}}</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    @yield('content')
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
            exampleSocket = new WebSocket("wss://{{env('APP_HOST')}}:8080", "protocolOne");
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