<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">

            <ul class="nav nav-tabs">

                <li class="nav-item active">
                    <a class="nav-link " href="#">Manage  ads</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/business/manage/details">My Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/business/manage/company">Company</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/business/manage/finance">Financials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/business/manage/metrics">Metrics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/business/manage/support">Support</a>
                </li>
            </ul>
            <div class="row">
                <div class="col-sm-10">

                </div>
                <div class="col-sm-2">
                    <a class="btn btn-primary" href="/user/ads/post">Post an Ad</a>

                </div>
            </div>
<table class="table">
    <tr><th></th><th>Views</th><th>Last Posted</th></tr>
            @foreach($products as $product)
                <tr><td>
                <div class="well">
                    <div class="product">
                        <div class="listing-side">
                            <div class="listing-thumbnail">
                                <img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{ count($product['images'])>0?$product['images'][0]:"noimage.png"}}" class="lazyload" alt="">

                                @if(isset($product['featured'])&&$product['featured']===1)
                                    <span class="ribbon-featured">
<strong class="ribbon" data-q="featuredProduct"><span class="hide-visually">This ad is</span>Featured</strong>
</span>
                                @endif

                                <div class="listing-meta txt-sub">
                                    <span class="glyphicon glyphicon-camera"> </span> <span class="image-number"> {{count($product['images'])}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="info">


                            <a class="listing-product" href="/p/{{$product['category']}}/{{$product['source_id']}}"> <h4 class="product-title">{{$product['title']}}</h4></a>

                            <span class="listing-location">
                                    {{$product['location_name']}}
                                </span>
                            <p class="listing-description">
                                {{$product['description']}}
                            </p>

                            @if($product['meta']['price']>=0)
                                <span class="product-price">£ {{$product['meta']['price']/100}}{{isset($product['meta']['price_frequency']) ? $product['meta']['price_frequency']:''}}
                                </span>
                            @endif



                            @if(isset($product['urgent'])&&$product['urgent']===1)
                                <span class="clearfix txt-agnosticRed txt-uppercase" data-q="urgentProduct">
<span class="hide-visually">This ad is </span>Urgent
</span>
                            @endif
                        </div>
                    </div>
                </div>
                    </td><td>0</td><td> <span class="posted">{{$product['posted']}}</span></td></tr>
            @endforeach
</table>
        </div>
    </div>


@endsection