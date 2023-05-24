@extends('backend/layouts/default')
@section('title')
Payment Verify :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Payment Verify
            </h3>
            <!-- BEGIN BREADCRUMBS -->
            <ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    Account Management
                            <span class="icon-angle-right"></span>
                        </li>
                         

                                    <li>Payment Verify
                                                
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
            @if($entries->isEmpty())
                <tr>
                <td colspan="8"> There are currently no verification requests.</td>
                </tr>
            @else

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
                            <a style="width:58px; margin-bottom:5px;" href="{{ route('approve/payment-verify', $entry->id) }}" class="btn btn-mini btn-success">Approve</a>                                      
                            <a href="{{ route('unapprove/payment-verify', $entry->id) }}" class="btn btn-mini btn-danger">Unapprove</a>                     
                        </td>
                    </tr>

                @endforeach

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
