@extends('backend/layouts/default')
@section('title')
Unapproved Voucher :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Unapproved Voucher
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    Account Management
                            <span class="icon-angle-right"></span>
                        </li>
                         

                                    <li>Unapproved Voucher
                                                
                                        </li>
                                                       
            </ul>
			<!-- END BREADCRUMBS -->
            <!-- BEGIN BREADCRUMBS -->
            <ul class="breadcrumb">                                   
           
                <form action="
                {{route('unapprove-voucher')}}
                " method="post">
                                                                     
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

                    <div class="control-group {{ $errors->has('invoice_no') ? 'error' : '' }}" style=" display:inline-block;">
                        <label class="control-label" for="invoice_no">Invoice No.</label>
                        <div class="controls">
                            <input style="width:100px;" type="text" name="invoice_no" id="invoice_no" value="{{ Input::old('invoice_no') }}" />
                            {{ $errors->first('invoice_no', '<span class="help-inline">:message</span>') }}
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
            <a class="btn btn-primary" id="add-row" href="{{route('create/unapprove-voucher')}}"><i class="icon-pencil"></i> Add</a>            
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
                            <th class="span2">Invoice No.</th>
                            <th class="span2">Name</th>
                            <th class="span2">For</th>
                            <th class="span2">Debit/Credit</th>
                            <th class="span2">Amount</th>
                            <th class="span2">Currency</th>                      
                            <th class="span2">Remarks</th>                        
                            
                <th class="span2">Created at</th>
                <th class="span3">@lang('table.actions')</th>
            </tr>
        </thead>
        <tbody>

            @foreach($entries as $entry)
            
                <tr>
                    <td>{{$entry->id}}</td>
                    <td>{{$entry->invoice_no}}</td>
                    @if(Session::get('account_type') == 'admin')
                        <td>
                            <?php $user = User::where('id', $entry->user_id)->first(); ?>
                            @if(isset($user))
                            <a href="{{ route('update/user', $user->id) }}"> {{ $user->first_name .' '. $user->last_name .'('.$user->email.')' }} </a>
                            @endif
                        </td>
                    @endif

                    <td>{{$entry->payment_for}}</td>
                    <td>{{$entry->debit_credit}}</td>
                    <td>{{$entry->amount}}</td>
                    <td>{{$entry->currency}}</td>           
                    <td>{{$entry->remarks}}</td>
                    <td>{{$entry->created_at}}</td>
                             
                    <td>
                        <a href="{{route('edit/unapprove-voucher', $entry->id)}}" class="btn btn-mini">Edit</a>    
                        <a href="{{route('delete/unapprove-voucher', $entry->id)}}" class="btn btn-mini btn-danger">@lang('button.delete')</a>    
                    </td>
                </tr>

            @endforeach

        </tbody>
        
    </table>

   {{$entries->links()}}     


			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>


@stop
