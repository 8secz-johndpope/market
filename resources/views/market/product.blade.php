<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')

        <div class="row">

        <div class="col-sm-3"></div>
                <div class="col-sm-6">
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
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                           @foreach($counts as $number)
                                <li data-target="#myCarousel" data-slide-to="{{$number}}"></li>
                            @endforeach
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{$image}}?1500586448" alt="Los Angeles">
                            </div>
                            @foreach($images as $image)
                            <div class="item">
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
                        {{$product['description']}}
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

                            </script>

                        </div>
                    </div>
                </div>
            <div class="col-sm-3">
                <div class="buttons">
                    <ul class="list-group">
                        <li class="list-group-item"> <button class="btn btn-default">Interested to Make Offer</button></li>
                        <li class="list-group-item"><button class="btn btn-default">Save to Favorites</button></li>
                        <li class="list-group-item"></li>
                        <li class="list-group-item"><button class="btn btn-primary">Buy Now</button></li>
                    </ul>



                </div>

            </div>
        </div>







@endsection
