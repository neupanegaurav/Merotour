@extends('emails/layouts/default')

@section('content')

<p>Hello, {{ $user->first_name }} </p>
<p>We regret to inform you that your cancel request for Order no. #{{ $invoice_no }} has been unapproved.</p>

<p> Reason for cancellation: </p>

<p>  </p>

<p>	User: {{ $user->first_name . ', ' . $user->last_name }}	</p>

<p> Category: {{ $category }}  </p>

<p> Package Name: {{ $package_name }}  </p>

<p> Invoice no: #{{ $invoice_no }} </p>

<p>Best regards,</p>

<p>Blackeye Travels Team</p>
<p> www.blackeyetravels.com </p>
@stop
