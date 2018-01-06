<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">

        <div class="col-sm-4">
            <br><br><br>
            <h4 style="text-align: center">Total Payments from Contract Invoices: £{{number_format($dtotal/100,2)}}</h4>
            <br><br><br>
            <h4>Payments from Contract Invoices</h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Description</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dtransactions as $transaction)
                    <tr>
                        <td>{{$transaction->description}}</td>
                        <td>£{{number_format($transaction->amount/100,2)}}</td>
                        <td>{{date('d/m/Y',strtotime($transaction->created_at))}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-sm-4">
            <br><br><br>
            <h4 style="text-align: center">Total Payments from Enhancements: £{{number_format($etotal/100,2)}}</h4>
            <br><br><br>
            <h4>Payments from Enhancements</h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Description</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($etransactions as $transaction)
                    <tr>
                        <td>{{$transaction->description}}</td>
                        <td>£{{number_format($transaction->amount/100,2)}}</td>
                        <td>{{date('d/m/Y',strtotime($transaction->created_at))}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-sm-4">
            <br><br><br>
            <h4 style="text-align: center">Total Commissions from Sales: £{{number_format($stotal/100,2)}}</h4>
            <br><br><br>
            <h4>Commissions from Sales</h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Description</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($stransactions as $transaction)
                    <tr>
                        <td>{{$transaction->description}}</td>
                        <td>£{{number_format($transaction->amount/100,2)}}</td>
                        <td>{{date('d/m/Y',strtotime($transaction->created_at))}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-sm-4">
            <br><br><br>
            <h4 style="text-align: center">Total Commissions from Invoices: £{{number_format($itotal/100,2)}}</h4>
            <br><br><br>
            <h4>Commissions from Invoices</h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Description</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($itransactions as $transaction)
                    <tr>
                        <td>{{$transaction->description}}</td>
                        <td>£{{number_format($transaction->amount/100,2)}}</td>
                        <td>{{date('d/m/Y',strtotime($transaction->created_at))}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-sm-4">
            <br><br><br>
            <h4 style="text-align: center">Total Commissions from Transfers: £{{number_format($ttotal/100,2)}}</h4>
            <br><br><br>
            <h4>Commissions from Sales</h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Description</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ttransactions as $transaction)
                    <tr>
                        <td>{{$transaction->description}}</td>
                        <td>£{{number_format($transaction->amount/100,2)}}</td>
                        <td>{{date('d/m/Y',strtotime($transaction->created_at))}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-sm-4">
            <br><br><br>
            <h4 style="text-align: center">Total Commissions from Withdrawals: £{{number_format($wtotal/100,2)}}</h4>
            <br><br><br>
            <h4>Commissions from Withdrawals</h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Description</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($wtransactions as $transaction)
                    <tr>
                        <td>{{$transaction->description}}</td>
                        <td>£{{number_format($transaction->amount/100,2)}}</td>
                        <td>{{date('d/m/Y',strtotime($transaction->created_at))}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
            <div class="col-sm-4">

            <br><br><br>
            <h4 style="text-align: center">Total Promotions: £{{number_format($ptotal/100,2)}}</h4>
            <br><br><br>
            <h4>Promotions</h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Description</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ptransactions as $promotion)
                    <tr>
                        <td>{{$promotion->description}}</td>
                        <td>£{{number_format($promotion->amount/100,2)}}</td>
                        <td>{{date('d/m/Y',strtotime($promotion->created_at))}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection