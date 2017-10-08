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

           <div class="panel panel-default automatic-category-panel" @if($category) style="display: none" @endif>
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


           <div class="panel panel-default selected-category-panel"  @if(!$category) style="display: none" @endif>
               <div class="panel-heading">
                   <h3 class="panel-title">Category</h3>
               </div>
               <div class="panel-body">
                   <div class="row">
                       <div class="col-sm-11"><span class="category-sting">@if($category) {{$category->pstring()}}   > <span class="select-category"> {{$category->title}} </span> @endif</span> </div>
                       <div class="col-sm-1">
                           <a class="btn btn-default edit-category">Edit</a>
                       </div>
                   </div>
               </div>
           </div>
           <div class="panel panel-default selected-location-panel" @if(!$category) style="display: none" @endif>
               <div class="panel-heading">
                   <h3 class="panel-title">Location</h3>
               </div>
               <div class="panel-body">
                   <div class="row">

                       <div class="col-sm-12 location-selected">
                           <p>Your Location</p>
                           <span class="extra-large"> @if($location){{$postcode}} @endif</span><a class="edit-location-button">(Edit)</a>
                       </div>


                       <div class="col-sm-12 edit-location" @if($location) style="display: none" @endif>
                           <input type="hidden" name="location_name" value="London" id="location_name">
                           <input type="hidden" name="location_id" value="London" id="location_id">

                           <input type="hidden" name="lat" value="52.0" id="lat">
                           <input type="hidden" name="lng" value="0.12" id="lng">
                           @if($message)
                           <span class="red-text" id="location-error-info" >{{$message}}</span>
                            @endif

                           <form class="form-inline" action="/user/advert/location" method="post">
                               {{ csrf_field() }}
                               @if($category)
                               <input type="hidden" name="category" value="{{$category->id}}" id="category">
                               @endif
                               <label class="sr-only" for="inlineFormInput">Postcode</label>
                               <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="postcode-text" placeholder="Postcode" name="postcode">
                               <button class="btn btn-danger" type="submit">Go</button>
                           </form>

                       </div>

                   </div>
               </div>
           </div>
           <form action="/user/advert/newad" method="post" id="advert-form">
               @if($category)
                   <input type="hidden" name="category" value="{{$category->id}}">
                   @endif
                   @if($location)
                       <input type="hidden" name="postcode" value="{{$postcode}}">
                   @endif
               {{ csrf_field() }}
           <div class="all-panels" @if(!$category) style="display: none" @endif>

           <div class="panel panel-default title-panel">
               <div class="panel-heading">
                   <h3 class="panel-title">Title</h3>
               </div>
               <div class="panel-body">
                   <div class="row"> <div class="col-sm-6"><input type="text" name="title" class="form-control  mb-2 mr-sm-2 mb-sm-0" placeholder="Title" required></div>
                       <div class="col-sm-6"><p>100 characters remaining</p></div></div>
               </div>
           </div>


           <div class="panel panel-default description-panel">
               <div class="panel-heading">
                   <h3 class="panel-title">Description</h3>
               </div>
               <div class="panel-body">
                   <div class="row">
                       <div class="col-sm-6"><textarea type="text" name="description" rows="10" class="form-control  mb-2 mr-sm-2 mb-sm-0" required></textarea></div>
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
               @if($fields)
               <div class="category-extras" style="display: block">
                   @if($hasprice)
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
                   @endif
                   @if(count($fields)>1)
                       <div class="panel panel-default extra-options-panel">
                           <div class="panel-heading">
                               <h3 class="panel-title">Select Options</h3>
                           </div>
                           <div class="panel-body">
                               <div class="row">
                                   <div class="col-sm-12">
                                       <div class="row">
                                           @foreach($fields as $field)
                                               @if($field->slug!=='price')
                                                   <div class="col-sm-6">
                                                       <span class="extra-title">{{$field->title}}</span>
                                                       @if($field->type==='integer')
                                                           <input class="form-control" type="text" name="{{$field->slug}}" required>
                                                       @elseif($field->type==='list')
                                                           <select class="form-control" name="{{$field->slug}}">
                                                               @foreach($field->values as $value)
                                                                   <option value="{{$value->slug}}">{{$value->title}}</option>
                                                               @endforeach
                                                           </select>
                                                       @else
                                                           <input class="form-control" type="text" name="{{$field->slug}}" required>
                                                       @endif
                                                   </div>
                                               @endif
                                           @endforeach
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   @endif
               </div>
               @endif
               @if($extras)
               <div class="extra-prices" style="display: block">
                   <div class="panel panel-default featured-panel">
                       <div class="panel-heading">
                           <h3 class="panel-title">Make your ad stand out!</h3>
                       </div>
                       <div class="panel-body">
                           <ul class="list-group">
                               @foreach($extras as $extra)

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