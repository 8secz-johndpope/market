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
                    <select class="form-control" name="employment_status" id="employment-status" value="{{($profile->employmentStatus != null) ? $profile->employmentStatus->status: ''}}">
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
                              @for($i = 0; $i < 7; $i++)
                              <td>
                                <div class="checkbox">
                                  <input type="checkbox" name="before_school[]" id="before-school-{{$i}}" value="{{$i}}" {{(isset($profile->availibility) && $profile->availibility->availibility_time(0,$i) != null) ? 'checked' : ''}}>
                                  <label for="before-school-{{$i}}"></label>
                                </div>
                              </td>
                              @endfor
                            </tr>

                            <tr>
                              <td class="text-left check-me-big active">
                                Morning
                              </td>
                              @for($i = 0; $i < 7; $i++)
                              <td>
                                <div class="checkbox">
                                  <input type="checkbox" name="morning[]" id="morning-{{$i}}" value="{{$i}}" {{(isset($profile->availibility) && $profile->availibility->availibility_time(1,$i) != null) ? 'checked' : ''}}>
                                   <label for="morning-{{$i}}"></label>
                                </div>
                              </td>
                              @endfor
                            </tr>
                            <tr>
                              <td class="text-left check-me-big active">
                                Noon
                              </td>
                              @for($i = 0; $i < 7; $i++)
                              <td>
                                <div class="checkbox">
                                  <input type="checkbox" name="noon[]" id="noon-{{$i}}" value="{{$i}}" {{(isset($profile->availibility) && $profile->availibility->availibility_time(2,$i) != null) ? 'checked' : ''}}>
                                   <label for="noon-{{$i}}"></label>
                                </div>
                              </td>
                              @endfor
                            </tr>
                            <tr>
                              <td class="text-left check-me-big active">
                                Afternoon
                              </td>
                              @for($i = 0; $i < 7; $i++)
                              <td>
                                <div class="checkbox">
                                  <input type="checkbox" name="afternoon[]" id="afternoon-{{$i}}" value="{{$i}}" {{(isset($profile->availibility) && $profile->availibility->availibility_time(3,$i) != null) ? 'checked' : ''}}>
                                  <label for="afternoon-{{$i}}"></label>
                                </div>
                              </td>
                              @endfor
                            </tr>
                            <tr>
                              <td class="text-left check-me-big active">
                                After School / Nursery
                              </td>
                              @for($i = 0; $i < 7; $i++)
                              <td>
                                <div class="checkbox">
                                  <input type="checkbox" name="after_school[]" id="after-school-{{$i}}" value="{{$i}}" {{(isset($profile->availibility) && $profile->availibility->availibility_time(4,$i) != null) ? 'checked' : ''}}>
                                  <label for="after-school-{{$i}}"></label>
                                </div>
                              </td>
                              @endfor
                            </tr>
                            <tr>
                              <td class="text-left check-me-big active">
                                Evening
                              </td>
                              @for($i = 0; $i < 7; $i++)
                              <td>
                                <div class="checkbox">
                                  <input type="checkbox" name="evening[]" id="evening-{{$i}}" value="{{$i}}" {{(isset($profile->availibility) && $profile->availibility->availibility_time(5,$i) != null) ? 'checked' : ''}}>
                                  <label for="evening-{{$i}}"></label>
                                </div>
                              </td>
                              @endfor
                            </tr>
                            <tr>
                              <td class="text-left check-me-big active">
                                Night
                              </td>
                              @for($i = 0; $i < 7; $i++)
                              <td>
                                <div class="checkbox">
                                  <input type="checkbox" name="night[]" id="night-{{$i}}" value="{{$i}}" {{(isset($profile->availibility) && $profile->availibility->availibility_time(6,$i) != null) ? 'checked' : ''}}>
                                  <label for="night-{{$i}}"></label>
                                </div>
                              </td>
                              @endfor
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="form-group">
                        <div class="checkbox checkbox-strar">
                          <input type="checkbox" name="holiday_availibility" id="holiday_availibility" value="1" {{(isset($profile->availibility) && $profile->availibility->holidays == 1) ? 'checked' : ''}}>
                          <label for="holiday_availibility">Available for babysitting during school holidays</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="checkbox checkbox-strar">
                          <input type="checkbox" name="nigth_availibility" id="night_availibility" value="1" {{(isset($profile->availibility) && $profile->availibility->night == 1) ? 'checked' : ''}}>
                          <label for="night_availibility">Available for overnight care</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="checkbox checkbox-strar">
                          <input type="checkbox" name="emergency_availibility" id="emergency_availibility" value="1" {{(isset($profile->availibility) && $profile->availibility->emergency == 1) ? 'checked' : ''}}>
                          <label for="emergency_availibility">Will accept last minute babysitting</label>
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