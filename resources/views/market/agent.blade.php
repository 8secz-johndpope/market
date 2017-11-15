@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-sm-12">
		</div>
		<div class="col-md-4 col-sm-12">
		</div>
	</div>
</div>
@endsection