<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">

        <div class="col-sm-4">
        </div>
        <div class="col-sm-4">
            <br><br><br>

            <h4 style="text-align: center">Total Adverts: {{$total}}</h4>
            <h4 style="text-align: center">Total Reports: {{count($reports)}}</h4>


        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
            <br><br><br>
            <h4>Reports</h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">User</th>
                    <th scope="col">Description</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reports as $report)
                    @if($report->user)
                        <tr>
                            <td>{{$report->advert->param('title')}}</td>
                            <td>{{$report->advert->category->title}}</td>
                            <td>{{$report->user->name}}</td>
                            <td>{{$report->info}}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>

            <br><br><br>
            <h4>Adverts</h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">User</th>
                    <th scope="col">Disable/Enable </th>
                </tr>
                </thead>
                <tbody>
                @foreach($adverts as $advert)
                        <tr>
                            <td>{{$advert->param('title')}}</td>
                            <td>{{$advert->category->title}}</td>
                            <td>{{$advert->user->name}}</td>
                            @if($advert->status===1)
                                <td><a href="/admin/disable/advert/{{$advert->id}}" class="btn btn-danger">Disable</a> </td>
                            @else
                                <td><a href="/admin/enable/advert/{{$advert->id}}" class="btn btn-primary">Enable</a> </td>
                            @endif                        </tr>
                @endforeach
                </tbody>
            </table>
            {{$adverts->links()}}

        </div>

    </div>


@endsection