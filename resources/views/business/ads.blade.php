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
            <form action="/business/manage/bump" method="post">
                {{ csrf_field() }}
<table class="table">
    <tr><th></th><th>Views</th><th>Last Posted</th><th colspan="3" class="center-text">Featured</th><th>Urgent</th><th>Spotlight</th><th>Bump</th></tr>
    <tr><td></td><td></td><td></td><td>3 days</td><td>7 days</td><td>14 days</td><td></td><td></td><td></td></tr>

@foreach($user->adverts as $advert)
                <tr><td>
                    <div class="product">
                        <div class="listing-side">
                            <div class="listing-thumbnail">
                                <img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{ count($advert->param('images'))>0?$advert->param('images')[0]:"noimage.png"}}" class="lazyload" alt="">

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
                                {{$advert->param('description')}}
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
                    <table class="table"><tr><td><a>Edit</a></td><td><a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Stats</a></td><td><a class="btn btn-danger" href="/user/advert/delete/{{$advert->id}}">Delete</a></td></tr></table>
                    </td><td><span class="bold-text">{{$advert->param('views')}}</span></td><td> <span class="posted">{{$advert->posted()}}</span></td>@if($advert->featured_expires()) <td colspan="3" class="center-text"><span class="bold-text">{{$advert->featured_expires()}} days left</span> </td> @else<td><input name="matrix[{{$advert->id}}][featured_3]" type="checkbox" value="1"></td><td><input name="matrix[{{$advert->id}}][featured]" type="checkbox" value="1"></td><td><input name="matrix[{{$advert->id}}][featured_14]" type="checkbox" value="1"></td>@endif<td> @if($advert->urgent_expires())<span class="bold-text">{{$advert->urgent_expires()}} days left</span>  @else <input name="matrix[{{$advert->id}}][urgent]" type="checkbox" value="1"> @endif</td><td>@if($advert->spotlight_expires())<span class="bold-text">{{$advert->spotlight_expires()}} days left</span>  @else<input name="matrix[{{$advert->id}}][spotlight]" type="checkbox" value="1"> @endif</td><td><input name="matrix[{{$advert->id}}][bump]" type="checkbox" value="1"></td></tr>
            @endforeach
</table>
                <button class="btn-primary btn" type="submit">Continue</button>

            </form>
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Statistics</h4>
                </div>
                <div class="modal-body">
                    <table>

                        <tr>
                            <td>
                                <table class="table">
                                 <tr>  <td>Views</td></td> <td>935</td></tr>
                                    <tr>  <td>Email replies</td></td> <td>11</td></tr>
                                    <tr>  <td>Created</td></td> <td>12 days ago</td></tr>
                                    <tr>  <td>Ad id</td></td> <td>1266508749</td></tr>

                                </table>


                            </td>
                            <td>

                                <table class="table">
                                    <tr>  <td>Listing views</td></td> <td>9,294</td></tr>
                                    <tr>  <td>Times bumped up</td></td> <td>0</td></tr>
                                    <tr>  <td>Last posted</td></td> <td> 12 days ago</td></tr>
                                    <tr>  <td></td></td> <td></td></tr>

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
    Try it Yourself »

@endsection