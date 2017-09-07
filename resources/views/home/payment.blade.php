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
                        <tr><td>{{$order['title']}}</td><td>£{{$order['price']}}</td></tr>
                            @endforeach
                            <tr><td>Total:</td><td>£{{$total}}</td></tr>
                    </table>
                </div>
                <div class="col-sm-4">
                    <h4>Pay by Card</h4>
                    <form action="/charge" method="post" id="payment-form">
                        <div class="form-row">
                            <label for="card-element">
                                Credit or debit card
                            </label>
                            <div id="card-element">
                                <!-- a Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display Element errors -->
                            <div id="card-errors" role="alert"></div>
                        </div>

                        <button>Submit Payment</button>
                    </form>
                    <p>Or</p>

                    <div id="myContainerElement"></div>

                    <script>
                        var stripe = Stripe('pk_test_pSP0FdEAje47JIrZx4H8ActS');
                        var elements = stripe.elements();
                        // Render the button into the container element
                        // Custom styling can be passed to options when creating an Element.
                        var style = {
                            base: {
                                // Add your base input styles here. For example:
                                fontSize: '16px',
                                lineHeight: '24px'
                            }
                        };

                        // Create an instance of the card Element
                        var card = elements.create('card', {style: style});

                        // Add an instance of the card Element into the `card-element` <div>
                        card.mount('#card-element');
                        card.addEventListener('change', function(event) {
                            var displayError = document.getElementById('card-errors');
                            if (event.error) {
                                displayError.textContent = event.error.message;
                            } else {
                                displayError.textContent = '';
                            }
                        });
                        // Create a token or display an error when the form is submitted.
                        var form = document.getElementById('payment-form');
                        form.addEventListener('submit', function(event) {
                            event.preventDefault();

                            stripe.createToken(card).then(function(result) {
                                if (result.error) {
                                    // Inform the user if there was an error
                                    var errorElement = document.getElementById('card-errors');
                                    errorElement.textContent = result.error.message;
                                } else {
                                    // Send the token to your server
                                    stripeTokenHandler(result.token);
                                }
                            });
                        });
                        function stripeTokenHandler(token) {
                            // Insert the token ID into the form so it gets submitted to the server
                            var form = document.getElementById('payment-form');
                            var hiddenInput = document.createElement('input');
                            hiddenInput.setAttribute('type', 'hidden');
                            hiddenInput.setAttribute('name', 'stripeToken');
                            hiddenInput.setAttribute('value', token.id);
                            form.appendChild(hiddenInput);

                            // Submit the form
                            form.submit();
                        }

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
                                                total:    '{{$total}}',
                                                currency: 'GBP'
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