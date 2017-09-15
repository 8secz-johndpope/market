<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.contract')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-2">
        
    </div>
    <div class="col-sm-8">
        <h4>Please read the contract carefully and sign below</h4>
        <embed src="https://sumra.net/css/contract.pdf" width="800" height="600" type='application/pdf'>
            <br>
            <input type="checkbox" name="agree">I agree to <a>Terms and Conditions</a>
       <br> Name: <input type="text" class="form-control" placeholder="Full Name">
            <a class="btn-primary btn">Submit</a>
    </div>
</div>
@endsection