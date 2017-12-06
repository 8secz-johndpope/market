@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<div class="body">
    <div class="container">
    <form action="/user/message/send" method="post" id="req-inv-form">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{$advert->id}}">
    <div class="row">
        <div class="col-sm-11 col-sm-offset-1">
            <h4 class="bold-text">{{$advert->param('title')}}</h4>
            <p class="bold-text">{{$advert->param('location_name')}}</p>
            <div class="well">
                <div class="under-heading">
                    <h4 class="bold-text">Send Request Invoice</h4>
                </div>
                <p>Your request to {{$advert->param('username')}}</p>
                <input type="hidden" name="message" value="Request Invoice">
                <p>Requests will be sent to <strong class="bold-text">{{$user->name}}</strong> at <strong class="bold-text">{{$user->email}}</strong> </p>
                <button class="btn btn-primary g-recaptcha"  data-sitekey="6Le7jzMUAAAAAERoH4JkYtt4pE8KASg0qTY7MwRt"
                        data-callback="onSubmit">Send Request Invoice</button>
            </div>
        </div>
    </div>
    </form>
    </div>
</div>
    <script>
        function onSubmit(token) {
            document.getElementById("req-inv-form").submit();
        }
    </script>
@endsection