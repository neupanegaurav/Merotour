@extends('backend/layouts/default')

@section('title')
List of Vacation Rentals :: @parent
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
     
    @if($slug == 'Vacation Rental')

       @if (Sentry::getUser()->hasAnyAccess(array('admin', 'vacationrentals_create')) )
        
           <div class="btn-group">
               <a class="btn btn-primary" id="add-row" href="{{ route('create_vacation_rentals') }}"><i class="icon-pencil"></i> Add</a>
                 
            </div>
        @endif

        @elseif($slug == 'Vacation Rental Deal Setup')

                <div class="btn-group">
                   <a class="btn btn-primary" id="add-row" href="{{ route('create-dealsetup/vacation-rentals') }}"><i class="icon-pencil"></i> Add</a>                 
                </div>
    @endif  


    </div>
    <!-- END TABLE TOOLS -->

    </div>
    <!-- BEGIN TABLE BODY -->
    <div class="body">
        
        @if ($entries->isEmpty())
    <span>There are currently no vacation rentals added.</span>
    @endif
    
    @if (!$entries->isEmpty()) 

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
                        
                        <th class="span2">Name</th>
			<th class="span2">Country</th>
                        <th class="span2">City</th>
                        <th class="span2">Rooms available</th>
                        <th class="span2">Price per room</th>
                        <th class="span2">Created at</th>
			<th class="span2">Updated at</th>
			<th class="span3">@lang('table.actions')</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($entries as $entry)
		<tr>
			<td>{{ $entry->name }}</td>
			<?php $country = Country::where('id', $entry->country)->first(); ?>
            <td>{{ isset($country) ? $country->value : '' }}</td>
            <td>{{ $entry->city}}</td>
            <td>{{ $entry->room}}</td>
            <td>{{ $entry->price}}</td>
            <td>{{ $entry->created_at->diffForHumans()}}</td>
            <td>{{ $entry->updated_at->diffForHumans()}}</td>
                     
			<td>
                            @if ( Sentry::getUser()->hasAnyAccess(array('admin', 'vacationrentals_edit')) )

				<a href="{{ route('edit_vacation_rentals', $entry->id) }}" class="btn btn-mini">Edit</a> 
                                
                            @endif
                            @if ( Sentry::getUser()->hasAnyAccess(array('admin', 'vacationrentals_delete')) )

				<a href="{{ route('delete_vacation_rentals', $entry->id) }}" class="btn btn-mini btn-danger">@lang('button.delete')</a>
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