<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.bank')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6">
            <br><br><br>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Send Money</th>
        </tr>
        </thead>
        <tbody>
        @foreach($user->contacts as $contact)
            <tr><td>{{$contact->first}}, {{$contact->last}}</td><td>@if($contact->is_user())<a class="btn btn-primary" href="/user/transfer/balance/{{$contact->uid()}}">Share Balance</a> @else  @endif</td></tr>
        @endforeach
        </tbody>
    </table>
        </div>
    </div>

@endsection