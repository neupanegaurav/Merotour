@extends('backend/layouts/default')
@section('title')
Credit Limit Management(Agent) :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Credit Limit Management(Agent)
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    Account Management
                            <span class="icon-angle-right"></span>
                        </li>
                         

                                    <li>Credit Limit Management(Agent)
                                                
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
        <style>
    .social-box .header input {margin-top: 10px;}
    .social-box .btn {margin-right: 12px;}

    </style>
        <div class="social-box">
    <div class="header">

    <!-- BEGIN TABLE TOOLS -->
    <div class="tools">
    
        <div class="btn-group">
         <!-- <a class="btn btn-primary" id="add-row" href="#">View Unapproved Credit Limit</a> -->            
       
            <a class="btn btn-primary" id="add-row" href="{{route('create/c-l-m')}}"><i class="icon-pencil"></i> Add</a>            
        </div>
    </div>
    <!-- END TABLE TOOLS -->

    </div>
    <!-- BEGIN TABLE BODY -->
    <div class="body">     
    
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>             
                <th class="span1">SN</th>
                <th class="span3">Agent Details</th>
                <th class="span8">Details</th>             
            </tr>
        </thead>
        <tbody>


        @if(!$entries->isEmpty())
            <?php 
                $user_list = array();
                $userprovider = Sentry::getUserProvider();
                $group = Sentry::getGroupProvider(); 
                $agent = $group->findById(3); 
                $distributor = $group->findById(6);
                $count1 = 1;
             ?>

            @foreach($entries as $entry)

            <?php

            $current_user = $userprovider->findById($entry->user_id);

            ?>

            @if(!$current_user->inGroup($agent)) 

            <?php continue; ?>

            @endif


            @if(in_array($entry->user_id, $user_list))

            <?php continue; ?>

            @endif

            <?php $user_list[] = $entry->user_id; ?>

                <tr>
                    <td>{{ $count1 }}</td>
                    <td>
                        <?php $user = User::where('id', $entry->user_id)->first(); ?>
                        @if(isset($user))
                        <a href="{{ route('update/user', $user->id) }}"> {{ $user->first_name .' '. $user->last_name .'('.$user->email.')' }} </a>
                        @endif

                        <p> <strong>Company Name:</strong> {{$user->company_name}} </p>
                        <p> <strong>Normal Balance:</strong> Rs.{{ Funds::where('user_id', $user->id)->first()->balance }}  </p>
                        <p> <strong>Credit Limit:</strong> Rs.{{$user->credit_limit}} </p>
                        <p> <strong>Credit Balance:</strong> Rs.{{ Funds::where('user_id', $user->id)->first()->credit_balance }} </p>
                        <p> <strong>Used Credit:</strong> Rs.{{ Funds::where('user_id', $user->id)->first()->used_credit_balance }} </p>
                        <p> <strong>Left Credit:</strong> Rs.{{ Funds::where('user_id', $user->id)->first()->credit_balance }} </p>


                    </td>

                                
                                <td>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>                                 
                                                        <th class="span1">SN</th>
                                                        <th class="span1">Amount</th>
                                                        <th class="span2">Start Date</th>
                                                        <th class="span2">Expire Date</th>
                                                        <th class="span1">Currency</th>
                                                        <th class="span1">Status</th>
                                                        <th class="span1">Paid/Unpaid</th>
                                                        <th class="span1">Paid Date</th>
                                                        <th class="span2">@lang('table.actions')</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php $count2 = 1; ?>

                                        @foreach($entries as $detail)

                                            @if($detail->user_id == $entry->user_id)
                                                <tr>
                                                    <td>{{ $count2 }}</td>
                                                    <td>{{ $detail->amount }}</td>
                                                    <td>{{ $detail->start_date }}</td>
                                                    <td>{{ $detail->expire_date }}</td>
                                                    <td>{{$detail->currency}}</td>
                                         
                                                    <td>{{$detail->status}}</td>
                                                    <td>{{ $detail->paid_unpaid == '1' ? 'Paid' : 'Unpaid' }}</td> 
                                                    <td>{{$detail->paid_date}}</td> 
                                                
                                                    <td>
                                                        @if($detail->status == 'Pending')
                                                        <a href="{{route('approve/c-l-m', $detail->id)}}" class="pull-left btn btn-mini btn-success" style="margin-bottom:12px;">Approve</a>    
                                                        <a href="{{route('unapprove/c-l-m', $detail->id)}}" class="pull-left btn btn-mini btn-info" style="margin-bottom:12px;">Unapprove</a>    
                                                        
                                                        @endif
                                                        <a href="{{route('edit/c-l-m', $detail->id)}}" class="btn btn-mini">Edit</a>    
                                                                                
                                                        <a href="{{route('delete/c-l-m', $detail->id)}}" class="btn btn-mini btn-danger">@lang('button.delete')</a>                     
                                                    </td>
                                                </tr>
                                                <?php $count2++; ?>
                                            @endif

                                        @endforeach

                                        </tbody>

                                    </table>
                                </td>
                </tr> 

                <?php $count1++; ?>

                                      
            @endforeach

        @else

            <tr>
                <td colspan="4">
                    No entries found.
                </td>
            </tr>

        @endif

        </tbody>
    </table>

			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>


@stop
