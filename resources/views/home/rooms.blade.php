@foreach($user->rooms as $room)
    <div class="media @if($room->id===$cur->id) selected-room @endif">
        <div class="media-left">
            <a href="#">
                <div class="listing-side">
                    <div class="listing-thumbnail">
                        <img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{$room->image}}" class="lazyload" alt="">
                    </div>
                </div>
            </a>
        </div>
        <div class="media-body">
            <a href="/user/manage/messages/{{$room->id}}"><h4 class="media-heading">{{$room->title}}</h4></a>
            <p>{{$room->last_message()->message}}</p>
            <strong>{{$room->last_message()->user->name}}</strong>
        </div>
    </div>
@endforeach