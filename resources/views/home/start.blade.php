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
                    <h3 class="panel-title">List of Packs</h3>
                </div>
                <div class="panel-body">
                    <div class="row" id="pack-list">
                        @include('home.packs', array('contract' => $contract));
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
                            <span class="category-title">{{$category->title}}</span>
                            <br>
                            <a class="main-category-link select-category-link" data-category="{{$category->id}}">Select</a>
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
                            <span class="category-title">   {{$location->title}} </span>
                            <a class="main-category-link select-location-link" data-location="{{$location->id}}">Select</a>
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
                        <label><input type="checkbox" name="type[]" value="standard" class="pack-class">Standard</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="type[]" value="urgent" class="pack-class">Urgent</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="type[]" value="spotlight" class="pack-class">Spotlight</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="type[]" value="featured_3" class="pack-class">Featured (3 days)</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="type[]" value="featured" class="pack-class">Featured (7 days)</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="type[]" value="featured_14" class="pack-class">Featured (14 days)</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="type[]" value="bump" class="pack-class">Bump</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="type[]" value="shipping_1" class="pack-class">Shipping (2kg)</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="type[]" value="shipping_2" class="pack-class">Shipping (5kg)</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="type[]" value="shipping_3" class="pack-class">Shipping (10kg)</label>
                    </div>

                    <a class="btn btn-primary add-pack">Add Packs</a>

                </form>
            </div>
        </div>


    </div>
@endsection