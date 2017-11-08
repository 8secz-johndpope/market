<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <link href="{{ asset('/css/property.css?q=874') }}" rel="stylesheet">
    <link href="/css/imageviewer.css"  rel="stylesheet" type="text/css" />
<script src="/js/imageviewer.min.js"></script>
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
            <div class="col-md-8 col-sm-12">
                <h2 class="item-name">{{$product['title']}}</h2>
                <div class="col-sm-9 location-name">
                    <p>{{$product['location_name']}}</p>
                </div>
                <div class="col-sm-3">
                    @if($product['meta']['price']>=0)
                    <div class="items-box-price font-5">£ {{number_format($product['meta']['price'] / 100, 0, '.', ',')}}{{isset($product['meta']['price_frequency']) ? $product['meta']['price_frequency']:''}}</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-sm-12">
                    <div id="current-image">
                        <img id="image-active" data-index="1" src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{$image}}?1500586448" alt="Los Angeles" data-high-res-src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{$image}}?1500586448" class="gallery-items">
                        <div class="images-info">
                            <div class="col-sm-4 start-animation">
                                <a href="javascript:void(0)" class="icon-before">Start slideshow</a>
                            </div>
                            <div class="col-sm-4 images-nav">
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
                                        <img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{$product['images'][$i+$j]}}?1500586448" alt="Los Angeles">
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
                            <a href="/user/reply/{{$product['source_id']}}" class="btn btn-default">Call</a>
                            <a href="/user/reply/{{$product['source_id']}}" class="btn btn-default">Send Message</a>
                            
                            <a href="/user/reply/{{$product['source_id']}}" class="btn btn-default">VideoCall</a>
                        </div>
                    </div>
                    <div id="tabs"> 
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-description">Description</a></li>
                        <li><a data-toggle="tab" href="#tap-map">Map & Street View</a></li>
                        @if($advert->has_meta('property_floorplan'))
                            <li><a data-toggle="tab" href="#tap-floorplan">Floorplan</a></li>
                        @endif
                    </ul>
                    <div class="tab-content">
                        <div id="tab-description" class="tab-pane fade in active">
                            <div class="content">
                                <div class="col-sm-8 left-content">
                                    @if($category->id == 307000000)
                                        <h3>Letting information:</h3>
                                    @endif
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
                                                Added on Sumra:
                                            </div>
                                            <div class="col-sm-6 meta-info">
                                                {{$advert->created_at->format('d F Y')}}
                                            </div>
                                            <div class="col-sm-6 meta-bold">
                                                Payments:
                                            </div>
                                            <div class="col-sm-6 meta-info">
                                                <a href="#"> <img class="payments-methods" src="/css/payments.png"></a>
                                            </div>
                                    </div>
                                    @if($advert->has_meta('key_features'))
                                        <div class="row key-features">
                                            <h3>Key features</h3> 
                                            <ul class="list-two-col list-style-square">
                                            @foreach($advert->meta('key_features') as $key)
                                                <li class="col-sm-6">{{$key}}</li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="description">
                                        <h3>Description</h3>
                                        @foreach($r = preg_split("/(\r\n|\n|\r)/", $product['description']) as $part)
                                            {{$part}}<br>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-sm-4 right-content">
                                    <div class="map-image">
                                        <img src="https://maps.googleapis.com/maps/api/staticmap?center={!! $lat !!},{!! $lng !!}&zoom=12&size=190x222&markers=color:blue%7Clabel:S%7C{!! $lat !!},{!! $lng !!}&key=AIzaSyCe5IY6S4WvKrjmvpgTwHyO1oiX4pRUUD8">
                                    </div>
                                    <div class="color-grey">
                                        <a href="#tap-map"> <span class="glyphicon glyphicon-zoom-in"></span>Enlarge this map</a>
                                    </div>
                                    <div class="color-grey nearest-stations">
                                        <h4>Nearest stations</h4>
                                        <ul class="stations-list">

                                        </ul>
                                        <small class="disclaimer">
                                            Distances are straight line measurements from centre of postcode
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tap-map" class="tab-pane fade">           
                            <div class="row mapframe">
                        <div class="col-sm-12">
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
                                    <small>Distances are straight line measurements from centre of postcode
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
                                });
                            </script>

                        </div>
                    </div>
                        </div>
                        @if($advert->has_meta('property_floorplan'))
                        <div id="tap-floorplan" class="tab-pane fade">
                            <div class="row">           
                                <div class="col-sm-12 foorplan">
                                    <img src="{{$advert->meta('property_floorplan')}}">
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    </div>
                </div>
            <div class="col-md-4 col-sm-12">
                <div class="row">
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
                            <span class="bold-text">£{{$advert->price()}}</span><span>+£{{$advert->shipping()}}&nbsp;&nbsp; Shipping</span>
                            <br><br>
                            <form action="/user/ad/sale" method="post">
                                <input name="id" type="hidden" value="{{$advert->id}}">
                                <input name="type" type="hidden" value="1">
                                {{ csrf_field() }}
                            <button type="submit"  class="btn-success btn">Order to Ship</button>
                            </form>

                        @endif

                        @if($advert->category->has_price())

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
                    <div class="details">
                        <h3>This property is marketed by</h3>
                        @if($advert->user!==null)
                        <div class="profile-picutre">
                            <img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{$advert->user->image}}">
                        </div>
                        <div class="user-details">
                            <p><strong>{{$advert->user->name}}</strong></p>
                            <address>
                                
                            </address>
                            <p><a href="/userads/{{$advert->user->id}}">View other adverts from this Advertiser</a></p>
                        </div>
                        @else
                        <ul class="list-group">
                            <li class="list-group-item"><h4>{{$product['username']}}</h4></li>
                        </ul>
                        @endif
                    </div>
                    <div class="contact">
                        <a href="/user/reply/{{$product['source_id']}}" class="btn btn-default">Send Message</a>
                        <p>Or</p>
                        <a href="/user/reply/{{$product['source_id']}}" class="btn btn-default">Call</a>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="glyphicon  @if(!Auth::guest()&&Auth::user()->is_favorite($advert->id)) glyphicon-heart @else glyphicon-heart-empty @endif favroite-icon" data-id="{{$advert->id}}"></span>Save property
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
            <div class="row">
                <div class="share">
                    <h3>Share this property</h3>
                    <div class=" media">
                        <div class="center-block"><a href=""><img class="img-responsive" src="/css/icons/facebook.svg"></a></div>
                        <div class="center-block"><a href=""><img class="img-responsive" src="/css/icons/twitter.svg"></a></div>
                        <div class="center-block"><a href=""><img class="img-responsive" src="/css/icons/instagram.png"></a></div>
                        <div class="center-block"><a href=""><img class="img-responsive" src="/css/icons/pinterest.svg"></a></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="report">
                    <h3>Report this Ad</h3>
                    <a href="#" class="btn btn-default">Report</a>
                </div>
            </div>
            <div class="row">
                <div class="similar-adverts">
                    <h3>Similar Adverts</h3>
                    <div class="listings-adverts">
                    @foreach($products as $product)
                        <div class="col-sm-6">
                            <div class="advert-img">
                                <img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{$product['images'][0]}}?1500586448">
                            </div>
                            <a href="/p/{{$category->slug}}/{{product['source_id']}}">
                            <div class="advert-details">
                                <h4>{{$product['title']}}</h4>
                                @if($product['meta']['price'] > 0)
                                    <h4 class="items-box-price font-6">£{{number_format($product['meta']['price'] / 100)}} {{isset($product['meta']['price_frequency']) ? $product['meta']['price_frequency']:''}}</h4>
                                @endif
                            </div>
                        </a>
                        </div>
                    @endforeach
                    </div>
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
    $('.carousel').carousel({
      interval: false
    })
    $('.small-image>a').click(function () {
        var src = $(this).children().first().attr('src');
        $('#image-active').attr('src', src);
        var index = $(this).attr('data-index');
        $('#image-active').attr('data-index', index);
        $('.index').text(index);
        var indexCarousel = $('.carousel-inner .item.active').index();
        var firsElementCarousel = indexCarousel * 5; 
        var lastElementCarousel = firsElementCarousel + 5;

        if(lastElementCarousel < (index-1)){
            $("#myCarousel").carousel("next");
        }else if(firsElementCarousel > (index-1)){
            $("#myCarousel").carousel("prev");
        }
    });
    $('.prev>a').click(function () {
        var index = $('#image-active').attr('data-index');
        if(index > 1){
            var children = $('.carousel-inner .item').children();
            var prevImage = children.eq(index - 2).find('img').attr('src');
            index -= 1
            $('#image-active').attr('data-index', index);
            $('#image-active').attr('src', prevImage);
            //$('.index').text(index);
            var indexCarousel = $('.carousel-inner .item.active').index();
            var firsElementCarousel = indexCarousel * 5; 
            var lastElementCarousel = firsElementCarousel + 5;
            if(firsElementCarousel > (index-1)){
                $("#myCarousel").carousel("prev");
            }
        }
    });
    $('.next>a').click(function () {
        var index = parseInt($('#image-active').attr('data-index'));
        var children = $('.carousel-inner .item').children();
        var numImg = children.length
        if(index <  numImg){
            var nextImage = children.eq(index).find('img').attr('src');
            index = index + 1;
            $('#image-active').attr('data-index', index);
            $('#image-active').attr('src', nextImage);
            //$('.index').text(index);
            var indexCarousel = $('.carousel-inner .item.active').index();
            var firsElementCarousel = indexCarousel * 5; 
            var lastElementCarousel = firsElementCarousel + 5;
            if(lastElementCarousel < (index)){
                $("#myCarousel").carousel("next");
            }
        }
    });
    $('a[href="#tap-map"]').click(function(e){
        e.preventDefault();
        $('.nav-tabs a[href="#tap-map"]').tab('show');
    });
    $('a[href="#tap-map"]').on('shown.bs.tab', function () {
        console.log("load maps tab");
        x = map.getZoom();
        c = map.getCenter();
        google.maps.event.trigger(map, 'resize');
        google.maps.event.trigger(panorama, 'resize');
        map.setZoom(x);
        map.setCenter(c);
    });
    $('input[type=radio][name=options]').change(function(){
        console.log(this);
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
        
    })
    
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
    $(function () {
        var viewer = ImageViewer();
        $('.images-current').click(function (e) {
            e.preventDefault();
            var imgSrc = $('#image-active').attr('src'),
                highResolutionImage = $('image-active').data('high-res-img');
     
            viewer.show(imgSrc, highResolutionImage);
        });
    });


</script>




@endsection
