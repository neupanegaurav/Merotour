@extends('backend/layouts/default')

@section('title')
Banner Management :: @parent
@stop

@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Banner Management
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			<li>
			        <i class="icon-home"></i>
			        General Settings
			                <span class="icon-angle-right"></span>
			            </li>
			                        <li>Banner Management
			                                    
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
           <a class="btn btn-primary" id="add-row" href="{{ route('create/banner') }}"><i class="icon-pencil"></i> Add</a>
             
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
                        <th class="span2">Name</th>
						<th class="span2">Thumbnail</th>                        
                        <th class="span2">Created at</th>
                        <th class="span2">Updated at</th>
                        
			<th class="span3">@lang('table.actions')</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($entries as $entry)
		<tr>
			<td>{{ $entry->id }}</td>
			<td>{{ $entry->name }}</td>
            <td><img src="{{ asset('assets/img/uploads/banners/' .$entry->icon)  }}"></td>
            <td>{{ $entry->description }}</td>                             
			<td>{{ $entry->created_at->diffForHumans() }}</td>
			<td>{{ $entry->updated_at->diffForHumans() }}</td>
			<td>
                            
				<a href="{{ route('edit/banner', $entry->id) }}" class="btn btn-mini">Edit</a>    
                                                    
                              
				<a href="{{ route('delete/banner', $entry->id) }}" class="btn btn-mini btn-danger">@lang('button.delete')</a>
                             
                                
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


