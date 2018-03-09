<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

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
<div class="body background-body candidate-portal">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="container-applications">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-overview">Overview</a></li>
                        <li><a data-toggle="tab" href="#tab-applications">My Applications</a></li>
                        <li><a data-toggle="tab" href="#tab-requests">My Requests to apply</a></li>
                        <li><a data-toggle="tab" href="#tab-reply">Reply</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab-overview">
                            <div class="row">
                                <div class="btns-actions-over clearfix">
                                    <div class="col-sm-offset-1 col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <a class="btn btn-action form-control">Unread Response</a>
                                            </div>
                                            <div class="col-sm-4">
                                                <a class="btn btn-action form-control">Activity</a>
                                            </div>
                                            <div class="col-sm-4">
                                                <a class="btn btn-action form-control">Appointments</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-9 container-overview">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4>Unread Response</h4>
                                            <hr>
                                            <div class="container-candidates">
                                                <ul class="list-group">
                                                    @foreach($myApplications as $application)
                                                    @if(isset($application->applications) > 0)
                                                        <li class="list-group-item">
                                                            <div class="container-job-title">
                                                                <p><strong>{{$application->param('title')}}</strong> - <span class="job-location">{{$application->param('location_name')}}</span></p>
                                                                <p class="blue-color"><a href="/job/manage/applications/{{$application->id}}">{{count($application->applications)}} Unread Candidates</a></p>
                                                            </div>
                                                        </li>
                                                    @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="container-activity">
                                                <h4>Activity</h4>
                                            

                                            </div>
                                            
                                            <div class="container-activity">
                                                <h4>Appointments</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="col-info-jobs">
                                                <h4>Motors</h4>
                                                <ul class="list-group">
                                                    <li class="list-group-item">Live <span class="quantity">{{count($myRequests)}}</span></li>
                                                    <li class="list-group-item">Inactive <span class="quantity">0</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="col-info-candidates">
                                                <h4>Reply</h4>
                                                <ul class="list-group">
                                                    <li class="list-group-item">New <span class="quantity">1</span></li>
                                                    <li class="list-group-item">Reviewed <span class="quantity">0</span></li>
                                                    <li class="list-group-item">Rejected <span class="quantity">0</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="tab-applications">
                            <div class="row">
                                <div class="col-sm-12 container-num-jobs">
                                    <h4>Your applications <span class="num-jobs-title">{{$myApplications->count()}}</span></h4>
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
                                    <div class="container-filter-by text-right">
                                        <span>Filter by:</span>
                                        <ul class="type-filters">
                                            <li><a href="#">All Motors</a></li>
                                            <li><a href="#">My Motors</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="jobs-selected">
                                        <strong>Motors selected: </strong><span class="num-jobs">0</span>
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
                                            <li><a href="#">Recent Views</a></li>
                                        </ul>
                                </div>
                            </div>
                            <table class="w100p table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Title</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($myApplications as $application)
                                    <tr>
                                        <td><input type="checkbox" name="select-job[]" class="checkboxs-jobs"></td>
                                        <td><a href="{{$application->advert->url()}}">{{$application->advert->param('title')}}</a></td>
                                        <td>{{$application->created_at->format('d M Y')}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade in" id="tab-requests">
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
                                        <a href="#" class="btn btn-disable">Change Status</a>
                                    </div>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <span>Sort by:</span>
                                    <ul class="type-filters">
                                        <li><a href="#">Newest First</a></li>
                                        <li><a href="#">Last Name</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="w100p table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Title</th>
                                                <th>Views</th>
                                                <th>Listing Views</th>
                                                <th>Number of replies</th>
                                                <th>Times bumped up</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($myRequests as $request)
                                                <tr>
                                                    <td><input type="checkbox" ></td>
                                                    <td>{{$request->param('title')}}</td>
                                                    <td>{{$request->param('views')}}</td>
                                                    <td>{{$request->param('list_views')}}</td>
                                                    <td>{{$request->replies}}</td>
                                                    <td>@if($request->has_param('bumped'))
                                                        {{$request->param('bumped')}}
                                                        @else
                                                            0
                                                        @endif
                                                    </td> 
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="tab-reply">
                            <div class="row">
                            </div>
                            <div class="row">
        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('a.btn-disable').click(function(e){
        e.preventDefault();
    });
    $('.checkboxs-jobs').change(function(){
        var checkboxs = $(this).parent().parent().parent().find('input:checked');
        console.log(checkboxs.length);
        if(checkboxs.length > 0){
            $('#tab-jobs a.btn-disable').addClass('btn-action');
            $('#tab-jobs a.btn-disable').removeClass('btn-disable');
            $('#tab-jobs .num-jobs').text(checkboxs.length);
        }else{
            $('#tab-jobs .num-jobs').text(0);
            $('#tab-jobs a.btn-action').addClass('btn-disable');
            $('#tab-jobs a.btn-action').removeClass('btn-action');
        }   
    })
</script>
@endsection