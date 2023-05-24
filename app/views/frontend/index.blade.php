@extends('frontend/layouts/default')

{{-- Page content --}}
@section('content')

        <div class="why-us">
        <div class="section_left">
            <h3 style="font-size:30px; margin-bottom:0px;">Why Us</h3>
            <ul class="why_us_nav">
                <li>Winner of National Tourism Awards</li>
                <li>Nepal's leading travel brand</a></li>
                <li>Over 100 services in Nepal and 430,000 worldwide</a></li>
                <li>Trusted by happy travellers</a></li>
                <li>Best price guarntee</a></li>
            </ul>
            
            <h4 style="font-size:30px; margin-bottom:24px">Deals in your box</h4>
            <p>Sign Up Free E-mail</p>

            <span style="float:left; margin:3px 10px 0 0;"><img src="{{asset('assets/frontend/images/mail_box.jpg')}}" alt="" /></span>
            <span>
                <form action="{{URL::route('newsletter')}}" method="post">                                                                                       
                      <!-- CSRF Token -->
                     <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="text" id="check_mail" name="email" value="Enter your E-mail" />
                    <button class="sign_up" type="submit">Sign up</button>
                </form>
            </span>
           
           </div><!--end why-us -->
        </div><!--end section_left -->
       
     
     <div class="top21">
                <div class="box21" id="topbox1">
                            <div class="image"><div class="travelhover"><img alt="travelhover" src="{{asset('assets/frontend/images/travelh.png')}}" /></div>
                                <a href="{{ route('package-tours-show', $package_tours_1->id) }}">
                                    <img alt="top1" style="width: 284px; height:192px;" src="{{ asset('assets/img/uploads/package_tours/' . $package_tours_1->photo)}}" />
                                </a>
                            </div>
                            <div class="ratings">
                                <ul class="star-rating">
                                  <li><a href="#" class="one-star">1</a></li>
                                  <li><a href="#" class="two-stars">2</a></li>
                                  <li><a href="#" class="three-stars">3</a></li>
                                  <li><a href="#" class="four-stars">4</a></li>
                                  <li><a href="#" class="five-stars">5</a></li>
                                </ul>
                                <span class="address"> {{ $package_tours_1->address }} </span>
                            </div>
                            <div class="desc"> {{ Str::words(html_entity_decode($package_tours_1->short_description), 18);}} <span class="more"><a href="{{ route('package-tours-show', $package_tours_1->id) }}">More</a></span></div>
                            <div class="viewmap"><a class="md-trigger" data-modal="modal-viewmap1" href="{{ route('package-tours-show', $package_tours_1->id) }}">View on Map</a></div>
                            <div class="booknow">
                                <div class="price">

                                <?php $currency = Session::get('currency'); ?>

                        @if($currency == 'usd')
                        <div class="price">
                            <span class="dollar">$ </span> 
                            {{$package_tours_1->cost}}
                        </div>
                    

                        @elseif ($currency == 'npr')
                        <span class="dollar">NPR</span> 
                        <?php $npr_cost = ceil($package_tours_1->cost * FXRate::where('iso_code', 'USD')->first()->exchange_rate) ?>
                       {{ $npr_cost }}
                      
                        @endif  

                            
                                </div>
                                <div class="book"><a class="bookbtn" href="{{route('package-tours-order', $package_tours_1->id )}}" name="booknow"> Book Now  </a></div>
                                <div class="clrleft"></div>
                            </div>
            </div>
    </div>
    <div class="clright"></div>
    <div id="right" class="top21">
                    <div class="box21" id="topbox1">
                            <div class="image">
                                <div class="travelhover">
                                    <img alt="travelhover" src="{{asset('assets/frontend/images/travelh.png')}}" />
                                </div>
                                <a href="{{ route('package-tours-show', $package_tours_2->id) }}">
                                    <img alt="top1" style="width: 284px; height:192px;" src="{{ asset('assets/img/uploads/package_tours/' . $package_tours_2->photo)}}" />
                                </a>
                                </div>
                            <div class="ratings">
                                <ul class="star-rating">
                                  <li><a href="#" class="one-star">1</a></li>
                                  <li><a href="#" class="two-stars">2</a></li>
                                  <li><a href="#" class="three-stars">3</a></li>
                                  <li><a href="#" class="four-stars">4</a></li>
                                  <li><a href="#" class="five-stars">5</a></li>
                                </ul>
                                <span class="address"> {{ $package_tours_2->address }} </span>
                            </div>
                            <div class="desc"> {{ Str::words(html_entity_decode($package_tours_2->short_description), 18);}} <span class="more"><a href="{{ route('package-tours-show', $package_tours_2->id) }}">More</a></span></div>
                            <div class="viewmap"><a class="md-trigger" data-modal="modal-viewmap1" href="{{ route('package-tours-show', $package_tours_2->id) }}">View on Map</a></div>
                            <div class="booknow">
                                <div class="price">

                                <?php $currency = Session::get('currency'); ?>

                        @if($currency == 'usd')
                        <div class="price">
                            <span class="dollar">$ </span> 
                            {{$package_tours_2->cost}}
                        </div>
                    

                        @elseif ($currency == 'npr')
                        <span class="dollar">NPR</span> 
                        <?php $npr_cost = ceil($package_tours_2->cost * FXRate::where('iso_code', 'USD')->first()->exchange_rate) ?>
                       {{ $npr_cost }}
                      
                        @endif  

                            
                                </div>
                                <div class="book"><a class="bookbtn" href="{{route('package-tours-order', $package_tours_2->id )}}" name="booknow"> Book Now  </a></div>
                                <div class="clrleft"></div>
                            </div>
            </div>
                        </div>

                   <div class="another_content"></div> 


                   <div class="clr"></div>  

                     <div class="coll6">
                                    <h1 style="font-size:30px; color:#2d2d2d;">Pages</h1>
                                                         
                                <div class="left_coll">

                               
                                    <div class="left_coll_nav">
                                            <ul>
                                                @foreach ($pages_left as $page)
                                                <li><img src="{{asset('assets/frontend/images/services-icons/refund.png')}}"><a href="{{ URL::to($page->slug) }}" >{{$page->title}} </a> </li>
                                                @endforeach
                                            </ul>
                                     </div><!--end left_coll_nav -->
                                        <div class="right_coll_nav">
                                            <ul>
                                                @foreach ($pages_right as $page)
                                                <li><img src="{{asset('assets/frontend/images/services-icons/refund.png')}}"><a href="{{ URL::to($page->slug) }}" >{{$page->title}} </a> </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                
                                </div><!--end left_coll-->
                                <div class="right_h">
                                <h1 style="font-size:30px; color:#2d2d2d;">Special Hotel Offers</h1>

                             <div class="right_coll">

                             @foreach($hotels as $hotel)
                                
                                <div class="europe">

                                        <div class="europe_img">
                                            <img  style="width: 100px; height:100px;" src="{{asset('assets/img/uploads/hotels/'.$hotel->photo)}}" />
                                        </div>

                                        <div class="country21">
                                            <div style="float:left">
                                                <p style="width:80px; margin:0; padding:0;">
                                                <a href="{{ route('hotel-show', $hotel->id) }}"> {{ $hotel->country }}</a>
                                                </p>

                                                <p>
                                                {{ $hotel->city }}
                                                </p>
                                            </div>

                                                <span style="float:left; margin-right:20px;"><img src="{{asset('assets/frontend/images/services-icons/divider.png')}}" /></span>
                                            <p style="margin:0; padding:0;"> {{ Str::words(html_entity_decode($hotel->short_description), 17); }} </p>
                                        </div>

                                    <div class="tour_price">
                                    <p> 
                                        @if($currency == 'usd')
                                        <div class="price">
                                            <span class="dollar">$ </span> 
                                            {{$package_tours_2->cost}}
                                        </div>
                                    

                                        @elseif ($currency == 'npr')
                                        <span class="dollar">NPR</span> 
                                        <?php $npr_cost = ceil($package_tours_2->cost * FXRate::where('iso_code', 'USD')->first()->exchange_rate) ?>
                                       {{ $npr_cost }}
                                       @endif
                                    </p>
                                    </div>

                                  <br clear="all">

                                </div>

                                @endforeach

                            </div><!--end right_coll -->
                            </div>
                       </div><!--end coll6 -->

 <div id="loading" style="display:none; position:fixed; top:94px; left:18%; width:625px; border:1px solid #dddddd; border-radius:8px; padding:5px; z-index:999999; background-color:#fff;">
                  
                <img src="{{asset('assets/img/searchflights.jpg')}}">


                  <div style="margin:auto; margin-top: 7px;">
                    
                      <div class="progress progress-danger progress-striped active">
                        <div class="bar" style="width: 100%; background-color: #1CC26C;"></div>
                      </div>
                    
                  </div>  
                  Please wait, Searching for available flights...
                    

                    </div>

@stop

@section('customjs')

    <script type="text/javascript">
        $(document).ready(function() {

            $('input.lightblue').iCheck({ radioClass: 'iradio_minimal-lightblue' });

            $( "#datepicker1" ).datepicker({       
                format: "dd-mm-yyyy",
                todayBtn: "linked",
                todayHighlight: true,
                startDate: "d",
                autoclose: true
            });

            $( "#datepicker2" ).datepicker({       
                format: "dd-mm-yyyy",
                todayBtn: "linked",
                todayHighlight: true,
                startDate: "d",
                autoclose: true
            });

            $("#datepicker1_intl").datepicker({       
                format: "yyyy-mm-dd",
                todayBtn: "linked",
                todayHighlight: true,
                startDate: "d",
                autoclose: true
            });

            $("#datepicker2_intl").datepicker({       
                format: "yyyy-mm-dd",
                todayBtn: "linked",
                todayHighlight: true,
                startDate: "d",
                autoclose: true
            }); 

            $("#checkin_picker").datepicker({       
                format: "yyyy-mm-dd",
                todayBtn: "linked",
                todayHighlight: true,
                startDate: "d",
                autoclose: true
            });

            $("#checkout_picker").datepicker({       
                format: "yyyy-mm-dd",
                todayBtn: "linked",
                todayHighlight: true,
                startDate: "d",
                autoclose: true
            });   

            $("#checkin_picker2").datepicker({       
                format: "yyyy-mm-dd",
                todayBtn: "linked",
                todayHighlight: true,
                startDate: "d",
                autoclose: true
            });

            $("#checkout_picker2").datepicker({       
                format: "yyyy-mm-dd",
                todayBtn: "linked",
                todayHighlight: true,
                startDate: "d",
                autoclose: true
            }); 

            $("#pickup_date").datepicker({       
                format: "yyyy-mm-dd",
                todayBtn: "linked",
                todayHighlight: true,
                startDate: "d",
                autoclose: true
            });

            $("#return_date").datepicker({       
                format: "yyyy-mm-dd",
                todayBtn: "linked",
                todayHighlight: true,
                startDate: "d",
                autoclose: true
            });


            /*$('input[name="vehicle_return"]').change(function() {

                $('#return_location').slideToggle('fast');
            });   */     


            $('#ui-datepicker-div').wrap('<div id="themedp"></div>');


            // Get State/Cities
            $('select[name="package_country"], select[name="hotel_country"], select[name="vacation_country"], select[name="vehicle_country"]').change(function() {

                country = $('option:selected', this).text();

                type = $(this).attr("name");

                url = "<?php echo route('home'); ?>";

                $.get( url + "country/" + country, function(data) {
                    //$( ".result" ).html( data );
                  
                    cities = '';
                  
                    Array.prototype.forEach.call(data, function(data) {
                        cities += '<option>' + data.city + '</option>';
                    });


                    //alert(cities);
                  
                    //alert(JSON.stringify(data));
                    
                    if (type == 'package_country') {
                        $('select[name="package_state"]').html(cities);
                        $('select[name="package_area_city"]').html(cities);
                    } else if(type == 'hotel_country') {
                        $('select[name="hotel_location"]').html(cities);
                    } else if (type == 'vacation_country') {
                        $('select[name="vacation_state"').html(cities);
                        $('select[name="vacation_area"').html(cities);
                    } else if (type == 'vehicle_country') {
                        
                        if (country == 'Nepal') {

                            addncities = cities;

                            addncities += '<option>Airport Transfer</option>\
                                          <option>Mountain Flight</option>\
                                          <option>Half day  Sight Seeing</option>\
                                          <option>Full Day Sight Seeing</option>\
                                          <option>Dakchinkali</option>\
                                          <option>Dakchinkali, Kritipur</option>\
                                          <option>Godhavari</option>\
                                          <option>Godavari, Patan</option>\
                                          <option>Phulchoki</option>\
                                          <option>Changu Narayan</option>\
                                          <option>Gokarna</option>\
                                          <option>Sundarijal</option>\
                                          <option>Sundarijal & Gokarna</option>\
                                          <option>Budhanilkantha</option>\
                                          <option>Bugmati</option>\
                                          <option>Nagarjune</option>\
                                          <option>Kakani & Balaju</option>\
                                          <option>Trishuli</option>\
                                          <option>Dhunche</option>\
                                          <option>Dhulikhel</option>\
                                          <option>Panauti</option>\
                                          <option>Namoboudha</option>\
                                          <option>Nagarkot</option>\
                                          <option>Nagarkot & Bhaktapur</option>\
                                          <option>Palanchok Bhagawoti</option>\
                                          <option>Chautara</option>\
                                          <option>Barabise</option>\
                                          <option>Kodari</option>\
                                          <option>Charikot</option>\
                                          <option>Jiri</option>\
                                          <option>Melamchi</option>\
                                          <option>Charaudi</option>\
                                          <option>Fishling</option>\
                                          <option>Kuringhat</option>\
                                          <option>Mugling</option>\
                                          <option>Gorkha</option>\
                                          <option>Dumre</option>\
                                          <option>Pokhara</option>\
                                          <option>Baglung</option>\
                                          <option>Nayapul</option>\
                                          <option>Gaighat</option>\
                                          <option>Gugedi</option>\
                                          <option>Chitwan Jungle</option>\
                                          <option>Machan - Overnight</option>\
                                          <option>Hedauda - Overnight</option>\
                                          <option>Birgunj - Overnight</option>\
                                          <option>Janakpur - Overnight</option>\
                                          <option>Lahan - Overnight</option>\
                                          <option>Biratnagar</option>\
                                          <option>Kakarvitta - Overnight</option>\
                                          <option>Dharan - Overnight</option>\
                                          <option>Dhankutta - Overnight</option>\
                                          <option>Megauli</option>\
                                          <option>Island Jungle Resort</option>\
                                          <option>Butwal - Overnight</option>\
                                          <option>Bhairawa - overnight</option>\
                                          <option>Lumbini - Overnight</option>\
                                          <option>Nepalgunj - Overnight</option>\
                                          <option>Dang - Overnight</option>\
                                          <option>Bardia NationalPark - Overnight</option>';

                            $('select[name="vehicle_from"').html(addncities);

                            $('select[name="vehicle_to"').html(addncities);              
                            
                        } else {
                            $('select[name="vehicle_from"').html(cities);
                            $('select[name="vehicle_to"').html(cities);
                        }

                        
                    }
                    
                  
                    //alert("Load was performed.");
                });
            }); 
            // End of Get Cities        
                 
         }); //Onload
    </script>           
@stop
