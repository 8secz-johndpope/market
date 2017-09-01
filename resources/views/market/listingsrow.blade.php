<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.home')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<script>
    //var $container = $('.listing-description');
    $('p.listing-description'). each(function( index ) {
        var $text = $(this);
        var originalText = $text.text();
        var temp = originalText;
        if( 200 < $text.outerHeight() ) {
        
            while(200 < $text.outerHeight()) {
                $text.text( temp = temp.substr(0, temp.length-1) );
            }   
            $text.text( temp = temp.substr(0, temp.length-3) );
            $text.append('...');
        }
    });
</script>

<div class="row">
    <div class="col-md-2 col-md-offset-1">
        <div class="l-visible-large">
            <ul>
                @foreach($parents as $parent)
                    <li><a href="/{{$parent->slug}}">{{$parent->title}}</a>&nbsp;&nbsp;</li>
                @endforeach
            </ul>
        </div>
        <div class="l-visible-large">
            <h4>{{$category->title}}</h4>
            <ul>
                @foreach($categories as $cat)
                        <li><a href="/{{$cat->slug}}">{{$cat->title}}</a>&nbsp;&nbsp;{{$cat->count}}</li>
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
    <div class="col-md-8">
        <section class="items-box-container clearfix">
            <h2 class="items-box-head">
                List of items for {{$category->title}}, {{$total}}

            </h2>


            <div class="col-md-12">

            @foreach($products as $product)
                    <div class="item">
                     <a class="listing-product" href="/p/{{$product['category']}}/{{$product['source_id']}}"> 
                        <div class="listing-img">
                            <div class="main-img">
                                <img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{ count($product['images'])>0?$product['images'][0]:"noimage.png"}}" class="lazyload" alt="">
                                <div class="listing-meta">
                                </div>
                            </div>
                        </div>
                        <div class="items-box-body listing-content">
                            <h4 class="items-box-name font-2">{{$product['title']}}</h4>
                            <div class="listing-location">
                                {{$product['location_name']}}
                            </div>
                            <p class="listing-description">
                                {{$product['description']}}
                            </p>
                            <div class="items-box-num clearfix">
                                @if($product['meta']['price']>=0)
                                    <div class="items-box-price font-5">£ {{$product['meta']['price']/100}}{{isset($product['meta']['price_frequency']) ? $product['meta']['price_frequency']:''}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
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
