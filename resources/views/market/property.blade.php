<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <link href="{{ asset('/css/property.css?q=874') }}" rel="stylesheet">
    <div class="container">
        <div class="row">
            <div class="col-lg-offset-1 col-lg-7 col-md-9 col-sm-12">
                <ol class="breadcrumb">
                    @foreach($parents as $parent)
                    <li class="breadcrumb-item"><a href="/{{$parent->slug}}">{{$parent->title}}</a></li>
                    @endforeach
                    <li class="breadcrumb-item"><a href="/{{$category->slug}}">{{$category->title}}</a></li>
                </ol>
                <h2 class="item-name">{{$product['title']}}</h2>
                <div class="col-sm-9 location-name">
                    <p>{{$product['location_name']}}</p>
                </div>
<div class="col-sm-3">@if($product['meta']['price']>=0)
        <div class="items-box-price font-5">£ {{$product['meta']['price']/100}}{{isset($product['meta']['price_frequency']) ? $product['meta']['price_frequency']:''}}</div>
    @endif</div>
                    <div id="current-image">
                        <img id="image-active" src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{$image}}?1500586448" alt="Los Angeles">
                        <div class="images-info">
                            <div class="col-sm-4 start-animation">
                                <a href="javascript:void(0)" class="icon-before">Start slideshow</a>
                            </div>
                            <div class="col-sm-4 images-nav">
                                <p><span class="index">1</span> of {{count($product['images'])}}</p>
                            </div>
                            <div class="col-sm-4 images-current">
                                <p> Picture <span class="index">1</span></p>
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
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-description">Description</a></li>
                        <li><a data-toggle="tab" href="#tap-map">Map</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-description" class="tab-pane fade in active">
                            @if($category->id == 307000000)
                                <h3>Letting information:</h3>
                            @endif
                            <div class="row meta">
                                @foreach($metas as $meta)
                                    <div class="col-sm-6 meta-bold">
                                        {{$meta->title}}:
                                    </div>
                                    <div class="col-sm-6">
                                        {{$meta->value}}
                                    </div>
                                @endforeach
                            </div>
                            @if($advert->has_meta('key_features'))
                                <div class="key-features">
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
                        <div id="tap-map" class="tab-pane fade">           
                            <div class="row mapframe">
                        <div class="col-sm-12">
                                                        <div id="map"></div>

                            <script>
                                var map;
                                function initMap() {
                                    var uluru = {lat: {!! $lat !!}, lng: {!! $lng !!}};
                                    console.log(JSON.stringify(uluru));
                                     map = new google.maps.Map(document.getElementById('map'), {
                                        zoom: 18,
                                        center: uluru
                                    });
                                    var marker = new google.maps.Marker({
                                        position: uluru,
                                        map: map
                                    });
                                }
                                $('.nav.nav-tabs a').click(function () {
                                    setTimeout(function(){
                                        x = map.getZoom();
                                        c = map.getCenter();
                                        google.maps.event.trigger(map, 'resize');
                                        map.setZoom(x);
                                        map.setCenter(c);
                                    },1000);

                                });
                                
                                $(document).ready(function() {
                                    initMap();
                                });
                                

                            </script>

                        </div>
                    </div>
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
                    <ul class="list-group">
                        <li class="list-group-item"><div style="width: 30px;padding-bottom: 30px;"><span class="glyphicon  @if(!Auth::guest()&&Auth::user()->is_favorite($advert->id)) glyphicon-heart @else glyphicon-heart-empty @endif favroite-icon" data-id="{{$advert->id}}"></span></div>
                        </li>


                        @if(!$advert->category->can_apply())
                            <li class="list-group-item"><a href="/user/reply/{{$product['source_id']}}" class="btn btn-default">Send Message</a></li>
                        @endif

                    </ul>
                    <h4>Info</h4>
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
        console.log(src);
        $('#image-active').attr('src', src);
        var index = $(this).attr('data-index');
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



</script>




@endsection
