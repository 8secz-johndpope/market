<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Upload CV')

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
          <a href="/job/profile/edit/general"><i class="glyphicon glyphicon-menu-left"></i>Your profile</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <form action="" method="post">
        <div class="section">
          <header class="section-header">
            <h2 class="title">Select a file to upload</h2>
          </header>
          <div class="content row">
              <div class="upload-options">
                <ul>
                  <li class="col-xs-12 col-sm-6 cv-upload-option">
                    <span class="upload-option device">
                      From your device
                    </span>
                    <input type="file" name="cv" class="file-input" id="upload-cv">
                  </li>
                  <li class="col-xs-12 col-sm-6 cv-upload-option">
                    <span class="upload-option googledrive">
                      Google Drive
                    </span>
                  </li>
                  <li class="col-xs-12 col-sm-6 cv-upload-option">
                    <span class="upload-option onedrive">
                      Microsoft OneDrive
                    </span>
                  </li>
                  <li class="col-xs-12 col-sm-6 cv-upload-option">
                    <span class="upload-option dropbox">
                      Dropbox
                    </span>
                  </li>
                </ul>
              </div>
              <div class="cv-confirmation-area col-xs-8 col-xs-offset-2" style="display: none">
                <div class="row">
                  <div class="col-xs-12 col-sm-8">
                    <div class="row cv-information">
                      <div class="col-xs-2">
                        <i class="icon icon-cv"></i>
                      </div>
                      <div class="col-xs-10">
                        <b class="filename"></b>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-4 incorrect-file">
                    <p>
                      Not the right file?
                      <br>
                      <a class="upload-new-cv" href="#">Upload a new CV</a>
                    </p>
                  </div>
                </div>
              </div>
              <div class="cv-searchable col-xs-12">
                <div class="checkbox">
                  <input type="checkbox" id="searchable-checkbox" checked="checked" name="searchable-checkbox">
                  <label for="searchable-checkbox">
                    <b>Let recruiters find your CV</b>
                    <br>
                    You can modify this at any time in your profile
                  </label>
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="title">Title</label> 
                <input type="hidden" value="{{$profile->id}}" name="profile" id="profile">
                <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="CV for Part Time Job">
                <small id="emailHelp" class="form-text text-muted">With title you can easily locate CV if you have many CVs </small>
                <div class="validation">
                  <span>Please add a title to your CV</span>
                </div>
              </div>
              <div class="form-group">
                <label for="category">Select Category</label>
                <select class="form-control" id="category">
                    <option value="0">Select</option>
                    @foreach($jobs as $job)
                      <option value="{{$job->id}}">{{$job->title}}</option>
                    @endforeach
                </select>
                <div class="validation">
                   <span>Please choose a category to your CV</span>
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <a class="btn btn-submit" id="upload-cv-link">Upload CV</a>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $('#upload-cv-link').click(function () {
        var title = $('#title').val();
        var category = $('#category').val();
        var parent = null;
        if(!title){
            parent = $('#title').closest('.form-group');
            //$('#no-title').show();
            //return;
        }
        /*else{
            $('#no-title').hide();
        }*/
        if(category=='0'){
          parent = $('#no-category').closest('.form-group');
            //$('#no-category').show();
            //return;
        }
        /*else{
            $('#no-category').hide();
        }*/
       if(parent != null){
        parent.addClass('input-validation-error');
       }else{
        upload_cv();
      }
    });
  $('#upload-cv').change(function(){
    $('.cv-confirmation-area').show();
    $('.filename').text($('#upload-cv').val());
    $('.upload-options').hide();
  });
  $('.upload-new-cv').click(function(){
    $('.upload-options').show();
    $('.cv-confirmation-area').hide();
    $('#upload-cv').val('');
  });
</script>
@endsection