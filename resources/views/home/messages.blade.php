<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <style>
        .search-div {
            position: absolute;
            bottom: 0;
            width: 300px;
            right: 0;
            top: 0;
            background: white;
            margin-top: 120px;
            display: none;
        }
        .cross-mark-search {
            width: 40px;
            font-size: 25px;
            float: right;
            cursor: pointer;
        }
        .message-search-list-item{
            cursor: pointer;
        }
    </style>
<div class="container-fluid background-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="full-width">
                @if(count($user->rooms)>0)
                <div class="conversations-container {{$leftclass}}">
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
                                        <a href="/user/new/message">
                                        <div role="button" data-role="New Chat">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path opacity=".55" fill="#263238" d="M19.005 3.175H4.674C3.642 3.175 3 3.789 3 4.821V21.02l3.544-3.514h12.461c1.033 0 2.064-1.06 2.064-2.093V4.821c-.001-1.032-1.032-1.646-2.064-1.646zm-4.989 9.869H7.041V11.1h6.975v1.944zm3-4H7.041V7.1h9.975v1.944z"></path></svg>
                                            </span>
                                        </div>
                                            </a>
                                    </div>
                                    <div class="controls-fields dropdown">
                                        <div role="button" data-role="Menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="#263238" fill-opacity=".6" d="M12 7a2 2 0 1 0-.001-4.001A2 2 0 0 0 12 7zm0 2a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 9zm0 6a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 15z"></path></svg>
                                            </span>
                                        </div>
                                        <ul class="dropdown-menu general-options">
                                          <li><a href="/user/manage/contacts">Contacts</a></li>
                                          <li><a href="/user/edit/profile">Profile</a></li>
                                          <li><a href="/user/groups/create">New Group</a></li>
                                          <li><a href="/user/new/broadcast">New broadcast</a></li>
                                          <li><a href="/download-mobile-apps">Call</a></li>
                                          <li><a href="/download-mobile-apps">VideoCall</a></li>
                                          <li><a href="#">Settings</a></li>
                                        </ul>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="left-div-messages" id="all-rooms">
                        @foreach($user->rooms as $room)
                            @if($room->is_visible())
                                <div class="media @if($room->id===$cur->id) selected-room @endif ">
                                    <div class="media-left">
                                        <a href="#">
                                            <div class="listing-side">
                                                <div class="listing-thumbnail">
                                                    <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$room->profile_image()}}" class="lazyload" alt="">
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <div class="chat-main">
                                            <div class="chat-title">
                                                <a href="/user/manage/messages/{{$room->id}}">
                                                    <div class="title-user">@if($room->direct===0&&$room->advert_id===0) {{$room->title}} @else {{$room->others()}} @endif</div>
                                                    <div class="media-heading">@if($room->direct===0&&$room->advert_id===0) {{$room->others()}} @else {{$room->title}} @endif</div>
                                                </a>
                                            </div>
                                            <div class="chat-meta">
                                                @if($room->last_message())
                                                <span class="message-time"> {{$room->last_message()->stringDateTime()}}</span>
                                                    @endif
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
                            @endif
                            @endforeach
                    </div>
                </div>
                <div class="right-div-messages {{$rightclass}}">
                    <div class="mtop">
                        <div class="chat-back">
                            <a class="message-back-button"  href="/user/manage/messages"><span class="glyphicon glyphicon-menu-left"></span></a>
                        </div>
                        <div class="chat-avatar">
                            <div class="avatar">
                                <span>
                                    <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$cur->profile_image()}}" class="avatar-image">
                                </span>
                            </div>
                        </div>
                        <div class="chat-body">
                            <div class="chat-main">
                                <div class="chat-title">
                                    <div class="title-user">
                                        @if($cur->direct===0&&$cur->advert_id===0) {{$cur->title}} @else {{$cur->others()}} @endif
                                    </div>
                                    <div class="media-heading">
                                        <div class="title-product">
                                            @if($cur->advert!==null)
                                            <div class="title-main">
                                                <a class="listing-product" href="/p/{{$cur->advert->param('category')}}/{{$cur->advert->id}}"> <span>{{$cur->advert->param('title')}}</span></a>
                                                @if($cur->advert->meta('price')>=0)
                                                    <span class="product-price">£ {{$cur->advert->meta('price')/100}}{{$cur->advert->meta('price_frequency')}}
                                                    </span>
                                                @endif
                                            </div>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pane-chat-controls">
                            <div class="controls-container">
                                <div class="controls-fields">
                                    <div role="button" data-role="Search" onclick="show_search()">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="#263238" fill-opacity=".5" d="M15.9 14.3H15l-.3-.3c1-1.1 1.6-2.7 1.6-4.3 0-3.7-3-6.7-6.7-6.7S3 6 3 9.7s3 6.7 6.7 6.7c1.6 0 3.2-.6 4.3-1.6l.3.3v.8l5.1 5.1 1.5-1.5-5-5.2zm-6.2 0c-2.6 0-4.6-2.1-4.6-4.6s2.1-4.6 4.6-4.6 4.6 2.1 4.6 4.6-2 4.6-4.6 4.6z"></path></svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="controls-fields">
                                    <div role="button" data-role="Call">
                                        <span>
                                            <a href="/download-mobile-apps">
                                                <img src="/css/icons/icon-call.svg" class="img-call" alt="Make Call">
                                            </a>
                                        </span>
                                    </div>
                                </div>
                                <div class="controls-fields">
                                    <div role="button" data-role="VideoCall">
                                        <span>
                                             <a href="/download-mobile-apps">
                                                <img src="/css/icons/icon-videocall.svg" class="img-call" alt="Make VideoCall">
                                            </a>
                                        </span>
                                    </div>
                                </div>
                                <div class="controls-fields">
                                    <div role="button" data-role="Attach" onclick="handleBtnClick()">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="#263238" fill-opacity=".5" d="M1.816 15.556v.002c0 1.502.584 2.912 1.646 3.972s2.472 1.647 3.974 1.647a5.58 5.58 0 0 0 3.972-1.645l9.547-9.548c.769-.768 1.147-1.767 1.058-2.817-.079-.968-.548-1.927-1.319-2.698-1.594-1.592-4.068-1.711-5.517-.262l-7.916 7.915c-.881.881-.792 2.25.214 3.261.959.958 2.423 1.053 3.263.215l5.511-5.512c.28-.28.267-.722.053-.936l-.244-.244c-.191-.191-.567-.349-.957.04l-5.506 5.506c-.18.18-.635.127-.976-.214-.098-.097-.576-.613-.213-.973l7.915-7.917c.818-.817 2.267-.699 3.23.262.5.501.802 1.1.849 1.685.051.573-.156 1.111-.589 1.543l-9.547 9.549a3.97 3.97 0 0 1-2.829 1.171 3.975 3.975 0 0 1-2.83-1.173 3.973 3.973 0 0 1-1.172-2.828c0-1.071.415-2.076 1.172-2.83l7.209-7.211c.157-.157.264-.579.028-.814L11.5 4.36a.572.572 0 0 0-.834.018l-7.205 7.207a5.577 5.577 0 0 0-1.645 3.971z"></path></svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="controls-fields">
                                    <div role="button" data-role="Send Invoice">
                                        <span>
                                            <a href="/room/invoice/create/{{$cur->id}}">
                                            <img src="/css/icons/invoice-icon.svg" class="img-invoice" alt="Send Invoice">
                                            </a>
                                        </span>
                                    </div>
                                </div>
                                <div class="controls-fields dropdown">
                                    <div role="button" data-role="Menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="#263238" fill-opacity=".6" d="M12 7a2 2 0 1 0-.001-4.001A2 2 0 0 0 12 7zm0 2a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 9zm0 6a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 15z"></path></svg>
                                        </span>
                                    </div>
                                    <ul class="dropdown-menu chat-options">
                                      <li><a href="#">Contact info</a></li>
                                      <!-- <li><a href="#">Select messages</a></li>
                                      <li><a href="#">Clear messages</a></li> -->
                                      <li><a href="/user/delete/chat/{{$cur->id}}">Delete chat</a></li>
                                    </ul>
                                </div>
                                
                                <!-- <div class="button-invoice">
                                    <a class="btn btn-primary" href="/room/invoice/create/{{$cur->id}}">Send Invoice</a>
                                </div> -->
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

                                        @elseif($message->type==='image')
                                    @if($message->from_msg===$user->id)
                                        <div class="right-message clearfix">
                                            <img src="{{$message->url}}" style="float: right;max-width: 90%;">
                                        </div>

                                    @else
                                        <div class="left-message clearfix">
                                            <img src="{{$message->url}}">
                                        </div>


                                    @endif

                                    @else

                            @if($message->from_msg===$user->id)

                            <div class="right-message clearfix"><span class="message" id="m{{$message->id}}"> {{$message->message}}&nbsp;&nbsp; <span class="message-time"> {{$message->timestamp()}}</span> </span></div>
                            @else
                                <div class="left-message clearfix"><span class="message" id="m{{$message->id}}">{{$message->message}}&nbsp;&nbsp;  <span class="message-time"> {{$message->timestamp()}}</span></span></div>
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
    <input type="file" id="upload-image-chat"  style="display: none">
    <div class="search-div">
        <div class="cross-mark-search">X</div>
        <input type="text" placeholder="Search this Conversation" class="form-control" id="search-query">
        <div id="search-results">

        </div>
    </div>
</div>
    <script>
        function handleBtnClick() {
            console.log("yahoo")
            $("#upload-image-chat").click();
        };
        $("#upload-image-chat").change(function () {
            console.log("did change");
            upload_image_chat();
        });
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
    function add_message(url) {
        axios.post('/user/add/message', {
            room:room,
            message:'image',
            type:'image',
            url:url
        })
            .then(function (response) {
                console.log(response);

            })
            .catch(function (error) {
                console.log(error);
            });
    }
function show_search() {
    $('.search-div').show();
}
$('.cross-mark-search').click(function () {
    $('.search-div').hide();
});
        $('#search-query').change(function () {
            var q = $('#search-query').val();
            axios.post('/user/message/search', {
                id:room,
                q:q
            })
                .then(function (response) {
                    console.log(response);
                    $('#search-results').html(response.data);

                })
                .catch(function (error) {
                    console.log(error);
                });
        });
        $('#search-results').on('click', '.message-search-list-item', function() {
            // do something
            var id = $(this).data('id');
            console.log($(this).data('id'));
            $('.search-div').hide();
            $('html, body').animate({
                scrollTop: $("#m"+id).offset().top
            }, 2000);
        });

    </script>

@endsection