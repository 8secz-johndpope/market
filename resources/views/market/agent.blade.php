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
                    		<div class="text">
	                    		<p>
	                    		With over 140 years experience in selling and letting property, Hamptons International has a network of over 85 branches across the country and internationally, marketing a huge variety of properties from compact flats to grand country estates. We’re national estate agents, with local offices. We know our local areas as well as any local agent. But our network means we can market your property to a much greater number of the right sort of buyers or tenants. And selling and letting property is not all we do. If you want to find out more about any of our additional services including Property Finance, Property Management, International Sales and Investments or Residential Developments and Investments, give us a call. Whether you are buying or renting, have a property to sell or let, need property finance, or management services, the Hamptons International brand is one you can trust.
	                    		</p>
                    		</div>
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