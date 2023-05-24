@extends('emails/layouts/default')

@section('content')
<p>New Order has been placed.</p>

<p>User: {{ $user->first_name . ', ' . $user->last_name }}</p>

<p> Category: {{ $category }}  </p>

<p> Invoice no: #{{ $invoice_no }} </p>

<p>Best regards,</p>

<p>Blackeye Travels</p>
<p> www.blackeyetravels.com </p>
@stop
