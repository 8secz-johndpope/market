<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.contract')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">


    <div class="form-group row">
        <label for="example-text-input" class="col-2 col-form-label">Company Name</label>
        <div class="col-10">
            <input class="form-control" type="text" placeholder="Example Ltd" id="example-text-input">
        </div>
    </div>
    <div class="form-group row">
        <label for="example-search-input" class="col-2 col-form-label">Address Line1</label>
        <div class="col-10">
            <input class="form-control" type="text" placeholder="35 Tinkle Street" id="example-search-input">
        </div>
    </div>
    <div class="form-group row">
        <label for="example-email-input" class="col-2 col-form-label">City</label>
        <div class="col-10">
            <input class="form-control" type="text" placeholder="London" id="example-email-input">
        </div>
    </div>
    <div class="form-group row">
        <label for="example-url-input" class="col-2 col-form-label">Postcode</label>
        <div class="col-10">
            <input class="form-control" type="text" placeholder="DH15AX" id="example-url-input">
        </div>
    </div>
    <div class="form-group row">
        <label for="example-tel-input" class="col-2 col-form-label">Telephone</label>
        <div class="col-10">
            <input class="form-control" type="tel" placeholder="0225343433" id="example-tel-input">
        </div>
    </div>
    <div class="form-group row">
        <label for="example-password-input" class="col-2 col-form-label">Company Registation No:(if applicable)</label>
        <div class="col-10">
            <input class="form-control" type="text" placeholder="01893293" id="example-password-input">
        </div>
    </div>

    <a  class="btn btn-primary go-to-packs">Continue</a>
        </div>
    </div>
@endsection