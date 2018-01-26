<!-- Stored in resources/views/child.blade.php -->
@php
use App\Model\Advert;
@endphp
@extends('layouts.home')

@section('title', $category->title)

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('next-search')
@endsection

@section('content')
<link rel="stylesheet" href="/build/css/intlTelInput.css">
<div class="listings background-body">
    <div class="container-fluid">
        <div class="row">
            <div class="banner">
                
            </div>
        </div>
        <div class="row">
        <div class="all">
            <div class="top-bar visible-xs">
                <a class="filter-button btn btn-default">Filter</a>
            </div>
    <div class="col-md-3 col-sm-3 col-xs-12">
    <div class="filter-container">
        <div class="all-filters">
        <!-- <div class="l-visible-large">
            <ul class="list-group">
                @foreach($lparents as $parent)
                    <li class="list-group-item"><a href="/{{$category->slug}}/{{$parent->slug}}">{{$parent->title}}</a>&nbsp;&nbsp;</li>
                @endforeach
            </ul>
        </div> -->
        <!-- <div class="l-visible-large">
            <h4>{{$location->title}}</h4>
            <ul class="list-group">
                @foreach($locs as $loc)
                    <li class="list-group-item"><a href="/{{$category->slug}}/{{$loc->slug}}">{{$loc->title}}</a>&nbsp{{$loc->count}}</li>
                @endforeach
            </ul>
        </div> -->
        <div class="flyout-accordion accordion-container">
            <button type="button" class="options-button accordion-options-button" data-toggle="collapse" data-target="acco-location">
                <span class="options-button-inner">
                    <span class="options-button-name">
                        Location
                    </span>
                    <span class="options-button-value">
                        {{$location->title}}
                    </span>
                    <span class="options-button-icon">
                        <i class="glyphicon glyphicon-menu-down"></i>
                    </span>
                </span>
            </button>
            <div class="collapse" id="acco-price">
                <div class="sf-accordion-select-container location-option">
                    @foreach($locs as $loc)
                    <div class="value-button">
                        <span class="term"><a href="/{{$category->slug}}/{{$loc->slug}}">{{$loc->title}}</a></span>
                        &nbsp;
                        <span class="count">({{$loc->count}})</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @if(count($parents) > 0)
        <div class="flyout-accordion accordion-container">
            <button type="button" class="options-button accordion-options-button" data-toggle="collapse" data-target="acco-location">
                <span class="options-button-inner">
                    <span class="options-button-name">
                        Other Categories
                    </span>
                    <span class="options-button-value">
                    </span>
                    <span class="options-button-icon">
                        <i class="glyphicon glyphicon-menu-down"></i>
                    </span>
                </span>
            </button>
            <div class="collapse in" id="acco-price">
                <div class="sf-accordion-select-container parents-option">
                    @foreach($parents as $parent)
                    <div class="value-button">
                        <span class="term"><a href="/{{$parent->slug}}/{{$location->slug}}">{{$parent->title}}</a></span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- <div class="l-visible-large">
            <ul class="list-group">
                @foreach($parents as $parent)
                    <li class="list-group-item"><a href="/{{$parent->slug}}/{{$location->slug}}">{{$parent->title}}</a>&nbsp;&nbsp;</li>
                @endforeach
            </ul>
        </div> -->
        @endif
        
        <!--<div class="l-visible-large">
            <h4>{{$category->title}}</h4>
            @if(count($categories) > 0)
            <ul class="list-group">
                @foreach($categories as $cat)
                        <li class="list-group-item"><a href="/{{$cat->slug}}/{{$location->slug}}">{{$cat->title}}</a>&nbsp;&nbsp;{{$cat->count}}</li>
                @endforeach
            </ul>
            @endif
        </div> -->

        <div class="flyout-accordion accordion-container">
            <button type="button" class="options-button accordion-options-button" data-toggle="collapse" data-target="acco-category">
                <span class="options-button-inner">
                    <span class="options-button-name">
                        Category
                    </span>
                    <span class="options-button-value">
                        {{$category->title}}
                    </span>
                    <span class="options-button-icon">
                        <i class="glyphicon glyphicon-menu-down"></i>
                    </span>
                </span>
            </button>
            <div class="collapse in" id="acco-category">
                @if(count($categories) > 0)
                <div class="sf-accordion-select-container parents-option">
                    @foreach($categories as $cat)
                    <div class="value-button">
                        <span class="term"><a href="/{{$cat->slug}}/{{$location->slug}}">{{$cat->title}}</a></span>
                         &nbsp;
                        <span class="count">({{$cat->count}})</span>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        <!-- <div class="l-visible-large">
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
        </div>-->
        <!-- <div class="l-visible-large">
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
        </div> -->
        @php
            $isChecked = false;
        @endphp
        <div class="flyout-accordion accordion-container">
            <button type="button" class="options-button accordion-options-button" data-toggle="collapse" data-target="acco-category">
                <span class="options-button-inner">
                    <span class="options-button-name">
                        Sort By
                    </span>
                    <span class="options-button-value">
                        @foreach($sorts as $st)
                            @if(isset($input['sort']) && $input['sort']===$st->key))
                                {{$st->title}}
                                @php
                                    $isChecked = true;
                                @endphp
                                @break
                            @endif
                        @endforeach
                        @if(!$isChecked)
                            Most recent first
                        @endif
                    </span>
                    <span class="options-button-icon">
                        <i class="glyphicon glyphicon-menu-down"></i>
                    </span>
                </span>
            </button>
            <div class="collapse" id="acco-category">
                <div class="sf-accordion-select-container parents-option">
                    <form action="{{$url}}" >
                        @foreach($input as $key=>$value)
                            @if($key!=='sort')
                                <input type="hidden" name="{{$key}}" value="{{$value}}">

                                @break
                            @endif
                        @endforeach
                        <select class="form-control" name="sort" data-autosubmit="" data-analytics="gaEvent:SRP-sortlistings,defer:true" aria-invalid="false" onchange="this.form.submit()">
                        @foreach($sorts as $st)
                            <option value="{{$st->key}}" @if(isset($input['sort'])&&$input['sort']===$st->key)) selected @endif>{{$st->title}}</option>
                        @endforeach
                        </select>
                    </form>
                </div>
            </div>
        </div>
        @php
            $isChecked = false;
        @endphp
        <div class="flyout-accordion accordion-container">
            <button type="button" class="options-button accordion-options-button" data-toggle="collapse" data-target="acco-distance">
                <span class="options-button-inner">
                    <span class="options-button-name">
                        Distance
                    </span>
                    <span class="options-button-value">
                        @foreach($distances as $key=>$value)
                            @if(isset($input['distance']) &&$input['distance']==$key)
                                {{$value}}
                                @php
                                    $isChecked = true;
                                @endphp
                                @break
                            @endif
                        @endforeach
                        @if(!$isChecked)
                            Distance (national)
                        @endif
                    </span>
                    <span class="options-button-icon">
                        <i class="glyphicon glyphicon-menu-down"></i>
                    </span>
                </span>
            </button>
            <div class="collapse in" id="acco-distance">
                <div class="sf-accordion-select-container parents-option">
                    <form action="{{$url}}" >
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
                    </form>
                </div>
            </div>
        </div>
        <!-- <div class="search-form-location-field">
            <div class="select-box">
                <form action="{{$url}}">
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
                    <div class="js-selectbox-label">

                    </div>
                </form>
            </div>
        </div> -->
        @if($category->id >= 4000000000 && $category->id <= 4999999999)
                <div class="l-visible-large">
                    <form action="/user/jobs/apply/all" method="post">
                        <div class="form-group clearfix">
                            <div class="col-sm-offset-6 col-sm-6">
                                <input type="hidden" name="url" value="{{$url}}">
                                {{ csrf_field() }}

                            @foreach($products as $product)
                                    <input type="hidden" name="ids[]" value="{{$product['source_id']}}">
                                    @endforeach
                                <button type="submit" class="btn btn-default">Apply All</button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="l-visible-large">
            <form action="{{$url}}">
                <label for="distance">Salary</label>
                @foreach($input as $key=>$value)
                    <input type="hidden" name="{{$key}}" value="{{$value}}">
                @endforeach
                    <div class="form-group">
                        <label class="control-label" for="sal_minimum">Salary min:</label>
                        <div class="">
                        <input class="form-control" placeholder="Any" type="number" id="sal_minimum" name="sal_minimum" value="@if(isset($input['sal_minimum'])){{$input['sal_minimun']}}@endif" aria-invalid="false">
                    </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="salary_max">Salary max:</label>
                        <div class=""><input class="form-control" placeholder="Any" type="number" name="sal_maximum" value="@if(isset($input['sal_maximum'])){{$input['sal_maximum']}}@endif" aria-invalid="false">
                        </div>
                        </div>
                    <div class="form-group clearfix">
                            <div class="col-sm-offset-6 col-sm-6">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
            </form>
        </div>
        @else
        <div class="flyout-accordion accordion-container">
            <button type="button" class="options-button accordion-options-button" data-toggle="collapse" data-target="acco-price">
                <span class="options-button-inner">
                    <span class="options-button-name">
                        Prices
                    </span>
                    <span class="options-button-value">
                        @if(!isset($input['min_price']) && !isset($input['max_price']))
                            Any
                        @else
                            @if(isset($input['min_price']))
                                £{{$input['min_price']}}
                            @else
                                Any
                            @endif
                             to
                            @if(isset($input['max_price']))
                                £{{$input['max_price']}}
                            @else
                                Any
                            @endif 
                        @endif 
                    </span>
                    <span class="options-button-icon">
                        <i class="glyphicon glyphicon-menu-down"></i>
                    </span>
                </span>
            </button>
            <div class="collapse in" id="acco-price">
                <div class="sf-accordion-select-container price-option">
                    <form action="{{$url}}">
                        @foreach($input as $key=>$value)
                            <input type="hidden" name="{{$key}}" value="{{$value}}">
                        @endforeach
                        <div class="sf-accordion-select-options">
                            <label class="sf-accordion-label" for="min_price">From</label>
                            <input class="js-min-input" placeholder="Min" type="number" id="min_price" name="min_price" value="@if(isset($input['min_price']))£{{$input['min_price']}}@endif" aria-invalid="false">
                        </div>
                        <div class="sf-accordion-select-options">
                             <label class="sf-accordion-label" for="max_price">To</label>
                            <input class="js-max-input" placeholder="Max" type="number" name="max_price" value="@if(isset($input['max_price']))£{{$input['max_price']}}@endif" aria-invalid="false">
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-sm-offset-6 col-sm-6">
                                <button type="submit" class="form-control btn btn-default">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
        @foreach($filters as $filter)
            @if($filter->type === 'list')
            <div style="display: none">
            @php
                //var_dump($filter);
            @endphp
            </div>
            <div class="flyout-list">
                <button type="button" class="options-button">
                    <span class="options-button-inner">
                        <span class="options-button-name">
                            {{$filter->title}}
                        </span>
                        <span class="options-button-value">
                            @foreach($filter->vals as $val)
                                @if($val->selected===1)
                                    {{$val->title}}
                                    <input type="hidden" class="current-filter" name="{{$filter->slug}}" value="{{$val->slug}}">
                                @endif
                            @endforeach
                        </span>
                        <span class="options-button-icon">
                            <i class="glyphicon glyphicon-menu-right"></i>
                        </span>
                    </span>
                </button>
                <div class="flyout">
                    <span class="flyout-arrow"></span>
                    <header class="flyout-header">
                        <h2 class="flyout-title">Select {{$filter->title}}</h2>
                        <div class="right">
                            <button type="button" class="sf-flyout-close"> 
                                Close
                                <i class="glyphicon glyphicon-remove"></i>
                            </button>
                        </div>
                    </header>
                    <div class="sf-flyout-scrollable-options">
                        <div class="sf-flyout-options">
                            @php
                                $totalCol = count($filter->vals) / 3;
                            @endphp
                            <div class="col-sm-4">
                                @for($i = 0; $i < $totalCol; $i++)
                                    <div class="value-button @if($filter->vals[$i]->selected===1) selected @endif">
                                        <span class="term"><a href="{!! $filter->vals[$i]->url !!}">{{$filter->vals[$i]->title}}</a></span>
                                        &nbsp;
                                        <span class="count">({{$filter->vals[$i]->count}})</span>
                                    </div>
                                @endfor
                            </div>
                            <div class="col-sm-4">
                                @for($i; $i < $totalCol * 2; $i++)
                                    <div class="value-button  @if($filter->vals[$i]->selected===1) selected @endif"">
                                        <span class="term"><a href="{!! $filter->vals[$i]->url !!}">{{$filter->vals[$i]->title}}</a></span>
                                        &nbsp;
                                        <span class="count">({{$filter->vals[$i]->count}})</span>
                                    </div>
                                @endfor
                            </div>
                            <div class="col-sm-4">
                                @for($i; $i < count($filter->vals); $i++)
                                    <div class="value-button  @if($filter->vals[$i]->selected===1) selected @endif">
                                        <span class="term"><a href="{!! $filter->vals[$i]->url !!}">{{$filter->vals[$i]->title}}</a></span>
                                        &nbsp;
                                        <span class="count">({{$filter->vals[$i]->count}})</span>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="sf-flyout-clear-button">Clear</div>
                </div>
            </div>
            @elseif($filter->type === 'integer')
            <div class="flyout-accordion accordion-container">
                <button type="button" class="options-button accordion-options-button" data-toggle="collapse" data-target="acco-{{$filter->slug}}">
                    <span class="options-button-inner">
                        <span class="options-button-name">
                            {{$filter->title}}
                        </span>
                        <span class="options-button-value">
                            @foreach($filter->vals as $val)
                                @if($val->selected===1)
                                    {{$val->title}}
                                    <input type="hidden" class="current-filter" name="{{$filter->slug}}" value="{{$val->slug}}">
                                @endif
                            @endforeach
                        </span>
                        <span class="options-button-icon">
                            <i class="glyphicon glyphicon-menu-down"></i>
                        </span>
                    </span>
                </button>
                <div class="collapse" id="acco-{{$filter->slug}}">
                    <div class="sf-accordion-select-container">
                        @foreach($filter->vals as $val)
                            <div class="value-button  @if($val->selected===1) selected @endif"">
                                <span class="term"><a href="{!! $val->url !!}">{{$val->title}}</a></span>
                                &nbsp;
                                <span class="count">({{$val->count}})</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @else
            <div class="l-visible-large">
                @if($filter->title === 'Salary Period')
                    <h4>Salary Bands</h4>
                @else
                    <h4>{{$filter->title}}</h4>
                @endif
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
            @endif
        @endforeach
        @if($category->id >= 1050000000 && $category->id <= 1059999999)
        <div class="flyout-accordion accordion-container">
            <button type="button" class="options-button accordion-options-button" data-toggle="collapse" data-target="acco-mpg">
                <span class="options-button-inner">
                    <span class="options-button-name">
                        Fuel consumption
                    </span>
                    <span class="options-button-value">
                        Any
                    </span>
                    <span class="options-button-icon">
                        <i class="glyphicon glyphicon-menu-down"></i>
                    </span>
                </span>
            </button>
            <div class="collapse" id="acco-mpg">
                <div class="sf-accordion-select-container">
                </div>
            </div>
        </div>
        <div class="flyout-accordion accordion-container">
            <button type="button" class="options-button accordion-options-button" data-toggle="collapse" data-target="acco-mpg">
                <span class="options-button-inner">
                    <span class="options-button-name">
                        Doors
                    </span>
                    <span class="options-button-value">
                        Any
                    </span>
                    <span class="options-button-icon">
                        <i class="glyphicon glyphicon-menu-down"></i>
                    </span>
                </span>
            </button>
            <div class="collapse" id="acco-mpg">
                <div class="sf-accordion-select-container">
                </div>
            </div>
        </div>
        @endif
        </div>
    </div>
</div>
<div class="col-lg-7 col-sm-9 col-xs-12">
    <div class="products">
        @if (session('msg'))
            <span style="color: green">
                                        <strong>{{ session('msg') }}</strong>
                                    </span>
        @endif
        <h4 class="items-box-head">
            List of items for {{$category->title}}, {{number_format($total)}}
        </h4>
        @php
            $i=0;
        @endphp
        <div class="listing-max-pro container-set-alarm clearfix">
            <div class="search-alert-div text-center">
                <a class="btn search-alert" href="/user/create/alert/{{$category->id}}?id={{$location->id}}"><span class="glyphicon glyphicon-bell"></span>&nbsp;&nbsp;Set Search Alert </a>
            </div>
        </div>
        @if($category->can_apply())
        <div class="listing-max-pro container-btns-recruiter text-center">
            <div class="row">
                <div class="col-sm-6 container-btn-recruiter">
                    <a href="#" class="btn-recruiter">Explore Companies</a>
                </div>
                <div class="col-sm-6 container-btn-recruiter border-left">
                    <a href="#" class="btn-recruiter">Search Recruiter</a>
                </div>
            </div>
        </div>
        @endif
        @foreach($products as $product)
        @if($i == 10)
        <div class="listing-max-pro container-emailme">
            <div class="container-emailme-header text-center">
                <h3>Let Us Help With Your Search</h3>
            </div>
            <div class="container-emailme-form text-center">
                <p>Submit and sit back. We'll send you opportunities you'll actually love and some helpful advice to help make the search stress free.</p>
                <div class="row">
                    <div class="col-sm-offset-2 col-sm-8">
                        <form action="" id="sendme-search">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="email-sendme">Email</span>
                                    <input type="text" class="form-control" placeholder="example@email.com" aria-describedby="email-sendme">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="phone-number-2" placeholder="+44 7777777777" aria-describedby="phone-sendme">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit-sendme" class="btn btn-submit">
                            </div>
                        </form>
                    </div>
                </div>
                <small>By clicking Submit, you accept our <a>Terms & Conditions</a>, <a>Privacy policy</a> and consent to messages</small>
            </div>
        </div>
        @endif
        <!--- This is for cars adverts -->
        @if($product['category'] >= 1050000000 && $product['category'] <= 1059999999)
        <div class="listing-max-pro">
            <div class="product product-car">
                <div class="listing-side">
                    <div class="listing-thumbnail">
                        <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{ count($product['images'])>0?$product['images'][0]:"noimage.png"}}" data-src="{{env('AWS_WEB_IMAGE_URL')}}/{{ count($product['images'])>0?$product['images'][0]:"noimage.png"}}" class="lazyload" alt="">
                        <div class="listing-meta txt-sub">
                            <span class="glyphicon glyphicon-camera"> </span> <span class="image-number"> {{count($product['images'])}}</span>
                        </div>
                    </div>
                </div>
                <div class="info">
                    <div class="wrapper-title-product">
                        <a class="listing-product" href="/p/{{$product['category']}}/{{$product['source_id']}}">

                            <h4 class="product-title">{{$product['title']}}</h4>
                        </a>
                    </div>
                    <div class="wrapper-location-product">
                        <span class="listing-location">
                            {{$product['location_name']}}
                        </span>
                    </div>
                    <div class="listing-description">
                        {!! $product['description'] !!}
                    </div>
                    <div class="listing-key-facts">
                        <ul class="list-key-facts">
                            @if(array_key_exists("vehicle_registration_year",$product['meta']))
                            <li>{{$product['meta']['vehicle_registration_year']}}</li>
                            @endif
                            @if(array_key_exists("vehicle_body_type",$product['meta']))
                            <li>{{$product['meta']['vehicle_body_type']}}</li>
                            @endif
                            @if(array_key_exists("vehicle_mileage",$product['meta']))
                            <li>{{number_format($product['meta']['vehicle_mileage'])}} miles</li>
                            @endif
                            @if(array_key_exists("vehicle_transmission",$product['meta']))
                            <li>{{$product['meta']['vehicle_transmission']}}</li>
                            @endif
                            @if(array_key_exists("vehicle_engine_size",$product['meta']))
                            <li>{{number_format($product['meta']['vehicle_engine_size'] / 1000, 2, ".", ",")}} L</li>
                            @endif 
                            @if(array_key_exists("key_facts",$product['meta']) && array_key_exists("Engine power",$product['meta']['key_facts']))
                                <li class="uppercase">{{$product['meta']['key_facts']["Engine power"]}}</li>
                            @endif
                                @if(array_key_exists("vehicle_fuel_type",$product['meta']))

                                <li>{{$product['meta']['vehicle_fuel_type']}}</li>
                                    @endif
                        </ul>
                    </div>
                @if(isset($product['featured'])&&$product['featured']===1&&$product['featured_expires']>$milli&&isset($product['featured_x']))
                @else
                    <span class="posted-text">{{$product['posted']}}</span>
                @endif
            </div>
        </div>
        <div class="wrapper-price-brand">
             @if($product['meta']['price']>=0)
             <div class="wrapper-price-product">
                <span class="product-price">£ {{number_format($product['meta']['price']/100)}}{{isset($product['meta']['price_frequency']) ? $product['meta']['price_frequency']:''}}
                </span>
            </div>
            <div class="ribbons-price">
                @if($product['price_type'] == 'great_price')
                <span class="ribbon ribbon-price-great">
                    <div class="wrapper-ribbon">
                        <span class="ribbon-text">
                            Great Price
                        </span>
                        <div class="tooltip tooltip-price-great  tooltip-arrow-upRight js-tooltip-window">
                            <div class="tooltip-content">
                                <h3 class="search-result-valueIndicatorTitle">Why is this car a great price?</h3>
                                <span>{{env('APP_NAME')}} has price-checked this car against the market value for similar cars and identified it as a great price.</span>
                            </div>
                            <div class="tooltip-close js-close"></div>
                        </div>
                    </div>
                </span>
                <span class="price-based-on">Based on similar cars</span>
                @elseif($product['price_type'] == 'good_price')
                <span class="ribbon ribbon-price-good">
                    <div class="wrapper-ribbon">
                        <span class="ribbon-text">
                            Good Price
                        </span>
                        <div class="tooltip  tooltip-arrow-upRight js-tooltip-window">
                            <div class="tooltip-content">
                                <h3 class="search-result-valueIndicatorTitle">Why is this car a good price?</h3>
                                <span>{{env('APP_NAME')}} has price-checked this car against the market value for similar cars and identified it as a good price.</span>
                            </div>
                            <div class="tooltip-close js-close"></div>
                        </div>
                    </div>
                </span>
                <span class="price-based-on">Based on similar cars</span>
                @elseif($product['price_type'] == 'price_reduced')
                <span class="ribbon ribbon-price-reduced">
                    <div class="wrapper-ribbon">
                        <span class="ribbon-text">
                            Price Reduced
                        </span>
                        <div class="tooltip tooltip-price-reduce  tooltip-arrow-upRight js-tooltip-window">
                            <div class="tooltip-content">
                                <h3 class="search-result-valueIndicatorTitle">Why is this car price reduced?</h3>
                                <span>{{env('APP_NAME')}} has price-checked this car against the market value for similar cars and identified it as priced low.</span>
                            </div>
                            <div class="tooltip-close js-close"></div>
                        </div>
                    </div>
                </span>
                    <span class="price-based-on">Based on similar cars</span>
                    @endif
                    <div class="ratings">
                        <div class="stars">
                            <span>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                            </span>
                        </div>
                    </div>
            </div>
            @endif
        </div>
        <div class="clearfix extra-info">
            <hr>
            <div class="ribbons">
                @if(isset($product['sold']) && $product['sold'] == 1)
                    <span class="ribbon sold">
                       Sold
                    </span>
                @else
                    @if(isset($product['spotlight'])&&$product['spotlight']===1&&$product['spotlight_expires']>$milli)
                    <span class="ribbon ribbon-spotlight">
                        <strong class="" data-q="featuredProduct"><span class="hide-visually">This ad is</span>Spotlight</strong> 
                    </span>
                    @endif
                    @if(isset($product['featured'])&&$product['featured']===1&&$product['featured_expires']>$milli&&isset($product['featured_x']))
                        <span class="ribbon ribbon-featured">
                            <strong class="" data-q="featuredProduct"><span class="hide-visually">This ad is</span>Featured</strong> 
                        </span>
                    @endif
                    @if(isset($product['urgent'])&&$product['urgent']===1&&$product['urgent_expires']>$milli)
                        <span class="ribbon urgent-span">
                            <span class="ribbon-text">
                            Urgent
                            </span>
                        </span>
                    @endif
                    @if(isset($product['canship'])&&$product['canship']===1)
                        <span class="ribbon ribbon-shipping">
                            <strong class="ship-ribbon" data-q="featuredProduct"><span class="hide-visually">This ad is</span>Can Ship</strong>
                        </span>
                    @endif
                    @if(isset($product['candeliver'])&&$product['candeliver']===1)
                        <span class="ribbon ribbon-delivery">
                            <strong class="deliver-ribbon" data-q="featuredProduct"><span class="hide-visually">This ad is</span>Local Delivery</strong>
                        </span>
                    @endif
                @endif
            </div>
            <div class="extra-options">
                <div class="make-offer">
                    <a href="#">
                    <div class="circle">
                        <div class="text-offer">
                            <span>Make an offer</span>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="favor-car">
                    <div class="favor">
                        @if (in_array($product['source_id'],$sids))
                            <span class="heart favroite-icon" data-id="{{$product['source_id']}}"></span>
                            <span  class="favor-text" style="display: none">SAVE</span>
                        @else
                            <span class="heart-empty favroite-icon" data-id="{{$product['source_id']}}">
                            </span>
                            <span  class="favor-text">SAVE</span>
                        @endif
                    </div>
                </div>
                <div class="brand-logo-container">

                </div>
            </div>
        </div>
    </div>
    <!-- End cars adverts -->
    @else
        
        <div class="listing-max-pro">
            <div class="product">
                @if($product['category'] < 4000000000 || $product['category'] > 4999999999)
                <div class="listing-side">
                    <div class="listing-thumbnail">
                        <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{ count($product['images'])>0?$product['images'][0]:"noimage.png"}}" data-src="{{env('AWS_WEB_IMAGE_URL')}}/{{ count($product['images'])>0?$product['images'][0]:"noimage.png"}}" class="lazyload" alt="">

                        <!-- @if(isset($product['featured'])&&$product['featured']===1&&$product['featured_expires']>$milli&&isset($product['featured_x']))
                            <span class="ribbon-featured">
                                <strong class="ribbon" data-q="featuredProduct"><span class="hide-visually">This ad is</span>Featured</strong>
                            </span>
                        @endif -->
                        <div class="listing-meta txt-sub">
                            <span class="glyphicon glyphicon-camera"> </span> <span class="image-number"> {{count($product['images'])}}</span>
                        </div>
                    </div>
                </div>
                @else
                    @if(isset($product['featured'])&&$product['featured']===1&&$product['featured_expires']>$milli&&isset($product['featured_x']))
                        <span class="ribbon-featured">
                            <strong class="ribbon-job" data-q="featuredProduct"><span class="hide-visually">This ad is</span>Featured</strong>
                        </span>
                    @endif
                @endif
                <div class="info{{($product['category'] >= 4000000000 && $product['category'] <= 4999999999) ? ' margin-left' :''}}">
                    <div class="favor">
                        @if (in_array($product['source_id'],$sids))
                            <span class="heart favroite-icon" data-id="{{$product['source_id']}}"></span>
                            <span  class="favor-text" style="display: none">SAVE</span>
                        @else
                            <span class="heart-empty favroite-icon" data-id="{{$product['source_id']}}">
                            </span>
                            <span  class="favor-text">SAVE</span>

                        @endif
                    </div>
                    <div class="wrapper-title-product">
                        @if($category->id >= 4000000000 && $category->id <= 4999999999)
                            <input type="checkbox" name="ids[]" value="{{$product['source_id']}}">
                        @endif
                        <a class="listing-product" href="/p/{{$product['category']}}/{{$product['source_id']}}"> 
                            <h4 class="product-title">{{$product['title']}}</h4>
                        </a>
                    </div>
                    @if($product['category'] >= 1050000000 && $product['category'] <= 1059999999)
                    <div class="wrapper-price-product">
                        @if($product['meta']['price']>=0)
                            <span class="product-price">£ {{number_format($product['meta']['price']/100)}}{{isset($product['meta']['price_frequency']) ? $product['meta']['price_frequency']:''}}
                            </span>
                        @endif
                    </div>
                    @endif
                    <div class="wrapper-location-product">
                        <span class="listing-location">
                            {{$product['location_name']}}
                        </span>
                    </div>
                    @if($product['category'] < 4000000000 || $product['category'] > 4999999999)
                        <div class="listing-description">
                            {!! $product['description'] !!}
                        </div>
                        @if($product['category'] >= 1050000000 && $product['category'] <= 1059999999)
                        <div class="listing-key-facts">
                            <ul class="list-key-facts">
                                @if(array_key_exists("vehicle_registration_year",$product['meta']))
                                <li>{{$product['meta']['vehicle_registration_year']}}</li>
                                @endif
                                @if(array_key_exists("vehicle_body_type",$product['meta']))
                                <li>{{$product['meta']['vehicle_body_type']}}</li>
                                @endif
                                @if(array_key_exists("vehicle_mileage",$product['meta']))
                                <li>{{number_format($product['meta']['vehicle_mileage'])}} miles</li>
                                @endif
                                @if(array_key_exists("vehicle_transmission",$product['meta']))
                                <li>{{$product['meta']['vehicle_transmission']}}</li>
                                @endif
                                @if(array_key_exists("vehicle_engine_size",$product['meta']))
                                <li>{{number_format($product['meta']['vehicle_engine_size'] / 1000, 2, ".", ",")}} L</li>
                                @endif 
                                @if(array_key_exists("key_facts",$product['meta']) && array_key_exists("Engine power",$product['meta']['key_facts']))
                                    <li class="uppercase">{{$product['meta']['key_facts']["Engine power"]}}</li>
                                @endif
                                    @if(array_key_exists("vehicle_fuel_type",$product['meta']))

                                    <li>{{$product['meta']['vehicle_fuel_type']}}</li>
                                        @endif
                            </ul>
                        </div>
                    @endif
                    @else
                        <div class="link-details">
                            <a href="/p/{{$product['category']}}/{{$product['source_id']}}">> VIEW FULL POSTING</a>
                        </div>
                    @endif
                    @if($product['category'] < 1050000000 || $product['category'] > 1059999999)
                        @if($product['meta']['price']>=0)
                            <span class="product-price">£ {{number_format($product['meta']['price']/100)}}{{isset($product['meta']['price_frequency']) ? $product['meta']['price_frequency']:''}}
                            </span>
                        @endif
                    @endif
                @if(isset($product['featured'])&&$product['featured']===1&&$product['featured_expires']>$milli&&isset($product['featured_x']))
                @else
                    <span class="posted-text">{{$product['posted']}}</span>
                @endif
            </div>
        </div>
        <div class="clearfix extra-info">
            <hr>
             @if($product['category'] < 4000000000 || $product['category'] > 4999999999)
                <div class="ribbons">
                    @if(isset($product['sold']) && $product['sold'] == 1)
                        <span class="ribbon sold">
                           Sold
                        </span>
                    @else
                        @if(isset($product['spotlight'])&&$product['spotlight']===1&&$product['spotlight_expires']>$milli)
                        <span class="ribbon ribbon-spotlight">
                            <strong class="" data-q="featuredProduct"><span class="hide-visually">This ad is</span>Spotlight</strong> 
                        </span>
                        @endif
                        @if(isset($product['featured'])&&$product['featured']===1&&$product['featured_expires']>$milli&&isset($product['featured_x']))
                            <span class="ribbon ribbon-featured">
                                <strong class="" data-q="featuredProduct"><span class="hide-visually">This ad is</span>Featured</strong> 
                            </span>
                        @endif
                        @if(isset($product['urgent'])&&$product['urgent']===1&&$product['urgent_expires']>$milli)
                            <span class="ribbon urgent-span">
                                <span class="ribbon-text">
                                Urgent
                                </span>
                            </span>
                        @endif
                        @if(isset($product['canship'])&&$product['canship']===1)
                            <span class="ribbon ribbon-shipping">
                                <strong class="ship-ribbon" data-q="featuredProduct"><span class="hide-visually">This ad is</span>Can Ship</strong>
                            </span>
                        @endif
                        @if(isset($product['candeliver'])&&$product['candeliver']===1)
                            <span class="ribbon ribbon-delivery">
                                <strong class="deliver-ribbon" data-q="featuredProduct"><span class="hide-visually">This ad is</span>Local Delivery</strong>
                            </span>
                        @endif
                    @endif
                    @if($product['category'] >= 1050000000 && $product['category'] <= 1059999999)
                        <span class="ribbon ribbon-price-reduced">
                            <span class="ribbon-text">
                                Price Reduced
                            </span>
                        </span>
                        <div class="tooltip tooltip-price-reduce  tooltip-arrow-upRight js-tooltip-window">
                            <div class="tooltip-content">
                                <h3 class="search-result-valueIndicatorTitle">Why is this car price reduced?</h3>
                                <span>{{env('APP_NAME')}} has price-checked this car against the market value for similar cars and identified it as priced low.</span>
                            </div>
                            <div class="tooltip-close js-close"></div>
                        </div>
                        <span class="ribbon ribbon-price-good">
                            <span class="ribbon-text">
                                Good Price
                            </span>
                        </span>
                        <div class="tooltip  tooltip-arrow-upRight js-tooltip-window">
                            <div class="tooltip-content">
                                <h3 class="search-result-valueIndicatorTitle">Why is this car a good price?</h3>
                                <span>{{env('APP_NAME')}} has price-checked this car against the market value for similar cars and identified it as a good price.</span>
                            </div>
                            <div class="tooltip-close js-close"></div>
                        </div>
                        <span class="ribbon ribbon-price-great">
                            <span class="ribbon-text">
                                Great Price
                            </span>
                        </span>
                        <div class="tooltip tooltip-price-great  tooltip-arrow-upRight js-tooltip-window">
                            <div class="tooltip-content">
                                <h3 class="search-result-valueIndicatorTitle">Why is this car a great price?</h3>
                                <span>{{env('APP_NAME')}} has price-checked this car against the market value for similar cars and identified it as a great price.</span>
                            </div>
                            <div class="tooltip-close js-close"></div>
                        </div>
                    @endif
                </div>
                <div class="extra-options">
                    <div class="make-offer">
                        <a href="#">
                        <div class="circle">
                            <div class="text-offer">
                                <span>Make an offer</span>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="ratings">
                        <div class="stars">
                            <span>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                            </span>
                        </div>
                    </div>
                </div>
            @else
                <div class="link-details">
                    <a href="/p/{{$product['category']}}/{{$product['source_id']}}">> LEARN MORE ABOUT THIS ADVERTISER</a>
                </div>
            @endif
        </div>
    </div>
    @endif
    @php
        $i = $i + 1;
    @endphp
    @endforeach
    
    <div class="listing-max-pro container-emailme">
        <div class="container-emailme-header text-center">
            <h3>Let Us Help With Your Search</h3>
        </div>
        <div class="container-emailme-form text-center">
            <p>Submit and sit back. We'll send you opportunities you'll actually love and some helpful advice to help make the search stress free.</p>
            <div class="row">
                <div class="col-sm-offset-2 col-sm-8">
                    <form action="" id="sendme-search">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="email-sendme">Email</span>
                                <input type="text" class="form-control" placeholder="example@email.com" aria-describedby="email-sendme">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="tel" id="phone-number-1" class="form-control" placeholder="00447777777777" aria-describedby="phone-sendme">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit-sendme" class="btn btn-submit">
                        </div>
                    </form>
                </div>
            </div>
            <small>By clicking Submit, you accept our <a>Terms & Conditions</a>, <a>Privacy policy</a> and consent to messages</small>
        </div>
    </div>


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
    <div class="col-md-2 col-sm-12 col-xs-12">
    </div>
        </div>
    </div>
</div>
</div>


@endsection

@section('scripts')
<script src="/build/js/intlTelInput.js"></script>
<script>
    $("#phone-number-2").intlTelInput();
    $("#phone-number-1").intlTelInput();
    $('.flyout-list .options-button').click(function(){
        if(!$(this).next().hasClass('is-in')){
            $('.flyout').removeClass('is-in is-visible');
        }
        $(this).next().toggleClass('is-in is-visible');
    });
    $('.flyout-accordion .options-button').click(function(){
        $(this).closest('.flyout-accordion').toggleClass('expanded');
        $(this).next().collapse('toggle'); 
    });
    $('.sf-flyout-close').click(function(){
        $(this).closest('.flyout').toggleClass('is-in is-visible');
    });
    $('.sf-flyout-clear-button').click(function(){
        var element = $(this).closest('.flyout-list').find('.current-filter');
        var currentFilter = element.val();
        var filter = element.attr('name');
        currentFilter = filter + '=' + currentFilter;
        var currentUrl = window.location.href;
        var cleanUrl = currentUrl.replace(currentFilter, '');
        window.location.href = cleanUrl; 
    });
    /*$('.flyout-list .options-button.accordion-options-button').click(function(e){
        e.preventDefault();
        $('.collapse').collapse();
    });*/
</script>
@endsection
