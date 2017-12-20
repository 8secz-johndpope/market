<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Your Applications |')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@php
    $date = new Datetime();
    $dateMs = $date->getTimestamp();
@endphp
@section('styles')
<link href="{{ asset("/css/applications.css?q=$dateMs") }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="body background-body">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="container-filter">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="container-applications">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-overview">Overview</a></li>
                        <li><a data-toggle="tab" href="#tab-jobs">Jobs</a></li>
                        <li><a data-toggle="tab" href="#tab-candidates">Candidates</a></li>
                        <li><a data-toggle="tab" href="#tab-share">Share Credit</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab-overview">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4>Candidates</h4>
                                            <div class="container-candidates">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="tab-jobs">
                            <div class="container-num-jobs">
                                <h3>Your jobs <span class="num-jobs">{{count($jobs)}}</span></h3>
                            </div>
                            <table class="w100p table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                        <th>Period</th>
                                        <th>Views</th>
                                        <th>Applications</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jobs as $job)
                                    <tr>
                                        <td><a href="{{$job->url()}}">{{$job->param('title')}}</a></td>
                                        <td>{{$job->param('location_name')}}</td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$job->param('views')}}</td>
                                        <td><a href="/job/manage/applications/{{$job->id}}">{{count($job->applications)}} Applications</a></td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection