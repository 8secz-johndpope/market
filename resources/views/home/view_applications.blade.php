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
            <div class="col-sm-12">
                <a href="{{$job->url()}}"><h4>Applications for {{$job->param('title')}}</h4></a>
                <table class="table">
                    <tr><th>Name</th><th>Phone</th><th>Cover</th><th>CV</th><th>Profile</th><th>Reply</th></tr>
                @foreach($job->applications as $application)
                    <tr><td>{{$application->user->name}}</td><td>{{$application->user->phone}}</td><td>@if($application->cover){{$application->cover->cover}} @else <span>No Cover</span> @endif</td> <td>              @if($application->cv)                      <a target="_blank" href="{{env('AWS_CV_IMAGE_URL')}}/{{$application->cv->file_name}}">View/Download</a> @else <span>No Cv</span> @endif</td><td><a href="/job/profile/view/{{$application->user_id}}">View Profile</a></td><td><a class="btn btn-primary" href="/user/areply/{{$application->id}}">Reply</a></td></tr>
                @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection