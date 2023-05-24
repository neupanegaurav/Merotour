
<div class="page-header">
	<h3>Flight</h3>
       
</div>

<table  style="table-layout: fixed; width: 160px; float:left; margin-right:20px;" class="table table-bordered table-striped table-hover">
    
 		<thead>
            <tr><th class="span1">Airlines</th></tr>
        </thead>
        <tbody>
           <tr><td class="span1"><a href="{{ URL::to('admin/flight/searchflights') }}"> Search Flights</a></td></tr>
        </tbody>



        <thead>
            <tr><th class="span1">Flight management</th></tr>
        </thead>
        <tbody>
           <tr><td class="span1"> <a href="{{ URL::to('admin/flight/airlines') }}">Airlines management</a></td></tr>
           <tr><td class="span1"> <a href="{{ URL::to('admin/flight/airports') }}">Airport management</a></td></tr>
        </tbody>


        
       
        
       
        
   
    
</table>