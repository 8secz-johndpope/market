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
<div class="body background-body recruiment-portal">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="container-applications">
                    <h3 class="portal-title">Recruiment Portal</h3>
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-overview">Overview</a></li>
                        <li><a data-toggle="tab" href="#tab-jobs">Jobs</a></li>
                        <li><a data-toggle="tab" href="#tab-candidates">Candidates</a></li>
                        <li><a data-toggle="tab" href="#tab-invitations">Invitations To Apply</a></li>
                        <li><a data-toggle="tab" href="#tab-share">Share Credit</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab-overview">
                            <div class="row">
                                <div class="btns-actions-over clearfix">
                                    <div class="col-sm-offset-1 col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <a class="btn btn-action form-control">Invitations an Application</a>
                                            </div>
                                            <div class="col-sm-3">
                                                <a href="/recruiter/portal?page=candidates&candidate_status=0" class="btn btn-action form-control">Unread Candidates</a>
                                            </div>
                                            <div class="col-sm-3">
                                                <a class="btn btn-action form-control" href="/user/manage/templates">Manage Reply Templates</a>
                                            </div>
                                            <div class="col-sm-3">
                                                <a href="/recuiter/cv-search" class="btn btn-action form-control">CV & Profile Access</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-9 container-overview">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4>Unread Candidates

                                            </h4>
                                            <hr>
                                            <div class="container-candidates">
                                                <ul class="list-group">
                                                    @foreach($jobsNewCandidates as $job)
                                                    @if(count($job->applications) > 0)
                                                        <li class="list-group-item">
                                                            <div class="container-job-title">
                                                                <p><strong>{{$job->param('title')}}</strong> - <span class="job-location">{{$job->param('location_name')}}</span></p>
                                                                <p class="blue-color"><a href="/job/manage/applications/{{$job->id}}">{{$job->unReadApplications->count()}} Unread Candidates</a></p>
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
                                                <h4>Interviews</h4>
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
                                                    <li class="list-group-item">Live <span class="quantity">{{count($jobs)}}</span></li>
                                                    <li class="list-group-item">Inactive <span class="quantity">0</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="col-info-candidates">
                                                <h4>Candidates</h4>
                                                <ul class="list-group">
                                                    <li class="list-group-item">New <span class="quantity">{{$totalUnreadCandidates}}</span></li>
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
                                    <h4>Your jobs <span class="num-jobs-title">{{$jobs->count()}}</span></h4>
                                </div>
                            </div>
                            <div class="row">
                                <form action="" method="get" id="form-filter-jobs">
                                    <input type="hidden" name="page" value="jobs">
                                    <div class="container-filter clearfix">
                                        <div class="col-md-5">
                                            <label for="keywords">Keywords</label>
                                            <input type="text" name="jobs_keywords" class="form-control" value="{{isset($jobsKeywords) ? $jobsKeywords : ''}}">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="jobs_status">
                                                <option value="">Select Status</option>
                                                @foreach($jobStatus as $status)
                                                <option value="{{$loop->index}}" {{isset($jobsStatus) && $jobsStatus == $loop->index ? "selected" : ''}}>{{$status}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2 container-btn">
                                            <button class="btn btn-filter" type="submit">Filter</button>
                                        </div>    
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="container-filter-by text-right">
                                        <span>Filter by:</span>
                                        <ul class="type-filters">
                                            <li><a href="#">All Jobs</a></li>
                                            <li><a href="#">My Jobs</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="jobs-selected">
                                        <strong>Jobs selected: </strong><span class="num-jobs">0</span>
                                    </div>
                                    <div class="btns-actions">
                                        <a class="btn btn-disable" id="expire">Expire</a>
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
                                    <form method="post" id="form-list-jobs">
                                         <input type="hidden" name="page" value="jobs">
                                        {{ csrf_field() }}
                                        @foreach($jobs as $job)
                                        <tr>
                                            <td><input type="checkbox" name="select_jobs[]" class="checkboxs-jobs" value="{{$job->id}}"></td>
                                            <td><a href="{{$job->url()}}">{{$job->param('title')}}</a></td>
                                            <td>{{$job->param('location_name')}}</td>
                                            <td>{{$job->getStatus()}}</td>
                                            <td>{{$job->param('views')}}</td>
                                            <td>
                                                @if(count($job->applications) > 0)
                                                <a href="/job/manage/applications/{{$job->id}}">
                                                {{count($job->applications)}} <span class="fa fa-file-text-o"></span></a>
                                                @else
                                                    0 <span class="fa fa-file-text-o"></span>
                                                @endif
                                            </td>
                                            <td><a href="#">Expire</a></td>
                                        </tr>
                                        @endforeach
                                    </form>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade in" id="tab-candidates">
                            <div class="row">
                                <div class="col-sm-12 container-num-jobs">
                                    <h4>Your candidates <span class="num-jobs-title">{{$candidates->count()}}</span></h4>
                                </div>
                            </div>
                            <div class="row">
                                <form action="" method="get" id="form-filter-candidates">
                                    <input type="hidden" name="page" value="candidates">
                                    <div class="container-filter clearfix">
                                        <div class="col-md-5">
                                            <label for="keywords">Keywords</label>
                                            <input type="text" name="candidate_keywords" class="form-control" value="{{isset($candidatesKeywords)? $candidatesKeywords : ''}}">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="status">Application Status</label>
                                            <select class="form-control" name="candidate_status">
                                                <option value="">Select Status</option>
                                                @foreach($applicationStatus as $status)
                                                 <option value="{{$loop->index}}" {{isset($candidatesStatus) && $loop->index == $candidatesStatus? 'selected' : ''}}>{{$status}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2 container-btn">
                                            <button type="submit" class="btn btn-filter">Filter</button>
                                        </div>    
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="jobs-selected">
                                        <a href="#" class="btn btn-disable" id="viewed">Viewed</a>
                                        <a href="#" class="btn btn-disable" id="rejected">Rejected</a>
                                        <a href="#" class="btn btn-disable" id="interview">Interview</a>
                                        <a href="#" class="btn btn-disable" id="accept">Accepted</a>
                                    </div>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <span>Sort by:</span>
                                    <ul class="type-filters">
                                        <li><a href="#">Newest First</a></li>
                                        <li><a href="#">Last Name</a></li>
                                    </ul>
                                </div>
                                @if(session('status'))
                                <div class="col-xs-12">
                                    <div class="alert alert-success" role="alert">
                                        <span>{{session('status')}}</span>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                                @endif
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
                                                <th>Cvs</th>
                                                <th>Profile</th>
                                                <th>Reply</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form method="post" id="form-list-candidates">
                                                <input type="hidden" name="page" value="candidates">
                                                {{ csrf_field() }}
                                                @foreach($candidates as $application)
                                                <tr>
                                                    <td><input type="checkbox" name="candidates[]" value="{{$application->id}}" class="candidates"></td>
                                                    <td>{{$application->advert->param('title')}}</td>
                                                    <td>{{$application->user->name}}</td>
                                                    <td>{{$application->user->phone}}</td>
                                                    <td>{{$application->getStatusEmployer()}}</td>
                                                    <td>{{$application->created_at->format('d M Y')}}</td> 
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
                                            </form>
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
                        <div class="tab-pane fade in" id="tab-invitations">
                            <div class="row">
                                <div class="col-sm-12 container-num-jobs">
                                    <h4>Your invitaions an apply <span class="num-jobs-title">{{$myInvitations->count()}}</span></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="container-filter clearfix">
                                    <div class="col-md-5">
                                        <label for="keywords">Keywords</label>
                                        <input type="text" name="keywords" class="form-control">
                                    </div>
                                    <div class="col-md-5">
                                        <label for="status">Invitation Status</label>
                                        <select class="form-control" name="status">
                                            <option value="" checked>Select Status</option>
                                            @foreach($invitationStatus as $status)
                                            <option value="{{$loop->index}}" checked>{{$status}}</option>
                                            @endforeach
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
                                                <th>Date Invited</th>
                                                <th>Reply</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($myInvitations as $invitation)
                                            <tr>
                                                <td><input type="checkbox" ></td>
                                                <td>{{$invitation->advert->param('title')}}</td>
                                                <td>{{$invitation->candidate->name}}</td>
                                                <td>{{$invitation->candidate->phone}}</td>
                                                <td>{{$invitation->getStatus()}}</td>
                                                <td>{{$invitation->created_at->format('d M Y')}}</td>
                                                <td><a class="btn btn-primary" href="/user/areply/{{$invitation->id}}">Reply</a>
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
    </div>
</div>
<script>
    $('a.btn-disable').click(function(e){
        e.preventDefault();
    });
    $('input:checkbox').change(function(){
        var tabpanel = $(this).closest('.tab-pane');
        var checkboxs = tabpanel.find('input:checked');
        if(checkboxs.length > 0){
            var buttons = tabpanel.find('a.btn-disable');
            buttons.addClass('btn-action');
            buttons.removeClass('btn-disable');
        }
        else{
            var buttons = tabpanel.find('a.btn-action');
            buttons.removeClass('btn-action');
            buttons.addClass('btn-disable');
        }
        tabpanel.find('.num-jobs').text(checkboxs.length);
    });
    @if(isset($tab))
         $('.nav-tabs a[href="#tab-{{$tab}}"]').tab('show');
    @endif
    $('#viewed').click(function(e){
        e.preventDefault();
        candidatesCommand('/recruiter/candidates/mark-view/all');
    });
    $('#rejected').click(function(e){
        e.preventDefault();
        candidatesCommand('/recruiter/candidates/reject/all');
    });
    $('#interview').click(function(e){
        e.preventDefault();
        candidatesCommand('/recruiter/candidates/interview/all');
    });
    $('#accept').click(function(e){
        e.preventDefault();
        candidatesCommand('/recruiter/candidates/accept/all');
    });
    $('#expire').click(function(e){
        e.preventDefault();
        var form = $('#form-list-jobs');
        form.attr('/recruiter/candidates/accept/all');
        form.submit();
    });
    function candidatesCommand(actionForm){
        var form = $('#form-list-candidates');
        form.attr('action', actionForm);
        form.submit();
    }
</script>
@endsection