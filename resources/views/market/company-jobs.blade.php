<!-- Stored in resources/views/child.blade.php -->
@php
use App\Model\Advert;
@endphp
@extends('layouts.home')

@section('title', $category->title)

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('next-search')
    
@endsection

@section('content')


<div class="listings background-body">
    <div class="container-fluid">
        <div class="row">
            <div class="banner">
                
            </div>
        </div>
        <div class="row">
        <div class="all">
            <div class="top-bar visible-xs">
                <a class="filter-button btn btn-default">Filter</a>
            </div>
    <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="filter-container">
            <div class="all-filters">
                <div class="l-visible-large">
                    <h4>Jobs at Uber</h4>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="/jobs/london">See all companies</a>
                        </li>
                    </ul>
                </div>
                <div class="l-visible-large">
                    <h4>Job Level</h4>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="#">Internship</a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">Mid Level</a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">Entry Level</a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">Senior Level</a>
                        </li>
                    </ul>
                </div>
                <div class="l-visible-large">
                    <h4>Company Size</h4>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="#">Small</a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">Medium</a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">Large</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<div class="col-lg-7 col-sm-9 col-xs-12">
    <div class="products">
        <h4 class="items-box-head">
            List of items for Uber, 8
        </h4>
        <div class="listing-max-pro container-set-alarm clearfix">
            <div class="search-alert-div text-center">
                <a class="btn search-alert" href="/user/create/alert/{{$category->id}}?id={{$location->id}}"><span class="glyphicon glyphicon-bell"></span>&nbsp;&nbsp;Set Search Alert </a>
            </div>
        </div>
        <!-- <div class="listing-max-pro container-emailme">
            <div class="container-emailme-header text-center">
                <h3>Let Us Help With Your Search</h3>
            </div>
            <div class="container-emailme-form text-center">
                <p>Submit and sit back. We'll send you opportunities you'll actually love and some helpful advice to help make the search stress free.</p>
                <div class="row">
                    <div class="col-sm-offset-2 col-sm-8">
                        <form action="" id="sendme-search">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="email-sendme">Email</span>
                                    <input type="text" class="form-control" placeholder="example@email.com" aria-describedby="email-sendme">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" id="phone-sendme">Mobile</span>
                                    <input type="text" class="form-control" placeholder="00447777777777" aria-describedby="phone-sendme">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit-sendme" class="btn btn-submit">
                            </div>
                        </form>
                    </div>
                </div>
                <small>By clicking Submit, you accept our <a>Terms & Conditions</a>, <a>Privacy policy</a> and consent to messages</small>
            </div>
        </div> -->
        <div class="listing-max-pro">
            <div class="product">
                <div class="info margin-left">
                    <div class="favor">
                        <span class="heart-empty favroite-icon" data-id="">
                        </span>
                        <span  class="favor-text">SAVE</span>
                    </div>
                    <a class="listing-product" href="/jobs/uber/safe-lead-uki">
                        <h4 class="product-title">Safe Lead UKI</h4>
                    </a>
                    <span class="listing-location">
                        London, United Kingdom
                    </span>
                    <div class="link-details">
                        <a href="/jobs/uber/safe-lead-uki">> VIEW FULL POSTING</a>
                    </div>
                    <span class="posted-text">34d ago</span>
                </div>
            </div>
        <div class="clearfix extra-info">
            <hr>
            <!--
                <div class="ribbons">
                </div>
                <div class="extra-options">
                    <div class="make-offer">
                        <a href="#">
                        <div class="circle">
                            <div class="text-offer">
                                <span>Make an offer</span>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="ratings">
                        <div class="stars">
                            <span>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                            </span>
                        </div>
                    </div>
                </div>
            -->
                <div class="link-details">
                    <a href="/companies/uber">> LEARN MORE ABOUT THIS ADVERTISER</a>
                </div>
        </div>
    </div>
    <div class="listing-max-pro">
            <div class="product">
                <div class="info margin-left">
                    <div class="favor">
                        <span class="heart-empty favroite-icon" data-id="">
                        </span>
                        <span  class="favor-text">SAVE</span>
                    </div>
                    <a class="listing-product" href="/jobs/uber/associate-counsel-uk-ireland"> 
                        <h4 class="product-title">Associate Counsel - UK & Ireland</h4>
                    </a>
                    <span class="listing-location">
                        London, United Kingdom
                    </span>
                    <div class="link-details">
                        <a href="/jobs/uber/associate-counsel-uk-ireland">> VIEW FULL POSTING</a>
                    </div>
                    <span class="posted-text">34d ago</span>
                </div>
            </div>
        <div class="clearfix extra-info">
            <hr>
            <!--
                <div class="ribbons">
                </div>
                <div class="extra-options">
                    <div class="make-offer">
                        <a href="#">
                        <div class="circle">
                            <div class="text-offer">
                                <span>Make an offer</span>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="ratings">
                        <div class="stars">
                            <span>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                            </span>
                        </div>
                    </div>
                </div>
            -->
                <div class="link-details">
                    <a href="/companies/uber">> LEARN MORE ABOUT THIS ADVERTISER</a>
                </div>
        </div>
    </div>
    <div class="listing-max-pro">
            <div class="product">
                <div class="info margin-left">
                    <div class="favor">
                        <span class="heart-empty favroite-icon" data-id="">
                        </span>
                        <span  class="favor-text">SAVE</span>
                    </div>
                    <a class="listing-product" href="/jobs/uber/head-of-compliance-uk-ireland"> 
                        <h4 class="product-title">Head of compliance - UK & Ireland</h4>
                    </a>
                    <span class="listing-location">
                        London, United Kingdom
                    </span>
                    <div class="link-details">
                        <a href="/jobs/uber/head-of-compliance-uk-ireland">> VIEW FULL POSTING</a>
                    </div>
                    <span class="posted-text">34d ago</span>
                </div>
            </div>
        <div class="clearfix extra-info">
            <hr>
            <!--
                <div class="ribbons">
                </div>
                <div class="extra-options">
                    <div class="make-offer">
                        <a href="#">
                        <div class="circle">
                            <div class="text-offer">
                                <span>Make an offer</span>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="ratings">
                        <div class="stars">
                            <span>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                            </span>
                        </div>
                    </div>
                </div>
            -->
                <div class="link-details">
                    <a href="/companies/uber">> LEARN MORE ABOUT THIS ADVERTISER</a>
                </div>
        </div>
    </div>
    <div class="listing-max-pro">
            <div class="product">
                <div class="info margin-left">
                    <div class="favor">
                        <span class="heart-empty favroite-icon" data-id="">
                        </span>
                        <span  class="favor-text">SAVE</span>
                    </div>
                    <a class="listing-product" href="/jobs/uber/senior-community-operations-manager-ubereats-uki"> 
                        <h4 class="product-title">Senior Community Operations Manager, UberEATS - UKI</h4>
                    </a>
                    <span class="listing-location">
                        London, United Kingdom
                    </span>
                    <div class="link-details">
                        <a href="/jobs/uber/senior-community-operations-manager-ubereats-uki">> VIEW FULL POSTING</a>
                    </div>
                    <span class="posted-text">34d ago</span>
                </div>
            </div>
        <div class="clearfix extra-info">
            <hr>
            <!--
                <div class="ribbons">
                </div>
                <div class="extra-options">
                    <div class="make-offer">
                        <a href="#">
                        <div class="circle">
                            <div class="text-offer">
                                <span>Make an offer</span>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="ratings">
                        <div class="stars">
                            <span>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                            </span>
                        </div>
                    </div>
                </div>
            -->
                <div class="link-details">
                    <a href="/companies/uber">> LEARN MORE ABOUT THIS ADVERTISER</a>
                </div>
        </div>
    </div>
    <div class="listing-max-pro">
            <div class="product">
                <div class="info margin-left">
                    <div class="favor">
                        <span class="heart-empty favroite-icon" data-id="">
                        </span>
                        <span  class="favor-text">SAVE</span>
                    </div>
                    <a class="listing-product" href="/jobs/uber/enterprise-account-executive-uber-eats"> 
                        <h4 class="product-title">Enterprise Account Executive, Uber Eats</h4>
                    </a>
                    <span class="listing-location">
                        London, United Kingdom
                    </span>
                    <div class="link-details">
                        <a href="/jobs/uber/enterprise-account-executive-uber-eats">> VIEW FULL POSTING</a>
                    </div>
                    <span class="posted-text">34d ago</span>
                </div>
            </div>
        <div class="clearfix extra-info">
            <hr>
            <!--
                <div class="ribbons">
                </div>
                <div class="extra-options">
                    <div class="make-offer">
                        <a href="#">
                        <div class="circle">
                            <div class="text-offer">
                                <span>Make an offer</span>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="ratings">
                        <div class="stars">
                            <span>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                            </span>
                        </div>
                    </div>
                </div>
            -->
                <div class="link-details">
                    <a href="#">> LEARN MORE ABOUT THIS ADVERTISER</a>
                </div>
        </div>
    </div>
    <div class="listing-max-pro">
            <div class="product">
                <div class="info margin-left">
                    <div class="favor">
                        <span class="heart-empty favroite-icon" data-id="">
                        </span>
                        <span  class="favor-text">SAVE</span>
                    </div>
                    <a class="listing-product" href="#"> 
                        <h4 class="product-title">Head of Public Policy UK & Ireland / Nothern Europe</h4>
                    </a>
                    <span class="listing-location">
                        London, United Kingdom
                    </span>
                    <div class="link-details">
                        <a href="#">> VIEW FULL POSTING</a>
                    </div>
                    <span class="posted-text">34d ago</span>
                </div>
            </div>
        <div class="clearfix extra-info">
            <hr>
            <!--
                <div class="ribbons">
                </div>
                <div class="extra-options">
                    <div class="make-offer">
                        <a href="#">
                        <div class="circle">
                            <div class="text-offer">
                                <span>Make an offer</span>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="ratings">
                        <div class="stars">
                            <span>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                            </span>
                        </div>
                    </div>
                </div>
            -->
                <div class="link-details">
                    <a href="#">> LEARN MORE ABOUT THIS ADVERTISER</a>
                </div>
        </div>
    </div>
    <div class="listing-max-pro">
            <div class="product">
                <div class="info margin-left">
                    <div class="favor">
                        <span class="heart-empty favroite-icon" data-id="">
                        </span>
                        <span  class="favor-text">SAVE</span>
                    </div>
                    <a class="listing-product" href="#"> 
                        <h4 class="product-title">Public Policy Senior Associate - UK & Ireland</h4>
                    </a>
                    <span class="listing-location">
                        London, United Kingdom
                    </span>
                    <div class="link-details">
                        <a href="#">> VIEW FULL POSTING</a>
                    </div>
                    <span class="posted-text">34d ago</span>
                </div>
            </div>
        <div class="clearfix extra-info">
            <hr>
            <!--
                <div class="ribbons">
                </div>
                <div class="extra-options">
                    <div class="make-offer">
                        <a href="#">
                        <div class="circle">
                            <div class="text-offer">
                                <span>Make an offer</span>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="ratings">
                        <div class="stars">
                            <span>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                            </span>
                        </div>
                    </div>
                </div>
            -->
                <div class="link-details">
                    <a href="#">> LEARN MORE ABOUT THIS ADVERTISER</a>
                </div>
        </div>
    </div>
    <div class="listing-max-pro">
            <div class="product">
                <div class="info margin-left">
                    <div class="favor">
                        <span class="heart-empty favroite-icon" data-id="">
                        </span>
                        <span  class="favor-text">SAVE</span>
                    </div>
                    <a class="listing-product" href="#"> 
                        <h4 class="product-title">Senior Counsel - UK&I</h4>
                    </a>
                    <span class="listing-location">
                        London, United Kingdom
                    </span>
                    <div class="link-details">
                        <a href="#">> VIEW FULL POSTING</a>
                    </div>
                    <span class="posted-text">34d ago</span>
                </div>
            </div>
        <div class="clearfix extra-info">
            <hr>
            <!--
                <div class="ribbons">
                </div>
                <div class="extra-options">
                    <div class="make-offer">
                        <a href="#">
                        <div class="circle">
                            <div class="text-offer">
                                <span>Make an offer</span>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="ratings">
                        <div class="stars">
                            <span>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                                <i class="fullstar"></i>
                            </span>
                        </div>
                    </div>
                </div>
            -->
                <div class="link-details">
                    <a href="#">> LEARN MORE ABOUT THIS ADVERTISER</a>
                </div>
        </div>
    </div>
    <div class="listing-max-pro container-emailme">
        <div class="container-emailme-header text-center">
            <h3>Let Us Help With Your Search</h3>
        </div>
        <div class="container-emailme-form text-center">
            <p>Submit and sit back. We'll send you opportunities you'll actually love and some helpful advice to help make the search stress free.</p>
            <div class="row">
                <div class="col-sm-offset-2 col-sm-8">
                    <form action="" id="sendme-search">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="email-sendme">Email</span>
                                <input type="text" class="form-control" placeholder="example@email.com" aria-describedby="email-sendme">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="phone-sendme">Mobile</span>
                                <input type="text" class="form-control" placeholder="00447777777777" aria-describedby="phone-sendme">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit-sendme" class="btn btn-submit">
                        </div>
                    </form>
                </div>
            </div>
            <small>By clicking Submit, you accept our <a>Terms & Conditions</a>, <a>Privacy policy</a> and consent to messages</small>
        </div>
    </div>


        <nav aria-label="Page navigation">
            <div class="text-center">
            <ul class="pagination">

                <li class="disabled">
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="active">
                    <span>1<span class="sr-only">(current)</span></span>
                </li>
                <li class="disabled">
                    <a href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
            </div>
        </nav>

    </div>
    </div>
    <div class="col-md-2 col-sm-12 col-xs-12">
    </div>
        </div>
    </div>
</div>
</div>


@endsection

@section('scripts')
<script>
    
</script>
@endsection
