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
                                            <h4 class="media-heading">{{$room->title}}</h4> 
                                            <span class="title-user">{{$room->other()->display_name}}</span>
                                        </a>
                                    </div>
                                    <div class="chat-meta">
                                        <span class="message-time"> {{$room->last_message()->timestamp()}}</span>
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
                                         <strong>{{$room->last_message()->user->name}}</strong>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                </div>
                <div class="right-div-messages {{$rightclass}}">
                    <div class="mtop">
                        <a class="message-back-button"  href="/user/manage/messages">Back</a>
                        <div class="title-product">
                            <a class="listing-product" href="/p/{{$cur->advert->param('category')}}/{{$cur->advert->id}}"> <h4>{{$cur->advert->param('title')}}</h4></a>
                            @if($cur->advert->meta('price')>=0)
                                <span class="product-price">£ {{$cur->advert->meta('price')/100}}{{$cur->advert->meta('price_frequency')}}
                                </span>
                            @endif
                        </div>
                        <div class="button-invoice">
                            <a class="btn btn-primary" href="/room/invoice/create/{{$cur->id}}">Send Invoice</a>
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