<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <ul class="list-inline">
        <li class="list-inline-item">Lorem ipsum</li>
        <li class="list-inline-item">Phasellus iaculis</li>
        <li class="list-inline-item">Nulla volutpat</li>
    </ul>
    @endsection