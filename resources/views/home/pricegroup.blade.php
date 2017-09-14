<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<input type="hidden" id="category">
<input type="hidden" id="location">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default selected-category-panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Category</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-11"><span class="category-sting"></span> </div>
                        <div class="col-sm-1">
                            <a class="btn btn-default edit-category">Edit</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="panel panel-default  manual-category-panel" style="display: block">
                <div class="panel-heading">
                    <h3 class="panel-title">Select Category</h3>
                </div>
                <div class="panel-body">
                    @foreach($categories as $category)
                        <div class="main-category" data-category="{{$category->id}}">
                            {{$category->title}}
                            <a class="select-link select-category-link" data-category="{{$category->id}}">Select</a>
                        </div>
                    @endforeach
                    <div class="row nomargin">
                        <div class="col-lg-3 sub-category">
                            <ul class="list-group category-level-1  nomargin">

                            </ul>
                        </div>
                        <div class="col-lg-3 sub-category">
                            <ul class="list-group category-level-2  nomargin">

                            </ul>
                        </div>
                        <div class="col-lg-3 sub-category">
                            <ul class="list-group category-level-3  nomargin">

                            </ul>
                        </div>
                        <div class="col-lg-3 sub-category">
                            <ul class="list-group category-level-4  nomargin">

                            </ul>
                        </div>
                    </div>

                </div>
            </div>


            <div class="panel panel-default selected-location-panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Location</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-11"><span class="location-sting"></span> </div>
                        <div class="col-sm-1">
                            <a class="btn btn-default edit-location">Edit</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="panel panel-default  manual-location-panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Select Location</h3>
                </div>
                <div class="panel-body">
                    @foreach($locations as $location)
                        <div class="main-location" data-location="{{$location->id}}">
                            {{$location->title}}
                            <a class="select-link select-location-link" data-category="{{$category->id}}">Select</a>
                        </div>
                    @endforeach
                    <div class="row nomargin">
                        <div class="col-lg-3 sub-location">
                            <ul class="list-group location-level-1  nomargin">

                            </ul>
                        </div>
                        <div class="col-lg-3 sub-location">
                            <ul class="list-group location-level-2  nomargin">

                            </ul>
                        </div>
                        <div class="col-lg-3 sub-location">
                            <ul class="list-group location-level-3  nomargin">

                            </ul>
                        </div>
                        <div class="col-lg-3 sub-location">
                            <ul class="list-group location-level-4  nomargin">

                            </ul>
                        </div>
                    </div>

                </div>
            </div>




            <div class="well">

                <form>
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
                            <input class="form-control" type="text" placeholder="Spotlight" id="example-url-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-url-input" class="col-2 col-form-label">Featured (3 days)</label>
                        <div class="col-10">
                            <input class="form-control" type="text" placeholder="Featured (3 days)" id="example-url-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-url-input" class="col-2 col-form-label">Featured (7 days)</label>
                        <div class="col-10">
                            <input class="form-control" type="text" placeholder="Featured (7 days)" id="example-url-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-url-input" class="col-2 col-form-label">Featured (14 days)</label>
                        <div class="col-10">
                            <input class="form-control" type="text" placeholder="Featured (14 days)" id="example-url-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-url-input" class="col-2 col-form-label">Bump</label>
                        <div class="col-10">
                            <input class="form-control" type="text" placeholder="Bump" id="example-url-input">
                        </div>
                    </div>

                    <a class="btn btn-primary">Add Price Group</a>

                </form>
            </div>
        </div>


    </div>
@endsection