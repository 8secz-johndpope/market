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
          <a href="{{ URL::previous() }}"><i class="glyphicon glyphicon-menu-left"></i>Your profile</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="section">
          <header class="section-header">
            <h2 class="title">Skills & expertise</h2>
          </header>
          <div class="content row">
            <form action="/user/save/skills" method="post" id="portfolio-form" method="post">
              <input name="redirect" id="redirect" type="hidden" value="/job/profile/edit/{{$profile->type}}">
              {{ csrf_field() }}
              <input type="hidden" name="profile" value="{{$profile->id}}">
              <div class="section-skill skill-add clearfix">
                <div class="section-title col-xs-12 col-sm-2">
                  <b>Your skills</b>
                </div>
                <div class="section-content col-xs-12 col-sm-10">
                  <div class="existing-skills">
                    @foreach($profile->skills as $skill)
                    <a href="#" class="lozenge skill">
                      <span class="skill-name">{{$skill->title}}</span>
                      <i class="glyphicon glyphicon-remove"></i>
                      <input type="hidden" name="skills[]" value="{{$skill->title}}">
                    </a>
                    @endforeach
                  </div>
                  <div class="section-value row">
                    <div class="add-form-field form-group col-xs-12 col-sm-10">
                      <span class="twitter-typehead inline">
                        <input type="text" class="form-control inline" placeholder="Add a new skill or expertise" style="position:relative; vertical-align: top;" name="skill" id="skill">
                      </span>
                      <div class="validation">
                        <span>Skill cannot be empty</span>
                      </div>
                    </div>
                    <div class="add-form-action col-xs-2">
                      <a href="#" class="btn btn-link add">
                        <i class="glyphicon glyphicon-plus-sign"></i>
                        Add
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="update-form-group col-xs-12 text-right">
                <p class="text-left">You can add various skills</p>
                <button type="button" class="cancel btn btn-link">Cancel</button>
                <button type="submit" class="save btn btn-submit">Save</button>
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
<script type="text/html" id="template-skill">
  <a href="#" class="lozenge skill">
    <span class="skill-name"></span>
    <i class="glyphicon glyphicon-remove"></i>
    <input type="hidden" name="skills[]" value="">
  </a>
</script>
<script>
  $('.btn.add').click(function(e){
    e.preventDefault();
    var skill = $('#skill').val();
    if(skill != ''){
      var parent = $('.existing-skills');
      var textHtml = $('#template-skill').html();
      $('#skill').val('')
      parent.append(textHtml);
      skillSelector = parent.find('.lozenge:last-child');
      skillSelector.find('.skill-name').text(skill);
      skillSelector.find('input').val(skill);
    }
    else{
      var formGroup = $('#skill').closest('.form-group');
      formGroup.addClass('input-validation-error');
    }
  });
  $(document).on('click', '.skill', function(e){
    e.preventDefault();
    $(this).remove();
  })
</script>
@endsection