<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

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
        <form action="/user/save/car-driving" method="post" id="form-driving">
          <input name="redirect" type="hidden" value="/job/profile/edit/{{$profile->type}}">
          {{ csrf_field() }}
          <input name="profile" type="hidden" value="{{$profile->id}}">
          <div class="section">
            <header class="section-header">
              <h2 class="title">Car & driving license</h2>
            </header>
            <div class="content row">
              <fieldset class="licence-option">
                <div class="form-group">
                  <label class="col-sm-4 control-label">
                    I have a full license and am eligible to drive in the UK
                  </label>
                  <div class="col-sm-8">
                    <label class="radio-inline">
                      <input type="radio" name="has_licence" id="has-licence-true" value="true" {{($profile->carAndDriving != null && $profile->carAndDriving->hasLicence()) ? 'checked' : '' }}>
                      Yes
                      <label for="has-licence-true">
                      </label>
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="has_licence" id="has-licence-false" {{($profile->carAndDriving != null && !$profile->carAndDriving->hasLicence()) ? 'checked' : '' }}>
                      No
                      <label for="has-licence-false">
                      </label>
                    </label>
                  </div>
                  <div class="col-xs-12 validation">
                    <span>Select one option</span>
                  </div>                    
                </div>
              </fieldset>
              <fieldset class="car-option">
                <div class="form-group">
                  <label class="col-sm-4 control-label">
                    I have a car
                  </label>
                  <div class="col-sm-8">
                    <label class="radio-inline">
                      <input type="radio" name="has_car" id="has-car-true" value="true" {{($profile->carAndDriving != null && $profile->carAndDriving->hasCar()) ? 'checked' : '' }}>
                      Yes
                      <label for="has-car-true">
                      </label>
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="has_car" id="has-car-false" {{($profile->carAndDriving != null && !$profile->carAndDriving->hasLicence()) ? 'checked' : '' }}>
                      No
                      <label for="has-car-false">
                      </label>
                    </label>
                  </div>
                  <div class="col-xs-12 validation">
                    <span>Select one option</span>
                  </div>                    
                </div>
              </fieldset>
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
@endsection
@section('scripts')
<script type="text/javascript">
  $('#form-driving').submit(function(e){
    var hasCar =  $("input[name='has_car']:checked"). val();
    var hasLicence =  $("input[name='has_licence']:checked"). val();
    if(!hasCar && !hasLicence){
      e.preventDefault();
      var parentHasCar = $("input[name='has_car']").closest('.form-group');
      var parentHasLicence = $("input[name='has_licence']").closest('.form-group');
      parentHasCar.addClass('input-validation-error');
      parentHasLicence.addClass('input-validation-error');
    }
  });
  $('input[type="radio"]').change(function(){
    $('.input-validation-error').removeClass('input-validation-error');
  });
</script>
@endsection