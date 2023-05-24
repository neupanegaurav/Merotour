@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Flight Search ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Flight Search
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Flight Search
	                <span class="icon-angle-right"></span>
	            </li>                       		                                           
			</ul>
			<!-- END BREADCRUMBS -->
        </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN DYNAMIC TABLE EXAMPLE -->
        <div class="social-box" style="display:inline-block; width:1109px;">
   
            <!-- BEGIN TABLE BODY -->
            <div class="body">
           
                <!-- BEGIN TABLE DATA -->

                <div class="top" style="padding:10px;">
                                    
                                    <h3>Flight Search Results</h3>
                                    
                                </div><!-- /Top -->

                                <div class="bottom clearfix" style="padding:10px;">

                                @if(isset($error)) 

    {{ $error }}

    @else

   <h4 style="margin:5px; margin-bottom:20px; "> Ticket Reserved: Please fill the details below and submit the form within 30 minutes for successful booking. The reserved ticket will expire within 30 minutes from now. </h4> 

    <style>

        .panel 
            {
                margin-bottom: 20px;
                background-color: #ffffff;
                border: 1px solid transparent;
                border-radius: 4px;
                -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
                box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
            }
        .panel-default > .panel-heading 
            {
                color: #555555;
                background-color: #f5f5f5;
                border-color: #dddddd;
            }
        .panel-heading 
            {
                padding: 10px 15px;
                border-bottom: 1px solid transparent;
                border-top-right-radius: 3px;
                border-top-left-radius: 3px;
            }
        .panel-default 
            {
                border-color: #dddddd;
                width:400px;
            }
        .panel-body 
            {
                padding:8px;
            }
        .panel-body input {
            max-width: 180px;
        }
        .label-primary 
            {
                background-color: #2fa4e7;
            }
        .label-success 
            {
                background-color: #73a839;
            }
        .label-info 
            {
            background-color: #033c73;
            }

        </style>

    <form method="post" action="{{ URL::to('payment') }}" class="form-horizontal" autocomplete="off">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="backend" value="1" /> 

        <div class="pull-left" style="width:450px;">
            
            <h3>Contact Details </h3>

            <div class="panel panel-default">
                <div class="panel-heading"> <strong>Contact Person</strong> <span class="label label-info pull-right">Contact</span></div>
                <div class="panel-body">

                    <!-- Contact Name -->
                    <div class="control-group{{ $errors->first('contact_name', ' error') }}">
                    <label class="control-label" for="contact_name">Contact Name</label>
                        <div class="controls">
                            <input type="text" name="contact_name" id="contact_name" value="{{ $user->contact_name ." " . $user->last_name }}" />
                            {{ $errors->first('contact_name', '<span class="help-block">:message</span>') }}
                        </div>
                    </div>
               
                    <!-- Contact Number -->
                    <div class="control-group{{ $errors->first('contact_number', ' error') }}">
                        <label class="control-label" for="contact_number">Contact Number</label>
                        <div class="controls">
                            <input type="text" name="contact_number" id="contact_number" value="{{ Input::old('contact_number'), 9808242212 }}" />
                            {{ $errors->first('contact_number', '<span class="help-block">:message</span>') }}
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="control-group{{ $errors->first('contact_email', ' error') }}">
                        <label class="control-label">Contact Email</label>
                        <div class="controls">
                            <input type="text" name="contact_email" value="{{ Input::old('contact_email', $user->email) }}" />
                            {{ $errors->first('contact_email', '<span class="help-block">:message</span>') }}
                        </div>
                    </div>

                   
                </div>
            </div>



            <h3>Adult Passenger Details </h3>

            
            @if($adults != 0)

                @for ($i = 1; $i <= $adults; $i++)

                <input type="hidden" name="passenger{{$i}}_pax_type" value="ADULT">
                  
                    
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong>Passenger {{$i}} </strong> <span class="label label-primary pull-right">Adult</span></div>
                        <div class="panel-body">


                          <!-- Gender -->
                            <div class="control-group{{ $errors->first('gender', ' error') }}">
                            <label class="control-label" >Gender</label>
                                <div class="controls">
                                <select name="passenger{{$i}}_gender" style="width:50px;"><option>M</option><option>F</option></select>
                                   
                                    {{ $errors->first('gender', '<span class="help-block">:message</span>') }}
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="control-group{{ $errors->first('title', ' error') }}">
                            <label class="control-label" for="title">Title</label>
                                <div class="controls">
                                    <input type="text" name="passenger{{$i}}_title" style="width:80px;"  id="title" value="Mr." />
                                    {{ $errors->first('title', '<span class="help-block">:message</span>') }}
                                </div>
                            </div>

                            <!-- First Name -->
                            <div class="control-group{{ $errors->first('first_name', ' error') }}">
                            <label class="control-label" for="first_name">First Name</label>
                                <div class="controls">
                                    <input type="text" name="passenger{{$i}}_first_name" id="first_name" value="{{ $user->first_name }}" />
                                    {{ $errors->first('first_name', '<span class="help-block">:message</span>') }}
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="control-group{{ $errors->first('last_name', ' error') }}">
                            <label class="control-label" for="last_name">Last Name</label>
                                <div class="controls">
                                    <input type="text" name="passenger{{$i}}_last_name" id="last_name" value="{{ $user->last_name }}" />
                                    {{ $errors->first('last_name', '<span class="help-block">:message</span>') }}
                                </div>
                            </div>
                
                            <!-- Nationality -->
                            <div class="control-group{{ $errors->first('nationality', ' error') }}">
                            <label class="control-label" for="nationality">Nationality</label>
                                <div class="controls">
                                    <input type="text" name="passenger{{$i}}_nationality" id="nationality" value="NP" />
                                    {{ $errors->first('nationality', '<span class="help-block">:message</span>') }}
                                </div>
                            </div>             

                            <!-- Passenger Remarks -->
                             <div class="control-group{{ $errors->first('pax_remarks', ' error') }}">
                                <label class="control-label">Passenger Remarks</label>
                                <div class="controls">

                                    <textarea style="width:152px;" name="passenger{{$i}}_pax_remarks">None</textarea>
                                    {{ $errors->first('pax_remarks', '<span class="help-block">:message</span>') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            @endif
           

            
        </div>

        <div class="pull-left">

            @if($children != 0)

                <h3>Child Passenger Details </h3>

                 @for ($i = 1; $i <= $children; $i++)

                 <input type="hidden" name="passenger{{$adults + $i}}_pax_type" value="CHILD">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong>Passenger {{ $adults + $i}} </strong> <span class="label label-success pull-right">Child</span></div>
                        <div class="panel-body">
                
                           <!-- Gender -->
                            <div class="control-group{{ $errors->first('gender', ' error') }}">
                            <label class="control-label" >Gender</label>
                                <div class="controls">
                                <select name="passenger{{$adults + $i}}_gender" style="width:50px;"><option>M</option><option>F</option></select>
                                   
                                    {{ $errors->first('gender', '<span class="help-block">:message</span>') }}
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="control-group{{ $errors->first('title', ' error') }}">
                            <label class="control-label" for="title">Title</label>
                                <div class="controls">
                                    <input type="text" name="passenger{{$adults + $i}}_title" style="width:80px;"  id="title" value="Mr." />
                                    {{ $errors->first('title', '<span class="help-block">:message</span>') }}
                                </div>
                            </div>

                            <!-- First Name -->
                            <div class="control-group{{ $errors->first('first_name', ' error') }}">
                            <label class="control-label" for="first_name">First Name</label>
                                <div class="controls">
                                    <input type="text" name="passenger{{$adults + $i}}_first_name" id="first_name" value="{{ $user->first_name }}" />
                                    {{ $errors->first('first_name', '<span class="help-block">:message</span>') }}
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="control-group{{ $errors->first('last_name', ' error') }}">
                            <label class="control-label" for="last_name">Last Name</label>
                                <div class="controls">
                                    <input type="text" name="passenger{{$adults + $i}}_last_name" id="last_name" value="{{ $user->last_name }}" />
                                    {{ $errors->first('last_name', '<span class="help-block">:message</span>') }}
                                </div>
                            </div>
                
                            <!-- Nationality -->
                            <div class="control-group{{ $errors->first('nationality', ' error') }}">
                            <label class="control-label" for="nationality">Nationality</label>
                                <div class="controls">
                                    <input type="text" name="passenger{{$adults + $i}}_nationality" id="nationality" value="NP" />
                                    {{ $errors->first('nationality', '<span class="help-block">:message</span>') }}
                                </div>
                            </div>    

                            <!-- Passenger Remarks -->
                             <div class="control-group{{ $errors->first('pax_remarks', ' error') }}">
                                <label class="control-label">Passenger Remarks</label>
                                <div class="controls">

                                    <textarea style="width:152px;" name="passenger{{$adults + $i}}_pax_remarks">None</textarea>
                                    {{ $errors->first('pax_remarks', '<span class="help-block">:message</span>') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor

            @endif
            
        </div>


        <br clear="all">
        

        <!-- Form actions -->
        <div class="control-group">
            <div class="controls">
                <a class="btn" href="{{ route('home') }}">Back</a>

                <button type="submit" class="btn">Submit</button>
            </div>
        </div>
    </form>


 @endif



                
                                </div> <!-- /Bottom --> 

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

        //For Reservation form
    $( "#datepicker" ).datepicker({       
          dateFormat: "dd-mm-yy"
        });
    $( "#clender" ).datepicker({       
          dateFormat: "dd-mm-yy"
        }); 

        $("#domestic").on('click', function() {
    
            $("#h4").text('Domestic Flight Search');
            
            $(".sectorFromIntl").hide();
            $("#sectorFrom").show();

            $(".sectorToIntl").hide();
            $("#sectorTo").show();

            $(".flight_date_intl").hide();
            $(".flight_date").show();

            $(".return_date_intl").hide();
            $(".return_date").show();

            $("#flight_form").attr("action", "{{URL::route('flightsearch')}}" );  
    
        });
            
    
        $("#international").on('click', function() {
    
            $("#h4").text('International Flight Search');

            $("#sectorFrom").hide();
            $(".sectorFromIntl").show();

            $("#sectorTo").hide();
            $(".sectorToIntl").show();

            $(".flight_date").hide();
            $(".flight_date_intl").show();

            $(".return_date").hide();
            $(".return_date_intl").show();

            $("#flight_form").attr("action", "{{URL::route('flightsearchintl')}}" );

    
        }); 


    }); //Onload


</script>

@stop
