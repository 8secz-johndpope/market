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
            <h4>Bulk Apply</h4>
            <form action="/user/jobs/apply/all" method="post">
                {{ csrf_field() }}

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Title</th>

                </tr>
                </thead>
                <tbody>
                @foreach($adverts as $advert)
                    <tr>
                        <td><a href="{{$advert->url()}}"> {{$advert->param('title')}}</a>
                            <input required="Please select at least one appplication" class="select-application" type="checkbox" name="ids[]" value="{{$advert->id}}">

                        </td>

                    </tr>
                @endforeach
                <tr>
                    <td>                                <button type="submit" class="btn btn-primary">Apply All</button>
                    </td>

                </tr>
                </tbody>
            </table>
            </form>
        </div>
        <div class="col-sm-2">

        </div>

    </div>

@endsection