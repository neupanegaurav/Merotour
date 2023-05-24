@extends('backend/layouts/default')
@section('title')
Service Provider Setting :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Service Provider Setting
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    Account Management
                            <span class="icon-angle-right"></span>
                </li>
                         
                <li> Service Provider Setting </li>
                                                       
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
    
     
        <div class="social-box span4">
                    <div class="header">
                        Travelport(Galileo)
                    </div>
                    <div class="body">


                       
                         <form method="post" action="{{ route('travel-port-setting')}}">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <table class="table table-bordered table-striped table-hover" style="margin-bottom:10px;">
                            
                            
                            <tbody>
    
                                <tr>

                                    <td>Search</td>
                                    <td>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="search_tp" value="1" {{ $travel_port->search == 1 ? 'checked="checked"' : '' }} >
                                            Enable 
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="search_tp" value="0" {{ $travel_port->search == 0 ? 'checked="checked"' : '' }}>
                                            Disable
                                            </label>
                                        </div>

                                    </td>        
                                </tr>
                                <tr>
                                    <td>Credit Booking</td>
                                    <td>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking_tp" value="1" {{ $travel_port->credit_booking == 1 ? 'checked="checked"' : '' }}>
                                            Enable 
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking_tp" value="0" {{ $travel_port->credit_booking == 0 ? 'checked="checked"' : '' }}>
                                            Disable
                                            </label>
                                        </div>

                                    </td>        
                                </tr>
                                <tr>
                                    <td>Ledger Balance</td>
                                    <td>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="ledger_balance_tp" value="1" {{ $travel_port->ledger_balance == 1 ? 'checked="checked"' : '' }}>
                                            Enable 
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="ledger_balance_tp" value="0" {{ $travel_port->ledger_balance == 0 ? 'checked="checked"' : '' }}>
                                            Disable
                                            </label>
                                        </div>

                                    </td>        
                                </tr>
                                <tr>
                                    <td>Instant Payment</td>
                                    <td>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="instant_payment_tp" value="1" {{ $travel_port->instant_payment == 1 ? 'checked="checked"' : '' }}>
                                            Enable 
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="instant_payment_tp" value="0" {{ $travel_port->instant_payment == 0 ? 'checked="checked"' : '' }}>
                                            Disable
                                            </label>
                                        </div>

                                    </td>        
                                </tr>

                            </tbody>

                        </table>
                                    <button type="submit" class="btn btn-mini pull-right" style="margin-bottom:10px;">Save</button>                            

                    </form>   
                                             
                    </div>
                </div>

                <div class="social-box span4">
                    <div class="header">
                        United Solutions
                    </div>
                    <div class="body">
                       
                        <form method="post" action="{{ route('united-solution-setting')}}">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <table class="table table-bordered table-striped table-hover" style="margin-bottom:10px;">
                            
            
                            <tbody>
    
                                <tr>
                                    <td>Search</td>
                                    <td>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="search_us" value="1" {{ $united_solutions->search == 1 ? 'checked="checked"' : '' }}>
                                            Enable 
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="search_us" value="0" {{ $united_solutions->search == 0 ? 'checked="checked"' : '' }}>
                                            Disable
                                            </label>
                                        </div>

                                    </td>        
                                </tr>

                                <tr>
                                    <td>Credit Booking</td>
                                    <td>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking_us" value="1" {{ $united_solutions->credit_booking == 1 ? 'checked="checked"' : '' }}>
                                            Enable 
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking_us" value="0" {{ $united_solutions->credit_booking == 0 ? 'checked="checked"' : '' }}>
                                            Disable
                                            </label>
                                        </div>

                                    </td>        
                                </tr>

                                <tr>
                                    <td>Ledger Balance</td>
                                    <td>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="ledger_balance_us" value="1" {{ $united_solutions->ledger_balance == 1 ? 'checked="checked"' : '' }}>
                                            Enable 
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="ledger_balance_us" value="0" {{ $united_solutions->ledger_balance == 0 ? 'checked="checked"' : '' }}>
                                            Disable
                                            </label>
                                        </div>

                                    </td>        
                                </tr>

                                <tr>
                                    <td>Instant Payment</td>
                                    <td>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="instant_payment_us" value="1" {{ $united_solutions->instant_payment == 1 ? 'checked="checked"' : '' }}>
                                            Enable 
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="instant_payment_us" value="0" {{ $united_solutions->instant_payment == 0 ? 'checked="checked"' : '' }}>
                                            Disable
                                            </label>
                                        </div>

                                    </td>        
                                </tr>
                            </tbody>

                        </table>
                                    <button type="submit" class="btn btn-mini pull-right" style="margin-bottom:10px;">Save</button>                            

                        </form>   
                                             
                    </div>
                </div>


                <div class="social-box span4">
                    <div class="header">
                        GMT
                    </div>
                    <div class="body">
                       
                         <form method="post" action="{{ route('travel-port-setting')}}">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <table class="table table-bordered table-striped table-hover" style="margin-bottom:10px;">
                            
            
                            <tbody>
    
                                <tr>
                                    <td>Search</td>
                                    <td>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="search" value="1" {{ $travel_port->search == 1 ? 'checked="checked"' : '' }}>
                                            Enable 
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="search" value="0" {{ $travel_port->search == 0 ? 'checked="checked"' : '' }}>
                                            Disable
                                            </label>
                                        </div>

                                    </td>        
                                </tr>
                                <tr>
                                    <td>Credit Booking</td>
                                    <td>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking" value="1" {{ $travel_port->search == 1 ? 'checked="checked"' : '' }}>
                                            Enable 
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking" value="0" {{ $travel_port->search == 0 ? 'checked="checked"' : '' }}>
                                            Disable
                                            </label>
                                        </div>

                                    </td>        
                                </tr>
                                <tr>
                                    <td>Ledger Balance</td>
                                    <td>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking" value="1" {{ $travel_port->search == 1 ? 'checked="checked"' : '' }}>
                                            Enable 
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking" value="0" {{ $travel_port->search == 0 ? 'checked="checked"' : '' }}>
                                            Disable
                                            </label>
                                        </div>

                                    </td>        
                                </tr>
                                <tr>
                                    <td>Instant Payment</td>
                                    <td>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking" value="1" {{ $travel_port->search == 1 ? 'checked="checked"' : '' }}>
                                            Enable 
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking" value="0" {{ $travel_port->search == 0 ? 'checked="checked"' : '' }}>
                                            Disable
                                            </label>
                                        </div>

                                    </td>        
                                </tr>

                            </tbody>

                        </table>
                                    <button type="submit" class="btn btn-mini pull-right" style="margin-bottom:10px;">Save</button>                            

</form>   
                                             


                    </div>
                </div>

                <div class="social-box span4" style="margin-left:0px;">
                    <div class="header">
                        TBO
                    </div>
                    <div class="body">
                       
                         <form method="post" action="{{ route('travel-port-setting')}}">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <table class="table table-bordered table-striped table-hover" style="margin-bottom:10px;">
                            
            
                            <tbody>
    
                                <tr>
                                    <td>Search</td>
                                    <td>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="search" value="1" {{ $travel_port->search == 1 ? 'checked="checked"' : '' }}>
                                            Enable 
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="search" value="0" {{ $travel_port->search == 0 ? 'checked="checked"' : '' }}>
                                            Disable
                                            </label>
                                        </div>

                                    </td>        
                                </tr>
                                <tr>
                                    <td>Credit Booking</td>
                                    <td>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking" value="1" {{ $travel_port->search == 1 ? 'checked="checked"' : '' }}>
                                            Enable 
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking" value="0" {{ $travel_port->search == 0 ? 'checked="checked"' : '' }}>
                                            Disable
                                            </label>
                                        </div>

                                    </td>        
                                </tr>
                                <tr>
                                    <td>Ledger Balance</td>
                                    <td>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking" value="1" {{ $travel_port->search == 1 ? 'checked="checked"' : '' }}>
                                            Enable 
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking" value="0" {{ $travel_port->search == 0 ? 'checked="checked"' : '' }}>
                                            Disable
                                            </label>
                                        </div>

                                    </td>        
                                </tr>
                                <tr>
                                    <td>Instant Payment</td>
                                    <td>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking" value="1" {{ $travel_port->search == 1 ? 'checked="checked"' : '' }}>
                                            Enable 
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking" value="0" {{ $travel_port->search == 0 ? 'checked="checked"' : '' }}>
                                            Disable
                                            </label>
                                        </div>

                                    </td>        
                                </tr>

                            </tbody>

                        </table>
                                    <button type="submit" class="btn btn-mini pull-right" style="margin-bottom:10px;">Save</button>                            

</form>   
                                             


                    </div>
                </div>

                <div class="social-box span4">
                    <div class="header">
                        Abacus
                    </div>
                    <div class="body">
                       
                         <form method="post" action="{{ route('travel-port-setting')}}">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <table class="table table-bordered table-striped table-hover" style="margin-bottom:10px;">
                            
            
                            <tbody>
    
                                <tr>
                                    <td>Search</td>
                                    <td>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="search" value="1" {{ $travel_port->search == 1 ? 'checked="checked"' : '' }}>
                                            Enable 
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="search" value="0" {{ $travel_port->search == 0 ? 'checked="checked"' : '' }}>
                                            Disable
                                            </label>
                                        </div>

                                    </td>        
                                </tr>
                                <tr>
                                    <td>Credit Booking</td>
                                    <td>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking" value="1" {{ $travel_port->search == 1 ? 'checked="checked"' : '' }}>
                                            Enable 
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking" value="0" {{ $travel_port->search == 0 ? 'checked="checked"' : '' }}>
                                            Disable
                                            </label>
                                        </div>

                                    </td>        
                                </tr>
                                <tr>
                                    <td>Ledger Balance</td>
                                    <td>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking" value="1" {{ $travel_port->search == 1 ? 'checked="checked"' : '' }}>
                                            Enable 
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking" value="0" {{ $travel_port->search == 0 ? 'checked="checked"' : '' }}>
                                            Disable
                                            </label>
                                        </div>

                                    </td>        
                                </tr>
                                <tr>
                                    <td>Instant Payment</td>
                                    <td>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking" value="1" {{ $travel_port->search == 1 ? 'checked="checked"' : '' }}>
                                            Enable 
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking" value="0" {{ $travel_port->search == 0 ? 'checked="checked"' : '' }}>
                                            Disable
                                            </label>
                                        </div>

                                    </td>        
                                </tr>

                            </tbody>

                        </table>
                                    <button type="submit" class="btn btn-mini pull-right" style="margin-bottom:10px;">Save</button>                            

</form>   
                                             


                    </div>
                </div>


                <div class="social-box span4">
                    <div class="header">
                        MakeMyTrip
                    </div>
                    <div class="body">
                       
                         <form method="post" action="{{ route('travel-port-setting')}}">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <table class="table table-bordered table-striped table-hover" style="margin-bottom:10px;">
                            
            
                            <tbody>
    
                                <tr>
                                    <td>Search</td>
                                    <td>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="search" value="1" {{ $travel_port->search == 1 ? 'checked="checked"' : '' }}>
                                            Enable 
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="search" value="0" {{ $travel_port->search == 0 ? 'checked="checked"' : '' }}>
                                            Disable
                                            </label>
                                        </div>

                                    </td>        
                                </tr>
                                <tr>
                                    <td>Credit Booking</td>
                                    <td>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking" value="1" {{ $travel_port->search == 1 ? 'checked="checked"' : '' }}>
                                            Enable 
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking" value="0" {{ $travel_port->search == 0 ? 'checked="checked"' : '' }}>
                                            Disable
                                            </label>
                                        </div>

                                    </td>        
                                </tr>
                                <tr>
                                    <td>Ledger Balance</td>
                                    <td>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking" value="1" {{ $travel_port->search == 1 ? 'checked="checked"' : '' }}>
                                            Enable 
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking" value="0" {{ $travel_port->search == 0 ? 'checked="checked"' : '' }}>
                                            Disable
                                            </label>
                                        </div>

                                    </td>        
                                </tr>
                                <tr>
                                    <td>Instant Payment</td>
                                    <td>

                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking" value="1" {{ $travel_port->search == 1 ? 'checked="checked"' : '' }}>
                                            Enable 
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="credit_booking" value="0" {{ $travel_port->search == 0 ? 'checked="checked"' : '' }}>
                                            Disable
                                            </label>
                                        </div>

                                    </td>        
                                </tr>

                            </tbody>

                        </table>
                                    <button type="submit" class="btn btn-mini pull-right" style="margin-bottom:10px;">Save</button>                            

</form>   
                                             


                    </div>
                </div>



    
         
        
     

     
                                               
               
        


			        <!-- END TABLE DATA -->
		    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>


@stop
