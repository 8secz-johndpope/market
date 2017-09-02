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
       <div class="col-lg-8">
           @foreach($categories as $category)
               <div class="main-category">
                   {{$category->title}}
               </div>
           @endforeach
       </div>
       <div class="col-lg-2"></div>
   </div>
    @endsection