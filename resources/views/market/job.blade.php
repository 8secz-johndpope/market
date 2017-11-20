<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.home')

@section('title', $product['title'] . ' | '. env('APP_NAME'))

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<link href="{{ asset('/css/jobs.css?q=874') }}" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-md-2 back">
            <a class="" href="{{ url()->previous()}}">< Back to search</a>
        </div>
        <div class="col-md-8 col-sm-12">
            <ol class="breadcrumb">
                @foreach($parents as $parent)
                <li class="breadcrumb-item"><a href="/{{$parent->slug}}">{{$parent->title}}</a></li>
                @endforeach
                <li class="breadcrumb-item"><a href="/{{$category->slug}}">{{$category->title}}</a></li>
            </ol>
        </div>
        <div class="col-md-2 prev-next">
            @if(isset($prevAdvert))
                <a href="/p/{{$category->id}}/{{$prevAdvert->id}}"> < Prev</a>
            @endif
            @if(isset($nextAdvert))
                <a href="/p/{{$category->id}}/{{$nextAdvert->id}}"> Next > </a>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-12">
            <!-- search -->
            <div class="row">
                @if($advert->user!==null)
                <div class="col-md-12">
                    <div class="details">
                        <h3>This Advert is marketed by</h3>
                        
                        <div class="profile-picutre">
                            <img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$advert->user->image}}">
                        </div>
                        <div class="user-details">
                            <p><strong>{{$advert->user->name}}</strong></p>
                            <address>
                            @if(isset($advert->user->address))
                            {{$advert->user->address->line1}}, {{$advert->user->address->city}}, {{$advert->user->address->postcode}}  
                            @endif    
                            </address>
                            <p class="link-about"><a class="btn btn-default" href="/agent/{{$advert->user->id}}">Learn more about the Advertiser</a></p>
                            <p><a class="advert-user" href="/userads/{{$advert->user->id}}">View other adverts from this Advertiser</a></p>
                        </div>
                    </div>
                </div>
                @else
                    <ul class="list-group">
                        <li class="list-group-item"><h4>{{$product['username']}}</h4></li>
                    </ul>
                @endif
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="report border-bottom-dashed">
                        <h3>Report this Ad</h3>
                        <a href="#" class="btn btn-default">Report</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="similar-adverts">
                        <h3>Similar Jobs</h3>
                        <div class="listings-adverts">
                        @foreach($products as $p)
                        <a href="/p/{{$category->id}}/{{$product['source_id']}}">
                            <div class="col-sm-12 border-bottom-dashed">
                                <div class="advert-details">
                                    <h4>{{$p['title']}}</h4>
                                    <p>{{$p['location_name']}}</p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="similar-adverts">
                        <h3>Recommended Course</h3>
                        <div class="listings-adverts">
                        <a href="#">
                            <div class="col-sm-12 border-bottom-dashed">
                                <div class="advert-details">
                                    <h4>Diploma of Childcare (Nany)</h4>
                                    <p>Online, self-paced</p>
                                    <p>Enquire now for pricing information</p>
                                </div>
                            </div>
                        </a>
                        <a href="#">
                            <div class="col-sm-12 border-bottom-dashed">
                                <div class="advert-details">
                                    <h4>Certificate in Childcare & Nannyng Training - Accredited by CPD</h4>
                                    <p>Online, self-paced</p>
                                    <p>£29.00</p>
                                </div>
                            </div>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-12">
            <div class="row">
                <!-- <div class="col-md-12 buttons-filters">
                    <a class="btn">All lastest jobs</a>
                    <a class="btn">Permanent</a>
                    <a class="btn">Tempory</a>
                    <a class="btn">Weekend</a>
                    <a class="btn">Search recruiters</a>
                    <a class="btn">Get job Alerts</a>
                </div>
                <div class="col-md-12 alerts">
                    <p>Set your jobs search alerts, click below to:</p>
                    <div class="buttons-alerts">
                        <a class="btn">Email Alert</a>
                        <a class="btn">Mobile Alert</a>
                    </div>
                </div> -->
                <div class="col-md-12 border-top-left-right">
                    <div class="company-img center-block">
                        <img src="">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 border-left-right">
                    <div class="job-details">
                        <div class="job-title">
                            <div class="job-criteria">
                                Title
                            </div>
                            <div class="job-detail">
                                <h2 class="item-name">{{$product['title']}}</h2>
                            </div>
                        </div>
                        <div class="job-criteria">
                            Salary/Rate
                        </div>
                        <div class="job-detail">
                            {{isset($metas['salary_rate']) ? $metas['salary_rate']:'£40,000/annum + Benefits'}}
                        </div>
                        <div class="job-criteria">
                            Location
                        </div>
                        <div class="job-detail">
                            {{$product['location_name']}}
                        </div>
                        <div class="job-criteria">
                            Posted
                        </div>
                        <div class="job-detail">
                            {{$advert->created_at->format('d F Y')}}
                        </div>
                        <div class="job-criteria">
                            Company
                        </div>
                        <div class="job-detail">
                        @if($advert->user)
                            {{isset($advert->user->business)? $advert->user->business->name : $advert->user->name}}
                            @endif
                        </div>
                        <div class="job-criteria">
                            Description
                        </div>
                        <div class="job-detail">
                            {!! $product['description'] !!}

                        </div>
                        <div class="job-criteria">
                            Type
                        </div>
                        <div class="job-detail">
                            Permanent
                        </div>
                        <div class="job-criteria">
                            Start Date
                        </div>
                        <div class="job-detail">
                            Immediate
                        </div>
                        <div class="job-criteria">
                            Contract Length
                        </div>
                        <div class="job-detail">
                            N/A
                        </div>
                        <div class="job-criteria">
                            Contact Name
                        </div>
                        <div class="job-detail">
                            Login or register to view
                        </div>
                        <div class="job-criteria">
                            Telephone
                        </div>
                        <div class="job-detail">
                            Login or register to view
                        </div>
                        <div class="job-criteria">
                            Job reference
                        </div>
                        <div class="job-detail">
                            0611FEDLONDON
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 bottom-buttons">
                    <a class="btn">Save</a>
                    <a class="btn">Call</a>
                    <a class="btn">VideoCall</a>
                    <a class="btn">Email</a>
                </div>
                <div class="col-md-12 col-sm-12 border-top">
                    <div class="jobs-apply">
                        <h2>Apply for {{$product['title']}}</h2>
                    </div>
                </div>
                @if (Auth::guest())
                <div class="col-md-12 col-sm-12 border-top-left-right">
                    <div class="jobs-apply">
                       
                        <span>Alredy uploaded your CV? <a href="/user/redirect/{{$advert->id}}">Sign in</a> to apply instantly</span>
                    </div>
                </div>
                @endif
                <div class="col-md-12 col-sm-12 border background-color">
                    <div class="form-group">
                        @if (Auth::guest())
                        <div class="row">
                            <div class="col-md-6">
                                <div class="field">
                                    <label for="first-name">
                                        First name
                                        <span class="field-indicator-required">
                                            <i data-icon="*" class="icon-required"></i>
                                        </span>
                                    </label>
                                    <input type="text" name="first-name" id="first-name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="field">
                                    <label for="last-name">
                                        Last name
                                        <span class="field-indicator-required">
                                            <i data-icon="*" class="icon-required"></i>
                                        </span>
                                    </label>
                                    <input type="text" name="last-name" id="last-name" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="field">
                                    <label for="email">
                                        Email address
                                        <span class="field-indicator-required">
                                            <i data-icon="*" class="icon-required"></i>
                                        </span>
                                    </label>
                                    <input type="text" name="email" id="email" required>
                                </div>
                                <hr>
                            </div>
                        </div>
                        @elseif(count(Auth::user()->cvs)>0)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="field">
                                    <label for="selected-cv" class="h3">
                                        Select a CV
                                    </label>
                                    <select class="form-control" name="cv" required id="selected-cv">
                                        <option value="0">Select</option>
                                        @foreach(Auth::user()->cvs as $cv)
                                            <option value="{{$cv->id}}">{{$cv->title}}</option>
                                        @endforeach
                                    </select> 
                                </div>     
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="field">
                                    <label for="upload-cv" class="h3">
                                        Upload your CV
                                    </label>
                                    <div class="upload-container">
                                        <p>Upload from cumputer or mobile phone</p>
                                        <div class="icon-before">
                                            <input type="file" name="upload-cv" id="upload-cv">
                                        </div>
                                        <p>Or upload from one of the following</p>
                                        <div class="buttons-cloud">
                                            <a href="#" class="btn btn-form btn-dropbox">Dropbox</a>
                                            <a href="#" class="btn btn-form btn-onedrive">OneDrive</a>
                                            <a href="#" class="btn btn-form btn-googledrive">Google Drive</a>
                                        </div>
                                    </div>
                                    <p><small>Your CV must be a .doc, .pdf, rtf, and no bigger than 1MB</small></p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="field">
                                    <span class="h3">Cover message or cover letter for {{$product['title']}}</span>
                                    <div class="cover-letter-container">
                                        <p>Choose from:</p>
                                        <div class="buttons-option-cover">
                                            <a href="" class="btn btn-form btn-profile">Profile</a>
                                            <a href="" class="btn btn-form btn-saved">Saved cover letter</a>
                                            <a href="" class="btn btn-form btn-new">Write new</a>
                                        </div>
                                        <div class="cover-write">
                                            <label for="cover-message"> 
                                                Your covering message
                                            </label>
                                            <textarea id="cover-message" name="cover-message" placeholder="Write your application covering message here or copy and paste from a document."> 
                                            </textarea>
                                            <p class="small text-right">4000 characters left</p>
                                             <input type="hidden" name="ctitle" value="{{$advert->category->title}}">
                                             <input type="hidden" name="ccategory" value="{{$advert->category->id}}">
                                        </div>
                                        @if(!Auth::guest() && count(Auth::user()->covers)>0)
                                        <div class="cover-select">
                                            <label for="cover">Select a Cover Letter</label>
                                            <select class="form-control" name="cover" id="cover" required>
                                                <option value="0">Select</option>
                                                @foreach(Auth::user()->covers as $cover)
                                                    <option value="{{$cover->id}}">{{$cover->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @endif
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="field">
                                     <div class="checkbox">
                                          <input type="checkbox" name="email-me" id="email-me" value="true" checked="checked">
                                          <label for="email-me">Email me jobs like this one when they become available</label>  
                                     </div>
                                </div>
                                <p>
                                    <small>
                                        By applying for a job listed on {{ env('APP_NAME')  }} Jobs you agree to our <a href="#">terms and conditions</a> and <a href="#">privacy policy</a>. You should never be to provide bank account details. If you are, please <a href="#">email us</a>.
                                    </small>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="field button-submit">
                                     <input class="btn-form" type="submit" name="submit-cv" id="submit-cv" value="Send application">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 safe-jobs">
                    <p>
                        <small>Remember: You should never send cash or cheques to a prospective employer, or provide your bank details or any other financial information. We pay great attention to vetting all jobs that appear on our site, but please get in touch if you see any roles asking for such payments or financial details from you. For more information on conducting a safe job hunt online, visit safer-jobs.</small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#check-button").click(function () {
        var id =$('#id').val();
        var postcode=$('#postcode').val();
        axios.get('/user/p/deliver/'+id, {
            params: {postcode: postcode}
        })
            .then(function (response) {
                console.log(response);
                if(response.data.can){
                    $('#delivery-info').show();
                    $('#postcode-text').html(postcode);
                    $('#check-div').hide();
                    $('#s-info').hide();
                }else{
                    $('#sorry-info').show();
                }

            })
            .catch(function (error) {
                console.log(error);

            });
    });
    $('#edit-post').click(function () {
        $('#check-div').show();
        $('#delivery-info').hide();
    });
    $('#upload-cv').change(function () {
        upload_cv();
    });
    $('.btn.btn-new').click(function(e){
        e.preventDefault();
        $('.active-cover').removeClass('active-cover');
        $('.cover-write').addClass('active-cover');
    });
    $('.btn.btn-saved').click(function(e){
        e.preventDefault();
        $('.active-cover').removeClass('active-cover');
        $('.cover-select').addClass('active-cover');
    })
</script>



@endsection
