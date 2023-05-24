@extends('backend/layouts/default')
@section('title')
Account Transactions  :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
            Account Transactions 
            </h3>
            <!-- BEGIN BREADCRUMBS -->
      <ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    Account
                            <span class="icon-angle-right"></span>
                        </li>
                         

                                    <li>Account Transactions
                                                
                                        </li>
                                                       
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

                    <div class="control-group {{ $errors->has('from_date') ? 'error' : '' }}" style=" display:inline-block;">
                        <label class="control-label" for="from_date">From Date</label>
                        <div class="controls">
                            <input type="text" name="from_date" id="from_date" value="{{ Input::old('from_date') }}" />
                            {{ $errors->first('from_date', '<span class="help-inline">:message</span>') }}
                        </div>
                    </div>

                    <div class="control-group {{ $errors->has('to_date') ? 'error' : '' }}" style=" display:inline-block;">
                        <label class="control-label" for="to_date">To Date</label>
                        <div class="controls">
                            <input type="text" name="to_date" id="to_date" value="{{ Input::old('to_date') }}" />
                            {{ $errors->first('to_date', '<span class="help-inline">:message</span>') }}
                        </div>
                    </div>

                    <div class="control-group {{ $errors->has('currency') ? 'error' : '' }}" style=" display:inline-block;">
                        <label class="control-label" for="currency">Currency</label>
                        <div class="controls">
                        <select><option>NPR</option><option>USD</option></select>
                            {{ $errors->first('currency', '<span class="help-inline">:message</span>') }}
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
            <a class="btn btn-primary" id="add-row" href="{{route('create/general-voucher')}}"><i class="icon-pencil"></i> Add</a>            
        </div>
    </div>
    <!-- END TABLE TOOLS -->

    </div>
    <!-- BEGIN TABLE BODY -->
    <div class="body">     
    
    <table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
                        <th class="span2">Id</th>
                        <th class="span2">Account Name</th>
                        <th class="span2">Date</th>
                        <th class="span2">Voucher#</th> 
                        <th class="span2">Narration</th>
                        <th class="span2">Debit/Credit</th>
                        <th class="span2">Balance</th>
        </tr>
    </thead>
    <tbody>

    <?php 
                $user_list = array();
                $user = 
                $userprovider = Sentry::getUserProvider();
                $group = Sentry::getGroupProvider(); 
                $agent = $group->findById(3);
                $distributor = $group->findById(6);
                $branch_office = $group->findById(8); 
                $count1 = 1;

             ?>

    @foreach($entries as $entry)

    <?php

    $current_user = $userprovider->findById($entry->user_id);

    if($current_user->id != Sentry::getUser()->id) 
    {
        continue;       
    }


    ?>
        
        <tr>
            <td>{{$entry->id}}</td>
            <td>
                <?php $user = User::where('id', $entry->user_id)->first(); ?>
                @if(isset($user))
                <a href="{{ route('update/user', $user->id) }}"> {{ $user->first_name .' '. $user->last_name .'('.$user->email.')' }} </a>
                @endif
            </td>
            <td>{{$entry->date}}</td>
            <td>{{$entry->invoice_no}}</td>
            <td>{{$entry->remarks}}</td>
            <td>{{$entry->debit_credit}}</td>
            <td>{{$entry->amount}}</td>         
            
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


@stop
