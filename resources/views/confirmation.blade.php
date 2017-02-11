@extends('layouts.app')

@section('content')
	<div class="container">
		@if(Session::has('flash_message'))
			<div class="alert alert-success">{{ Session::get('flash_message') }}</div>
		@endif
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Dashboard</div>

					<div class="panel-body">
						You need to confirm your E-mail address first, check your E-mail, or <a
								href="{{ route('confirmation.resend') }}"><b>resend</b></a> a new confirmation please!
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
