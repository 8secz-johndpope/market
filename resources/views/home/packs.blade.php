<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">


            <div class="well">
                <table class="table">
                    <thead><th>Standard</th><th>Urgent</th><th>Spotlight</th><th>Featured(3 days)</th><th>Featured(7 days)</th><th>Featured(14 days)</th><th>Bump</th><th>Location</th><th>Category</th></thead>
                @foreach($prices as $price)

<tr>
    <td>{{$price->standard}}</td>
    <td>{{$price->urgent}}</td>
    <td>{{$price->spotlight}}</td>
    <td>{{$price->featured_3}}</td>
    <td>{{$price->featured}}</td>
    <td>{{$price->featured_14}}</td>
    <td>{{$price->bump}}</td>
    <td>{{$price->location->title}}</td>
    <td>{{$price->category->title}}</td>

</tr>
                @endforeach
                </table>
            </div>
        </div>


    </div>
@endsection