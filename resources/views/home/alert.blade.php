<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<div class="body background-color">
  <div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="notification-pages">
              <div class="notification-page selected">
                <form id="" action="" class="">
                </form>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection