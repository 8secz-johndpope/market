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
<link href="{{ asset("/css/search-profiles.css?q=$dateMs") }}" rel="stylesheet" type="text/css">
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
                            <div class="checkbox">
                                <input type="checkbox" name="candidates_id[]" id="candidate-{{$profile->user->id}}" value="{{$profile->user->id}}">
                                <label for="candidate-{{$profile->user->id}}">
                                    Select
                                </label>
                            </div>
                            <div class="candidate-picture">
                                <figure>
                                    <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$profile->user->image}}">
                                </figure>
                            </div>
                            <div class="candidate-details-wrapper">
                                <h3 class="candidate-name"><a href="/job/profile/{{$profile->id}}">{{$profile->user->name}}</a></h3>
                                @if(isset($profile->user->address))
                                <p class="candidate-location">{{$profile->user->address->city}}</p>
                                @endif
                                @if(isset($profile->looking_for))
                                    @if(isset($profile->looking_for->job_title))
                                    <strong>{{$profile->looking_for->job_title}}</strong>
                                    @endif
                                    @if(isset($profile->looking_for->min_per_annum) && isset($profile->looking_for->min_per_hour))
                                    <p>{{$profile->looking_for->min_per_annum}} per annum or {{$profile->looking_for->min_per_hour}} per hour</p>
                                    @elseif(isset($profile->looking_for->min_per_annum))
                                    <p>{{$profile->looking_for->min_per_annum}} per annum</p>
                                    @elseif(isset($profile->looking_for->min_per_hour))
                                    <p>{{$profile->looking_for->min_per_hour}} per hour</p>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="candidate-actions text-center">
                            <div class="row">
                                <div class="col-xs-3">
                                    Save
                                </div>
                                <div class="col-xs-3">
                                    <div class="dropdown">
                                        <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown"">Download CV<span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            @foreach($profile->user->cvs as $cv)
                                            <li>
                                                <a href="{{env('AWS_CV_IMAGE_URL')}}/{{$cv->filename}}">{{$cv->title}}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    Request Application
                                </div>
                            </div>
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