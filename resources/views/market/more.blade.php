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


@section('content')


    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">

            </div>
            <div class="col-sm-6">
                <ul class="list-group">
                    <li class="list-group-item"><a href="/{{$category->slug}}">All in {{$category->title}}</a> </li>
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
