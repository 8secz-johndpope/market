<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Your Applications |')

@section('sidebar')
    @parent

    <p></p>
@endsection
@php
    $date = new Datetime();
    $dateMs = $date->getTimestamp();
@endphp
@section('styles')
<link href="{{ asset("/css/applications.css?q=$dateMs") }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="body background-body recruiter-search-profile">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <header>
                    <h3>I am looking for candidates in:</h3>
                </header>
                <div class="row">
                    <div class="col-sm-4">
                        General Sector
                    </div>
                     <div class="col-sm-4">
                        Social & Childcare Sector
                    </div>
                     <div class="col-sm-4">
                        Sub Contractor Sector
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="candidates-container">
                    @foreach($profiles as $profile)
                    <div class="candidate">
                        <div class="candidate-wrapper">
                            <div class="candiate-picture">
                                <figure>
                                    <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$profile->user->image}}">
                                </figure>
                            </div>
                            <div class="candidate-details-wrapper">
                                <h3 class="candidate-name">{{$profile->user->name}}</h3>
                                @if(issset($profile->user->address))
                                <p class="candidate-location">{{$profile->user->address->city}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="candidate-actions">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    
</script>
@endsection