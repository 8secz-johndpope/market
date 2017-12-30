<ul class="list-group">
    @foreach($messages as $message)
    <li class="list-group-item" style="padding: 10px;"><span >{{$message->message}}</span></li>
        @endforeach
</ul>