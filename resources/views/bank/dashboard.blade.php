<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.bank')

@section('title', 'Dashboard')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">




        </div>
    </div>


@endsection