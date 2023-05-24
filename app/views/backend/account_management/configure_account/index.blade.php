@extends('backend/layouts/default')
@section('title')
Configure Account :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Configure Account
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    Account Management
                            <span class="icon-angle-right"></span>
                        </li>
                         

                                    <li>Configure Account
                                                
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

    </div>
    <!-- END TABLE TOOLS -->

    </div>
    <!-- BEGIN TABLE BODY -->
    <div class="body">     
    
    <table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
                        
                        <th class="span2">Account Name</th>
                        <th class="span2">Ledger</th>
            
        </tr>
    </thead>
    <tbody>


        
        <tr>
            <td>Discount Account</td>
            <td><select><option>{{$entry->discount_account}}</option></select></td>
                        
                     
            
        </tr>
        <tr>
            <td>Commission Account</td>
            <td><select><option>{{$entry->commission_account}}</option></select></td>
                        
                     
            
        </tr>
        <tr>
            <td>Tax Account</td>
            <td><select><option>{{$entry->tax_account}}</option></select></td>           
        </tr>

        <tr>
            <td>Default Airline Settlement</td>
            <td><select><option>{{$entry->default_airline_settlement}}</option></select></td>
        </tr>

        <tr>
            <td>Purchase Account</td>
            <td><select><option>{{$entry->purchase_account}}</option></select></td>
        </tr>

        <tr>
            <td>Sales Account</td>
            <td><select><option>{{$entry->sales_account}}</option></select></td>
        </tr>

        <tr>
            <td>Markup Account</td>
            <td><select><option>{{$entry->markup_account}}</option></select></td>
        </tr>

        <tr>
            <td>Cash Account</td>
            <td><select><option>{{$entry->cash_account}}</option></select></td>
        </tr>

        <tr>
            <td>Suspension Account</td>
            <td><select><option>{{$entry->suspension_account}}</option></select></td>
        </tr>

        <tr>
            <td>Service Charge</td>
            <td><select><option>{{$entry->service_charge}}</option></select></td>
        </tr>
        
    </tbody>
</table>


<a href="#" class="btn btn-mini pull-right" style="margin-bottom:10px;">Save</a>    

<br clear="all">
        


			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>


@stop
