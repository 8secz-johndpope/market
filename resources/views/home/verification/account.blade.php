@extends('layouts.app')

@php
    $date = new Datetime();
    $dateMs = $date->getTimestamp();
@endphp
@section('styles')
<link rel="stylesheet" href="/build/css/intlTelInput.css">
<link rel="stylesheet" href="{{asset("/css/register.css?q=$dateMs")}}">
@endsection
@section('content')

<div class="body background-body">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if(session('status'))
                <div class="alert alert-success" role="alert">
                    {{session('status')}}
                </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>We sent you an activation code. Check your email and click on the link verification. You must verify your address to continue</h3>
                    </div>
                    <div class="panel-body">
                        <p>The page you requested requires that you first verify your email address. Clicking the button below will send an email to the address associated with your account. It will contain a link that, when clicked, will verify your email address. You will only have to do this once.</p>
                        <a href="/user/send/verify-code?user_id={{$user}}" class="btn btn-submit">Send again the verification email</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="/build/js/intlTelInput.js"></script>
<script>
    function onSubmit(token) {
        document.getElementById("register-form").submit();
    }
    $("#phone").intlTelInput();
</script>
@endsection
