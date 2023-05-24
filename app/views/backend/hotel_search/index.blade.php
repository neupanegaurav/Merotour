@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Hotel Search ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Hotel Search
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Hotel Search
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
        
<div id="tabs-2" class="tab clearfix" style="width:450px;" >
                            <div class="detail">
                                <form action="{{URL::route('searchbox2')}}" method="post">
                                 
                                    <div class="trip" style="display:block; height:20px;">                                       
                                    </div>
                                    
                                    <!-- CSRF Token -->
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 
                                    <input type="hidden" name="backend" value="1" /> 

                                    <div class="location clearfix">                                      
                                        <label class="dst">City Code</label>
                                        <input type="text" name="city" value="DXB">
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

        $("#domestic").on('click', function() {
    
            $("#h4").text('Domestic Hotel Search');
            
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
    
            $("#h4").text('International Hotel Search');

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
