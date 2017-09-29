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
            <h4 class="bold-text">{{$advert->param('title')}}</h4>
            <p class="bold-text">{{$advert->param('location_name')}}</p>
            <div class="well">
                <div class="under-heading">
                    <h4>Reply to the listing</h4>
                </div>
                <p>Your message to {{$advert->param('user_name')}}</p>
                <textarea cols="100">

                </textarea>
                <p>Replies will be sent to {{$user->name}} at{{$user->email}}</p>
            </div>
        </div>
    </div>


@endsection