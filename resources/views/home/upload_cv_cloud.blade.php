<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

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
          <a href="{{ URL::previous() }}"><i class="glyphicon glyphicon-menu-left"></i>Your profile</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="section">
          <header class="section-header">
            <h2 class="title">Select a file to upload</h2>
          </header>
          <div class="content row">
            <form action="" method="post">
              <div class="upload-options">
                <ul>
                  <li class="col-xs-12 col-sm-6 cv-upload-option">
                    <span class="upload-option device">
                      From your device
                    </span>
                    <input type="file" name="cv" class="file-input">
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
            </form>
          </div>
          <div class="row">
            <div class="col-sm-12">
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection