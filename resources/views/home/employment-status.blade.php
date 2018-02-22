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
        <form action="/user/employment-status/add" method="post">
          <input name="redirect" type="hidden" value="/job/profile/edit/{{$profile->type}}">
          {{ csrf_field() }}
          <input name="profile" type="hidden" value="{{$profile->id}}">
          <div class="section">
            <header class="section-header">
              <h2 class="title">Status and availability</h2>
            </header>
            
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
            </div>
            @if($profile->type == 'social-childcare')
            <div class="row">
              <div class="col-xs-12 availability-inscription">
                <div class="section">
                  <header class="section-header">
                    <h2 class="title">Availability</h2>
                  </header>
                  <div class="content row">
                    <div class="col-xs-12 part">
                      <div class="table-responsive availability-tab">
                        <table id="zone-horaire" class="table table-bordered">
                          <thead>
                            <tr class="active">
                              <th></th>
                              <th>
                                <span class="hidden-xs">Mon</span>
                                <span class="visible-xs tableday">M</span>
                              </th>
                              <th>
                                <span class="hidden-xs">Tues</span>
                                <span class="visible-xs tableday">T</span>
                              </th>
                              <th>
                                <span class="hidden-xs">Wed</span>
                                <span class="visible-xs tableday">W</span>
                              </th>
                              <th>
                                <span class="hidden-xs">Thu</span>
                                <span class="visible-xs tableday">T</span>
                              </th>
                              <th>
                                <span class="hidden-xs">Fri</span>
                                <span class="visible-xs tableday">F</span>
                              </th>
                              <th>
                                <span class="hidden-xs">Sat</span>
                                <span class="visible-xs tableday">S</span>
                              </th>
                              <th>
                                <span class="hidden-xs">Sun</span>
                                <span class="visible-xs tableday">s</span>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="text-left check-me-big active">
                                Before School / Nursery
                              </td>
                              <td>
                                <input type="checkbox" name="before_school[]" value="0">
                              </td>
                              <td>
                                <input type="checkbox" name="before_school[]" value="1">
                              </td>
                              <td>
                                <input type="checkbox" name="before_school[]" value="2">
                              </td>
                              <td>
                                <input type="checkbox" name="before_school[]" value="3">
                              </td>
                              <td>
                                <input type="checkbox" name="before_school[]" value="4">
                              </td>
                              <td>
                                <input type="checkbox" name="before_school[]" value="5">
                              </td>
                              <td>
                                <input type="checkbox" name="before_school[]" value="6">
                              </td>
                            </tr>
                            <tr>
                              <td class="text-left check-me-big active">
                                Morning
                              </td>
                              <td>
                                <input type="checkbox" name="morning[]" value="0">
                              </td>
                              <td>
                                <input type="checkbox" name="morning[]" value="1">
                              </td>
                              <td>
                                <input type="checkbox" name="morning[]" value="2">
                              </td>
                              <td>
                                <input type="checkbox" name="morning[]" value="3">
                              </td>
                              <td>
                                <input type="checkbox" name="morning[]" value="4">
                              </td>
                              <td>
                                <input type="checkbox" name="morning[]" value="5">
                              </td>
                              <td>
                                <input type="checkbox" name="morning[]" value="6">
                              </td>
                            </tr>
                            <tr>
                              <td class="text-left check-me-big active">
                                Noon
                              </td>
                              <td>
                                <input type="checkbox" name="noon[]" value="0">
                              </td>
                              <td>
                                <input type="checkbox" name="noon[]" value="1">
                              </td>
                              <td>
                                <input type="checkbox" name="noon[]" value="2">
                              </td>
                              <td>
                                <input type="checkbox" name="noon[]" value="3">
                              </td>
                              <td>
                                <input type="checkbox" name="noon[]" value="4">
                              </td>
                              <td>
                                <input type="checkbox" name="noon[]" value="5">
                              </td>
                              <td>
                                <input type="checkbox" name="noon[]" value="6">
                              </td>
                            </tr>
                            <tr>
                              <td class="text-left check-me-big active">
                                Afternoon
                              </td>
                              <td>
                                <input type="checkbox" name="afternoon[]" value="0">
                              </td>
                              <td>
                                <input type="checkbox" name="afternoon[]" value="1">
                              </td>
                              <td>
                                <input type="checkbox" name="afternoon[]" value="2">
                              </td>
                              <td>
                                <input type="checkbox" name="afternoon[]" value="3">
                              </td>
                              <td>
                                <input type="checkbox" name="afternoon[]" value="4">
                              </td>
                              <td>
                                <input type="checkbox" name="afternoon[]" value="5">
                              </td>
                              <td>
                                <input type="checkbox" name="afternoon[]" value="6">
                              </td>
                            </tr>
                            <tr>
                              <td class="text-left check-me-big active">
                                After School / Nursery
                              </td>
                              <td>
                                <input type="checkbox" name="after_school[]" value="0">
                              </td>
                              <td>
                                <input type="checkbox" name="after_school[]" value="1">
                              </td>
                              <td>
                                <input type="checkbox" name="after_school[]" value="2">
                              </td>
                              <td>
                                <input type="checkbox" name="after_school[]" value="3">
                              </td>
                              <td>
                                <input type="checkbox" name="after_school[]" value="4">
                              </td>
                              <td>
                                <input type="checkbox" name="after_school[]" value="5">
                              </td>
                              <td>
                                <input type="checkbox" name="after_school[]" value="6">
                              </td>
                            </tr>
                            <tr>
                              <td class="text-left check-me-big active">
                                Evening
                              </td>
                              <td>
                                <input type="checkbox" name="evening[]" value="0">
                              </td>
                              <td>
                                <input type="checkbox" name="evening[]" value="1">
                              </td>
                              <td>
                                <input type="checkbox" name="evening[]" value="2">
                              </td>
                              <td>
                                <input type="checkbox" name="evening[]" value="3">
                              </td>
                              <td>
                                <input type="checkbox" name="evening[]" value="4">
                              </td>
                              <td>
                                <input type="checkbox" name="evening[]" value="5">
                              </td>
                              <td>
                                <input type="checkbox" name="evening[]" value="6">
                              </td>
                            </tr>
                            <tr>
                              <td class="text-left check-me-big active">
                                Night
                              </td>
                              <td>
                                <input type="checkbox" name="night[]" value="0">
                              </td>
                              <td>
                                <input type="checkbox" name="night[]" value="1">
                              </td>
                              <td>
                                <input type="checkbox" name="night[]" value="2">
                              </td>
                              <td>
                                <input type="checkbox" name="night[]" value="3">
                              </td>
                              <td>
                                <input type="checkbox" name="night[]" value="4">
                              </td>
                              <td>
                                <input type="checkbox" name="night[]" value="5">
                              </td>
                              <td>
                                <input type="checkbox" name="night[]" value="6">
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="form-group">
                        <div class="checkbox checkbox-strar">
                          <input type="checkbox" name="holiday_availability" id="holiday_availability">
                          <label for="holiday_availability">Available for babysitting during school holidays</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="checkbox checkbox-strar">
                          <input type="checkbox" name="nigth_availability" id="night_availability">
                          <label for="night_availability">Available for overnight care</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="checkbox checkbox-strar">
                          <input type="checkbox" name="emergency_availability" id="emergency_availability">
                          <label for="emergency_availability">Will accept last minute babysitting</label>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          @endif
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