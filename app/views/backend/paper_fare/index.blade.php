@extends('backend/layouts/default')
@section('title')
Airline Paper Fare :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Airline Paper Fare 
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    Paper Fare
                            <span class="icon-angle-right"></span>
                </li>
                         
                <li> Airline </li>
                                                       
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

    
        <div class="btn-group">
            <a class="btn btn-primary" id="add-row" href="{{route('create/deal-setup')}}"><i class="icon-pencil"></i> Add</a>            
            
        </div>
    </div>
    <!-- END TABLE TOOLS -->

    </div>
    <!-- BEGIN TABLE BODY -->
    <div class="body"> 

                       
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th class="span1">Id</th>
                <th class="span2">From</th>
                <th class="span2">To</th>
                <th class="span2">Airline</th>
                <th class="span2">Flight Number</th>
                <th class="span2">Effective From</th>
                <th class="span2">Expire On</th>
                <th class="span2">@lang('table.actions')</th>
            </tr>
        </thead>
        <tbody>
            @if ($entries->count() >= 1)
            @foreach ($entries as $entry)
            <tr>
                <td>{{ $entry->id }}</td>
                <td>{{ $entry->setup_from }}</td>
                <td>{{ $entry->setup_to }}</td>
                <td>{{ $entry->airline }}</td>
                <td>{{ $entry->flight_number }}</td>
                <td>{{ $entry->effective_from }}</td>
                <td>{{ $entry->expire_on }}</td>
                <td>
                    <a href="{{ route('edit/deal-setup', $entry->id) }}" class="btn btn-mini">@lang('button.edit')</a>
                    <a href="{{ route('delete/deal-setup', $entry->id) }}" class="btn btn-mini btn-danger">@lang('button.delete')</a>
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

                                                      

			        <!-- END TABLE DATA -->
	</div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>


@stop
