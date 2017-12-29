@extends('layouts.recruiters')

@section('title', env('APP_NAME').' | Contact - Template Uber')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@section('content')
 <link href="{{ asset('/css/css/font-awesome.min.css?q=874') }}" rel="stylesheet">
 <link href="{{asset('/css/template-job.css?q=874')}}" rel="stylesheet">
 <div class="body">
	<div class="container-fluid">
		<div class="row header-container">
			<div class="col-sm-12">
				<div id="top-image" class="bg-image">
					<h1>Safety Lead UKI</h1>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			
		</div>
	</div>
</div>
@endsection