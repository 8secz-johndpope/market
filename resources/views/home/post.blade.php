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
                <ul class="list-group">

                </ul>
               </div>
               <div class="col-lg-3 sub-category">

               </div>
               <div class="col-lg-3 sub-category">

               </div>
               <div class="col-lg-3 sub-category">

               </div>
           </div>
       </div>
       <div class="col-lg-2"></div>
   </div>
    @endsection