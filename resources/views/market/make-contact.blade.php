@extends('layouts.app')

@section('title', env('APP_NAME'))

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
 <link href="{{ asset('/css/agent.css?q=874') }}" rel="stylesheet">
<div class="body">
<div class="container">
	<div class="row">
		 <div class="col-md-8 col-sm-12">
		 	<div class="nav-back">
		 	<a href="{{ url()->previous()}}"> < Go back</a>
		 	</div>
		 </div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="banner-agency">
				<img src="{{env('AWS_WEB_IMAGE_URL')}}/{{isset($user->business) ? $user->business->banner_img: ''}}" class="img-banner">
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
                    			@if(isset($user->business))
                    			<p>
                    				{{$user->business->description}}
                    			</p>
                    			@else
	                    		<p>
	                    		With over 140 years experience in selling and letting property, Hamptons International has a network of over 85 branches across the country and internationally, marketing a huge variety of properties from compact flats to grand country estates. We’re national estate agents, with local offices. We know our local areas as well as any local agent. But our network means we can market your property to a much greater number of the right sort of buyers or tenants. And selling and letting property is not all we do. If you want to find out more about any of our additional services including Property Finance, Property Management, International Sales and Investments or Residential Developments and Investments, give us a call. Whether you are buying or renting, have a property to sell or let, need property finance, or management services, the Hamptons International brand is one you can trust.
	                    		</p>
	                    		@endif
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
                    		<h3>Meet the team</h3>
                    		<div class="team-member">
	                    		<div class="member-img">
	                    			<img src="{{env('AWS_WEB_IMAGE_URL')}}/{{$user->image}}">
	                    		</div>
	                    		<div class="member-details">
	                    			<h3>{{$user->name}}</h3>
	                    			<p class="member-job">Head of Sales and Head of Notting Hill Office</p>
	                    			<p class="member-summary">Jerry has been a property specialist for 26 years since graduating from Royal Agricultural College, Cirencester and then working with Knight Frank and several other national and international prime property brands. He is a member of the Royal Institute of Chartered Surveyors and has lived in Notting Hill for 15 years. Jerry has worked closely with YOUhome since 2011 and joined the firm in August 2013.</p>
	                    		</div>
                    		</div>
                    		<div class="team-member">
	                    		<div class="member-img">
	                    			<img src="{{env('AWS_WEB_IMAGE_URL')}}/825060836495.jpg">
	                    		</div>
	                    		<div class="member-details">
	                    			<h3>Will Thacker MARLA</h3>
	                    			<p class="member-job">Lettings and Property Manager</p>
	                    			<p class="member-summary">Will has been a property specialist for 7 years having worked for two of London's leading prime property agents. He has considerable experience managing the day-to-day administration of rental properties, tenant communications and overseeing repair and maintenance works. He has successfully managed the properties of both domestic and international private landlords and larger portfolio estates, including the Howard de Walden and Portman Estates. Will joined YOUhome in May 2013.</p>
	                    		</div>
                    		</div>
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
                    						<label class="contact-label" for="branch-enquiry-title">
                    							Name: <span class="required">*</span>
                    						</label>
                    						<div class="input-name is-valid">
                    							<input id="branch-enquiry-title" type="text" name="title" title="Title" placeholder="Title" class="title-name">
                    							<input id="branch-enquiry-first-name" type="text" name="first-name" title="First name" placeholder="First name" class="name">
                    							<input id="branch-enquiry-last-name" type="text" name="last-name"
                    							title="Last name" placeholder="Last name" class="name">
                    						</div>
                    					</div>
                    					<div class="inputset large-validation is-valid">
                							<label class="contact-label" for="telephone">
                								Telephone: <span class="required">*</span>
                							</label>
                							<input id="telephone" type="text" name="telephone" title="Telephone" placeholder="" required>
                							<div id="branch-enquiry-telephone-error" class="validation-container">
                								Please enter a telephone number.
                							</div>
                    					</div>
                    					<div class="inputset large-validation is-valid">
                    						<label class="contact-label" for="email">
                    							Email: <span class="required">*</span>
                    						</label>
                    						<input id="email" type="email" name="email" title="Email" placeholder="" required>
                    						<div id="branch-enquiry-email-error" class="validation-container">
                								Please enter your email address.
                							</div>
                    					</div>
                    					<div class="inputset large-validation is-valid">
                    						<label class="contact-label" class="contact-label">Address: </label>
                    						<textarea id="address" name="address" rows="3"></textarea>
                    					</div>
                    					<div class="inputset large-validation is-valid">
                    						<label class="contact-label" for="postcode">
                    							Postcode: 
                    						</label>
                    						<input id="postcode" type="postcode" name="postcode" title="Postcode" placeholder="">
                    					</div>
                    					<div class="inputset large-validation is-valid">
                    						<label class="contact-label" for="type-enquiry">
                    							Type of enquiry: 
                    						</label>
                    						<select name="type-enquiry" id="type-enquiry">
                    							<option value selected="selected">Please select:</option>
                    							<option value="looking_to_rent">I am looking to rent a property</option>
                    							<option value="looking_to_buy">I am looking to buy a property</option>
                    							<option value="arrange_valuation">I want a valuation of my property</option>
                    							<option value="looking_to_let">I have a property to let</option>
                    							<option value="looking_to_sale">I have a property to sale</option>
                    						</select>
                    					</div>
                    					<div class="inputset large-validation is-valid">
                    						<label class="contact-label" class="contact-label">Your message: </label>
                    						<textarea id="comment" name="comment" rows="3"></textarea>
                    					</div>
                    					<script src="https://www.google.com/recaptcha/api.js" async="" defer=""></script>
                    					<script>
									      function onCaptchaSubmit(token) {
									        $("#letting-branch").submit();
									      }
									    </script>
									    <div id="submit-inputset">
									    	<input type="submit" name="send-email" value="Send Email to {{isset($user->business)? $user->business->name: ''}}" class="btn btn-default">
									    </div>

                    				</fieldset>
                    				<p class="contact-form-disclaimer">
                    					Please note that {{env('APP_NAME')}} will send the above details to {{isset($user->business) ? $user->business->name : ''}} only. By submitting this form, you confirm that you agree to our website <a href="#">terms of use</a>, our <a href="#">terms of use</a> and consent to <a href="">cookies</a> being stored on your computer.
                    				</p>
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
			<div class="row">
				<div class="col-md-12">
					<div class="disclaimer">
						<h3>Disclaimer</h3>
						<p>The content on this site has been uploaded by {{$user->business->name}}. {{ env('APP_NAME')  }} makes no warranty as to the accuracy or completeness of the content, any queries should be sent directly to {{$user->business->name}}. Where properties are displayed on a page, this comprises a property advertisement. {{ env('APP_NAME')  }} who operate the website {{ env('APP_NAME')  }} makes no warranty as to the accuracy or completeness of the advertisement or any linked or associated information, and {{ env('APP_NAME')  }} has no control over the content. These property advertisements do not constitute property particulars. The information is provided and maintained by {{$user->business->name}}. Please contact the agent directly to obtain any information which may be available under the terms of The Energy Performance of Buildings (Certificates and Inspections) (England and Wales) Regulations 2007 or the Home Report if in relation to a residential property in Scotland and if you have any query over the content.</p>
					</div>
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
						<img src="{{env('AWS_WEB_IMAGE_URL')}}/{{isset($user->business) ? $user->business->logo: 'no_avatar.jpg'}}">
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
						<p><strong>Tel: </strong>{{isset($user->business->phone) ? $user->business->phone : ''}}</p>
						<p><strong>Fax: </strong>{{isset($user->business->fax) ? $user->business->fax : ''}}</p>
						@endif
						<a href="#" class="btn btn-default">Email agent</a>
					</div>
				</div>
			</div>
			<div class="row border-outside">
				<div class="col-sm-12 details-agent title">
					<h3>Opening hours</h3>
				</div>
				<div class="col-sm-12 details-agent">
					<ul >
						<li>Monday 8.30am - 6.00pm</li>
						<li>Tuesday 8.30am - 6.00pm</li>
						<li>Wednesday 8.30am - 6.00pm</li>
						<li>Thursday 8.30am - 6.00pm</li>
						<li>Friday 8.30am - 6.00pm</li>
						<li>Saturday 8.30am - 6.30pm</li>
						<li>Sunday 8.30am - 6.30pm</li>
					</ul>
				</div>
			</div>
			<div class="row border-outside">
				<div class="col-sm-12 details-agent website">
					<a href="#"><h3>Visit the advertiser's website</h3></a>
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
</div>
@endsection