<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.bank')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6">
            <br><br><br>
            <form method="post" action="/bank/send/money">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Amount</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" name="amount" placeholder="95 (£50 minimum)">
                    </div>
                </div>
                {{ csrf_field() }}
                <ul class="list-group">

                    <li class="list-group-item">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="hidden" name="id" value="{{$other->id}}">
                                <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$other->image}}" class="lazyload" alt="" style="width: 100px">
                                {{$other->display_name}}
                            </label>
                        </div>
                    </li>
                </ul>
                <div class="row">
                    <div class="col">
                        <input type="submit" class="btn btn-primary" value="Send">
                    </div>
                    <div class="col">
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection