<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title', 'Admin Dashboard')

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
            <a href="/admin/manage/commissions" class="btn btn-primary">Commissions</a>             <a href="/admin" class="btn btn-primary">Users</a>
            <a href="/admin" class="btn btn-primary">Contracts</a>
            <a href="/admin" class="btn btn-primary">Adverts</a>
        </div>
    </div>


@endsection