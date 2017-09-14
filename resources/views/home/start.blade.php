<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.contract')

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

            <div class="panel panel-default selected-business-panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Business Type</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-11">


                            <div class="form-group">
                                <select class="form-control" id="business">
                                    <option value="0">Select Business</option>
                                    <option value="1">Small Business</option>
                                    <option value="2">Medium Business</option>
                                    <option value="3">Large Business</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-1">
                        </div>
                    </div>
                </div>
            </div>


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
                            <a class="select-link select-location-link" data-location="{{$location->id}}">Select</a>
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
                    <div class="checkbox">
                        <label><input type="checkbox" name="type" value="standard">Standard</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="type" value="standard">Urgent</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="type" value="standard">Spotlight</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="type" value="standard">Featured (3 days)</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="type" value="standard">Featured (7 days)</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="type" value="standard">Bump</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="type" value="standard">Shipping (2kg)</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="type" value="standard">Shipping (5kg)</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="type" value="standard">Shipping (10kg)</label>
                    </div>

                    <a class="btn btn-primary add-pack">Add Pack</a>

                </form>
            </div>
        </div>


    </div>
@endsection