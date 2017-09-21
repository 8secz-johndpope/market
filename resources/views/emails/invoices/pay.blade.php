@component('mail::message')# Your payment is due
@component('mail::table')
    | Laravel       | Table         | Example  |
    | ------------- |:-------------:| --------:|
    | Col 2 is      | Centered      | $10      |
    | Col 3 is      | Right-Aligned | $20      |
@endcomponent
@component('mail::button', ['url' => $url])Pay Now
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent