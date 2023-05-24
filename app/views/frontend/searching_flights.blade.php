<!doctype html>
<html>
<head>
    <title>Searching Flights</title>
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.css') }}">
</head>
<body>
    <div id="loading" style="width:1024px; margin: 20px auto; padding:5px; z-index:999999; background-color:#fff;">
                  
        <div class="logo" style="width:280px; margin:12px auto;">
            <?php $logo = ApplicationSetting::find(6)->image; ?>

            @if(isset($logo))
            <a href="{{ route('home') }}">

                <img style="width:280px; height:auto;" src="{{ asset('assets/frontend/images/'. $logo) }}" alt="Logo">
            
            </a>
            @endif
        
        </div>

          <div style="width:280px; margin:12px auto;">

            <div style="width:170px; margin:12px auto; font-size: 28px;">

                    @if ($dom_int == 'domestic')
                        {{ $sectorFrom }}  →  {{ $sectorTo }} 
                    @elseif ($dom_int == 'international')
                        {{ $origin }} → {{ $destination}} 
                    @endif

            </div>
            
              <div class="progress progress-danger progress-striped active">
                <div class="bar" style="width: 100%; background-color: #1CC26C;"></div>
              </div>
            
          </div>  

        <div style="width: 344px;margin: 12px auto; font-size: 22px; font-family: cursive; color: #FF7521;">Searching for the best airfares...</div> 
        <img style="width:100%; height:auto; border:1px solid #dddddd; border-radius:4px;" src="{{asset('assets/img/searchflights.jpg')}}">

    </div>
             

<form method="post" action="
 @if ($dom_int == 'domestic')
    {{ route('flight-results') }}
@elseif ($dom_int == 'international')
     {{ route('flightsearchintl') }}
@endif 
">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 
    <input type="hidden" name="sectorFrom" value="{{ $sectorFrom }}" /> 
    <input type="hidden" name="sectorTo" value="{{ $sectorTo }}" /> 
    <input type="hidden" name="origin" value="{{ $origin }}" /> 
    <input type="hidden" name="destination" value="{{ $destination }}" /> 
    <input type="hidden" name="flight_date" value="{{ $flight_date }}" /> 
    <input type="hidden" name="trip_type" value="{{ $trip_type }}" /> 
    <input type="hidden" name="return_date" value="{{ $return_date }}" /> 
    <input type="hidden" name="flight_date_intl" value="{{ $flight_date_intl }}" /> 
    <input type="hidden" name="return_date_intl" value="{{ $return_date_intl }}" /> 
    <input type="hidden" name="adults" value="{{ $adults }}" /> 
    <input type="hidden" name="children" value="{{ $children }}" /> 
    <input type="hidden" name="nationality" value="{{ $nationality }}" /> 
    @if(isset($backend))
        <input type="hidden" name="backend" value="{{ $backend }}" />
    @endif
</form>

<script type="text/javascript" src="{{asset('assets/frontend/js/jquery.js')}}"></script>

 <script type="text/javascript">
    $(document).ready(function() {
        $('form').submit();
    }); //Onload
</script>     
 </body>
 </html>
 

