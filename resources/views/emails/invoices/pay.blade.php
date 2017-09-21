@component('mail::message')# Your payment is due
@component('mail::table')
    | Laravel       | Table         | Example  |
    | ------------- |:-------------:| --------:|
    @foreach($payment->contract->packs as $pack)
    | {{$pack->title}}     | {{$pack->category->title}}      | {{$pack->location->title}}      |
    @endforeach
    | Col 3 is      | Right-Aligned | $20      |
@endcomponent
@component('mail::button', ['url' => $url])Pay Now
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent