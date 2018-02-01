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
                        <figure class="ad-applicant-picture"></figure>
                        <span data-toggle="tooltip" data-placement="top" data-trigger="focus hover" class="glyphicon glyphicon-ok" data-title="Details, ID, and diplomas of this profile have been verified manually by our teams."></span>
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
                        <ul class="list-inline list-unstyle ad-applicant-experiences row">
                            <li>41 years old</li>
                            <li>7 years of experience</li>
                        </ul>
                        <ul class="list-inline list-unstyle ad-applicant-services">
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
                        <ul class="list-unstyle">
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
                                
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection