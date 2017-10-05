<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">

            <ul class="nav nav-tabs">

                <li class="nav-item">
                    <a class="nav-link " href="/business/manage/ads">Manage  ads</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="/business/manage/details">My Details</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " href="#">Company</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/business/manage/finance">Financials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/business/manage/metrics">Metrics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/business/manage/support">Support</a>
                </li>
            </ul>

            <div class="row">
                <div class="cols-sm-12">
                    <ul class="nav nav-tabs">

                        <li class="nav-item active">
                            <a class="nav-link " data-toggle="tab" href="#overview">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#package_summary">Package Summary</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#package_usage">Package Usage</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div id="overview" class="tab-pane fade in active">
                            <h3>HOME</h3>
                            <p>Some content.</p>
                        </div>
                        <div id="package_summary" class="tab-pane fade">
                            <table class="table">
                                <tr><th>Product</th><th>Total</th><th>Used</th><th>Remaining</th></tr>
                           @foreach($user->packs as $pack)
                               <tr><td>{{$pack->type()->stitle}} in {{$pack->category->title}},{{$pack->location->title}}</td><td>{{$pack->total}}</td><td>{{$pack->total-$pack->remaining}}</td><td><span class="red-text">{{$pack->remaining}}</span> </td></tr>
                               @endforeach
                            </table>
                        </div>
                        <div id="package_usage" class="tab-pane fade">
                            <table class="table">
                                <th><td>Date Posted</td><td>Ad ID</td><td>Ad Title</td><td>Product</td></th>
                                @foreach($user->bumps() as $bump)
                                    <tr><td>{{date('d/m/y',strtotime($bump->advert->created_at))}}</td><td>{{$bump->advert->id}}</td><td>{{$bump->advert->param('title')}}</td><td>{{$bump->type->stitle}} in {{$bump->category->title}},{{$bump->location->title}}</td>
                                    </tr>@endforeach
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection