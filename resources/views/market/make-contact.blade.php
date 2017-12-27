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
			</div>
			<div class="row">
			</div>
		</div>
		<!-- end info-content -->
	</div>
</div>
</div>
@endsection