<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Add yours publication')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@php
    $date = new Datetime();
    $dateMs = $date->getTimestamp();
@endphp
@section('content')
<link href="{{ asset("/css/private-profile.css?q=$dateMs") }}" rel="stylesheet" type="text/css">
<div class="body background-body">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="back-link">
          <a href="{{ URL::previous() }}"><i class="glyphicon glyphicon-menu-left"></i>Your profile</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="section">
          <header class="section-header">
            <h2 class="title">Add Portfolio</h2>
          </header>
          <div class="content row">
            <form action="/user/save/portfolio" method="post" id="work-experience-form" method="post">
                <input name="redirect" id="redirect" type="hidden" value="/job/profile/edit/{{$profile->type}}">
                {{ csrf_field() }}
                <input type="hidden" name="profile" value="{{$profile->id}}">
              <div class="small-container col-xs-12 col-sm-9">
                <div class="form-group">
                    <label for="title">Title</label> 
                    <span class="red-text" id="no-title" style="display: none">Please add a title</span>
                    <input type="text" class="form-control" name="title" placeholder="" required>
                </div>
                <div class="container-images row">
                  <div class="col-xs-6 col-sm-4 col-md-3">
                    <a href="" class="" id="add-image">
                      <div class="imagen-block">
                        <span class="circle add">
                          <i class="glyphicon glyphicon-plus-sign"></i>
                        </span>
                      </div>
                    </a>
                  </div>
                </div>
                @foreach($profile->publication->images as $image)
                <div class="container-images row">
                  <div class="col-xs-6 col-sm-4 col-md-3">
                    <div class="imagen-block">
                      <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$image->image}}">
                    </div>
                  </div>
                </div>
                @endforeach
                <div class="update-form-group col-xs-12 text-right">
                  <button type="button" class="cancel btn btn-link">Cancel</button>
                  <button type="button" class="save-and-other btn btn-inverse">Save & add other</button>
                  <button type="submit" class="save btn btn-submit" id="upload-cv-link">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $('.cancel').click(function(){
    window.location.href = $('#redirect').val();
  });
  $('.save-and-other').click(function(){
    $('#redirect').val('/user/create/publication');
    //$('#work-experience-form')[0].reset();
    //$('#work-experience-form').submit();
  });
</script>
@endsection