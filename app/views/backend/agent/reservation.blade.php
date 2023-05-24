@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Change your email ::
@parent
@stop

{{-- Page content --}}
@section('content')


<div id="right_section">
    
    <div id="right_header">
	<h3>
		Reservation

		
	</h3>
        
    </div>
    


    <div class="bottom clearfix" style="padding:10px;">

                                @if(isset($error)) 

    {{ $error }}

    @else

    {{ $reservation }}


 @endif



                
                                </div> <!-- /Bottom -->

                </div>

                                
    
                  

@stop
