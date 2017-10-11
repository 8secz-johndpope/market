<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <style>
        .select-category-link{
            display: none;
        }
    </style>


    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10  nopadding">






            <div class="panel panel-default selected-category-panel"  >
                <div class="panel-heading">
                    <h3 class="panel-title">Category</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-11"><span class="category-sting"> {{$advert->category->pstring()}} > <span class="select-category"> {{$advert->category->title}}    </span> </span> </div>
                        <div class="col-sm-1">
                            <span class="glyphicon glyphicon-lock"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default selected-location-panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Location</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-11 location-selected">
                            <span class="extra-large">{{$advert->postcode->postcode}} </span>
                        </div>
                        <div class="col-sm-1">
                            <span class="glyphicon glyphicon-lock"></span>
                        </div>


                    </div>
                </div>
            </div>
            <form action="/user/advert/save" method="post" id="advert-form">
                <input type="hidden" name="id" value="{{$advert->id}}" id="id">
                {{ csrf_field() }}
                <div class="all-panels" >

                    <div class="panel panel-default title-panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Title</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row"> <div class="col-sm-6"><input type="text" name="title" class="form-control  mb-2 mr-sm-2 mb-sm-0" placeholder="Title" value="{{$advert->param('title')}}" required></div>
                                <div class="col-sm-6"><p>100 characters remaining</p></div></div>
                        </div>
                    </div>


                    <div class="panel panel-default description-panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Description</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6"><textarea type="text" name="description" rows="10" class="form-control  mb-2 mr-sm-2 mb-sm-0" required>{{$advert->param('description')}}</textarea></div>
                                <div class="col-sm-6"><p>10000 characters remaining (12 words minimum).
                                        Enter as much information possible; ads with detailed and longer descriptions get more views and replies!
                                    </p></div>

                            </div>
                        </div>
                    </div>





                    <div class="panel panel-success images-panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Add Image</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row row-images ui-sortable"  id="sortable">
                                @foreach($advert->param('images') as $image)
                                    <div class="col-sm-3 single-image ui-state-default ui-sortable-handle"><div class="cross-mark">X</div> <input type="hidden" name="images[]" value="{{$image}}"><img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{$image}}"></div>
                                    @endforeach
                                <div class="col-sm-3">
                                    <a ><img src="/css/addimage.png" class="add-image" style="cursor: pointer"></a>
                                    <input type="file" id="file-chooser" style="display: none">
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="category-extras" style="display: block">
                            @if($advert->category->has_price())
                                <div class="panel panel-default price-panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Price</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="input-group">

                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-gbp"></i></span>
                                                    <input type="number" name="price" class="form-control  mb-2 mr-sm-2 mb-sm-0" placeholder="Price" required value="{{$advert->price()}}" step="1">

                                                </div>
                                            </div>

                                            <div class="col-sm-6"></div></div>
                                    </div>
                                </div>
                            @endif

                                <div class="panel panel-default extra-options-panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Select Options</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    @foreach($advert->category->fields as $field)
                                                        @if($field->slug!=='price')
                                                            <div class="col-sm-6">
                                                                <span class="extra-title">{{$field->title}}</span>
                                                                @if($field->type==='integer')
                                                                    <input class="form-control" type="text" name="{{$field->slug}}" required value="{{$advert->meta($field->slug)}}">
                                                                @elseif($field->type==='list')
                                                                    <select class="form-control" name="{{$field->slug}}">
                                                                        @foreach($field->values as $value)
                                                                            <option value="{{$value->slug}}" @if($value->slug===$advert->meta($field->slug)) selected @endif>{{$value->title}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                @else
                                                                    <input class="form-control" type="text" name="{{$field->slug}}" required  value="{{$advert->meta($field->slug)}}">
                                                                @endif
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="extra-prices" style="display: block">
                            <div class="panel panel-default featured-panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Make your ad stand out!</h3>
                                </div>
                                <div class="panel-body">
                                    <ul class="list-group">

                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                @if($advert->urgent_expires())
                                                                    <input  type="hidden" name="urgent" value="0" id="urgent">
                                                                    <span class="glyphicon glyphicon-lock"></span>
                                                                @else
                                                                <input class="form-check-input extra-change" type="checkbox" name="urgent" value="1" id="urgent">
                                                                @endif
                                                                <span class="span-urgent">Urgent</span> &nbsp;Let people know you want to sell, rent or hire quickly.
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        @if($advert->urgent_expires())
                                                            <span class="extra-price"> {{$advert->urgent_expires()}} days left</span>
                                                        @else
                                                            <span class="extra-price"> @if($advert->has_pack('urgent')) Included in Package  @else £{{$advert->extra_price('urgent')/100}} @endif</span>
                                                            <input type="hidden" id="urgent-price" value="@if($advert->has_pack('urgent'))0@else{{$advert->extra_price('urgent')/100}}@endif" name="urgent-price">
                                                            @endif

                                                    </div>
                                                </div>

                                            </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            @if($advert->featured_expires())
                                                                <input  type="hidden" name="featured" value="0" id="featured">
                                                                <span class="glyphicon glyphicon-lock"></span>
                                                            @else
                                                            <input class="form-check-input extra-change" type="checkbox" name="featured" value="1" id="featured">
                                                            @endif
                                                            <span class="span-featured">Featured</span> &nbsp;Have your Ad appear at the top of the category listings for 3, 7 or 14 days.
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    @if($advert->featured_expires())
                                                        <span class="extra-price"> {{$advert->featured_expires()}} days left</span>
                                                    @else

                                                        <select class="form-control extra-change" name="featured_type" id="featured_type">

                                                                <option value="featured_3">Featured (3 days)  ( @if($advert->has_pack('featured_3')) Included in Package  @else £{{$advert->extra_price('featured_3')/100}} @endif )</option>
                                                            <option value="featured" selected>Featured (7 days)  ( @if($advert->has_pack('featured')) Included in Package  @else £{{$advert->extra_price('featured')/100}} @endif )</option>
                                                            <option value="featured_14">Featured (14 days)  ( @if($advert->has_pack('featured_14')) Included in Package  @else £{{$advert->extra_price('featured_14')/100}} @endif )</option>

                                                        </select>
                                                        @endif

                                                </div>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            @if($advert->spotlight_expires())
                                                                <input  type="hidden" name="spotlight" value="0" id="spotlight">
                                                                <span class="glyphicon glyphicon-lock"></span>
                                                            @else
                                                            <input class="form-check-input extra-change" type="checkbox" name="spotlight" value="1" id="spotlight">
                                                            @endif
                                                            <span class="span-spotlight">Spotlight</span> &nbsp; Have your Ad seen on the Sumra homepage!
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    @if($advert->spotlight_expires())
                                                        <span class="extra-price"> {{$advert->spotlight_expires()}} days left</span>
                                                    @else
                                                    <span class="extra-price"> @if($advert->has_pack('spotlight')) Included in Package  @else £{{$advert->extra_price('spotlight')/100}} @endif</span>
                                                    <input type="hidden" id="urgent-price" value="@if($advert->has_pack('spotlight'))0@else{{$advert->extra_price('spotlight')/100}}@endif" name="urgent-price">
                                                    @endif
                                                </div>
                                            </div>

                                        </li>
                                        @if($advert->category->can_ship())
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input extra-change" type="checkbox" name="shipping" value="1" id="shipping" @if($advert->has_param('shipping')) checked @endif>
                                                            <span class="span-shipping">Shipping</span> &nbsp;Ship to the buyer when order is placed.
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">

                                                    <select class="form-control extra-change" name="shipping_type" id="shipping_type">
                                                        @foreach($shippings as $shipping)
                                                            <option value="{{$shipping->key}}">Shipping (2kg)  ( @if($advert->has_pack($shipping->key)) Included in Package  @else £{{$advert->extra_price($shipping->key)/100}} @endif )</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>

                                        </li>
                                            @endif

                                    </ul>
                                </div>
                            </div>

                        </div>

                    <div class="panel panel-success total-panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Total</h3>
                        </div>
                        <div class="panel-body">
                            £<span class="total-price">0.00</span>
                            <input type="hidden" value="0" name="total" id="total-price">
                        </div>
                    </div>



                    <div class="panel panel-info post-panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"></h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-2 col-sm-offset-10"><button type="submit" class="btn btn-primary" name="update" value="1">Update Advert</button> </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>
    </div>
@endsection