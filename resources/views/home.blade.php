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
                    {{ $user_type == 'orchestra' ? 'Welcome ' . Auth::user()->orchestra_name . " - " : '' }}
                    You are logged in as {{ strtoupper($user_type) }} !

	                @if($user_type == 'orchestra')
		                <br /> You can add new member from <a href="{{ route('members.add') }}">HERE</a>
					@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
