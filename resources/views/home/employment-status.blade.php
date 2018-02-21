<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Create your employment status')

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
          <a href="/job/profile/edit/{{$profile->type}}"><i class="glyphicon glyphicon-menu-left"></i>Your profile</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="section">
          <header class="section-header">
            <h2 class="title">Status and availability</h2>
          </header>
          <form action="/user/employment-status/add" method="post">
            <input name="redirect" type="hidden" value="/job/profile/edit/{{$profile->type}}">
            {{ csrf_field() }}
            <input name="profile" type="hidden" value="{{$profile->id}}">
            <div class="content row">
              <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                  <label for="employment-status">Employment status</label>
                  <select class="form-control" name="employment_status" id="employment-status">
                    <option value="">- select -</option>
                    <option value="1">Employed (full-time)</option>
                    <option value="2">Employed (part-time)</option>
                    <option value="3">Employed (temp / contract)</option>
                    <option value="4">Full-time education</option>
                    <option value="5">Unemployed</option>
                  </select>
                  <div class="validation">
                    <span class="field-validation-valid"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="notice-period">Notice period</label>
                  <select class="form-control" id="notice_period" name="notice-period">
                    <option value="">- select -</option>
                    <option value="1">None specified</option>
                    <option value="2">1 week</option>
                    <option value="3">2 weeks</option>
                    <option value="4">3 weeks</option>
                    <option value="5">1 month</option>
                    <option value="6">2 months</option>
                    <option value="7">3 months</option>
                    <option value="8">6 months</option>
                  </select>
                  <div class="validation">
                    <span class="field-validation-valid"></span>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6">
              </div>
            </div>
            <div class="action-container">
              <button type="button" class="btn-inverse">Cancel</button>
              <button type="submit" class="btn btn-submit">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection