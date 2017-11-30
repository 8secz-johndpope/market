<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <form action="/user/message/asend" method="post" id="login-form">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{$application->id}}">
    <div class="row">
        <div class="col-sm-11 col-sm-offset-1">
            <h4 class="bold-text">Application for {{$application->advert->param('title')}}</h4>
            <div class="well">
                <div class="under-heading">
                    <h4 class="bold-text">Reply to the listing</h4>
                </div>
                <p>Your message to {{$application->user->name}}</p>
                <textarea cols="50" rows="5" name="message"></textarea>
                <p>Replies will be sent to <strong class="bold-text">{{$user->name}}</strong> at <strong class="bold-text">{{$user->email}}</strong> </p>
                <button class="btn btn-primary g-recaptcha"  data-sitekey="6Le7jzMUAAAAAERoH4JkYtt4pE8KASg0qTY7MwRt"
                        data-callback="onSubmit">Send Message</button>
            </div>
        </div>
    </div>
    </form>
    <script>
        function onSubmit(token) {


            document.getElementById("login-form").submit();



        }
    </script>
@endsection