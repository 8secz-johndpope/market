<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.next')

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
            <br>
            <br><br>
            <h4>My Applications</h4>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Title</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->applications as $application)
                        <tr>
                            <td><a href="{{$application->advert->url()}}"> {{$application->advert->param('title')}}</a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
        <div class="col-sm-2">

        </div>

    </div>

@endsection