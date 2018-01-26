<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.next')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-2">

        </div>
        <div class="col-sm-8">
            <br>
            <br><br>
            <h4>My Applications</h4>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Date</th>
                        <th scope="col">Cover</th>
                        <th scope="col">CV</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($applications as $application)
                        <tr>
                            <td><a href="{{$application->advert->url()}}"> {{$application->advert->param('title')}}</a>
                            </td>
                            <td>{{$application->created_at->format('d M Y')}}</td>
                            <td>@if($application->cover){{$application->cover->cover}} @else <span>No Cover</span> @endif</td>
                            <td>              @if($application->cv)                      <a target="_blank" href="{{env('AWS_CV_IMAGE_URL')}}/{{$application->cv->file_name}}">View/Download</a> @else <span>No Cv</span> @endif</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            {{ $applications->links() }}

        </div>
        <div class="col-sm-2">

        </div>

    </div>

@endsection