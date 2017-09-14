<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">


            <div class="well">

                <form>
                    <div class="form-group row">
                        <label for="example-url-input" class="col-2 col-form-label">Category</label>
                        <div class="col-10">
                            <input class="form-control" type="text" placeholder="Category" id="example-url-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-url-input" class="col-2 col-form-label">Location</label>
                        <div class="col-10">
                            <input class="form-control" type="text" placeholder="Location" id="example-url-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-url-input" class="col-2 col-form-label">Standard</label>
                        <div class="col-10">
                            <input class="form-control" type="text" placeholder="Standard" id="example-url-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-url-input" class="col-2 col-form-label">Urgent</label>
                        <div class="col-10">
                            <input class="form-control" type="text" placeholder="Urgent" id="example-url-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-url-input" class="col-2 col-form-label">Spotlight</label>
                        <div class="col-10">
                            <input class="form-control" type="text" placeholder="Standard" id="example-url-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-url-input" class="col-2 col-form-label">Featured (3 days)</label>
                        <div class="col-10">
                            <input class="form-control" type="text" placeholder="Standard" id="example-url-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-url-input" class="col-2 col-form-label">Featured (7 days)</label>
                        <div class="col-10">
                            <input class="form-control" type="text" placeholder="Standard" id="example-url-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-url-input" class="col-2 col-form-label">Featured (14 days)</label>
                        <div class="col-10">
                            <input class="form-control" type="text" placeholder="Standard" id="example-url-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-url-input" class="col-2 col-form-label">Bump</label>
                        <div class="col-10">
                            <input class="form-control" type="text" placeholder="Standard" id="example-url-input">
                        </div>
                    </div>

                    <a class="btn btn-primary">Add Price Group</a>

                </form>
            </div>
        </div>


    </div>
@endsection