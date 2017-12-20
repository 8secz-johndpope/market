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
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4>Unread Candidates</h4>
                                            <hr>
                                            <div class="container-candidates">
                                                <ul class="list-group">
                                                    @foreach($jobs as $job)
                                                    <li class="list-group-item">
                                                        <div class="container-job-title">
                                                            <p>{{$job->param('title')}} - {{$job->param('location_name')}}</p>
                                                            <p>{{count($job->applications)}} Unread Candidates</p>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <hr>
                                            <h4>Activity</h4>
                                            <div class="container-activity">

                                            </div>
                                            <hr>
                                            <h4>Interviews</h4>
                                            <div class="container-activity">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="col-info-jobs">
                                                <h4>Jobs</h4>
                                                <ul class="list-group">
                                                    <li class="list-group-item">Live</li>
                                                    <li class="list-group-item">Inactive</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="col-info-candidates">
                                                <h4>Candidates</h4>
                                                <ul class="list-group">
                                                    <li class="list-group-item">New</li>
                                                    <li class="list-group-item">Reviewed</li>
                                                    <li class="list-group-item">Rejected</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="tab-jobs">
                            <div class="row">
                                <div class="col-sm-12 container-num-jobs">
                                    <h4>Your jobs <span class="num-jobs">{{count($jobs)}}</span></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="container-filter clearfix">
                                    <div class="col-md-5">
                                        <label for="keywords">Keywords</label>
                                        <input type="text" name="keywords" class="form-control">
                                    </div>
                                    <div class="col-md-5">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status">
                                            <option value="1" checked>Live</option>
                                            <option value="0">Draft</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 container-btn">
                                        <button class="btn btn-filter">Filter</button>
                                    </div>    
                                </div>
                            </div>
                            <table class="w100p table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Title</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                        <th>Views</th>
                                        <th>Applications</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jobs as $job)
                                    <tr>
                                        <td><input type="checkbox" name="select-job[]"></td>
                                        <td><a href="{{$job->url()}}">{{$job->param('title')}}</a></td>
                                        <td>{{$job->param('location_name')}}</td>
                                        <td>{{$job->status == 1 ? 'Live': 'Inactive' }}</td>
                                        <td>{{$job->param('views')}}</td>
                                        <td><a href="/job/manage/applications/{{$job->id}}">{{count($job->applications)}} <span class="fa fa-file-text-o"></span></a></td>
                                        <td><a href="#">Expire</td>
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