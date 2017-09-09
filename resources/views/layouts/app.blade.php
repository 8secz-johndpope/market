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
    <link href="{{ asset('/css/base.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/extra.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">

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
        img.lazyload{
            width: 100%;
        }
        body {
           /* font: 1em/1.67 'Open Sans', Arial, Sans-serif; */
            margin: 0;
            background: #e9e9e9;
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
    <div class="top hidden-xs">
        <div class="row">
            <div class="col">
                <img class="icon" src="/css/sumra-text.png">
            </div>
        </div>
    </div>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><img class="icon" src="/css/ic_launcher1.png"></a>
                <div class="col-2 col-md-8 col-lg-5 pull-right hidden-xs hidden-sm">
                    <div class="center-block">
                        <img class="img-responsive" src="/css/googleplayx233.png">
                    </div>
                    <div class="center-block">
                        <img class="img-responsive" src="/css/appstorex233.png">
                    </div>
                    <div class="center-block">
                        <img class="img-responsive" src="/css/windowsx233.png">
                    </div>
                </div>
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
                    <li><a class="btn btn-info bussines" role="button" href="#">Sumra for Business</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
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
                <img id="footer_top_logo" class="img-responsive" title="" alt="" src="/css/sumra-text.png">
            </div>

            <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-2">
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
            <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-0">
                <div class="col">
                    <h4>Discover</h4>
                    <ul>
                        <li><a href="/why-us" title="Why Us">Why Us</a></li>
                        <li><a href="/our-programs" title="Our programmes">Our academic programmes</a></li>
                        <li><a href="/our-teaching-methods" title="Our teaching methods">Our teaching methods</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-0">
                <div class="col">
                    <h4>Experience</h4>
                    <ul>
                        <li><a href="/growth" title="Growth">Growth</a></li>
                        <li><a href="/responsibility" title="Responsibility">Responsibility</a></li>
                        <li><a href="/security" title="Security">Security</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-0">
                <div class="col">
                    <h4>Resources</h4>
                    <ul>
                        <li><a href="/faq" title="F.A.Q.">F.A.Q.</a></li>
                        <li><a href="/help" title="Help">Help</a></li>
                        <li><a href="/how-it-works" title="How it works">How it works</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-2">
                <div class="col">
                    <h4>Commitment</h4>
                    <ul>
                        <li><a href="/privacy-policy" title="Privacy policy">Privacy policy</a></li>
                        <li><a href="/cookies-policy" title="Cookies policy">Cookies policy</a></li>
                        <li><a href="/terms-of-use" title="Terms of Use">Terms of Use</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-0">
                <div class="col">
                    <h4>Partnerships</h4>
                    <ul>
                        <li><a href="/corporate-partners" title="Corporate partners">Corporate partners</a></li>
                        <li><a href="/education-partners" title="Education partners">Education partners</a></li>
                        <li><a href="/brand-partners" title="Brand partners">Brand partners</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-0">
                <div class="col">
                    <h4>Press & Opportunities</h4>
                    <ul>
                        <li><a href="/careers" title="Careers">Careers</a></li>
                        <li><a href="/press" title="Press">Press</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-0">
                <div class="col">
                    <img  class="img-responsive  footer_logo" src="/css/ic_launcher1.png" />
                </div>
            </div>
        </div>
    </div>
</footer>
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
            lat.value=place.geometry.location.lat();
            lng.value=place.geometry.location.lng();

        });
        initMap();
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWhXNJ7VlpNA64oFdUU4pmq3YLZC6Xqd4&libraries=places&callback=initAutocomplete"
        async defer></script>
<script src="https://sumra.net/js/jquery.autocomplete.js"></script>
<script src="https://sumra.net/js/aws-sdk.js"></script>
<script src="https://sumra.net/js/load.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>


<script>
    window.axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
    };
    $('#autocomplete').autocomplete({
        paramName :'q',
        serviceUrl: '/api/suggest',
        onSelect: function (suggestion) {
            window.location.href = "https://sumra.net/"+suggestion.slug+"?q="+suggestion.value
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
        get_extras($(this).data('category'));
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

        $.get("/category/prices/"+category, function(data, status){
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
        get_extras($(this).data('category'));
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
       $(".extra-large").html($("#postcode-text").val());
       $(".edit-location").hide();
       $(".location-selected").show();
       $(".all-panels").show();
    });
    $(".edit-location-button").click(function () {
        $(".edit-location").show();
        $(".location-selected").hide();
    });
    $(".add-image").click(function () {
        $("#file-chooser").click();
    });
    $("#file-chooser").change(function () {
        console.log("did change");
        upload_file();
    });
    function get_location(postcode) {
        $.get("https://maps.googleapis.com/maps/api/geocode/json?address="+postcode+"&key=AIzaSyDsy5_jVhfZJ7zpDlSkGYs9xdo2yFJFpQ0",function (data,status) {
            console.log(data.results[0]['formatted_address']);
            console.log(data.results[0]['geometry']['location']['lat']);
            console.log(data.results[0]['geometry']['location']['lng']);
            var address = data.results[0]['formatted_address'];
            var parts =  address.split(',');
            $("#location_name").val(parts[0]);
            $("#lat").val(data.results[0]['geometry']['location']['lat']);
            $("#lng").val(data.results[0]['geometry']['location']['lng']);

        });
    }
    $(".postcode-submit").click(function () {
       var postcode = $("#postcode-text").val();
       get_location(postcode);
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
        if ($('#featured').is(":checked"))
        {
            total += parseInt($("#featured-price").val());
        }
        if ($('#urgent').is(":checked"))
        {
            total += parseInt($("#urgent-price").val());
        }
        if ($('#spotlight').is(":checked"))
        {
            total += parseInt($("#spotlight-price").val());
        }
        if ($('#shipping').is(":checked"))
        {
            total += parseInt($("#shipping-price").val());
        }
        $(".total-price").html(total);
        $("#total-price").val(total);

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
</script>
</body>
</html>