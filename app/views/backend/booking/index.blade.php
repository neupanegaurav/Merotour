@extends('backend/layouts/default')
@section('title')
{{ $q }} :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
            <!-- issued ticket -->
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
        <div class="btn-group">
            <a class="btn btn-primary" id="add-row" href="{{route('create/issued-tickets')}}"><i class="icon-pencil"></i> Add</a>            
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
                <th class="span2">Agent Name</th>
                <th class="span1">API</th>
                <th class="span2">Contact Name</th>
                <th class="span1">Sector</th>
                <th class="span1">Booked On</th>
                <th class="span1">Type</th>
                <th class="span2">Status</th>
                <th class="span1">@lang('table.actions')</th>
            </tr>
        </thead>
        <tbody>
            @if($entries->count() >= 1)
            @foreach($entries as $entry)
            <tr>
                <td>{{ $entry->id }}</td>
                <td>
                @if(Sentry::getUserProvider()->findById($entry->user_id)->inGroup(Sentry::getGroupProvider()->findById(3)))
                {{ Sentry::getUserProvider()->findById($entry->user_id)->first_name .", ". Sentry::getUserProvider()->findById($entry->user_id)->last_name }}
               <?php $type = 'B2B'; ?>
                @else

                Blackeye Travels Pvt. Ltd

                <?php $type = 'B2C'; ?>

                @endif

                </td>
                <td>{{ $entry->api }}</td>
                <td>{{ $entry->contact_name }}</td>
                <td>{{ $entry->departure .'-'. $entry->arrival }}</td>
                <td>{{ $entry->created_at }}</td>
                <td>{{ $type }}</td>
                <td>
                            <form method="post" action="{{route('status-change/issued-tickets', $entry->id)}}">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />       
                            <select name="status" class="pull-left" style="width:170px;">
                                <option {{ $entry->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option {{ $entry->status == 'Payment Processing' ? 'selected' : '' }}>Payment Processing</option>
                                <option {{ $entry->status == 'Order Completed' ? 'selected' : '' }}>Order Completed</option>
                                <option {{ $entry->status == 'Cancel Requested' ? 'selected' : '' }}>Cancel Requested</option>
                                <option {{ $entry->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            <button class="btn-mini btn-success pull-right" type="submit">Change</button> 
                            </form>
                </td>
                <td>
                    <form action="{{ route('pdf-generator')}}" method="post" target="_blank" >
                        <!-- CSRF Token -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="id" value="{{$entry->id}}" >

                        <button class="btn-mini" type="submit">Download PDF</button>
                    </form>

                    <a href="{{ route('details/issued-tickets', $entry->id) }}" class="btn btn-mini">Details</a>
                    <a href="{{ route('edit/issued-tickets', $entry->id) }}" class="btn btn-mini">Edit</a>
                    <a href="{{ route('delete/issued-tickets', $entry->id) }}" class="btn btn-mini btn-danger">@lang('button.delete')</a>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="9">No results found.</td>
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
