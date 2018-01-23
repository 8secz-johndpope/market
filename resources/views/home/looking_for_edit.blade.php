<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Create your cover letter')

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
    <div class="row looking-for-edit">
      <div class="col-sm-12">
        <div class="section">
          <header class="section-header">
            <h2 class="title">Looking for</h2>
          </header>
          <div class="content row">
            <form action="" method="post">
              <input name="redirect" type="hidden" value="/job/profile/edit">
              {{ csrf_field() }}
              <section class="section-job-title">
                <div class="header col-xs-12 col-sm-3">
                  <h3 class="title">Desired Job</h3>
                </div>
                <div class="section-content col-xs-12 col-sm-6">
                  <fieldset class="form-field valid">
                    <span class="twitter-typehead">
                      <input class="form-control desired-job-title tt-input" value="Engineer">
                      <div class="tt-dataset">
                        <span class="tt-suggestions">
                          <div class="tt-suggestion tt-selectable">Engineer</div>
                          <div class="tt-suggestion tt-selectable">Engineer Surveyor</div>
                          <div class="tt-suggestion tt-selectable">Engineering</div>
                          <div class="tt-suggestion tt-selectable">Engineering Administrator</div>
                          <div class="tt-suggestion tt-selectable">Engineering Assistant</div>
                        </span>
                      </div>
                    </span>
                  </fieldset>
                </div>
              </section>
              <section class="section-salary">
                <div class="header col-xs-12 col-sm-3">
                  <h3 class="title">Salary</h3>
                </div>
                <div class="section-content col-xs-12 col-sm-6">
                  <small class="info">Minimum salary (please enter at least one type of salary)</small>
                  <fieldset class="form-field col-xs-12 col-sm-6">
                    <span class="pound-sign">£</span>
                    <input class="form-control salary" type="text" name="minimum-salary" id="minimum-salary" placeholder="per annum">
                    <small class="type-info">Per annum</small>
                    <div class="validation">
                    </div>  
                  </fieldset>
                  <fieldset class="form-field col-xs-12 col-sm-6">
                    <span class="pound-sign">£</span>
                    <input class="form-control salary" type="text" name="minimum-temp-rate" id="minimum-temp-rate" placeholder="per hour">
                    <small class="type-info">Per hour</small>
                    <div class="validation">
                    </div>  
                  </fieldset>
                </div>
              </section>
              <section class="section-locations">
                <div class="header col-xs-12 col-sm-3">
                  <h3 class="title">Preferred work location</h3>
                </div>
                <div class="section-content col-xs-12 col-sm-6">
                  <div class="locations-selector">
                    <ul class="locations">
                      <li>
                        <span class="location-name">London, South East England</span>
                        <input type="hidden" name="prefferedlocation" id="prefferedlocation">
                        <span class="locations-remove small">Remove</span>
                      </li>
                    </ul>
                    <div class="add-button">
                      <button class="btn btn-inverse">
                        <i class="glyphicon glyphicon-plus-sign"></i>
                        <span>Add another location</span>
                      </button>
                    </div>
                    <div class="form-field add-location" style="display: none">
                      <div class="location-container">
                      </div>
                      <div class="validation">
                        <span class="field-validation-error">Sorry, we didn't recognise that town, please try again.</span>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <section class="section-job-type">
                <div class="header col-xs-12 col-sm-3">
                  <h3 class="title">Job type</h3>
                </div>
                <div class="section-content col-xs-12 col-sm-6">
                  <fieldset class="form-field">
                    <div class="checkbox">
                      <input type="checkbox" name="perm-work" id="perm-work">
                      <label for="perm-work">Permanent</label>
                    </div>
                    <div class="checkbox">
                      <input type="checkbox" name="temp-work" id="temp-work">
                      <label for="temp-work">Temporary</label>
                    </div>
                    <div class="checkbox">
                      <input type="checkbox" name="contract-work" id="contract-work">
                      <label for="contract-work">Contract</label>
                    </div>
                    <div class="checkbox"></div>
                  </fieldset>
                  <fieldset class="form-field graduate-jobs">
                    <div class="checkbox">
                      <input type="checkbox" name="is-graduate" id="is-graduate">
                      <label for="is-graduate">Graduate Jobs (Select if you are a recent graduate)</label>
                    </div>
                  </fieldset>
                </div>
              </section>
              <div class="action-container">
                <button type="submit" class="btn btn-submit" id="upload-cv-link">Save changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection