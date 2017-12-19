<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@section('styles')
<link href="{{ asset('/css/create-invoice.css?q=874') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="background-body">
<div class="container">
    <div class="row">
        <form action="/room/invoice/save" method="post" id="change-category">
            <div class="col-sm-9">
                <div class="container-invoice">
                <input name="id" type="hidden" value="{{$room->id}}">
                {{ csrf_field() }}
                <div class="form-group row">
                    <div class="col-sm-offset-6 col-sm-6 text-right">
                        <span class="text-invoice">INVOICE</span>
                    </div>
                </div>
                <div class="form-group row info-form">
                    <div class="col-sm-6">
                        <label for="staticEmail" class="">Title</label>
                        <input type="text" name="title" class="form-control" id="staticEmail" value="{{$room->title}}">
                    </div>
                    <div class="col-sm-6">
                        <label for="date-payment">Payment</label>
                        <input type="text" name="date-payment" class="form-control" id="date-payment" placeholder="Due Upon Receipt">
                    </div>
                    <div class="col-sm-offset-6 col-sm-6 group-date-ship ship-container">
                        <label for="date-shipping">Shipping Date</label>
                        <input type="text" name="date-shipping" class="form-control" id="date-shipping" placeholder="Next day">
                    </div>
                </div>
                <div id="items">
                    <div class="form-group row">
                        <div class="table-container">
                            <div class="col-sm-12">
                                <table class="w100p tinput-invoice" id="table-items">
                                    <thead>
                                        <tr>
                                            <th class="cell-item">Item</th>
                                            <th class="text-right">Quantity</th>
                                            <th class="text-right">Price</th>
                                            <th class="text-right">Amount</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" class="form-control" placeholder="Item" name="items[]"></td>
                                            <td><input type="number" class="form-control quantities" placeholder="1" name="quantities[]"></td>
                                            <td><input type="number" class="form-control prices" placeholder="500" name="prices[]"></td>
                                            <td class="cell-amount">£ <span class="amount">0</span></td>
                                            <td>
                                                <a class="delete-item"><span class="glyphicon glyphicon-trash"></span></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="container-badd-item">
                                <a class="add-more-items">+ Add Item</a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group row">

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword" placeholder="Deposit" name="items[]">
                        </div>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputPassword" placeholder="500" name="prices[]">
                        </div>
                        <div class="col-sm-1">
                            <a class="btn btn-danger delete-item">Delete Item</a>
                        </div>
                    </div>
                <div class="form-group row">
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputPassword" placeholder="Admin Fee" name="items[]">
                    </div>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" id="inputPassword" placeholder="100" name="prices[]">
                    </div>
                    <div class="col-sm-1">
                        <a class="btn btn-danger delete-item">Delete Item</a>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputPassword" placeholder="Credit Check Fee" name="items[]">
                    </div>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" id="inputPassword" placeholder="35" name="prices[]">
                    </div>
                    <div class="col-sm-1">
                        <a class="btn btn-danger delete-item">Delete Item</a>
                    </div>
                </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-8">
                    </div>
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-1">
                        <a class="btn btn-default add-more-items">Add Item</a>
                    </div>
                </div>-->
                <hr>
                <div class="form-group row">
                    <div class="col-sm-offset-6 col-sm-3 text-right">
                        <label for="notes">Subtotal</label>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <span class="input-group-addon">£</span>
                            <input type="text" name="subtotal" id="subtotal" disabled="true" value="0" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group row" id="vat-container">
                    <div class="col-sm-offset-6 col-sm-3 text-right" >
                        <label for="notes">VAT</label>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <span class="input-group-addon">%</span>
                            <select class="form-control" id="por-vat">
                                <option value="0" checked>0</option>
                                <option value="0.05">5</option>
                                <option value="0.1">10</option>
                                <option value="0.2">20</option>
                                <!--<input type="text" name="por-vat" class="form-control">-->
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row ship-container" id="ship-container">
                    <div class="col-sm-offset-6 col-sm-3 text-right">
                        <label for="terms">Shipping</label>
                    </div>
                    <div class="col-sm-3" >
                        <div class="input-group">
                            <span class="input-group-addon">£</span>
                            <input type="text" name="shipping" class="form-control">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-sm-offset-6 col-sm-3 text-right">
                        <label for="notes">Total</label>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <span class="input-group-addon">£</span>
                            <input type="text" name="amount-total" id="amount-total" disabled="true" value="0" class="form-control">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="notes">Notes</label>
                        <textarea rows="5" name="notes" id="notes" placeholder="Notes - Any relevant information" class="w100p"></textarea>
                    </div>
                    <div class="col-sm-6">
                        <label for="terms">Terms</label>
                        <textarea rows="5" name="terms" id="terms" placeholder="Terms and conditions" class="w100p"></textarea>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
        <div class="col-md-3">
            <div class="col-options-send">
                <div class="row">
                    <div class="col-sm-12">
                    <input type="submit" value="Send Invoice" class="btn btn-primary send-invoice">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="vat-check">
                            <span>Add VAT information</span>
                            <label class="switch">
                              <input type="checkbox" id="add_vat_info" name="add_vat_info" value="1">
                              <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="ship-check">
                            <span>Add Shipping information</span>
                            <label class="switch">
                              <input type="checkbox" id="add_ship_info" name="add_ship_info" value="1">
                              <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        </div>
    </div>
</div>
</di>
    <script>
        $('#items').on('click','.delete-item',function () {
            $(this).parent().parent().remove();
        });
        /*$('.add-more-items').click(function () {
            $('#items').append('<div class="form-group row">\n' +
                '                    <div class="col-sm-8">\n' +
                '                        <input type="text" class="form-control" id="inputPassword" placeholder="One More Item" name="items[]">\n' +
                '                    </div>\n' +
                '                    <div class="col-sm-3">\n' +
                '                        <input type="number" class="form-control" id="inputPassword" placeholder="100" name="prices[]">\n' +
                '                    </div>\n' +
                '                    <div class="col-sm-1">\n' +
                '                        <a class="btn btn-danger delete-item">Delete Item</a>\n' +
                '                    </div>\n' +
                '                </div>');
        });*/
        $('.add-more-items').click(function () {
            $('#table-items tbody').append(
                '<tr>' +
                    '<td><input type="text" class="form-control" placeholder="Deposit" name="items[]"></td>' +
                    '<td><input type="number" class="form-control" placeholder="0" name="quantities[]"></td>' +
                    '<td><input type="number" class="form-control" placeholder="500" name="prices[]"></td>' +
                    '<td class="cell-amount">£ <span class="amount">0</span></td>'+
                    '<td><a class="delete-item"><span class="glyphicon glyphicon-trash"></span></a></td>'+
                '</tr>');
        });
        $('#add_ship_info').change(function(){
            if(this.checked){
                $('.ship-container').show();
            }
            else{
                $('.ship-container').hide();
            }
        });
        $('#add_vat_info').change(function(){
            if(this.checked){
                $('#vat-container').show();
            }
            else{
                $('#vat-container').hide();
            }
        });
        $('#por-vat').change(function(){
            var total = totalWithVat();
            $('#amount-total').val(total);
        });
        $('.quantities').focusout(function(){
            var price = parseFloat($(this).parent().next().find('.prices').val());
            console.log(price);
            var quantity = parseFloat($(this).val());
            if(!isNaN(price) && !isNaN(quantity)){
                price = price * quantity;
                $(this).parent().parent().find('.amount').text(price);
                $('#subtotal').val(price);
                price = totalWithVat();
                $('#amount-total').val(price);
            }
        });
        $('.prices').focusout(function(){
            //var quantity = parseFloat($(this).parent().prev().find('.quantities').val());
            //var price = parseFloat($(this).val());
            //if(!isNaN(quantity) && !isNaN(price)){
            var price = 0.0;
            $('.prices').each(function(){
                price += getItemPrice(this);
            })
            //var price = getItemPrice(this);
            console.log('price: ' + price);
            if(price > 0){
                $(this).parent().next().find('.amount').text(price);
                $('#subtotal').val(price);
                price = totalWithVat();
                console.log(price);
                $('#amount-total').val(price);
            }
        });
        function getItemPrice(element){
            var quantity = parseFloat($(element).parent().parent().find('.quantities').val());
            var price = parseFloat($(element).parent().parent().find('.prices').val());
            if(!isNaN(quantity) && !isNaN(price)){
                return price * quantity;
            }
            return 0;

        }
        function totalWithVat(){
            var porVat = parseFloat($('#por-vat').val());
            var subtotal = parseFloat($('#subtotal').val());
            var total = subtotal + (subtotal*porVat);
            return total;
        }
    </script>
@endsection