<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Discard All Applications Request')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@php
    $date = new Datetime();
    $dateMs = $date->getTimestamp();
@endphp
@section('styles')
<link href="{{ asset("/css/bulk-discard.css?q=$dateMs") }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="body background-body">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3>Discard All Applications Request</h3>
                <form action="/user/jobs/discard/all" method="post" id="form-bulk-discard">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="validation">
                            <span>Please select at least one application</span>
                        </div>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($adverts as $advert)
                            <tr>
                                <td>
                                    <a href="{{$advert->url()}}"> {{$advert->param('title')}}</a>
                                    <input required="Please select at least one appplication" class="select-application" type="hidden" name="ids[]" value="{{$advert->id}}">
                                </td>
                                <td>
                                    <button class="btn btn-danger" onclick="$(this).parent().parent().remove();">Delete</button> 
                                </td>
                            </tr>
                            @endforeach                                
                        </tbody>
                    </table>
                    <div class="form-group">
                         <button type="submit" class="btn btn-primary">Discard All</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $('#form-bulk-discard').submit(function(e){
        var length = $('input:checked').length;
        if(length == 0){
            e.preventDefault();
            $('.form-group').addClass('input-validation-error');
        }
    })  
</script>

@endsection