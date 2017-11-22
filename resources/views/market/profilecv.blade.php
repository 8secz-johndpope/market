<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Josh E. |' . env('APP_NAME'))

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="profile-background">
                    
                </div>
                <div class="profile-header">
                    <div class="top-card">
                        <div class="profile-photo-container">
                            <div class="profile-photo-wrapper">
                                <div class="profile-photo">
                                    <img src="{{env('AWS_WEB_IMAGE_URL')}}/752734721579.jpeg">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="top-card-body">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="row border-outside">
                <div class="col-sm-12 details-agent title">
                    <h3>Contact and Personal Info</h3>
                </div>
                <div class="col-sm-12 details-agent">
                    <div class="personal-details">
                        <p>
                            David H.
                        </p>
                        <address>
                            Blenheim, New Zealand
                        </address>
                        <p><strong>Tel: </strong>0788998878</p>
                        <a href="#" class="btn btn-default">Email</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection