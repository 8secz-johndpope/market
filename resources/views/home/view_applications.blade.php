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
            <div class="col-sm-12">
                <div class="btns-actions">
                    <a href="#" class="btn btn-disable">Change Status</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form method="post" action="/user/reply/all">
                    {{ csrf_field() }}
                    <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Date Applied</th>
                            <th class="cell-cover">Cover</th>
                            <th>CV</th>
                            <th>Profile</th>
                            <th>Reply</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr><td><input type="checkbox" class="select-all" id="select-all"> Select All</td></tr>
                    @foreach($job->applications as $application)
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="{{$application->id}}" class="select-application"></td>
                            <td>{{$application->user->name}}</td>
                            <td>{{$application->user->phone}}</td>
                            <td>New</td>
                            <td>{{$application->created_at->format('d M Y')}}</td>
                            <td>@if($application->cover){{$application->cover->cover}} @else <span>No Cover</span> @endif</td> 
                            <td>              @if($application->cv)                      <a target="_blank" href="{{env('AWS_CV_IMAGE_URL')}}/{{$application->cv->file_name}}">View/Download</a> @else <span>No Cv</span> @endif</td>
                            <td><a href="/job/profile/view/{{$application->user_id}}">View Profile</a></td>
                            <td><a class="btn btn-primary" href="/user/areply/{{$application->id}}">Reply</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4"><select class="form-control" id="inlineFormCustomSelect" name="template">
                                @foreach($user->templates as $template)

                                <option value="{{$template->id}}">{{$template->title}}</option>
                                @endforeach
                            </select></div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary">Reply Selected</button>

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <script>
        $('#select-all').change(function() {
            if(this.checked) {
                $('.select-application').prop('checked', true);

            }else{
                $('.select-application').prop('checked', false);

            }
        });
    </script>
@endsection