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
                                                            <p><strong>{{$job->param('title')}}</strong> - <span class="job-location">{{$job->param('location_name')}}</span></p>
                                                            <p class="blue-color">{{count($job->applications)}} Unread Candidates</p>
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
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="container-filter-by">
                                        <span>Filter by:</span>
                                        <ul class="type-filters">
                                            <li>All Jobs</li>
                                            <li>My Jobs</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <table class="w100p table table-striped table-hover">
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
                        <div class="tab-pane fade in" id="tab-candidates">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="w100p table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Job</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Status</th>
                                                <th>Date Applied</th>
                                                <th>Cover Letter</th>
                                                <th>Cvs</th>
                                                <th>Profile</th>
                                                <th>Replay</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($jobs as $job)
                                                @foreach($job->applications as $application)
                                                <tr>
                                                    <td><input type="checkbox" ></td>
                                                    <td>{{$job->param('title')}}</td>
                                                    <td>{{$application->user->name}}</td>
                                                    <td>{{$application->user->phone}}</td>
                                                    <td></td>
                                                    <td>{{$application->created_at->format('d/m/Y')}}</td>
                                                    <td>@if($application->cover){{$application->cover->cover}} @else <span>No Cover</span> @endif</td> 
                                                    <td>
                                                        @if($application->cv)                      
                                                        <a target="_blank" href="{{env('AWS_CV_IMAGE_URL')}}/{{$application->cv->file_name}}">
                                                            View/Download
                                                        </a> 
                                                        @else 
                                                            <span>No Cv</span> 
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="/job/profile/view/{{$application->user_id}}">View Profile
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary" href="/user/areply/{{$application->id}}">Reply</a>
                                                    </td>
                                                </tr>
                                                @endforeach
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
    </div>
</div>
@endsection