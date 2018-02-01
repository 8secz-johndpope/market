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
                </div>
            </div>
            <div class="col-md-5 hidden-xs">
            </div>
        </div>
    </div>
</div>
@endsection