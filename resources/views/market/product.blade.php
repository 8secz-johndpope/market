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
                   
                    @if(count($product['images'])>0)
                    <div class="image-gallery">
                        @foreach($product['images'] as $image)
                            <div>
                                <img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{$image}}?1500586448" alt="Chicago">
                            </div>
                        @endforeach
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
                                $(document).ready(function() {
                                    initMap();
//your code
                                });

                            </script>

                        </div>
                    </div>
                </div>
            <div class="col-sm-3">
                <div class="buttons">
                    <h4>Seller Info</h4>
                    <ul class="list-group">
                        <li class="list-group-item"><h4>{{$product['username']}}</h4></li>
                    </ul>
                    <ul class="list-group">
                        <li class="list-group-item"> <button class="btn btn-default">Interested to Make Offer</button></li>
                        <li class="list-group-item"><button class="btn btn-default">Save to Favorites</button></li>
                        <li class="list-group-item"><button class="btn btn-default">Send Message</button></li>
                        @if(isset($product['shipping'])&&$product['shipping']===1)
                        <li class="list-group-item"><a class="btn btn-primary" href="/user/manage/shipping/{{$product['source_id']}}">Buy Now</a></li>
                            @endif
                    </ul>
                </div>

            </div>
        </div>




<script>
    $(document).ready(function () {
        $('.image-gallery').slick();
    });


</script>


@endsection
