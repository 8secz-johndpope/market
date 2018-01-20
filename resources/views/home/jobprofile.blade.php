<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', env('APP_NAME'). ' | Private Profile')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@php
    $date = new Datetime();
    $dateMs = $date->getTimestamp();
@endphp
@section('content')
<link href="{{ asset("/css/private-profile.css?q=$dateMs") }}" rel="stylesheet" type="text/css">
<div class="body background-color">
    <section class="container-profile-header mb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="header-profile-title">Your {{env('APP_NAME')}} Private Profile</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="container-details-profile mb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="wrapper-img-profile">
                        <figure>
                            <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$user->image}}">
                        </figure>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="wrapper-details-profile">
                        <h3 class="details-profile-title">Private Profile</h3>
                        <p class="details-profile-subtitle">Complete your deatils</p>
                        <div class="wrapper-details-content">
                            <p class="details-item">{{$user->name}}}</p>
                            <p class="details-item">{{$user->email}}}</p>
                            <p class="details-item">{{$user->phone}}}</p>
                        </div>
                    </div>
                </div>           
            </div>
        </div>
    </section>    
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">
            <form action="/job/profile/save" method="post" id="change-category">
                {{ csrf_field() }}
            <h4>About me</h4>
            <textarea type="text" name="about_me" rows="10" id="editor" class="ckeditor form-control  mb-2 mr-sm-2 mb-sm-0" >{{$user->profile->about_me}}</textarea>
            <h4>Salary</h4>
            <input type="text" class="form-control" name="salary" value="{{$user->profile->salary}}">
                <br>
                <input type="submit" class="btn-primary btn" value="Save">
            </form>
        </div>
    </div>
</div>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
            console.error( error );
        } );
    </script>
@endsection