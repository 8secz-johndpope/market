<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Create your public profile')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<link href="{{ asset('/css/public-profile.css?q=874') }}" rel="stylesheet">
<div class="body background-body">
    <section class="container-title-profile">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="wrapper-title-profile">
                        <h3>Create Your {{env('APP_NAME')}} Public Profile</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container-details-profile">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="wrapper-picture-profile">
                        <figure>
                            <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$user->image}}" class="img-responsive photo-profile">
                        </figure>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="wrapper-details-profile">
                        <h3>{{$user->name}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">
        </div>
    </div>
</div>
@endsection