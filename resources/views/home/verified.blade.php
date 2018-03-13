<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<div class="body background-body">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div style="height: 500px">
                    <h4>{{$msg}}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection