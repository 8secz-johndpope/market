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
                        <li><a data-toggle="tab" href="#tab-jobs">Adverts</a></li>
                        <li><a data-toggle="tab" href="#tab-candidates">Reply</a></li>
                        <li><a data-toggle="tab" href="#tab-share">Share Credit</a></li>
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
                                                    @foreach($motors as $motor)
                                                    @if(count($motor->applications) > 0)
                                                        <li class="list-group-item">
                                                            <div class="container-job-title">
                                                                <p><strong>{{$motor->param('title')}}</strong> - <span class="job-location">{{$motor->param('location_name')}}</span></p>
                                                                <p class="blue-color"><a href="/job/manage/applications/{{$motor->id}}">{{count($motor->applications)}} Unread Candidates</a></p>
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
                                                    <li class="list-group-item">Live <span class="quantity">{{count($motors)}}</span></li>
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
                        <div class="tab-pane fade in" id="tab-jobs">
                            <div class="row">
                                <div class="col-sm-12 container-num-jobs">
                                    <h4>Your motors <span class="num-jobs-title">{{count($motors)}}</span></h4>
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
                                        <th>Location</th>
                                        <th>Status</th>
                                        <th>Views</th>
                                        <th>Replies</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($motors as $motor)
                                    <tr>
                                        <td><input type="checkbox" name="select-job[]" class="checkboxs-jobs"></td>
                                        <td><a href="{{$motor->url()}}">{{$motor->param('title')}}</a></td>
                                        <td>{{$motor->param('location_name')}}</td>
                                        <td>{{$motor->status == 1 ? 'Live': 'Inactive' }}</td>
                                        <td>{{$motor->param('views')}}</td>
                                        <td>{{$motor->replies}}</td>
                                        <td><a href="#">Expire</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade in" id="tab-candidates">
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
                                                <th>Job</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Status</th>
                                                <th>Date Applied</th>
                                                <th class="cell-cover">Cover Letter</th>
                                                <th>Cvs</th>
                                                <th>Profile</th>
                                                <th>Reply</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($motors as $motor)
                                                @foreach($motor->applications as $application)
                                                <tr>
                                                    <td><input type="checkbox" ></td>
                                                    <td>{{$motor->param('title')}}</td>
                                                    <td>{{$application->user->name}}</td>
                                                    <td>{{$application->user->phone}}</td>
                                                    <td>New</td>
                                                    <td>{{$application->created_at->format('d M Y')}}</td>
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
                        <div class="tab-pane fade in" id="tab-share">
                            <div class="row">
                                <div class="btns-actions-over clearfix">
                                    <div class="col-sm-offset-1 col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="image-profile">
                                                    <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$user->image}}" class="circle">
                                                </div>
                                                <div class="container-welcome">
                                                    <h3 class="welcome-msg">Hi, {{$user->name}}</h3>
                                                </div>
                                            </div>
                                            <div class=" col-sm-offset-4 col-sm-2">
                                                <div class="action-item">
                                                    <a class="">
                                                        <span class="icon icon-send-credit fa fa-money">
                                                             <span class="icon-action fa fa-share"></span>
                                                        </span>
                                                        <span>Send Credit</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="action-item">
                                                    <a class="">
                                                        <span class="icon icon-request-credit fa fa-money">
                                                            <span class="icon-action fa fa-reply"></span>
                                                        </span>
                                                        <span>Request Credit</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="container-balance">
                                                <h4>Your balance</h4>
                                                <div class="balance-numeral">
                                                    @foreach($balance['available'] as $item)
                                                    <span class="balance">
                                                            {{number_format($item['amount']/100,2)}}
                                                    </span>
                                                    <span class="balance-currency">{{$item['currency']}}</span>
                                                     @endforeach
                                                </div>
                                                <p class="currenciesHeader"> Currencies</p>
                                                <ul class="currencies-list">
                                                    <li class="currencies-entry">0,00 GBP</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="container-history">
                                                <h4 class="module-header">
                                                    <a class="module-header-link">Completed</a>
                                                </h4>
                                                <div class="list-history">
                                                    <ul class="list-group">
                                                        <li class="transition-row">
                                                            <div class="transition-item">
                                                                <div class="row linked-block">
                                                                    <div class="col-xs-1">
                                                                        <div class="date-parts">
                                                                            <span class="date-month">
                                                                                Nov
                                                                            </span>
                                                                            <span class="date-day">
                                                                                28
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-11 transaction-details-container">
                                                                        <div class="txn-description row">
                                                                            <span class="transaction-user col-xs-7 col-lg-12">
                                                                                Anthony
                                                                            </span>
                                                                            <span class="transaction-branch col-xs-7">
                                                                                Company - Hackney
                                                                            </span>
                                                                        </div>
                                                                        <div class="transaction-action">
                                                                            <span class="glyphicon glyphicon-play-circle"></span>
                                                                            <a href="#">
                                                                                Repeat this transaction
                                                                            </a>
                                                                        </div>
                                                                        <div class="transaction-amount">
                                                                            <span class="net-amount">
                                                                                46,00
                                                                                <span class="currency">
                                                                                    GBP
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="transition-row">
                                                            <div class="transition-item">
                                                                <div class="row linked-block">
                                                                    <div class="col-xs-1">
                                                                        <div class="date-parts">
                                                                            <span class="date-month">
                                                                                Oct
                                                                            </span>
                                                                            <span class="date-day">
                                                                                28
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-11 transaction-details-container">
                                                                        <div class="txn-description row">
                                                                            <span class="transaction-user col-xs-7 col-lg-12">
                                                                                Smith
                                                                            </span>
                                                                            <span class="transaction-branch col-xs-7">
                                                                                Company - Hackney
                                                                            </span>
                                                                        </div>
                                                                        <div class="transaction-action">
                                                                            <span class="glyphicon glyphicon-play-circle"></span>
                                                                            <a href="#">
                                                                                Repeat this transaction
                                                                            </a>
                                                                        </div>
                                                                        <div class="transaction-amount">
                                                                            <span class="net-amount">
                                                                                46,00
                                                                                <span class="currency">
                                                                                    GBP
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="transition-row">
                                                            <div class="transition-item">
                                                                <div class="row linked-block">
                                                                    <div class="col-xs-1">
                                                                        <div class="date-parts">
                                                                            <span class="date-month">
                                                                                Sep
                                                                            </span>
                                                                            <span class="date-day">
                                                                                18
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-11 transaction-details-container">
                                                                        <div class="txn-description row">
                                                                            <span class="transaction-user col-xs-7 col-lg-12">
                                                                                Zara
                                                                            </span>
                                                                            <span class="transaction-branch col-xs-7">
                                                                                Company - Hammersmith
                                                                            </span>
                                                                        </div>
                                                                        <div class="transaction-action">
                                                                            <span class="glyphicon glyphicon-play-circle"></span>
                                                                            <a href="#">
                                                                                Repeat this transaction
                                                                            </a>
                                                                        </div>
                                                                        <div class="transaction-amount">
                                                                            <span class="net-amount">
                                                                                46,00
                                                                                <span class="currency">
                                                                                    GBP
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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