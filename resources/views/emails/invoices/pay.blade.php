@component('mail::message')# Your payment is due
@component('mail::table')
    | Product       | Category         | Location  |
    | ------------- |:-------------:| --------:|
    @foreach($payment->contract->packs as $pack)
    | {{$pack->title}}     | {{$pack->category->title}}      | {{$pack->location->title}}      |
    @endforeach
    | Total      |  | £{{$payment->amount/100}}      |
@endcomponent
@component('mail::button', ['url' => $url])Pay Now
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent