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
                <li class="nav-item active">
                    <a class="nav-link" href="#">Metrics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/business/manage/support">Support</a>
                </li>
            </ul>


        </div>
    </div>
    <div id="container" style="width: 75%;">
        <canvas id="canvas"></canvas>
    </div>
    <script src="/js/Chart.bundle.js"></script>
    <script src="/js/utils.js"></script>

    <script>
        var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var color = Chart.helpers.color;
        var barChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                label: 'live Adverts',
                backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                borderColor: window.chartColors.blue,
                borderWidth: 1,
                data: [
                   1,
                    10,
                    23,
                   5,
                    15,
                   19,
                    3
                ]
            }]

        };

        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Adverts this year'
                    }
                }
            });

        };



    </script>

@endsection