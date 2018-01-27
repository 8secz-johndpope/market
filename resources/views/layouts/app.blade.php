<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="{{ asset('/css/css/font-awesome.min.css?q=874') }}" rel="stylesheet">
    <link href="{{ asset('/css/base.css?q=34') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link href="{{ asset('/css/extra.css?q=43') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-alpha.2/classic/ckeditor.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
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
            height: 400px;
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
.description, .meta{
    margin-top: 30px;
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
    <nav class="navbar navbar-default navbar-fixed-top">
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
                                        @if($room->last_message())
                                        <li class="list-group-item">
                                            <a href="/user/manage/messages/{{$room->id}}">{{$room->title}}</a>
                                            <div class="message-inside">
                                                <p class="@if($room->unread===1) unread-message @endif">{{$room->last_message()->message}}</p>
                                                <span class="message-username">{{$room->last_message()->user->name}}</span>
                                            </div>

                                        </li>
                                        @endif
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
            <div class="cell col-lg-4 col-md-8 col-xs-12 footer-copy col-md-offset-2 col-lg-offset-4">
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

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWhXNJ7VlpNA64oFdUU4pmq3YLZC6Xqd4&libraries=places&callback=initAutocomplete"
        async defer></script>
<script
        src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
        crossorigin="anonymous"></script>
<script src="{{env('APP_URL')}}/js/jquery.autocomplete.js"></script>
<script src="{{env('APP_URL')}}/js/aws-sdk.js"></script>
<script src="{{env('APP_URL')}}/js/load.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
    $('#sortable').sortable({placeholder: "ui-state-highlight",helper:'clone'});
    window.axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
    };

    $(".stats-click").click(function () {
        var id = $(this).data('id');
        axios.get('/user/p/stats/'+id,{ params:{}})
            .then(function (response) {
                console.log(response);
                $("#modal-content").html(response.data);
                $("#myModal").modal('show');
            })
            .catch(function (error) {
                console.log(error);
            });
    });
    $('#autocomplete').autocomplete({
        paramName :'q',
        serviceUrl: '/api/suggest',
        onSelect: function (suggestion) {
            window.location.href = "{{env('APP_URL')}}/"+suggestion.slug+"?q="+suggestion.value
            // alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
        }
    });
    $(".main-category").on("click", function(event){
        $('.select-arrow').removeClass('glyphicon-ok-sign');
        $('.category-level-2').html('');
        $('.category-level-3').html('');
        $('.category-level-4').html('');
        console.log($(this).data('category'));
        $.get("/category/children/"+$(this).data('category'), function(data, status){
            console.log(data);
            $('.category-level-1').html(data);
        });
    });
    $(".category-level-1").on("click","li", function(event){
        $('.select-arrow').removeClass('glyphicon-ok-sign');
        $('.category-level-3').html('');
        $('.category-level-4').html('');
        var count = $(this).data('children');
        if(count===0){
            $('.category-level-2').html('');
            $("#continue-button").attr('disabled',false);
            $("#continue-button").data('category',$(this).data('category'));
            $(this).find('.select-arrow').addClass('glyphicon-ok-sign');
            return;
        }
        $("#continue-button").attr('disabled',true);

        console.log($(this).data('category'));
        $.get("/category/children/"+$(this).data('category'), function(data, status){
            console.log(data);
            $('.category-level-2').html(data);
        });
    });
    $(".category-level-2").on("click","li", function(event){
        $('.select-arrow').removeClass('glyphicon-ok-sign');
        $('.category-level-4').html('');
        var count = $(this).data('children');
        if(count===0){
            $('.category-level-3').html('');
            $("#continue-button").attr('disabled',false);
            $("#continue-button").data('category',$(this).data('category'));
            $(this).find('.select-arrow').addClass('glyphicon-ok-sign');
            return;
        }
        $("#continue-button").attr('disabled',true);

        console.log($(this).data('category'));
        $.get("/category/children/"+$(this).data('category'), function(data, status){
            console.log(data);
            $('.category-level-3').html(data);
        });
    });
    $(".category-level-3").on("click","li", function(event){
        $('.select-arrow').removeClass('glyphicon-ok-sign');
        var count = $(this).data('children');
        if(count===0){
            $('.category-level-4').html('');
            $("#continue-button").attr('disabled',false);
            $("#continue-button").data('category',$(this).data('category'));

            $(this).find('.select-arrow').addClass('glyphicon-ok-sign');
            return;
        }
        $("#continue-button").attr('disabled',true);

        console.log($(this).data('category'));
        $.get("/category/children/"+$(this).data('category'), function(data, status){
            console.log(data);
            $('.category-level-4').html(data);
        });
    });
    $("#continue-button").click(function () {
        $('#category').val($(this).data('category'));
        $('#change-category').submit();
      //  get_extras($(this).data('category'));
    });
    $(".category-level-4").on("click","li", function(event) {
        $('.select-arrow').removeClass('glyphicon-ok-sign');
        $("#continue-button").attr('disabled',false);
        get_extras($(this).data('category'));
        $(this).find('.select-arrow').addClass('glyphicon-ok-sign');
    });
    function get_extras(category) {
        $("#category").val(category);
        if($(".location-selected").is(':visible'))
        $(".all-panels").show();
        $.get("/category/string/"+category, function(data, status){
            console.log(data);
            $('.category-sting').html(data);
            $(".manual-category-panel").hide();
            $(".automatic-category-panel").hide();
            $(".selected-category-panel").show();
            $(".selected-location-panel").show();
        })
        $.get("/category/extras/"+category, function(data, status){
            console.log(data.length);
            $('.category-extras').html(data);
            if(data.length===0){
                $('.extra-options-panel').hide();
            }else{
                $('.extra-options-panel').show();
            }
        });
        get_prices(category);
    }
    function get_prices(category) {
        var lat = $("#lat").val();
        var lng = $("#lng").val();
        var id = $("#location_id").val();
        $.get("/category/prices/"+category+'?id='+id, function(data, status){
            $('.extra-prices').html(data);
        });
    }
    $('input.posting-string').on('input',function(e){
        $.get("/category/suggest?q="+$(this).val(), function(data, status){
            console.log(data);
            $('.category-suggest').html(data);
        });
    });
    $(".category-suggest").on("click","li", function(event) {
        $('#category').val($(this).data('category'));
        $("#change-category").submit();
    });

    $(".browse-category").click(function () {
        $(".manual-category-panel").show();
    });
    $(".edit-category").click(function () {
       $('.all-panels').hide();
       $('.selected-category-panel').hide();
       $('.automatic-category-panel').show();
    });
    $(".postcode-submit").click(function () {
        console.log("click works");

    });
    $(".edit-location-button").click(function () {
        $(".edit-location").show();
        $(".location-selected").hide();
        $(".all-panels").hide();
    });
    $(".add-image").click(function () {
        $("#file-chooser").click();
    });
    $("#file-chooser").change(function () {
        console.log("did change");
        upload_file();
    });
    function get_location(postcode) {
        /*
        $.get("https://maps.googleapis.com/maps/api/geocode/json?address="+postcode+"&key=AIzaSyDsy5_jVhfZJ7zpDlSkGYs9xdo2yFJFpQ0",function (data,status) {
            console.log(data.results[0]['formatted_address']);
            console.log(data.results[0]['geometry']['location']['lat']);
            console.log(data.results[0]['geometry']['location']['lng']);
            var address = data.results[0]['formatted_address'];
            var parts =  address.split(',');
            $("#location_name").val(parts[0]);
            $("#lat").val(data.results[0]['geometry']['location']['lat']);
            $("#lng").val(data.results[0]['geometry']['location']['lng']);
            var category =  $("#category").val();
            get_prices(category);


        });
        */
        axios.get('/postcodes/postcode',{ params:{q:postcode}})
            .then(function (response) {
                console.log(response.data);
                if(response.data.msg==='yes') {
                    $("#location_id").val(response.data.id);
                    $(".extra-large").html($("#postcode-text").val());
                    $(".edit-location").hide();
                    $(".location-selected").show();
                    $(".all-panels").show();
                    var category =  $("#category").val();
                    get_prices(category);
                }
                else{
                    $("#location-error-info").show();
                 console.log("no");
                }

            })
            .catch(function (error) {
                console.log(error);
            });
    }
    $(".postcode-submit").click(function () {
       var postcode = $("#postcode-text").val();
       get_location(postcode);
    });
    $(".row-images").on('click','.cross-mark',function () {
        $(this).parent().remove();
    });
    $(function() {
        var isDragging = false;
        $("a")
            .mousedown(function() {
                isDragging = false;
            })
            .mousemove(function() {
                isDragging = true;
            })
            .mouseup(function() {
                var wasDragging = isDragging;
                isDragging = false;
                if (!wasDragging) {
                    $("#throbble").toggle();
                }
            });

        $("ul").sortable();
    });
    axios.get('/user/list/price')
        .then(function (response) {
            console.log(response);
        })
        .catch(function (error) {
            console.log(error);
        });
    $(document).on('change',".extra-change", function(){

        var total = 0;
        var featured = 0;
        var urgent = 0;
        var shipping = 0;
        var spotlight = 0;
        var featured_type = 'featured_3';
        var shipping_type = '1';
        if ($('#featured').is(":checked"))
        {
            featured = 1;
            featured_type = $("#featured_type").val();
        }
        if ($('#urgent').is(":checked"))
        {
            urgent=1;
        }
        if ($('#spotlight').is(":checked"))
        {
            spotlight = 1;

        }
        if ($('#shipping').is(":checked"))
        {
            shipping=1;
            shipping_type=$("#shipping_type").val();
        }
        var category = $("#category").val();
        var id = $("#location_id").val();

        axios.get('/category/total/'+category,{ params:{id:id,shipping:shipping,featured:featured,spotlight:spotlight,urgent:urgent,featured_type:featured_type,shipping_type:shipping_type}})
            .then(function (response) {
            console.log(response.data);
                $(".total-price").html(response.data.total);


            })
            .catch(function (error) {
                console.log(error);
            });
        var id = $("#id").val();
        axios.get('/product/total',{ params:{id:id,shipping:shipping,featured:featured,spotlight:spotlight,urgent:urgent,featured_type:featured_type,shipping_type:shipping_type}})
            .then(function (response) {
                console.log(response.data);
                $(".total-price").html(response.data.total);


            })
            .catch(function (error) {
                console.log(error);
            });
      //  $("#total-price").val(total);

    });
    $(document).on('change',".address-select",function () {
        var id = $('input[name=address]:checked', '#addressform').val();
        console.log($('input[name=address]:checked', '#addressform').val());
        axios.get('/user/address/change/'+id)
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
    });
    $(".update-shipping").click(function () {
       var id = $(this).data('id');
       console.log(id);
       $("#tracking-info").modal('show');
        $(".update-tracking").data('id',id);
    });
    $(".update-tracking").click(function () {
        var id = $(this).data('id');
        var tracking = $("#tracking_id").val();
        console.log(id);
        axios.get('/user/manage/order/shipping/update/'+id,{ params:{tracking:tracking}})
            .then(function (response) {
                console.log(response);
                location.reload();
            })
            .catch(function (error) {
                console.log(error);
            });
    });
    var current = 1;
    var max = @if(isset($product['images'])){{count($product['images'])}} @else 1 @endif ;
    $(".image-gallery-right").click(function () {
        if(current==max){
            return;
        }
        var width = $(".image-gallery-li").outerWidth();
        console.log(width);
        $("ul.image-gallery-ul").animate({
            marginLeft: (-1*current*width)+'px'
        });
        current++;
    });
    $(".image-gallery-left").click(function () {
        if(current<2){
            return
        }
        var width = $(".image-gallery-li").outerWidth();
        console.log(width);
        $("ul.image-gallery-ul").animate({
            marginLeft: (-1*(current-2)*width)+'px'
        });
        current--;
    });
    $(window).scroll(function(){
        var aTop = $('.ad').height();
        if($(this).scrollTop()>=aTop){
          //  alert('header just passed.');
            // instead of alert you can use to show your ad
            // something like $('#footAd').slideup();
        }
    });
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

</script>
@if (!Auth::guest())
    <script>
        var token = '{{Auth::user()->access_token}}' ;
        var notifications = '{{Auth::user()->notifications}}';

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
                    if(notifications=='1'){
                        document.getElementById('notify-tune').play();

                    }
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