<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
   <div class="row">
       <div class="col-lg-2"></div>
       <div class="col-lg-8  nopadding">
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
                   <a class="btn btn-danger" disabled>Continue</a>
               </div>
           </div>
       </div>
       <div class="col-lg-2"></div>
   </div>
    @endsection