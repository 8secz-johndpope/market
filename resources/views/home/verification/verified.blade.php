@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
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
                        <p>{{$msg}}</p>
                        <p>Please return to the <a href="/login">login</a> to enjoy of {{env('APP_NAME')}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection