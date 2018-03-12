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
                        <li><a data-toggle="tab" href="#tab-requests">My Applications Request</a></li>
                        <li><a data-toggle="tab" href="#tab-reply">Reply</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab-overview">
                            <div class="row">
                                <div class="btns-actions-over clearfix">
                                    <div class="col-sm-offset-1 col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <a href="/job/profile/edit/general" class="btn btn-action form-control">Create Profile</a>
                                            </div>
                                            <div class="col-sm-4">
                                                <a href="/jobs/uk" class="btn btn-action form-control">Latest Jobs</a>
                                            </div>
                                            <div class="col-sm-4">
                                                <a class="btn btn-action form-control">Recommended Jobs</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-9 container-overview">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4>My Applications Request</h4>
                                            <hr>
                                            <div class="container-candidates">
                                                @if($myRequests->count() > 0)
                                                <ul class="list-group">
                                                    @foreach($myRequests as $request)
                                                        @if(isset($loop->index) && $loop->index == 4)
                                                            @break
                                                        @endif
                                                        <li class="list-group-item">
                                                            <div class="container-job-title">
                                                                <p><strong>{{$request->advert->param('title')}}</strong> - <span class="job-location">{{$request->advert->param('location_name')}}</span></p>
                                                                <p class="blue-color">{{$request->message}}</p>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                @else
                                                    <p>You do not have any application request</p>
                                                @endif
                                            </div>
                                            <div class="container-activity">
                                                <h4>My Applications</h4>
                                                <hr>
                                                <div class="container-candidates">
                                                    @if($myApplications->count() > 0)
                                                    <ul class="list-group">
                                                        @foreach($myApplications as $application)
                                                            @if($loop->index == 4)
                                                                @break
                                                            @endif
                                                            <li class="list-group-item">
                                                                <div class="container-job-title">
                                                                    <p><strong>{{$application->advert->param('title')}}</strong> - <span class="job-location">{{$application->advert->param('location_name')}}</span></p>
                                                                    <p class="blue-color">{{$application->getStatus()}}</p>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    @else
                                                        <p>You do not have any application</p>
                                                    @endif
                                                </div>
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
                                                <h4>Applications</h4>
                                                <ul class="list-group">
                                                    <li class="list-group-item">Pending <span class="quantity">{{count($myRequests)}}</span></li>
                                                    <li class="list-group-item">Rejected <span class="quantity">0</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="col-info-candidates">
                                                <h4>Request to Apply</h4>
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
                                            <option value="1" checked>Pending</option>
                                            <option value="0">Rejected</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 container-btn">
                                        <button class="btn btn-filter">Filter</button>
                                    </div>    
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-sm-12">
                                    <div class="container-filter-by text-right">
                                        <span>Filter by:</span>
                                        <ul class="type-filters">
                                            <li><a href="#">All Motors</a></li>
                                            <li><a href="#">My Motors</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="jobs-selected">
                                        <strong>Applications selected: </strong><span class="num-jobs">0</span>
                                    </div>
                                    <div class="btns-actions">
                                        <button class="btn btn-disable">Withdraw Application</button>
                                        <button class="btn btn-disable">Refresh</button>
                                    </div>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <span>Sort by:</span>
                                        <ul class="type-filters">
                                            <li><a href="#">Created</a></li>
                                            <li><a href="#">Name</a></li>
                                            <li><a href="#">Date</a></li>
                                        </ul>
                                </div>
                            </div>
                            <table class="w100p table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Title</th>
                                        <th>Location</th>
                                        <th>Date</th>
                                        <th>CV</th>
                                        <th>Profile</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($myApplications as $application)
                                    <tr>
                                        <td><input type="checkbox" name="select-job[]" class="checkboxs-jobs"></td>
                                        <td><a href="{{$application->advert->url()}}">{{$application->advert->param('title')}}</a></td>
                                        <td>{{$application->advert->param('location_name')}}</td>
                                        <td>{{$application->created_at->format('d M Y')}}</td>
                                        <td>
                                            @if(isset($application->cv))
                                            <a href="">
                                                {{$application->cv->title}}
                                            </a>
                                            @else
                                                No
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($application->profile))
                                            <a href="/job/profile/edit/{{$application->profile->type}}">
                                                {{$application->profile->getType()}}
                                            </a>
                                            @else
                                                No
                                            @endif
                                        </td>
                                        <td>
                                            {{$application->getStatus()}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade in" id="tab-requests">
                            <div class="row">
                                <div class="col-sm-12 container-num-jobs">
                                    <h4>Your Requests <span class="num-jobs-title">{{count($myRequests)}}</span></h4>
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
                                        <strong>Requests selected: </strong><span class="num-jobs">0</span>
                                    </div>
                                    <div class="btns-actions">
                                        <button class="btn btn-disable" id="apply">Apply</button>
                                        <button class="btn btn-disable" id="discard">Discard</button>
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
                                    <form id="bulk-apply-form" action="/user/jobs/application-request/apply" method="post">
                                        {{ csrf_field() }}
                                        <table class="w100p table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Title</th>
                                                    <th>Message</th>
                                                    <th>Company</th>
                                                    <th>Location</th>
                                                    <th>Contact</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($myRequests as $request)
                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <input type="checkbox" name="ids[]" class="request-applications" value="{{$request->id}}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="{{$request->advert->url()}}" target="_black" class="link-job">
                                                                {{$request->advert->param('title')}}
                                                            </a>
                                                        </td>
                                                        <td>{{$request->message}}</td>
                                                        <td>
                                                            @if(isset($request->user->company))
                                                                {{$request->user->company->name}}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>{{$request->advert->param('location_name')}}</td>
                                                        <td>{{$request->employer->name}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </form>
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
    $('.request-applications').change(function(){
        var checkboxs = $(this).parent().parent().parent().find('input:checked');
        console.log(checkboxs.length);
        disableButtons('#tab-requests', checkboxs.length);   
    });
    $('.checkboxs-jobs').change(function(){
        var checkboxs = $(this).closest('tbody').find('input:checked');
        console.log(checkboxs.length);
        disableButtons('#tab-applications', checkboxs.length);
    });
    function disableButtons(selector, length){
        var buttons;
        if(length > 0){
            buttons = $(selector + ' button.btn-disable');
            buttons.addClass('btn-action');
            buttons.removeClass('btn-disable');
            $(selector + ' .num-jobs').text(length);
        }else{
            $(selector + ' .num-jobs').text(0);
            buttons = $(selector + ' button.btn-action');
            buttons.addClass('btn-disable');
            buttons.removeClass('btn-action');
        }  
    }
    $('#apply').click(function(){
        $('#bulk-apply-form').submit()
    });
    $('#discard').click(function(){
        var form =  $('#bulk-apply-form'); 
        form.attr('action', '/user/jobs/application-requests/discard');
        form.submit();
    });
</script>
@endsection