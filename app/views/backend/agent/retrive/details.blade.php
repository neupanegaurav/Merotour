@extends('backend/layouts/default')
@section('title')
Issued Ticket Details :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Issued Ticket Details
            </h3>
            <!-- BEGIN BREADCRUMBS -->
            <ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    Booking
                            <span class="icon-angle-right"></span>
                        </li>
                         

                                    <li>Issued Ticket Details
                                                
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

                        <a href="{{route('issued-tickets')}}"  class="btn">Back</a>


    </div>
    <!-- END TABLE TOOLS -->

    </div>
    <!-- BEGIN TABLE BODY -->
    <div class="body"> 

            <div>

            <style type="text/css">

            div .control-label {width: 100px !important; }

            </style>

            Test
            <?php var_dump($getitinerary); ?>

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th colspan="6">Passenger Information </th>
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
                                Adult         
                            </td>
                            <td>
                                 {{$passenger->title}}
                            </td>
                            <td>
                                {{$passenger->first_name}}
                            </td> 
                            <td>
                                 {{$passenger->last_name}}
                            </td>
                            
                            <td>
                                {{$passenger->ticket_no}}
                            </td>
                            <td>
                                {{$passenger->_dob}}
                            </td>

                        </tr>  
                    @endforeach
                    </tbody>
                </table>

                     
                <table class="table table-bordered table-striped table-hover">
                    <thead>

                        <tr>
                            <th colspan="9">Segment Information </th>
                        </tr>
                        <tr>
                            <th class="span2">Airline</th>
                            <th class="span2">Flight No.</th>
                            <th class="span2">Class</th>
                            <th class="span2">From</th>
                            <th class="span2">Departure Date(Time)</th>
                            <th class="span2">To</th>
                            <th class="span2">Arrival Date(Time)</th>
                            <th class="span2">Airline PNR</th>
                            <th class="span2">Baggage</th>      
                        </tr>
                    </thead>
                    <tbody>


   
                    
                   
                        <tr>
                            <td>                                
                                {{ $entry->airline }}      
                            </td>
                            <td>
                                {{$entry->flight_no}}
                            </td> 
                            <td>
                                {{$entry->class_code}}
                            </td>
                            <td>
                                {{$entry->departure}}
                            </td>
                            
                            <td>
                                {{$entry->issue_date}}
                                                   
                            </td>

                            <td>
                                {{$entry->arrival}}
                            </td>

                            <td>
                                {{$entry->flight_date}}
                            </td> 
                            
                            <td>
                                {{$entry->pnr_no}}
                            </td> 
                            <td>
                                {{$entry->free_baggage}}                            
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
                            <th class="span2" colspan="2">Purchase</th>
                        </tr>
                         <tr>
                            <th class="span2" colspan="4">Currency NPR</th>             
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($passengers as $passenger)
                        <tr>
                            <td>Pax Type</td>
                            <td><select style="width:80px;"><option>Adult</option><option>Child</option></select></td> 
                           
                        </tr>
                        <tr>
                            <td>Base Fare</td>
                            <td>
                                <div class="control-group {{ $errors->has('base_fare') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="base_fare" value="{{ Input::old('base_fare', $passenger->base_fare)}}" />
                                    {{ $errors->first('base_fare', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                             
                        </tr> 

                        <tr>
                            <td>Additional Txn Fee</td>
                            <td>
                                <div class="control-group {{ $errors->has('additional_txn_fee') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="additional_txn_fee" value="{{Input::old('additional_txn_fee', $passenger->additional_txn_fee)}}" />
                                    {{ $errors->first('additional_txn_fee', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                             
                        </tr>
                        <tr>
                            <td>Airline Txn Fee</td>
                            <td>
                                <div class="control-group {{ $errors->has('airline_txn_fee') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="airline_txn_fee" value="{{Input::old('airline_txn_fee', $passenger->airline_txn_fee)}}" />
                                    {{ $errors->first('airline_txn_fee', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                             
                        </tr>
                        <tr>
                            <td>Tax</td>
                            <td>
                                <div class="control-group {{ $errors->has('tax') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="tax" value="{{Input::old('tax', $passenger->tax)}}" />
                                    {{ $errors->first('tax', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                             
                        </tr>
                        <tr>
                            <td>Service Tax</td>
                            <td>
                                <div class="control-group {{ $errors->has('service_tax') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="service_tax" value="{{Input::old('service_tax', $passenger->service_tax)}}" />
                                    {{ $errors->first('service_tax', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                             
                        </tr>
                        <tr>
                            <td>FSC</td>
                            <td>
                                <div class="control-group {{ $errors->has('fsc') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="fsc" value="{{Input::old('fsc', $passenger->fsc)}}" />
                                    {{ $errors->first('fsc', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                            
                        </tr>
                        <tr>
                            <td>Commission</td>
                            <td>
                                <div class="control-group {{ $errors->has('commission') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="commission" value="{{Input::old('commission', $passenger->commission)}}" />
                                    {{ $errors->first('commission', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                            
                             
                        </tr>
                        <tr>
                            <td>Other Charges</td>
                            <td>
                                <div class="control-group {{ $errors->has('other_charges') ? 'error' : '' }}">
                                    <div class="controls" style="margin:0px;">
                                    <input style="width:100px;" type="text" name="other_charges" value="{{Input::old('other_charges', $passenger->other_charges)}}" />
                                    {{ $errors->first('other_charges', '<span class="help-inline">:message</span>') }}
                                    </div>
                                </div>
                            </td> 
                           
                        </tr
                        <?php break; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>

        



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