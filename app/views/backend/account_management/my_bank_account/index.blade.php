@extends('backend/layouts/default')
@section('title')
My Bank Account :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                My Bank Account
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    Account Management
                            <span class="icon-angle-right"></span>
                        </li>
                         

                                    <li>My Bank Account
                                                
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
            <a class="btn btn-primary" id="add-row" href="#"><i class="icon-pencil"></i> Add</a>            
        </div>
    </div>
    <!-- END TABLE TOOLS -->

    </div>
    <!-- BEGIN TABLE BODY -->
    <div class="body">     
    
    <table class="table table-bordered table-striped table-hover" style="margin-top:12px;">
                            <thead>
                                <tr>
                                                
                                    <th class="span2">SN</th>
                                    <th class="span2">Bank</th>
                                    <th class="span2">Branch</th>
                                    
                                    <th class="span2">Account Name</th>
                                    <th class="span2">Account Number</th>   
                                    <th class="span2">Swift Code</th>
                                    <th class="span2">Company Name</th>                 
                                    <th class="span3">@lang('table.actions')</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($entries as $entry)
                                
                                <tr>

                                    <td>1</td>
                                    <td>{{$entry->bank}}</td> 
                                    <td>{{$entry->branch}}</td>
                                    <td>{{$entry->account_name}}</td>
                                    <td>{{$entry->account_number}}</td>
                                    <td>{{$entry->swift_code}}</td>
                                    <td>{{$entry->company_name}}</td>
                                         
                                             
                                    <td>                                                                                    
                                        <a href="#" class="btn btn-mini">Edit</a>                                            
                                        <a href="#" class="btn btn-mini btn-danger">@lang('button.delete')</a>                     
                                    </td>
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
