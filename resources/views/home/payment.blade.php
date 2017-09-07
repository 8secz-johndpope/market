<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">

            <div class="row">
                <div class="col-sm-8">
                    <h4>Your Order</h4>
                    <table class="table">
                        @foreach($orders as $order)
                        <tr><td>{{$order['title']}}</td><td>{{$order['price']}}</td></tr>
                            @endforeach
                            <tr><td colspan="2">{{$total}}</td></tr>
                    </table>
                </div>
                <div class="col-sm-4">

                </div>
            </div>
        </div>
    </div>


@endsection