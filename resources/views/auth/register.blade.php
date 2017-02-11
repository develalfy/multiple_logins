@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Register</div>
					<div class="panel-body">
						<form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
							{{ csrf_field() }}

							<div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
								<label for="name" class="col-md-4 control-label">First name</label>

								<div class="col-md-6">
									<input id="name" type="text" class="form-control" name="firstname"
									       value="{{ old('firstname') }}" required autofocus>

									@if ($errors->has('firstname'))
										<span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
								<label for="name" class="col-md-4 control-label">Surname</label>

								<div class="col-md-6">
									<input id="name" type="text" class="form-control" name="surname"
									       value="{{ old('surname') }}" required autofocus>

									@if ($errors->has('surname'))
										<span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
								<label for="gender" class="col-md-4 control-label">Gender</label>

								<div class="col-md-6">
									<input id="male" type="radio" class=""
									       name="gender"
									       value="male" checked required autofocus>
									<label for="male">Male</label> -
									<input id="female" type="radio"
									       class="" name="gender"
									       value="female" required autofocus>
									<label for="female">Female</label>

									@if ($errors->has('gender'))
										<span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('role_type') ? ' has-error' : '' }}">
								<label class="col-md-4 control-label">Role type</label>

								<div class="col-md-6">
									<input id="role_type_orchestra" type="checkbox" class="" name="role_type[]"
									       value="orchestra" checked="checked">
									<label for="role_type_orchestra">Orchestra</label>
									<br>
									<input id="role_type_musician" type="checkbox" class="" name="role_type[]"
									       value="musician">
									<label for="role_type_musician">Musician</label>

									@if ($errors->has('role_type'))
										<span class="help-block">
                                        <strong>{{ $errors->first('role_type') }}</strong>
                                    </span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label for="email" class="col-md-4 control-label">E-Mail Address</label>

								<div class="col-md-6">
									<input id="email" type="email" class="form-control" name="email"
									       value="{{ old('email') }}" required>

									@if ($errors->has('email'))
										<span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
								<label for="password" class="col-md-4 control-label">Password</label>

								<div class="col-md-6">
									<input id="password" type="password" class="form-control" name="password" required>

									@if ($errors->has('password'))
										<span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

								<div class="col-md-6">
									<input id="password-confirm" type="password" class="form-control"
									       name="password_confirmation" required>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Register
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
