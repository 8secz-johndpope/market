<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<div class="body background-body">
    <div class="container">
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-6">
                @foreach($jobs as $job)
                    <a href="{{$job->url()}}"><h4>{{$job->param('title')}}</h4></a>
                    <br>
                    <a href="/job/manage/applications/{{$job->id}}">{{count($job->applications)}} Applications</a>
                    @endforeach
            </div>
        </div>
    </div>
</div>
@endsection