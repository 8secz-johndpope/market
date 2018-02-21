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

            <h4 style="text-align: center">Total Users: {{$total}}</h4>


        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">

            <br><br><br>
            <h4>Users</h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Disable/Enable</th>
                    <th scope="col">Adverts</th>

                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        @if($user->enabled===1)
                        <td><a href="/admin/disable/user/{{$user->id}}" class="btn btn-danger">Disable</a> </td>
                        @else
                            <td><a href="/admin/enable/user/{{$user->id}}" class="btn btn-primary">Enable</a> </td>
                        @endif

                        <td><a href="/userads/{{$user->id}}">{{$user->countEAdverts()}}</a></td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$users->links()}}
        </div>

    </div>


@endsection