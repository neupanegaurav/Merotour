@extends('backend/layouts/default')

@section('title')
List of Vehicle Rentals :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                {{ $slug }}
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			       {{ $slug }}
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

      @if($slug == 'Vehicle Rental')

       @if (Sentry::getUser()->hasAnyAccess(array('admin', 'vehiclerentals_create')) )
        
           <div class="btn-group">
               <a class="btn btn-primary" id="add-row" href="{{ route('create_vehicle_rentals') }}"><i class="icon-pencil"></i> Add</a>
                 
            </div>
        @endif

        @elseif($slug == 'Vehicle Rental Deal Setup')

                <div class="btn-group">
                   <a class="btn btn-primary" id="add-row" href="{{ route('create-dealsetup/vacation-rentals') }}"><i class="icon-pencil"></i> Add</a>                 
                </div>
    @endif  


     @if ( Sentry::getUser()->hasAnyAccess(array('admin', 'vehiclerentals_create')) )
	
       <div class="btn-group">
           <a class="btn btn-primary" id="add-row" href="{{ route('create_vehicle_rentals') }}"><i class="icon-pencil"></i> Add</a>
             
        </div>
    @endif

    </div>
    <!-- END TABLE TOOLS -->

    </div>
    <!-- BEGIN TABLE BODY -->
    <div class="body">
        
       @if ($entries->isEmpty())
    <span>There are currently no vehicle rentals added.</span>
    @endif
    
    @if (!$entries->isEmpty()) 

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
                        
                        <th class="span2">Name</th>
                        <th class="span2">Description</th>
			<th class="span2">Country</th>
                        <th class="span2">City</th>
                        <th class="span2">Going from</th>
                        <th class="span2">Going to</th>
                        <th class="span2">Price</th>
                        <th class="span2">Created at</th>
			<th class="span2">Updated at</th>
			<th class="span3">@lang('table.actions')</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($entries as $entry)
		<tr>
      <td>{{ $entry->name }}</td>
      <td>{{ $entry->description}}</td>
      <?php $country = Country::where('id', $entry->country)->first(); ?>
      <td>{{ isset($country) ? $country->value : '' }}</td>
      <td>{{ $entry->city}}</td>
      <td>{{ $entry->trip_from}}</td>
      <td>{{ $entry->trip_to}}</td>                     
      <td>${{ $entry->cost}}</td>
      <td>{{ $entry->created_at->diffForHumans()}}</td>
      <td>{{ $entry->updated_at->diffForHumans()}}</td>
                     
			<td>
                            
     @if ( Sentry::getUser()->hasAnyAccess(array('admin', 'vehiclerentals_edit')) )                       
				<a href="{{ route('edit_vehicle_rentals', $entry->id) }}" class="btn btn-mini">Edit</a>
              @endif                  
   
     @if ( Sentry::getUser()->hasAnyAccess(array('admin', 'vehiclerentals_delete')) )                             
				<a href="{{ route('delete_vehicle_rentals', $entry->id) }}" class="btn btn-mini btn-danger">@lang('button.delete')</a>
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