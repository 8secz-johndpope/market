<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.next')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">

            <ul class="nav nav-tabs">

                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/ads"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;&nbsp; Manage  ads</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/images"><span class="glyphicon glyphicon-camera"></span>&nbsp;&nbsp;Images</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/orders"><span class="glyphicon glyphicon-credit-card"></span> &nbsp;&nbsp; Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/messages"><span class="glyphicon glyphicon-envelope"></span> &nbsp;&nbsp; Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/details"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; My Details</a>
                </li>
                @if($user->contract!==null)
                    <li class="nav-item">
                        <a class="nav-link nav-color" href="/business/manage/company"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp; Company</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-color" href="/business/manage/finance"><span class="glyphicon glyphicon-gbp"></span> &nbsp;&nbsp; Financials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-color" href="/business/manage/metrics"><span class="glyphicon glyphicon-stats"></span> &nbsp;&nbsp; Metrics</a>
                    </li>
                @endif
                <li class="nav-item active">
                    <a class="nav-link nav-color" href="#"><span class="glyphicon glyphicon-heart"></span> &nbsp;&nbsp; Favorites</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/alerts"><span class="glyphicon glyphicon-bell"></span> &nbsp;&nbsp; Search Alerts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/support"><span class="glyphicon glyphicon-earphone"></span> &nbsp;&nbsp; Support</a>
                </li>
            </ul>
        </div>
    </div>
    <a class="btn btn-primary" href="/user/contacts/add">Add Contact</a>
    <a class="btn btn-success" href="/user/groups/create">New Group</a>

    <h4>Favorites</h4>
    <table class="table table-striped">
        <thead>

        <tr><th>First Name</th><th>Last Name</th><th>Phone</th><th>Email</th><th>Send Message</th><th>Send Invoice</th></tr>
        </thead>
        <tbody>
        @foreach($user->contacts as $contact)
            @if($contact->is_user())
            <tr><td>{{$contact->first}}</td><td>{{$contact->last}}</td><td>{{$contact->phone}}</td><td>{{$contact->email}}</td><td>@if($contact->is_user())<a class="btn btn-primary" href="/user/direct/message/{{$contact->uid()}}">Send Message</a> @else <a class="btn btn-outline-primary" href="#">Invite</a> @endif</td><td>@if($contact->is_user())<a class="btn btn-primary" href="/user/direct/invoice/{{$contact->uid()}}">Send Invoice</a> @else  @endif</td></tr>
            @endif
        </tbody>
                @endforeach
    </table>


    <h4>Invite</h4>
    <table class="table table-striped">
        <thead>
        <tr><th>First Name</th><th>Last Name</th><th>Phone</th><th>Email</th><th>Invite</th></tr>
        </thead>
        <tbody>
        @foreach($user->contacts as $contact)
            @if(!$contact->is_user())
                <tr><td>{{$contact->first}}</td><td>{{$contact->last}}</td><td>{{$contact->phone}}</td><td>{{$contact->email}}</td><td> <a class="btn btn-outline-primary" href="#">Invite</a> </td></tr>
            @endif
        @endforeach
        </tbody>
    </table>

@endsection