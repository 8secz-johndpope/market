<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Build your CV')

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
        <h2 class="cvbuilder-personal-details-title">Build your CV</h2>
        <div class="steps-container">
          <ul class="steps" id="cvbuilder-steps" data-total-steps="4">
            <li class="step step-current" data-step="1">
              <span class="sign"></span>
              <span class="name">Details</span>
            </li>
            <li class="step" data-step="2">
              <span class="sign"></span>
              <span class="name">Work experience</span>
            </li>
            <li class="step" data-step="3">
              <span class="sign"></span>
              <span class="name">Qualifications</span>
            </li>
            <li class="step" data-step="4">
              <span class="sign"></span>
              <span class="name">Personal statement</span>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-sm-12">
        <div class="back-link">
          <a href="{{ URL::previous() }}"><i class="glyphicon glyphicon-menu-left"></i>Back</a>
        </div>
      </div>
    </div>
    @if($slug === 'personal-details')
    <div class="row cvbuilder-personal-details">
      <div class="col-sm-12">
        <div class="section">
          <div class="row">
            <div class="col-xs-12">
              <div class="alert alert-info text-center">
                <h4>Allow companies to contact you when you apply to their jobs.</h4>
                <p>Please fill in all the blank fields.</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="section-title">
                <h2>Details about you</h2>
              </div>
            </div>
          </div>
          <form action="" method="post">
              <input name="redirect" type="hidden" value="/job/profile/edit">
              {{ csrf_field() }}
            <div class="content row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="pre-filled" for="first-name">First name</label>
                  <input class="form-control" type="text" name="first-name" id="first-name" value="{{$user->name}}">
                  <div class="validation">
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="pre-filled" for="last-name">Last name</label>
                  <input class="form-control" type="text" name="last-name" id="last-name">
                  <div class="validation">
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="pre-filled" for="email">Email</label>
                  <input class="form-control" type="email" name="email" id="email" value="{{$user->email}}">
                  <div class="validation">
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="pre-filled" for="phone">Phone</label>
                  <input class="form-control" type="phone" name="phone" value="{{$user->phone}}">
                  <div class="validation">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
            <div class="col-xs-12">
              <div class="section-title">
                <h2>Your address</h2>
              </div>
            </div>
          </div>
          <div class="content row">
            <div class="col-xs-12">
              <div class="address-area">
                <div class="form-group">
                  <label class="pre-filled" for="address">Address</label>
                  <input class="form-control" type="address" name="address" value="">
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <label class="pre-filled" for="town">Town</label>
                  <input class="form-control" type="town" name="town" value="">
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <label class="pre-filled" for="country">Country</label>
                  <select name="country" id="country" disabled class="form-control">
                    <option value="uk">United Kingdom</option>
                  </select>
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <label class="pre-filled" for="postcode">Postcode</label>
                  <input class="form-control" type="postcode" name="postcode">
                  <div class="validation"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-5 col-sm-offset-2">
              <button class="btn btn-inverse" type="button">Save and continue later</button>
            </div>
            <div class="col-xs-12 col-sm-5">
              <button class="btn btn-submit" type="submit">Continue</button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
    @elseif($slug === 'work-experience')
    <div class="row cvbuilder-work-experience">
      <div class="col-sm-12">
        <div class="section">
          <div class="row">
            <div class="col-xs-12">
              <div class="alert alert-info text-center">
                <h4>Let companies know where you’ve worked and when.</h4>
                <p>Please fill in all the blank fields.</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="section-title">
                <h2>Your work experience</h2>
              </div>
            </div>
          </div>
          <div class="form-field checkbox">
            <input type="checkbox" name="no-work-experience" id="no-work-experience">
            <label for="no-work-experience">I have no work experience</label>
          </div>
          <div class="work-experience">
            <div class="work-experience-container">
            </div>
            <div class="add-button-container text-right">
              <button type="button" class="btn btn-secondary add-work-experience">Add work experience</button>
            </div>
          </div>
          <div class="work-experience-details" style="display: none">
            <form action="" method="post" id="work-experience-form">
              <input name="redirect" type="hidden" value="/job/profile/edit">
              {{ csrf_field() }}
              <div class="content row">
                <div class="col-sm-12">
                  <h5 class="work-experience-form-title"><span>Add</span> work experience</h5>
                  <div class="job-title form-group">
                    <label for="job-title">Job title</label>
                    <input class="form-control tt-input" id="job-title" name="job-title" type="text">
                    <div class="validation"></div>
                  </div>
                  <div class="company form-group">
                    <label for="company">Company</label>
                    <input type="text" name="company" id="company" class="form-control tt-input">
                    <div class="validation"></div>
                  </div>
                  <div class="date-from group form-group date-group">
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
                          @for($i = 2018; $i > 1943; $i--)
                            <option value="{{$i}}">{{$i}}</option>
                          @endfor
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="current-role form-group checkbox">
                    <input type="checkbox" name="is-current-role" id="is-current-role" value="true">
                    <label for="is-current-role">I currently work here</label>
                    <div class="validation"></div>
                  </div>
                  <div class="date-to form-group date-group">
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
                          @for($i = 2018; $i > 1943; $i--)
                            <option value="{{$i}}">{{$i}}</option>
                          @endfor
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="responsabilities form-group">
                    <label for="exampleFormControlTextarea1">What did you do there?</label>
                    <div class="value">
                      <textarea class="form-control" id="exampleFormControlTextarea1" name="responsabilities" rows="5"></textarea>
                    </div>
                    <div class="character-count">
                      <small><strong>2000</strong> characters remaining</small>
                    </div>
                    <div class="validation">
                    </div>
                  </div>
                </div>
                <div class="text-right">
                  <button type="button" class=" cancel btn btn-inline btn-link">Cancel</button>
                  <button type="button" class="btn btn-inline btn-submit confirm-work-experience-button">Confirm</button>

                </div>
              </div>
              <div class="row actions-btns-cv-builder">
                <div class="col-xs-12 col-sm-5 col-sm-offset-2">
                  <button class="btn btn-inverse" type="button">Save and continue later</button>
                </div>
                <div class="col-xs-12 col-sm-5">
                  <button class="btn btn-submit" type="submit">Continue</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>
</div>
<script>
  $('.cvbuilder-personal-details .btn-submit').click(function(e){
    e.preventDefault();
    window.location.href = '/user/cv-builder/work-experience';
  })
  $('.add-work-experience').click(function(){
    $(this).parent().hide();
    $('#no-work-experience').parent().hide();
    $('.work-experience-details').show();

  });
  $('.cancel').click(function(){
    $('.work-experience-details').hide();
    $('#no-work-experience').parent().show();
    $('.add-work-experience').parent().show();
  });
  
</script>
@endsection