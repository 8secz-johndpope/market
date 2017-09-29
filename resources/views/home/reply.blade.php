<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <form action="/user/message/send">
    <div class="row">
        <div class="col-sm-11 col-sm-offset-1">
            <h4 class="bold-text">{{$advert->param('title')}}</h4>
            <p class="bold-text">{{$advert->param('location_name')}}</p>
            <div class="well">
                <div class="under-heading">
                    <h4 class="bold-text">Reply to the listing</h4>
                </div>
                <p>Your message to {{$advert->param('username')}}</p>
                <textarea cols="50" rows="5" name="message"></textarea>
                <p>Replies will be sent to <strong class="bold-text">{{$user->name}}</strong> at <strong class="bold-text">{{$user->email}}</strong> </p>
                <button class="btn btn-primary">Send Message</button>
            </div>
        </div>
    </div>
    </form>

@endsection