@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="/build/css/intlTelInput.css">
<link rel="stylesheet" href="/css/register.css">
<script src="/build/js/intlTelInput.js"></script>
<div class="body background-body">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>You must verify your address to continue</h3>
                    </div>
                    <div class="panel-body">
                        <p>The page you requested requires that you first verify your email address. Clicking the button below will send an email to the address associated with your account. It will contain a link that, when clicked, will verify your email address. You will only have to do this once.</p>
                        <button class="btn btn-submit">Send the verification email</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function onSubmit(token) {


        document.getElementById("register-form").submit();



    }
    $("#phone").intlTelInput();

</script>
@endsection
