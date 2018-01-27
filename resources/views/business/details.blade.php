<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row all-divs">
        <div class="col-sm-12">
            <div class="row" style="margin-bottom: 30px">
                <div class="col-md-6 col-md-offset-3">
                    <h2 class="bold-text">{{$user->name}}</h2>
                    <div class="row">
                        <div class="col-sm-4">
                        <div class="gray-color">
                          <strong>Login email:</strong>
                        </div>
                            <div class="detail-text">
                                {{$user->email}}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="gray-color">
                                <strong>Password:</strong>
                            </div>
                            <div class="detail-text">
                                <p>*************</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                        <a><span class="glyphicon glyphicon-edit"></span>Edit </a>
                        </div>
                    </div>
                    <h2 class="bold-text">Contact Details</h2>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="gray-color">
                                <strong>Contact number:</strong>
                            </div>
                            <div class="detail-text">
                                {{$user->phone}} @if($user->phone_verified!==1) <a class="verify-phone-link">Verify Phone</a> @else <span class="glyphicon glyphicon-ok-sign" style="color: green"></span> @endif
                            </div>
                            <div class="gray-color">
                                <strong>Display name:</strong>
                            </div>
                            <div class="detail-text">
                                {{$user->display_name}}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="gray-color">
                                <strong>Primary Email:</strong>
                            </div>
                            <div class="detail-text">
                                {{$user->email}}@if($user->email_verified!==1)  <a href="/user/email/resend">Resend Verificaton Email</a> @else <span class="glyphicon glyphicon-ok-sign" style="color: green"></span> @endif
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <a><span class="glyphicon glyphicon-edit"></span>Edit </a>
                        </div>
                    </div>
                    <div class="user-addresses">
                        <h4 class="bold-text">Addresses</h4>
                        @if($user->default_address>0)
                            <div class="address-div">
                                <p>{{$user->address->line1}}</p>
                                <p>{{$user->address->city}}</p>
                                <p>{{$user->address->postcode}}</p>
                                 <span class="bold-text green-text">Primary</span>
                            </div>
                            @endif
                        @foreach($user->addresses as $address)
                            @if($user->default_address!==$address->id)
                            <div class="address-div">
                                <p>{{$address->line1}}</p>
                                <p>{{$address->city}}</p>
                                <p>{{$address->postcode}}</p>
                               @if($user->address->id===$address->id)  <span class="bold-text green-text">Primary</span> @else <a href="/user/primary/address/{{$address->id}}">Make Primary</a><a href="/user/delete/address/{{$address->id}}"> <span class="red-text">Delete</span></a>@endif
                            </div>
                            @endif

                        @endforeach
                        <br>
                        <a class="btn btn-primary add-address-link" >Add New Address</a>

                    </div>
                    <div class="user-cvs">
                        <h4 class="bold-text">Stored CVs</h4>

                        @foreach($user->cvs as $cv)
                                <div class="address-div">
                                    <p class="bold-text">{{$cv->title}}</p>
                                    @if($cv->category)
                                        <p>{{$cv->category->title}}</p>
                                    @endif
                                    <a target="_blank" href="{{env('AWS_CV_IMAGE_URL')}}/{{$cv->file_name}}">View/Download</a>
                                    <a  href="/user/delete/cv/{{$cv->id}}"><span class="red-text">Delete</span> </a>
                                </div>

                        @endforeach
                        <br>
                        <div class="well">
                        <div class="form-group">
                            <label for="title">Title</label> <span class="red-text" id="no-title" style="display: none">Please add a title to your CV</span>
                            <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="CV for Part Time Job">
                            <small id="emailHelp" class="form-text text-muted">With title you can easily locate CV if you have many CVs </small>
                        </div>
                        <div class="form-group">
                            <label for="category">Select Category</label> <span class="red-text" id="no-category" style="display: none">Please choose a category to your CV</span>
                            <select class="form-control" id="category">
                                <option value="0">Select</option>
                                @foreach($jobs as $job)
                                    <option value="{{$job->id}}">{{$job->title}}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="v">Select CV</label>
                            <input type="file" class="form-control-file" id="upload-cv">
                        </div>
                        <a class="btn btn-primary" id="upload-cv-link">Upload CV</a>
                        </div>

                    </div>
                    <div class="user-covers">
                        <h4 class="bold-text">Stored Covers</h4>

                        @foreach($user->covers as $cover)
                            <div class="address-div">
                                <p class="bold-text">{{$cover->title}}</p>
                                @if($cover->category)
                                    <p>{{$cover->category->title}}</p>
                                @endif
                                <p>{{$cover->cover}}</p>
                                <a  href="/user/delete/cover/{{$cover->id}}"><span class="red-text">Delete</span> </a>

                            </div>

                        @endforeach
                        <div class="well">
                            <form action="/user/covers/add" method="post">
                                <input name="redirect" type="hidden" value="/user/manage/details">
                                {{ csrf_field() }}
                            <div class="form-group">
                                <label for="title">Title</label> <span class="red-text" id="no-title" style="display: none">Please add a title to your Cover</span>
                                <input type="text" class="form-control" name="title" aria-describedby="emailHelp" placeholder="Cover for Part Time Job" required>
                                <small id="emailHelp" class="form-text text-muted">With title you can easily locate Cover if you have many Covers </small>
                            </div>
                            <div class="form-group">
                                <label for="category">Select Category</label> <span class="red-text" id="no-category" style="display: none">Please choose a category to your CV</span>
                                <select class="form-control" name="category" required>
                                    @foreach($jobs as $job)
                                        <option value="{{$job->id}}">{{$job->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Cover Letter</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="cover" rows="3"></textarea>
                                </div>

                            <button type="submit" class="btn btn-primary" id="upload-cv-link">Add Cover</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="add-card-form" style="display: none">
        <div class="cross-mark-add-card">
            X
        </div>
        <form action="/user/cards/add" method="post">
            <input name="redirect" type="hidden" value="/user/manage/details">
            {{ csrf_field() }}
            <div class="form-group" style="margin-top: 25px">
                <label for="card">Card Number:</label>
                <input class="form-control" name="card" placeholder="Card number">
            </div>
            <div class="form-group">
                <label for="expiry">Expiry date:</label>
                <input class="form-control" name="expiry" placeholder="Expiry MM/YYYY">
            </div>
            <div class="form-group">
                <label for="cvc">CVC:</label>
                <input class="form-control" name="cvc" placeholder="cvc (3 digits)">
            </div>
            <div class="form-group">
                <label for="address">Billing Address:</label>
                <select class="form-control" name="address">
                    @foreach($user->addresses as $address)
                        <option value="{{$address->id}}">{{$address->line1}}, {{$address->city}}, {{$address->postcode}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Save </button>
        </form>
    </div>
    <div class="add-account-form" style="display: none">
        <div class="cross-mark-add-bank">
            X
        </div>
        <form action="/user/accounts/add" method="post">
            <input name="redirect" type="hidden" value="/user/manage/details">

            {{ csrf_field() }}
            <div class="form-group" style="margin-top: 25px">
                <label for="card">Sort Code:</label>
                <input class="form-control" name="sortcode" placeholder="108800">
            </div>
            <div class="form-group">
                <label for="expiry">Account Number:</label>
                <input class="form-control" name="number" placeholder="00012345">
            </div>

            <button type="submit" class="btn btn-success">Save </button>
        </form>
    </div>
    <div class="add-address-form" style="display: none">
        <div class="cross-mark-add-address">
            X
        </div>
        <form action="/user/addresses/add" method="post">
            <input name="redirect" type="hidden" value="/user/manage/details">

            {{ csrf_field() }}
            <div class="form-group" style="margin-top: 25px">
                <label for="card">Line 1:</label>
                <input class="form-control" name="line1" placeholder="32 Finchale Road">
            </div>
            <div class="form-group">
                <label for="expiry">City:</label>
                <input class="form-control" name="city" placeholder="Durham">
            </div>
            <div class="form-group">
                <label for="expiry">Postcode:</label>
                <input class="form-control" name="postcode" placeholder="DH15JH">
            </div>

            <button type="submit" class="btn btn-success">Save </button>
        </form>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" id="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Verification Code</h4>
                </div>
                <div class="modal-body">
                    <span class="red-text" id="invalid-code" style="display: none">Invalid Code</span>
                    <div class="form-group" style="margin-top: 25px">
                        <label for="card">Enter the code sent to your mobile:</label>
                        <input class="form-control" name="code" id="code" placeholder="6342">
                    </div>
                    <a class="btn btn-primary" id="verify-link">Verify</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
<script>
    $(".card-div-link").click(function () {
        $(".all-divs").hide();
       $(".add-card-form").show();
    });
    $(".cross-mark-add-card ").click(function () {
        $(".all-divs").show();
        $(".add-card-form").hide();
    });
    $(".add-bank-link-btn").click(function () {
        $(".all-divs").hide();
        $(".add-account-form").show();
    });
    $(".cross-mark-add-bank ").click(function () {
        $(".all-divs").show();
        $(".add-account-form").hide();
    });
    $('.add-address-link').click(function () {
        $(".all-divs").hide();
        $(".add-address-form").show();
    });
    $(".cross-mark-add-address ").click(function () {
        $(".all-divs").show();
        $(".add-address-form").hide();
    });
    $(".verify-phone-link").click(function () {
        $("#myModal").modal('show');
        axios.get('/user/send/text', {
            params : {testing:'hello'}
        })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
    });
    $("#verify-link").click(function(){
        var code=$("#code").val();
        axios.get('/user/verify/text', {
            params : {code:code}
        })
            .then(function (response) {
                console.log(response);
                if(response.data.msg==='wrong'){
                    $('#invalid-code').show();
                }else{
                    location.reload();
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    });
    $('#upload-cv-link').click(function () {
        var title = $('#title').val();
        var category = $('#category').val();
        if(!title){
            $('#no-title').show();
            return;
        }else{
            $('#no-title').hide();
        }
        if(category=='0'){
            $('#no-category').show();
            return;
        }else{
            $('#no-category').hide();
        }
       upload_cv();
    });
</script>
@endsection