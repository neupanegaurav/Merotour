@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Coupon Management ::
@parent
@stop

{{-- Page content --}}
@section('content')
@include('backend.administration.sidebar')


<div id="right_section">
    
    <div id="right_header">
	<h3>
		Coupon Management

		<div class="pull-right">
			<a href="{{ route('create_coupon') }}" class="btn btn-small btn-info"><i class="icon-plus-sign icon-white"></i> Create</a>
		</div>
	</h3>
</div>

{{ $coupons->links() }}

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th class="span1">Coupon Code</th>
			<th class="span6">Type</th>
			<th class="span2">Value</th>
			<th class="span2">Applies to</th>
			<th class="span2">@lang('table.actions')</th>
		</tr>
	</thead>
	<tbody>
		@if ($coupons->count() >= 1)
		@foreach ($coupons as $coupon)
		<tr>
			<td>{{ $coupon->code }}</td>
			<td>{{ $coupon->type }}</td>
			<td>{{ $coupon->value }}</td>
			<td>{{ $coupon->maximum_usage }}</td>
			<td>
				<a href="{{ route('update_coupon', $coupon->id) }}" class="btn btn-mini">@lang('button.edit')</a>
				<a href="{{ route('delete_coupon', $coupon->id) }}" class="btn btn-mini btn-danger">@lang('button.delete')</a>
			</td>
		</tr>
		@endforeach
		@else
		<tr>
			<td colspan="5">No results</td>
		</tr>
		@endif
	</tbody>
</table>

{{ $coupons->links() }}

</div>

@stop
