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
        <form action="/user/save/profile-additional-info" method="post">
          <input name="redirect" type="hidden" value="/job/profile/edit/{{$profile->type}}">
          {{ csrf_field() }}
          <input name="profile" type="hidden" value="{{$profile->id}}">
          <div class="section">
            <header class="section-header">
              <h2 class="title">Additional Information</h2>
            </header>
            <div class="content row">
              <fieldset class="licence-option">
                <div class="form-group">
                  <label class="col-sm-4 control-label">
                    Smoker*
                  </label>
                  <div class="col-sm-8">
                    <label class="radio-inline">
                      <input type="radio" name="is_smoker" id="is-smoker-true" value="true" {{($profile->additionalInfo != null && $profile->additionalInfo->isSmoker()) ? 'checked' : '' }}>
                      Yes
                      <label for="is-smoker-true">
                      </label>
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="is_smoker" id="is-smoker-false" {{($profile->additionalInfo != null && !$profile->additionalInfo->isSmoker()) ? 'checked' : '' }}>
                      No
                      <label for="is-smoker-false">
                      </label>
                    </label>
                  </div>                    
                </div>
              </fieldset>
              @if($profile->isSocialcare())
              <fieldset class="first-aid-option">
                <div class="form-group">
                  <label class="col-sm-4 control-label">
                    First Aid Certificate*
                  </label>
                  <div class="col-sm-8">
                    <label class="radio-inline">
                      <input type="radio" name="has_first_aid" id="has-first-aid-true" value="true" {{($profile->additionalInfo != null && $profile->additionalInfo->hasFirstAid()) ? 'checked' : '' }}>
                      Yes
                      <label for="has-first-aid-true">
                      </label>
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="has_first_aid" id="has-first-aid-false" {{($profile->additionalInfo != null && !$profile->additionalInfo->hasFirstAid()) ? 'checked' : '' }}>
                      No
                      <label for="has-first-aid-false">
                      </label>
                    </label>
                  </div>                    
                </div>
              </fieldset>
              <fieldset class="first-aid-option">
                <div class="form-group">
                  <label class="col-sm-4 control-label">
                    Do you have children?*
                  </label>
                  <div class="col-sm-8">
                    <label class="radio-inline">
                      <input type="radio" name="has_children" id="has_children-true" value="true" {{($profile->additionalInfo != null && $profile->additionalInfo->hasChildren()) ? 'checked' : '' }}>
                      Yes
                      <label for="has_children-true">
                      </label>
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="has_children" id="has_children-false" {{($profile->additionalInfo != null && !$profile->additionalInfo->hasChildren()) ? 'checked' : '' }}>
                      No
                      <label for="has_children-false">
                      </label>
                    </label>
                  </div>                    
                </div>
              </fieldset>
              @endif
              <div class="col-xs-12">
                @if($profile->isSubContractor())
                <div class="form-group">
                  <label for="url-linkedin">Your LinkedIn profile</label>
                  <input type="text" name="url_linkedin" id="url-linkedin" placeholder="Url" class="form-control">
                </div>
                @endif
                <div class="form-group">
                  <label>Tell us about yourself: Your education, work, interests,...</label>
                  <textarea rows="5" class="form-control" name="about_me">
                  </textarea>
                </div>
              </div>
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