@section('title')
List of Flight Airports :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Flight Airports
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			       Flight Airports
			    </li>                      
			</ul>
			<!-- END BREADCRUMBS -->

            <!-- BEGIN BREADCRUMBS -->
            <ul class="breadcrumb">                                   
           
                <form action="{{URL::route('airport-search')}}" method="post">
                                                                     
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 

                    <div class="control-group {{ $errors->has('query') ? 'error' : '' }}" style=" display:inline-block;">
                        <label class="control-label" for="query">Search Airports</label>
                        <div class="controls">
                            <input type="text" name="query" id="query" value="{{ Input::old('query') }}" />
                            {{ $errors->first('query', '<span class="help-inline">:message</span>') }}
                        </div>
                    </div>

                    <div class="control-group {{ $errors->has('query') ? 'error' : '' }}" style=" display:inline-block;">
                        <label class="control-label" for="query">Category</label>
                        <div class="controls">
                            <select><option>Domestic</option><option>International</option></select>
                            {{ $errors->first('query', '<span class="help-inline">:message</span>') }}
                        </div>
                    </div>
        
                    <div class="search" style=" display:inline-block; margin-top:-10px; vertical-align: middle;">
                        <input type="submit" name="search" value="SEARCH" >
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

    @if ( Sentry::getUser()->hasAnyAccess(array('admin', 'packagetours_create')) )

       <div class="btn-group">
           <a class="btn btn-primary" id="add-row" href="{{ route('create_airport') }}"><i class="icon-pencil"></i> Add</a>
             
        </div>
    @endif
    </div>
    <!-- END TABLE TOOLS -->

    </div>
    <!-- BEGIN TABLE BODY -->
    <div class="body">
        
        @if ($entries->isEmpty())
    <span>There are currently no orders.</span>
    @endif
    
    @if (!$entries->isEmpty()) 

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
                        
                        <th class="span2">Name</th>
			<th class="span2">Country</th>
                        <th class="span2">State id</th>
                        <th class="span2">City id</th>
                        <th class="span2">ICAO code</th>
                        <th class="span2">IATA code</th>    
                        <th class="span2">Created_at</th>
			<th class="span2">Updated at</th>
			<th class="span3">@lang('table.actions')</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($entries as $entry)
		<tr>
        
			<td>{{ $entry->airport_name }}</td>            
			<td>{{ Country::where('id',$entry->country_id)->first()->value}}</td>
                        <td>{{ $entry->state_id}}</td>
                        <td>{{ $entry->city_id}}</td>
                         <td>{{ $entry->icao_code}}</td>
                          <td>{{ $entry->iata_code}}</td>
                        <td> {{ $entry->created_at->diffForHumans()}}</td>
                        <td>{{ $entry->updated_at->diffForHumans()}}</td>
                     
			<td>
				<a href="{{ route('edit_airport', $entry->id) }}" class="btn btn-mini">Edit</a>                                                      
				<a href="{{ route('delete_airport', $entry->id) }}" class="btn btn-mini btn-danger">@lang('button.delete')</a>
                                
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
