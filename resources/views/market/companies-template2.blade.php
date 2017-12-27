@extends('layouts.app')

@section('title', env('APP_NAME').' | '. isset($user->business) ? $user->business->name : 'Company')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
 <link href="{{asset('/css/agent.css?q=874')}}" rel="stylesheet">
 <div class="body">
	<div class="container">
		<div class="row">
			<!-- div info-content -->
			
		</div>
	</div>
</div>
@endsection