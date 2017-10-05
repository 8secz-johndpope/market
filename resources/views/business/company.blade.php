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
                            <h3>Menu 1</h3>
                            <p>Some content in menu 1.</p>
                        </div>
                        <div id="package_usage" class="tab-pane fade">
                            <h3>Menu 2</h3>
                            <p>Some content in menu 2.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection