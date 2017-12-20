@extends('layouts.business')

@section('title', 'Page Title')

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
            <div class="container-num-jobs clearfix">
                <div class="col-sm-12 text-center">
                    <h4>
                        {{$job->param('title')}}
                        <br>
                        Applications <span class="num-jobs">{{count($job->applications)}}</span>
                    </h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container-filter clearfix">
                <div class="col-md-5">
                    <label for="keywords">Keywords</label>
                    <input type="text" name="keywords" class="form-control">
                </div>
                <div class="col-md-5">
                    <label for="status">Application Status</label>
                    <select class="form-control" name="status">
                        <option value="1" checked>New</option>
                        <option value="0">Reviewed</option>
                        <option value="2">Rejected</option>
                    </select>
                </div>
                <div class="col-md-2 container-btn">
                    <button class="btn btn-filter">Filter</button>
                </div>    
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="jobs-selected">
                    <strong>Jobs selected: </strong><span class="num-jobs">0</span>
                </div>
                <div class="btns-actions">
                    <a class="btn btn-disable">Upgrade</a>
                    <a class="btn btn-disable">Expire</a>
                    <a class="btn btn-disable">Refresh</a>
                </div>
            </div>
            <div class="col-sm-6 text-right">
                <span>Sort by:</span>
                    <ul class="type-filters">
                        <li><a href="#">Created</a></li>
                        <li><a href="#">Expiring</a></li>
                        <li><a href="#">Recent Applications</a></li>
                    </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <a href="{{$job->url()}}"><h4>Applications for {{$job->param('title')}}</h4></a>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Cover</th>
                            <th>CV</th>
                            <th>Profile</th>
                            <th>Reply</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($job->applications as $application)
                        <tr><td>{{$application->user->name}}</td><td>{{$application->user->phone}}</td><td>@if($application->cover){{$application->cover->cover}} @else <span>No Cover</span> @endif</td> <td>              @if($application->cv)                      <a target="_blank" href="{{env('AWS_CV_IMAGE_URL')}}/{{$application->cv->file_name}}">View/Download</a> @else <span>No Cv</span> @endif</td><td><a href="/job/profile/view/{{$application->user_id}}">View Profile</a></td><td><a class="btn btn-primary" href="/user/areply/{{$application->id}}">Reply</a></td></tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection