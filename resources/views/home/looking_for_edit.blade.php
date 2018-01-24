<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Create your cover letter')

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
    <div class="row looking-for-edit">
      <div class="col-sm-12">
        <div class="section">
          <header class="section-header">
            <h2 class="title">Looking for</h2>
          </header>
          <div class="content row">
            <form action="" method="post">
              <input name="redirect" type="hidden" value="/job/profile/edit">
              {{ csrf_field() }}
              <section class="section-job-title row">
                <div class="header col-xs-12 col-sm-3">
                  <h3 class="title">Desired Job</h3>
                </div>
                <div class="section-content col-xs-12 col-sm-6">
                  <fieldset class="form-field valid">
                    <span class="twitter-typehead">
                      <input class="form-control desired-job-title tt-input" value="Engineer">
                      <div class="tt-dataset">
                        <span class="tt-suggestions">
                          <div class="tt-suggestion tt-selectable">Engineer</div>
                          <div class="tt-suggestion tt-selectable">Engineer Surveyor</div>
                          <div class="tt-suggestion tt-selectable">Engineering</div>
                          <div class="tt-suggestion tt-selectable">Engineering Administrator</div>
                          <div class="tt-suggestion tt-selectable">Engineering Assistant</div>
                        </span>
                      </div>
                    </span>
                  </fieldset>
                </div>
              </section>
              <section class="section-salary row">
                <div class="header col-xs-12 col-sm-3">
                  <h3 class="title">Salary</h3>
                </div>
                <div class="section-content col-xs-12 col-sm-6">
                  <p class="small">Minimum salary (please enter at least one type of salary)</p>
                  <fieldset class="form-field col-xs-12 col-sm-6">
                    <span class="pound-sign">£</span>
                    <input class="form-control salary" type="text" name="minimum-salary" id="minimum-salary" placeholder="per annum">
                    <small class="type-info">Per annum</small>
                    <div class="validation">
                    </div>  
                  </fieldset>
                  <fieldset class="form-field col-xs-12 col-sm-6">
                    <span class="pound-sign">£</span>
                    <input class="form-control salary" type="text" name="minimum-temp-rate" id="minimum-temp-rate" placeholder="per hour">
                    <small class="type-info">Per hour</small>
                    <div class="validation">
                    </div>  
                  </fieldset>
                </div>
              </section>
              <section class="section-locations row">
                <div class="header col-xs-12 col-sm-3">
                  <h3 class="title">Preferred work location</h3>
                </div>
                <div class="section-content col-xs-12 col-sm-9">
                  <div class="locations-selector">
                    <ul class="locations">
                      <li>
                        <span class="location-name">London, South East England</span>
                        <input type="hidden" name="prefferedlocation" id="prefferedlocation">
                        <span class="location-remove small">Remove</span>
                      </li>
                    </ul>
                    <div class="add-button">
                      <button class="btn btn-inverse">
                        <i class="glyphicon glyphicon-plus-sign"></i>
                        <span>Add another location</span>
                      </button>
                    </div>
                    <div class="form-field add-location" style="display: none">
                      <div class="location-container">
                        <div class="inline-input inline">
                          <span class="twitter-typehead inline">
                            <input type="text" name="location" id="location" class="form-control tt-input">
                          </span>
                          <a href="#" class="location-link">
                            <i class="glyphicon glyphicon-map-marker"></i>
                          </a>
                        </div>
                        <button class="btn btn-secondary btn-inline">Add</button>
                      </div>
                      <div class="validation">
                        <span class="field-validation-error">Sorry, we didn't recognise that town, please try again.</span>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <section class="section-job-type row">
                <div class="header col-xs-12 col-sm-3">
                  <h3 class="title">Job type</h3>
                </div>
                <div class="section-content col-xs-12 col-sm-6">
                  <fieldset class="form-field">
                    <div class="checkbox">
                      <input type="checkbox" name="perm-work" id="perm-work">
                      <label for="perm-work">Permanent</label>
                    </div>
                    <div class="checkbox">
                      <input type="checkbox" name="temp-work" id="temp-work">
                      <label for="temp-work">Temporary</label>
                    </div>
                    <div class="checkbox">
                      <input type="checkbox" name="contract-work" id="contract-work">
                      <label for="contract-work">Contract</label>
                    </div>
                    <div class="checkbox"></div>
                  </fieldset>
                  <fieldset class="form-field graduate-jobs">
                    <div class="checkbox">
                      <input type="checkbox" name="is-graduate" id="is-graduate">
                      <label for="is-graduate">Graduate Jobs (Select if you are a recent graduate)</label>
                    </div>
                  </fieldset>
                </div>
              </section>
              <section class="section-hours row">
                <div class="header col-xs-12 col-sm-3">
                  <h3 class="title">Hours</h3>
                </div>
                <div class="section-content col-xs-12 col-sm-9">
                  <fieldset class="form-field">
                    <div class="checkbox">
                      <input type="checkbox" name="is-full-time" id="is-full-time">
                      <label for="is-full-time">Full-time</label>
                    </div>
                    <div class="checkbox">
                      <input type="checkbox" name="is-part-time" id="is-part-time">
                      <label for="is-part-time">Part-time</label>
                    </div>
                  </fieldset>
                </div>
              </section>
              <section class="section-specialisms row">
                <div class="header col-xs-12 col-sm-3">
                  <h3 class="title">Sectors</h3>
                  <small>You may add up to 10 sectors</small>
                </div>
                <div class="section-content col-xs-12 col-sm-9">
                  <div class="specialism-selector">
                    <div class="selected-specialisms">
                      <div>
                        <div class="specialism">
                          <div class="specialism-details row">
                            <div class="data col-xs-6 col-sm-8">
                              <span class="name">IT & Telecoms</span>
                              <span>4 roles</span>
                            </div>
                            <div class="edit-specialism-actions small col-xs-6 col-sm-4">
                              <span class="edit">
                                <i class="glyphicon glyphicon-pencil visible-xs-block"></i>
                                <span class="hidden-xs">Edit roles</span>
                              </span>
                              <span class="remove">
                                <i class="glyphicon glyphicon-trash"></i>
                              </span>
                            </div>
                          </div>
                          <div class="edit-roles" style="display: none">
                            <div class="warning" style="display: none">
                              You have selected a maximum number of roles.
                            </div>
                            <p class="warning minimum">
                              You haven't selected enough roles, yet.
                            </p>
                            <ul class="role row">
                              @foreach($sectorPreferred->children as $subSector)
                                <li class="form-field checkbox col-sm-6 col-xs-12">
                                  <input type="checkbox" name="edit-subsector-{{$subSector->id}}"  id="edit-subsector-{{$subSector->id}}" value="{{$subSector->id}}" {{in_array($subSector->id, $idsSubSectorPreferred) ? 'checked': ''}}>
                                  <label for="edit-subsector-{{$subSector->id}}">
                                    {{$subSector->title}}
                                  </label>
                                </li>
                              @endforeach
                            </ul>
                            <span class="role-action">
                              <button class="update btn btn-inverse btn-inline">
                                Update
                              </button>
                              <button class="cancel btn btn-link btn-inline">
                                Cancel
                              </button>
                            </span>
                          </div>
                        </div>
                        <div class="more-specialism-actions">
                          <button class="add-more-specialism btn btn-inverse">
                            <i class="glyphicon glyphicon-plus-sign"></i>
                            <span>Add another sector</span>
                          </button>
                        </div>
                        <div class="add-specialism-container" style="display: none">
                          <select class="form-control specialisms-list">
                            <option value>Choose your sector...</option>
                            @foreach($jobChildren as $job)
                              <option value={{$job->id}}>{{$job->title}}</option>
                            @endforeach
                          </select>
                          <div style="display: none">
                            <p class="info">
                              Select up to 5 roles
                            </p>
                            <ul class="roles list-unstyled">
                            </ul>
                          </div>
                          <div>
                            <div class="add-specialism-actions">
                              <button class="cancel btn btn-link btn-inline">Cancel</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <div class="action-container">
                <button type="submit" class="btn btn-submit" id="upload-cv-link">Save changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  var geocoder;
  var sectors;
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
  $('.edit').click(function(e){
    $('.edit-roles').show();
    $(this).parent().hide();
    $('.more-specialism-actions').hide();
  });
  $('.edit-roles .cancel').click(function(e){
    e.preventDefault();
    $(this).parent().hide();
    $('.edit-roles').hide();
    $('.more-specialism-actions').show();
    $('.edit-specialism-actions').show();
  });
  function loadSubSectors(){
    sectors = [];
    @foreach($jobChildren as $job)
      sectors[{{$job->id}}] =[
      @foreach($job->children as $subSector)
        { id: {{$subSector->id}}, title : "{{$subSector->title}}" },
      @endforeach
      ]                       
    @endforeach
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