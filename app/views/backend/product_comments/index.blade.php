@extends('backend/layouts/default')

@section('title')
List of Comments:: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Comments Management
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			<li>
			        <i class="icon-home"></i>
			        General Settings
			                <span class="icon-angle-right"></span>
			            </li>
			                        <li>Comments Management
			                                    
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
                        <th class="span3">First Name</th>
                        <th class="span3">Last Name</th>
                       
                        <th class="span2">Product Type</th>
                        <th class="span2">Product Id</th>          
			<th class="span3">Content</th>
                        <th class="span2">Created_at</th>
			<th class="span2">Updated at</th>
			<th class="span3">@lang('table.actions')</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($entries as $entry)
                
                {{-- */ $user = Sentry::getUserProvider()->findById($entry->user_id); /*--}}
		<tr>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name}}</td>
                        <td>{{ $entry->product_type }}</td>
                        <td>{{ $entry->product_id }}</td>
                       
			<td>{{ html_entity_decode(Str::words($entry->content, 10))}}</td>
                        <td>{{ $entry->created_at->diffForHumans()}}</td>
                        <td>{{ $entry->updated_at->diffForHumans()}}</td>
                     
			<td>
				
           
                                <a href="{{ route('edit_pcomment', $entry->id) }}" class="btn btn-mini">Edit</a>
                                
                                <a href="{{ route('delete_pcomment', $entry->id) }}" class="btn btn-mini btn-danger">@lang('button.delete')</a>
                                
                           
				
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

