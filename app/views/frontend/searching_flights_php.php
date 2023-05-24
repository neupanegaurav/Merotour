 <div id="loading" style="width:625px; border:1px solid #dddddd; border-radius:8px; padding:5px; z-index:999999; background-color:#fff;">
                  
                <img src="{{asset('assets/img/searchflights.jpg')}}">


                  <div style="margin:auto; margin-top: 7px;">
                    
                      <div class="progress progress-danger progress-striped active">
                        <div class="bar" style="width: 100%; background-color: #1CC26C;"></div>
                      </div>
                    
                  </div>  
                  Please wait, Searching for available flights...
                    

                    </div>
<?php
        $url = route('flight-results');

        $token = Session::token();

        //exit();

        $fields = array(
            'sectorFrom'    => $sectorFrom,
            'sectorTo'      => $sectorTo,
            'flight_date'   => $flight_date,
            'trip_type'     => $trip_type,
            'return_date'   => $return_date,
            'adults'        => $adults,
            'children'      => $children,
            'nationality'   => $nationality,
            '_token'        => $token
        );

        sleep(5);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($fields));
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

        curl_exec($curl);

      /*  $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        //curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));

        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_exec ($ch);

       // curl_close ($ch);

        //echo $server_output;*/
?>
