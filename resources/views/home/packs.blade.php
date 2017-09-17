    <div class="col-sm-12" >
<table class="table">
    <thead><th>Title</th><th>Category</th><th>Location</th><th>Quantity</th><th>Price</th><th>Delete</th></thead>
    @foreach($contract->packs as $pack)
        <tr><td>{{$pack->title}}</td><td>{{$pack->category->title}}</td><td>{{$pack->location->title}}</td><td>{{$contract->count}}</td><td>£{{$pack->amount/100}}</td><td><a class="delete-pack btn btn-danger" data-id="{{$pack->id}}">Delete</a> </td></tr>
        @endforeach
    <tr><td><span class="bold-text">Total</span></td><td></td><td></td><td><span class="bold-text">{{count($contract->packs)*$contract->count}}</span></td><td><span class="bold-text"> £{{$contract->packs->sum('amount')/100}}</span></td></tr>
</table>
    </div>
    <div class="col-sm-11">

    </div>
    <div class="col-sm-1">
        <a class="btn btn-primary" href="/user/contract/sign">Continue</a>
    </div>
