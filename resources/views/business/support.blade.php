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
                    <a class="nav-link " href="/business/manage/ads"><span class="glyphicon glyphicon-folder-open"></span>Manage  ads</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="/business/manage/details"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;My Details</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " href="/business/manage/company">Company</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/business/manage/finance">Financials</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="/business/manage/metrics">Metrics</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Support</a>
                </li>
            </ul>


        </div>
    </div>


@endsection