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
            <h4>Adverts</h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">User</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($adverts as $advert)
                        <tr>
                            <td>{{$advert->param('title')}}</td>
                            <td>{{$advert->category->title}}</td>
                            <td>{{$advert->user->name}}</td>
                            <td><a href="/admin" class="btn btn-danger">Delete</a> </td>
                        </tr>
                @endforeach
                </tbody>
            </table>

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
                    <tr>
                        <td>{{$report->advert->param('title')}}</td>
                        <td>{{$report->advert->category->title}}</td>
                        <td>{{$report->user->name}}</td>
                        <td>{{$report->info}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>


@endsection