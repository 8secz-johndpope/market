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
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Send Money</th>
        </tr>
        </thead>
        <tbody>
        @foreach($user->contacts as $contact)
            @if($contact->is_user())
            <tr><td>                                <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$contact->u()->image}}" class="lazyload" alt="" style="width: 50px"></td><td>{{$contact->first}}, {{$contact->last}}</td><td><a class="btn btn-primary" href="/bank/transfer/{{$contact->uid()}}">Send Money</a> </td></tr>
            @endif
        @endforeach
        </tbody>
    </table>
        </div>
    </div>

@endsection