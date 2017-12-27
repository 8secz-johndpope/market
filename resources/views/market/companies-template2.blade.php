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
			<div class="col-sm-8">
				<div class="title-block">
					<h1>We are<br><div class="big-title">UBER</div></h1>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="logo-block">
					<a href="/companies/uber"><img src="https://assets.themuse.com/uploaded/companies/61/small_logo.png?v=None" alt="Uber Careers"></a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection