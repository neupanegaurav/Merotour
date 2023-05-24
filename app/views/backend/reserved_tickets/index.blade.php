@extends('backend/layouts/default')
@section('title')
{{ $q }} :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                {{ $q }} 
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    Airlines
                    <span class="icon-angle-right"></span>
                </li>
                <li> 
                         {{ $q }}                   
                </li>      
               
                                                       
            </ul>
			<!-- END BREADCRUMBS -->
        </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN DYNAMIC TABLE EXAMPLE -->
        <div class="social-box" style="display:inline-block; width:1126px;">           

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
                <th class="span1">Id</th>
                @if (Session::get('account_type') == 'admin')
                    <th class="span2">Reserved By</th>
                @endif
                <th class="span1">API</th>
                <th class="span1">Sector</th>
                <th class="span1">Airline</th>
                <th class="span1">Class Code</th>
                <th class="span2">Booked On</th>
                <th class="span1">Reservation Status</th>
                <th class="span2">@lang('table.actions')</th>
            </tr>
        </thead>
        <tbody>
            @if($entries->count() >= 1)
            @foreach($entries as $entry)
            <tr>
                <td>{{ $entry->id }}</td>
                @if (Session::get('account_type') == 'admin')
                    <td>
                        {{ Sentry::getUserProvider()->findById($entry->user_id)->first_name .", ". Sentry::getUserProvider()->findById($entry->user_id)->last_name }}
                    </td>
                @endif
                <td>{{ $entry->api }}</td>
                <td>{{ $entry->departure .'-'. $entry->arrival }}</td>
                <td> {{ $entry->airline }} ({{ $entry->airline_id }})</td>
                <td> {{ $entry->class_code }}</td>
                <td> {{ $entry->created_at }} ({{ $entry->created_at->diffForHumans() }}) </td>
                <td> {{ $entry->reservation_status }} </td>
                <td>
                    <a href="{{ route('details/reserved-tickets', $entry->id) }}" class="btn btn-mini">Details</a>
                    <a href="{{ route('edit/reserved-tickets', $entry->id) }}" class="btn btn-mini">Edit</a>
                    <a href="{{ route('delete/reserved-tickets', $entry->id) }}" class="btn btn-mini btn-danger">@lang('button.delete')</a>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="5">No results</td>
            </tr>
            @endif
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
