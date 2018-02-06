<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.home')

@section('title', $product['title'] . ' | '. env('APP_NAME'))

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<link href="{{ asset('/css/jobs.css?q=874') }}" rel="stylesheet">
<script src="/js/imageviewer.min.js"></script>
<script src="/js/carousel.js"></script>
<div class="background-body">
    <div class="container">
        
    </div>
    <div class="job-container-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-sm-3 col-xs-6 back">
                    <a class="" href="/{{$category->slug}}">< Back to search</a>
                </div>
                <div class="col-md-8 col-sm-6 hidden-xs">
                    <ol class="breadcrumb">
                        @foreach($parents as $parent)
                        <li class="breadcrumb-item"><a href="/{{$parent->slug}}">{{$parent->title}}</a></li>
                        @endforeach
                        <li class="breadcrumb-item"><a href="/{{$category->slug}}">{{$category->title}}</a></li>
                    </ol>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-6 prev-next">
                    @if(isset($prevAdvert))
                        <a href="/p/{{$category->id}}/{{$prevAdvert->id}}"> < Prev</a>
                    @endif
                    @if(isset($nextAdvert))
                        <a href="/p/{{$category->id}}/{{$nextAdvert->id}}"> Next > </a>
                    @endif
                </div>
            </div>
            <div class="row hidden-xs">
                <div class="col-xs-12">
                    <div class="bg-image" id="bg-image">
                        <h1>{{$product['title']}}</h1>
                        <div class="cta text-center">
                            <a class="btn btn-success">
                                Apply Now
                                <i class="fa fa-long-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-12">
                    <div class="buttons-border">
                        <a href="/jobs" class="btn">All Lastest Jobs</a>
                        <a href="/jobs/uk?job_contract_type=permanent" class="btn">Permanent</a>
                        <a href="/jobs/uk?hours=term-time" class="btn">Temporary</a>
                        <a href="/jobs/uk?hours=weekends" class="btn">Weekend</a>
                        <a class="btn">Search Recruiters</a>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="buttons-border last">
                        <a href="/jobs/uk?hours=part-time" class="btn">Part Time</a>
                        <a class="btn">Work Wanted</a>
                        <a class="btn">Daily Work</a>
                        <a class="btn">Gig Work</a>
                        <a href="/jobs/uk?job_contract_type=freelance" class="btn">Freelancers</a>
                    </div>
                </div>
                -->
            </div>
        </div>
    </div>
    <div class="container">
    <!-- <div class="row">
        <div class="col-md-12">
            <div class="alerts">
                <p>Set your jobs search alerts, click below to:</p>
                <div class="buttons-alerts">
                    <span>Get Job Alerts:</span>
                    <a class="btn">Email Alert</a>
                    <a href="/download-mobile-apps/" class="btn">Mobile Alert</a>
                </div>
            </div>
        </div>
    </div> -->
    <div class="row top-space">
        <div class="col-md-8 col-sm-12">
            <!-- <h2 class="item-name">{{$product['title']}}</h2>
            <div class="col-sm-9 location-name">
                <p>{{$product['location_name']}}</p>
            </div>
            <div class="col-sm-3">
                @if($product['meta']['price']>=0)
                <div class="items-box-price font-5">£ {{number_format($product['meta']['price'] / 100, 0, '.', ',')}}{{isset($product['meta']['price_frequency']) ? $product['meta']['price_frequency']:''}}</div>
                @endif
            </div> -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="job-side-section sidebar-content">
                <div class="metadata-location">
                    <h3 class="hidden-xs">About This Job</h3>
                    <div class="metadata metadata-list">
                        <h4 class="metadata-list-header">Location</h4>
                        <ul class="metadata-list-items">
                            <li>
                                <a href="/jobs/{{$product['location_name']}}">{{$product['location_name']}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="hidden-xs hidden-sm">
                <div class="job-side-section sidebar-content">
                    <h3>Get Alerts</h3>
                    <ul class="useful-links">
                        <li>
                            <a href="/user/create/alert/{{$category->id}}?id=0">
                                <i class="fa fa-chevron-left"></i>
                                Email Alert
                            </a>
                        </li>
                        <li>
                            <a href="/download-mobile-apps/">
                                <i class="fa fa-chevron-left"></i>
                                Mobile Alert
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hidden-xs hidden-sm">
                <div class="job-side-section sidebar-content">
                    <h3>Usefull Links</h3>
                    <ul class="useful-links">
                        <li>
                            <a href="/{{$category->slug}}">
                                <i class="fa fa-chevron-left"></i>
                                Back to All Jobs
                            </a>
                        </li>
                        <li>
                            <a href="/jobs">
                                <i class="fa fa-chevron-left"></i>
                                See All Lastest Jobs
                            </a>
                        </li>
                        @if(isset($advert->user))
                        <li>
                            <a href="/userads/{{$advert->user->id}}">
                                <i class="fa fa-chevron-left"></i>
                                @if(isset($advert->user->business))
                                See all {{$advert->user->business->name}} Jobs
                                @else
                                See all {{$advert->user->name}} Jobs
                                @endif
                            </a>
                        </li>
                        @endif
                        <li>
                            <a href="/jobs/{{$product['location_name']}}">
                                <i class="fa fa-chevron-left"></i>
                                See all {{$product['location_name']}} Jobs
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-sm-8 col-xs-12">
                @if(count($product['images']) > 0)
                <div id="current-image">
                    <img id="image-active" data-index="1" src="{{env('AWS_WEB_IMAGE_URL')}}/{{$image}}?1500586448" alt="Los Angeles" data-high-res-src="{{env('AWS_WEB_IMAGE_URL')}}/{{$image}}?1500586448" class="gallery-items">
                    <div class="images-info">
                        <div class="col-sm-4 start-animation">
                            <a href="javascript:void(0)" class="icon-before">Start slideshow</a>
                        </div>
                        <div class="col-sm-4 col-xs-12 images-nav">
                            <p><span class="prev"> <a href="javascript:void(0)"><span class="glyphicon glyphicon-chevron-left"></span></a></span>
                                <span class="index">1</span> of {{count($product['images'])}}
                                <span class="next"><a href="javascript:void(0)"><span class="glyphicon glyphicon-chevron-right"></span></a></span>
                            </p>
                        </div>
                        <div class="col-sm-4 images-current">
                            <a href="#"><p><span class="glyphicon glyphicon-zoom-in"></span>Enlarge</p></a>
                        </div>
                    </div>
                </div>
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators 
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                       @foreach($counts as $number)
                            <li data-target="#myCarousel" data-slide-to="{{$number}}"></li>
                        @endforeach
                    </ol> -->

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        @for($i=0; $i< count($product['images']); $i++)
                        <div class="item">
                            @for($j=0; $j < 5 && ($i+$j) < count($product['images']); $j++)
                            <div class="small-image">
                                <a href="javascript:void(0)" data-index="{{$i+$j+1}}">
                                    <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$product['images'][$i+$j]}}?1500586448" alt="Los Angeles">
                                </a>
                            </div>
                            @endfor
                            @php
                                $i = $i + $j - 1
                            @endphp
                        </div>
                        @endfor
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    <div class="request-details">
                        <a href="/download-mobile-apps/" class="btn btn-default">Call</a>
                        <a href="/user/reply/{{$product['source_id']}}" class="btn btn-default">Send Message</a>
                        
                        <a href="/download-mobile-apps/" class="btn btn-default">VideoCall</a>
                    </div>
                </div>
                @endif
                <div class="">
                    <div id="tabs">
                    <ul class="nav nav-tabs hidden-xs">
                        <li class="active"><a data-toggle="tab" href="#tab-description">Description</a></li>
                        <li><a data-toggle="tab" href="#tab-map">Map & Street View</a></li>
                        <li><a data-toggle="tab" href="#tab-apply">Apply</a></li>
                    </ul>
                    <ul class="nav nav-pills nav-stacked visible-xs">
                      <li class="active"><a data-toggle="pill" href="#tab-description">Description</a></li>
                      @if(count($product['images']) > 0)
                        <li><a data-toggle="pill" href="#tab-map">Map & Street View</a></li>
                      @endif
                      <li><a data-toggle="pill" href="#tab-apply">Apply</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-description" class="tab-pane fade in active">
                            <div class="row">
                                <div class="job-details">
                                    <div class="col-sm-12 left-content">
                                        <h3>Job information:</h3>
                                        <div class="row meta">
                                            @foreach($metas as $meta)
                                                <div class="col-sm-6 meta-bold">
                                                    {{$meta->title}}:
                                                </div>
                                                <div class="col-sm-6 meta-info">
                                                    {{$meta->value}}
                                                </div>
                                            @endforeach
                                                <div class="col-sm-6 meta-bold">
                                                    Added on {{env('APP_NAME')}}:
                                                </div>
                                                <div class="col-sm-6 meta-info">
                                                    {{$advert->created_at->format('d F Y')}}
                                                </div>
                                                <!-- <div class="col-sm-6 meta-bold">
                                                    Payments:
                                                </div>
                                                <div class="col-sm-6 meta-info">
                                                    <a href="#"> <img class="payments-methods" src="/css/payments.png"></a>
                                                </div> -->
                                        </div>
                                        <div class="description">
                                            <h3>Full Description</h3>
                                            {!! $product['description'] !!}
                                        </div>
                                        <!--- @if(count($product['images']) == 0)
                                        <div class="col-md-12 col-sm-12 bottom-buttons">
                                            <a class="btn">Save</a>
                                            <a class="btn">Call</a>
                                            <a class="btn">VideoCall</a>
                                            <a class="btn">Email</a>
                                        </div>
                                        @endif -->
                                    </div>  
                                </div>
                            </div>
                        </div>
                        <div id="tab-map" class="tab-pane fade">
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
                                        <div>
                                            <h4>Nearest stations</h4>
                                            <ul class="stations-list">

                                            </ul>
                                            <small>
                                                Distances are straight line measurements from centre of postcode
                                            </small>
                                        </div>
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
                                        var uluru = {lat: {!! $lat !!}, lng: {!! $lng !!}};
                                         map = new google.maps.Map(document.getElementById('map'), {
                                            zoom: 18,
                                            center: uluru
                                        });
                                        var marker = new google.maps.Marker({
                                            position: uluru,
                                            map: map
                                        });
                                        var pos = new google.maps.LatLng(uluru.lat, uluru.lng);
                                        getTransport({!! $lat !!},{!! $lng !!});
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
                        <div id="tab-apply" class="tab-pane fade">
                            <!-- Apply -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12 border-bottom">
                                    <div class="jobs-apply">
                                        <h2>Apply for {{$product['title']}}</h2>
                                    </div>
                                </div>
                                @if (Auth::guest())
                                <div class="col-md-12 col-sm-12">
                                    <div class="jobs-apply">
                                        <span>Alredy uploaded your CV? <a href="/user/redirect/{{$advert->id}}">Sign in</a> to apply instantly</span>
                                    </div>
                                </div>
                                @else
                                @if(Auth::user()->has_applied($advert->id))
                                <div class="col-sm-12">
                                    <div class="jobs-applied">
                                        <span class="h3">
                                            You have already applied
                                        </span>
                                    </div>
                                </div>
                                @else
                                <div class="col-md-12 col-sm-12 background-color">
                                    <form action="/user/jobs/apply" method="post">
                                    <input name="redirect" type="hidden" value="{{$advert->url()}}">
                                    <input name="id" type="hidden" value="{{$advert->id}}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        @if (Auth::guest())
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="field">
                                                    <label for="first-name">
                                                        First name
                                                        <span class="field-indicator-required">
                                                            <i data-icon="*" class="icon-required"></i>
                                                        </span>
                                                    </label>
                                                    <input type="text" name="first-name" id="first-name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="field">
                                                    <label for="last-name">
                                                        Last name
                                                        <span class="field-indicator-required">
                                                            <i data-icon="*" class="icon-required"></i>
                                                        </span>
                                                    </label>
                                                    <input type="text" name="last-name" id="last-name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="field">
                                                    <label for="email">
                                                        Email address
                                                        <span class="field-indicator-required">
                                                            <i data-icon="*" class="icon-required"></i>
                                                        </span>
                                                    </label>
                                                    <input type="text" name="email" id="email" required>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                        @elseif(count(Auth::user()->cvs)>0)
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="field">
                                                    <label for="selected-cv" class="h3">
                                                        Select a CV
                                                    </label>
                                                    <select class="form-control" name="cv" required id="selected-cv">
                                                        <option value="0">Select</option>
                                                        @foreach(Auth::user()->cvs as $cv)
                                                            <option value="{{$cv->id}}">{{$cv->title}}</option>
                                                        @endforeach
                                                    </select> 
                                                </div>     
                                            </div>
                                        </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="field">
                                                    <label for="upload-cv" class="h3">
                                                        Upload your CV
                                                    </label>
                                                    <div class="upload-container">
                                                        <p>Upload from cumputer or mobile phone</p>
                                                        <div class="icon-before">
                                                            <input type="hidden" id="title" value="{{$advert->category->title}}">
                                                            <input type="hidden" id="category" value="{{$advert->category_id}}">
                                                            <input type="file" name="upload-cv" id="upload-cv">
                                                        </div>
                                                        <p>Or upload from one of the following</p>
                                                        <div class="buttons-cloud">
                                                            <a href="#" class="btn btn-form btn-dropbox">Dropbox</a>
                                                            <a href="#" class="btn btn-form btn-onedrive">OneDrive</a>
                                                            <a href="#" class="btn btn-form btn-googledrive">Google Drive</a>
                                                        </div>
                                                    </div>
                                                    <p><small>Your CV must be a .doc, .pdf, rtf, and no bigger than 1MB</small></p>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="field">
                                                    <span class="h3">Cover message or cover letter for {{$product['title']}}</span>
                                                    <div class="cover-letter-container">
                                                        <p>Choose from:</p>
                                                        <div class="buttons-option-cover">
                                                            <a href="" class="btn btn-form btn-profile">Profile</a>
                                                            <a href="" class="btn btn-form btn-saved">Saved cover letter</a>
                                                            <a href="" class="btn btn-form btn-new">Write new</a>
                                                        </div>
                                                        <div class="cover-write">
                                                            <label for="cover-message"> 
                                                                Your covering message
                                                            </label>
                                                            <textarea id="cover-message" name="ctext" placeholder="Write your application covering message here or copy and paste from a document."> 
                                                            </textarea>
                                                            <p class="small text-right">4000 characters left</p>
                                                             <input type="hidden" name="ctitle" value="{{$advert->category->title}}">
                                                             <input type="hidden" name="ccategory" value="{{$advert->category->id}}">
                                                        </div>
                                                        @if(!Auth::guest() && count(Auth::user()->covers)>0)
                                                        <div class="cover-select">
                                                            <label for="cover">Select a Cover Letter</label>
                                                            <select class="form-control" name="cover" id="cover" required>
                                                                <option value="0">Select</option>
                                                                @foreach(Auth::user()->covers as $cover)
                                                                    <option value="{{$cover->id}}">{{$cover->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="field">
                                                     <div class="checkbox">
                                                          <input type="checkbox" name="email-me" id="email-me" value="true" checked="checked">
                                                          <label for="email-me">Email me jobs like this one when they become available</label>  
                                                     </div>
                                                </div>
                                                <p>
                                                    <small>
                                                        By applying for a job listed on {{ env('APP_NAME')  }} Jobs you agree to our <a href="#">terms and conditions</a> and <a href="#">privacy policy</a>. You should never be to provide bank account details. If you are, please <a href="#">email us</a>.
                                                    </small>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="field button-submit">
                                                     <input class="btn-form" type="submit" name="submit-cv" id="submit-cv" value="Send application">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>
                                @endif
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                @if(count($product['images']) == 0)
                <div class="col-md-12 col-sm-12 bottom-buttons">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <a class="btn btn-default">Save</a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="/download-mobile-apps/" class="btn btn-default">Call</a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="/download-mobile-apps/" class="btn btn-default">VideoCall</a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="/download-mobile-apps/" class="btn btn-default">Email</a>
                        </div>
                    </div>
                </div>
                @endif
                <div class="col-md-12 safe-jobs">
                    <p>
                        <small>Remember: You should never send cash or cheques to a prospective employer, or provide your bank details or any other financial information. We pay great attention to vetting all jobs that appear on our site, but please get in touch if you see any roles asking for such payments or financial details from you.</small>
                    </p>
                </div>
                <div class="col-sm-12">
                    <div class="hidden-xs hidden-sm">
                        <div class="job-side-section sidebar-content">
                            <h3>Get Alerts</h3>
                            <ul class="useful-links">
                                <li>
                                    <a href="/user/create/alert/{{$category->id}}?id=0">
                                        <i class="fa fa-chevron-left"></i>
                                        Email Alert
                                    </a>
                                </li>
                                <li>
                                    <a href="/download-mobile-apps/">
                                        <i class="fa fa-chevron-left"></i>
                                        Mobile Alert
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="hidden-xs hidden-sm">
                        <div class="job-side-section sidebar-content">
                            <h3>Usefull Links</h3>
                            <ul class="useful-links">
                                <li>
                                    <a href="/{{$category->slug}}">
                                        <i class="fa fa-chevron-left"></i>
                                        Back to All Jobs
                                    </a>
                                </li>
                                <li>
                                    <a href="/jobs">
                                        <i class="fa fa-chevron-left"></i>
                                        See All Lastest Jobs
                                    </a>
                                </li>
                                @if(isset($advert->user))
                                <li>
                                    <a href="/userads/{{$advert->user->id}}">
                                        <i class="fa fa-chevron-left"></i>
                                        @if(isset($advert->user->business))
                                        See all {{$advert->user->business->name}} Jobs
                                        @else
                                        See all {{$advert->user->name}} Jobs
                                        @endif
                                    </a>
                                </li>
                                @endif
                                <li>
                                    <a href="/jobs/{{$product['location_name']}}">
                                        <i class="fa fa-chevron-left"></i>
                                        See all {{$product['location_name']}} Jobs
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-md-3 col-sm-4 col-sm-12">
            <!-- search -->
            <div class="row">
                @if($advert->user!==null)
                <div class="col-md-12">
                    <div class="buttons">
                        <div class="details">
                            <h3>This Advert is by</h3>
                            
                            <div class="profile-picutre">
                                @if(isset($advert->user->business))
                                    <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$advert->user->business->logo}}">
                                @else
                                    <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$advert->user->image}}">
                                @endif
                            </div>
                            <div class="user-details">
                                <p>
                                    @if(isset($advert->user->business))
                                    <strong>{{$advert->user->business->name}}</strong>
                                    @else
                                    <strong>{{$advert->user->name}}</strong>
                                    @endif
                                </p>
                                <address>
                                @if(isset($advert->user->address))
                                {{$advert->user->address->line1}}, {{$advert->user->address->city}}, {{$advert->user->address->postcode}}  
                                @endif    
                                </address>
                                @if(isset($advert->user->business))
                                <p class="link-about"><a class="btn btn-advertiser" href="/company/{{$advert->user->id}}">Learn more about the Advertiser</a></p>
                                @endif
                                <p><a class="advert-user" href="/userads/{{$advert->user->id}}">View other adverts from this Advertiser</a></p>
                            </div>
                        </div>
                         <div class="contact">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <span class="@if(!Auth::guest()&&Auth::user()->is_favorite($advert->id)) heart @else heart-empty @endif favroite-icon" data-id="{{$advert->id}}"></span>Save job
                                </li>
                                <li class="list-group-item">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                    Add notes
                                </li>
                                <li class="list-group-item">
                                    <span class="glyphicon glyphicon-print"></span>
                                    Print
                                </li>
                                <li class="list-group-item">
                                    <span class="email-icon"><img src="/css/icons/email.svg"></span>

                                    Email to friend
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @else
                    <ul class="list-group">
                        <li class="list-group-item"><h4>{{$product['username']}}</h4></li>
                    </ul>
                @endif
            </div>
            <div class="row">
                 <div class="col-sm-12">
                    <div class="share border-bottom-dashed">
                        <h3>Share this job</h3>
                        <div class=" media">
                            <div class="center-block"><a href=""><img class="img-responsive" src="/css/icons/facebook.svg"></a></div>
                            <div class="center-block"><a href=""><img class="img-responsive" src="/css/icons/twitter.svg"></a></div>
                            <div class="center-block"><a href=""><img class="img-responsive" src="/css/icons/instagram.png"></a></div>
                            <div class="center-block"><a href=""><img class="img-responsive" src="/css/icons/pinterest.svg"></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="report border-bottom-dashed">
                        <h3>Report this Ad</h3>
                        <a href="#" class="btn btn-default">Report</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="similar-adverts">
                        <h3>Similar Jobs</h3>
                        <div class="listings-adverts">
                        @foreach($products as $p)
                        <a class="border-bottom-dashed" href="/p/{{$category->id}}/{{$product['source_id']}}">
                            <div class="col-sm-12">
                                <div class="advert-details">
                                    <h4>{{$p['title']}}</h4>
                                    <p>{{$p['location_name']}}</p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="similar-adverts">
                        <h3>Recommended Course</h3>
                        <div class="listings-adverts">
                        <a class="border-bottom-dashed" href="#">
                            <div class="col-sm-12">
                                <div class="advert-details">
                                    <h4>Diploma of Childcare (Nanny)</h4>
                                    <p>Online, self-paced</p>
                                    <p>Enquire now for pricing information</p>
                                </div>
                            </div>
                        </a>
                        <a href="#">
                            <div class="col-sm-12">
                                <div class="advert-details">
                                    <h4>Certificate in Childcare & Nannyng Training - Accredited by CPD</h4>
                                    <p>Online, self-paced</p>
                                    <p>£29.00</p>
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
    $('a[href="#tab-map"]').on('shown.bs.tab', function () {
        x = map.getZoom();
        c = map.getCenter();
        google.maps.event.trigger(map, 'resize');
        google.maps.event.trigger(panorama, 'resize');
        map.setZoom(x);
        map.setCenter(c);
    });
    $("#check-button").click(function () {
        var id =$('#id').val();
        var postcode=$('#postcode').val();
        axios.get('/user/p/deliver/'+id, {
            params: {postcode: postcode}
        })
            .then(function (response) {
                console.log(response);
                if(response.data.can){
                    $('#delivery-info').show();
                    $('#postcode-text').html(postcode);
                    $('#check-div').hide();
                    $('#s-info').hide();
                }else{
                    $('#sorry-info').show();
                }

            })
            .catch(function (error) {
                console.log(error);

            });
    });
    $('#edit-post').click(function () {
        $('#check-div').show();
        $('#delivery-info').hide();
    });
    $('#upload-cv').change(function () {
        upload_cv();
    });
    $('.btn.btn-new').click(function(e){
        e.preventDefault();
        $('.active-cover').removeClass('active-cover');
        $('.cover-write').addClass('active-cover');
    });
    $('.btn.btn-saved').click(function(e){
        e.preventDefault();
        $('.active-cover').removeClass('active-cover');
        $('.cover-select').addClass('active-cover');
    })
    $('input[type=radio][name=options]').change(function(){
        if(this.id == "option-view"){
            console.log("change to panorama");
            $('.info-map').hide();
            $('.info-pano').show();
            google.maps.event.trigger(panorama, 'resize');
        }
        else{
           console.log("change to map");
            $('.info-map').show();
            $('.info-pano').hide(); 
        }
        
    });
    function isUnderground(types){
        return types.indexOf('tube') != -1;
    }
    function isRail(types){
        for (var i = 0; i < types.length; i++) {
            if(types[i].modeName == "national-rail" || types[i].modeName == "tflrail")
                return true;
        }
        return false;
    }
    function isOverground(types){
        return types.indexOf('overground') != -1;
    }
    function isBus(types){
        return types.indexOf('bus') != -1;
    }
    function isDlr(types){
        return types.indexOf('dlr') != -1;
    }
    function getStationHtml(dict){
        var textHtml = "";
        for(key in dict){
            textHtml += dict[key] + "\n";
        }
        return textHtml;
    }
    function processStops(stops){
        var aux;
        var stations = [];
        var distance;
        console.log(stops);
        for(i = 0; i < stops.length; i++){
            aux = "";
            if(isRail(stops[i].lineModeGroups)){
                aux += "<i class=\"icon-transport icon-rail\"></i>";
            }
            if(isUnderground(stops[i].modes)){
                aux +="<i class=\"icon-transport icon-underground\"></i>";
            }
            if(isOverground(stops[i].modes)){
                aux +="<i class=\"icon-transport icon-overground\"></i>";
            }
            if(isDlr(stops[i].modes)){
                aux +="<i class=\"icon-transport icon-dlr\"></i>";
            }
            if(isBus(stops[i].modes)){
                aux +="<i class=\"icon-transport icon-bus\"></i>";
            }
            distance = parseFloat(stops[i].distance / 1600).toFixed(2);
            aux = "<li>" + aux + "<span>" + stops[i].commonName + " <small>(" + distance + " mi)</small></span></li>";
            var length;
            if(typeof(stations[stops[i].commonName]) != "undefined"){
                length = stations[stops[i].commonName].length
                if(aux.length > length){
                    stations[stops[i].commonName] = aux;
                }
            }
            else
                stations[stops[i].commonName] = aux;
        }
        var stationsList = getStationHtml(stations);
        $('.stations-list').html(stationsList);
    }
    function getTransport(lat, lng) {
    // See Parsing the Results for
    // the basics of a callback function.
        $.ajax({
            url: "https://api.tfl.gov.uk/Place?type=NaptanMetroStation,NaptanRailStation&lat=" + lat + "&lon=" + lng + "&categories=Description&radius=1500&app_id=2d80416f&app_key=31f4c6d3a317c8de56f699bb3aff9af2",
            dataType: "json",
            type: "GET",
        }).done(function(data, textStatus){
            var places = data.places;
            processStops(places);
        }).fail(function( jqXHR, textStatus, errorThrown ) {
            if ( console && console.log ) {
                console.log( "Error get stations: " +  textStatus);
            }
        });
    }
</script>



@endsection
