<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

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
          <a href="/job/profile/edit/{{$profile->type}}"><i class="glyphicon glyphicon-menu-left"></i>Your profile</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="section">
          <header class="section-header">
            <h2 class="title">Qualification</h2>
          </header>
          <form action="/user/save/qualification" method="post">
            <input name="redirect" type="hidden" value="/job/profile/edit/{{$profile->type}}">
            <input type="hidden" name="profile" value="{{$profile->id}}">
            {{ csrf_field() }}
          <div class="content row">
              <div class="qualification-type form-group col-xs-12">
                <label for=qualification-type>Type</label>
                <select class="form-control" id="qualification-type" name="qualification_type">
                  <option value="">Select type</option>
                  @foreach($qualificationTypes as $type)
                    <option value="{{$type->id}}">{{$type->name}}</option>
                  @endforeach
                </select>
                <div class="validation"></div>
              </div>
              <div class="qualification-details" style="display: none">
                  <div class="small-container col-xs-12">
                    <div class="institution form-group">
                      <label for="institution-name">Name of university or college</label>
                      <input type="text" name="institution_name" id="institution-name" class="form-control tt-input">
                      <div class="validation">
                      </div>
                    </div>
                    <div class="dates form-group">
                      <div class="row">
                        <div class="date-from col-xs-6">
                          <label for="started-on">From</label>
                          <select class="form-control" id="started-on" name="started_on">
                            <option value="">Start</option>
                            @for($i=idate('Y'); $i > 1967; $i--)
                              <option value="{{$i}}">{{$i}}</option>
                            @endfor
                          </select>
                        </div>
                        <div class="date-to col-xs-6">
                          <label for="ended-on">To</label>
                          <select class="form-control" id="ended-on" name="ended_on">
                            <option value="">to</option>
                            @for($i=idate('Y'); $i > 1967; $i--)
                              <option value="{{$i}}">{{$i}}</option>
                            @endfor
                          </select>
                        </div>
                        <div class="validation col-xs-12">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="subjects col-xs-12">
                    <div class="subject row">
                      <div class="subject-name form-group col-xs-12 col-sm-8">
                        <label for="subject-name">Degree</label>
                        <input type="text" name="subject_name" id="subject-name" class="form-control">
                        <div class="validation">
                        </div>
                      </div>
                      <div class="subject-grade form-group col-xs-12 col-sm-4">
                        <label for="grade-selector">Grade</label>
                        <select class="form-control" name="grade_selector" id="grade-selector">
                          <option value="">Select</option>
                          <option value="1">First</option>
                          <option value="2">2:1</option>
                          <option value="3">2:2</option>
                          <option value="4">Third</option>
                          <option value="5">Pass</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="other col-sm-9 col-xs-12" style="display: none">
                    <label for="grade-description">Grade (Optional)</label>
                    <input type="text" name="grade_description" id="grade-description" class="form-control">
                    <div class="validation"></div>
                  </div>
                  <div class="col-xs-12 text-right">
                    <button type="button" class=" cancel btn btn-inline btn-link">Cancel</button>
                    <button type="submit" class="btn btn-inline btn-submit confirm-button">Confirm</button>
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
@section('scripts')
  @foreach($qualificationTypes as $type)
  <script type="text/html" id="grades-{{$type->id}}">
    <option value="">Select</option>
    @foreach($type->grades as $grade)
      <option value="{{$grade->id}}">{{$grade->name}}</option>
    @endforeach
  </script>
  @endforeach
<script>
  $('.cancel').click(function(){
    window.location.href = $('#redirect').val();
  });
  $('.save-and-other').click(function(){
    $('#redirect').val('/user/create/publication');
    //$('#work-experience-form')[0].reset();
    //$('#work-experience-form').submit();
  });
  $('#qualification-type').change(function(){
    $('#qualification-type option:selected').each(function(){
      var val = $(this).val();
      var container = $('.qualification-details');
      if(val != ''){
        if(val == '32'){
          setOtherGradeForm();
        }
        else if(val == '8'){
          setAGradeForm();
        }
        else if(val == '16'){
          setOtherGCSEForm();
        }
        else if(val == '2' || val == '4'){
          setMasterGradeForm();
        }
        else{
          setDegreeGradeForm();
        }
        container.show();
      }else{
        container.hide();
      }
    });
  });
  function setQualificationIndex(value){
    $('#index-edit-qualification').val(value);
  }
  function setOtherGradeForm(){
    $('[for="subjet-name"]').text('Qualification');
    $('[for="institution-name"]').text('Name of awarding body');
    $('.subject-grade').hide();
    $('.other').show();
  }
  function setOtherGCSEForm(){
    $('[for="subjet-name"]').text('Subject');
    $('[for="institution-name"]').text('School or college');
    var text = $('#grades-16').html();
    $('#grade-selector').html(text);
    $('.subject-grade').show();
    $('.other').hide();
  }
  function setAGradeForm(){
    $('[for="subjet-name"]').text('Subject');
    $('[for="institution-name"]').text('School or college');
    var text = $('#grades-8').html();
    $('#grade-selector').html(text);
    $('.subject-grade').show();
    $('.other').hide();
  }
  function setMasterGradeForm(){
    $('[for="subjet-name"]').text('Degree');
    $('[for="institution-name"]').text('Name of university or college');
    var text = $('#grades-2').html();
    $('#grade-selector').html(text);
    $('.subject-grade').show();
    $('.other').hide();
  }
  function setDegreeGradeForm(){
    $('[for="subjet-name"]').text('Degree');
    $('[for="institution-name"]').text('Name of university or college');
    var text = $('#grades-1').html();
    $('#grade-selector').html(text);
    $('.subject-grade').show();
    $('.other').hide();
  }
</script>
@endsection