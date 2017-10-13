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
                    <a class="nav-link nav-color" href="/business/manage/ads"><span class="glyphicon glyphicon-folder-open"></span>&nbsp Manage  ads</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link nav-color" href="/business/manage/details"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;My Details</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link nav-color" href="#">Company</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/finance">Financials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/metrics">Metrics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-color" href="/business/manage/support">Support</a>
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
                            <div class="well">
                            <h4>Company Profile</h4>
                           <div class="row">
                               <div class="col-sm-3">
                                   <p class="bold-text">
                                      Company Name
                                   </p>
                                   <h4>{{$user->business->name}}</h4>
                                   <p class="bold-text">
                                       Account Number
                                   </p>
                                   <h4>{{$user->business->id}}</h4>
                                   <p class="bold-text">
                                       Oustanding Balance
                                   </p>
                                   <h4>£{{$user->contract->monthly_payment()}}</h4>
                                   <a href="/business/manage/finance">Pay Now</a>


                               </div>
                               <div class="col-sm-3">
                                   <p class="bold-text">
                                      Current Account Status
                                   </p>
                                   <span class="active-strip">Active</span>
                                   <p class="bold-text">
                                       Current Package Status
                                   </p>
                                   <span class="active-strip">Live</span>
                                   <p class="bold-text">
                                      Posting us with since
                                   </p>
                                   <p>{{date('Y',strtotime($user->created_at))}}</p>
                               </div>
                               <div class="col-sm-3">
                                   <p class="bold-text">
                                       Company Address
                                   </p>
                                   <p>{{$user->business->address->line1}}</p>
                                   <p>{{$user->business->address->city}}</p>
                                   <p>{{$user->business->address->postcode}}</p>
                                   <p class="bold-text">
                                       Company Registration Number
                                   </p>
                                   <p>{{$user->business->company}}</p>
                                   <p class="bold-text">
                                       Company VAT Number
                                   </p>
                                   <p>{{$user->business->vat}}</p>
                               </div>
                               <div class="col-sm-3">

                               </div>
                           </div>
                                <div class="well">
                                    <div class="row">
                                        <div class="col-sm-4">

                                        </div>
                                        <div class="col-sm-8">
                                            <div class="row">
                                        <div class="col-sm-6">
                                            <h4>Your primary contact</h4>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="profile-picture">
                                                        <img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{$user->image}}">
                                                    </div>

                                                </div>
                                                <div class="col-sm-8">
                                                    <p>{{$user->name}}</p>
                                                    <p>{{$user->phone}}</p>
                                                    <p><a href="mailto:{{$user->email}}">{{$user->email}}</a> </p>
                                                    <span class="active-strip">Active</span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h4>Your finance contact</h4>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="profile-picture">
                                                        <img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{$user->image}}">
                                                    </div>

                                                </div>
                                                <div class="col-sm-8">
                                                    <p>{{$user->name}}</p>
                                                    <p>{{$user->phone}}</p>
                                                    <p><a href="mailto:{{$user->email}}">{{$user->email}}</a> </p>
                                                    <span class="active-strip">Active</span>

                                                </div>
                                            </div>
                                        </div>
                                            </div>
                                            <h4>All company contacts</h4>
                                            <table class="table">
                                                <tr><th>Name</th><th>Email</th><th>Type</th><th></th></tr>
                                                <tr><td>{{$user->name}}</td><td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td><td>Account/Finance</td><td><span class="glyphicon glyphicon-info-sign"></span> </td></tr>
                                            </table>
                                            <a class="btn btn-default">New Contact</a>
                                        </div>
                                    </div>


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