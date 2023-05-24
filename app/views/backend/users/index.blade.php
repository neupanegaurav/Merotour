@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
User Management ::
@parent
@stop

{{-- Page content --}}
@section('content')
 
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
             @if(Request::is(Session::get('account_type') . '/b2c/userslist'))                
                B2C Users
             @else
                Manage Users
             @endif
            </h3>

            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
                    @if(Request::is(Session::get('account_type') . '/b2c/userslist'))                
                        B2C

                    @else
                        User Management
                    @endif			        
		          <span class="icon-angle-right"></span>
	            </li>
                <li>Users List </li>		                            
			</ul>
			<!-- END BREADCRUMBS -->

            <!-- BEGIN BREADCRUMBS -->
            <ul class="breadcrumb">                                   
           
                <form action="@if(Request::is(Session::get('account_type') . '/b2c/userslist'))
                {{route('b2c-userslist')}}
                @else
                {{route('users')}}
                @endif" method="post">
                                                                     
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 

                    <div class="control-group {{ $errors->has('first_name') ? 'error' : '' }}" style=" display:inline-block;">
                        <label class="control-label" for="first_name">Firstt Name</label>
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

    @if(Request::is(Session::get('account_type') . '/b2c/userslist'))
	   <a class="btn btn-medium" href="{{ URL::to(Session::get('account_type') . '/b2c/userslist' . '/?withTrashed=true') }}">Include Deleted Users</a>
	   <a class="btn btn-medium" href="{{ URL::to(Session::get('account_type') . '/b2c/userslist' . '/?onlyTrashed=true') }}">Include Only Deleted Users</a>
        @else
       <a class="btn btn-medium" href="{{ URL::to(Session::get('account_type') . '/users' . '/?withTrashed=true') }}">Include Deleted Users</a>
       <a class="btn btn-medium" href="{{ URL::to(Session::get('account_type') . '/users' . '/?onlyTrashed=true') }}">Include Only Deleted Users</a> 
    @endif

    <!-- BEGIN TABLE TOOLS -->
    <div class="tools">


        <div class="btn-group">
           
            <a class="btn btn-primary" id="add-row" href="{{ route('create/user') }}"><i class="icon-pencil"></i> Add</a>
            
        </div>
    </div>
    <!-- END TABLE TOOLS -->

    </div>
    <!-- BEGIN TABLE BODY -->
    <div class="body">
        <!-- BEGIN ADVANCED SEARCH EXAMPLE -->
        <div id="advanced-search" class="collapse">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-condensed well">
                <thead>
                <tr>
                    <th>Target</th>
                    <th>Search text</th>
                    <th>Treat as regex</th>
                    <th>Use smart search</th>
                </tr>
                </thead>
                <tbody>
                    <tr id="filter_global">
                        <td align="center">Global search</td>
                        <td align="center"><input type="text"     name="global_filter" id="global_filter"></td>
                        <td align="center"><input type="checkbox" name="global_regex"  id="global_regex" ></td>
                        <td align="center"><input type="checkbox" name="global_smart"  id="global_smart"  checked></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- END ADVANCED SEARCH EXAMPLE -->
        <!-- BEGIN TABLE DATA -->
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="editable">
            <!-- BEGIN -->
            <thead>
                <tr>
            <th class="span1">@lang('admin/users/table.id')</th>
			<th class="span2">@lang('admin/users/table.first_name')</th>
			<th class="span2">@lang('admin/users/table.last_name')</th>
			<th class="span3">@lang('admin/users/table.email')</th>
                        <!--<th class="span2">@lang('admin/users/table.role')</th>-->
			<th class="span2">@lang('admin/users/table.activated')</th>
			
             @if(Session::get('account_type') == 'admin')
            <th class="span3">Balance</th>
            @endif

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
                                <!--<td>{{ $user->role }}</td>-->
				<td>{{ $user->email }}</td>
				<td>@lang('general.' . ($user->isActivated() ? 'yes' : 'no'))</td>
				
                 @if(Session::get('account_type') == 'admin')
                <td class="span3">
                <?php

                $funds = Funds::where('user_id', $user->id)->first();

                if(empty($funds->balance)) {
                    echo '0';
                } else {
                    echo $funds->balance;
                }

                ?>
                </td>
                @endif

                <td>{{ $user->created_at->diffForHumans() }}</td>
				<td>
					<a href="{{ route('update/user', $user->id) }}" class="btn btn-mini">@lang('button.edit')</a>

					@if ( ! is_null($user->deleted_at))
					<a href="{{ route('restore/user', $user->id) }}" class="btn btn-mini btn-warning">@lang('button.restore')</a>
					@else
					@if (Sentry::getId() !== $user->id)
					<button data-toggle="modal" href="#delete_confirmation" link="{{ route('delete/user', $user->id) }}" class="btn btn-mini btn-danger delete ">@lang('button.delete')</button>
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

<div id="delete_confirmation" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
  <div class="modal-body">
    <p>Do you really want to delete this user?</p>
  </div>
  <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn">No</button>
    <a id="confirmed" href="" type="button" class="btn btn-primary">Yes, of course</a>
  </div>
</div>
         

@stop

@section('currentpagejs')

<script type="text/javascript">

    $(document).ready(function() {
        $('button.delete').click(function() {
            link = $(this).attr('link');
            $('#delete_confirmation #confirmed').attr('href', link);
            //alert(link);
        });
    });
</script>


@stop
