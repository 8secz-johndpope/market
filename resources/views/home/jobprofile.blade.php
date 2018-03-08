<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

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
                                    <!--<p class="details-item title-job">Engineer Computer</p> -->
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
                                <p>Your profile is 30% complete</p>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                                </div>
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
                        @if($user->cvs->count() > 0)
                        <div class="cv-details col-sm-12">
                            <div class="row">
                                <div class="current-cv col-sm-7">
                                    <h3 class="title">Your currents CVs</h3>
                                    <div class="row"> 
                                    @foreach($user->cvs as $cv)
                                    <div class="col-xs-12 col-sm-6">
                                        <p class="data">
                                            <span class="cv-name">{{$cv->title}}</span>
                                            <span class="cv-uploaded">Added {{$cv->created_at->format('d F Y')}}</span>
                                            <span class="actions">
                                                <a class="download-cv" href="{{env('AWS_CV_IMAGE_URL')}}/{{$cv->file_name}}">
                                                    <i class="glyphicon glyphicon-download-alt"></i>
                                                    Download
                                                </a>
                                                <a class="delete-cv" href="/user/delete/cv/{{$cv->id}}">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                    Delete
                                                </a>
                                            </span>
                                        </p>
                                    </div>
                                    @endforeach
                                    </div>
                                </div>
                                <div class="manage-cv col-xs-12 col-sm-5">
                                    <h3 class="title">Manage your CV</h3>
                                    <div class="data">
                                        <p>Upload a new CV, or use our CV builder to build one for you.</p>
                                        <div>
                                            <a class="btn btn-inverse" href="/user/cv-builder/personal-details?type={{$type}}">CV Builder by {{env('APP_NAME')}}</a>
                                             <a class="btn btn-submit" href="/user/upload/cvs?type={{$type}}">Upload CV</a>
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
                                    <a class="btn btn-inverse" href="/user/cv-builder/personal-details?type={{$type}}">CV Builder by {{env('APP_NAME')}}</a>
                                    <a class="btn btn-submit" href="/user/upload/cvs?type={{$type}}">Upload CV</a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container-templates-options mb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="template-options-title">Confirm or Select & Complete Your Profile</h2>
                    <p class="details-profile-subtitle">We have automatically allocated you a general profile. However you can confirm the general profile or select a new profile</p>
                    <p class="details-profile-subtitle">After selecting a profile, you should provide revelant information for each section in order to complete the profile</p>
                </div>
                <div class="col-sm-4">
                    <div class="template-item">
                        <h3 class="template-item-title">General Profile</h3>
                        <div class="template-content {{$type === $types[0] ? 'selected' : ''}}   {{$types[0]}}" data-href="{{$types[0]}}">
                            <div class="template-item-ribbon">
                                <span class="template-item-ribbon-title">
                                    General Profile
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="template-item">
                        <h3 class="template-item-title">Social Care & Childcare Profile</h3>
                        <div class="template-content {{$type === $types[1] ? 'selected' : ''}} socialcare" data-href="{{$types[1]}}">
                            <div class="template-item-ribbon">
                                <span class="template-item-ribbon-title">
                                   Social Care & Childcare Profile
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="template-item">
                        <h3 class="template-item-title">Sub Contractor Profile</h3>
                        <div class="template-content {{$type === $types[2] ? 'selected' : ''}}" data-href="{{$types[2]}}">
                            <div class="template-item-ribbon">
                                <span class="template-item-ribbon-title">
                                   Sub Contractor
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 text-center">
                    <p class="select-profile">To procced, you must confirm or select a profile</p>
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
                            @if($profile->looking_for->job_title != null)
                            <div class="desired-job-title">
                                <h3 class="title">Desired job title</h3>
                                <p class="data">Engineer</p>
                            </div>
                            @endif
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
                                @foreach($profile->looking_for->locations as $location)
                                <p class="data">London, South East England</p>
                                @endforeach
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
    
    <section class="container-status-availability mb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <header class="section-header">
                        <h2 class="title">Status & availability</h2>
                        <a class="action edit" href="/user/employment-status/create?type={{$type}}">Edit<i class="glyphicon glyphicon-menu-right"></i></a>
                    </header>
                    <div class="content row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="employment-status">
                                @if($profile->employmentStatus == null || $profile->employmentStatus->status == null)
                                <h3 class="title">Employment status</h3>
                                <p class="data">Unemployed</p>
                                @else
                                <h3 class="title">Employment status</h3>
                                <p class="data">{{$employmentStatus[$profile->employmentStatus->status - 1]}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if($type == $types[1])
                    <div class="content row">
                        <div class="col-xs-12">
                            <div class="employment-availibity">
                                <h3 class="title">Employment Availability</h3>
                                <div class="table-responsive availability-tab">
                                    <table id="zone-horaire" class="table table-striped table-bordered table-horaire-profile text-center">
                                        <thead>
                                            <tr class="active">
                                                <th></th> 
                                                <th class="hidden-xs">Mon</th> 
                                                <th class="visible-xs tableday">M</th> 
                                                <th class="hidden-xs">Tue</th> 
                                                <th class="visible-xs tableday">T</th> 
                                                <th class="hidden-xs">Wed</th> 
                                                <th class="visible-xs tableday">W</th> 
                                                <th class="hidden-xs">Thu</th> 
                                                <th class="visible-xs tableday">T</th> 
                                                <th class="hidden-xs">Fri</th> 
                                                <th class="visible-xs tableday">F</th> 
                                                <th class="hidden-xs">Sat</th> 
                                                <th class="visible-xs tableday">S</th> 
                                                <th class="hidden-xs">Sun</th> 
                                                <th class="visible-xs tableday">S</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="align-left active">6h / 9h</td> 
                                                @for($i=0; $i < 7; $i++)
                                                <td class="selected">
                                                    @if(isset($profile->availibility) && $profile->availibility->availibility_time(0, $i) != null)
                                                        <span class="glyphicon glyphicon-ok green"></span>
                                                    @else 
                                                        <span class="glyphicon green"></span>
                                                    @endif
                                                </td>
                                                @endfor
                                            </tr> 
                                            <tr>
                                                <td class="align-left active">9am - 12am</td> 
                                                 @for($i=0; $i < 7; $i++)
                                                <td class="selected">
                                                    @if(isset($profile->availibility) && $profile->availibility->availibility_time(1, $i) != null)
                                                        <span class="glyphicon glyphicon-ok green"></span>
                                                    @else 
                                                        <span class="glyphicon green"></span>
                                                    @endif
                                                </td>
                                                @endfor
                                            </tr> 
                                            <tr>
                                                <td class="align-left active">12pm - 2pm</td> 
                                                </td>
                                                @for($i=0; $i < 7; $i++)
                                                <td class="selected">
                                                    @if(isset($profile->availibility) && $profile->availibility->availibility_time(2, $i) != null)
                                                        <span class="glyphicon glyphicon-ok green"></span>
                                                    @else 
                                                        <span class="glyphicon green"></span>
                                                    @endif
                                                </td>
                                                @endfor
                                            </tr> 
                                            <tr>
                                                <td class="align-left active">2pm - 4pm</td> 
                                                @for($i=0; $i < 7; $i++)
                                                <td class="selected">
                                                    @if(isset($profile->availibility) && $profile->availibility->availibility_time(3, $i) != null)
                                                        <span class="glyphicon glyphicon-ok green"></span>
                                                    @else 
                                                        <span class="glyphicon green"></span>
                                                    @endif
                                                </td>
                                                @endfor
                                            </tr> 
                                            <tr>
                                                <td class="align-left active">4pm - 6pm</td> 
                                                @for($i=0; $i < 7; $i++)
                                                <td class="selected">
                                                    @if(isset($profile->availibility) && $profile->availibility->availibility_time(4, $i) != null)
                                                        <span class="glyphicon glyphicon-ok green"></span>
                                                    @else 
                                                        <span class="glyphicon green"></span>
                                                    @endif
                                                </td>
                                                @endfor
                                            </tr> 
                                            <tr>
                                                <td class="align-left active">6pm - 8pm</td> 
                                                @for($i=0; $i < 7; $i++)
                                                <td class="selected">
                                                    @if(isset($profile->availibility) && $profile->availibility->availibility_time(5, $i) != null)
                                                        <span class="glyphicon glyphicon-ok green"></span>
                                                    @else 
                                                        <span class="glyphicon green"></span>
                                                    @endif
                                                </td>
                                                @endfor
                                            </tr> 
                                            <tr>
                                                <td class="align-left active">Night</td> 
                                                @for($i=0; $i < 7; $i++)
                                                <td class="selected">
                                                    @if(isset($profile->availibility) && $profile->availibility->availibility_time(6, $i) != null)
                                                        <span class="glyphicon glyphicon-ok green"></span>
                                                    @else 
                                                        <span class="glyphicon green"></span>
                                                    @endif
                                                </td>
                                                @endfor
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
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
                        <a class="action edit" href="/user/create/covers?type={{$type}}" {{($profile->cover == null) ? "style=display:none;" : ''}}>Edit<i class="glyphicon glyphicon-menu-right"></i></a>
                    </header>
                    <div class="content">
                        @if($profile->cover != null)
                        <div class="escaped-statement">
                            <div class="title">
                                {{$profile->cover->title}}
                            </div>
                            <div class="description">
                                {{$profile->cover->cover}}
                            </div>
                        </div>
                        @endif
                        <a class="add-first" href="/user/create/covers?type={{$type}}" {{($profile->cover != null) ? "style=display:none;" : ''}}>
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
                        @if($profile->work_experiences->count() > 0)
                        <a href="/user/create/work-experience?type={{$type}}" class="action add">
                            Add
                            <i class="glyphicon glyphicon-menu-right"></i>
                        </a>
                        @endif
                    </header>
                    <div class="content">
                        <div class="experience-container">
                            <div>
                                @foreach($profile->work_experiences as $workExperience)
                                <div class="row work">
                                    <div class="action delete">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </div>
                                    <div class="action edit">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </div>
                                    <div class="when col-xs-12 col-sm-3 col-md-2">
                                        {{date_format(date_create($workExperience->from), 'm/Y')}} - 
                                        @if($workExperience->to != null)
                                        {{date_format(date_create($workExperience->to), 'm/Y')}}
                                        @else
                                        Present
                                        @endif
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
    <section class="container-languages mb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <header class="section-header">
                        <h2 class="title">Languages</h2>
                        @if($profile->languages->count() > 0)
                        <a href="/user/create/profile-languages?type={{$type}}" class="action edit">
                            Edit
                            <i class="glyphicon glyphicon-menu-right"></i>
                        </a>
                        @endif
                    </header>
                    <div class="content">
                        @if($profile->languages->count() > 0)
                        <div>
                            <div class="languages-row row">
                                @foreach($profile->languages as $profileLanguage)
                                <div class="language-block col-xs-12 col-sm-3">
                                    <strong>{{$profileLanguage->language->name}}</strong>
                                    (
                                    <span class="language-fluency">{{$languageLevels[$profileLanguage->level-1]}}</span>
                                    )
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @else
                        <a class="add-first" href="/user/create/profile-languages?type={{$type}}">
                            <i class="glyphicon glyphicon-plus-sign"></i>
                            Add languages
                        </a>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
     <section class="container-additional-information mb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <header class="section-header">
                        <h2 class="title">Additional Information</h2>
                        @if($profile->additionalInfo != null)
                        <a href="/user/create/profile-additional-info?type={{$type}}" class="action edit">
                            Edit
                            <i class="glyphicon glyphicon-menu-right"></i>
                        </a>
                        @endif
                    </header>
                    <div class="content row">
                        @if($profile->additionalInfo != null)
                            <div class="col-xs-12 col-md-6">
                                <!-- <div class="nationality-title">
                                    <h3 class="title">Nationality</h3>
                                    <p class="data">{{$profile->additionalInfo->nationality}}</p>
                                </div> -->
                                <div class="smoker-title">
                                    <h3 class="title">Smoker</h3>
                                    <p class="data">{{($profile->additionalInfo != null && $profile->additionalInfo->isSmoker()) ? 'Yes' : 'No' }}</p>
                                </div>
                            </div>
                            @if($profile->isSocialCare())
                            <div class="col-xs-12 col-md-6">
                                <div class="firts-aid-title">
                                    <h3 class="title">First Aid certificate</h3>
                                    <p class="data">{{($profile->additionalInfo != null && $profile->additionalInfo->hasFirstAid()) ? 'Yes' : 'No'}}</p>
                                </div>
                                 <div class="has-children-title">
                                    <h3 class="title">Do you have children?</h3>
                                    <p class="data">{{($profile->additionalInfo != null && $profile->additionalInfo->hasChildren()) ? 'Yes' : 'No'}}</p>
                                </div>
                            </div>
                            @endif
                            @if($profile->additionalInfo->about_me != null)
                                <div class="col-xs-12">
                                    <div class="about-title">
                                        <h3 class="title">Tell us a bit about yourself: Your education, work, hobbies, interest, ...</h3>
                                        <p class="data">{{$profile->additionalInfo->about_me}}</p>
                                    </div>
                                </div>
                            @endif
                        @else
                            <a class="add-first" href="/user/create/profile-additional-info?type={{$type}}">
                                <i class="glyphicon glyphicon-plus-sign"></i>
                                Add information
                            </a>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <section class="container-other-information mb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <header class="section-header">
                        <h2 class="title">Car & driving license</h2>
                        @if($profile->carAndDriving != null)
                        <a href="/user/create/car-driving?type={{$type}}" class="action edit">
                            Edit
                            <i class="glyphicon glyphicon-menu-right"></i>
                        </a>
                        @endif
                    </header>
                    <div class="content">
                        @if($profile->carAndDriving != null)
                        <div class="driving-row row">
                            <div>
                                @if($profile->carAndDriving->hasLicence())
                                <div class="licence-col col-xs-12 col-md-6">
                                    <strong>Licence</strong>
                                    <p>I have a full license and am eligible to drive in the UK</p>
                                </div>
                                @endif
                                @if($profile->carAndDriving->hasCar())
                                <div class="car-col col-xs-12 col-md-6">
                                    <strong>Car</strong>
                                    <p>I have a car</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        @else
                        <a class="add-first" href="/user/create/car-driving?type={{$type}}">
                            <i class="glyphicon glyphicon-plus-sign"></i>
                            Add information
                        </a>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    @if($type == $types[1])
    <section class="container-task-can-help mb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <header class="section-header">
                        <h2 class="title">Task that you can help with & Services offered</h2>
                        <a class="action edit" href="/user/create/tasks-help-services?type={{$type}}">Edit<i class="glyphicon glyphicon-menu-right"></i></a>
                    </header>
                    <div class="content row">
                        <h3 class="title">Task that you can help with</h3>
                        <div class="experience-container">
                            <div>
                                <div class="col-md-11 col-md-offset-1 col-xs-12">
                                    <ul class="list-unstyled">
                                        @for($i=0; $i<$tasksHelp->count(); $i++)
                                        <li class="task-block row no-margin">
                                            <div class="col-md-6 no-padding col-xs-12">
                                                <div class="row no-margin">
                                                    <div class="col-md-2 no-padding col-xs-3">
                                                        <div class="ui-rating">
                                                            @for($j=0; $j < $tasksHelpValues[$tasksHelp[$i]->id]; $j++)
                                                                <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                            @endfor
                                                            @for($j; $j < 3; $j++)
                                                                <a title="ui rating value 1" class="rating-star rating-star-empty"></a>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <div class="service-text col-md-10 col-xs-9">
                                                        <p class="littlep">{{$tasksHelp[$i]->title}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                $i++;
                                            @endphp
                                            <div class="col-md-6 no-padding col-xs-12">
                                                <div class="row no-margin">
                                                    <div class="col-md-2 no-padding col-xs-3">
                                                        <div class="ui-rating">
                                                            @for($j=0; $j < $tasksHelpValues[$tasksHelp[$i]->id]; $j++)
                                                                <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                            @endfor
                                                            @for($j; $j < 3; $j++)
                                                                <a title="ui rating value 1" class="rating-star rating-star-empty"></a>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <div class="service-text col-md-10 col-xs-9">
                                                        <p class="littlep">{{$tasksHelp[$i]->title}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endfor
                                    </ul>
                                </div>
                                </div>
                        </div>
                    </div>
                    <div class="content row">
                        <h3 class="title">Task that you can help with</h3>
                        <div class="experience-container">
                            <div>
                                <ul class="services list-inline">
                                    @for($i=1; $i <= count(SocialcareServiceOffered::SERVICES_OFFERED); $i++)
                                    @if($profile->socialcareServiceOffered($i) != null)
                                    <li class="service active">
                                    @else
                                    <li class="service">
                                    @endif
                                        <a>
                                            <span>
                                                {{SocialcareServiceOffered::SERVICES_OFFERED[$i]}}
                                            </span>
                                        </a>
                                    </li>
                                    @endfor
                                   @if($profile->socialcareServiceOffered(2) != null)
                                    <li class="service active">
                                    @else
                                    <li class="service">
                                    @endif
                                        <a>
                                            <span>
                                                Pet sitting
                                            </span>
                                        </a>
                                    </li>
                                    @if($profile->socialcareServiceOffered(3) != null)
                                    <li class="service active">
                                    @else
                                    <li class="service">
                                    @endif
                                        <a>
                                            <span>
                                                Housekeeping
                                            </span>
                                        </a>
                                    </li>
                                    @if($profile->socialcareServiceOffered(4) != null)
                                    <li class="service active">
                                    @else
                                    <li class="service">
                                    @endif
                                        <a>
                                            <span>
                                                Childcare
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    @if($type == $types[2])
    <section class="container-work-publications mb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <header class="section-header">
                        <h2 class="title">Publications</h2>
                        @if($profile->publications->count() > 0)
                        <a href="/user/create/publication?type={{$type}}" class="action add">
                            Add
                            <i class="glyphicon glyphicon-menu-right"></i>
                        </a>
                        @endif
                    </header>
                    <div class="content">
                        <div class="publications-container">
                            <div>
                                @foreach($profile->publications as $publication)
                                <div class="row publication">
                                    <div class="action delete">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </div>
                                    <div class="action edit">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </div>
                                    <div class="when col-xs-12 col-sm-3 col-md-2">
                                        {{date_format(date_create($publication->date), 'd/m/Y')}}
                                    </div>
                                    <div class="what col-xs-12 col-sm-9 col-md-10">
                                        <div class="typename">
                                            <b>{{$publication->title}}</b>
                                        </div>
                                        <div class="company">
                                            {{$publication->publisher}}
                                        </div>
                                        <div class="url">
                                            {{$publication->url}}
                                        </div>

                                        <div class="description">
                                            {{$publication->description}}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @if($profile->publications->count() == 0)
                        <a class="add-first" href="/user/create/publication?type={{$type}}">
                            <i class="glyphicon glyphicon-plus-sign"></i>
                            Add publication
                        </a>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <section class="container-portfolio mb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <header class="section-header">
                        <h2 class="title">Portfolio</h2>
                        @if($profile->portfolio != null)
                        <a href="/user/create/portfolio?type={{$type}}" class="action edit">
                            Edit
                            <i class="glyphicon glyphicon-menu-right"></i>
                        </a>
                        @endif
                    </header>
                    <div class="content">
                        @if($profile->portfolio != null)
                        <div class="portfolio-row row">
                            <div>
                                <div class="col-xs-12">
                                    <strong>{{$profile->portfolio->title}}</strong>
                                    <div class="container-images row">
                                        @foreach($profile->portfolio->images as $image)
                                        <div class="portfolio-img col-xs-6 col-sm-3 col-md-4">
                                            <div class="image-block">
                                                <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$image->image}}">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <a class="add-first" href="/user/create/portfolio?type={{$type}}">
                            <i class="glyphicon glyphicon-plus-sign"></i>
                            Add information
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container-qualifications mb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <header class="section-header">
                        <h2 class="title">Qualifications</h2>
                        @if($profile->qualifications->count() > 0)
                        <a href="/user/create/qualification?type={{$type}}" class="action add">
                            Add
                            <i class="glyphicon glyphicon-menu-right"></i>
                        </a>
                        @endif
                    </header>
                    <div class="content">
                        <div class="qualifications-container">
                            <div>
                                @foreach($profile->qualifications as $qualification)
                                <div class="row qualification">
                                    <div class="action delete">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </div>
                                    <div class="action edit">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </div>
                                    <div class="when col-xs-12 col-sm-3 col-md-2">
                                        {{date_format(date_create($qualification->started_on), 'Y')}} - {{date_format(date_create($qualification->ended_on), 'Y')}}
                                    </div>
                                    <div class="what col-xs-12 col-sm-9 col-md-10">
                                        <div class="typename">
                                            <b>{{$qualification->type->name}}</b>
                                        </div>
                                        <div class="institution">
                                            {{$qualification->school_name}}
                                        </div>
                                        <div class="qualification-list">
                                            <div class="qualification-item">
                                                <span class="subject-name">{{$qualification->degree}}</span>
                                                <span class="grade-value">
                                                    <span>(Grade: {{$qualification->grade->name}})</span>
                                                </span>
                                            </div> 
                                            {{$qualification->description}}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @if($profile->qualifications->count() == 0)
                        <a class="add-first" href="/user/create/qualification?type={{$type}}">
                            <i class="glyphicon glyphicon-plus-sign"></i>
                            Add qualification
                        </a>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <section class="container-skills mb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <header class="section-header">
                        <h2 class="title">Skills</h2>
                        @if($profile->skills->count() > 0)
                        <a href="/user/create/skills?type={{$type}}" class="action add">
                            Edit
                            <i class="glyphicon glyphicon-menu-right"></i>
                        </a>
                        @endif
                    </header>
                    <div class="content">
                        <ul class="skills-list">
                            @foreach($profile->skills as $skill)
                            <li class="lozenge">
                                {{$skill->title}}
                            </li>
                            @endforeach
                        </ul>
                        @if($profile->skills->count() == 0)
                        <div>
                            <a class="add-first" href="/user/create/skills?type={{$type}}">
                                <i class="glyphicon glyphicon-plus-sign"></i>
                                Add skills & expertise
                            </a>
                        </div>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    @endif
    <section class="container-action-profile mb-10">
        <div class="container">
            <div class="row">
                <div class="save col-xs-6 col-sm-3 col-sm-offset-6 text-right">
                    <button class="btn btn-inverse">Save Profile</button>
                </div>
                <div class="publish col-xs-6 col-sm-3">
                    <a href="/user/job/publish/profile?type={{$type}}" class="btn btn-submit">Publish Profile</a>
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
@endsection
@section('scripts')
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