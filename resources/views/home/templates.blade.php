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
            <a class="btn btn-default" href="/user/manage/applications">Back</a>
            <br><br>
            <a class="btn btn-primary" href="/user/templates/add">Add Template</a>
            <br><br>
            <h4>Templates</h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Message</th>
                    <th scope="col">Delete</th>

                </tr>
                </thead>
                <tbody>
                @foreach($user->templates as $template)
                    <tr>
                        <td>{{$template->title}}</td>
                        <td>{{$template->message}}</td>
                            <td><a href="/user/delete/template/{{$template->id}}" class="btn btn-danger">Delete</a> </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-sm-2">

        </div>

    </div>

@endsection