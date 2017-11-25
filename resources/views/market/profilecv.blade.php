<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Josh E. |' . env('APP_NAME'))

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <link href="{{ asset('/css/profile.css?q=874') }}" rel="stylesheet">
<div class="background-body">
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-xs-12">
            <div class="row">
                <div class="profile-background">
                    <div class="profile-background-container">
                        <img src="https://media.licdn.com/media/AAEAAQAAAAAAAArWAAAAJDE4ZTYwOTg3LTI5NTUtNDcwOS05N2E3LWNjNWJkNDRiYTI1OA.jpg">
                    </div>
                </div>
                <div class="profile-header">
                    <div class="top-card">
                        <div class="profile-photo-container">
                            <div class="profile-photo-wrapper">
                                <div class="profile-photo">
                                    <img src="{{env('AWS_WEB_IMAGE_URL')}}/752734721579.jpeg">
                                </div>
                            </div>
                        </div>
                        <div class="top-card-body">
                            <div class="top-card-info">
                                <div class="align-items-center">
                                    <h1>David H.</h1>
                                </div>
                                <h2>Blenheim, New Zealand</h2>
                            </div>
                            <div class="top-card-buttons">
                                <p>Looking for:</p>
                                <ul class="looking-for">
                                    <li>IT</li>
                                    <li>Chef</li>
                                    <li>Driver</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            <!-- div info-content -->
                <div class="col-sm-12">
                    <div id="tabs">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-overview">Overview</a></li>
                            <li><a data-toggle="tab" href="#tab-about">About Me</a></li>
                            <li><a data-toggle="tab" href="#tab-work">Works</a></li>
                            <li><a data-toggle="tab" href="#tab-approval">Approval</a></li>
                            <li><a data-toggle="tab" href="#tab-contact">Contact</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-overview" class="tab-pane fade in active">
                                <ul class="tab-vert">
                                    <li class="tablinks selected">
                                        <a href="#tab-over">
                                            <span class="bullet branded"></span>
                                            Overview
                                        </a>
                                    </li>
                                    <li class="tablinks">
                                        <a href="#tab-location">
                                            <span class="bullet branded"></span>
                                            My Location
                                        </a>
                                    </li>
                                    <li class="tablinks">
                                        <a href="#tab-area">
                                            <span class="bullet branded"></span>
                                            Areas | cover
                                        </a>
                                    </li>
                                    <li class="tablinks">
                                        <a href="#tab-availibity">
                                            <span class="bullet branded"></span>
                                            My Availability
                                        </a>
                                    </li>
                                </ul>
                                <div id="tab-over" class="tabcontent active-tab">
                                   <p>
                                    I specialize in Python but have worked with Lua, PHP, C, JavaScript, and others, in fields from web development to machine learning to systems integration.
                                    <br>I have worked as a software engineer, team lead, and technical director at various points in the past decade and am now fully committed to consulting.<br>
                                    My recent work includes: SaaS & API development in Python, machine learning, systems integration for legacy systems, mobile app and game development, PLC programming with Lua, Twilio, Twitter, Stripe and other API dev, and much more.
                                    <br>
                                    My past work includes being technical lead at an academic social network startup, engaging in a broad array of web development with backends in Python, PHP, and C, providing ecommerce solutions, web interfaces for proprietary hardware, desktop software for OSX and Windows, among others.
                                    <br>
                                    I have experience both working remotely and managing remote workers across several time zones, and have worked with clients from around the globe
                                   </p> 
                                </div>
                                <div id="tab-location" class="tabcontent">
                                    <div class="row">
                                <div class="col-md-12">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-primary active">
                                            <input type="radio" name="options" id="option-map" autocomplete="off" checked> map view
                                        </label>
                                        <label class="btn btn-primary">
                                            <input type="radio" name="options" id="option-view" autocomplete="off">
                                            street view
                                        </label>
                                    </div>
                                    <div class="info-map">
                                        <div id="map"></div>
                                        <small>Note: The pin shows the centre of the property's postcode, and does not pinpoint the exact address</small>
                                        <!-- <div>
                                            <h4>Nearest stations</h4>
                                            <ul class="stations-list">

                                            </ul>
                                            <small>
                                                Distances are straight line measurements from centre of postcode
                                            </small>
                                        </div> -->
                                    </div>
                                    <div class="info-pano">
                                        <div id="pano"></div>
                                        <small>Note: Start exploring the local area from here.</small>
                                    </div>
                                    <script>
                                    var map;
                                    var panorama;
                                    var service;
                                    function initMap() {
                                        var uluru = {lat: 51.529068, lng: -0.215875};
                                         map = new google.maps.Map(document.getElementById('map'), {
                                            zoom: 18,
                                            center: uluru
                                        });
                                        var marker = new google.maps.Marker({
                                            position: uluru,
                                            map: map
                                        });
                                        var pos = new google.maps.LatLng(uluru.lat, uluru.lng);
                                        //getTransport(51.529068,-0.215875);
                                        panorama = new google.maps.StreetViewPanorama(
                                            document.getElementById('pano'), {
                                                position: uluru,
                                                pov: {heading: 165, pitch: 0},
                                                motionTrackingControlOptions: {
                                                position: google.maps.ControlPosition.LEFT_BOTTOM
                                            }
                                        });
                                    }
                                    $(document).ready(function() {
                                        initMap();
                                        activeFirstItem();
                                    });
                                    </script>
                                </div>
                            </div>
                                </div>
                                <div id="tab-area" class="tabcontent">
                                    <p>
                                    I specialize in Python but have worked with Lua, PHP, C, JavaScript, and others, in fields from web development to machine learning to systems integration.
                                    <br>I have worked as a software engineer, team lead, and technical director at various points in the past decade and am now fully committed to consulting.<br>
                                    My recent work includes: SaaS & API development in Python, machine learning, systems integration for legacy systems, mobile app and game development, PLC programming with Lua, Twilio, Twitter, Stripe and other API dev, and much more.
                                    <br>
                                    My past work includes being technical lead at an academic social network startup, engaging in a broad array of web development with backends in Python, PHP, and C, providing ecommerce solutions, web interfaces for proprietary hardware, desktop software for OSX and Windows, among others.
                                    <br>
                                    I have experience both working remotely and managing remote workers across several time zones, and have worked with clients from around the globe
                                   </p> 
                                </div>
                                <div id="tab-availibity" class="tabcontent">
                                    
                                </div>
                            </div>
                            <div id="tab-about" class="tab-pane fade">
                                <ul class="tab-vert">
                                    <li class="tablinks selected">
                                        <a href="#tab-why-me">
                                            <span class="bullet branded"></span>
                                            Why me
                                        </a>
                                    </li>
                                    <li class="tablinks">
                                        <a href="#tab-what-i-do">
                                            <span class="bullet branded"></span>
                                            What i do
                                        </a>
                                    </li>
                                    <li class="tablinks">
                                        <a href="#tab-resume">
                                            <span class="bullet branded"></span>
                                            Resume
                                        </a>
                                    </li>
                                </ul>
                                <div id="tab-why-me" class="tabcontent active-tab">
                                    <p>
                                        Register students for courses, design and manage program software, solve customer problems, enforce department policies, and serve as a contact for students, faculty, and staff.<br>
                                        Hiring, training, scheduling and management of staff, managing supply inventory, and ordering.<br>
                                        Minnesota driver's license with NTSA defensive driving certification.<br>
                                        Extensive experience in collegiate programming and management.<br>
                                        Excellent interpersonal and communication skills.<br>
                                    </p>
                                </div>
                                <div id="tab-what-i-do" class="tabcontent">
                                    
                                </div>
                                <div id="tab-resume" class="tabcontent">
                                    
                                </div>
                            </div>
                            <div id="tab-work" class="tab-pane fade">
                                <ul class="tab-vert">
                                    <li class="tablinks selected">
                                        <a href="#tab-portfolio">
                                            <span class="bullet branded"></span>
                                            Protfolio
                                        </a>
                                    </li>
                                    <li class="tablinks">
                                        <a href="#tab-publications">
                                            <span class="bullet branded"></span>
                                            Publications
                                        </a>
                                    </li>
                                    <li class="tablinks">
                                        <a href="#tab-pictures">
                                            <span class="bullet branded"></span>
                                            Pictures
                                        </a>
                                    </li>
                                </ul>
                                <div id="tab-portfolio" class="tabcontent active-tab">
                                    
                                </div>
                                <div id="tab-publications" class="tabcontent">
                                    
                                </div>
                                <div id="tab-pictures" class="tabcontent">
                                    
                                </div>
                            </div>
                            <div id="tab-approval" class="tab-pane fade">
                                <ul class="tab-vert">
                                     <li class="tablinks selected">
                                        <a href="#tab-verified">
                                            <span class="bullet branded"></span>Verified by Sumra
                                        </a>
                                    </li>
                                    <li class="tablinks">
                                        <a href="#tab-reviews">
                                            <span class="bullet branded"></span>Reviews & Ratings
                                        </a>
                                    </li>
                                    <li class="tablinks">
                                        <a href="#tab-recommendations">
                                            <span class="bullet branded"></span>Recommendations
                                        </a>
                                    </li>
                                </ul>
                                <div id="tab-verified" class="tabcontent active-tab">
                                    
                                </div>
                                <div id="tab-reviews" class="tabcontent">
                                    
                                </div>
                                <div id="tab-recommendations" class="tabcontent">
                                    
                                </div>
                            </div>
                            <div id="tab-contact" class="tab-pane fade">
                                <ul class="tab-vert">
                                    <li class="tablinks selected">
                                        <a href="#tab-contact-me">
                                            <span class="bullet branded"></span>Contact me
                                        </a>
                                    </li>
                                     <li class="tablinks">
                                        <a href="#tab-make-offer">
                                            <span class="bullet branded"></span>Request my application
                                        </a>
                                    </li>
                                    <li class="tablinks">
                                        <a href="#tab-make-offer">
                                            <span class="bullet branded"></span>Charges
                                        </a>
                                    </li>
                                    <li class="tablinks">
                                        <a href="#tab-req-application">
                                            <span class="bullet branded"></span>Make an offer
                                        </a>
                                    </li>
                                </ul>
                                <div id="tab-contact-me" class="tabcontent active-tab">
                                    
                                </div>
                                <div id="tab-make-offer" class="tabcontent">
                                    
                                </div>
                                <div id="tab-req-application" class="tabcontent">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-xs-12">
            <div class="row border-outside">
                <div class="col-sm-12 details-agent title">
                    <h3>Contact and Personal Info</h3>
                </div>
                <div class="col-sm-12 details-agent">
                    <div class="personal-details">
                        <p>
                            David H.
                        </p>
                        <address>
                            Blenheim, New Zealand
                        </address>
                        <p><strong>Tel: </strong>0788998878</p>
                        <a href="#" class="btn btn-default">Email</a>
                    </div>
                </div>
            </div>
            <div class="row border-outside">
                <div class="col-sm-12 details-agent website">
                    <a target="_black" href="#">
                        <h3>Website Link</h3>
                    </a>
                </div>
            </div>
            <div class="row border-outside">
                <div class="col-sm-12 details-agent title">
                    <h3>Availibility</h3>
                </div>
                <div class="col-sm-12 details-agent">
                    <div class="personal-details">
                        <p>
                            Available
                        </p>
                        <p>
                            Less than 30 hrs/week
                        </p>
                        <P>
                            < 24 hour response time
                        </P>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 details-similar">
                    <div class="similar-adverts">
                        <h3>Similar Profile</h3>
                        <div class="listings-profiles">
                            <a class="border-bottom-dashed" href="#">
                                <div class="col-sm-12">
                                    <div class="advert-img">
                                        <img src="{{env('AWS_WEB_IMAGE_URL')}}/260650123898.jpg" class="circle">
                                    </div>
                                    <div class="advert-details">
                                        <h4>Piotr Chursciak</h4>
                                        <p>Psychology student</p>
                                    </div>
                                </div>
                            </a>
                            <a class="border-bottom-dashed" href="#">
                                <div class="col-sm-12">
                                    <div class="advert-img">
                                        <img src="{{env('AWS_WEB_IMAGE_URL')}}/52316802048.jpg" class="circle">
                                    </div>
                                    <div class="advert-details">
                                        <h4>Luis Ernesto Alcantara</h4>
                                        <p>Android Developer</p>
                                    </div>
                                </div>
                            </a>
                            <a class="border-bottom-dashed" href="#">
                                <div class="col-sm-12">
                                    <div class="advert-img">
                                        <img src="{{env('AWS_WEB_IMAGE_URL')}}/66028142415.jpg" class="circle">
                                    </div>
                                    <div class="advert-details">
                                        <h4>Victoriano Montesinos Canovas</h4>
                                        <p>Computer Science Master's Student & Researcher</p>
                                    </div>
                                </div>
                            </a>
                            <a class="border-bottom-dashed" href="#">
                                <div class="col-sm-12">
                                    <div class="advert-img">
                                        <img src="{{env('AWS_WEB_IMAGE_URL')}}/509626763579.jpg" class="circle">
                                    </div>
                                    <div class="advert-details">
                                        <h4>Ignacio Martinez Alpiste</h4>
                                        <p>Researcher at University of the West of Scotland - Computer Engineer</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    function changeCenterMap(){
        x = map.getZoom();
        c = map.getCenter();
        google.maps.event.trigger(map, 'resize');
        map.setZoom(x);
        map.setCenter(c); 
    }
    function changeCenterStreet(){
        x = map.getZoom();
        c = map.getCenter();
        google.maps.event.trigger(panorama, 'resize');
        map.setZoom(x);
        map.setCenter(c); 
    }
    $('.tablinks a').click(function(e){
        e.preventDefault();
        var tab = $(this).attr('href');
        $(this).closest('ul').siblings().removeClass('active-tab');
        $(this).parent().siblings().removeClass('selected');
        $(this).parent().addClass('selected');
        $(tab).addClass('active-tab');
    })
    $('a[href="#tab-location"]').click(function () {
        changeCenterMap();
    });
    $('input[type=radio][name=options]').change(function(){
        if(this.id == "option-view"){
            console.log("change to panorama");
            $('.info-map').hide();
            $('.info-pano').show();
            changeCenterStreet();
        }
        else{
           console.log("change to map");
            $('.info-map').show();
            $('.info-pano').hide();
            changeCenterMap();
        } 
    });
</script>
@endsection