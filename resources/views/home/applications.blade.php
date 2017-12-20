<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Your Applications |')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<div class="body background-body">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="containe-num-jobs text-center">
                    <h2>Your jobs <span>{{count($jobs)}}</span></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="container-filter">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="container-applications">
                    <table class="w100p table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Period</th>
                                <th>Views</th>
                                <th>Applications</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobs as $job)
                            <tr>
                                <td><a href="{{$job->url()}}"><h4>{{$job->param('title')}}</h4></a></td>
                                <td>{{$job->param('location_name')}}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><a href="/job/manage/applications/{{$job->id}}">{{count($job->applications)}} Applications</a></td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection