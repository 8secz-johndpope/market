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
                            <h4>Company Profile</h4>
                           <div class="row">
                               <div class="col-sm-3">
                                   <p class="bold-text">
                                      Company Name
                                   </p>
                                   <h4>{{$user->business->name}}</h4>

                               </div>
                               <div class="col-sm-3">
                                   <p class="bold-text">
                                      Current Account Status
                                   </p>
                                   <span class="active-strip">Active</span>
                               </div>
                               <div class="col-sm-3">

                               </div>
                               <div class="col-sm-3">

                               </div>
                           </div>
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
                                <tr><th>Date Posted</th><th>Ad ID</th><th>Ad Title</th><th>Product</th></tr>
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