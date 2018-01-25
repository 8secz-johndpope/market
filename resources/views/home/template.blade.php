<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="body">
        <form action="/user/templates/save" method="post" id="login-form">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-11 col-sm-offset-1">
                    <div class="well">
                        <input type="text" name="title" class="form-control">
                        <textarea cols="50" rows="5" name="message">Can you attend interview next week and join immediately?</textarea>
                        <button class="btn btn-primary" type="submit">Add Template</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection