<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.business')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<div class="body background-color">
  <div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="notification-pages">
              <div class="notification-page selected">
                <form id="add_notifications" action="" name="add_notifications">
                  <div class="field-id">
                    <input type="hidden" name="id">
                  </div>
                  <div class="create-alert-home">
                    <div class="notification-title">
                      <h2>Create new Job Alert</h2>
                    </div>
                    <div class="notification-modify-form">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="field-reference">
                            <label for="reference">
                              Alert Name <span>(For your reference)</span>
                            </label>
                            <input type="text" name="reference" id="reference" class="form-control">
                          </div>
                          <div class="field-keywords">
                            <label for="keywords">
                              Keywords <span>(e.g. receptionist)</span>
                            </label>
                            <input type="text" name="keywords" id="keywords" class="form-control">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="row">
                            <div class="col-sm-7">
                              <div class="field-location">
                                <label for="location">Location</label>
                                <input type="text" name="location" id="location">
                              </div>
                            </div>
                            <div class="col-sm-5">
                              <div class="field-distance">
                                <label for="distance">Within</label>
                                <select name="distance" id="distance">
                                  <option value="1" id="distance.0">1 mile</option>
                                  <option value="2" id="distance.1">2 miles</option>
                                  <option value="5" id="distance.2">5 miles</option>
                                  <option value="7" id="distance.3">7 miles</option>
                                  <option value="10" id="distance.4">10 miles</option>
                                  <option value="15" id="distance.5">15 miles</option>
                                  <option value="20" id="distance.6" selected="selected">20 miles</option>
                                  <option value="25" id="distance.7">25 miles</option>
                                  <option value="35" id="distance.8">35 miles</option>
                                  <option value="50" id="distance.9">50 miles</option>
                                  <option value="75" id="distance.10">75 miles</option>
                                  <option value="100" id="distance.11">100 miles</option>
                                  <option value="250" id="distance.12">250 miles</option>
                                  <option value="500" id="distance.13">500 miles</option>
                                  <option value="750" id="distance.14">750 miles</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
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