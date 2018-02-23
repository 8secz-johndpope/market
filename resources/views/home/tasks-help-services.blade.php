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
              <h2 class="title">Task that you can help with</h2>
            </header>
            
              <div class="content row">
                <div class="col-xs-12">
                  <div class="form-group">
                    <div class="tasks-container">
                      @foreach($tasksHelp as $task)
                      <div class="task">
                        <input type="radio" name="{{str_replace("-", "_", $task->slug)}}" id="{{$task->slug}}-3" value="3">
                        <label for="{{$task->slug}}-3"></label>
                        <input type="radio" name="{{str_replace("-", "_", $task->slug)}}" id="{{$task->slug}}-2" value="2">
                        <label for="{{$task->slug}}-2"></label>
                        <input type="radio" name="{{str_replace("-", "_", $task->slug)}}" id="{{$task->slug}}-1" value="1">
                        <label for="{{$task->slug}}-1"></label>
                        <span>{{$task->title}}</span>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @if($profile->type == 'social-childcare')
            <div class="row">
              <div class="col-xs-12 availability-inscription">
                <div class="section">
                  <header class="section-header">
                    <h2 class="title">SERVICES OFFERED</h2>
                  </header>
                  <div class="content row">
                    <div class="col-xs-12 part">
                      <div class="form-group">
                        <div class="checkbox checkbox-strar">
                          <input type="checkbox" name="holiday_availibility" id="holiday_availibility" value="1" {{(isset($profile->availibility) && $profile->availibility->holidays == 1) ? 'checked' : ''}}>
                          <label for="holiday_availibility">Tutoring</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="checkbox checkbox-strar">
                          <input type="checkbox" name="nigth_availibility" id="night_availibility" value="1" {{(isset($profile->availibility) && $profile->availibility->night == 1) ? 'checked' : ''}}>
                          <label for="night_availibility">Pet sitting</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="checkbox checkbox-strar">
                          <input type="checkbox" name="emergency_availibility" id="emergency_availibility" value="1" {{(isset($profile->availibility) && $profile->availibility->emergency == 1) ? 'checked' : ''}}>
                          <label for="emergency_availibility">Housekeeping</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="checkbox checkbox-strar">
                          <input type="checkbox" name="emergency_availibility" id="emergency_availibility" value="1" {{(isset($profile->availibility) && $profile->availibility->emergency == 1) ? 'checked' : ''}}>
                          <label for="emergency_availibility">Childcare</label>
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