<table class="table">
    <thead><th>Title</th><th>Category</th><th>Location</th><th>Quantity</th><th>Price</th></thead>
    @foreach($contract->packs as $pack)
        <tr><td>{{$pack->title}}</td><td>{{$pack->category->title}}</td><td>{{$pack->location->title}}</td><td>{{$contract->count}}</td><td>{{$pack->amount/100}}</td></tr>
        @endforeach
    <tr><td>Total</td><td>{{count($contract->packs)*$contract->count}}</td><td>{{$contract->packs->sum('amount')/100}}</td></tr>
</table>