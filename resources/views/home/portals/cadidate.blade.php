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
                    <h3 class="portal-title">Candidate Portal</h3>
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
                                                @if($latestApplicationRequests->count() > 0)
                                                <ul class="list-group">
                                                    @foreach($latestApplicationRequests as $request)
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
                                                    @if($latestApplications->count() > 0)
                                                    <ul class="list-group">
                                                        @foreach($latestApplications as $application)
                                                            <li class="list-group-item">
                                                                <div class="container-job-title">
                                                                    <p><strong>{{$application->advert->param('title')}}</strong> - <span class="job-location">{{$application->advert->param('location_name')}}</span></p>
                                                                    <p class="blue-color">{{$application->getStatusEmployee()}}</p>
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
                                    <form action="/user/job/portal" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="tab" value="tab-applications"> 
                                        <div class="col-md-5">
                                            <label for="keywords">Keywords</label>
                                            <input type="text" name="keywords" class="form-control" value="{{isset($keywordsFilter) ? $keywordsFilter : ''}}">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status">
                                                <option value="">Select Status</option>
                                                @foreach($applicationStatus as $status)
                                                <option value="{{$loop->index}}" {{isset($statusFilter) && $loop->index == $statusFilter ? 'selected' : ''}}>{{$status}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2 container-btn">
                                            <button class="btn btn-filter" type="submit">Filter</button>
                                        </div>
                                    </form>    
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
                                        <button class="btn btn-disable" id="withdraw-applications">Withdraw Application</button>
                                    </div>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <span>Sort by:</span>
                                        <ul class="type-filters">
                                            <li><a href="#">Created</a></li>
                                            <li><a href="#">Name</a></li>
                                        </ul>
                                </div>
                                <div class="col-xs-12">
                                    <div class="alert alert-success" role="alert" style="display:none;">
                                        <span class="message"></span>
                                    </div>
                                </div>
                            </div>
                            <form action="/user/jobs/withdraw/applications" id="form-withdraw-applications" method="post">
                                {{ csrf_field() }} 
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
                                            <td><input type="checkbox" name="select_job[]" class="checkboxs-jobs" value="{{$application->id}}"></td>
                                            <td><a href="{{$application->advert->url()}}">{{$application->advert->param('title')}}</a></td>
                                            <td>{{$application->advert->param('location_name')}}</td>
                                            <td>{{$application->created_at->format('d M Y')}}</td>
                                            <td>
                                                @if(isset($application->cv))
                                                <a href="{{env('AWS_CV_IMAGE_URL')}}/{{$application->cv->file_name}}">
                                                    {{$application->cv->title}}
                                                </a>
                                                @else
                                                    No
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($application->profile))
                                                <a href="/job/profile/edit/{{$application->profile->type}}" target="_black">
                                                    {{$application->profile->getType()}}
                                                </a>
                                                @else
                                                    No
                                                @endif
                                            </td>
                                            <td>
                                                {{$application->getStatusEmployee()}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <div class="tab-pane fade in" id="tab-requests">
                            <div class="row">
                                <div class="col-sm-12 container-num-jobs">
                                    <h4>Your Requests <span class="num-jobs-title">{{count($myRequests)}}</span></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="container-filter clearfix">
                                    <form action="/user/job/portal" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="tab" value="tab-requests"> 
                                        <div class="col-md-5">
                                            <label for="keywords">Keywords</label>
                                            <input type="text" name="request_keywords" class="form-control" value="{{ isset($keywordsRequest) ? $keywordsRequest : ''}}">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="status">Application Status</label>
                                            <select class="form-control" name="request_status">
                                                <option value="">Select Status</option>
                                                @foreach($requestStatus as $status)
                                                <option value="{{$loop->index}}" {{(isset($statusRequest) && $statusRequest == $loop->index) ? 'selected' : ''}}>{{$status}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2 container-btn">
                                            <button class="btn btn-filter" type="submit">Filter</button>
                                        </div>
                                    </form>    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="jobs-selected">
                                        <strong>Requests selected: </strong><span class="num-jobs">0</span>
                                    </div>
                                    <div class="btns-actions">
                                        <button class="btn btn-disable" id="apply">Accept & Apply</button>
                                        <button class="btn btn-disable" id="discard">Decline</button>
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
                                    <form id="bulk-apply-form" action="/user/jobs/application-request/apply/all" method="post">
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
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($myRequests as $request)
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="ids[]" class="request-applications" value="{{$request->id}}">
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
                                                                PI
                                                            @endif
                                                        </td>
                                                        <td>{{$request->advert->param('location_name')}}</td>
                                                        <td>{{$request->employer->name}}</td>
                                                        <td>{{$request->getStatus()}}</td>
                                                        <td>
                                                            <button class="btn btn-black" type="button" id="accept" data-toggle="modal" data-target="#modalAcceptApply" data-whatever="{{$request->id}}">Accept & Apply</button>
                                                            <button class="btn btn-danger" type="button">Decline</button>
                                                            <button class="btn btn-primary" type="button">Reply</button>
                                                        </td>
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
<div class="modal fade" id="modalAcceptApply" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Accept the Application Request</h4>
      </div>
      <div class="modal-body">
        <form>
            {{ csrf_field() }}
            <input type="hidden" class="form-control" id="recipient-name" >
            <div class="form-group">
                <label class="control-label">Apply with:</label>
                <div class="radio">
                    <label for="">Profile</label>
                    <input  type="radio" name="type" value="0">
                </div>
                <div class="radio">
                    <label for="">CV</label>
                    <input  type="radio" name="type" value="1">
                </div>
                <div class="radio">
                    <label for="">Profile & CV</label>
                    <input  type="radio" name="type" value="2">
                </div>
            </div>
            <div class="form-group">
                <label for="message-text" class="control-label">Message:</label>
                <textarea class="form-control" id="message-text"></textarea>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
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
    $('#withdraw-applications').click(function(){
        var length = $('.checkboxs-jobs:checked').length;
        if(length > 0){
            $('#form-withdraw-applications').submit();
        }
    });
    $('#form-withdraw-applications').submit(function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        axios.post($(this).attr('action'), formData)
        .then(function(response){
            removeApplications();
            var alertSelector = $('.alert-success');
            alertSelector.find('.message').text(response.data.status);
            alertSelector.show();
            alertSelector.delay(3000).fadeOut(300);
        })
        .catch(function (error) {
            console.log(error);
        });
    });
    function removeApplications(){
        $('.checkboxs-jobs:checked').each(function(){
            $(this).closest('tr').remove();
        });
    }

    @if(isset($tab))
        $('.nav-tabs a[href="#{{$tab}}"]').tab('show');
    @endif
</script>
@endsection