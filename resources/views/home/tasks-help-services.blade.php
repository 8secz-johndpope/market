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
        <form action="/user/save/tasks-help-services" method="post">
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
                      <div class="task row">
                        <div class="col-md-2">
                          @for($i=1; $i < 4; $i++)
                          <input type="radio" name="task[{{$task->id}}]" id="{{$task->slug}}-{{$i}}" value="{{$i}}" {{}}>
                          <label for="{{$task->slug}}-{{$i}}"></label>
                          @endfor
                          <input type="radio" name="task[{{$task->id}}]" id="{{$task->slug}}-2" value="2">
                          <label for="{{$task->slug}}-2"></label>
                          <input type="radio" name="task[{{$task->id}}]" id="{{$task->slug}}-1" value="1">
                          <label for="{{$task->slug}}-1"></label>
                        </div>
                        <div class="col-md-10">
                          <span>{{$task->title}}</span>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 availability-inscription">
                <div class="section">
                  <header class="section-header">
                    <h2 class="title">SERVICES OFFERED</h2>
                  </header>
                  <div class="content row">
                    <div class="col-xs-12 part">
                      @foreach($servicesOffered as $service)
                      <div class="form-group">
                        <div class="checkbox checkbox-strar">
                          <input type="checkbox" name="services_offered[]" id="{{$service->slug}}" value="{{$service->id}}" {{($profile->socialcareServiceOffered($service->id) != null) ? 'checked' : ''}}>
                          <label for="{{$service->slug}}">{{$service->title}}</label>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
              </div>
            </div>
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

@endsection