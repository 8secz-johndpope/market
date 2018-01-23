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
                <div class="col-sm-9">
                    <h2 class="header-profile-title">Your {{env('APP_NAME')}} Private Profile</h2>
                </div>
                <div class="col-sm-3">
                    <a class="btn btn-info" href="#">Recommended Jobs</a>
                </div>
            </div>
        </div>
    </section>
    <section class="container-details-profile mb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-10">
                    <h3 class="details-profile-title">Private Profile</h3>
                    <p class="details-profile-subtitle">Complete your deatils</p>
                </div>
                <div class="col-sm-2">
                    <a class="btn update-details" href="/user/manage/details">Edit</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <form>
                        <div class="wrapper-img-profile">
                            <figure>
                                <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$user->image}}" class="img-responsive img-profile">
                            </figure>
                            <a href="#" id="change-avatar">
                                <div class="edit-avatar">
                                    <input type="file" id="upload-profile"  style="display: none">
                                    <input type="hidden" name="image" value="{{$user->image}}" id="image">
                                    <i class="glyphicon glyphicon-edit"></i>
                                </div>
                            </a>
                        </div>
                    </form>
                </div>
                <div class="col-sm-9">
                    <div class="wrapper-details-profile">
                        <div class="wrapper-details-content">
                            <p class="details-item name">{{$user->name}}</p>
                            <p class="details-item title-job">Engineer Computer</p>
                            <p class="details-item">{{$user->email}}</p>
                            <p class="details-item">{{$user->phone}}</p>
                        </div>
                    </div>
                </div>           
            </div>
        </div>
    </section>
    <section class="container-templates-options mb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="template-options-title">Select & Create Your Profile</h2>
                    <p class="details-profile-subtitle">After selecting a profile, you should provide revelant information for each section in order to complete the profile</p>
                </div>
                <div class="col-sm-4">
                    <div class="template-item">
                        <h3 class="template-item-title">General</h3>
                        <div class="template-content selected">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="template-item">
                        <h3 class="template-item-title">Social Care & Childcare</h3>
                        <div class="template-content">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="template-item">
                        <h3 class="template-item-title">Sub Contractor</h3>
                        <div class="template-content">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> 
    <section class="container-looking-for-options mb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <header class="section-header">
                        <h2 class="title">Looking for</h2>
                        <a class="action edit" href="">Edit<i class="glyphicon glyphicon-menu-right"></i></a>
                    </header>
                    <div class="content row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="desired-job-title">
                                <h3 class="title">Desired job title</h3>
                                <p class="data">Engineer</p>
                            </div>
                            <div class="salary">
                                <h3 class="title">Salary</h3>
                                <p class="data"></p>
                                <ul>
                                    <li>£ per annum</li>
                                    <li>£ per hour</li>
                                </ul>
                                <a href="#">
                                    Add salary
                                    <i class="glyphicon glyphicon-plus-sign"></i>
                                </a>
                                <p></p>
                            </div>
                            <div class="location">
                                <h3 class="title">Location</h3>
                                <p class="data">London, South East England</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="job-type">
                                <h3 class="title">Job Type</h3>
                                <p class="data">Full-time & part-time permanent & contract work</p>
                            </div>
                            <div class="specialisms">
                                <h3 class="title">Sectors / Industries</h3>
                                <p class="data">IT & Telecoms</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container-cvs mb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <header class="section-header">
                        <h2 class="title">Your CV's</h2>
                    </header>
                    <div class="content row">
                        <div class="alerts">
                            <div class="alert alert-danger">
                                <strong>You haven't uploaded a CV yet.</strong>
                                 To apply for jobs, you'll need a CV.
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <p>Upload a new CV, or use our CV builder to build one for you.</p>
                            <div class="btns row">
                                <div class="col-xs-12 col-sm-6">
                                    <a class="btn btn-submit">Upload CV</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container-status-availability mb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <header class="section-header">
                        <h2 class="title">Status & availability</h2>
                        <a class="action edit" href="">Edit<i class="glyphicon glyphicon-menu-right"></i></a>
                    </header>
                    <div class="content row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="employment-status">
                                <h3 class="title">Employment status</h3>
                                <p class="data">Unemployed</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container-cover-letter mb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <header class="section-header">
                        <h2 class="title">Cover letter</h2>
                    </header>
                    <div class="content">
                        <a class="add-first" href="/user/create/covers">
                            <i class="glyphicon glyphicon-plus-sign"></i>
                            Add cover letter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container-work-experience mb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <header class="section-header">
                        <h2 class="title">Work experience</h2>
                    </header>
                    <div class="content">
                        <a class="add-first" href="/user/create/work-experience">
                            <i class="glyphicon glyphicon-plus-sign"></i>
                            Add work experience
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <div class="row">
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
    -->
</div>
<!--
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
            console.error( error );
        } );
    </script>
-->
<script>
    $('#edit-avatar').click(function (e) {
        e.preventDefault();
        console.log('click');
        $("#upload-profile").click();
    });
</script>
@endsection