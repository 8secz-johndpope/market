<table class="table">
    <thead><th>Title</th><th>Quantity</th><th>Price</th></thead>
    @foreach($contract->packs as $pack)
        <tr><td>{{$pack->title}}</td><td>{{$contract->count}}</td><td>{{$pack->amount}}</td></tr>
        @endforeach
    <tr><td>Total</td><td>{{count($contract->packs)*$contract->count}}</td><td>{{$contract->packs->sum('amount')}}</td></tr>
</table>