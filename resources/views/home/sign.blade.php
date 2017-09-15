<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.contract')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')

<embed src="https://sumra.net/css/contract.pdf" width="500" height="375" type='application/pdf'>
@endsection