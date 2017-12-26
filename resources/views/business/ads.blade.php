<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">

            <!-- <ul class="nav nav-tabs top-main-nav">

                <li class="nav-item active">
                    <a class="nav-link nav-color" href="#"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;&nbsp; Manage  ads</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/images"><span class="glyphicon glyphicon-camera"></span>&nbsp;&nbsp;Images</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/orders"><span class="glyphicon glyphicon-credit-card"></span> &nbsp;&nbsp; Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/messages"><span class="glyphicon glyphicon-envelope"></span> &nbsp;&nbsp; Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/details"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; My Details</a>
                </li>
                @if($user->contract!==null)
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/company"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp; Company</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/finance"><span class="glyphicon glyphicon-gbp"></span> &nbsp;&nbsp; Financials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/metrics"><span class="glyphicon glyphicon-stats"></span> &nbsp;&nbsp; Metrics</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/favorites"><span class="glyphicon glyphicon-heart"></span> &nbsp;&nbsp; Favorites</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/alerts"><span class="glyphicon glyphicon-bell"></span> &nbsp;&nbsp; Search Alerts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/support"><span class="glyphicon glyphicon-earphone"></span> &nbsp;&nbsp; Support</a>
                </li>
            </ul>-->
            <div class="row">
                <div class="col-sm-8">

                </div>
                <div class="col-sm-2">

                <form action="/user/upload/csv" method="post" enctype="multipart/form-data">{{csrf_field()}}
                <input type="file" name="csv">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
                </div>
                <div class="col-sm-2">
                    <a class="btn btn-success" href="/user/ad/create"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp; Post an Ad</a>

                </div>
            </div>
            <ul class="nav nav-tabs">

                <li class="nav-item active">
                    <a class="nav-link nav-color" data-toggle="tab" href="#live">Live</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" data-toggle="tab" href="#drafts">Drafts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" data-toggle="tab" href="#inactive">Inactive</a>
                </li>

            </ul>
            <div class="tab-content">
                <div id="live" class="tab-pane fade in active">
            <form action="/business/manage/bump" method="post">
                {{ csrf_field() }}
<table class="table">
    <tr><th></th><th>Views</th><th>Last Posted</th><th colspan="3" class="center-text">Featured</th><th>Urgent</th><th>Spotlight</th><th>Bump</th></tr>
    <tr><td></td><td></td><td></td><td>3 days</td><td>7 days</td><td>14 days</td><td></td><td></td><td></td></tr>

@foreach($user->live as $advert)
                <tr><td>
                    <div class="product">
                        <div class="listing-side">
                            <div class="listing-thumbnail">
                                <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{ count($advert->param('images'))>0?$advert->param('images')[0]:"noimage.png"}}" class="lazyload" alt="">

                                @if($advert->featured_expires())
                                    <span class="ribbon-featured">
<strong class="ribbon" data-q="featuredProduct"><span class="hide-visually">This ad is</span>Featured</strong>
</span>
                                @endif

                                <div class="listing-meta txt-sub">
                                    <span class="glyphicon glyphicon-camera"> </span> <span class="image-number"> {{count($advert->param('images'))}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="info">


                            <a class="listing-product" href="/p/{{$advert->param('category')}}/{{$advert->id}}"> <h4 class="product-title">{{$advert->param('title')}}</h4></a>

                            <span class="listing-location">
                                    {{$advert->param('location_name')}}
                                </span>
                            <p class="listing-description">
                                {!! $advert->param('description') !!}
                            </p>

                            @if($advert->meta('price')>=0)
                                <span class="product-price">£ {{$advert->meta('price')/100}}{{$advert->meta('price_frequency')}}
                                </span>
                            @endif

                            
                            @if($advert->urgent_expires())
                                <span class="clearfix txt-agnosticRed txt-uppercase" data-q="urgentProduct">
<span class="hide-visually">This ad is </span>Urgent
</span>
                            @endif
                            @if($advert->urgent_expires())
                                <span class="clearfix txt-agnosticRed txt-uppercase" data-q="urgentProduct">
<span class="hide-visually">This ad is </span>Urgent
</span>
                            @endif
                        </div>
                    </div>

                    <table class="table"><tr><td><span class="green-text bold-text">Live</span> </td><td><a class="nav-color assign-images" data-id="{{$advert->id}}" ><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp; Add Images</a></td><td><a class="nav-color" href="/user/advert/edit/{{$advert->id}}"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp; Edit</a></td><td><a class="nav-color" href="/user/advert/duplicate/{{$advert->id}}"><span class="glyphicon glyphicon-magnet"></span>&nbsp;&nbsp; Duplicate</a></td><td><a href="#" class="stats-click nav-color" data-id="{{$advert->id}}"><span class="glyphicon glyphicon-stats"></span> &nbsp;&nbsp;Stats</a></td><td><a class="red-color" href="/user/advert/delete/{{$advert->id}}"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;&nbsp; Delete</a></td></tr></table>
                    </td>
                    <td><span class="bold-text">{{$advert->param('views')}}</span></td><td> <span class="posted">{{$advert->posted()}}</span></td>@if($advert->featured_expires()) <td colspan="3" class="center-text"><span class="bold-text">{{$advert->featured_expires()}} days left</span> </td> @else<td><input name="matrix[{{$advert->id}}][featured_3]" type="checkbox" class="featured-check featured-check-{{$advert->id}}" data-id="{{$advert->id}}" value="1"></td><td><input class="featured-check featured-check-{{$advert->id}}" data-id="{{$advert->id}}" name="matrix[{{$advert->id}}][featured]" type="checkbox" value="1"></td><td><input class="featured-check featured-check-{{$advert->id}}" data-id="{{$advert->id}}" name="matrix[{{$advert->id}}][featured_14]" type="checkbox" value="1"></td>@endif<td> @if($advert->urgent_expires())<span class="bold-text">{{$advert->urgent_expires()}} days left</span>  @else <input name="matrix[{{$advert->id}}][urgent]" type="checkbox" value="1"> @endif</td><td>@if($advert->spotlight_expires())<span class="bold-text">{{$advert->spotlight_expires()}} days left</span>  @else<input name="matrix[{{$advert->id}}][spotlight]" type="checkbox" value="1"> @endif</td><td><input name="matrix[{{$advert->id}}][bump]" type="checkbox" value="1"></td>
                </tr>
            @endforeach
</table>
                <div class="continue-div">
                <button class="btn-primary btn" type="submit" style="float: right;margin-right: 20px;">Continue</button>
                </div>
            </form>
                </div>
                <div id="drafts" class="tab-pane fade">
                        {{ csrf_field() }}
                        <table class="table">
                            <tr><th></th><th>Views</th><th>Last Posted</th><th colspan="3" class="center-text">Featured</th><th>Urgent</th><th>Spotlight</th><th>Bump</th></tr>
                            <tr><td></td><td></td><td></td><td>3 days</td><td>7 days</td><td>14 days</td><td></td><td></td><td></td></tr>

                            @foreach($user->drafts as $advert)
                                <tr><td>
                                        <div class="product">
                                            <div class="listing-side">
                                                <div class="listing-thumbnail">
                                                    <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{ count($advert->param('images'))>0?$advert->param('images')[0]:"noimage.png"}}" class="lazyload" alt="">

                                                    @if($advert->featured_expires())
                                                        <span class="ribbon-featured">
<strong class="ribbon" data-q="featuredProduct"><span class="hide-visually">This ad is</span>Featured</strong>
</span>
                                                    @endif

                                                    <div class="listing-meta txt-sub">
                                                        <span class="glyphicon glyphicon-camera"> </span> <span class="image-number"> {{count($advert->param('images'))}}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="info">


                                                <a class="listing-product" href="/p/{{$advert->param('category')}}/{{$advert->id}}"> <h4 class="product-title">{{$advert->param('title')}}</h4></a>

                                                <span class="listing-location">
                                    {{$advert->param('location_name')}}
                                </span>
                                                <p class="listing-description">
                                                    {!!$advert->param('description')  !!}
                                                </p>

                                                @if($advert->meta('price')>=0)
                                                    <span class="product-price">£ {{$advert->meta('price')/100}}{{$advert->meta('price_frequency')}}
                                </span>
                                                @endif



                                                @if($advert->urgent_expires())
                                                    <span class="clearfix txt-agnosticRed txt-uppercase" data-q="urgentProduct">
<span class="hide-visually">This ad is </span>Urgent
</span>
                                                @endif
                                            </div>
                                        </div>
                                            <table class="table"><tr><td><span class="yellow-text bold-text">Draft</span></td><td><a class="nav-color assign-images" data-id="{{$advert->id}}" ><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp; Add Images</a></td><td></td><td><a class="nav-color" href="/user/manage/ad/{{$advert->id}}"><span class="glyphicon glyphicon-play-circle"></span>&nbsp;&nbsp; Continue To Post</a></td></tr></table>


                                    </td>
                                        <td colspan="5"><p>You need to Finish the  advert to promote the advert. </p><a href="/user/manage/ad/{{$advert->id}}">Finish Posting</a></td>

                                </tr>
                            @endforeach
                        </table>

                </div>
                <div id="inactive" class="tab-pane fade">

                        <table class="table">
                            <tr><th></th><th>Views</th><th>Last Posted</th><th colspan="3" class="center-text">Featured</th><th>Urgent</th><th>Spotlight</th><th>Bump</th></tr>
                            <tr><td></td><td></td><td></td><td>3 days</td><td>7 days</td><td>14 days</td><td></td><td></td><td></td></tr>

                            @foreach($user->inactive as $advert)
                                <tr><td>
                                        <div class="product">
                                            <div class="listing-side">
                                                <div class="listing-thumbnail">
                                                    <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{ count($advert->param('images'))>0?$advert->param('images')[0]:"noimage.png"}}" class="lazyload" alt="">

                                                    @if($advert->featured_expires())
                                                        <span class="ribbon-featured">
<strong class="ribbon" data-q="featuredProduct"><span class="hide-visually">This ad is</span>Featured</strong>
</span>
                                                    @endif

                                                    <div class="listing-meta txt-sub">
                                                        <span class="glyphicon glyphicon-camera"> </span> <span class="image-number"> {{count($advert->param('images'))}}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="info">


                                                <a class="listing-product" href="/p/{{$advert->param('category')}}/{{$advert->id}}"> <h4 class="product-title">{{$advert->param('title')}}</h4></a>

                                                <span class="listing-location">
                                    {{$advert->param('location_name')}}
                                </span>
                                                <p class="listing-description">
                                                    {!! $advert->param('description') !!}
                                                </p>

                                                @if($advert->meta('price')>=0)
                                                    <span class="product-price">£ {{$advert->meta('price')/100}}{{$advert->meta('price_frequency')}}
                                </span>
                                                @endif



                                                @if($advert->urgent_expires())
                                                    <span class="clearfix txt-agnosticRed txt-uppercase" data-q="urgentProduct">
<span class="hide-visually">This ad is </span>Urgent
</span>
                                                @endif
                                            </div>
                                        </div>

                                            <table class="table">
                                                <tr><td><span class="red-text bold-text">Deleted</span></td>
                                                    <td><a class="nav-color assign-images" data-id="{{$advert->id}}" ><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp; Add Images</a></td><td></td><td><a class="nav-color" href="/user/advert/repost/{{$advert->id}}"><span class="glyphicon glyphicon-record"></span>&nbsp;&nbsp;Repost</a></td></tr></table>

                                    </td>
                                        <td colspan="5"><p>You need to repost advert to promote the advert. </p><a class="nav-color" href="/user/advert/repost/{{$advert->id}}"><span class="glyphicon glyphicon-record"></span>&nbsp;&nbsp; Repost</a></td>

                                </tr>
                            @endforeach
                        </table>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" id="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Statistics</h4>
                </div>
                <div class="modal-body">
                    <table>

                        <tr>
                            <td>
                                <table class="table">
                                 <tr>  <td>Views</td></td> <td>935</td><td>Listing views</td></td> <td>9,294</td></tr>
                                    <tr>  <td>Email replies</td></td> <td>11</td><td>Times bumped up</td></td> <td>0</td></tr>
                                    <tr>  <td>Created</td></td> <td>12 days ago</td><td>Last posted</td></td> <td> 12 days ago</td></tr>
                                    <tr>  <td>Ad id</td></td> <td>1266508749</td> <td> </td></td> <td></tr>

                                </table>
                            </td>
                        </tr>

                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <div id="myModal1" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <form action="/user/ad/images" method="post">
                {{ csrf_field() }}
                <input name="id" value="0" type="hidden" id="advert_id">
            <!-- Modal content-->
            <div class="modal-content" id="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Assign Images</h4>
                </div>
                <div class="modal-body">
                    <div class="row row-images-modal"  id="sortable">
                        @foreach($user->images as $image)
                            <div class="multi-image"><input type="checkbox" name="images[]" value="{{$image->image}}"><img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$image->image}}" data-src="{{env('AWS_WEB_IMAGE_URL')}}/{{$image->image}}"></div>
                        @endforeach

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection