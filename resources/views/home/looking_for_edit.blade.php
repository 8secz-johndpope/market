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
              <section class="section-job-title row">
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
              <section class="section-salary row">
                <div class="header col-xs-12 col-sm-3">
                  <h3 class="title">Salary</h3>
                </div>
                <div class="section-content col-xs-12 col-sm-6">
                  <p class="small">Minimum salary (please enter at least one type of salary)</p>
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
              <section class="section-locations row">
                <div class="header col-xs-12 col-sm-3">
                  <h3 class="title">Preferred work location</h3>
                </div>
                <div class="section-content col-xs-12 col-sm-9">
                  <div class="locations-selector">
                    <ul class="locations">
                      <li>
                        <span class="location-name">London, South East England</span>
                        <input type="hidden" name="prefferedlocation" id="prefferedlocation">
                        <span class="location-remove small">Remove</span>
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
                        <div class="inline-input inline">
                          <span class="twitter-typehead inline">
                            <input type="text" name="location" id="location" class="form-control tt-input">
                          </span>
                          <a href="#" class="location-link glyphicon glyphicon-map-marker"></a>
                        </div>
                        <button btn btn-secondary btn-inline>Add</button>
                      </div>
                      <div class="validation">
                        <span class="field-validation-error">Sorry, we didn't recognise that town, please try again.</span>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <section class="section-job-type row">
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
              <section class="section-hours row">
                <div class="header col-xs-12 col-sm-3">
                  <h3 class="title">Hours</h3>
                </div>
                <div class="section-content col-xs-12 col-sm-9">
                  <fieldset class="form-field">
                    <div class="checkbox">
                      <input type="checkbox" name="is-full-time" id="is-full-time">
                      <label for="is-full-time">Full-time</label>
                    </div>
                    <div class="checkbox">
                      <input type="checkbox" name="is-part-time" id="is-part-time">
                      <label for="is-part-time">Part-time</label>
                    </div>
                  </fieldset>
                </div>
              </section>
              <section class="section-specialisms row">
                <div class="header col-xs-12 col-sm-3">
                  <h3 class="title">Sectors</h3>
                  <small>You may add up to 10 sectors</small>
                </div>
                <div class="section-content col-xs-12 col-sm-9">
                  <div class="specialism-selector">
                    <div class="selected-specialisms">
                      <div>
                        <div class="specialism">
                          <div class="specialism-details row">
                            <div class="data col-xs-6 col-sm-8">
                              <span class="name">IT & Telecoms</span>
                              <span>4 roles</span>
                            </div>
                            <div class="edit-specialism-actions small col-xs-6 col-sm-4">
                              <span class="edit">
                                <i class="glyphicon glyphicon-pencil visible-xs-block"></i>
                                <span class="hidden-xs">Edit roles</span>
                              </span>
                              <span class="remove">
                                <i class="glyphicon glyphicon-trash"></i>
                              </span>
                            </div>
                            <div class="edit-roles" style="display: none"></div>
                          </div>
                          <div class="more-specialism-actions">
                            <button class="add-more-specialism btn btn-inverse">
                              <i class="glyphicon glyphicon-plus-sign"></i>
                              <span>Add another sector</span>
                            </button>
                          </div>
                          <div class="add-specialism-container" style="display: none">
                            <select class="form-control specialisms-list">
                              <option value>Choose your sector...</option>
                            </select>
                            <div style="display: none">
                              <p class="info">
                                Select up to 5 roles
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
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
<script>
  $('.add-button button').click(function(e){
    e.preventDefault();
    $(this).parent().hide();
    $('.add-location').show();
  });
</script>
@endsection