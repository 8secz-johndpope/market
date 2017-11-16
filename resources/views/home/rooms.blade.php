@foreach($user->rooms as $room)
    <div class="media @if($room->id===$cur->id) selected-room @endif">
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
            <a href="/user/manage/messages/{{$room->id}}"><h4 class="media-heading">{{$room->title}}</h4></a>
            <p class="@if($room->unread===1) unread-message @endif">{{$room->last_message()->message}}</p>
            <strong>{{$room->last_message()->user->name}}</strong>
        </div>
    </div>
@endforeach