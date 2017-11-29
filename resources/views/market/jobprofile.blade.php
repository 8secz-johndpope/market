<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">
            <h2>{{$user->name}}</h2>
            <h4>About me</h4>
            {!! $profile->about_me !!}
            <h4>Salary</h4>
            <p>{{$profile->salary}}</p>
        </div>
    </div>

@endsection