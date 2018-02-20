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
                <div class="col-sm-9 col-xs-12">
                    <div class="row">
                        <div class="col-sm-10">
                            <h3 class="details-profile-title">Private Profile</h3>
                            <p class="details-profile-subtitle">Complete your details</p>
                        </div>
                        <div class="col-sm-2 text-right">
                            <a class="action edit" href="/user/manage/details">Edit<i class="glyphicon glyphicon-menu-right"></i></a>
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
                                            <i class="glyphicon glyphicon-edit"></i>
                                        </div>
                                    </a>
                                    <input type="file" id="upload-profile"  style="display: none">
                                    <input type="hidden" name="image" value="{{$user->image}}" id="image">
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
                <div class="col-sm-3 col-xs-12">
                    <div class="card profile-card">
                        <div class="profile-apps-jobs row">
                            <a class="col-xs-6 profile-jobs" href="/user/manage/my/applications">
                                <span>{{$totalApplication}}</span>
                                Applications
                            </a>
                            <a class="col-xs-6 profile-apps">
                                <span>0</span>
                                Saved jobs
                            </a>
                        </div>
                        <div class="profile progress-row">
                            <div class="profile-progress">
                                <p>Your profile is 50% complete</p>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                </div>
                            </div>
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
                        <div class="template-content {{$type === $types[0] ? 'selected' : ''}}" data-href="{{$types[0]}}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="template-item">
                        <h3 class="template-item-title">Social Care & Childcare</h3>
                        <div class="template-content {{$type === $types[1] ? 'selected' : ''}}" data-href="{{$types[1]}}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="template-item">
                        <h3 class="template-item-title">Sub Contractor</h3>
                        <div class="template-content {{$type === $types[2] ? 'selected' : ''}}" data-href="{{$types[2]}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 text-center">
                    <p class="select-profile">To procced, you must select a profile</p>
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
                        <a class="action edit" href="/user/jobs/looking-for">Edit<i class="glyphicon glyphicon-menu-right"></i></a>
                    </header>
                    <div class="content row">
                        @if(isset($profile->looking_for))
                        <div class="col-xs-12 col-sm-6">
                            <div class="desired-job-title">
                                <h3 class="title">Desired job title</h3>
                                <p class="data">Engineer</p>
                            </div>
                            <div class="salary">
                                <h3 class="title">Salary</h3>
                                <p class="data"></p>
                                <ul>
                                    @if(isset($profile->looking_for->min_per_annum))
                                    <li>£{{$profile->looking_for->min_per_annum}} per annum</li>
                                    @endif
                                    @if(isset($profile->looking_for->min_per_hour))
                                    <li>£{{$profile->looking_for->min_per_hour}} per hour</li>
                                    @endif
                                </ul>
                                @if(!isset($profile->looking_for->min_per_annum) && !isset($profile->looking_for->min_per_hour))
                                <a href="/user/jobs/looking-for">
                                    Add salary
                                    <i class="glyphicon glyphicon-plus-sign"></i>
                                </a>
                                @endif
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
                                @foreach($profile->looking_for->getSectors() as $sector)
                                    <p class="data">{{$sector->title}}</p>
                                @endforeach
                            </div>
                        </div>
                        @endif
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
                        @if(count($user->cvs) > 0)
                        <div class="cv-details col-sm-12">
                            <div class="row">
                                <div class="current-cv col-sm-4">
                                    <h3 class="title">Your current CV</h3>
                                    <p class="data">
                                        <span class="cv-name">{{$user->cvs[0]->title}}</span>
                                        <span class="cv-uploaded">Added {{$user->cvs[0]->created_at->format('d F Y')}}</span>
                                        <span class="actions">
                                            <a class="download-cv" href="{{env('AWS_WEB_IMAGE_URL')}}/{{$user->cvs[0]->file_name}}">
                                                <i class="glyphicon glyphicon-download-alt"></i>
                                                Download
                                            </a>
                                            <a class="delete-cv" href="/user/delete/cv/{{$user->cvs[0]->id}}">
                                                <i class="glyphicon glyphicon-trash"></i>
                                                Delete
                                            </a>
                                        </span>
                                    </p>
                                </div>
                                <div class="manage-cv col-xs-12 col-sm-8">
                                    <h3 class="title">Manage your CV</h3>
                                    <div class="data">
                                        <p>Upload a new CV, or use our CV builder to build one for you.</p>
                                        <div>
                                            <a class="btn btn-inverse" href="/user/cv-builder/personal-details">CV Builder by {{env('APP_NAME')}}</a>
                                             <a class="btn btn-submit" href="/user/upload/cvs">Upload CV</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="alerts">
                            <div class="alert alert-danger">
                                <strong>You haven't uploaded a CV yet.</strong>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <p>Upload a new CV, or use our CV builder to build one for you.</p>
                            <div class="btns row">
                                <div class="col-xs-12 col-sm-6">
                                    <a class="btn btn-inverse" href="/user/cv-builder/personal-details">CV Builder by {{env('APP_NAME')}}</a>
                                    <a class="btn btn-submit" href="/user/upload/cvs">Upload CV</a>
                                </div>
                            </div>
                        </div>
                        @endif
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
                        <a class="action edit" href="/user/create/covers">Edit<i class="glyphicon glyphicon-menu-right" {{($user->covers->count() == 0) ? '' : 'style="display:none;"'}}></i></a>
                    </header>
                    <div class="content">
                        @if($user->covers->count() > 0)
                        <div class="escaped-statement">
                            <div class="title">
                                {{$user->covers[0]->title}}
                            </div>
                            <div class="description">
                                {{$user->covers[0]->cover}}
                            </div>
                        </div>
                        @endif
                        <a class="add-first" href="/user/create/covers" {{($user->covers->count() == 0) ? "style=display:none;" : ''}}>
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
                        <div class="experience-container">
                            <div>
                                @foreach($profile->work_experiences as $workExperience)
                                <div class="row work">
                                    <div class="action delete">
                                    </div>
                                    <div class="action edit">
                                    </div>
                                    <div class="when col-xs-12 col-sm-3 col-md-2">
                                        {{$workExperience->from->format('m/Y')}} - {{$workExperience->to->format('m/Y')}}
                                    </div>
                                    <div class="what col-xs-12 col-sm-9 col-md-10">
                                        <div class="title">
                                            {{$workExperience->job_title}}
                                        </div>
                                        <div class="company">
                                            {{$workExperience->company}}
                                        </div>
                                        <div class="description">
                                            {{$workExperience->description}}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @if($profile->work_experiences->count() == 0)
                        <a class="add-first" href="/user/create/work-experience?type={{$type}}">
                            <i class="glyphicon glyphicon-plus-sign"></i>
                            Add work experience
                        </a>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <section class="container-action-profile mb-10">
        <div class="container">
            <div class="row">
                <div class="save col-xs-6 col-sm-3 col-sm-offset-6 text-right">
                    <button class="btn btn-inverse">Save Profile</button>
                </div>
                <div class="publish col-xs-6 col-sm-3">
                    <div class="btn btn-submit">Publish Profile</div>
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
            <textarea type="text" name="about_me" rows="10" id="editor" class="ckeditor form-control  mb-2 mr-sm-2 mb-sm-0" ></textarea>
            <h4>Salary</h4>
            <input type="text" class="form-control" name="salary" value="">
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
    $('.edit-avatar').click(function (e) {
        e.preventDefault();
        console.log('click');
        $("#upload-profile").click();
    });
    $("#upload-profile").change(function () {
        console.log("did change");
        upload_profile();
    });
    $('.template-content').click(function(){
        var template = $(this).attr('data-href');
        window.location.href = '/job/profile/edit/' + template;
    })
</script>
@endsection