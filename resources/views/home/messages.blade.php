<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

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
                    <a class="nav-link" href="/user/manage/ads">Manage My ads</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/user/manage/orders">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/user/manage/buying">Buying</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/user/manage/favorites">Favorites</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/user/manage/details">My Details</a>
                </li>
            </ul>
            <div class="full-width">
                <div class="left-div-messages">
                    {{count($g)}}
                    @foreach($g as $group)
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <div class="listing-side">
                                        <div class="listing-thumbnail">
                                            <img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{ isset($group['image'])?$group['image']:"noimage.png"}}" class="lazyload" alt="">


                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">{{$group['title']}}</h4>
                                ...
                            </div>
                        </div>
                        @endforeach
                </div>
                <div class="right-div-messages">
                    <ul class="list-group">
                        @foreach($r as $message)
                            <li class="list-group-item">{{$message['message']}}</li>
                            @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>


@endsection