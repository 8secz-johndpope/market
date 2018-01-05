@component('mail::message')# Join {{env('APP_NAME')}} now to earn £5. Please click the button below to register and use the code <span class="green-text">{{$code}}</span>
@component('mail::button', ['url' => $url])Register
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent