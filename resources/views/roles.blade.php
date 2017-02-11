@extends('layouts.app')

@section('content')
	<div class="container">
		@if(Session::has('flash_message'))
			<div class="alert alert-success">{{ Session::get('flash_message') }}</div>
		@endif
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Roles</div>

					<div class="panel-body">
						<div class="text-center bs-callout bs-callout-warning" id="callout-helper-pull-navbar">
							<h4>Please, select a role to continue using!</h4>
							@foreach($user_roles as $key => $role)
								<a href="{{ route('roles.update', $key) }}"
								   class="btn btn-group-lg btn-primary">{{ strtoupper($role) }}</a>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
@endsection
