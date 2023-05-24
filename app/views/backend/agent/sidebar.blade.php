
<table  style="table-layout: fixed; width: 160px; float:left; margin-right:20px;" class="table table-bordered table-striped table-hover">
    
        <thead>
            <tr><th class="span1">My Info</th></tr>
        </thead>
        <tbody>
           <tr><td class="span1"> <a href="{{ URL::to('agent/profile') }}"> My Profile</a></td></tr>
           <tr><td class="span1"> <a href="{{ URL::to('agent/change-password') }}">Change password</a></td></tr>
           <tr><td class="span1"> <a href="{{ URL::to('agent/change-email') }}">Change email</a></td></tr>
           
        </tbody>
        
        <thead>
            <tr><th class="span1">Fund Management</th></tr>
        </thead>
        <tbody>
           <tr><td class="span1"><a href="{{ URL::to('agent/add-funds') }}"> Add funds</a></td></tr>
           <tr><td class="span1"><a href="{{ URL::to('agent/withdraw-funds') }}"> Withdraw funds</a></td></tr>
        </tbody>
        
         <thead>
            <tr><th class="span1">My Clients</th></tr>
        </thead>
        <tbody>
           <tr><td class="span1"><a href="{{ URL::to('agent/signup') }}"> Register a Client</a></td></tr>
           <tr><td class="span1"><a href="{{ URL::to('agent/listallclients') }}"> List all clients</a></td></tr>
        </tbody>
        
        
        <thead>
            <tr><th class="span1">Invoice</th></tr>
        </thead>
        <tbody>
           <tr><td class="span1"><a href="{{ URL::to('agent/inquiries') }}"> List of invoices</a></td></tr>
           <tr><td class="span1"><a href="{{ URL::to('agent/transactions') }}"> Transaction History</a></td></tr>
        </tbody>
        
         <thead>
            <tr><th class="span1">Quotations</th></tr>
        </thead>
        <tbody>
           <tr><td class="span1"><a href="{{ URL::to('agent/quotations') }}"> Request Quotation to Admin</a></td></tr>
           <tr><td class="span1"><a href="{{ URL::to('agent/send-quotations') }}"> Send Quotation to Client </td></tr>
        </tbody>

         <thead>
            <tr><th class="span1">Airlines</th></tr>
        </thead>
        <tbody>
           <tr><td class="span1"><a href="{{ URL::to('agent/searchflights') }}"> Search Flights</a></td></tr>
        </tbody>
        
        
        
       
        
   
    
</table>