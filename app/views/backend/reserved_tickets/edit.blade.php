@extends('backend/layouts/default')
@section('title')
Booking Details :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Booking Details
            </h3>
            <!-- BEGIN BREADCRUMBS -->
            <ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    Booking
                            <span class="icon-angle-right"></span>
                        </li>
                         

                                    <li>Booking Details
                                                
                                        </li>
                                                       
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

    </div>
    <!-- END TABLE TOOLS -->

    </div>
    <!-- BEGIN TABLE BODY -->
    <div class="body"> 

        <form class="form-horizontal" method="post" action="" autocomplete="off">
            <!-- CSRF Token -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input id="inc" type="hidden" name="inc" value="1">
                
            <table class="table table-bordered table-striped table-hover pull-left" style="width:300px; margin:10px; margin-left:0px;">
                <thead>
                    <tr>
                        <th>Account Detail</th>
                    </tr>
                    <tr>
                                    <th class="span2"></th>
                                    <th class="span2">NPR</th>
                                    <th class="span2">USD</th>
                    </tr>
                </thead>
                <tbody>
               
                    <tr>
                        <td>Credit Limit</td>
                        <td>
                            <?php $user = User::where('id', $entry->user_id)->first(); ?>

                            {{$user->credit_limit}}
                        </td> 
                        <td></td>               
                    </tr>

                    <tr>
                        <td>Available Balance</td>
                        <td>
                        <?php $funds= Funds::where('user_id', $entry->user_id)->first()?>
                        @if(isset($funds))
                        {{$funds->balance}}
                        @else
                        0
                        @endif

                        </td> 
                        <td></td>               
                    </tr>

                     <tr>
                        <td>Ledger Balance</td>
                        <td></td> 
                        <td></td>               
                    </tr>       
                </tbody>
            </table>

            <table class="table table-bordered table-striped table-hover pull-left" style="width:300px; margin:10px;">
                <thead>

                    <tr>
                                    <th class="span2">Branch Office</th>
                                    <th class="span2">Distributor</th>
                    </tr>
                </thead>
                <tbody>
               
                    <tr>
                        <td></td> 
                        <td></td>               
                    </tr>

                    <tr>
                        <td></td> 
                        <td></td>               
                    </tr>       
                </tbody>
            </table>

            <table class="table table-bordered table-striped table-hover pull-left" style="width:300px; margin:10px;">
                <thead>
                    <tr>
                        <th>User Detail</th>
                    </tr>
                </thead>
                <tbody>

               
                    <tr>
                        <td>Name</td>
                        <td>{{$user->first_name .' '. $user->last_name}}</td>               
                    </tr>

                    <tr>
                        <td>Address</td>
                        <td>{{$user->address}}</td>               
                    </tr>

                     <tr>
                        <td>Mobile</td>
                        <td>{{$user->mobile}}</td>               
                    </tr>       
                </tbody>
            </table>

            <br clear="all">


            <div>

            <style type="text/css">

            div .control-label {width: 100px !important; }

            </style>

                <div style="margin-bottom:12px;">
                    <div class="control-group pull-left {{ $errors->has('api') ? 'error' : '' }}">
                        <label class="control-label">Source Using</label>
                        <div class="controls">
                            <select name="api"><option {{ $entry->api == 'Domestic Flights' ? 'selected' : '' }} >United Solutions</option><option {{ $entry->api == 'Travel Port' ? 'selected' : '' }}>Travel Port</option></select>
                            {{ $errors->first('api', '<span class="help-inline">:message</span>') }}
                        </div>
                    </div>
                    
                    <div class="control-group pull-left {{ $errors->has('gds_pnr') ? 'error' : '' }}">
                        <label class="control-label">GDS PNR</label>
                        <div class="controls">
                            <input type="text" name="gds_pnr" value="{{ Input::old('gds_pnr', $entry->gds_pnr) }}" />
                            {{ $errors->first('gds_pnr', '<span class="help-inline">:message</span>') }}
                        </div>
                    </div>

                    <div class="control-group pull-left {{ $errors->has('payment_method') ? 'error' : '' }}">
                        <label class="control-label">Payment Method</label>
                        <div class="controls">
                            <input type="text" name="payment_method" value="{{ Input::old('payment_method', $entry->payment_method) }}" />
                            {{ $errors->first('payment_method', '<span class="help-inline">:message</span>') }}
                        </div>
                    </div>
                   
                    <div class="control-group pull-left {{ $errors->has('remarks') ? 'error' : '' }}">
                        <label class="control-label">Remarks</label>
                        <div class="controls">
                            <input type="text" name="remarks" value="{{ Input::old('remarks', $entry->remarks) }}" />
                            {{ $errors->first('remarks', '<span class="help-inline">:message</span>') }}
                        </div>
                    </div>
                </div>

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>PNR Information</th>
                        </tr>
                        <tr>
                            <th class="span2">Prefix</th>
                            <th class="span2">First Name</th>
                            <th class="span2">Last name</th>              
                        </tr>
                    </thead>
                    <tbody>
                   
                        <tr>
                            <td>
                                <div class="control-group {{ $errors->has('contact_name') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="contact_name" value="{{Input::old('contact_name', $entry->contact_name )}}" />
                                    {{ $errors->first('contact_name', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="control-group {{ $errors->has('contact_number') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:200px;" type="text" name="contact_number" value="{{Input::old('contact_number', $entry->contact_number)}}" />
                                    {{ $errors->first('contact_number', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                            <td>
                                <div class="control-group {{ $errors->has('contact_email') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:200px;" type="text" name="contact_email" value="{{Input::old('contact_email', $entry->contact_email)}}" />
                                    {{ $errors->first('contact_email', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td>

                        </tr>  
                    </tbody>
                </table>

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th colspan="6">Passenger Information <div id="add_new" class="btn btn-success pull-right">Add New</div></th>
                        </tr>
                        <tr>
                            <th class="span2">Pax Type</th>
                            <th class="span2">Prefix</th>
                            <th class="span2">First Name</th>
                            <th class="span2">Last name</th>
                            <th class="span2">Ticket No.</th>
                            <th class="span2">DOB</th>             
                        </tr>
                    </thead>
                    <tbody id="passengers">


                    @foreach($passengers as $passenger)
                   
                        <tr>
                            <td>
                                <select name="passenger1_pax_type" style="width:80px;"><option>Adult</option><option>Child</option></select>                            
                            </td>
                            <td>
                                 <div class="control-group {{ $errors->has('passenger1_title') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:200px;" type="text" name="passenger1_title" value="{{Input::old('passenger1_title', $passenger->title)}}" />
                                    {{ $errors->first('passenger1_title', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="control-group {{ $errors->has('passenger1_first_name') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:200px;" type="text" name="passenger1_first_name" value="{{Input::old('passenger1_first_name', $passenger->first_name)}}" />
                                    {{ $errors->first('passenger1_first_name', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                            <td>
                                 <div class="control-group {{ $errors->has('passenger1_last_name') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:200px;" type="text" name="passenger1_last_name" value="{{Input::old('passenger1_last_name', $passenger->last_name)}}" />
                                    {{ $errors->first('passenger1_last_name', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td>
                            
                            <td>
                                <div class="control-group {{ $errors->has('passenger1_ticket_no') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="passenger1_ticket_no" value="{{Input::old('passenger1_ticket_no', $passenger->ticket_no)}}" />
                                    {{ $errors->first('passenger1_ticket_no', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="control-group {{ $errors->has('passenger1_dob') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input id="datepick3" style="width:100px;" type="text" name="passenger1_dob" value="{{Input::old('passenger1_dob', $passenger->_dob)}}" />
                                    {{ $errors->first('passenger1_dob', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td>

                        </tr>  
                    @endforeach
                    </tbody>
                </table>


                <table class="table table-bordered table-striped table-hover">
                    <thead>

                        <tr>
                            <th colspan="9">Segment Information</th>
                        </tr>
                        <tr>
                            <th class="span1">Airline</th>
                            <th class="span1">Flight No.</th>
                            <th class="span1">Class Code</th>
                            <th class="span1">Departure</th>
                            <th class="span1">Arrival</th>
                            <th class="span1">Airline PNR</th>
                            <th class="span1">TTL Date</th>
                            <th class="span1">TTL Time</th>

                            <th class="span1">Free Baggage</th>      
                        </tr>
                    </thead>
                    <tbody>
                   
                        <tr>
                            <td>
                                <div class="control-group {{ $errors->has('airline_id') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <select>
                                        <option value="RMK" {{ $entry->airline_id == 'RMK' ? 'selected' : '' }}> Simrik Airlines </option>
                                        <option value="YT" {{ $entry->airline_id == 'YT' ? 'selected' : '' }} > Yeti Airlines </option>
                                        <option value="U4" {{ $entry->airline_id == 'U4' ? 'selected' : '' }} > Buddha Airlines </option>
                                    </select>
                                    {{ $errors->first('airline_id', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="control-group {{ $errors->has('flight_no') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:80px;" type="text" name="flight_no" value="{{ Input::old('flight_no', $entry->flight_no) }}" 
                                    {{ $errors->first('flight_no', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                            <td>
                                <div class="control-group {{ $errors->has('class_code') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:30px;" type="text" name="class_code" value="{{ Input::old('class_code', $entry->class_code) }}" 
                                    {{ $errors->first('class_code', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="control-group {{ $errors->has('departure') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:80px;" type="text" name="departure" value="{{ Input::old('departure', $entry->departure) }}"                                    
                                    {{ $errors->first('departure', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td>
                            
                            <td>
                                <div class="control-group {{ $errors->has('arrival') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:80px;" type="text" name="arrival" value="{{ Input::old('arrival', $entry->arrival) }}" 
                                    {{ $errors->first('arrival', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="control-group {{ $errors->has('pnr_no') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    {{$entry->pnr_no}}
                                    {{ $errors->first('pnr_no', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 

                            <td>
                                <div class="control-group {{ $errors->has('ttl_date') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="ttl_date" value="{{ Input::old('ttl_date', $entry->ttl_date) }}" 
                                    {{ $errors->first('ttl_date', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>                             
                            </td>

                            <td>
                                <div class="control-group {{ $errors->has('ttl_time') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="ttl_time" value="{{ Input::old('ttl_time', $entry->ttl_time) }}" 
                                    {{ $errors->first('ttl_time', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="control-group {{ $errors->has('free_baggage') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    {{$entry->free_baggage}}
                                    <input style="width:80px;" type="text" name="free_baggage" value="{{ Input::old('free_baggage', $entry->free_baggage) }}" 
                                    {{ $errors->first('free_baggage', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            
                            </td>

                        </tr>
                    </tbody>
                </table>
                     
                

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Fare Information</th>
                        </tr>
                        <tr>
                            <th class="span2" colspan="4">Currency NPR</th>             
                        </tr>
                        <tr>
                            <th class="span2">Pax Type</th>  
                            <th class="span2">Base Fare</th>
                            <th class="span2">Fuel Surcharge</th>
                            <th class="span2">Tax</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $total = 0; ?>
                    @foreach($passengers as $passenger)
                        <tr>
                            <td>
                                <div class="control-group {{ $errors->has('pax_type') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <select style="width:80px;">
                                        <option name="pax_type" {{ $passenger->pax_type == 'ADULT' ? 'selected' : '' }} value="ADULT"> Adult</option>
                                        <option name="pax_type" {{ $passenger->pax_type == 'CHILD' ? 'selected' : '' }} value="CHILD" > Child </option>
                                    </select>
                                    {{ $errors->first('pax_type', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                             </td>
                            <td>
                                <div class="control-group {{ $errors->has('fare') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:60px;" type="text" name="fare" value="{{Input::old('fare', $passenger->fare)}}" />
                                    {{ $errors->first('fare', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td>  
                            <td>
                                <div class="control-group {{ $errors->has('surcharge') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:60px;" type="text" name="surcharge" value="{{Input::old('surcharge', $passenger->surcharge)}}" />
                                    {{ $errors->first('surcharge', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                             </td>
                            <td> 
                                <div class="control-group {{ $errors->has('tax') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:60px;" type="text" name="tax" value="{{Input::old('tax', $passenger->tax)}}" />
                                    {{ $errors->first('tax', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td>
                           
                        </tr>
                                                
                        @endforeach
                        
                    </tbody>
                </table>
            </div>

        

            <!-- Form Actions -->
            <div class="control-group">
                <div class="controls">
                    <a class="btn btn-link" href="{{ route('reserved-tickets') }}">Back to Reserved Tickets List</a>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </form>



<br clear="all">
        


                    <!-- END TABLE DATA -->
                </div>
                <!-- END TABLE BODY -->
        </div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>

@stop


@section('currentpagejs')

<script type="text/javascript">

    $(document).ready(function() {

    
        $("#datepick").datepicker({       
              dateFormat: "dd-mm-yy"
            });
        $("#datepick2").datepicker({       
              dateFormat: "dd-mm-yy"
            });
        $("#datepick3").datepicker({       
              dateFormat: "dd-mm-yy"
            });

        inc = 2;

        $('#add_new').click(function(){   
            $('#inc').val(inc);        
            $('#passengers').append('<tr><td><select name="passenger'+inc+'_pax_type" style="width:80px;"><option>Adult</option><option>Child</option></select></td><td><div class="control-group"><div class="controls" style="margin:0px;"><input style="width:200px;" type="text" name="passenger'+ inc +'_title" value="" /></div></div></td><td><div class="control-group"><div class="controls" style="margin:0px;"><input style="width:200px;" type="text" name="passenger'+ inc +'_first_name" value="" /></div></div></td> <td><div class="control-group"><div class="controls" style="margin:0px;"><input style="width:200px;" type="text" name="passenger'+ inc +'_last_name" value="" /></div></div></td><td><div class="control-group"><div class="controls" style="margin:0px;"><input style="width:100px;" type="text" name="passenger'+ inc +'_ticket_no" value="" /></div></div></td><td><div class="control-group"><div class="controls" style="margin:0px;"><input id="dob'+inc+'" style="width:100px;" type="text" name="passenger'+ inc +'_dob" value="" /></div></div></td></tr>');
            $("#dob"+inc).datepicker({       
              dateFormat: "dd-mm-yy"
            });
            inc++;              
        });

    /*$("#recheck").click(function()
        {


            $("#ajaxform").submit(function(e)
            {

                alert("test");
                $("#simple-msg").html("Test");
                var postData = $(this).serializeArray();
                var formURL = $(this).attr("action");
                $.ajax(
                {
                    url : formURL,
                    type: "POST",
                    data : postData,
                    success:function(data, textStatus, jqXHR) 
                    {
                        $("#simple-msg").html('<pre><code class="prettyprint">'+data+'</code></pre>');

                    },
                    error: function(jqXHR, textStatus, errorThrown) 
                    {
                        $("#simple-msg").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
                    }
                });
                e.preventDefault(); //STOP default action
                e.unbind();
            });
                
            $("#ajaxform").submit(); //SUBMIT FORM
        });*/

    }); //Onload

</script>



@stop