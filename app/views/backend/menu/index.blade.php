@extends('backend/layouts/default')

@section('title')
List of Menu Items:: @parent
@stop

@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Menu Management
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			<li>
			        <i class="icon-home"></i>
			        General Settings
			                <span class="icon-angle-right"></span>
			            </li>
			                        <li>Menu Management
			                                    
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
           <a class="btn btn-primary" id="add-row" href="{{ route('create_menu') }}"><i class="icon-pencil"></i> Create Menu</a>
             
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
                        <th class="span2">Title</th>
			<th class="span3">Content</th>
                        <th class="span2">Created_at</th>
			<th class="span2">Updated at</th>
			<th class="span3">@lang('table.actions')</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($entries as $entry)
		<tr>
                        <td>{{ $entry->slug }}</td>
                        <td>{{ $entry->title }}</td>
			<td>{{ html_entity_decode(Str::words($entry->content, 10))}}</td>
                        <td>{{ $entry->created_at->diffForHumans()}}</td>
                        <td>{{ $entry->updated_at->diffForHumans()}}</td>
                     
			<td>
				
                                
                                @if ($entry->enable == 1)
                                
                                <a href="{{ route('disable_menu', $entry->id) }}" class="btn btn-mini btn-info">Disable</a>
                                
       
                                @else
                                
				<a href="{{ route('enable_menu', $entry->id) }}" class="btn btn-mini">Enable</a>
                                
                                @endif
                                
                                @if ($entry->editable == 1)
                                
                                <a href="{{ route('edit_menu', $entry->id) }}" class="btn btn-mini">Edit</a>
                                
                                <a href="{{ route('delete_menu', $entry->id) }}" class="btn btn-mini btn-danger">@lang('button.delete')</a>
                                
                                @endif
				
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
