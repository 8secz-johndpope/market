<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.bank')

@section('title', 'Dashboard')

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
            <h4 style="text-align: center">Your Balance: £0</h4>
        </div>
    </div>


@endsection