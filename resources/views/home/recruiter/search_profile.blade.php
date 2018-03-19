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
        <div class="row search-input-container">
            <div class="col-sm-5">
                <div class="form-group">
                    <input type="text" name="job_title" value="" id="job-title" placeholder="Job title" class="form-control">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <select class="form-control">
                        <option>Select Sector</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <button class="btn btn-submit">Search</button>
                </div>
            </div>
        </div>
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
        <div class="row bulk-candidates-container">
            <div class="col-sm-8">
                <div class="">
                    <input type="checkbox" name="" id="select-all">
                    <label for="select-all">
                        Select all for 
                        <span class="bulk-apply-tm">BulkApplicationRequest<sup>TM</sup></span>
                    </label>
                </div>
            </div>
            <div class="col-sm-4 text-right">
                <button class="btn btn-submit">Bulk Application Request</button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form action="/recruiter/candidate/application-request/all" method="post">
                    {{ csrf_field() }}
                    <div class="candidates-container">
                        @foreach($profiles as $profile)
                        <div class="candidate">
                            <div class="candidate-wrapper">
                                <div class="checkbox">
                                    <input type="checkbox" name="candidate_id[]" id="candidate-{{$profile->id}}" value="{{$profile->id}}" class="candidates-checkbox">
                                    <label for="candidate-{{$profile->id}}">
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
                            <hr>
                            <div class="candidate-actions text-center">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="box">
                                            <span class="heart-empty favroite-icon"></span>
                                            <span>Save</span>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="box">
                                            <div class="dropdown download-cvs">
                                                <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown"">Download CV<span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    @foreach($profile->user->cvs as $cv)
                                                    <li>
                                                        <a href="{{env('AWS_CV_IMAGE_URL')}}/{{$cv->filename}}" target="_blank" class="download-cv">{{$cv->title}}</a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="box">
                                            <button class="btn btn-link" data-toggle="modal" data-target="#modalApplicationRequest">Request Application</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="modalApplicationRequest" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Send Application Request</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script>
    $('#select-all').change(function(){
        $('.candidates-checkbox').prop('checked', this.checked);
    });    
</script>
@endsection