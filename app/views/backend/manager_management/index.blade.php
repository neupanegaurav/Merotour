@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Manager Management ::
@parent
@stop

{{-- Page content --}}
@section('content')
 
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Manage Managers
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Manager Management
			                <span class="icon-angle-right"></span>
			            </li>
			                        <li>Manage Managers
			                                    
			                            </li>
			                                           
			                            
			</ul>
			<!-- END BREADCRUMBS -->

            <!-- BEGIN BREADCRUMBS -->
            <ul class="breadcrumb">                                   
           
                <form action="" method="post">
                                                                     
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 

                    <div class="control-group {{ $errors->has('first_name') ? 'error' : '' }}" style=" display:inline-block;">
                        <label class="control-label" for="first_name">First Name</label>
                        <div class="controls">
                            <input type="text" name="first_name" id="first_name" value="{{ Input::old('first_name') }}" />
                            {{ $errors->first('first_name', '<span class="help-inline">:message</span>') }}
                        </div>
                    </div>

                    <div class="control-group {{ $errors->has('last_name') ? 'error' : '' }}" style=" display:inline-block;">
                        <label class="control-label" for="last_name">Last Name</label>
                        <div class="controls">
                            <input type="text" name="last_name" id="last_name" value="{{ Input::old('last_name') }}" />
                            {{ $errors->first('last_name', '<span class="help-inline">:message</span>') }}
                        </div>
                    </div>
  
                    <div class="search" style=" display:inline-block; margin-top:-10px; vertical-align: middle;">
                        <input type="submit" name="search" value="SEARCH" >
                    </div> 
                </form>                                                                              
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
            <a class="btn btn-primary" id="add-row" href="{{ route('create/manager') }}"><i class="icon-pencil"></i> Add</a>   
        </div>
    </div>
    <!-- END TABLE TOOLS -->

    </div>
    <!-- BEGIN TABLE BODY -->
    <div class="body">      
        
        <!-- BEGIN TABLE DATA -->
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="editable">
            <!-- BEGIN -->
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
            <!-- END -->
            <!-- BEGIN -->
            <tbody>

            	@foreach ($users as $user)

            			<tr>
            				<td>{{ $user->id }}</td>
            				<td>{{ $user->first_name }}</td>
            				<td>{{ $user->last_name }}</td>
            				<td>{{ $user->email }}</td>
            				<td>@lang('general.' . ($user->isActivated() ? 'yes' : 'no'))</td>
            				<td>{{ $user->created_at->diffForHumans() }}</td>
            				<td span="3">
            					<a href="{{ route('edit/manager', $user->id) }}" class="btn btn-mini">@lang('button.edit')</a>
                    
            					@if ( ! is_null($user->deleted_at))
            					<a href="{{ route('restore/manager', $user->id) }}" class="btn btn-mini btn-warning">@lang('button.restore')</a>
            					@else
            					@if (Sentry::getId() !== $user->id)
            					<a href="{{ route('delete/manager', $user->id) }}" class="btn btn-mini btn-danger">@lang('button.delete')</a>
            					@else
            					<span class="btn btn-mini btn-danger disabled">@lang('button.delete')</span>
            					@endif
            					@endif
            				</td>
            			</tr>
             
            	@endforeach

            </tbody>
            <!-- END -->
        </table>


			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>
         

@stop
