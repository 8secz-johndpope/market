<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#">Manage My ads</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Messages</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Favorites</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">My Details</a>
        </li>
    </ul>

    @endsection