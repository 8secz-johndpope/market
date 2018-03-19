<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Your Applications |')

@section('sidebar')
    @parent

    <p></p>
@endsection
@php
    $date = new Datetime();
    $dateMs = $date->getTimestamp();
@endphp
@section('styles')
<link href="{{ asset("/css/search-profiles.css?q=$dateMs") }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="body background-body recruiter-search-profile">
    <div class="container">
        <div class="row search-input-container">
            <div class="col-sm-5">
                <div class="form-group">
                    <input type="text" name="job_title" value="" id="job-title" placeholder="Job title" class="form-control">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <input type="text" name="location" value="" placeholder="Location" class="form-control">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <button class="btn btn-submit">Search</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                 <header>
                    <h3>I am looking for candidates in:</h3>
                </header>
            </div>
        </div>
        <div class="row text-center profile-types-container">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-4 profile-type">
                        General Sector
                    </div>
                     <div class="col-sm-4 profile-type">
                        Social & Childcare Sector
                    </div>
                     <div class="col-sm-4 profile-type">
                        Sub Contractor Sector
                    </div>
                </div>
            </div>
        </div>
        <div class="row bulk-candidates-container">
            <div class="col-xs-12">
            @if(session('status'))
                <div class="alert alert-success">
                    <span>{{session('status')}}</span>
                </div>
            @endif
            </div>
            <div class="col-sm-8">
                <div class="">
                    <input type="checkbox" name="" id="select-all">
                    <label for="select-all">
                        Select all for 
                        <span class="bulk-apply-tm">BulkApplicationRequest<sup>TM</sup></span>
                    </label>
                </div>
            </div>
            <div class="col-sm-4 text-right">
                <button type="button" class="btn btn-submit" data-toggle="modal" data-target="#modalApplicationRequest" data-whatever="all">Bulk Application Request</button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form action="/recruiter/send/application-request/candidates" method="post" id="form-candidates-request">
                    {{ csrf_field() }}
                    <input type="hidden" name="offer_job" id="offer-job">
                    <input type="hidden" name="offer_message" id="offer-message">
                    <div class="candidates-container">
                        @foreach($profiles as $profile)
                        <div class="candidate">
                            <div class="candidate-wrapper">
                                <div class="checkbox">
                                    <input type="checkbox" name="candidate_id[]" id="candidate-{{$profile->id}}" value="{{$profile->id}}" class="candidates-checkbox">
                                    <label for="candidate-{{$profile->id}}">
                                        Select
                                    </label>
                                </div>
                                <div class="candidate-picture">
                                    <figure>
                                        <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$profile->user->image}}">
                                    </figure>
                                </div>
                                <div class="candidate-details-wrapper">
                                    <h3 class="candidate-name"><a href="/job/profile/{{$profile->id}}">{{$profile->user->name}}</a></h3>
                                    @if(isset($profile->user->address))
                                    <p class="candidate-location">{{$profile->user->address->city}}</p>
                                    @endif
                                    @if(isset($profile->looking_for))
                                        @if(isset($profile->looking_for->job_title))
                                        <strong>{{$profile->looking_for->job_title}}</strong>
                                        @endif
                                        @if(isset($profile->looking_for->min_per_annum) && isset($profile->looking_for->min_per_hour))
                                        <p>£{{$profile->looking_for->min_per_annum}} per annum or £{{$profile->looking_for->min_per_hour}} per hour</p>
                                        @elseif(isset($profile->looking_for->min_per_annum))
                                        <p>£{{$profile->looking_for->min_per_annum}} per annum</p>
                                        @elseif(isset($profile->looking_for->min_per_hour))
                                        <p>£{{$profile->looking_for->min_per_hour}} per hour</p>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="candidate-actions text-center">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="box">
                                            <span class="heart-empty favroite-icon"></span>
                                            <span>Save</span>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="box">
                                            <div class="dropdown download-cvs">
                                                <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown"">Download CV<span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    @foreach($profile->user->cvs as $cv)
                                                    <li>
                                                        <a href="{{env('AWS_CV_IMAGE_URL')}}/{{$cv->filename}}" target="_blank" class="download-cv">{{$cv->title}}</a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="box">
                                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalApplicationRequest" data-whatever="{{$profile->id}}">Request Application</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="modalApplicationRequest" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Send Application Request</h4>
      </div>
      <div class="modal-body">
        <form action="/recruiter/send/application-request/candidate" method="post" id="form-candidate-request">
            {{ csrf_field() }}
            <input type="hidden" name="user_profile"  id="profile">
            @if($myJobs->count() > 0)
            <div class="validation alert alert-danger" style="display: none">
                <span></span>                
            </div>
            <div class="form-group">
                <label>Select Job</label>
                <select class="form-control" name="offer_job">
                    <option>Select</option>
                    @foreach($myJobs as $job)
                    <option value="{{$job->id}}">{{$job->param('title')}}</option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="form-group">
                <label>Write Message</label>
                <textarea class="form-control" rows="4"></textarea>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-submit">Send Invitations</button>
      </div>
    </div>

  </div>
</div>
<script>
    $('#select-all').change(function(){
        $('.candidates-checkbox').prop('checked', this.checked);
    });
    $('#modalApplicationRequest').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);
        var request = button.data('whatever');
        if(request == 'all' && $('.candidates-checkbox:checked').length == 0){
            $('.modal-footer .btn-submit').prop('disabled', true);
            $('.modal .validation span').text('Select candidates');
            $('.modal .validation').show();
        }else{
            $('.modal .validation').hide();
            $('.modal-footer .btn-submit').prop('disabled', false);
            var modal = $(this);
            modal.find('#profile').val(request);
        }
    });
    $('.modal-footer .btn-submit').click(function(){
        if($('.modal-body select').val() == ''){
            $('.modal .validation span').text('Select job');
            $('.modal .validation').show();
        }
        else{
            if($('#profile').val() == 'all'){
                $('#offer-job').val($('.modal-body select').val());
                $('#offer-message').val($('.modal-body textarea').val());
                $('#form-candidates-request').submit();
            }
            else{
                $('#form-candidate-request').submit();
            }
        }
    });    
</script>
@endsection