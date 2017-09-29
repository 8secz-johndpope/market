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
                        <div class="media @if($group['rid']===$rid) selected-room @endif">
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
                                <a href="/user/manage/messages/{{$group['rid']}}"><h4 class="media-heading">{{$group['title']}}</h4></a>
                                ...
                            </div>
                        </div>
                        @endforeach
                </div>
                <div class="right-div-messages">
                    <div class="all-messages">
                        @foreach($r as $message)
                            @if($message['from_msg']===$user->id)
                            <span class="right-message">{{$message['message']}}</span><br>
                            @else
                                <span class="left-message">{{$message['message']}}</span><br>
                            @endif

                        @endforeach
                    </div>


                    <div class="bottom-div-messages">
                        <form action="/user/message/rsend" method="post">
                            <input type="hidden" name="rid" value="{{$rid}}">
                            {{ csrf_field() }}                            <div class="message-input-div"><input type="text" class="form-control"  name="message" placeholder="Type Your Message here" required></div>
                            <div class="message-send-div"><button type="submit" class="btn btn-primary">Send</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection