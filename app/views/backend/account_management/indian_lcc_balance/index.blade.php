@extends('backend/layouts/default')
@section('title')
Indian LCC Balance :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Indian LCC Balance
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    Account Management
                            <span class="icon-angle-right"></span>
                </li>
                         
                <li> Indian LCC Balance </li>
                                                       
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
    
     <a href="#" class="btn btn-mini btn-info">Check</a> 

    
         
         INR 86,000.2304

     

     
                                               
               
        


			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>


@stop
