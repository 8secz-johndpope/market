<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@php
    $date = new Datetime();
    $dateMs = $date->getTimestamp();
@endphp
@section('styles')
<link href="{{ asset("/css/alert.css?q=$dateMs") }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="body background-color">
  <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="notification-pages">
              <div class="notification-page selected">
                <form id="add_notifications" action="" name="add_notifications">
                  <div class="field-id">
                    <input type="hidden" name="id">
                  </div>
                  <div class="create-alert-home">
                    <div class="notification-title">
                      <h2>Create New Job Alert</h2>
                    </div>
                    <div class="notification-modify-form">
                      <div class="row">
                        <div class="col-sm-6 modify-left">
                          <div class="field-reference">
                            <label for="reference">
                              Alert Name <span>(For your reference)</span>
                            </label>
                            <input type="text" name="reference" id="reference" class="form-control">
                          </div>
                          <div class="field-keywords">
                            <label for="keywords">
                              Keywords <span>(e.g. receptionist)</span>
                            </label>
                            <input type="text" name="keywords" id="keywords" class="form-control">
                          </div>
                        </div>
                        <div class="col-sm-6 modify-right">
                          <div class="row">
                            <div class="col-sm-7">
                              <div class="field-location">
                                <label for="location">Location</label>
                                <input type="text" name="location" id="location" class="form-control">
                              </div>
                            </div>
                            <div class="col-sm-5">
                              <div class="field-distance">
                                <label for="distance">Within</label>
                                <select name="distance" id="distance" class="form-control">
                                  <option value="1" id="distance.0">1 mile</option>
                                  <option value="2" id="distance.1">2 miles</option>
                                  <option value="5" id="distance.2">5 miles</option>
                                  <option value="7" id="distance.3">7 miles</option>
                                  <option value="10" id="distance.4">10 miles</option>
                                  <option value="15" id="distance.5">15 miles</option>
                                  <option value="20" id="distance.6" selected="selected">20 miles</option>
                                  <option value="25" id="distance.7">25 miles</option>
                                  <option value="35" id="distance.8">35 miles</option>
                                  <option value="50" id="distance.9">50 miles</option>
                                  <option value="75" id="distance.10">75 miles</option>
                                  <option value="100" id="distance.11">100 miles</option>
                                  <option value="250" id="distance.12">250 miles</option>
                                  <option value="500" id="distance.13">500 miles</option>
                                  <option value="750" id="distance.14">750 miles</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-4">
                              <div class="field-min-salary">
                                <label for="min-salary">Salary Min</label>
                                <input type="text" name="min-salary" id="min-salary" class="form-control">
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="field-max-salary">
                                <label for="max-salary">Salary Min</label>
                                <input type="text" name="max-salary" id="max-salary" class="form-control">
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="field-salary-period">
                                <label for="salary-period">Salary Type</label>
                                <select name="salary-period" id="salary-period" class="form-control">
                                  <option value="annum" id="salary-period.0">annum</option>
                                  <option value="month" id="salary-period.1">month</option>
                                  <option value="week" id="salary-period.2">week</option>
                                  <option value="day" id="salary-period.3">day</option>
                                  <option value="hour" id="salary-period.4">hour</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-12">
                          <div class="field-type">
                            <h5>Job Type</h5>
                            <label class="checkbox-inline"><input type="checkbox" name="types[]" id="type.0">Any</label>
                            <label class="checkbox-inline"><input type="checkbox" name="types[]" id="type.1">Permanent</label>
                            <label class="checkbox-inline"><input type="checkbox" name="types[]" id="type.2">Contract</label>
                            <label class="checkbox-inline"><input type="checkbox" name="types[]" id="type.3">Temporary</label>
                            <label class="checkbox-inline"><input type="checkbox" name="types[]" id="type.4">Part time</label>
                            <label class="checkbox-inline"><input type="checkbox" name="types[]" id="type.5">Apprenticeship</label>
                          </div>
                        </div>
                        <div class="col-xs-12">
                          <h5>Industry</h5>
                          <div class="row">
                            <div class="field-type">
                              <ul class="sectors clearfix">
                                <li class="col-sm-6 checkbox">
                                  <label>
                                    <input type="checkbox" name="types[]" id="type.0">Any
                                  </label>
                                </li>
                                @foreach($sectors as $sector)
                                <li class="col-sm-6 checkbox">
                                  <label>
                                    <input type="checkbox" name="types[]" id="type.{{$sector->id}}" value="{{$sector->id}}">{{$sector->title}}
                                  </label>
                                </li>
                                @endforeach
                              </ul>
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-12">
                          <h5>Contract Type</h5>
                          <div class="field-contract-types">
                            <div class="row">
                              <ul class="contract-types clearfix">
                                @foreach($fields[15]->values as $value)
                                  @if($value->slug !== 'locum' && $value->slug !== 'voluntary')
                                    <li class="col-sm-6 checkbox">
                                      <label>
                                        <input type="checkbox" name="contract-types[]" id="" value="{{$value->slug}}">{{$value->title}}
                                      </label>
                                    </li>
                                  @endif
                                @endforeach
                              </ul>
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-12">
                          <div class="field-recruiter-type">
                            <h5>Recuiter Type</h5>
                            @foreach($fields[16]->values as $value)
                              <label class="checkbox-inline"><input type="checkbox" name="recruiter-types[]" id="" value="{{$value->slug}}">{{$value->title}}</label>
                            @endforeach
                          </div>
                        </div>
                        <div class="col-xs-12">
                          <div class="field-save">
                            <button type="submit" class="btn btn-submit">Create new alert</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection