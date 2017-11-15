@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')

<div class="container">
	<div class="row">
		<div class="col-sm-12 banner-agency">
			<img src="" class="img-banner">
		</div>
	</div> 
	<div class="row">
		<!-- div info-content -->
		<div class="col-md-8 col-sm-12">
			<div class="row">
				<div class="col-sm-12">
					<ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-overview">Overview</a></li>
                        <li><a data-toggle="tab" href="#tab-about">About Us</a></li>
                        <li><a data-toggle="tab" href="#tab-branch-loc">Branch location</a></li>
                        <li><a data-toggle="tab" href="#tab-contact">Contact Us</a></li>
                    </ul>
                    <div class="tabs-content">
                    	<div class="tabs-content" id="tab-overview">
                    	</div>
                    	<div class="tabs-content" id="tab-about">
                    	</div>
                    	<div class="tabs-content" id="tab-branch-loc">
                    	</div>
                    	<div class="tabs-content" id="tab-contact">
                    	</div>
                    </div>

				</div>
			</div>
		</div>
		<!-- end info-content -->
		<!-- div col-agency-contact -->
		<div class="col-md-4 col-sm-12">

		</div>
		<!-- end col-agency-contact -->
	</div>
</div>
@endsection