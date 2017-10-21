<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')

        <div class="row">

        <div class="col-lg-3"></div>
                <div class="col-lg-6 col-md-9 col-sm-12">
                    <ol class="breadcrumb">
                        @foreach($parents as $parent)
                        <li class="breadcrumb-item"><a href="/{{$parent->slug}}">{{$parent->title}}</a></li>
                        @endforeach
                            <li class="breadcrumb-item"><a href="/{{$category->slug}}">{{$category->title}}</a></li>

                    </ol>
                <h2 class="item-name">{{$product['title']}}</h2>
<div class="col-sm-10">
    <p>{{$product['location_name']}}</p>
</div>
<div class="col-sm-2">@if($product['meta']['price']>=0)
        <div class="items-box-price font-5">£ {{$product['meta']['price']/100}}{{isset($product['meta']['price_frequency']) ? $product['meta']['price_frequency']:''}}</div>
    @endif</div>
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
                                <img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{$image}}?1500586448" alt="Los Angeles">
                            </div>
                            @foreach($images as $image)
                            <div class="item frame">
                                <img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{$image}}?1500586448" alt="Chicago">
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
                                        <img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{$image}}?1500586448" alt="Chicago">
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
                    <div class="description">
                       {!! $product['description'] !!}
                    </div>
                    <textarea rows="100" cols="100">{!! $product['description'] !!}}</textarea>
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
                <div class="buttons">
                    <h4>Seller Info</h4>
                    @if($advert->user!==null)
                    <div class="profile-picutre">
                        <img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{$advert->user->image}}">
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

                    <ul class="list-group">
                        <li class="list-group-item"> <button class="btn btn-default">Interested to Make Offer</button></li>
                        <li class="list-group-item"><button class="btn btn-default">Save to Favorites</button></li>
                        <li class="list-group-item"><a href="/user/reply/{{$product['source_id']}}" class="btn btn-default">Send Message</a></li>
                        @if(isset($product['shipping'])&&$product['shipping']===1)
                        <li class="list-group-item"><a class="btn btn-primary" href="/user/manage/shipping/{{$product['source_id']}}">Buy Now</a></li>
                            @endif
                    </ul>
                </div>

            </div>
        </div>






@endsection
