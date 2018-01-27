<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Add your work experience')

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
            <h2 class="title">Work experience</h2>
          </header>
          <div class="content row">
            <form action="" method="post">
                <input name="redirect" type="hidden" value="/job/profile/edit">
                {{ csrf_field() }}
              <div class="small-container col-xs-12 col-sm-9">
                <div class="form-group">
                    <label for="title">Job title</label> 
                    <span class="red-text" id="no-title" style="display: none">Please add a job title</span>
                    <input type="text" class="form-control" name="title" aria-describedby="emailHelp" placeholder="" required>
                </div>
                <div class="form-group">
                  <label for="title">Company</label> 
                  <span class="red-text" id="no-company" style="display: none">Please add the company name</span>
                  <input type="text" class="form-control" name="company" aria-describedby="emailHelp" placeholder="" required>
                </div>
                <div class="row">
                  <div class="date-from form-group col-sm-8 col-xs-12">
                    <label class="legend" for="date-from-month">From</label>
                    <div class="row">
                      <div class="month col-sm-6 col-xs-12">
                        <select class="form-control" id="date-from-month" name="date-from-month">
                          <option value="">Month</option>
                          <option value="1">January</option>
                          <option value="2">February</option>
                          <option value="3">March</option>
                          <option value="4">April</option>
                          <option value="5">May</option>
                          <option value="6">June</option>
                          <option value="7">July</option>
                          <option value="8">August</option>
                          <option value="9">September</option>
                          <option value="10">October</option>
                          <option value="11">November</option>
                          <option value="12">December</option>
                        </select>
                      </div>
                      <div class="year col-sm-6 col-xs-12">
                        <select class="form-control" id="date-from-year" name="date-from-year">
                          <option value="">Year</option>
                          @for($i = idate('Y'); $i > 1943; $i--)
                            <option value="{{$i}}">{{$i}}</option>
                          @endfor
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="current-role form-group checkbox col-sm-4 col-xs-12">
                    <input type="checkbox" name="is-current-role" id="is-current-role">
                    <label for="is-current-role">I currently work here</label>
                  </div>
                  <div class="date-to form-group col-sm-8 col-xs-12">
                    <label class="legend" for="date-to-month">To</label>
                    <div class="row">
                      <div class="month col-sm-6 col-xs-12">
                        <select class="form-control" id="date-to-month" name="date-to-month">
                          <option value="">Month</option>
                          <option value="1">January</option>
                          <option value="2">February</option>
                          <option value="3">March</option>
                          <option value="4">April</option>
                          <option value="5">May</option>
                          <option value="6">June</option>
                          <option value="7">July</option>
                          <option value="8">August</option>
                          <option value="9">September</option>
                          <option value="10">October</option>
                          <option value="11">November</option>
                          <option value="12">December</option>
                        </select>
                      </div>
                      <div class="year col-sm-6 col-xs-12">
                        <select class="form-control" id="date-to-year" name="date-to-year">
                          <option value="">Year</option>
                          @for($i = idate('Y'); $i > 1943; $i--)
                            <option value="{{$i}}">{{$i}}</option>
                          @endfor
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                <div class="col-sm-12 form-group">
                    <label for="exampleFormControlTextarea1">What did you do there?</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="responsabilities" rows="5"></textarea>
                    <small><strong>2000</strong> characters remaining</small>
                </div>
                <div class="update-form-group col-xs-12">
                  <button type="button" class="cancel btn btn-link">Cancel</button>
                  <button type="button" class="save-and-other btn btn-inverse">Save & add other</button>
                  <button type="button" class="save btn btn-submit" id="upload-cv-link">Save</button>
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