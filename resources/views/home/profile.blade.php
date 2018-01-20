<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.next')

@section('title', env('APP_NAME'). ' | Profile')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@php
    $date = new Datetime();
    $dateMs = $date->getTimestamp();
@endphp
@section('content')
<div class="body background-color">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
            </div>
        </div>
        <form method="post" action="/user/save/profile">
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Display Name</label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" name="display_name" value="{{$user->display_name}}">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-12">
                    <a ><img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$user->image}}" class="add-profile-image" style="cursor: pointer;width: 50px;"></a>
                    <input type="file" id="upload-profile"  style="display: none">
                    <input type="hidden" name="image" value="{{$user->image}}" id="image">

                </div>
            </div>
            {{ csrf_field() }}
            <div class="row">
                <div class="col">
                    <input type="submit" class="btn btn-primary" value="Save Changes">

                </div>
                <div class="col">
                </div>
            </div>
        </form>
    </div>
</div>
    <script>
        $(".add-profile-image").click(function () {
            $("#upload-profile").click();
        });

        $("#upload-profile").change(function () {
            console.log("did change");
            upload_profile();
        });
    </script>
@endsection