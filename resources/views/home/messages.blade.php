<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 over-hidden">
            <ul class="nav nav-tabs top-main-nav">
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/ads"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;&nbsp; Manage  ads</a>
                </li>
                <li class="nav-item">
                <a class="nav-link nav-color" href="/user/manage/images"><span class="glyphicon glyphicon-camera"></span>&nbsp;&nbsp;Images</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/orders"><span class="glyphicon glyphicon-credit-card"></span> &nbsp;&nbsp; Orders</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link nav-color" href="#"><span class="glyphicon glyphicon-envelope"></span> &nbsp;&nbsp;Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/details"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; My Details</a>
                </li>
                @if($user->contract!==null)

                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/company"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp; Company</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/finance"><span class="glyphicon glyphicon-gbp"></span> &nbsp;&nbsp; Financials</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/metrics"><span class="glyphicon glyphicon-stats"></span> &nbsp;&nbsp; Metrics</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/favorites"><span class="glyphicon glyphicon-heart"></span> &nbsp;&nbsp; Favorites</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/user/manage/alerts"><span class="glyphicon glyphicon-bell"></span> &nbsp;&nbsp; Search Alerts</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/support"><span class="glyphicon glyphicon-earphone"></span> &nbsp;&nbsp; Support</a>
                </li> -->
            </ul>
        </div>
        <div class="col-sm-12">
            <div class="full-width">
                @if(count($user->rooms)>0)
                <div class="conversations-container">
                    <div class="l-top">
                        <div class="text-heading pane-list-user">
                            <div class="avatar">
                                <span>
                                    <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$user->image}}" class="avatar-image">
                                </span>
                            </div>
                            <!-- <span>My Conversations</span> -->
                        </div>
                        <div class="pane-list-controls">
                            <div class="controls-container">
                                <span>
                                    <div class="controls-fields">
                                        <div role="button">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                                    <path fill="#727A7E" d="M12 20.664a9.163 9.163 0 0 1-6.521-2.702.977.977 0 0 1 1.381-1.381 7.269 7.269 0 0 0 10.024.244.977.977 0 0 1 1.313 1.445A9.192 9.192 0 0 1 12 20.664zm7.965-6.112a.977.977 0 0 1-.944-1.229 7.26 7.26 0 0 0-4.8-8.804.977.977 0 0 1 .594-1.86 9.212 9.212 0 0 1 6.092 11.169.976.976 0 0 1-.942.724zm-16.025-.39a.977.977 0 0 1-.953-.769 9.21 9.21 0 0 1 6.626-10.86.975.975 0 1 1 .52 1.882l-.015.004a7.259 7.259 0 0 0-5.223 8.558.978.978 0 0 1-.955 1.185z"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="controls-fields">
                                        <div role="button">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path opacity=".55" fill="#263238" d="M19.005 3.175H4.674C3.642 3.175 3 3.789 3 4.821V21.02l3.544-3.514h12.461c1.033 0 2.064-1.06 2.064-2.093V4.821c-.001-1.032-1.032-1.646-2.064-1.646zm-4.989 9.869H7.041V11.1h6.975v1.944zm3-4H7.041V7.1h9.975v1.944z"></path></svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="controls-fields">
                                        <div role="button">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="#263238" fill-opacity=".6" d="M12 7a2 2 0 1 0-.001-4.001A2 2 0 0 0 12 7zm0 2a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 9zm0 6a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 15z"></path></svg>
                                            </span>
                                        </div>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="left-div-messages {{$leftclass}}" id="all-rooms">
                        @foreach($user->rooms as $room)
                                <div class="media @if($room->id===$cur->id) selected-room @endif ">
                                    <div class="media-left">
                                        <a href="#">
                                            <div class="listing-side">
                                                <div class="listing-thumbnail">
                                                    <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$room->image}}" class="lazyload" alt="">
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <div class="chat-main">
                                            <div class="chat-title">
                                                <a href="/user/manage/messages/{{$room->id}}">
                                                    <div class="title-user">{{$room->other()->display_name}}</div>
                                                    <div class="media-heading">{{$room->title}}</div>
                                                </a>
                                            </div>
                                            <div class="chat-meta">
                                                <span class="message-time"> {{$room->last_message()->stringDateTime()}}</span>
                                            </div>
                                        </div>
                                        <div class="chat-secondary">
                                            @if($room->last_message())
                                            <div class="chat-status"> 
                                                
                                                <p class="@if($room->unread===1) unread-message @endif">
                                                    {{$room->last_message()->message}}
                                                </p>
                                            </div>
                                            <div class="chat-meta">
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                    </div>
                </div>
                <div class="right-div-messages {{$rightclass}}">
                    <div class="mtop">
                        <a class="message-back-button"  href="/user/manage/messages">Back</a>
                        <div class="chat-avatar">
                            <div class="avatar">
                                <span>
                                    <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$cur->image}}" class="avatar-image">
                                </span>
                            </div>
                        </div>
                        <div class="chat-body">
                            <div class="chat-main">
                                <div class="chat-title">
                                    <div class="title-user">
                                        {{$cur->other()->display_name}}
                                    </div>
                                    <div class="media-heading">
                                        <div class="title-product">
                                            <div class="title-main">
                                                <a class="listing-product" href="/p/{{$cur->advert->param('category')}}/{{$cur->advert->id}}"> <span>{{$cur->advert->param('title')}}</span></a>
                                                @if($cur->advert->meta('price')>=0)
                                                    <span class="product-price">£ {{$cur->advert->meta('price')/100}}{{$cur->advert->meta('price_frequency')}}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pane-chat-controls">
                            <div class="controls-container">
                                <div class="button-invoice">
                                    <a class="btn btn-primary" href="/room/invoice/create/{{$cur->id}}">Send Invoice</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="all-messages" id="all-msg">
                        @foreach($cur->messages as $message)
                            @if($message->previous()&&$message->previous()->day()!==$message->day()||!$message->previous())
                               <div class="day-seperator"><span class="day-seperator-text">{{$message->day()}}</span> </div>
                                @endif

                            @if($message->type==='invoice')
                                    @if($message->from_msg===$user->id)
                                        <div class="right-message clearfix">
                                            <span>
                                                @if($message->invoice->status==1)<span class="green-text">Paid</span> @else  <span class="yellow-text">Pending</span> @endif
                                            </span>
                                            <span class="message"> Invoice Sent for  £{{$message->invoice->amount()}} &nbsp;&nbsp; <span class="message-time"> {{$message->timestamp()}}</span> </span>
                                            
                                        </div>

                                    @else
                                        <div class="left-message clearfix"><span class="message get-invoice"> Got Invoice for  £{{$message->invoice->amount()}}  &nbsp;&nbsp;  <span class="message-time"> {{$message->timestamp()}}</span></span> <span>
                                                @if($message->invoice->status==1)<span class="green-text">Paid</span> @else  <a class="btn btn-primary btn-pay" href="/pay/invoice/{{$message->invoice->id}}">Pay Here</a> @endif
                                            </span></div>


                                    @endif

                                    @else

                            @if($message->from_msg===$user->id)

                            <div class="right-message clearfix"><span class="message"> {{$message->message}}&nbsp;&nbsp; <span class="message-time"> {{$message->timestamp()}}</span> </span></div>
                            @else
                                <div class="left-message clearfix"><span class="message">{{$message->message}}&nbsp;&nbsp;  <span class="message-time"> {{$message->timestamp()}}</span></span></div>
                            @endif
@endif
                        @endforeach
                    </div>


                    <div class="bottom-div-messages">
                        <form action="/user/message/rsend" method="post" id="login-form">
                            <input type="hidden" name="rid" value="{{$cur->id}}">
                            {{ csrf_field() }}                            <div class="message-input-div"><input type="text" class="form-control"  id="message" name="message" placeholder="Type Your Message here" required></div>
                            <div class="message-send-div">
                                <button type="submit"  class="btn btn-send-msg g-recaptcha" data-sitekey="6Le7jzMUAAAAAERoH4JkYtt4pE8KASg0qTY7MwRt" data-callback="onSubmit">
                                    <span class="glyphicon glyphicon-send send"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                    @else
                    <h4>No Messages to Display</h4>
                    @endif
            </div>
        </div>
    </div>
</div>
    <script>
        function scroll_bottom() {
            var objDiv = document.getElementById("all-msg");
            objDiv.scrollTop = objDiv.scrollHeight;
        }
        scroll_bottom();
        function onSubmit(token) {


            document.getElementById("login-form").submit();



        }

        var room = @if($cur) {{$cur->id}} @else 0 @endif;

        function got_message(data) {
            var object = JSON.parse(data);
            console.log(object);
            if(object.message&&object.room_id==room)
            {
                axios.get('/user/manage/msgs/'+object.room_id, {
                    params: {}
                })
                    .then(function (response) {
                        console.log(response);
                        $('#all-msg').html(response.data);
                        scroll_bottom();

                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                    axios.get('/user/manage/rooms/'+object.room_id+'/'+room, {
                    params: {}
                })
                    .then(function (response) {
                        console.log(response);
                        $('#all-rooms').html(response.data);

                    })
                    .catch(function (error) {
                        console.log(error);
                    });
               // $('#all-msg').append('<div class="left-message"><span class="message">'+object.message+'</span></div>');

            }else if(object.message){

                // location.reload();
                axios.get('/user/manage/rooms/'+object.room_id+'/'+room, {
                    params: {}
                })
                    .then(function (response) {
                        console.log(response);
                        $('#all-rooms').html(response.data);

                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }
        }




    </script>

@endsection