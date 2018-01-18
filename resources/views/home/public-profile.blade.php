<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Create your public profile')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<div class="body background-body">
    <section class="container-title-profile">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="wrapper-title-profile">
                        <h3>Create Your {{env('APP_NAME')}} Public Profile</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container-details-profile">
        <div class="container">
            <div class="row">
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">
        </div>
    </div>
</div>
@endsection