<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.home')

@section('title', $product['title'] . ' | '. env('APP_NAME'))

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<link href="{{ asset('/css/jobs.css?q=874') }}" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <ol class="breadcrumb">
                @foreach($parents as $parent)
                <li class="breadcrumb-item"><a href="/{{$parent->slug}}">{{$parent->title}}</a></li>
                @endforeach
                <li class="breadcrumb-item"><a href="/{{$category->slug}}">{{$category->title}}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-12">
            <!-- search -->
            <div class="row">
                @if($advert->user!==null)
                <div class="col-md-12">
                    <div class="details">
                        <h3>This Advert is marketed by</h3>
                        
                        <div class="profile-picutre">
                            <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$advert->user->image}}">
                        </div>
                        <div class="user-details">
                            <p><strong>{{$advert->user->name}}</strong></p>
                            <address>
                            @if(isset($advert->user->address))
                            {{$advert->user->address->line1}}, {{$advert->user->address->city}}, {{$advert->user->address->postcode}}  
                            @endif    
                            </address>
                            <p class="link-about"><a class="btn btn-default" href="/agent/{{$advert->user->id}}">Learn more about the Advertiser</a></p>
                            <p><a class="advert-user" href="/userads/{{$advert->user->id}}">View other adverts from this Advertiser</a></p>
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
                        <a href="/p/{{$category->id}}/{{$product['source_id']}}">
                            <div class="col-sm-12 border-bottom-dashed">
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
                        <a href="#">
                            <div class="col-sm-12 border-bottom-dashed">
                                <div class="advert-details">
                                    <h4>Diploma of Childcare (Nany)</h4>
                                    <p>Online, self-paced</p>
                                    <p>Enquire now for pricing information</p>
                                </div>
                            </div>
                        </a>
                        <a href="#">
                            <div class="col-sm-12 border-bottom-dashed">
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
        <div class="col-md-9 col-sm-12">
            <div class="row">
                <div class="col-md-12 buttons-filters">
                    <a class="btn">All lastest jobs</a>
                    <a class="btn">Permanent</a>
                    <a class="btn">Tempory</a>
                    <a class="btn">Weekend</a>
                    <a class="btn">Search recruiters</a>
                    <a class="btn">Get job Alerts</a>
                </div>
                <div class="col-md-12 alerts">
                    <p>Set your jobs search alerts, click below to:</p>
                    <div class="buttons-alerts">
                        <a class="btn">Email Alert</a>
                        <a class="btn">Mobile Alert</a>
                    </div>
                </div>
                <div class="col-md-12 border-top-left-right">
                    <div class="company-img center-block">
                        <img src="">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 border-left-right">
                    <div class="job-details">
                        <div class="job-title">
                            <div class="job-criteria">
                                Title
                            </div>
                            <div class="job-detail">
                                <h2 class="item-name">{{$product['title']}}</h2>
                            </div>
                        </div>
                        <div class="job-criteria">
                            Salary/Rate
                        </div>
                        <div class="job-detail">
                            {{isset($metas['salary_rate']) ? $metas['salary_rate']:'£40,000/annum + Benefits'}}
                        </div>
                        <div class="job-criteria">
                            Location
                        </div>
                        <div class="job-detail">
                            {{$product['location_name']}}
                        </div>
                        <div class="job-criteria">
                            Posted
                        </div>
                        <div class="job-detail">
                            {{$advert->created_at->format('d F Y')}}
                        </div>
                        <div class="job-criteria">
                            Company
                        </div>
                        <div class="job-detail">
                        @if($advert->user)
                            {{isset($advert->user->business)? $advert->user->business->name : $advert->user->name}}
                            @endif
                        </div>
                        <div class="job-criteria">
                            Description
                        </div>
                        <div class="job-detail">
                            {!! $product['description'] !!}

                        </div>
                        <div class="job-criteria">
                            Type
                        </div>
                        <div class="job-detail">
                            Permanent
                        </div>
                        <div class="job-criteria">
                            Start Date
                        </div>
                        <div class="job-detail">
                            Immediate
                        </div>
                        <div class="job-criteria">
                            Contract Length
                        </div>
                        <div class="job-detail">
                            N/A
                        </div>
                        <div class="job-criteria">
                            Contact Name
                        </div>
                        <div class="job-detail">
                            Login or register to view
                        </div>
                        <div class="job-criteria">
                            Telephone
                        </div>
                        <div class="job-detail">
                            Login or register to view
                        </div>
                        <div class="job-criteria">
                            Job reference
                        </div>
                        <div class="job-detail">
                            0611FEDLONDON
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 bottom-buttons">
                    <a class="btn">Save</a>
                    <a class="btn">Call</a>
                    <a class="btn">VideoCall</a>
                    <a class="btn">Email</a>
                </div>
                <div class="col-md-12 col-sm-12 border-top">
                    <div class="jobs-apply">
                        <h2>Apply for {{$product['title']}}</h2>
                    </div>
                </div>
                @if (Auth::guest())
                <div class="col-md-12 col-sm-12 border-top-left-right">
                    <div class="jobs-apply">
                       
                        <span>Alredy uploaded your CV? <a href="/user/redirect/{{$advert->id}}">Sign in</a> to apply instantly</span>
                    </div>
                </div>
                @endif
                <div class="col-md-12 col-sm-12 border background-color">
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
                                        <textarea id="cover-message" name="cover-message" placeholder="Write your application covering message here or copy and paste from a document."> 
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
                <div class="col-md-12">
                    <p>
                        <small>Remember: You should never send cash or cheques to a prospective employer, or provide your bank details or any other financial information. We pay great attention to vetting all jobs that appear on our site, but please get in touch if you see any roles asking for such payments or financial details from you. For more information on conducting a safe job hunt online, visit safer-jobs.</small>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div style="display: none">
                <h2 class="item-name">{{$product['title']}}</h2>
<div class="col-sm-10">
    <p>{{$product['location_name']}}</p>
</div>
</div>
<div style="display: none">
<div class="col-sm-2">@if($product['meta']['price']>=0)
        <div class="items-box-price font-5">£ {{$product['meta']['price']/100}}{{isset($product['meta']['price_frequency']) ? $product['meta']['price_frequency']:''}}</div>
    @endif</div>
</div>
<div style="display: none">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel"  style="display: none">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                           @foreach($counts as $number)
                                <li data-target="#myCarousel" data-slide-to="{{$number}}"></li>
                            @endforeach
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item frame active">
                                <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$image}}?1500586448" alt="Los Angeles">
                            </div>
                            @foreach($images as $image)
                            <div class="item frame">
                                <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$image}}?1500586448" alt="Chicago">
                            </div>
                            @endforeach
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
                    </div>
                    @if(count($product['images'])>0)
                    <div class="image-gallery">

                        <ul class="image-gallery-ul" style="width: {{count($product['images'])*800}}px;">
                        @foreach($product['images'] as $key=>$image)
                            <li class="image-gallery-li">
                                <div class="listing-side-big">
                                    <div class="listing-thumbnail-big">
                                        <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$image}}?1500586448" alt="Chicago">
                                        <div class="listing-meta txt-sub">
                                            &nbsp;<span class="glyphicon glyphicon-camera"> </span> <span class="image-number"> &nbsp; {{$key+1}} of {{count($product['images'])}}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        </ul>


                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-circle-arrow-left image-gallery-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-circle-arrow-right image-gallery-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        <div class="number-text"></div>
                    </div>
                    @endif
                    
                    <div class="row meta">
                        @foreach($metas as $meta)
                            <div class="col-sm-3 meta-bold">
                                {{$meta->title}}
                            </div>
                            <div class="col-sm-3">
                                {{$meta->value}}
                            </div>
                            @endforeach
                    </div>
                    @if($advert->has_meta('key_features'))
                    <div class="key-features">
                        <h3>Key features</h3> 
                        <ul>
                        @foreach($advert->meta('key_features') as $key)
                            <li>{{$key}}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="description">
                        <h3>Description</h3>
                        @foreach($r = preg_split("/(\r\n|\n|\r)/", $product['description']) as $part)
                            <br>{{$part}}
                            @endforeach
                    </div>
                    <div class="row mapframe">
                        <div class="col-sm-12">

                            <div id="map"></div>
                            <script>
                                function initMap() {
                                    var uluru = {lat: {!! $lat !!}, lng: {!! $lng !!}};
                                    var map = new google.maps.Map(document.getElementById('map'), {
                                        zoom: 18,
                                        center: uluru
                                    });
                                    var marker = new google.maps.Marker({
                                        position: uluru,
                                        map: map
                                    });
                                }
                                $(document).ready(function() {
                                    initMap();
//your code
                                });

                            </script>

                        </div>
                    </div>
                </div>
            <div class="col-md-3 col-sm-12">
                @if($advert->has_param('sold'))
                    <div class="sold-div">
                        <img class="sold-picture" src="/css/sold.jpg">

                    </div>

                @elseif($advert->category->can_ship())
                <div class="delivery-options">
                    @if($advert->has_param('candeliver')&&$advert->param('candeliver')===1)
                        <div id="check-div" @if (!Auth::guest()&& Auth::user()->default_address>0) style="display: none" @endif>
                        <p class="bold-text">Check if it can be delivered to you</p>
                        <span class="red-text" id="sorry-info" style="display: none">Sorry, the item can't be delivered to your location</span>
                        <input class="form-control" placeholder="SW153AZ" name="postcode" id="postcode">
                        <input type="hidden" id="id" value="{{$advert->id}}">
                    <button class="btn btn-default" id="check-button">Check</button>
                        </div>
                    <br>
                        @if (Auth::guest()|| Auth::user()->default_address===0)
                            @else
                            <span><span id="delivery-info" @if(!$advert->can_deliver_to(Auth::user()->address->zip)) style="display: none" @endif>Can be delivered to </span> <span class="red-text" id="s-info" @if($advert->can_deliver_to(Auth::user()->address->zip)) style="display: none" @endif>Cannot be delivered to </span>  <span class="bold-text" id="postcode-text">{{ Auth::user()->address->postcode}} </span>
                           <a id="edit-post">Edit</a></span>

                        @endif
                            <h4>Can Delivery Locally(Within {{$advert->meta('distance')}}  Miles)</h4>
                        <p>Price</p>
                        <span class="bold-text">£{{$advert->price()}}</span><span>+£{{$advert->delivery()}}&nbsp;&nbsp; Delivery</span>
                    <br><br>
                        <form action="/user/ad/sale" method="post">
                            <input name="id" type="hidden" value="{{$advert->id}}">
                            <input name="type" type="hidden" value="0">
                            {{ csrf_field() }}
                        <button type="submit" class="btn-primary btn">Order to Deliver</button>
                        </form>
                        @endif
                        @if($advert->has_param('canship')&&$advert->param('canship')===1)
                            <h4>Can Ship Nationwide</h4>
                            <p>Price</p>
                            <span class="bold-text">£{{$advert->price()}}</span><span>+£{{$advert->shipping_cost()}}&nbsp;&nbsp; Shipping</span>
                            <br><br>
                            <form action="/user/ad/sale" method="post">
                                <input name="id" type="hidden" value="{{$advert->id}}">
                                <input name="type" type="hidden" value="1">
                                {{ csrf_field() }}
                            <button type="submit"  class="btn-success btn">Order to Ship</button>
                            </form>

                        @endif

                        @if($advert->category->has_price()&&$advert->user->stripe_account)

                            <div class="collection-options">
                                <h4>Near to Seller, liked the item?</h4>
                                <form action="/user/ad/sale" method="post">
                                    <input name="id" type="hidden" value="{{$advert->id}}">
                                    <input name="type" type="hidden" value="2">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn-info btn">Purchase</button>
                                </form>
                                <p>Once you agree to buy, the seller will handover the item and get paid</p>
                            </div>
                        @endif
                </div>
                @endif
                    @if($advert->category->can_apply())
                        <div class="apply-options">
                            @if (Auth::guest())
                                <br>
                            <br>
                            You need to login to apply.
                                <a href="/user/redirect/{{$advert->id}}" class="btn btn-primary">Login</a>
                                @elseif(Auth::user()->has_applied($advert->id))
                                <br>
                            <br>
                            <br>
                                <button class="btn-primary btn" disabled>Application Sent</button>
                                @else
                                <form action="/user/jobs/apply" method="post">
                                    <input name="redirect" type="hidden" value="{{$advert->url()}}">
                                    <input name="id" type="hidden" value="{{$advert->id}}">
                                    {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="cv">Select a CV</label>
                                    @if(count(Auth::user()->cvs)>0)
                                    <select class="form-control" name="cv" required>
                                        <option value="0">Select</option>
                                        @foreach(Auth::user()->cvs as $cv)
                                            <option value="{{$cv->id}}">{{$cv->title}}</option>
                                        @endforeach
                                    </select>
                                        @else
                                        <input type="hidden" id="title" value="{{$advert->category->title}}">

                                        <input type="hidden" id="category" value="{{$advert->category_id}}">
                                        <input type="file" class="form-control-file" id="upload-cv">
                                    @endif
                                </div>
                                    <div class="form-group">
                                        @if(count(Auth::user()->covers)>0)

                                        <label for="cover">Select a Cover Letter</label>
                                        <select class="form-control" name="cover" required>
                                            <option value="0">Select</option>
                                            @foreach(Auth::user()->covers as $cover)
                                                <option value="{{$cover->id}}">{{$cover->title}}</option>
                                            @endforeach
                                        </select>
                                            @else
                                            <label for="cover">Cover Letter</label>
                                            <input type="hidden" name="ctitle" value="{{$advert->category->title}}">
                                            <textarea name="ctext" class="form-control" rows="3"></textarea>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">Apply</button>
                                </form>


                            @endif
                        </div>
                            @endif


                <div class="buttons">
                    <ul class="list-group">
                        <li class="list-group-item"><div style="width: 30px;padding-bottom: 30px;"><span class="glyphicon  @if(!Auth::guest()&&Auth::user()->is_favorite($advert->id)) glyphicon-heart @else glyphicon-heart-empty @endif favroite-icon" data-id="{{$advert->id}}"></span></div>
                        </li>


                            <li class="list-group-item"><a href="/user/reply/{{$product['source_id']}}" class="btn btn-default">Send Message</a></li>


                    </ul>
                    <h4>Info</h4>
                    @if($advert->user!==null)
                    <div class="profile-picutre">
                        <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$advert->user->image}}">
                    </div>
                        <a href="/userads/{{$advert->user->id}}">Ads({{count($advert->user->adverts)}})</a>
                        <ul class="list-group">
                            <li class="list-group-item"><h4>{{$advert->user->display_name}}</h4></li>
                            <li class="list-group-item">     <div class="user-badge">
                                    {{$advert->user->vid}}
                                </div></li>
                        </ul>

                        @else
                        <ul class="list-group">
                            <li class="list-group-item"><h4>{{$product['username']}}</h4></li>
                        </ul>
                    @endif


                </div>

            </div>
        </div>
    </div>
</div>


<script>
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
</script>



@endsection
