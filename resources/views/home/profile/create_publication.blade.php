<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Add yours publication')

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
            <h2 class="title">Add Publication</h2>
          </header>
          <div class="content row">
            <form action="/user/save/work-experience" method="post" id="work-experience-form" method="post">
                <input name="redirect" id="redirect" type="hidden" value="/job/profile/edit/{{$profile->type}}">
                {{ csrf_field() }}
                <input type="hidden" name="profile_id" value="{{$profile->id}}">
              <div class="small-container col-xs-12 col-sm-9">
                <div class="form-group">
                    <label for="title">Title</label> 
                    <span class="red-text" id="no-title" style="display: none">Please add a title</span>
                    <input type="text" class="form-control" name="title" placeholder="" required>
                </div>
                <div class="form-group">
                  <label for="title">Publication/Publisher</label> 
                  <span class="red-text" id="no-company" style="display: none">Please add the publisher</span>
                  <input type="text" class="form-control" name="publisher" aria-describedby="emailHelp" placeholder="" required>
                </div>
                <div class="form-group">
                  <label for="title">URL</label> 
                  <span class="red-text" id="no-company" style="display: none">Please add the url</span>
                  <input type="text" class="form-control" name="publisher" aria-describedby="emailHelp" placeholder="" required>
                </div>
                <div class="row">
                  <div class="date-from form-group col-sm-8 col-xs-12">
                    <label class="legend" for="date-from-month">From</label>
                    <div class="row">
                      <div class="month col-sm-6 col-xs-12">
                        <select class="form-control" id="date-month" name="date_month">
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
                      <div class="day col-sm-3 col-xs-12">
                        <select class="form-control" id="date-day" name="date_day">
                          <option value="">Day</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17">17</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                          <option value="24">24</option>
                          <option value="25">25</option>
                          <option value="26">26</option>
                          <option value="27">27</option>
                          <option value="28">28</option>
                          <option value="29">29</option>
                          <option value="30">30</option>
                          <option value="31">31</option>
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
                  </div>
                </div>
              </div>
                <div class="col-sm-12 form-group">
                    <label for="exampleFormControlTextarea1">What did you do there?</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="5"></textarea>
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
</script>
@endsection