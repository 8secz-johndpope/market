<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.next')

@section('title', 'Contacts')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-10">
            <br><br>
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
                @endforeach
        </tbody>

    </table>


    <h4>Invite</h4>  <a href="/invite/all" class="btn btn-outline-primary">Invite All</a>
    <table class="table table-striped">
        <thead>
        <tr><th>First Name</th><th>Last Name</th><th>Phone</th><th>Email</th><th>Invite</th></tr>
        </thead>
        <tbody>
        @foreach($user->contacts as $contact)
            @if(!$contact->is_user())
                <tr><td>{{$contact->first}}</td><td>{{$contact->last}}</td><td>{{$contact->phone}}</td><td>{{$contact->email}}</td><td> @if($contact->sent===0) <a href="/invite/contact/{{$contact->id}}" class="btn btn-outline-primary">Invite</a> @else <a class="btn btn-outline-info" disabled>Invitation Sent</a>   @endif </td></tr>
            @endif
        @endforeach
        </tbody>
    </table>
        </div>
    </div>
@endsection