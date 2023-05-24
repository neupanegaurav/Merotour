@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Group Management ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Manage Roles
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			       User Management
			                <span class="icon-angle-right"></span>
			            </li>
			                        <li>Manage Roles
			                                    
			                            </li>
			                                           
			                            
			</ul>
			<!-- END BREADCRUMBS -->
        </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN DYNAMIC TABLE EXAMPLE -->
        <div class="social-box">
    <div class="header">
    

    <!-- BEGIN TABLE TOOLS -->
    <div class="tools">

       <div class="btn-group">
           <a class="btn btn-primary" id="add-row" href="{{ route('create/group') }}"><i class="icon-pencil"></i> Add</a>
             
        </div>
    </div>
    <!-- END TABLE TOOLS -->

    </div>
    <!-- BEGIN TABLE BODY -->
    <div class="body">
        
        <!-- BEGIN TABLE DATA -->
       <table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th class="span1">@lang('admin/groups/table.id')</th>
			<th class="span6">@lang('admin/groups/table.name')</th>
			<th class="span2">@lang('admin/groups/table.users')</th>
			<th class="span2">@lang('admin/groups/table.created_at')</th>
			<th class="span2">@lang('table.actions')</th>
		</tr>
	</thead>
	<tbody>
		@if ($groups->count() >= 1)
		@foreach ($groups as $group)
		<tr>
			<td>{{ $group->id }}</td>
			<td>{{ $group->name }}</td>
			<td>{{ $group->users()->count() }}</td>
			<td>{{ $group->created_at->diffForHumans() }}</td>
			<td>
				<a href="{{ route('update/group', $group->id) }}" class="btn btn-mini">@lang('button.edit')</a>
				<a href="{{ route('delete/group', $group->id) }}" class="btn btn-mini btn-danger">@lang('button.delete')</a>
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

{{ $groups->links() }}

        


			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>


@stop