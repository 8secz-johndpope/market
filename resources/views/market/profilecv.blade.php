<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Josh E. |' . env('APP_NAME'))

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <link href="{{ asset('/css/profile.css?q=874') }}" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="profile-background">
                    <div class="profile-background-container">
                        <img src="https://media.licdn.com/media/AAEAAQAAAAAAAArWAAAAJDE4ZTYwOTg3LTI5NTUtNDcwOS05N2E3LWNjNWJkNDRiYTI1OA.jpg">
                    </div>
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
                        <div class="top-card-body">
                            <div class="top-card-info">
                                <div class="align-items-center">
                                    <h1>David H.</h1>
                                </div>
                                <h2>Blenheim, New Zealand</h2>
                            </div>
                            <div class="top-card-buttons">
                                <p>Looking for:</p>
                                <ul class="looking-for">
                                    <li>IT</li>
                                    <li>Chef</li>
                                    <li>Driver</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            <!-- div info-content -->
                <div class="col-md-8 col-sm-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="tabs">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-overview">Overview</a></li>
                                    <li><a data-toggle="tab" href="#tab-about">About Me</a></li>
                                    <li><a data-toggle="tab" href="#tab-work">Works</a></li>
                                    <li><a data-toggle="tab" href="#tab-contact">Contact Us</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-overview" class="tab-pane fade in active">
                                        <div class="tab-vert">
                                            <button class="tablinks">Resume</button>
                                            <button class="tablinks">Area</button>
                                            <button class="tablinks">Cover</button>
                                            <button class="tablinks">Charges</button>
                                        </div>
                                        <div id="resume" class="tabcontent">
                                           <p>
                                            I specialize in Python but have worked with Lua, PHP, C, JavaScript, and others, in fields from web development to machine learning to systems integration.
                                            <br>I have worked as a software engineer, team lead, and technical director at various points in the past decade and am now fully committed to consulting.<br>
                                            My recent work includes: SaaS & API development in Python, machine learning, systems integration for legacy systems, mobile app and game development, PLC programming with Lua, Twilio, Twitter, Stripe and other API dev, and much more.
                                            <br>
                                            My past work includes being technical lead at an academic social network startup, engaging in a broad array of web development with backends in Python, PHP, and C, providing ecommerce solutions, web interfaces for proprietary hardware, desktop software for OSX and Windows, among others.
                                            <br>
                                            I have experience both working remotely and managing remote workers across several time zones, and have worked with clients from around the globe
                                           </p> 
                                        </div>
                                        <div id="area" class="tabcontent">
                                            
                                        </div>
                                        <div id="cover" class="tabcontent">
                                            
                                        </div>
                                        <div id="charge" class="tabcontent">
                                            
                                        </div>
                                    </div>
                                    <div id="tab-about" class="tab-pane fade">
                                        <div class="tab-vert">
                                            <button class="tablinks">Why me</button>
                                            <button class="tablinks">What i do</button>
                                            <button class="tablinks">Reviews & ratings</button>
                                            <button class="tablinks">Recommendations</button>
                                        </div>
                                        <div id="why-me" class="tabcontent">
                                            
                                        </div>
                                        <div id="what-i-do" class="tabcontent">
                                            
                                        </div>
                                        <div id="reviews-ratings" class="tabcontent">
                                            
                                        </div>
                                        <div id="recommendations" class="tabcontent">
                                            
                                        </div>
                                    </div>
                                    <div id="tab-work" class="tab-pane fade">
                                        <div class="tab-vert">
                                            <button class="tablinks">Protfolio</button>
                                            <button class="tablinks">Publications</button>
                                            <button class="tablinks">Pictures</button>
                                        </div>
                                        <div id="portfolio" class="tabcontent">
                                            
                                        </div>
                                        <div id="publications" class="tabcontent">
                                            
                                        </div>
                                        <div id="pictures" class="tabcontent">
                                            
                                        </div>
                                    </div>
                                    <div id="tab-contact" class="tab-pane fade">
                                        <div class="tab-vert">
                                            <button class="tablinks">Contact me</button>
                                            <button class="tablinks">Make an offer</button>
                                            <button class="tablinks">Request my application</button>
                                        </div>
                                        <div id="contact-me" class="tabcontent">
                                            
                                        </div>
                                        <div id="make-offer" class="tabcontent">
                                            
                                        </div>
                                        <div id="req-application" class="tabcontent">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
</div>
@endsection