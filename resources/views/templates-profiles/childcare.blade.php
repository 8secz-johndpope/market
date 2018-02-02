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
                <div class="col-md-7 col-xs-12 main">
                    <div class="col-md-3 col-xs-12">
                        <figure class="ad-applicant-picture">
                            <span data-toggle="tooltip" data-placement="top" data-trigger="focus hover" class="glyphicon glyphicon-ok" data-title="Details, ID, and diplomas of this profile have been verified manually by our teams."></span>
                        </figure>
                    </div>
                    <div class="col-md-9 ad-applicant-profil-infos col-xs-12">
                        <div class="person">
                            <h1>
                                <span class="ad-applicant-name">Anna T.</span>
                                <span class="ad-applicant-job-title">Nanny</span>
                                <span>in</span>
                                <span class="ad-applicant-address">
                                    <span class="address-location">London</span>
                                </span>
                            </h1>
                        </div>
                        <ul class="list-inline list-unstyled ad-applicant-experiences row">
                            <li>41 years old</li>
                            <li>7 years of experience</li>
                        </ul>
                        <ul class="list-inline list-unstyled ad-applicant-services">
                            <li class="available">
                                Occasional
                            </li>
                            <li class="available">
                                Part time / After School
                            </li>
                            <li class="available">
                                Full time
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5 hidden-xs">

                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="content container-ad-applicant">
        <div class="container">
            <div class="row">
                <div class="col-md-10 clearfix col-xs-12">
                    <h4 class="info-title dimgrey">Available upon your request, thank you.</h4>
                    <p class="break-word">Hello and hope my message finds you well.<br> <br>
                        I am 40 years old West London (Chiswick) based full time available (previously experienced and qualified  medical professional) looking for vacancies to look after children and support parents with essential child minding tasks.<br>
                        I have number of skills, experiences and knowledge that may be beneficial for tutoring and teaching children too.<br> <br>
                        I am available upon your request and feel free to contact me directly by email or phone as well.<br> <br>
                        Many thanks and yours faithfully,<br>
                        Anna Tilbury
                    </p>
                </div>
            </div>
            <div class="row hidden-xs">
                <div class="col-xs-12 no-padding">
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
                                        <span>This Applicant has a DBS document, checked by the {{env('APP_NAME')}} Team</span>
                                    </div>
                                </div>
                                <p>
                                    The address, phone number, ID and diplomas of this profile have been manually reviewed by our team. 
                                </p>
                            </li>
                            <li class="row">
                                <div class="col-md-4 col-xs-7">Languages spoken:</div>
                                <div class="col-md-8 col-xs-5 no-padding">
                                    <span class="border">Armenian</span>
                                    (Native Language)
                                    <span class="border">Russia</span>
                                    (Fluently)
                                    <span class="border">English</span>
                                    (Fluently)
                                </div>
                            </li>
                            <li class="row">
                                <div class="col-md-4 col-xs-7">Nationality:</div>
                                <div class="col-md-8 col-xs-5 no-padding">
                                    <span class="border">British</span>
                                </div>
                            </li>
                            <li class="row">
                                <div class="col-md-4 col-xs-7">Experience:</div>
                                <div class="col-md-8 col-xs-5 no-padding">
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
                                        <span class="col-md-10 col-xs-9">Drivers License
                                        </span>
                                        <span class="col-md-1 col-md-offset-1 col-xs-3 span-no">No</span>
                                    </div>
                                </div>
                                <div class="col-md-5 col-md-offset-1 col-xs-12">
                                    <div class="row">
                                        <span class="col-md-10 no-padding col-xs-9">First Aid certificate
                                        </span>
                                        <span class="col-md-1 col-md-offset-1 col-xs-3 span-yes">Yes</span>
                                    </div>
                                </div>
                            </li>
                            <li class="row">
                                <div class="col-md-5 col-xs-12 xs-no-padding">
                                    <div class="row">
                                        <span class="col-md-10 col-xs-9">Access to a vehicle
                                        </span>
                                        <span class="col-md-1 col-md-offset-1 col-xs-3 span-no">No</span>
                                    </div>
                                </div>
                                <div class="col-md-5 col-md-offset-1 col-xs-12">
                                    <div class="row">
                                        <span class="col-md-10 no-padding col-xs-9">Has children
                                        </span>
                                        <span class="col-md-1 col-md-offset-1 col-xs-3 span-yes">No</span>
                                    </div>
                                </div>
                            </li>
                            <li class="row">
                                <div class="col-md-5 col-xs-12 xs-no-padding">
                                    <div class="row">
                                        <span class="col-md-10 col-xs-9">Non smoker
                                        </span>
                                        <span class="col-md-1 col-md-offset-1 col-xs-3 span-no">Yes</span>
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
                            <li class="service">
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
    <div class="description container-ad-applicant">
        <div class="container">
            <div class="row part">
                <div class="col-md-10 clearfix col-xs-12">
                    <h4 class="info-title dimgrey">
                        <div class="row no-margin">
                            <div class="col-md-1 title-icon bg-blue col-xs-2">
                                <i></i>
                            </div>
                            <div class="col-md-11 title col-xs-10">
                                Availability  Anna
                            </div>
                        </div>
                    </h4>
                    <div class="block block-calendar block-availability">
                        <div class="row">
                            <div class="col-md-11 col-xs-12">
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
                <div class="col-md-10 clearfix col-xs-12">
                    <h4 class="info-title dimgrey">
                        <div class="row no-margin">
                            <div class="col-md-1 title-icon bg-blue col-xs-2">
                                <i></i>
                            </div>
                            <div class="col-md-11 title col-xs-10">
                                Tasks that Anna can help with
                            </div>
                        </div>
                    </h4>
                    <div class="row no-margin">
                        <div class="col-md-11 col-xs-12">
                            <ul class="list-unstyled">
                                <li class="task-block row no-margin">
                                    <div class="col-md-6 no-padding col-xs-12">
                                        <div class="row no-margin">
                                            <div class="col-md-2 no-padding col-xs-3">
                                                
                                            </div>
                                            <div class="service-text col-md-10 col-xs-9">
                                                <p class="littlep">Cooking</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 no-padding col-xs-12">
                                        <div class="row no-margin">
                                            <div class="col-md-2 no-padding col-xs-3">
                                                
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
                                                
                                            </div>
                                            <div class="service-text col-md-10 col-xs-9">
                                                <p class="littlep">Help with homework</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 no-padding col-xs-12">
                                        <div class="row no-margin">
                                            <div class="col-md-2 no-padding col-xs-3">
                                                
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
                                                    
                                                </div>
                                                <div class="service-text col-md-10 col-xs-9">
                                                    <p class="littlep">Wedding Day supervision</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 no-padding col-xs-12">
                                            <div class="row no-margin">
                                                <div class="col-md-2 no-padding col-xs-3">
                                                    
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
                                                    
                                                </div>
                                                <div class="service-text col-md-10 col-xs-9">
                                                    <p class="littlep">Infant (6 months to 2 years)</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 no-padding col-xs-12">
                                            <div class="row no-margin">
                                                <div class="col-md-2 no-padding col-xs-3">
                                                    
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
                                                    
                                                </div>
                                                <div class="service-text col-md-10 col-xs-9">
                                                    <p class="littlep">School Aged Children (6 years and up)</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 no-padding col-xs-12">
                                            <div class="row no-margin">
                                                <div class="col-md-2 no-padding col-xs-3">
                                                    
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
                                                    
                                                </div>
                                                <div class="service-text col-md-10 col-xs-9">
                                                    <p class="littlep">Children with disabilities</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 no-padding col-xs-12">
                                            <div class="row no-margin">
                                                <div class="col-md-2 no-padding col-xs-3">
                                                    
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
                    <div class="col-md-10 clearfix col-xs-16">
                        <h4 class="info-title dimgrey">
                            <div class="row no-margin">
                                <div class="col-md-1 title-icon bg-blue col-xs-2">
                                    <i></i>
                                </div>
                                <div class="col-md-11 title col-xs-10">
                                    Professional Experience:7 years of experience
                                </div>
                            </div>
                        </h4>
                        <div class="row no-margin">
                            <div class="col-md-11 col-xs-12">
                                <ul class="list-unstyled">
                                    <li class="row">
                                        <div class="col-md-3 col-xs-12 left">
                                            <span class="date-text">From 07-1990</span>
                                            <span class="date-text">Until 08-2002</span>
                                        </div>
                                        <div class="col-md-9 col-xs-12 right">
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
                                    <i></i>
                                </div>
                                <div class="col-md-11 title col-xs-10">
                                    More about Anna
                                </div>
                            </div>
                        </h4>
                        <div class="row no-margin">
                            <div class="col-md-11 col-xs-12 pl0">
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
                    <div class="col-md-10 clearfix col-xs-12">
                        <h4 class="info-title dimgrey">
                            <div class="row no-margin">
                                <div class="col-md-1 title-icon bg-blue col-xs-2">
                                    <i></i>
                                </div>
                                <div class="col-md-11 title col-xs-10">
                                    Location
                                </div>
                            </div>
                        </h4>
                        <div class="row no-margin">
                            <div class="col-md-9 main col-xs-12">
                                <div class="map">
                                    <div id="profile-map-canvas"></div>
                                </div>
                            </div>
                            <div class="col-md-3 side pull-right hidden-xs">
                                <div class="row">
                                    <div class="col-xs-12 bg-withe">
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
            zoom: 18,
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