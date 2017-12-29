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
					<p class="c-white">Uber - Company template</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection