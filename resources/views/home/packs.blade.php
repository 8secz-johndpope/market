    <div class="col-sm-12" >
<table class="table">
    <thead><th>Title</th><th>Category</th><th>Location</th><th>Quantity</th><th>Price</th><th>Delete</th></thead>
    @foreach($contract->packs as $pack)
        <tr><td>{{$pack->title}}</td><td>{{$pack->category->title}}</td><td>{{$pack->location->title}}</td><td>{{$contract->count}}</td><td>£{{$pack->amount/100}}</td><td><a class="delete-pack btn btn-danger" data-id="{{$pack->id}}">Delete</a> </td></tr>
        @endforeach
    <tr><td><span class="bold-text">Subtotal</span></td><td></td><td></td><td><span class="bold-text">{{count($contract->packs)*$contract->count}}</span></td><td><span class="bold-text"> £{{$contract->total_before_discount()}}</span></td></tr>
    <tr><td><span class="bold-text">Discount</span></td><td></td><td></td><td></td><td><span class="bold-text"> £{{$contract->total_discount()}}</span></td></tr>
    <tr><td><span class="bold-text">Subtotal after Discount</span></td><td></td><td></td><td></td><td><span class="bold-text"> £{{$contract->total_after_discount()}}</span></td></tr>
    <tr><td><span class="bold-text">VAT @ 20%</span></td><td></td><td></td><td></td><td><span class="bold-text"> £{{$contract->total_vat()}}</span></td></tr>
    <tr><td><span class="bold-text">Total</span></td><td></td><td></td><td></td><td><span class="bold-text"> £{{$contract->total_after_vat()}}</span></td></tr>

</table>
    </div>
    <div class="col-sm-6">

    </div>
    <div class="col-sm-6">
        <a class="btn btn-primary" href="/user/contract/sign" @if($contract->total_after_vat()<$contract->minimum_payment()) disabled @endif>Continue</a>
        <h4>Minimum Contract Amount £{{$contract->minimum_payment()}}</h4>
        <h4>Choose packs below to reach the above minimum contract amount for you to continue.</h4>
    </div>
