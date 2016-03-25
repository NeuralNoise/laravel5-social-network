@extends('templates.default')

@section('content')
	<h3>Your search for {{ request('query') }}</h3>
@stop