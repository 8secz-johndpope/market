@extends('layouts.recruiters')

@section('title', env('APP_NAME').' | Contact - Template Uber')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@section('content')
 <link href="{{asset('/css/template-contact.css?q=874')}}" rel="stylesheet">
 <link href="{{ asset('/css/css/font-awesome.min.css?q=874') }}" rel="stylesheet">
 <div class="body">
	<div class="container-fluid">
		<div class="row header-container">
			<div class="col-sm-12">
				<div class="parallax-content">
					<h1 class="header-title">
						Sumra - Contact
					</h1>
					<p class="c-white">Uber Template</p>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2 class="contact-title">
					Contact Us About the Uber Template
				</h2>
				<div class="contact-form-yellow">
				</div>
			</div>
			<div class="col-sm-5">
				<h3>Via Website:</h3>
				<form>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group has-icon">
								<label class="control-label sr-only" for="contact-name">
									Name
								</label>
								<input type="text" id="contact-name" class="form-control input">
								<span class="fa fa-user form-control-icon"></span>	
								<p class="help-block help-block-error"></p>
							</div>					
						</div>
						<div class="col-sm-6">
							<div class="form-group has-icon">
								<label class="control-label sr-only" for="contact-email">Email</label>
								<input type="text" id="contact-email" class="form-control input">
								<span class="fa fa-envelope-o form-control-icon"></span>
								<p class="help-block help-block-error"></p>
							</div>
						</div>
					</div>
					<div class="row">
					</div>
					<div class="row">
					</div>
					<div class="row">
					</div>
					
				</form>
			</div>
			<div class="col-sm-3">
			</div>
			<div class="col-sm-4">
			</div>
		</div>
	</div>
</div>
@endsection