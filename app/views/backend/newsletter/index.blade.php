@extends('backend/layouts/default')

@section('title')
Newsletter :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Newsletter Management
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			<li>
			        <i class="icon-home"></i>
			        General Settings
			                <span class="icon-angle-right"></span>
			            </li>
			                        <li>Newsletter Management
			                                    
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
           <a class="btn btn-primary" id="add-row" href="{{ route('send-newsletter') }}"><i class="icon-pencil"></i> Send Mass Newsletter</a>
             
        </div>
   
    </div>
    <!-- END TABLE TOOLS -->

    </div>
    <!-- BEGIN TABLE BODY -->
    <div class="body">
        
   <table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
                        <th class="span2">Name</th>
                        <th class="span2">Email</th>
			
                        <th class="span2">Created_at</th>
			<th class="span2">Updated at</th>
			<th class="span3">@lang('table.actions')</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($entries as $entry)
		<tr>
                        <td>{{ $entry->name }}</td>
                        <td>{{ $entry->email }}</td>
			<td>{{ $entry->created_at->diffForHumans()}}</td>
                        <td>{{ $entry->updated_at->diffForHumans()}}</td>
                     
			<td>
				<a href="{{ route('edit_newsletter', $entry->id) }}" class="btn btn-mini">Edit</a> 
                                <a href="{{ route('delete_newsletter', $entry->id) }}" class="btn btn-mini btn-danger">Delete</a> 
                               
                               
				
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

{{ $entries->links() }}



			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>


@stop
