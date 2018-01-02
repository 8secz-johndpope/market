<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.bank')

@section('title', 'Dashboard')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6">
            <br><br><br>
            <h4 style="text-align: center">Your Balance: £0</h4>
            <br><br><br>
            <div style="margin: auto;    width: 400px;">
                <a class="btn btn-primary">Send Money</a>
                <a class="btn btn-primary">Receive Money</a>
                <a class="btn btn-primary">Withdraw</a>

            </div>
            <br><br><br>
            <h4>Transactions</h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th scope="col">Description</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Handle</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><img src="/css/right.png" style="width: 30px"> </td>

                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <td><img src="/css/right.png" style="width: 30px"> </td>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <td><img src="/css/right.png" style="width: 30px"> </td>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


@endsection