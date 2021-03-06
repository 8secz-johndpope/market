@extends('layouts.app')

@section('title', env('APP_NAME'))

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@php
    $date = new Datetime();
    $dateMs = $date->getTimestamp();
@endphp
@section('content')
 <link href="{{ asset("/css/make-contact.css?q=$dateMs") }}" rel="stylesheet">
<div class="body">
	<div class="container">
		<div class="row">
			 <div class="col-md-8 col-sm-12">
			 	<div class="nav-back">
			 	<a href="/userads/{{$user->id}}"> < Go back</a>
			 	</div>
			 </div>
		</div>
		<div class="row container-info-advertiser">
			<!-- div info-content -->
			<div class="col-sm-3">
				<div class="container-img-advertiser">
	                <div class="img-advertiser">
	                    <img class="circle image-advertiser" src="{{env('AWS_WEB_IMAGE_URL')}}/{{$user->image}}">
	                </div>
	            </div>
			</div>
			<div class="col-sm-9">
				<div class="container-info-advertiser">
                    <p><strong>{{$user->name}}</strong></p>
                    <address>
                        {{$user->address->city}}
                    </address>
                    <span>
                        <span class="glyphicon glyphicon-earphone"></span>
                        {{substr($user->phone,0,5)}}XXXXXX
                    </span>
                </div>
			</div>
			<!-- end info-content -->
		</div>
		<div class="row container-buttons">
			<div class="col-sm-offset-2 col-sm-8">
				<div class="row">
					<div class="col-sm-4">
						<a class="btn btn-default">Send Message</a>
					</div>
					<div class="col-sm-4">
						<a class="btn btn-default">Call</a>
					</div>
					<div class="col-sm-4">
						<a class="btn btn-default">VideoCall</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection