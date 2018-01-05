@component('mail::message')# Join {{env('APP_NAME')}} now to get £5. Simply Download Sumra Marketplace App. Please click the button below to register and use the code <span class="green-text">{{$code}}</span>
@component('mail::button', ['url' => $url])Register
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent