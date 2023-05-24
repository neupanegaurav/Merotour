@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Agent Management ::
@parent
@stop

{{-- Page content --}}
@section('content')
 
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Manage Agents
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Agent Management
			                <span class="icon-angle-right"></span>
			            </li>
			                        <li>Manage Agents
			                                    
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
			<th class="span2">Balance(NRS)</th>
                </tr>
            </thead>
            <!-- END -->
            <!-- BEGIN -->
            <tbody>

                <?php

                $userprovider = Sentry::getUserProvider();
                $group = Sentry::getGroupProvider();
                $agent = $group->findById(3); 

                ?>
                                       
                                       

            	@foreach ($users as $user)

                   <?php

                   $current_user = $userprovider->findById($user->id);

                   ?>

                   @if($current_user->inGroup($agent))

               
            			<tr>
            				<td>{{ $user->id }}</td>
            				<td>{{ $user->first_name }}</td>
            				<td>{{ $user->last_name }}</td>
            				<td>{{ $user->email }}</td>
            				<td>@lang('general.' . ($user->isActivated() ? 'yes' : 'no'))</td>
            				<td>{{ $user->created_at->diffForHumans() }}</td>
            				 @if(Session::get('account_type') == 'admin')
                            <td class="span3">
                            <?php

                            $funds = Funds::where('user_id', $user->id)->first();

                            if(empty($funds->balance)) {
                                echo '0';
                            }
                            else {

                                echo $funds->balance;

                            }

                            ?>
                            </td>
                            @endif
            			</tr>

                    @endif

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
