<!-- Stored in resources/views/child.blade.php -->
@php
use App\Model\Advert;
@endphp
@extends('layouts.home')

@section('title', $category->title)

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('next-search')
    <div class="search-alert-div hidden-xs">
        <a class="btn search-alert" href="/user/create/alert/{{$category->id}}?id={{$location->id}}"><span class="glyphicon glyphicon-bell"></span>&nbsp;&nbsp;Set Search Alert </a>
    </div>
@endsection

@section('content')


    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">

            </div>
            <div class="col-sm-6">
                <ul class="list-group">
                    @foreach($category->children as $child)
                        <li class="list-group-item"><a href="/more/{{$child->id}}">{{$child->title}}</a></li>
                        @endforeach
                </ul>
            </div>
        </div>
</div>


@endsection

@section('scripts')
<script>
    
</script>
@endsection
