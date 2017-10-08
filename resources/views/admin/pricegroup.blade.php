<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default selected-category-panel" @if($price) style="display: block" @endif>
                <div class="panel-heading">
                    <h3 class="panel-title">Category</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-11"><span class="category-sting">@if($price) {{$price->category->string()}} @endif</span> </div>
                        <div class="col-sm-1">
                            @if($price) <span class="glyphicon glyphicon-lock"></span> @else   <a class="btn btn-default edit-category">Edit</a>@endif
                        </div>
                    </div>
                </div>
            </div>
            @if($price)

                @else

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
            @endif


            <div class="panel panel-default selected-location-panel" @if($price) style="display: block" @endif>
                <div class="panel-heading">
                    <h3 class="panel-title">Location</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-11"><span class="location-sting">@if($price) {{$price->location->string()}} @endif</span> </div>
                        <div class="col-sm-1">
                            @if($price) <span class="glyphicon glyphicon-lock"></span> @else  <a class="btn btn-default edit-location">Edit</a> @endif
                        </div>
                    </div>
                </div>
            </div>
            @if($price)

            @else



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
            @endif


            <div class="well">

                <form action="/admin/manage/pricegroup/add" method="post">
                    {{ csrf_field() }}
                    @if($price)
                        <input type="hidden" name="id" value="{{$price->id}}">
                        @endif
                    <input type="hidden" id="category" name="category" value="@if($price) {{$price->category->id}} @else 0 @endif">
                    <input type="hidden" id="location" name="location" value="@if($price) {{$price->location->id}} @else 0 @endif">
                    <div class="form-group row">
                        <label for="example-url-input" class="col-2 col-form-label">Standard</label>
                        <div class="col-10">
                            <input class="form-control" name="standard" type="text" placeholder="0.00" id="standard" required @if($price) value="{{$price->standard/100}}" @endif >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-url-input" class="col-2 col-form-label">Urgent</label>
                        <div class="col-10">
                            <input class="form-control" name="urgent" type="text" placeholder="10.00" id="urgent" required @if($price) value="{{$price->urgent/100}}" @endif>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-url-input" class="col-2 col-form-label">Spotlight</label>
                        <div class="col-10">
                            <input class="form-control" name="spotlight" type="text" placeholder="20.00" id="spotlight" required @if($price) value="{{$price->spotlight/100}}" @endif>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-url-input" class="col-2 col-form-label">Featured (3 days)</label>
                        <div class="col-10">
                            <input class="form-control" name="featured_3" type="text" placeholder="15.00" id="featured_3" required @if($price) value="{{$price->featured_3/100}}" @endif>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-url-input" class="col-2 col-form-label">Featured (7 days)</label>
                        <div class="col-10">
                            <input class="form-control" name="featured" type="text" placeholder="20.00" id="featured" required @if($price) value="{{$price->featured/100}}" @endif>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-url-input" class="col-2 col-form-label">Featured (14 days)</label>
                        <div class="col-10">
                            <input class="form-control" name="featured_14" type="text" placeholder="30.00" id="featured_14" required @if($price) value="{{$price->featured_14/100}}" @endif>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-url-input" class="col-2 col-form-label">Bump</label>
                        <div class="col-10">
                            <input class="form-control" name="bump" type="text" placeholder="5.00" id="bump" required @if($price) value="{{$price->bump/100}}" @endif>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">  @if($price) Save Changes @else Add Price Group @endif</button>

                </form>
            </div>
        </div>


    </div>
@endsection