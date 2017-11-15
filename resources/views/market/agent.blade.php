@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
 <link href="{{ asset('/css/agent.css?q=874') }}" rel="stylesheet">
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="banner-agency">
				<img src="{{$user->business->banner_img}}" class="img-banner">
				<span class="all-properties">
					<a class="btn btn-default" href="#">View properties</a>
				</span>
			</div>
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
                    <div class="tab-content">
                    	<div id="tab-overview" class="tab-pane fade in active">
                    		<div class="content-text">
	                    		<p>
	                    		With over 140 years experience in selling and letting property, Hamptons International has a network of over 85 branches across the country and internationally, marketing a huge variety of properties from compact flats to grand country estates. We’re national estate agents, with local offices. We know our local areas as well as any local agent. But our network means we can market your property to a much greater number of the right sort of buyers or tenants. And selling and letting property is not all we do. If you want to find out more about any of our additional services including Property Finance, Property Management, International Sales and Investments or Residential Developments and Investments, give us a call. Whether you are buying or renting, have a property to sell or let, need property finance, or management services, the Hamptons International brand is one you can trust.
	                    		</p>
                    		</div>
                    		<div>
                    			<table class="averages">
                    				<tbody>
                    					<tr>
                    						<th>Properties</th>
                    						<th>Number of properties</th>
                    						<th>Avg. asking price</th>
                    						<th>Avg. listing age</th>
                    					</tr>
                    					@if($avgPriceRent >0)
                    					<tr>
                    						<td><a>Residential to rent</a></td>
                    						<td class="text-center">{{count($advertsForRent)}}</td>
                    						<td class="text-center">£ {{number_format($avgPriceRent, 0, '.', ',')}}</td>
                    						<td class="text-center">6 weeks</td>
                    					</tr>
                    					@endif
                    					@if($avgPriceSale >0)
                    					<tr>
                    						<td><a>Residential to sale</a></td>
                    						<td class="text-center">{{count($advertsForsale)}}</td>
                    						<td class="text-center">£ {{number_format($avgPriceSale, 0, '.', ',')}}</td>
                    						<td class="text-center">6 weeks</td>
                    					</tr>
                    					@endif
                    				</tbody>
                    			</table>
                    		</div>
                    	</div>
                    	<div id="tab-about" class="tab-pane fade">
                    	</div>
                    	<div id="tab-branch-loc" class="tab-pane fade">
                    		<h3>Agent's branch</h3>
                    		<div id="map">
                    		</div>
                    	</div>
                    	<div id="tab-contact" class="tab-pane fade">
                    		<h3>Contact</h3>
                    		<div class="form-content">
                    			<form id="letting-branch">
                    				<fieldset>
                    					<div class="inputset">
                    						<label class="contact-form">
                    							Name: <span class="required">*</span>
                    						</label>
                    					</div>
                    				</fieldset>
                    			</form>
                    		</div>
                    	</div>
                    </div>

				</div>
			</div>
			<div class="row btns-properties">
				<div class="col-sm-12">
					<h3>See all ads by this advertiser</h3>
				</div>
				<div class="col-sm-12">
					<a href="#" class="btn btn-default">For Sale</a>
					<a href="#" class="btn btn-default">For Rent</a>
				</div>
			</div>
		</div>
		<!-- end info-content -->
		<!-- div col-agency-contact -->
		<div class="col-md-4 col-sm-12">
			<div class="row">
				
			</div>
			<div class="row border-outside">
				<div class="col-sm-12 details-agent title">
					<h3>Contact details</h3>
				</div>
				<div class="col-sm-12 details-agent">
					<div class="profile-picutre">
						<img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{$user->business->logo}}">
					</div>
					<div class="agent-details">
						<p>
							@if(isset($user->business))
								{{$user->business->name}}
							@endif
						</p>
						@if(isset($user->business)) 
						<address>
							 @if(isset($user->business->address))
							 {{$user->business->address->line1}}, {{$user->business->address->city}}, {{$user->business->address->postcode}} 
							 @endif
						</address>
						<p><strong>Tel: </strong>{{$user->business->phone}}</p>
						<p><strong>Fax: </strong>{{$user->business->fax}}</p>
						@endif
						<a href="#" class="btn btn-default">Email agent</a>
					</div>
				</div>
			</div>
			<div class="row border-outside">
				<div class="col-sm-12 title">
					<h3>See it? Scan it</h3>
				</div>
				<div class="col-sm-12 q-code-wraper">
					<h4>For sale</h4>
					<div class="qr-code-img-wrapper">
						<img src="http://media.rightmove.co.uk/qr/www.rightmove.co.uk/s1r_39899_m/QR_Thackerays_London_RESALE_39899.png">
					</div>
					<div class="print-qr-code-link">
						<a href="#">Print </a>
						or 
						<a href="#">Save</a>
					</div>
					<div class="print-qr-code-link">
						this QR code for this agent's properties for sale
					</div>
				</div>
				<div class="col-sm-12 q-code-wraper">
					<h4>For rent</h4>
					<div class="qr-code-img-wrapper">
						<img src="http://media.rightmove.co.uk/qr/www.rightmove.co.uk/s1l_39899_m/QR_Thackerays_London_LETTINGS_39899.png">
					</div>
					<div class="print-qr-code-link">
						<a href="#">Print </a>
						or 
						<a href="#">Save</a>
					</div>
					<div class="print-qr-code-link">
						this QR code for this agent's properties for rent
					</div>
				</div>
			</div>
		</div>
		<!-- end col-agency-contact -->
	</div>
</div>
@if(isset($user->business)) 
<script>

	var map;
	function initMap() {
	    var uluru = {lat: {!! $postcode->lat !!}, lng: {!! $postcode->lng !!}};
	     map = new google.maps.Map(document.getElementById('map'), {
	        zoom: 18,
	        center: uluru
	    });
	    var marker = new google.maps.Marker({
	        position: uluru,
	        map: map
	    });
	}
	$(document).ready(function() {
	    initMap();
	});
	$('a[href="#tab-branch-loc"]').on('shown.bs.tab', function () {
        console.log("load maps tab");
        x = map.getZoom();
        c = map.getCenter();
        google.maps.event.trigger(map, 'resize');
        map.setZoom(x);
        map.setCenter(c);
    });
</script>
@endif
@endsection