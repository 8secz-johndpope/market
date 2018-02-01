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
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-xs-12 main">
                <div class="col-md-2 col-xs-12">
                    <figure class="ad-applicant-picture"></figure>
                    <span data-toggle="tooltip" data-placement="top" data-trigger="focus hover" class="glyphicon glyphicon-ok" data-title="Details, ID, and diplomas of this profile have been verified manually by our teams."></span>
                    <div class="tooltip fade top in" role="tooltip">
                </div>
                <div class="col-md-10 ad-applicant-profil-infos col-xs-12">
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
@endsection