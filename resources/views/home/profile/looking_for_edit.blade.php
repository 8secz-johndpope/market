<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

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
            <form action="/user/jobs/save/looking-for" method="post">
              <input name="redirect" type="hidden" value="/job/profile/edit/{{$lookingFor->profile->type}}">
              <input name="looking_for_id" type="hidden" value="{{$lookingFor->id}}">
              {{ csrf_field() }}
              <section class="section-job-title row">
                <div class="header col-xs-12 col-sm-3">
                  <h3 class="title">Desired Job</h3>
                </div>
                <div class="section-content col-xs-12 col-sm-6">
                  <fieldset class="form-field valid">
                    <span class="twitter-typehead">
                      <input class="form-control desired-job-title tt-input" value="{{$lookingFor->job_title}}" name="job_title">
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
                    <input class="form-control salary" type="text" name="minimum_salary" id="minimum-salary" placeholder="per annum" value="{{$lookingFor->min_per_annum}}">
                    <small class="type-info">Per annum</small>
                    <div class="validation">
                    </div>  
                  </fieldset>
                  <fieldset class="form-field col-xs-12 col-sm-6">
                    <span class="pound-sign">£</span>
                    <input class="form-control salary" type="text" name="minimum_temp_rate" id="minimum-temp-rate" placeholder="per hour" value="{{$lookingFor->min_per_hour}}">
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
                      @foreach($lookingFor->locations as $location)
                      <li>
                        <span class="location-name">$location->name</span>
                        <input type="hidden" name="prefferedlocation[]" id="prefferedlocation" value="{{$location->id}}">
                        <span class="location-remove small">Remove</span>
                      </li>
                      @endforeach
                    </ul>
                    <div class="add-button">
                      <button class="btn btn-inverse" type="button">
                        <i class="glyphicon glyphicon-plus-sign"></i>
                        <span>Add another location</span>
                      </button>
                    </div>
                    <div class="form-field add-location" style="display: none">
                      <div class="location-container">
                        <div class="inline-input inline">
                          <span class="twitter-typehead inline">
                            <input type="text" name="location" id="pac-input" class="form-control tt-input">
                            <input type="hidden" name="lat" id="lat">
                            <input type="hidden" name="lng" id="lng">
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
                    @foreach($contractTypes as $contractType)
                      @if($contractType->title != '')
                      <div class="checkbox">
                        <input type="checkbox" name="contract_type[]" id="{{$contractType->slug}}-work" value="{{$contractType->id}}" {{($lookingFor->jobTypes->contains($contractType->id))? 'checked' : ''}}>
                        <label for="{{$contractType->slug}}-work">{{$contractType->title}}</label>
                      </div>
                      @endif
                    @endforeach
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
                      <input type="checkbox" name="is_full_time" id="is-full-time" {{($lookingFor->full_time)? 'checked' : ''}}>
                      <label for="is-full-time">Full-time</label>
                    </div>
                    <div class="checkbox">
                      <input type="checkbox" name="is_part_time" id="is-part-time" {{($lookingFor->part_time)? 'checked' : ''}}>
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
                        @foreach($sectorsPreferred as $key => $sectorPreferred)
                        <div class="specialism">
                          <div class="specialism-details row">
                            <div class="data col-xs-6 col-sm-8">
                              <span class="name">{{$sectorPreferred->title}}</span>
                               (
                              <span>{{count($subSectorsPreferred[$key])}} roles</span>
                              )
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
                                  <input type="checkbox" name="edit_subsector[]"  id="edit-subsector-{{$subSector->id}}" value="{{$subSector->id}}" {{in_array($subSector->id, $subSectorsPreferred[$key]) ? 'checked': ''}}>
                                  <label for="edit-subsector-{{$subSector->id}}">
                                    {{$subSector->title}}
                                  </label>
                                </li>
                              @endforeach
                            </ul>
                            <span class="role-action">
                              <button class="update btn btn-inverse btn-inline" type="button">
                                Update
                              </button>
                              <button class="cancel btn btn-link btn-inline">
                                Cancel
                              </button>
                            </span>
                          </div>
                        </div>
                        @endforeach
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
                          <p class="info-sector">
                            Select up to 5 roles
                          </p>
                          <ul class="roles list-unstyled row">
                          </ul>
                          <div class="add-specialism-actions">
                            <p class="warning full" style="display: none">You have selected a maximum number of roles.</p>
                            <p class="warning minimum">You haven't selected enough roles, yet.</p>
                            <button class="add btn btn-inverse btn-inline disabled" type="button">Save roles</button>
                            <button class="cancel btn btn-link btn-inline">Cancel</button>
                          </div>
                        </div>
                        <div>
                          <div class="add-specialism-actions">
                            <button class="cancel btn btn-link btn-inline">Cancel</button>
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
@endsection
@section('scripts')
<script>
  var geocoder;
  var sectors;
  $("#pac-input").autocomplete({
        paramName :'q',
        serviceUrl: '/api/lsuggest',
        onSelect: function (suggestion) {
            $(this).val(suggestion.value);
            $(this).attr('data-ref', suggestion.data);
            //   window.location.href = "{{env('APP_URL')}}/"+suggestion.slug+"?q="+suggestion.value
            // alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
        }
    });
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
          + "<input type=\"checkbox\" name=\"edit_subsector[]" + sectorChildren[i].id + "\" id=\"add-subsector-" + sectorChildren[i].id + "\" value=\""+ sectorChildren[i].id +"\">\n"
          +"<label for=\"add-subsector-"+ sectorChildren[i].id +"\">" + sectorChildren[i].title + "</label>\n"
          +"</li>";
        }
        $('.roles').html(text);
      }
    })
  });
  $(document).on('change', '.roles input[type=checkbox]', function(){
    var countRoles = $('.roles input[type=checkbox]:checked').length;
    if(countRoles >= 1){
      $('.add-specialism-actions button.add').removeClass('disabled');
    }
    else{
      $('.add-specialism-actions button.add').addClass('disabled');
    }
  });
  $('.add-specialism-actions button.add').click(function(){
    var title;
    $('.specialisms-list option:selected').each(function(){
      title = $(this).text();
    });
    var text = '<div class="specialism">' + 
                    '<div class="specialism-details row">'+
                      '<div class="data col-xs-6 col-sm-8">' +
                        '<span class="name">' + title + '</span>'+
                         ' (<span>' + $('.roles input[type=checkbox]:checked').length + ' roles</span>)'+
                      '</div>'+
                      '<div class="edit-specialism-actions small col-xs-6 col-sm-4">'+
                        '<span class="edit">'+
                          '<i class="glyphicon glyphicon-pencil visible-xs-block"></i>'+
                          '<span class="hidden-xs">Edit roles</span>'+
                        '</span>'+
                        '<span class="remove">'+
                          '<i class="glyphicon glyphicon-trash"></i>'+
                        '</span>'+
                      '</div>'+
                    '</div>'+
                    '<div class="edit-roles" style="display: none">'+
                      '<div class="warning" style="display: none">'+
                        'You have selected a maximum number of roles.'+
                      '</div>'+
                      '<p class="warning minimum">'+
                        'You haven\'t selected enough roles, yet.'+
                      '</p>'+
                      '<ul class="role row">'+
                        $('.roles').html()
                       +
                      '</ul>'+
                      '<span class="role-action">'+
                        '<button class="update btn btn-inverse btn-inline" type="button">'+
                          'Update' +
                        '</button>' +
                        '<button class="cancel btn btn-link btn-inline">' +
                          'Cancel' +
                        '</button>' +
                      '</span>' +
                    '</div>' +
                  '</div>';
    $('.selected-specialisms').append(text);
    $('.add-specialism-container').hide();
    $('.more-specialism-actions').show();
    $('.roles input[type=checkbox]:checked').prop('checked', false);
  })
  $(document).on('click', '.edit', function(e){
    $(this).closest('.specialism').find('.edit-roles').show();
    $(this).parent().hide();
    $('.more-specialism-actions').hide();
  });
  $(document).on('click', '.edit-roles .cancel', function(e){
    e.preventDefault();
    $(this).closest('.specialism').find('.edit-roles').hide();
    $('.more-specialism-actions').show();
     $(this).closest('.specialism').find('.edit-specialism-actions').show();
  });
  $(document).on('click', '.location-remove', function(e){
    e.preventDefault();
    $(this).parent().remove();
  });
  $('.add-location button').click(function(e){
    e.preventDefault();
    var location = $("#pac-input").val();
    var idLocation = $("#pac-input").attr('data-ref');
    var text = '<li>\n' +
                    '<span class="location-name">' + location + '</span>\n' 
                    + '<input type="hidden" name="prefferedlocation[]" id="prefferedlocation" value="' + idLocation + '">\n'
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