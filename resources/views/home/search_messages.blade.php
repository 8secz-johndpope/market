<ul class="list-group">
    @foreach($messages as $message)
    <li class="list-group-item"><span style="padding: 4px;">{{$message->message}}</span></li>
        @endforeach
</ul>