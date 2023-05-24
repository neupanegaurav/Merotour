@extends('backend/layouts/default')
@section('title')
Cancel Request :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Cancel Request
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    Airlines
                          
                </li>                                             
            </ul>
			<!-- END BREADCRUMBS -->

            <!-- BEGIN BREADCRUMBS -->
            <ul class="breadcrumb">   
                <form action="{{URL::route('issued-tickets-search')}}" method="post">
                                                                     
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 

                    <div class="control-group {{ $errors->has('query') ? 'error' : '' }}" style=" display:inline-block;">
                        <label class="control-label" for="query">Search according to Customer Name</label>
                        <div class="controls">
                            <input type="text" name="query" id="query" value="{{ Input::old('query') }}" />
                            {{ $errors->first('query', '<span class="help-inline">:message</span>') }}
                        </div>
                    </div>

                    
                    <div class="search" style=" display:inline-block; position:absolute; margin-top:26px;">
                                            <input type="submit" name="search" value="SEARCH" style="height: 30px;">
                                        </div> 

                </form>                                        
                                        
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
                <th class="span2">Contact Name</th>
                <th class="span2">Sector</th>
                <th class="span2">Booked On</th>
                <th class="span2">@lang('table.actions')</th>
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
                
                <td>{{ $entry->contact_name }}</td>
                <td>{{ $entry->departure .'-'. $entry->arrival }}</td>
                <td>{{ $entry->created_at }}</td>
                <td>
                    <a href="{{ route('cancel/cancel-request', $entry->id) }}" class="btn btn-mini btn-danger">Cancel Ticket</a>
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
