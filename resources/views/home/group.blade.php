<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.next')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">

            <ul class="nav nav-tabs">

                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/ads"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;&nbsp; Manage  ads</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/images"><span class="glyphicon glyphicon-camera"></span>&nbsp;&nbsp;Images</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/orders"><span class="glyphicon glyphicon-credit-card"></span> &nbsp;&nbsp; Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/messages"><span class="glyphicon glyphicon-envelope"></span> &nbsp;&nbsp; Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/details"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; My Details</a>
                </li>
                @if($user->contract!==null)
                    <li class="nav-item">
                        <a class="nav-link nav-color" href="/business/manage/company"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp; Company</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-color" href="/business/manage/finance"><span class="glyphicon glyphicon-gbp"></span> &nbsp;&nbsp; Financials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-color" href="/business/manage/metrics"><span class="glyphicon glyphicon-stats"></span> &nbsp;&nbsp; Metrics</a>
                    </li>
                @endif
                <li class="nav-item active">
                    <a class="nav-link nav-color" href="#"><span class="glyphicon glyphicon-heart"></span> &nbsp;&nbsp; Favorites</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/alerts"><span class="glyphicon glyphicon-bell"></span> &nbsp;&nbsp; Search Alerts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/support"><span class="glyphicon glyphicon-earphone"></span> &nbsp;&nbsp; Support</a>
                </li>
            </ul>
        </div>
    </div>
    <form method="post" action="/user/groups/add">
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Group Title</label>
            <div class="col-sm-10">
                <input type="text"  class="form-control" name="title">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-12">
                <a ><img src="/css/addimage.png" class="add-profile-image" style="cursor: pointer"></a>
                <input type="file" id="upload-profile"  style="display: none">
                <input type="hidden" name="image" value="no_avatar.jpg">

            </div>
        </div>
        {{ csrf_field() }}
        <ul class="list-group">
            @foreach($user->contacts as $contact)
                @if($contact->is_user())
            <li class="list-group-item">
        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" value="">
                <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$contact->u()->image}}" class="lazyload" alt="" style="width: 100px">
                {{$contact->first}}
            </label>
        </div>
            </li>
                @endif
                @endforeach
        </ul>
        <div class="row">
            <div class="col">
                <input type="submit" class="btn btn-primary" value="Create Group">

            </div>
            <div class="col">
            </div>
        </div>
    </form>
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