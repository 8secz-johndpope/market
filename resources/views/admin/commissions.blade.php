<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title', 'Admin Dashboard')

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
            <h4>Transactions</h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Description</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($commissions as $commission)
                    <tr>
                        <td>{{$commission->description}}</td>
                        <td>£{{number_format($commission->amount/100,2)}}</td>
                        <td>{{date('d/m/Y',strtotime($commission->created_at))}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection