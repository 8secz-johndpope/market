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
                          <div class="field-location">
                            <label for="location">Location</label>
                            <input type="text" name="location" id="location">
                          </div>
                          <div class="field-distance">
                            
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