@section('content')



<div id="right_section">
    
    <div id="right_header">
	<h3>
		View Inquiry

		<div class="pull-right">
			<a href="{{ route('inquiries') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> Back</a>
		</div>
	</h3>
</div>

<table class="table table-bordered table-striped table-hover">
	
    <tr>                  
        <th class="span2">Name</th>
        <td>{{ $entry->name }}</td>
    </tr>
    
    <tr>                  
        <th class="span2">Email</th>
        <td>{{ $entry->email}}</td>
    </tr>
    
    <tr>                  
       <th class="span2">Interested in</th>
        <td>{{ $entry->interested_in}}</td>
    </tr>
    
    <tr>                  
        <th class="span2">No. of person</th>
        <td>{{ $entry->no_of_person}}</td>
    </tr>
    
     <tr>                  
        <th class="span2">Address</th>
         
                        <td>{{ $entry->address}}</td>                
    </tr>
    
    <tr>                  
       <th class="span2">Country</th>
        <td>{{ $entry->country}}</td>
    </tr>
    
    <tr>                  
       <th class="span2">Telephone/Mobile</th>
        <td>{{ $entry->telephone}}</td>
    </tr>
    
     <tr>                  
       <th class="span2">Description</th>
        <td>{{ $entry->description}}</td>
    </tr>
    
     <tr>                  
       <th class="span2">Created at</th>
        
			<td>{{ $entry->created_at->diffForHumans() }}</td>
    </tr>
    
     <tr>                  
       <th class="span3">@lang('table.actions')</th>       
       <td> <a href="{{ route('delete/blog', $entry->id) }}" class="btn btn-mini btn-danger">@lang('button.delete')</a></td>
                                
    </tr>
    
			
                  
</table>
  
</div>
@stop
