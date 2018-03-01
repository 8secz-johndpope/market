<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

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
            <form action="/user/save/portfolio" method="post" id="portfolio-form" method="post">
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
                  <div class="portfolio-img col-xs-6 col-sm-4 col-md-3">
                      <div class="image-block add">
                          <i class="icon icon-add-image"></i>
                      </div>
                      <input type="file" name="image" id="image">
                  </div>
                  @if($profile->portfolio != null)
                    @foreach($profile->portfolio->images as $image)
                      <div class="portfolio-img col-xs-6 col-sm-4 col-md-3 image">
                        <div class="image-block">
                          <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$image->image}}">
                          <input type="hidden" name="images[]" value="{{$image->image}}">
                          <span class="circle action delete">
                            <i class="glyphicon glyphicon-trash"></i>
                          </span>
                        </div>
                      </div>
                    @endforeach
                  @endif
                </div>
                <div class="update-form-group col-xs-12 text-right">
                  <button type="button" class="cancel btn btn-link">Cancel</button>
                  <button type="submit" class="save btn btn-submit">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script type="text/html" id="image-template">
<div class="portfolio-img col-xs-6 col-sm-4 col-md-3 image">
  <div class="image-block">
    <img src="/css/loading.gif" class="">
    <input type="hidden" name="images[]" value="">
    <span class="circle action delete">
      <i class="glyphicon glyphicon-trash"></i>
    </span>
  </div>
</div> 
</script>
<script>
  $('.cancel').click(function(){
    window.location.href = $('#redirect').val();
  });
  $("#image").change(function (){
    var text = $('#image-template').html();
    var input = document.getElementById('#image');
    $('.container-images').append(text);
    var image = $('.portfolio-img:last-child').find('img');
    uploadImage(this, image);
    $(this).val('');
  });
  $('#portfolio-form').submit(function(e){
    $('.image').each(function(){
      var src = $(this).find('img').attr('src');
      var imgName = src.substring(src.lastIndexOf('/') + 1, src.length);
      $(this).find('img').next().val(imgName);
    });
  });
  $('.action.delete').click(function(){
    var parent = $(this).parent().parent();
    var nameImage = parent.find('input').val();
    if(nameImage == "")
      deleteImage(nameImage, false);
    else{
      deleteImage(nameImage, true);
    }
    parent.remove();
  });
</script>
@endsection