@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@php
    $date = new Datetime();
    $dateMs = $date->getTimestamp();
@endphp
@section('styles')
<link rel="stylesheet" href="{{asset("/css/register.css?q=$dateMs")}}">
@endsection

@section('content')
<div class="body background-body">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Verifying email address</h3>
                    </div>
                    <div class="panel-body">
                        @if(isset($msg))
                        <p class="alert alert-success" role="alert">{{$msg}}</p>
                        <p>Please return to the <a href="/login">login</a> to enjoy of {{env('APP_NAME')}}
                        @elseif(isset($error))
                        <p>{{$error}}</p>
                        <p>Please do click on the link <a href="/user/verify-email?user_id={{$user}}">resend code</a> to enjoy of {{env('APP_NAME')}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection