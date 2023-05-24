@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Package Tours ::
@parent
@stop

{{-- Page content --}}
@section('content')
<style>
    #maincont {background: #fff; margin-top:20px; padding:5px;}
    table strong {font-size:14px;}
    table thead td {background:none;}
    td img {float:left; margin-right:10px; width:170px; height:115px;}
    a:hover {text-decoration:none;}
    td p {color: rgb(102, 102, 102);}
     
</style>



    
 
	
       



<!-- Grid page -->
                <div class="content booking_wrap">
                    <div>
                        <div>
                            <div>
                                <div class="top" style="padding:10px;">
                                    
                                    <h3>Search Results for "{{$q}}"</h3>
                                    
                                </div><!-- /Top -->

                                <div class="bottom clearfix" style="padding:10px;">
    
    @if ($entries->isEmpty())
    <span>Sorry, no results were found. Please try another search.</span>
    @endif
    
    @if (!$entries->isEmpty()) 

 <table class="table table-bordered table-striped table-hover">
	<thead>
		@foreach ($entries as $entry)
		<tr>
			<td>
                            <img src="assets/img/uploads/{{ $entry->photo }}" >
                            
                            <h3><a href="{{ route('package-tours-show', $entry->id) }}" >{{ $entry->name }}</a></h3>
                            <p>
                        Country: {{ $entry->country}}   | 
                        Area: {{ $entry->area}}   |
                        Activities: {{ $entry->activities}}   |
                        Duration: {{ $entry->duration}}  |
                        Difficulty: {{ $entry->difficulty}} 
                        
                        <br>
                        {{ html_entity_decode(Str::words($entry->description, 10)); }}
                            </p> 
                        </td>
			
                       
                     
	
		</tr>
		@endforeach
	</thead>
</table>


 {{ $entries->links() }}

@endif

                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                                
    
       
    
  
                              
                              
                       

@stop
