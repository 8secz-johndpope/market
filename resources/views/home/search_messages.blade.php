<ul class="list-group">
    @foreach($messages as $message)
    <li class="list-group-item message-search-list-item" style="padding: 10px;" data-id="{{$message->id}}"><span >{{$message->message}}</span></li>
        @endforeach
</ul>