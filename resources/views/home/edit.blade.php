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
                            <div class="row row-images">
                                <div class="col-sm-3">
                                    <a ><img src="/css/addimage.png" class="add-image" style="cursor: pointer"></a>
                                    <input type="file" id="file-chooser" style="display: none">
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="category-extras" style="display: block">
                                <div class="panel panel-default price-panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Price</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="input-group">

                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-gbp"></i></span>
                                                    <input type="text" name="price" class="form-control  mb-2 mr-sm-2 mb-sm-0" placeholder="Price" required>
                                                    <span class="input-group-addon">.00</span>

                                                </div>
                                            </div>
                                            <div class="col-sm-6"></div></div>
                                    </div>
                                </div>

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
                                                                            <option value="{{$value->slug}}" @if($value->slug===$advert->meta($field->slug)) @endif>{{$value->title}}</option>
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
                                        @foreach($advert->extras() as $extra)

                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input extra-change" type="checkbox" name="{{$extra->slug}}" value="1" id="{{$extra->slug}}">
                                                                <span class="span-{{$extra->slug}}">{{$extra->title}}</span> &nbsp;&nbsp;{{$extra->subtitle}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        @if($extra->type==='single')
                                                            <span class="extra-price">£{{$extra->price->price/100}}</span>
                                                            <input type="hidden" id="{{$extra->slug}}-price" value="{{$extra->price->price/100}}" name="{{$extra->slug}}-price">
                                                        @else
                                                            <select class="form-control extra-change" name="{{$extra->key}}" id="{{$extra->key}}">
                                                                @foreach($extra->prices as $price)
                                                                    <option value="{{$price->key}}">{{$price->title}}  (£{{$price->price/100}})</option>
                                                                @endforeach
                                                            </select>
                                                        @endif

                                                    </div>
                                                </div>

                                            </li>
                                        @endforeach

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
                                <div class="col-sm-2 col-sm-offset-10"><button type="submit" class="btn btn-primary">Post Advert</button> </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>
    </div>
@endsection