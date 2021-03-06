<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

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
            <form action="/user/save/work-experience" method="post" id="work-experience-form">
                <input name="redirect" id="redirect" type="hidden" value="/job/profile/edit/{{$profile->type}}">
                {{ csrf_field() }}
                <input type="hidden" name="profile_id" value="{{$profile->id}}">
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
                        <select class="form-control" id="date-from-month" name="date_from_month">
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
                        <select class="form-control" id="date-from-year" name="date_from_year">
                          <option value="">Year</option>
                          @for($i = idate('Y'); $i > 1943; $i--)
                            <option value="{{$i}}">{{$i}}</option>
                          @endfor
                        </select>
                      </div>
                    </div>
                    <div class="validation">
                      <span>Please enter date you started this position</span>
                    </div>
                  </div>
                  <div class="current-role form-group checkbox col-sm-4 col-xs-12">
                    <input type="checkbox" name="is_current_role" id="is-current-role">
                    <label for="is-current-role">I currently work here</label>
                  </div>
                  <div class="date-to form-group col-sm-8 col-xs-12">
                    <label class="legend" for="date-to-month">To</label>
                    <div class="row">
                      <div class="month col-sm-6 col-xs-12">
                        <select class="form-control" id="date-to-month" name="date_to_month">
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
                        <select class="form-control" id="date-to-year" name="date_to_year">
                          <option value="">Year</option>
                          @for($i = idate('Y'); $i > 1943; $i--)
                            <option value="{{$i}}">{{$i}}</option>
                          @endfor
                        </select>
                      </div>
                    </div>
                    <div class="validation">
                      <span>Please enter validate date you ended this position</span>
                    </div>
                  </div>
                </div>
              </div>
                <div class="col-sm-12 form-group">
                    <label for="exampleFormControlTextarea1">What did you do there?</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="responsabilities" rows="5"></textarea>
                    <small><strong>2000</strong> characters remaining</small>
                </div>
                <div class="update-form-group col-xs-12 text-right">
                  <button type="button" class="cancel btn btn-link">Cancel</button>
                  <button type="button" class="save-and-other btn btn-inverse">Save & add other</button>
                  <button type="submit" class="save btn btn-submit" id="upload-cv-link">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
  $('.cancel').click(function(){
    window.location.href = $('#redirect').val();
  });
  $('.save-and-other').click(function(){
    $('#redirect').val('/user/create/work-experience');
    $('#work-experience-form')[0].reset();
    //$('#work-experience-form').submit();
  });
  $('#is-current-role').change(function(){
    var dateTo = $('.date-to');
    if(this.checked){
      dateTo.hide();
    }else{
      dateTo.show();
    }
  });
  $('#date-from-year').change(function(){
    var date = new Date();
    var month = date.getMonth();
    var year = date.getFullYear();
    var fromMonth = $('#date-from-month').val();
    var fromYear = $(this).val();
    if(year == fromYear){
      if(fromMonth > month){
        $('#date-from-month').val('');
      }
      for(var i= month+1; i < 13; i++){
        $('#date-from-month option[value='+ i +']').attr('disabled', 'true');
      }
    }
    checkDates();
  });
  $('#date-to-year').change(function(){
    var date = new Date();
    var month = date.getMonth();
    var year = date.getFullYear();
    var toMonth = $('#date-to-month').val();
    var toYear = $(this).val();
    if(year == toYear){
      if(toMonth > month){
        $('#date-to-month').val('');
      }
      for(var i= month+1; i < 13; i++){
        $('#date-to-month option[value='+ i +']').attr('disabled', 'true');
      }
    }
    checkDates();
  });
  $('#date-from-month').change(function(){
    var parent = $(this).closest('.form-group');
    parent.removeClass('input-validation-error');
  });
  $('#date-to-month, #date-from-month').change(function(){
    checkDates();
  });
  $('#work-experience-form').submit(function(e){
    var sInputMonth = $('#date-from-month');
    var fromMonth = sInputMonth.val();
    var fromYear = $('#date-from-year').val();
    var toMonth = $('#date-to-month').val();
    var toYear = $('#date-to-year').val();
    if(fromMonth == '' || fromYear == ''){
      e.preventDefault();
      var parent = sInputMonth.closest('.form-group');
      parent.addClass('input-validation-error');
    }
    if(toMonth == '' || toYear == ''){
      $('#is-current-role').prop('checked', true);
      $('.date-to').hide();
    }
  });
  function checkDates(){
    var sFromYear = $('#date-from-year');
    var sFromMonth = $('#date-from-month');
    var sToYear = $('#date-to-year');
    var sToMonth = $('#date-to-month');
    var date = new Date();
    var month = date.getMonth();
    var year = date.getFullYear();
    var fromYear = sFromYear.val();
    var fromMonth = sFromMonth.val();
    var toYear = sToYear.val();
    var toMonth = sToMonth.val();
    if(fromYear != '' && toYear != ''){
      var dateFrom = new Date(fromYear, fromMonth);
      var dateTo = new Date(toYear, toMonth);
      var parent = sToYear.closest('.form-group');
      if(dateTo < dateFrom){
        parent.addClass('input-validation-error');
      }
      else{
        parent.removeClass('input-validation-error');
      }
    }
  }
</script>
@endsection