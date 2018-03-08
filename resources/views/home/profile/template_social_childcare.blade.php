@extends('layouts.app')

@section('title', 'Anna T. |' . env('APP_NAME'))
@php
    $date = new Datetime();
    $dateMs = $date->getTimestamp();
@endphp
@section('styles')
<link href="{{ asset("/css/profile.css?q=$dateMs") }}" rel="stylesheet">
@endsection

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')   
<div class="background-body body">
    <div class="header-image background-image">
    </div>
    <div class="header container-ad-applicant">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-xs-12 main">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12">
                            <figure class="ad-applicant-picture" style="background: url({{env('AWS_WEB_IMAGE_URL')}}/{{$profile->user->image}}); background-size: cover;">
                                <span data-toggle="tooltip" data-placement="top" data-trigger="focus hover" class="glyphicon glyphicon-ok" data-title="Details, ID, and diplomas of this profile have been verified manually by our teams.">
                                    <span class="verification-level">3</span>
                                </span>
                            </figure>
                        </div>
                        <div class="col-sm-9 ad-applicant-profil-infos col-xs-12">
                            <div class="person">
                                <h1>
                                    <span class="ad-applicant-name">{{$profile->user->name}}</span>
                                    @if(isset($profile->looking_for))
                                    <span class="ad-applicant-job-title">{{$profile->looking_for->job_title}}</span>
                                    @endif
                                    @if(isset($profile->user->address))
                                    <span>in</span>
                                    <span class="ad-applicant-address">
                                        <span class="address-location">{{$profile->user->address->city}}</span>
                                    </span>
                                    @endif
                                </h1>
                            </div>
                            <ul class="list-inline list-unstyled ad-applicant-experiences row">
                                <li>41 years old</li>
                                <li>7 years of experience</li>
                            </ul>
                            <ul class="list-inline list-unstyled ad-applicant-services">
                                @if(isset($profile->looking_for))
                                    @foreach($profile->looking_for->jobTypes as $jobType)
                                    <li class="available">
                                        {{$jobType->title}}
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                            <div class="visible-xs">
                                <div class="row mb-20">
                                    <div class="col-xs-12">
                                        <div class="row">
                                            <button id="about-applicant" type="button" class="btn btn-expandeble col-xs-4 col-xs-offset-4" data-toggle="collapse" data-target="#about-applicant-info">
                                                About Us
                                                <span class="caret"></span>
                                            </button>
                                        </div>
                                        <div class="row collapse" id="about-applicant-info">
                                            <div class="col-xs-12">
                                                <div class="part">
                                                    <ul class="list-unstyled">
                                                        <li class="row no-margin">
                                                            <h4>Verification Status</h4>
                                                            <div>
                                                                <div class="badge-container badge-container-profile">
                                                                    <div>
                                                                        <div class="badge-container-badge">
                                                                            DBS
                                                                            <span class="glyphicon glyphicon-ok"></span>
                                                                        </div>
                                                                    </div>
                                                                    <span>This Applicant has a DBS document, available for verification</span>
                                                                </div>
                                                            </div>
                                                            <p>
                                                                The address, phone number, ID and diplomas of this profile are available. 
                                                            </p>
                                                        </li>
                                                        @if($profile->languages->count() > 0)
                                                        <li class="row">
                                                            <div class="col-md-2 col-xs-6">Languages spoken:</div>
                                                            <div class="col-md-10 col-xs-6 no-padding">
                                                                @foreach($profile->languages as $profileLanguage)
                                                                <span class="border">$profileLanguage->language->name</span>
                                                                ($profileLanguage->getLevel()),
                                                                @endforeach 
                                                                <span class="border">Russia</span>
                                                                (Fluently), 
                                                                <span class="border">English</span>
                                                                (Fluently), 
                                                            </div>
                                                        </li>
                                                        @endif
                                                        <li class="row">
                                                            <div class="col-md-2 col-xs-6">Nationality:</div>
                                                            <div class="col-md-10 col-xs-6 no-padding">
                                                                <span class="border">British</span>
                                                            </div>
                                                        </li>
                                                        <li class="row">
                                                            <div class="col-md-2 col-xs-6">Experience:</div>
                                                            <div class="col-md-10 col-xs-6 no-padding">
                                                                <span class="border">7 years of experience</span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="part">
                                                    <ul class="list-unstyled user-options">
                                                        <li class="row">
                                                            <div class="col-md-5 col-xs-12 xs-no-padding">
                                                                <div class="row">
                                                                    <span class="col-md-9 col-xs-6">Drivers License
                                                                    </span>
                                                                    <span class="col-md-2 col-md-offset-1 col-xs-3 span-no">No</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5 col-md-offset-1 col-xs-12">
                                                                <div class="row">
                                                                    <span class="col-md-9 no-padding col-xs-6">First Aid certificate
                                                                    </span>
                                                                    <span class="col-md-2 col-md-offset-1 col-xs-3 span-yes">Yes</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="row">
                                                            <div class="col-md-5 col-xs-12 xs-no-padding">
                                                                <div class="row">
                                                                    <span class="col-md-9 col-xs-6">Access to a vehicle
                                                                    </span>
                                                                    <span class="col-md-2 col-md-offset-1 col-xs-3 span-no">No</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5 col-md-offset-1 col-xs-12">
                                                                <div class="row">
                                                                    <span class="col-md-9 no-padding col-xs-6">Has children
                                                                    </span>
                                                                    <span class="col-md-2 col-md-offset-1 col-xs-3 span-no">No</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="row">
                                                            <div class="col-md-5 col-xs-12 xs-no-padding">
                                                                <div class="row">
                                                                    <span class="col-md-9 col-xs-6">Non smoker
                                                                    </span>
                                                                    <span class="col-md-2 col-md-offset-1 col-xs-3 span-yes">Yes</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="part">
                                                    <h4>Services offered by Anna</h4>
                                                    <ul class="services list-inline">
                                                        <li class="service">
                                                            <a>
                                                                <span>
                                                                    Tutoring
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="service">
                                                            <a>
                                                                <span>
                                                                    Pet sitting
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="service">
                                                            <a>
                                                                <span>
                                                                    Housekeeping
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="service active">
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
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 sidebar hidden-xs">
                    <div class="row">
                        <section id="profile-sidebar" class="ad-sidebar-right col-md-12 affix-top">
                            <header>
                                <h1>Your Profile</h1>
                            </header>
                            <div class="ad-sidebar-right-container clearfix">
                                <a class="btn btn-lg btn-primary" href="/job/profile/edit/social-childcare">Modify your profile</a>
                                <a class="btn btn-verification">Verification</a>
                                <a class="btn btn-success" href="#">Publish</a>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content container-ad-applicant">
        <div class="container">
            @if(isset($profile->cover))
            <div class="row">
                <div class="col-md-8 clearfix col-xs-12">
                    <div class="row no-margin">
                        <div class="col-xs-12 content">
                            <h4 class="info-title dimgrey">{{$profile->cover->title}}</h4>
                            <p class="break-word">
                                {{$profile->cover->description}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="row hidden-xs">
                <div class="col-xs-10 no-padding">
                    <div class="part">
                        <ul class="list-unstyled">
                            <li class="row no-margin">
                                <h4>Verification Status</h4>
                                <div>
                                    <div class="badge-container badge-container-profile">
                                        <div>
                                            <div class="badge-container-badge">
                                                DBS
                                                <span class="glyphicon glyphicon-ok"></span>
                                            </div>
                                        </div>
                                        <span>This Applicant has a DBS document, available for verification</span>
                                    </div>
                                </div>
                                <p>
                                    The address, phone number, ID and diplomas of this profile are available. 
                                </p>
                            </li>
                            @if($profile->languages->count() > 0)
                            <li class="row">
                                <div class="col-md-2 col-sm-3 col-xs-7">Languages spoken:</div>
                                <div class="col-md-10 col-sm-9 col-xs-5 no-padding">
                                    @foreach($profile->languages as $profileLanguage)
                                    <span class="border">{{$profileLanguage->language->name}}</span>
                                    ({{$profileLanguage->getType()}}),
                                    @endforeach 
                                </div>
                            </li>
                            @endif
                            <li class="row">
                                <div class="col-md-2 col-sm-3 col-xs-7">Nationality:</div>
                                <div class="col-md-10 col-sm-9 col-xs-5 no-padding">
                                    <span class="border">British</span>
                                </div>
                            </li>
                            <li class="row">
                                <div class="col-md-2 col-sm-3 col-xs-7">Experience:</div>
                                <div class="col-md-10 col-sm-9 col-xs-5 no-padding">
                                    <span class="border">7 years of experience</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    @if(isset($profile->additionalInfo))
                    <div class="part">
                        <ul class="list-unstyled user-options">
                            <li class="row">
                                <div class="col-md-5 col-sm-5 col-xs-12 xs-no-padding">
                                    <div class="row">
                                        <span class="col-md-9 col-xs-9">Drivers License
                                        </span>
                                        <span class="col-sm-2 col-md-2 col-md-offset-1 col-xs-3 span-no">No</span>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-5 col-md-offset-1 col-xs-12">
                                    <div class="row">
                                        <span class="col-md-9 no-padding col-xs-9">First Aid certificate
                                        </span>
                                        <span class="col-sm-2 col-md-2 col-md-offset-1 col-xs-3 span-yes">Yes</span>
                                    </div>
                                </div>
                            </li>
                            <li class="row">
                                <div class="col-md-5 col-sm-5 col-xs-12 xs-no-padding">
                                    <div class="row">
                                        <span class="col-md-9 col-xs-9">Access to a vehicle
                                        </span>
                                        <span class="col-sm-2 col-md-2 col-md-offset-1 col-xs-3 span-no">No</span>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-5 col-md-offset-1 col-xs-12">
                                    <div class="row">
                                        <span class="col-md-9 no-padding col-xs-9">Has children
                                        </span>
                                        <span class="col-sm-2 col-md-2 col-md-offset-1 col-xs-3 span-no">No</span>
                                    </div>
                                </div>
                            </li>
                            <li class="row">
                                <div class="col-md-5 col-sm-5 col-xs-12 xs-no-padding">
                                    <div class="row">
                                        <span class="col-md-9 col-xs-9">Non smoker
                                        </span>
                                        <span class="col-sm-2 col-md-2 col-md-offset-1 col-xs-3 span-yes">Yes</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    @endif
                    <div class="part">
                        <h4>Services offered by {{$profile->user->name}}</h4>
                        <ul class="services list-inline">
                            @for($i=1; $i <= count($servicesOffered); $i++)
                                @if($profile->socialcareServiceOffered($i) != null)
                                <li class="service active">
                                @else
                                <li class="service">
                                @endif
                                    <a>
                                        <span>
                                            {{$servicesOffered[$i - 1]}}
                                        </span>
                                    </a>
                                </li>
                            @endfor
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="description container-ad-applicant">
        <div class="container">
            <div class="row part">
                <div class="col-md-10 clearfix col-xs-12">
                    <h4 class="info-title dimgrey">
                        <div class="row no-margin">
                            <div class="col-md-1 title-icon bg-blue col-xs-2">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="col-md-11 title col-xs-10">
                                Availability  Anna
                            </div>
                        </div>
                    </h4>
                    <div class="block block-calendar block-availability">
                        <div class="row">
                            <div class="col-md-11 col-md-offset-1 col-xs-12">
                                <div class="table-responsive availability-tab">
                                    <table id="zone-horaire" class="table table-striped table-bordered table-horaire-profile">
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
                                                <td class="align-left active">6h / 8h</td>
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
                                                <td class="align-left active">8am - 10am</td> 
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                            </tr> 
                                            <tr>
                                                <td class="align-left active">10am - 12pm</td> 
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                            </tr> 
                                            <tr>
                                                <td class="align-left active">12pm - 2pm</td> 
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                            </tr> 
                                            <tr>
                                                <td class="align-left active">2pm - 4pm</td> 
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                            </tr> 
                                            <tr>
                                                <td class="align-left active">4pm - 6pm</td> 
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                            </tr> 
                                            <tr>
                                                <td class="align-left active">6pm - 8pm</td> 
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                            </tr> 
                                            <tr>
                                                <td class="align-left active">20h / 24h</td> 
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                            </tr> 
                                            <tr>
                                                <td class="align-left active">Night</td> 
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                                <td class="selected">
                                                    <span class="glyphicon glyphicon-ok green"></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="zone-horaire-details">
                                    <span class="availability">
                                        Will accept last minute babysitting
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row part">
                <div class="col-md-10 col-xs-12">
                    <h4 class="info-title dimgrey">
                        <div class="row no-margin">
                            <div class="col-md-1 title-icon bg-blue col-xs-2">
                                <i class="far fa-check-square"></i>
                            </div>
                            <div class="col-md-11 title col-xs-10">
                                Tasks that Anna can help with
                            </div>
                        </div>
                    </h4>
                    <div class="row no-margin">
                        <div class="col-md-11 col-md-offset-1 col-xs-12">
                            <ul class="list-unstyled">
                                <li class="task-block row no-margin">
                                    <div class="col-md-6 no-padding col-xs-12">
                                        <div class="row no-margin">
                                            <div class="col-md-2 no-padding col-xs-3">
                                                <div class="ui-rating">
                                                    <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                    <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                    <a title="ui rating value 1" class="rating-star rating-star-empty"></a>
                                                </div>
                                            </div>
                                            <div class="service-text col-md-10 col-xs-9">
                                                <p class="littlep">Cooking</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 no-padding col-xs-12">
                                        <div class="row no-margin">
                                            <div class="col-md-2 no-padding col-xs-3">
                                                <div class="ui-rating">
                                                    <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                    <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                    <a title="ui rating value 1" class="rating-star rating-star-empty"></a>
                                                </div>
                                            </div>
                                            <div class="service-text col-md-10 col-xs-9">
                                                <p class="littlep">Ironing</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="task-block row no-margin">
                                    <div class="col-md-6 no-padding col-xs-12">
                                        <div class="row no-margin">
                                            <div class="col-md-2 no-padding col-xs-3">
                                                <div class="ui-rating">
                                                    <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                    <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                    <a title="ui rating value 1" class="rating-star rating-star-empty"></a>
                                                </div>
                                            </div>
                                            <div class="service-text col-md-10 col-xs-9">
                                                <p class="littlep">Help with homework</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 no-padding col-xs-12">
                                        <div class="row no-margin">
                                            <div class="col-md-2 no-padding col-xs-3">
                                                <div class="ui-rating">
                                                    <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                    <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                    <a title="ui rating value 1" class="rating-star rating-star-empty"></a>
                                                </div>
                                            </div>
                                            <div class="service-text col-md-10 col-xs-9">
                                                <p class="littlep">Housework</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="task-block row no-margin">
                                        <div class="col-md-6 no-padding col-xs-12">
                                            <div class="row no-margin">
                                                <div class="col-md-2 no-padding col-xs-3">
                                                    <div class="ui-rating">
                                                    <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                    <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                    <a title="ui rating value 1" class="rating-star rating-star-empty"></a>
                                                </div>
                                                </div>
                                                <div class="service-text col-md-10 col-xs-9">
                                                    <p class="littlep">Wedding Day supervision</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 no-padding col-xs-12">
                                            <div class="row no-margin">
                                                <div class="col-md-2 no-padding col-xs-3">
                                                    <div class="ui-rating">
                                                    <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                    <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                    <a title="ui rating value 1" class="rating-star rating-star-empty"></a>
                                                </div>
                                                </div>
                                                <div class="service-text col-md-10 col-xs-9">
                                                    <p class="littlep">Newborn (under  6 months)</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="task-block row no-margin">
                                        <div class="col-md-6 no-padding col-xs-12">
                                            <div class="row no-margin">
                                                <div class="col-md-2 no-padding col-xs-3">
                                                    <div class="ui-rating">
                                                    <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                    <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                    <a title="ui rating value 1" class="rating-star rating-star-empty"></a>
                                                </div>
                                                </div>
                                                <div class="service-text col-md-10 col-xs-9">
                                                    <p class="littlep">Infant (6 months to 2 years)</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 no-padding col-xs-12">
                                            <div class="row no-margin">
                                                <div class="col-md-2 no-padding col-xs-3">
                                                    <div class="ui-rating">
                                                    <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                    <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                    <a title="ui rating value 1" class="rating-star rating-star-empty"></a>
                                                </div>
                                                </div>
                                                <div class="service-text col-md-10 col-xs-9">
                                                    <p class="littlep">Toddlers (2 to 6 years)</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="task-block row no-margin">
                                        <div class="col-md-6 no-padding col-xs-12">
                                            <div class="row no-margin">
                                                <div class="col-md-2 no-padding col-xs-3">
                                                    <div class="ui-rating">
                                                    <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                    <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                    <a title="ui rating value 1" class="rating-star rating-star-empty"></a>
                                                </div>
                                                </div>
                                                <div class="service-text col-md-10 col-xs-9">
                                                    <p class="littlep">School Aged Children (6 years and up)</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 no-padding col-xs-12">
                                            <div class="row no-margin">
                                                <div class="col-md-2 no-padding col-xs-3">
                                                    <div class="ui-rating">
                                                    <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                    <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                    <a title="ui rating value 1" class="rating-star rating-star-empty"></a>
                                                </div>
                                                </div>
                                                <div class="service-text col-md-10 col-xs-9">
                                                    <p class="littlep">Pet help</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="task-block row no-margin">
                                        <div class="col-md-6 no-padding col-xs-12">
                                            <div class="row no-margin">
                                                <div class="col-md-2 no-padding col-xs-3">
                                                    <div class="ui-rating">
                                                    <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                    <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                    <a title="ui rating value 1" class="rating-star rating-star-empty"></a>
                                                </div>
                                                </div>
                                                <div class="service-text col-md-10 col-xs-9">
                                                    <p class="littlep">Children with disabilities</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 no-padding col-xs-12">
                                            <div class="row no-margin">
                                                <div class="col-md-2 no-padding col-xs-3">
                                                    <div class="ui-rating">
                                                    <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                    <a title="ui rating value 1" class="rating-star rating-star-full"></a>
                                                    <a title="ui rating value 1" class="rating-star rating-star-empty"></a>
                                                </div>
                                                </div>
                                                <div class="service-text col-md-10 col-xs-9">
                                                    <p class="littlep">Sick children</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="experience container-ad-applicant">
            <div class="container">
                <div class="row">
                    <div class="col-md-10  clearfix col-xs-16">
                        <h4 class="info-title dimgrey">
                            <div class="row no-margin">
                                <div class="col-md-1 title-icon bg-blue col-xs-2">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                <div class="col-md-11 title col-xs-10">
                                    Professional Experience:7 years of experience
                                </div>
                            </div>
                        </h4>
                        <div class="row no-margin">
                            <div class="col-md-11 col-md-offset-1 col-xs-12">
                                <ul class="list-unstyled">
                                    <li class="row">
                                        <div class="col-sm-2 col-md-2 col-xs-12 left">
                                            <span class="date-text">From 07-1990</span>
                                            <span class="date-text">Until 08-2002</span>
                                        </div>
                                        <div class="col-sm-10 col-md-10 col-xs-12 right">
                                            <p class="littlep">I have looked after her son since she gave birth as was unwell and unfit,  I was living with her, doing all the housekeeping and cooking and looking after new born baby till he was 13 years old. Then I got married and moved away to live with my husband in 2002.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hobbies container-ad-applicant">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 clearfix col-xs-12">
                        <h4 class="info-title dimgrey">
                            <div class="row no-margin">
                                <div class="col-md-1 title-icon bg-blue col-xs-2">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="col-md-11 title col-xs-10">
                                    More about Anna
                                </div>
                            </div>
                        </h4>
                        <div class="row no-margin">
                            <div class="col-md-11 col-md-offset-1 col-xs-12 pl0">
                                <p>
                                    I have a postgraduate degree in Medicine, years of experience in clinical as well as academic settings at the Universities and hospitals in the UK as well as overseas. Multiple and numerous skills and expertise:
                                    I play piano, compose music, paint and had 10 personal art exhibitions, I act and was featured in many TV programmes and films.
                                    I love gardening, cooking, baking, sawing , knitting, reading, using media, watching cartoons/animations, comedies, movies, I taught drama and acting at the college and love entertaining, playing and  teaching children science, biology, reading, maths, drawing, painting, making things/ crafts and helping with homework and etc.
                                    I am experienced first Aider, have CRB/DBS checks. I don't drive and do not own a car and can not swim.
                                    No allergies and easy going.
                                    I aim to find parents who need my help and they instead make my experience pleasant and joyful and happy.
                                    Many thanks, Anna
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-map container-ad-applicant">
            <div class="container">
                <div class="row">
                    <div class="clearfix col-xs-12">
                        <h4 class="info-title dimgrey">
                            <div class="row no-margin">
                                <div class="col-md-1 title-icon bg-blue col-xs-2">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="col-md-11 title col-xs-10">
                                    Location
                                </div>
                            </div>
                        </h4>
                        <div class="row no-margin">
                            <div class="col-md-8 col-sm-8 col-md-offset-1 main col-xs-12">
                                <div class="map">
                                    <div id="profile-map-canvas"></div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4 side pull-right hidden-xs">
                                <div class="row">
                                    <div class="col-xs-12 bg-white">
                                        <header>
                                            <h4>Childcare near London</h4>
                                            <span>
                                                <img src="https://static.yoopies.com/bundles/yoopiescore/img/profile-v4/icon-location.png?1322" height="60px">
                                            </span>
                                        </header>
                                        <div class="content">
                                            <ul class="list-unstyled">
                                                <li><a>Watford</a></li>
                                                <li><a>Orpington</a></li>
                                                <li><a>Epsom</a></li>
                                                <li><a>Walton-on-Thames</a></li>
                                                <li><a>Hatfield</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var map;
    var panorama;
    var service;
    function initMap() {
        var uluru = {lat: 51.5073509, lng: -0.1277583};
         map = new google.maps.Map(document.getElementById('profile-map-canvas'), {
            zoom: 14,
            center: uluru
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
    }
    $(document).ready(function() {
        initMap();
    });
</script>
@endsection