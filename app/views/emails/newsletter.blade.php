@extends('emails/layouts/default')

@section('content')

<p>{{html_entity_decode($body)}}</p>

@stop
