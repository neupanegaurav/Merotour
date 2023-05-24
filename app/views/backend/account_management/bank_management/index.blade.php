@extends('backend/layouts/default')
@section('title')
Bank Management :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Bank Management
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    Account Management
                            <span class="icon-angle-right"></span>
                        </li>
                         

                                    <li>Bank Management
                                                
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
    
    <table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
                        
                        <th class="span2">SN</th>
            <th class="span2">Bank</th>
                        <th class="span2">Phone no.</th>
                        <th class="span2">Contact Person</th>
                        
            <th class="span3">@lang('table.actions')</th>
        </tr>
    </thead>
    <tbody>
        
        <tr>
            <td>1</td>
            <td>Kist Bank Ltd.</td>
            <td>4430201</td>
            <td>Yalamber Nyaupane</td>        
                     
            <td>
                <a href="#" class="btn btn-mini btn-info">View</a>                                             
                <a href="#" class="btn btn-mini">Edit</a>                                            
                <a href="#" class="btn btn-mini btn-danger">@lang('button.delete')</a>                     
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
