@foreach($user->rooms as $room)
    <div class="media @if($room->id===$cur->id) selected-room @endif">
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
                        <div class="title-user">{{$room->other()->display_name}}</div>
                        <div class="media-heading">{{$room->title}}</div> 
                    </a>
                </div>
                <div class="chat-meta">
                    <span class="message-time"> {{$room->last_message()->timestamp()}}</span>
                </div>
            </div>
            <div class="chat-secondary">
                <div class="chat-status"> 
                    <p class="@if($room->unread===1) unread-message @endif">{{$room->last_message()->message}}</p>
                </div>
                <div class="chat-meta">
                    
                </div>
            </div>
        </div>
    </div>
@endforeach