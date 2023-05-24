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

        @if($errors->has())

   @foreach ($errors->all() as $error)

      <div>{{ $error }}</div>

  @endforeach

@endif
        

	<div id="tabs-1" class="tab clearfix" style="width:450px;" >
                            <div class="detail">
                                <form id="flight_form"  action="{{URL::route('flightsearch')}}" method="post">
                                     <!-- CSRF Token -->
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 
                                    <input type="hidden" name="backend" value="1" /> 
                                    <input type="hidden" name="dom_int" value="domestic" />
                                                                                        
                                    <a class="btn btn-info" id="domestic" > Domestic </a>                                    

                                    <a class="btn btn-info" id="international" > International </a>
                                    
                                    <h4 id="h4" style="margin:10px;">Domestic Flight Search </h4>
                                        
                                    <div class="trip">
                                        <input type="radio" name="trip_type" checked="checked" value="O"><span>One-way</span>
                                        <input type="radio" name="trip_type" value="R"><span>Roud-Trip</span>                 
                                    </div>

                                        <div class="location clearfix">
                                            <div class="pull-left">
                                                <label>Your Location</label>
                                
                                                <select name="sectorFrom"  id="sectorFrom">                        
                                                    <option value="KTM" SELECTED>KATHMANDU</option> 

                                                    <option value="BDP">BHADRAPUR</option>

                                                    <option value="BWA">BHAIRAHAWA</option>

                                                    <option value="BHR">BHARATPUR</option>

                                                    <option value="BIR">BIRATNAGAR</option>

                                                    <option value="DHI">DHANGADI</option>

                                                    <option value="JKR">JANAKPUR</option>

                                                    <option value="KTM">KATHMANDU</option>

                                                    <option value="MTN">MOUNTAIN</option>

                                                    <option value="KEP">NEPALJUNG</option>

                                                    <option value="PKR">POKHARA</option>

                                                    <option value="SIF">SIMARA</option>
                                                </select>
            

                                                    <input style="display:none;" class="sectorFromIntl" name="origin" type="text" id="tags">
                                                    </div>

                                            <div class="pull-right">
                                                <label class="dst">Destination</label>
                                 
                                                <select name="sectorTo"  id="sectorTo">
                                                    <option value="PKR"  SELECTED>POKHARA</option>

                                                    <option value="BDP">BHADRAPUR</option>

                                                    <option value="BWA">BHAIRAHAWA</option>

                                                    <option value="BHR">BHARATPUR</option>

                                                    <option value="BIR">BIRATNAGAR</option>

                                                    <option value="DHI">DHANGADI</option>

                                                    <option value="JKR">JANAKPUR</option>

                                                    <option value="KTM">KATHMANDU</option>

                                                    <option value="MTN">MOUNTAIN</option>

                                                    <option value="KEP">NEPALJUNG</option>

                                                    <option value="PKR">POKHARA</option>

                                                    <option value="SIF">SIMARA</option>

                                                </select>

                                               
                                                <input style="display:none;" class="sectorToIntl" name="destination" type="text" id="tags2">
                                            </div>
                                        </div>

                                        <div class="location clearfix">
                                            <div class="pull-left">
                                                <div class="date clearfix">
                                                    <div class="Depart-Date">
                                                        <label>Depart Date</label> 
                                                        <input type="text" class="flight_date" name="flight_date" value="<?php echo date('d-m-Y');?>" id="<?php echo 'datepicker';?>">
                                                        <input style="display:none" type="text" class="flight_date_intl" name="flight_date_intl" value="<?php echo date('Y-m-d');?>" id="<?php echo 'datepickerintl';?>">
                                                    </div>
                                                    <div id="returndiv" style="visibility:hidden;">
                                                        <label>Return Date</label>
                                                        <input type="text" class="return_date" name="return_date" value="<?php echo date('d-m-Y');?>" id="<?php echo 'clender';?>">
                                                        <input style="display:none" type="text" class="return_date_intl" name="return_date_intl" value="<?php echo date('Y-m-d');?>" id="<?php echo 'clenderintl';?>">
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pull-right">
                                                <div class="persons">
                                                    <div class="ad">
                                                        <label>Adults</label>
                                                        <input class=""type="text" name="adults" value="1" id="spinner">
                                                    </div>
                                                    <div class="ad">
                                                        <label>Children</label>
                                                        <input type="text" name="children" value="0" id="spinner-two">
                                                    </div>
                                                    <div class="ad">
                                                        <label>Nationality</label>
                                                        <select name="nationality" style="width:90px" >
                                                            <option value="Nepalese">Nepalese</option>
                                                            <option value="IN">Indian</option>
                                                            <option value="Others">Others</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="search">
                                            <input type="submit" name="search" value="SEARCH" >
                                        </div>
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

            jQuery.fn.visible = function() {
                return this.css('visibility', 'visible');
            };

            jQuery.fn.invisible = function() {
                return this.css('visibility', 'hidden');
            };

            jQuery.fn.visibilityToggle = function() {
                return this.css('visibility', function(i, visibility) {
                    return (visibility == 'visible') ? 'hidden' : 'visible';
                });
            };
        

            /**
             * Show/Hide Return input box according to checkbox( One way, Return trip)
             */
            $('input[name="trip_type"]').change(function() {
                    trip_type = $(this).val();
                    if (trip_type == 'O') {
                        $('#returndiv').invisible();
                    } else {
                        $('#returndiv').visible();
                    }
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

                $('form#flight_form input[name="dom_int"]').val('domestic');
        
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

                $('form#flight_form input[name="dom_int"]').val('international');
            });

            $(function() {
                <?php
                include(app_path().'/includes/airports.php');


                echo 'var availableTags = ['. $airports .'];';
                ?>

                
                $( ".sectorFromIntl" ).autocomplete({
                  source: availableTags,
                  minLength: 3
                });

                $( ".sectorToIntl" ).autocomplete({
                  source: availableTags,
                  minLength: 3
                });

            });

        }); //Onload
    </script>
@stop
