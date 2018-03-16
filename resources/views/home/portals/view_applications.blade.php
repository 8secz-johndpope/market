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
<div class="body background-body body-applications">
    <div class="container all-applications">
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
                    <a href="/user/manage/applications">< Back to jobs</a>
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
            <div class="col-sm-4">
                <div class="btns-actions">
                    <button type="button" class="btn btn-disable">Change Status</button>
                    <button type="button" data-toggle="modal" data-target="#select-template" class="btn btn-disable">Reply Selected</button>
                </div>
            </div>
            <div class="col-sm-4">
                @if (session('msg'))
                    <span style="color: green">
                        <strong>{{ session('msg') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <form method="post" action="/user/reply/all" id="form-replay-all">
                    {{ csrf_field() }}
                    <input type="hidden" name="template" id="template">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="select-all" id="select-all"> Select All</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Date Applied</th>
                                <th>CV</th>
                                <th>Profile</th>
                                <th>Reply</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($job->applications as $application)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{$application->id}}" class="select-application"></td>
                                <td>{{$application->user->name}}</td>
                                <td>{{$application->user->phone}}</td>
                                <td>{{$application->getStatusEmployer()}}</td>
                                <td>{{$application->created_at->format('d M Y')}}</td>
                                <td>              @if($application->cv)                      <a target="_blank" href="{{env('AWS_CV_IMAGE_URL')}}/{{$application->cv->file_name}}">View/Download</a> @else <span>No Cv</span> @endif</td>
                                <td><a href="/job/profile/view/{{$application->user_id}}">View Profile</a></td>
                                <td><a class="btn btn-primary" href="/user/areply/{{$application->id}}">Reply</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="select-template" tabindex="-1" role="dialog" aria-labelledby="select-template" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Send Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if($user->templates->count() > 0)
        <div class="form-group">
            <label>Select a Template</label>
            <select class="form-control" id="template-reply" name="template-reply">
                @foreach($user->templates as $template)
                <option value="{{$template->id}}">{{$template->title}}</option>
                @endforeach
            </select>
        </div> 
        @endif
        <div>
            <p>You do not have reply templates, if you want to create a new one click <a href="/user/templates/add">here</a></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-submit" {{ $user->templates->count() == 0 ? 'disabled' : ''}}>Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>
    $('#select-all').change(function() {
        var checkboxs = $('.select-application');
        if(this.checked) {
            checkboxs.prop('checked', true);
        }else{
            checkboxs.prop('checked', false);
        }
        checkboxs.change();
    });
    $('.select-application').change(function(){
        var parent = $(this).closest('.all-applications');
        var checkboxs = parent.find('tbody input:checked');
        if(checkboxs.length > 0){
            var buttons = parent.find('button.btn-disable');
            buttons.addClass('btn-action');
            buttons.removeClass('btn-disable');
        }
        else{
            var buttons = parent.find('button.btn-action');
            buttons.removeClass('btn-action');
            buttons.addClass('btn-disable');
        }
        parent.find('.num-jobs').text(checkboxs.length);
    });
    $('.modal-footer .btn-submit').click(function(){
        $('#template').val($('#template-reply').val());
        $('#form-replay-all').submit();
    });
</script>
@endsection