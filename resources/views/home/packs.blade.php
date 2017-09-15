<table class="table">
    <thead><th>Title</th><th>Quantity</th><th>Price</th></thead>
    @foreach($contract->packs as $pack)
        <tr><td>{{$pack->title}}</td><td>{{$contract->count}}</td><td>{{$pack->amount}}</td></tr>
        @endforeach
</table>