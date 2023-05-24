@extends('emails/layouts/default')

@section('content')
<p>Hello {{ $user->first_name }},</p>

<p>Welcome to Blackeye Travels! Please click on the following link to confirm your Blackeye Travels account:</p>

<p><a href="{{ $activationUrl }}">{{ $activationUrl }}</a></p>

<p>Best regards,</p>

<p>Blackeye Travels</p>
<p> www.blackeyetravels.com</p>
@stop
