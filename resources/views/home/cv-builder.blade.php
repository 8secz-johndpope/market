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
          <div class="work-experience-details">
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
                </div>
              </div>
            </form>
          </div>
    @endif
  </div>
</div>
<script>
  var geocoder;
  var sectors;
  $('.cvbuilder-personal-details .btn-submit').click(function(e){
    e.preventDefault();
    window.location.href = '/user/cv-builder/work-experience';
  })
  $('.add-button button').click(function(e){
    e.preventDefault();
    $(this).parent().hide();
    $('.add-location').show();
  });
  $('.location-link').click(function(e){
    e.preventDefault();
    if(navigator.geolocation){
      navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
    }
  });
  $('.more-specialism-actions button').click(function(e){
    e.preventDefault();
    var parent = $(this).parent();
    parent.hide();
    parent.next().show();
  });
  $('.specialisms-list').change(function(){
    $('.specialisms-list option:selected').each(function(){
      var sectorId = $(this).val();
      console.log(sectorId);
      if(sectorId != ""){
        $('.specialisms-list').next().show();
        $('.specialisms-list').next().next().hide();
        loadSubSectors();
        var sectorChildren = sectors[sectorId];
        var text = "";
        for(var i=0; i < sectorChildren.length; i++){
          text += "<li class=\"role form-field checkbox col-xs-12 col-sm-6\">"
          + "<input type=\"checkbox\" id=\"add-subsector-" + sectorChildren[i].id + "\" id=\"add-subsector-" + sectorChildren[i].id + "\" value=\""+ sectorChildren[i].id +"\">\n"
          +"<label for=\"add-subsector-"+ sectorChildren[i].id +"\">" + sectorChildren[i].title + "</label>\n"
          +"</li>";
        }
        $('.roles').html(text);
      }
    })
  });
  $(document).on('click', '.edit', function(e){
    $('.edit-roles').show();
    $(this).parent().hide();
    $('.more-specialism-actions').hide();
  });
  $('.edit-roles .cancel').click(function(e){
    e.preventDefault();
    $('.edit-roles').hide();
    $('.more-specialism-actions').show();
    $('.edit-specialism-actions').show();
  });
  $(document).on('click', '.location-remove', function(e){
    e.preventDefault();
    $(this).parent().remove();
  });
  $('.add-location button').click(function(e){
    e.preventDefault();
    var location = $("#pac-input").val();
    var text = '<li>\n' +
                    '<span class="location-name">' + location + '</span>\n' 
                    + '<input type="hidden" name="prefferedlocation" id="prefferedlocation">\n'
                    + '<span class="location-remove small">Remove</span>\n'
                  +'</li>';
    $('.locations').append(text);
    $("#pac-input").val('');
    $(this).closest('.add-location').hide();
    $('.add-button').show();
  });
  $(document).on('click', '.remove', function(){
    $(this).closest('.specialism').remove();
  });
  $('.add-specialism-container .cancel').click(function(e){
    e.preventDefault();
    $('.add-specialism-container').hide();
    $('.specialisms-list').next().next().show();
    $('.more-specialism-actions').show();
    $('.specialisms-list').next().hide();
  });
  function loadSubSectors(){
    sectors = [];
  }
  function errorFunction(){
    console.log("Geocoder Failed");
  }
  function successFunction(position){
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
    codeLatLng(lat, lng);
  }
  function codeLatLng(lat, lng){
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({latLng: latlng}, function(results, status){
      if(status == google.maps.GeocoderStatus.OK){
        if(results[1]){
          var arrAddress = results;
          console.log(results);
          $.each(arrAddress, function(i, address_component){
            if(address_component.types[0] == 'locality'){
              $('#location').val(address_component.address_components[0].long_name);
              console.log("City: " + address_component.address_components[0].long_name);
            }
          })
        }
        else{
          console.log('no results found');
        }
      }else{
        console.log('Geocoder failed due to:' + status);
      }
    });
  }
</script>
@endsection