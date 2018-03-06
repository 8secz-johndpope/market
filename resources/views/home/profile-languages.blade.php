<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

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
        <form action="/user/save/profile-languages" method="post" id="languages-form">
          <input name="redirect" type="hidden" value="/job/profile/edit/{{$profile->type}}">
          {{ csrf_field() }}
          <input name="profile" type="hidden" value="{{$profile->id}}">
          <div class="section">
            <header class="section-header">
              <h2 class="title">Languages</h2>
            </header>
            <div class="alert alert-info" style="display: none">
              You may only add up to 5 languages
            </div>
            <div class="headers row">
              <span class="left-header small col-xs-12 col-sm-5">
                Add up to 5 languages
              </span>
              @if($profile->languages->count() > 0)
              <span class="right-heaader small hidden-xs col-sm-7">Fluency</span>
              @endif
            </div>
            <div class="languages">
              @foreach($profile->languages as $profileLanguage)
              <div class="language-row row">
                <div class="form-left col-xs-12 col-sm-5">
                  <select class="form-control long" name="languages[0]" value="{{$profileLanguage->language_id}}">
                    @foreach($languages as $language)
                      <option value="{{$language->id}}" {{($profileLanguage->language_id == $language->id) ? 'selected' : ''}}>{{$language->name}}</option>
                    @endforeach
                  </select>
                  <div class="remove-language-container visible-xs-block">
                    <i class="">Remove</i>
                  </div>
                  <div class="fluency-label-mobile col-xs-12 visible-xs-block">Fluency</div>
                </div>
                <div class="form-right col-xs-12 col-sm-7">
                  <div class="form-group">
                    <div class="radio">
                      <input type="radio" id="fluency-low-0" name="levels[0]" value="1" {{($profileLanguage->level == 1) ? 'checked' : '' }}>
                      <label for="fluency-low-0">
                        Basic
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="radio">
                      <input type="radio" id="fluency-mid-0" name="levels[0]" value="2" {{($profileLanguage->level == 2) ? 'checked' : '' }}>
                      <label for="fluency-mid-0">
                        Intermediate
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="radio">
                      <input type="radio" id="fluency-hig-0" name="levels[0]" value="3" {{($profileLanguage->level == 3) ? 'checked' : '' }}>
                      <label for="fluency-hig-0">
                        Fluent
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
            <span class="add-language btn btn-inverse">
              Add language
            </span>
          </div>
          <div class="action-container">
            <button type="button" class="btn-inverse">Cancel</button>
            <button type="submit" class="btn btn-submit">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/html" id="language-template">
  <div class="language-row row">
    <div class="form-left col-xs-12 col-sm-5">
      <div class="form-group">
      <select class="form-control long">
        <option value="">Choose a language..</option>
        @foreach($languages as $language)
          <option value="{{$language->id}}">{{$language->name}}</option>
        @endforeach
      </select>
      <div class="validation">
        <span>Select language</span>
      </div>
    </div>
      <div class="remove-language-container visible-xs-block">
        <i class="">Remove</i>
      </div>
      <div class="fluency-label-mobile col-xs-12 visible-xs-block">Fluency</div>
    </div>
    <div class="form-right col-xs-12 col-sm-7">
      <div class="form-group">
        <div class="radio">
          <input type="radio" id="fluency-low" name="language_fluency[0]" value="1" checked="">
          <label for="fluency-low">
            Basic
          </label>
        </div>
      </div>
      <div class="form-group">
        <div class="radio">
          <input type="radio" id="fluency-mid" name="language_fluency[0]" value="2">
          <label for="fluency-mid">
            Intermediate
          </label>
        </div>
      </div>
      <div class="form-group">
        <div class="radio">
          <input type="radio" id="fluency-hig" name="language_fluency[0]" value="3">
          <label for="fluency-hig">
            Fluent
          </label>
        </div>
      </div>
    </div>
</script>
@endsection
@section('scripts')
<script>
  $('.add-language').click(function(){
    var total = $('.language-row').length;
    if(total < 5){
      var text = $('#language-template').html();
      $('.languages').append(text);
      var newInput = $('.language-row:last-child').find('input');
      var newSelect = $('.language-row:last-child').find('select');
      newSelect.attr('name', 'languages['+ total +']');
      newSelect.attr('id', 'fluency-mid-'+ total);
      $('#fluency-low').attr('id', 'fluency-low' + total);
      $('label[for=fluency-low]').attr('for', 'fluency-low' + total);
      $('#fluency-mid').attr('id', 'fluency-mid' + total);
      $('label[for=fluency-mid]').attr('for', 'fluency-mid' + total);
      $('#fluency-hig').attr('id', 'fluency-hig' + total);
      $('label[for=fluency-hig]').attr('for', 'fluency-hig' + total);
      newInput.attr('name', 'levels['+ total +']');
    }
  });
  $('#languages-form').submit(function(e){
    $('select').each(function(){
      if($(this).val() == ''){
        console.log('some');
        e.preventDefault();
        var parent = $(this).closest('.form-group');
        parent.addClass('input-validation-error');
      }
    })
  });
</script>
@endsection