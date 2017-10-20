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

            <div class="panel panel-default automatic-category-panel" @if($advert->category_id>0) style="display: none" @endif>
                <div class="panel-heading">
                    <h3 class="panel-title">Category</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tell us what you are posting:</label>
                                <input type="text" class="form-control posting-string" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex, iPhone, Samsung">
                            </div>

                        </div>
                        <div class="col-sm-12">
                            <h4>Suggested Categories</h4>
                            <ul class="list-group category-suggest">

                            </ul>
                        </div>
                        <div class="col-sm-12">
                            <a class="browse-category">Or browse to find a category</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default  manual-category-panel"   style="display: none">
                <div class="panel-heading">
                    <h3 class="panel-title">Select Category</h3>
                </div>
                <div class="panel-body">
                    @foreach($categories as $cat)
                        <div class="main-category" data-category="{{$cat->id}}">
                            {{$cat->title}}
                        </div>
                    @endforeach
                    <div class="row nomargin">
                        <div class="col-lg-3 sub-category">
                            <ul class="list-group category-level-1  nomargin">

                            </ul>
                        </div>
                        <div class="col-lg-3 sub-category">
                            <ul class="list-group category-level-2  nomargin">

                            </ul>
                        </div>
                        <div class="col-lg-3 sub-category">
                            <ul class="list-group category-level-3  nomargin">

                            </ul>
                        </div>
                        <div class="col-lg-3 sub-category">
                            <ul class="list-group category-level-4  nomargin">

                            </ul>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 30px;margin-bottom: 30px">
                        <div class="col-sm-1 col-sm-offset-11">
                            <a class="btn btn-danger" disabled id="continue-button">Continue</a>
                        </div>
                    </div>
                </div>
            </div>
            <form action="/user/advert/category/change" method="post" id="change-category">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$advert->id}}">
                <input type="hidden" name="category" value="0" id="category">
            </form>


            <div class="panel panel-default selected-category-panel"  @if($advert->category_id===0) style="display: none" @endif>
                <div class="panel-heading">
                    <h3 class="panel-title">Category</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-11"><span class="category-sting">@if($advert->category_id>0) {{$advert->category->pstring()}}   > <span class="select-category"> {{$advert->category->title}} </span> @endif</span> </div>
                        <div class="col-sm-1">
                            <a class="btn btn-default edit-category">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default selected-location-panel" @if($advert->category_id===0) style="display: none" @endif>
                <div class="panel-heading">
                    <h3 class="panel-title">Location</h3>
                </div>
                <div class="panel-body">
                    <div class="row">

                        <div class="col-sm-12 location-selected" @if($advert->postcode_id===0) style="display: none" @endif>
                            <p>Your Location</p>
                            <span class="extra-large"> @if($advert->postcode_id>0){{$advert->postcode->postcode}} @endif</span><a class="edit-location-button">(Edit)</a>
                        </div>


                        <div class="col-sm-12 edit-location" @if($advert->postcode_id>0) style="display: none" @endif>
                            <input type="hidden" name="location_name" value="London" id="location_name">
                            <input type="hidden" name="location_id" value="London" id="location_id">

                            <input type="hidden" name="lat" value="52.0" id="lat">
                            <input type="hidden" name="lng" value="0.12" id="lng">
                            @if($advert->postcode_id<0)
                                <span class="red-text" id="location-error-info" >Invalid Postcode</span>
                            @endif

                            <form class="form-inline" action="/user/advert/location/change" method="post" id="change-location">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{$advert->id}}">

                                <label class="sr-only" for="inlineFormInput">Postcode</label>
                                <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="postcode-text" placeholder="Postcode" name="postcode">
                                <button class="btn btn-danger" type="submit">Go</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
            @if($advert->category_id>0&&$advert->postcode_id>0)
            <form action="/user/advert/save" method="post" id="advert-form">
                <input type="hidden" name="id" value="{{$advert->id}}" id="id">
                <input type="hidden" name="category" value="{{$advert->category_id}}" id="id">

                {{ csrf_field() }}
                <div class="all-panels" >

                    <div class="panel panel-default title-panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Title</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row"> <div class="col-sm-6"><input type="text" name="title" class="form-control  mb-2 mr-sm-2 mb-sm-0" placeholder="Title" value="{{$advert->param('title')}}" ></div>
                                <div class="col-sm-6"><p>100 characters remaining</p></div></div>
                        </div>
                    </div>


                    <div class="panel panel-default description-panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Description</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6"><textarea type="text" name="description" rows="10" class="form-control  mb-2 mr-sm-2 mb-sm-0" >{{$advert->param('description')}}</textarea></div>
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
                                    <input type="file" id="file-chooser" multiple style="display: none">
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
                                                <input type="number" name="price" class="form-control  mb-2 mr-sm-2 mb-sm-0" placeholder="Price"  value="@if($advert->has_meta('price')&&$advert->meta('price')>=0){{$advert->price()}}@endif" step="1">

                                            </div>
                                        </div>

                                        <div class="col-sm-6"></div></div>
                                </div>
                            </div>
                        @endif
                        @if(count($advert->category->fields)>1)
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
                                                            <input class="form-control" type="text" name="{{$field->slug}}"  value="{{$advert->meta($field->slug)}}">
                                                        @elseif($field->type==='list')
                                                            <select class="form-control" name="{{$field->slug}}">
                                                                @foreach($field->values as $value)
                                                                    <option value="{{$value->slug}}" @if($value->slug===$advert->meta($field->slug)) selected @endif>{{$value->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        @else
                                                            <input class="form-control" type="text" name="{{$field->slug}}"   value="{{$advert->meta($field->slug)}}">
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
                        @endif

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


                                        <li class="list-group-item" style="display: none">
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

                    @if($advert->category->can_ship())
                        <div class="panel panel-default extra-options-panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Delivery Options</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input  type="checkbox" name="candeliver" value="1"><span class="delivery-text">Can Deliver Locally</span>
                                        <p>Note: Need to delivery the product within 2 days of receiving the order</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <span class="delivery-text">Delivery Distance</span>

                                        <select class="form-control" name="distance">
                                            <option value="1">1 Mile</option>
                                            <option value="5">5 Miles</option>
                                            <option value="10">10 Miles</option>
                                            <option value="30">30 Miles</option>
                                            <option value="50">50 Miles</option>
                                            <option value="100">100 Miles</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input  type="checkbox" name="canship" value="1"><span class="delivery-text">Can Ship Nationwide</span>
                                        <p>Note: Need to ship the product by the date specified on the order</p>
                                        <div class="well">
                                            <h4>Shipping Method</h4>
                                            <p class="bold-text"> Royal Mail 2nd Class Signed For</p>
                                            <div id="shipping-replace">

                                            <ul>
                                                <li>Max: 20 kg, 61 x 46 x 46 cm</li>
                                                <li>Tracking included: No</li>
                                                <li>Compensation included: Yes</li>
                                                <li>Delivery time: 2 - 3 working days</li>
                                            </ul>
                                            </div>
                                            <a  data-toggle="modal" data-target="#myModal">Change Shipping Method</a>

                                            <p class="bold-text">Buyer Pays</p>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-gbp"></i></span>
                                                <input type="number" name="buyer_pays"  class="form-control  mb-2 mr-sm-2 mb-sm-0" placeholder=""  value="@if($advert->has_meta('price')&&$advert->meta('price')>=0){{$advert->price()}}@endif" step="1">
                                            </div>
                                            <br>
                                            <input  type="checkbox" name="freeshipping" value="1"><span class="delivery-text">Free Shipping</span>
                                            <p>This is a great way to attract potential buyers looking to grab a bargain.</p>
                                            <br>
                                            <input  type="checkbox" name="acceptreturns" value="1"><span class="delivery-text">Accept Returns</span>
                                            <p>Buyers have 14 days to let you know they'd like to retun an item, plus an additional 14 days to return the item. Buyers pay to return the item.</p>

                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <span class="delivery-text">Dispatch Time</span>
                                        <select class="form-control" name="distance">
                                            <option value="1">1 working day</option>
                                            <option value="2">2 working days</option>
                                            <option value="3">3 working days</option>
                                            <option value="5">5 working days</option>
                                            <option value="10">10 working days</option>
                                            <option value="30">1 month</option>
                                            <option value="60">2 months</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

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
                                <div class="col-sm-2 col-sm-offset-8"><button value="1" name="save" type="submit" class="btn btn-default">Save Advert</button> </div>
                                <div class="col-sm-2"><button name="post" value="1" type="submit" class="btn btn-primary">Post Advert</button> </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
@endif
        </div>
    </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content" id="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Shipping Methods</h4>
                </div>
                <div class="modal-body all-con">
                    <h4 class="bold-text">Economy services</h4>
                    <table class="table">
                        <tr><th>Service</th><th>Tracking</th></span><th>Compensation</th><th>Delivery time</th></tr>
                        <tr><td><input class="change-shipping" data-servicecode="UK_RoyalMailSecondClassStandard" data-servicename="Royal Mail 2nd Class" type="radio" value="UK_RoyalMailSecondClassStandard" id="domestic_Royal Mail 2nd Class" name="serviceOptions" aria-label=" Royal Mail 2nd Class Delivery time 2 - 3 working days Price range " data-w-onclick="setServiceState|w0-w0-shipping-services-overlay_serviceList" data-w-onkeydown="setServiceState|w0-w0-shipping-services-overlay_serviceList">
                            <span class="shippingServicesOverlay__groupContentCell serviceName col-4 sm-1">Royal Mail 2nd Class</span>
                                <span class="subText sm-1">Max: 20 kg, 61 x 46 x 46 cm</span>
                                <span class="subText mobile_only sm-1">Tracking included: No</span>
                                <span class="subText mobile_only sm-1">Compensation included: Yes</span>
                                <span class="subText mobile_only sm-1">Delivery time: 2 - 3 working days</span>
                                <div id="UK_RoyalMailSecondClassStandard_extras" style="display: none">
                                    <ul>
                                        <li>Max: 20 kg, 61 x 46 x 46 cm</li>
                                        <li>Tracking included: No</li>
                                        <li>Compensation included: Yes</li>
                                        <li>Delivery time: 2 - 3 working days</li>
                                    </ul>
                                </div>
                            </td>
                                   <td> <span class="shippingServicesOverlay__groupContentCell lg_only col-4">No</span>
                                       </td>


                            <td>
                            <span class="shippingServicesOverlay__groupContentCell lg_only col-4"><b>Yes</b></span>
                            </td>
                            <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4">2 - 3 working days</span>
                           </td></tr>
                        <tr><td> <input class="change-shipping" data-servicecode="UK_RoyalMailSecondClassRecorded" data-servicename="Royal Mail 2nd Class Signed For" type="radio" value="UK_RoyalMailSecondClassRecorded" id="domestic_Royal Mail 2nd Class Signed For" name="serviceOptions" aria-label=" Royal Mail 2nd Class Signed For Delivery time 2 - 3 working days Price range " data-w-onclick="setServiceState|w0-w0-shipping-services-overlay_serviceList" data-w-onkeydown="setServiceState|w0-w0-shipping-services-overlay_serviceList">
                                    <span class="shippingServicesOverlay__groupContentCell serviceName col-4 sm-1">Royal Mail 2nd Class Signed For</span>
                                    <span class="subText sm-1">Max: 20 kg, 61 x 46 x 46 cm</span>
                                    <span class="subText mobile_only sm-1">Tracking included: No</span>
                                    <span class="subText mobile_only sm-1">Compensation included: Yes</span>
                                    <span class="subText mobile_only sm-1">Delivery time: 2 - 3 working days</span>
                                </td>
                                    <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4">No</span></td>
                                    <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4"><b>Yes</b></span></td>
                                    <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4">2 - 3 working days</span></td>
                                   </tr>
                        <tr><td><input data-servicecode="UK_myHermesDoorToDoorService" data-servicename="Hermes Tracked" type="radio" value="UK_myHermesDoorToDoorService" id="domestic_Hermes Tracked" name="serviceOptions" aria-label=" Hermes Tracked Delivery time 3 - 5 working days Price range " data-w-onclick="setServiceState|w0-w0-shipping-services-overlay_serviceList" data-w-onkeydown="setServiceState|w0-w0-shipping-services-overlay_serviceList">
                                    <span class="shippingServicesOverlay__groupContentCell serviceName col-4 sm-1">Hermes Tracked</span>
                                <span class="subText sm-1">Max: 15 kg, 120 cm</span>
                                <span class="subText mobile_only sm-1">Tracking included: Yes</span>
                                <span class="subText mobile_only sm-1">Compensation included: Yes</span>
                                <span class="subText mobile_only sm-1">Delivery time: 3 - 5 working days</span></td>
                            <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4"><b>Yes</b></span></td>
                            <td> <span class="shippingServicesOverlay__groupContentCell lg_only col-4"><b>Yes</b></span></td>
                            <td> <span class="shippingServicesOverlay__groupContentCell lg_only col-4">3 - 5 working days</span></td>
                                   </tr>
                        <tr><td><input data-servicecode="UK_CollectPlusTrakedDeliveryToDoor" data-servicename="Collect+ Economy Tracked" type="radio" value="UK_CollectPlusTrakedDeliveryToDoor" id="domestic_Collect+ Economy Tracked" name="serviceOptions" aria-label=" Collect+ Economy Tracked Delivery time 3 - 5 working days Price range " data-w-onclick="setServiceState|w0-w0-shipping-services-overlay_serviceList" data-w-onkeydown="setServiceState|w0-w0-shipping-services-overlay_serviceList">
                                    <span class="shippingServicesOverlay__groupContentCell serviceName col-4 sm-1">Collect+ Economy Tracked</span>
                                <span class="subText sm-1">Max: 10 kg, 50 x 30 x 30 cm</span>
                                <span class="subText mobile_only sm-1">Tracking included: Yes</span>
                                <span class="subText mobile_only sm-1">Compensation included: Yes</span>
                                <span class="subText mobile_only sm-1">Delivery time: 3 - 5 working days</span>
                            </td>
                            <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4"><b>Yes</b></span></td>
                            <td> <span class="shippingServicesOverlay__groupContentCell lg_only col-4"><b>Yes</b></span></td>
                            <td> <span class="shippingServicesOverlay__groupContentCell lg_only col-4">3 - 5 working days</span></td>
                                    </tr>
                        <tr><td><input data-servicecode="UK_OtherCourier" data-servicename="Other courier (3 to 5 days)" type="radio" value="UK_OtherCourier" id="domestic_Other courier (3 to 5 days)" name="serviceOptions" aria-label=" Other courier (3 to 5 days) Delivery time 3 - 5 working days Price range " data-w-onclick="setServiceState|w0-w0-shipping-services-overlay_serviceList" data-w-onkeydown="setServiceState|w0-w0-shipping-services-overlay_serviceList">
                                <span class="shippingServicesOverlay__groupContentCell serviceName col-4 sm-1">Other courier (3 to 5 days)</span>
                                <span class="subText mobile_only sm-1">Tracking included: No</span>
                                <span class="subText mobile_only sm-1">Compensation included: No</span>
                                <span class="subText mobile_only sm-1">Delivery time: 3 - 5 working days</span>
                            </td>

                            <td> <span class="shippingServicesOverlay__groupContentCell lg_only col-4">No</span></td>
                            <td> <span class="shippingServicesOverlay__groupContentCell lg_only col-4">No</span></td>
                            <td> <span class="shippingServicesOverlay__groupContentCell lg_only col-4">3 - 5 working days</span></td>
                              </tr>
                        <tr><td><input data-servicecode="UK_Shutl3To5Days" data-servicename="eBay delivery - Shutl 3-5 days" type="radio" value="UK_Shutl3To5Days" id="domestic_eBay delivery - Shutl 3-5 days" name="serviceOptions" aria-label=" eBay delivery - Shutl 3-5 days Delivery time 3 - 5 working days Price range " data-w-onclick="setServiceState|w0-w0-shipping-services-overlay_serviceList" data-w-onkeydown="setServiceState|w0-w0-shipping-services-overlay_serviceList">
                                <span class="shippingServicesOverlay__groupContentCell serviceName col-4 sm-1">Shutl 3-5 days</span>
                                <span class="subText sm-1">Max: 15 kg, 120 cm</span>
                                <span class="subText mobile_only sm-1">Tracking included: Yes</span>
                                <span class="subText mobile_only sm-1">Compensation included: Yes</span>
                                <span class="subText mobile_only sm-1">Delivery time: 3 - 5 working days</span>
                            </td>
                            <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4"><b>Yes</b></span></td>
                            <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4"><b>Yes</b></span></td>
                            <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4">3 - 5 working days</span></td>
                             </tr>
                    </table>
                    <h4 class="bold-text">Standard services</h4>
                    <table class="table">
                        <tr><th>Service</th><th>Tracking</th></span><th>Compensation</th><th>Delivery time</th></tr>
                   <tr><td> <input data-servicecode="UK_RoyalMailFirstClassStandard" data-servicename="Royal Mail 1st Class" type="radio" value="UK_RoyalMailFirstClassStandard" id="domestic_Royal Mail 1st Class" name="serviceOptions" aria-label=" Royal Mail 1st Class Delivery time 1 working day Price range " data-w-onclick="setServiceState|w0-w0-shipping-services-overlay_serviceList" data-w-onkeydown="setServiceState|w0-w0-shipping-services-overlay_serviceList">
                        <span class="shippingServicesOverlay__groupContentCell serviceName col-4 sm-1">Royal Mail 1st Class</span>
                        <span class="subText sm-1">Max: 20 kg, 61 x 46 x 46 cm</span>
                        <span class="subText mobile_only sm-1">Tracking included: No</span>
                        <span class="subText mobile_only sm-1">Compensation included: Yes</span>
                        <span class="subText mobile_only sm-1">Delivery time: 1 working day</span>
                   </td>

                        <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4">No</span></td>
                        <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4"><b>Yes</b></span></td>
                        <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4">1 working day</span></td>
                   </tr>

                       <tr>
                           <td>
                           <input data-servicecode="UK_RoyalMailFirstClassRecorded" data-servicename="Royal Mail 1st Class Signed For" type="radio" value="UK_RoyalMailFirstClassRecorded" id="domestic_Royal Mail 1st Class Signed For" name="serviceOptions" aria-label=" Royal Mail 1st Class Signed For Delivery time 1 working day Price range " data-w-onclick="setServiceState|w0-w0-shipping-services-overlay_serviceList" data-w-onkeydown="setServiceState|w0-w0-shipping-services-overlay_serviceList">
                        <span class="shippingServicesOverlay__groupContentCell serviceName col-4 sm-1">Royal Mail 1st Class Signed For</span>
                           <span class="subText sm-1">Max: 20 kg, 61 x 46 x 46 cm</span>
                           <span class="subText mobile_only sm-1">Tracking included: No</span>
                           <span class="subText mobile_only sm-1">Compensation included: Yes</span>
                           <span class="subText mobile_only sm-1">Delivery time: 1 working day</span>
                           </td>
                           <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4">No</span></td>
                           <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4"><b>Yes</b></span></td>
                           <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4">1 working day</span></td>

                       </tr>
                        <tr>
                            <td>
                        <input data-servicecode="UK_Parcelforce48" data-servicename="Parcelforce 48" type="radio" value="UK_Parcelforce48" id="domestic_Parcelforce 48" name="serviceOptions" aria-label=" Parcelforce 48 Delivery time 1 - 2 working days Price range " data-w-onclick="setServiceState|w0-w0-shipping-services-overlay_serviceList" data-w-onkeydown="setServiceState|w0-w0-shipping-services-overlay_serviceList">
                        <span class="shippingServicesOverlay__groupContentCell serviceName col-4 sm-1">Parcelforce 48</span>
                                <span class="subText sm-1">Max: 30 kg, 150 cm</span>
                                <span class="subText mobile_only sm-1">Tracking included: Yes</span>
                                <span class="subText mobile_only sm-1">Compensation included: Yes</span>
                                <span class="subText mobile_only sm-1">Delivery time: 1 - 2 working days</span>
                            </td>
                            <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4"><b>Yes</b></span></td>
                            <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4"><b>Yes</b></span></td>
                            <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4">1 - 2 working days</span></td>

                        </tr>
                        <tr>
                            <td>
                        <input data-servicecode="UK_OtherCourier48" data-servicename="Other 48h courier" type="radio" value="UK_OtherCourier48" id="domestic_Other 48h courier" name="serviceOptions" aria-label=" Other 48h courier Delivery time 1 - 2 working days Price range " data-w-onclick="setServiceState|w0-w0-shipping-services-overlay_serviceList" data-w-onkeydown="setServiceState|w0-w0-shipping-services-overlay_serviceList">
                        <span class="shippingServicesOverlay__groupContentCell serviceName col-4 sm-1">Other 48h courier</span>
                                <span class="subText mobile_only sm-1">Tracking included: No</span>
                                <span class="subText mobile_only sm-1">Compensation included: No</span>
                                <span class="subText mobile_only sm-1">Delivery time: 1 - 2 working days</span>
                            </td>
                            <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4">No</span></td>
                            <td> <span class="shippingServicesOverlay__groupContentCell lg_only col-4">No</span></td>
                            <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4">1 - 2 working days</span></td>

                        </tr>
                        <tr>

                            <td> <input data-servicecode="UK_Shutl2Days" data-servicename="eBay delivery - Shutl 2 days" type="radio" value="UK_Shutl2Days" id="domestic_eBay delivery - Shutl 2 days" name="serviceOptions" aria-label=" eBay delivery - Shutl 2 days Delivery time 2 working days Price range " data-w-onclick="setServiceState|w0-w0-shipping-services-overlay_serviceList" data-w-onkeydown="setServiceState|w0-w0-shipping-services-overlay_serviceList">
                        <span class="shippingServicesOverlay__groupContentCell serviceName col-4 sm-1">Shutl 2 days</span>
                                <span class="subText sm-1">Max: 10 kg, 60 x 50 x 50 cm</span>
                                <span class="subText mobile_only sm-1">Tracking included: Yes</span>
                                <span class="subText mobile_only sm-1">Compensation included: Yes</span>
                                <span class="subText mobile_only sm-1">Delivery time: 2 working days</span></td>
                            <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4"><b>Yes</b></span> </td>
                            <td> <span class="shippingServicesOverlay__groupContentCell lg_only col-4"><b>Yes</b></span> </td>
                            <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4">2 working days</span> </td>

                        </tr>
                    </table>
                        <h4 class="bold-text">Express services</h4>
                        <table class="table">
                            <tr><th>Service</th><th>Tracking</th></span><th>Compensation</th><th>Delivery time</th></tr>
                            <tr>

                                <td> <input data-servicecode="UK_Shutl1Day" data-servicename="eBay delivery - Shutl 1 day" type="radio" value="UK_Shutl1Day" id="domestic_eBay delivery - Shutl 1 day" name="serviceOptions" aria-label=" eBay delivery - Shutl 1 day Delivery time 1 working day Price range £5.65" data-w-onclick="setServiceState|w0-w0-shipping-services-overlay_serviceList" data-w-onkeydown="setServiceState|w0-w0-shipping-services-overlay_serviceList">
                            <span class="shippingServicesOverlay__groupContentCell serviceName col-4 sm-1">Shutl 1 day</span>
                                    <span class="subText sm-1">Max: 15 kg, 80 cm</span>
                                    <span class="subText mobile_only sm-1">Tracking included: Yes</span>
                                    <span class="subText mobile_only sm-1">Compensation included: Yes</span>
                                    <span class="subText mobile_only sm-1">Delivery time: 1 working day</span></td>
                                <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4"><b>Yes</b></span> </td>
                                <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4"><b>Yes</b></span> </td>
                                <td> <span class="shippingServicesOverlay__groupContentCell lg_only col-4">1 working day</span> </td>

                            </tr>
                            <tr>

                                <td> <input data-servicecode="UK_RoyalMailSpecialDeliveryNextDay" data-servicename="Royal Mail Special Delivery (TM) 1:00 pm" type="radio" value="UK_RoyalMailSpecialDeliveryNextDay" id="domestic_Royal Mail Special Delivery (TM) 1:00 pm" name="serviceOptions" aria-label=" Royal Mail Special Delivery (TM) 1:00 pm Delivery time 1 working day Price range " data-w-onclick="setServiceState|w0-w0-shipping-services-overlay_serviceList" data-w-onkeydown="setServiceState|w0-w0-shipping-services-overlay_serviceList">
                            <span class="shippingServicesOverlay__groupContentCell serviceName col-4 sm-1">Royal Mail Special Delivery (TM) 1:00 pm</span>
                                    <span class="subText sm-1">Max: 20 kg, 61 x 46 x 46 cm</span>
                                    <span class="subText mobile_only sm-1">Tracking included: Yes</span>
                                    <span class="subText mobile_only sm-1">Compensation included: Yes</span>
                                    <span class="subText mobile_only sm-1">Delivery time: 1 working day</span></td>
                                <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4"><b>Yes</b></span> </td>
                                <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4"><b>Yes</b></span> </td>
                                <td><span class="shippingServicesOverlay__groupContentCell lg_only col-4">1 working day</span> </td>

                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(".change-shipping").change( function(){

            var id = $(this).id;
            $("#shipping-replace").html($("#"+id+"_extras").html());
            $('#myModal').modal('hide');
        });
    </script>
@endsection