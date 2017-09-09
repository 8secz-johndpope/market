<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="/user/manage/ads">Manage My ads</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/user/manage/orders">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/user/manage/buying">Buying</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/user/manage/messages">Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/user/manage/favorites">Favorites</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">My Details</a>
                </li>
            </ul>
           <table class="table">
               <tr><td>Name</td><td>{{$user->name}}</td></tr>
               <tr><td>Email</td><td>{{$user->email}}</td></tr>
               <tr><td>Phone</td><td>{{$user->phone}}</td></tr>
           </table>
            <h4>Adresses</h4>
            @foreach($user->addresses as $address)
                <a class="glyphicon glyphicon-trash delete-icon" href="/user/address/delete/{{$address->id}}"></a>
                <ul class="list-group">
                    <li class="list-group-item"> {{$address->line1}}</li>
                    <li class="list-group-item">{{$address->city}}</li>
                    <li class="list-group-item">{{$address->postcode}}</li>
                </ul>
                @endforeach
        </div>
    </div>


@endsection