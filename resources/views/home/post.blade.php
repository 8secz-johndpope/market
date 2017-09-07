<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <form action="/user/advert/newad" method="post" id="advert-form">
        {{ csrf_field() }}
        <input type="hidden" name="category" value="0" id="category">
   <div class="row">
       <div class="col-lg-2"></div>
       <div class="col-lg-8  nopadding">

           <div class="panel panel-default automatic-category-panel">
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

           <div class="panel panel-default  manual-category-panel">
               <div class="panel-heading">
                   <h3 class="panel-title">Select Category</h3>
               </div>
               <div class="panel-body">
                   @foreach($categories as $category)
                       <div class="main-category" data-category="{{$category->id}}">
                           {{$category->title}}
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


           <div class="panel panel-default selected-category-panel">
               <div class="panel-heading">
                   <h3 class="panel-title">Category</h3>
               </div>
               <div class="panel-body">
                   <div class="row">
                       <div class="col-sm-11"><span class="category-sting"></span> </div>
                       <div class="col-sm-1">
                           <a class="btn btn-default edit-category">Edit</a>
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
                       <div class="col-sm-12 location-selected">
                           <p>Your Location</p>
                           <span class="extra-large">M139AX</span><a class="edit-location-button">(Edit)</a>
                       </div>
                       <div class="col-sm-12 edit-location">
                           <input type="hidden" name="location_name" value="London" id="location_name">
                           <input type="hidden" name="lat" value="52.0" id="lat">
                           <input type="hidden" name="lng" value="0.12" id="lng">

                           <form class="form-inline">
                               <label class="sr-only" for="inlineFormInput">Postcode</label>
                               <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="postcode-text" placeholder="Postcode">
                               <a class="btn btn-danger postcode-submit">Go</a>
                           </form>
                       </div>

                   </div>
               </div>
           </div>

           <div class="all-panels">



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


           <div class="panel panel-default price-panel">
               <div class="panel-heading">
                   <h3 class="panel-title">Price</h3>
               </div>
               <div class="panel-body">
                   <div class="row"> <div class="col-sm-6">  <span class="input-group-addon"><i class="glyphicon glyphicon-gbp"></i></span>
                           <input type="text" name="price" class="form-control  mb-2 mr-sm-2 mb-sm-0" placeholder="Price" required></div>
                       <div class="col-sm-6"><p>100 characters remaining</p></div></div>
               </div>
           </div>

          <div class="extra-prices">

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
               <div class="panel panel-default extra-options-panel">
                   <div class="panel-heading">
                       <h3 class="panel-title">Select Options</h3>
                   </div>
                   <div class="panel-body">
                       <div class="row">
                           <div class="col-sm-12">
                               <div class="row category-extras"></div>
                           </div>
                       </div>
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

       </div>

       <div class="col-lg-2"></div>
   </div>
   </form>
    @endsection