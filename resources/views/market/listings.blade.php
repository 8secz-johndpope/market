<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')


<div class="row">
    <div class="col-md-2 col-md-offset-1">

        <div class="l-visible-large">
            <h4> Location</h4>
            <form action="{{$url}}" >
                @foreach($input as $key=>$value)
                    @if($key!=='lat'&&$key!=='lng')
                        <input type="hidden" name="{{$key}}" value="{{$value}}">
                    @endif
                @endforeach
                <input type="hidden" id="lat" name="lat" value="{{$lat}}">
                <input type="hidden" id="lng" name="lng" value="{{$lng}}">
                <input id="pac-input" class="controls" type="text" placeholder="Postcode or location" name="location" value="@if(isset($input['location'])) {{$input['location']}} @endif" required>
                <button type="submit" class="btn btn-primary btn-full-width">Go</button>
            </form>
        </div>
        <div class="l-visible-large">
            <h4>Distance</h4>
            <form action="{{$url}}" >
                @foreach($input as $key=>$value)
                    @if($key!=='distance')
                        <input type="hidden" name="{{$key}}" value="{{$value}}">
                    @endif
                @endforeach
                <select data-autosubmit="" name="distance" id="distanceRefine" aria-invalid="false"  onchange="this.form.submit()">
                    @foreach($distances as $key=>$value)
                        <option value="{{$key}}" @if(isset($input['distance'])&&$input['distance']==$key)) selected @endif>
                            {{$value}}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="l-visible-large">
            <h4> Sort By:</h4>
            <form action="{{$url}}" >
                @foreach($input as $key=>$value)
                    @if($key!=='sort')
                        <input type="hidden" name="{{$key}}" value="{{$value}}">
                    @endif
                @endforeach
                <select name="sort" data-autosubmit="" data-analytics="gaEvent:SRP-sortlistings,defer:true" aria-invalid="false" onchange="this.form.submit()">
                    @foreach($sorts as $st)
                        <option value="{{$st->key}}" @if(isset($input['sort'])&&$input['sort']===$st->key)) selected @endif>{{$st->title}}</option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="l-visible-large">
            <h4>Price</h4>
            <form action="{{$url}}"  class="form-horizontal">
                @foreach($input as $key=>$value)
                    <input type="hidden" name="{{$key}}" value="{{$value}}">
                @endforeach
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="min_price">Minimum Price:</label>
                        <div class="col-sm-4">
                        <input placeholder="Min" type="number" id="min_price" name="min_price" value="@if(isset($input['min_price'])){{$input['min_price']}}@endif" aria-invalid="false">
                    </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="max_price">Maximum Price:</label>
                        <div class="col-sm-4"><input placeholder="Max" type="number" name="max_price" value="@if(isset($input['max_price'])){{$input['max_price']}}@endif" aria-invalid="false"><span class="icn-clear txt-quaternary clear-input is-visible"></span></span>
                        </div>
                        </div>
                    <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
            </form>
        </div>
        @foreach($filters as $filter)
            <div class="l-visible-large">
                <h4>{{$filter->title}}</h4>
                <ul>
                    @foreach($filter->vals as $val)
                        @if($val->selected===1)
                            <li>{{$val->title}}</li>
                        @else
                            <li><a href="{!! $val->url !!}">{{$val->title}}</a>&nbsp;&nbsp;{{$val->count}}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
    <div class="col-md-9">
        <section class="items-box-container clearfix">
            <h2 class="items-box-head">
                List of items for {{$last}}, {{$total}}

            </h2>


            <div class="masonry">

            @foreach($products as $product)
                    <div class="item">

                                <img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{ count($product['images'])>0?$product['images'][0]:"noimage.png"}}" class="lazyload" alt="The north Face Men&#039;s Size 34 Pants">

                            <div class="items-box-body">
                                <a href="/p/{{$product['category']}}/{{$product['source_id']}}"> <h4 class="items-box-name font-2">{{$product['title']}}</h4>  </a>
                                <div class="items-box-num clearfix">
                                    @if($product['meta']['price']>=0)
                                        <div class="items-box-price font-5">£ {{$product['meta']['price']/100}}{{isset($product['meta']['price_frequency']) ? $product['meta']['price_frequency']:''}}</div>
                                    @endif
                                </div>
                            </div>

                    </div>
                @endforeach



            </div>
        </section>
        <ul class="pager">
            @if($page!=1)
                <li class="pager-prev visible-pc">
                    <ul>
                        <li class="pager-cell">
                            <a href="{{$pageurl}}&page=1">
                                <i class="icon-arrow-double-left"></i>
                            </a>
                        </li>
                        <li class="pager-cell">
                            <a href="{{$pageurl}}&page={{$page-1}}">
                                <i class="icon-arrow-left"></i>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <li class="pager-num">
                <ul>
                    @foreach($pages as $p)
                        <li class="pager-cell {{$page==$p?'active':''}}">
                            @if($page===$p)
                                {{$p}}
                            @else
                                <a href="{{$pageurl}}&page={{$p}}">{{$p}}</a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </li>
            @if($page!=$max)
                <li class="pager-next visible-pc">
                    <ul>
                        <li class="pager-cell">
                            <a href="{{$pageurl}}&page={{$page+1}}">
                                <i class="icon-arrow-right"></i>
                            </a>
                        </li>
                        <li class="pager-cell">
                            <a href="{{$pageurl}}&page={{$max}}">
                                <i class="icon-arrow-double-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
    <div class="col-md-3">

    </div>
</div>




@endsection
