<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">

        <div class="col-sm-6 col-sm-offset-3">
            <h1>Sorry!The item you are looking for is not found</h1>
            <img src="/css/ic_launcher1.png" style="width: 500px">

        </div>
    </div>
    @endsection