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
            <div class="col-md-12">
                <div class="container-applications">
                    <table class="w100p">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobs as $job)
                            <tr>
                                <td><a href="{{$job->url()}}"><h4>{{$job->param('title')}}</h4></a></td>
                                <td></td>
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