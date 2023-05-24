@extends('backend/layouts/default')
@section('title')
Deposit Update :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Deposit Update
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    Account Management
                            <span class="icon-angle-right"></span>
                        </li>
                         

                                    <li>Deposit Update
                                                
                                        </li>
                                                       
            </ul>
			<!-- END BREADCRUMBS -->
        </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN DYNAMIC TABLE EXAMPLE -->
        <style>
    .social-box .header input {margin-top: 10px;}
    .social-box .header .btn {margin-right: 12px;}

    </style>
        <div class="social-box">
    <div class="header">



     
    Agent <input type="text" > 
    <a class="btn btn-info"  id="add-row" href="#"> Search</a>            
       

    <!-- BEGIN TABLE TOOLS -->
    <div class="tools">

    
    
    
        <div class="btn-group">
         <a class="btn btn-primary" id="add-row" href="#">View Unapproved Payment</a>            
       
            <a class="btn btn-primary" id="add-row" href="#"><i class="icon-pencil"></i> Add</a>            
        </div>
    </div>
    <!-- END TABLE TOOLS -->

    </div>
    <!-- BEGIN TABLE BODY -->
    <div class="body">     
    
    <table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
                        
                        <th class="span2">SN</th>
            <th class="span2">Agency Name</th>
                        <th class="span2">Agency Code</th>
                        <th class="span2">Details</th>
                       
            
        </tr>
    </thead>
    <tbody>
        
        <tr>
            <td>1</td>
            <td>Hari Bahadur</td>
                        <td>AG-234</td>
                        <td>
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                                    
                                                    <th class="span1">SN</th>
                                        <th class="span2">Payment Mode</th>
                                                    <th class="span1">Deposit Amount</th>
                                                    <th class="span1">Currency</th>
                                                    <th class="span2">Deposit Update</th>
                                                    <th class="span2">Status</th>
                                                   
                                        <th class="span3">@lang('table.actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
        
                                    <tr>
                                    <td>1</td>
                                    <td>Cash</td>
                                    <td>50,000</td>
                                    <td>Nepali</td>
                                    <td>09 Jan 2014</td>
                                    <td>Processing</td>
                                    
                                     <td>

                                      <a href="#" class="btn btn-mini btn-info">View</a>    
                                                   

                                        <a href="#" class="btn btn-mini">Edit</a>    
                                                                
                                         <a href="#" class="btn btn-mini btn-danger">@lang('button.delete')</a>                     
                                    </td>
                                    </tr>

                                </tbody>

                                </table>


                        


                        </td>
                        
                     
           
        </tr>
        
    </tbody>
</table>

        


			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>


@stop
