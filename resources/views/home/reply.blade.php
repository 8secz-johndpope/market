<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-11 col-sm-offset-1">
            <h1>{{$advert->param('title')}}</h1>
        </div>
    </div>


@endsection