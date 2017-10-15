<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.home')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')


<div class="row listings">
    <div class="container-fluid">
        <div class="all">
            <div class="search-alert-div">
                <a class="search-alert" href="/user/create/alert/{{$category->id}}?id={{$location->id}}"><span class="glyphicon glyphicon-bell"></span>&nbsp;&nbsp;Set Search Alert </a>
            </div>
            <div class="top-bar">
                <a class="filter-button btn btn-default">Filter</a>
            </div>
    <div class="filter-container">
        <div class="all-filters">
        <div class="l-visible-large">
            <ul class="list-group">
                @foreach($lparents as $parent)
                    <li class="list-group-item"><a href="/{{$category->slug}}/{{$parent->slug}}">{{$parent->title}}</a>&nbsp;&nbsp;</li>
                @endforeach
            </ul>
        </div>
        <div class="l-visible-large">
            <h4>{{$location->title}}</h4>
            <ul class="list-group">
                @foreach($locs as $cat)
                    <li class="list-group-item"><a href="/{{$category->slug}}/{{$cat->slug}}">{{$cat->title}}</a>&nbsp{{$cat->count}}</li>
                @endforeach
            </ul>
        </div>
        <div class="l-visible-large">
            <ul class="list-group">
                @foreach($parents as $parent)
                    <li class="list-group-item"><a href="/{{$parent->slug}}/{{$location->slug}}">{{$parent->title}}</a>&nbsp;&nbsp;</li>
                @endforeach
            </ul>
        </div>
        <div class="l-visible-large">
            <h4>{{$category->title}}</h4>
            <ul class="list-group">
                @foreach($categories as $cat)
                        <li class="list-group-item"><a href="/{{$cat->slug}}/{{$location->slug}}">{{$cat->title}}</a>&nbsp;&nbsp;{{$cat->count}}</li>
                @endforeach
            </ul>
        </div>
        <form action="{{$url}}" >
            <div class="form-group">
                <label for="distance">Distance:</label>
                @foreach($input as $key=>$value)
                    @if($key!=='distance')
                        <input type="hidden" name="{{$key}}" value="{{$value}}">
                    @endif
                @endforeach
                <select class="form-control" data-autosubmit="" name="distance" id="distanceRefine" aria-invalid="false"  onchange="this.form.submit()">
                    @foreach($distances as $key=>$value)
                        <option value="{{$key}}" @if(isset($input['distance'])&&$input['distance']==$key)) selected @endif>
                            {{$value}}
                        </option>
                    @endforeach
                </select>
            </div>
            </form>


            <form action="{{$url}}" >
                <div class="form-group">
                    <label for="sort"> Sort By:</label>
                @foreach($input as $key=>$value)
                    @if($key!=='sort')
                        <input type="hidden" name="{{$key}}" value="{{$value}}">
                    @endif
                @endforeach
                <select class="form-control" name="sort" data-autosubmit="" data-analytics="gaEvent:SRP-sortlistings,defer:true" aria-invalid="false" onchange="this.form.submit()">
                    @foreach($sorts as $st)
                        <option value="{{$st->key}}" @if(isset($input['sort'])&&$input['sort']===$st->key)) selected @endif>{{$st->title}}</option>
                    @endforeach
                </select>
                </div>
            </form>


            <form action="{{$url}}"  class="form-horizontal">
                <label for="distance">Price:</label>
                @foreach($input as $key=>$value)
                    <input type="hidden" name="{{$key}}" value="{{$value}}">
                @endforeach
                    <div class="form-group">
                        <label class="control-label col-sm-6" for="min_price">Minimum Price:</label>
                        <div class="col-sm-6">
                        <input class="form-control" placeholder="Min" type="number" id="min_price" name="min_price" value="@if(isset($input['min_price'])){{$input['min_price']}}@endif" aria-invalid="false">
                    </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-6" for="max_price">Maximum Price:</label>
                        <div class="col-sm-6"><input class="form-control" placeholder="Max" type="number" name="max_price" value="@if(isset($input['max_price'])){{$input['max_price']}}@endif" aria-invalid="false">
                        </div>
                        </div>
                    <div class="form-group">
                            <div class="col-sm-offset-6 col-sm-6">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
            </form>

        @foreach($filters as $filter)
            <div class="l-visible-large">
                <h4>{{$filter->title}}</h4>
                <ul class="list-group">
                    @foreach($filter->vals as $val)
                        @if($val->selected===1)
                            <li class="list-group-item">{{$val->title}}</li>
                        @else
                            <li class="list-group-item"><a href="{!! $val->url !!}">{{$val->title}}</a>&nbsp;&nbsp;{{$val->count}}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endforeach
        </div>
    </div>
    <div class="products">
            <h2 class="items-box-head">
                List of items for {{$category->title}}, {{number_format($total)}}

            </h2>



            @foreach($products as $product)
    <div class="well">
        <div class="product">
        <div class="listing-side">
                <div class="listing-thumbnail">
                    <img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{ count($product['images'])>0?$product['images'][0]:"noimage.png"}}" class="lazyload" alt="">

                    @if(isset($product['featured'])&&$product['featured']===1&&$product['featured_expires']>$milli&&isset($product['featured_x']))
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

                            <div class="favor">
                                @if (in_array($product['source_id'],$sids))
                                    <span class="glyphicon glyphicon-heart favroite-icon" data-id="{{$product['source_id']}}"></span>
                                @else
                                    <span class="glyphicon glyphicon-heart-empty favroite-icon" data-id="{{$product['source_id']}}"></span>

                                @endif
                            </div>
                            <a class="listing-product" href="/p/{{$product['category']}}/{{$product['source_id']}}"> <h4 class="product-title">{{$product['title']}}</h4></a>

                            <span class="listing-location">
                                    {{\App\Model\Location::where('res',$product['location_id'])->first()->title}}, {{\App\Model\Location::where('res',$product['location_id'])->first()->parent->title}}
                                </span>
                            <p class="listing-description">
                                {{$product['description']}}
                            </p>

                        @if($product['meta']['price']>=0)
                                <span class="product-price">£ {{$product['meta']['price']/100}}{{isset($product['meta']['price_frequency']) ? $product['meta']['price_frequency']:''}}
                                </span>
                            @endif
                @if(isset($product['featured'])&&$product['featured']===1&&$product['featured_expires']>$milli&&isset($product['featured_x']))

                    @else
                <span class="posted-text">{{$product['posted']}}</span>
                @endif


                            @if(isset($product['urgent'])&&$product['urgent']===1&&$product['urgent_expires']>$milli)
                                    <span class="clearfix txt-agnosticRed txt-uppercase" data-q="urgentProduct">
<span class="hide-visually">This ad is </span>Urgent
</span>
                            @endif
            </div>
        </div>
</div>
            @endforeach


        <nav aria-label="Page navigation">
            <div class="text-center">
            <ul class="pagination">

                <li class=" @if($page==1)disabled @endif">
                    <a href="{{$pageurl}}&page={{$page-1}}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                @foreach($pages as $p)
                    <li class="{{$page==$p?'active':''}}">
                        @if($page===$p)
                            <span> {{$p}}<span class="sr-only">(current)</span></span>
                        @else
                            <a href="{{$pageurl}}&page={{$p}}">{{$p}}</a>
                        @endif
                    </li>
                @endforeach

                <li class=" @if($page==$max)disabled @endif">
                    <a href="{{$pageurl}}&page={{$page+1}}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
            </div>
        </nav>

    </div>
        </div>
    </div>
</div>


@endsection
