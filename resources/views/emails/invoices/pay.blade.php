@component('mail::message')# Your payment is due
@component('mail::button', ['url' => $url])Pay Now
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent