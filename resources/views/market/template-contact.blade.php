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
				<h3 class="options-contact-title">Via Website:</h3>
				<form>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group has-icon">
								<label class="control-label sr-only" for="contact-name">
									Name
								</label>
								<input type="text" id="contact-name" name="contact-name" class="form-control input">
								<span class="fa fa-user form-control-icon"></span>	
								<p class="help-block help-block-error"></p>
							</div>					
						</div>
						<div class="col-sm-6">
							<div class="form-group has-icon">
								<label class="control-label sr-only" for="contact-email">Email</label>
								<input type="text" id="contact-email" name="contact-email" class="form-control input">
								<span class="fa fa-envelope-o form-control-icon"></span>
								<p class="help-block help-block-error"></p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group has-icon">
								<label class="control-label sr-only" for="contact-subject">Subject</label>
								<input type="text" id="contact-subject" name="contact-subject" class="form-control input">
								<span class="fa fa-envelope-o form-control-icon"></span>
								<p class="help-block help-block-error"></p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group has-icon">
								<textarea id="contact-body" name="contact-body" class="form-control" rows="6" placeholder="Message"></textarea>
								<p class="help-block help-block-error"></p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-offset-6 col-sm-6">
							<button type="submit" class="btn btn-submit" name="contact-button">Send Message</button>
						</div>
					</div>	
				</form>
			</div>
			<div class="col-sm-3">
				<h3 class="options-contact-title">By Email:</h3>
				<ul class="list-style-1">
					<li>
						<i class="fa fa-envelope"></i>
						<span>info@sumra.net</span>
					</li>
				</ul>
				<h3 class="options-contact-title">By Phone:</h3>
				<ul class="list-style-1">
					<li>
						<i class="fa fa-phone"></i>
						<span> +44 208 777 7777</span>
					</li>
				</ul>
				<h3 class="options-contact-title">Bussines Hours:</h3>
				<ul class="list-style-1">
					<li>
						<i class="fa fa-calendar"></i>
						<strong>Monday - Sunday</strong>
					</li>
					<li>
						<i class="fa fa-clock-o"></i>
						<span>09:00 to 21:00</span>
					</li>
				</ul>
			</div>
			<div class="col-sm-4">
			</div>
		</div>
	</div>
</div>
@endsection