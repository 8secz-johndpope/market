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
		<!-- div info-content -->
		<div class="col-sm-12">
			<div class="row">
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
	</div>
</div>
</div>
@endsection