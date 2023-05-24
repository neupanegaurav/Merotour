@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
List of Clients ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                List of Clients
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        My Clients
			                <span class="icon-angle-right"></span>
			            </li>
			             
			                        <li>List of Clients
			                                    
			                            </li>
			                                           
			</ul>
			<!-- END BREADCRUMBS -->
        </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN DYNAMIC TABLE EXAMPLE -->
        <div class="social-box" style="display:inline-block; width:1109px;">
   
    <!-- BEGIN TABLE BODY -->
    <div class="body">
   
        <!-- BEGIN TABLE DATA -->
        

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th class="span1">@lang('admin/users/table.id')</th>
			<th class="span2">@lang('admin/users/table.first_name')</th>
			<th class="span2">@lang('admin/users/table.last_name')</th>
			<th class="span3">@lang('admin/users/table.email')</th>
			<th class="span2">@lang('admin/users/table.activated')</th>
			<th class="span2">@lang('admin/users/table.created_at')</th>
			<th class="span2">@lang('table.actions')</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($users as $user)
		<tr>
			<td>{{ $user->id }}</td>
			<td>{{ $user->first_name }}</td>
			<td>{{ $user->last_name }}</td>
			<td>{{ $user->email }}</td>
			<td>@lang('general.' . ($user->isActivated() ? 'yes' : 'no'))</td>
			<td>{{ $user->created_at->diffForHumans() }}</td>
			<td>
				<a href="{{ route('update/user/agent', $user->id) }}" class="btn btn-mini">@lang('button.edit')</a>

				
				@if (Sentry::getId() !== $user->id)
				<a href="{{ route('delete/user/agent', $user->id) }}" class="btn btn-mini btn-danger">@lang('button.delete')</a>
				@else
				<span class="btn btn-mini btn-danger disabled">@lang('button.delete')</span>
				@endif
				
			</td>
		</tr>
		@endforeach
	</tbody>
</table>


			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>
         




<script src="{{asset('ckeditor')}}/ckeditor.js"></script>

@stop
