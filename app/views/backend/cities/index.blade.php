@section('title')
List of Package Tours :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Cities Management
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			       Cities Management
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

            @if ( Sentry::getUser()->hasAnyAccess(array('admin', 'packagetours_create'))  )

               <div class="btn-group">
                   <a class="btn btn-primary" id="add-row" href="{{ route('cities-management/create') }}"><i class="icon-pencil"></i> Add</a>
                     
                </div>

            @endif

        </div>
        <!-- END TABLE TOOLS -->
    </div>
    <!-- BEGIN TABLE BODY -->
    <div class="body">
        
        @if ($entries->isEmpty())
    <span>There are currently no packages.</span>
    @endif
    
    @if (!$entries->isEmpty()) 

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>                       
            <th class="span2">Country</th>
            <th class="span2">City</th>
            <th class="span2">Latitude</th>
            <th class="span2">Longitude</th>
            <th class="span2">Altitude</th>
            
            <th class="span3">@lang('table.actions')</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($entries as $entry)
		<tr>
			<td>{{ $entry->country }}</td>
			<td>{{ $entry->city }}</td>
            <td>{{ $entry->latitude}}</td>
            <td>{{ $entry->longitude}}</td>
            <td>{{ $entry->altitude}}</td>
           

            <!-- diffForHumans()}}</td> -->
            <!-- ->diffForHumans()}}</td> -->
			<td>
                @if ( Sentry::getUser()->hasAnyAccess(array('admin', 'packagetours_edit')) )
    				<a href="{{ route('cities-management/edit', $entry->id) }}" class="btn btn-mini">Edit</a>    
                @endif   
                                                                
                @if ( Sentry::getUser()->hasAnyAccess(array('admin', 'packagetours_delete')) )  
				    <a href="{{ route('cities-management/delete', $entry->id) }}" class="btn btn-mini btn-danger">@lang('button.delete')</a>
                @endif                                  
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

{{ $entries->links() }}

@endif

        


			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>


@stop
