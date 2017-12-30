<ul class="list-group">
    @foreach($messages as $message)
    <li class="list-group-item">{{$message->$message}}</li>
        @endforeach
</ul>