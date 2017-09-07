<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">

            <div class="row">
                <div class="col-sm-8">
                    <h4>Your Order</h4>
                    <table class="table">
                        @foreach($orders as $order)
                        <tr><td>{{$order['title']}}</td><td>{{$order['price']}}</td></tr>
                            @endforeach
                            <tr><td>Total:</td><td>{{$total}}</td></tr>
                    </table>
                </div>
                <div class="col-sm-4">
                    <div id="myContainerElement"></div>

                    <script>
                        // Render the button into the container element

                        paypal.Button.render({

                            // Pass the client ids to use to create your transaction on sandbox and production environments

                            client: {
                                sandbox:    'AUBOJK9kQGBJDHSQubGYiOzoGSa0Q-TIvp6catf9WmsQ4gbbInp7qhOkX92QZT_a1Bd0wKSQHov9nBCF', // from https://developer.paypal.com/developer/applications/
                                production: 'ASDM1ag3La0rWSQMAnbLVXmvHeF1y5ydr4I9xmWYNH635LHJl2xX27UwOzZiwonSm1TNFHx4QLiguFxc'  // from https://developer.paypal.com/developer/applications/
                            },

                            // Pass the payment details for your transaction
                            // See https://developer.paypal.com/docs/api/payments/#payment_create for the expected json parameters

                            payment: function(data, actions) {
                                return actions.payment.create({
                                    transactions: [
                                        {
                                            amount: {
                                                total:    '1.00',
                                                currency: 'USD'
                                            }
                                        }
                                    ]
                                });
                            },

                            // Display a "Pay Now" button rather than a "Continue" button

                            commit: true,

                            // Pass a function to be called when the customer completes the payment

                            onAuthorize: function(data, actions) {
                                return actions.payment.execute().then(function(response) {
                                    console.log('The payment was completed!');
                                });
                            },

                            // Pass a function to be called when the customer cancels the payment

                            onCancel: function(data) {
                                console.log('The payment was cancelled!');
                            }

                        }, '#myContainerElement');
                    </script>
                </div>
            </div>
        </div>
    </div>


@endsection