@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Vacation Rentals ::
@parent
@stop

{{-- Page content --}}
@section('content')

                                    
   
    
			


 <!-- Crum -->
                <div class="crum-wrapper">
                	<div class="container">
                    	<div class="row">
                        	<div class="span12">
                            	<a href="">Home</a>
                                <span class="crum">Detail</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Crum-->
               
                <!-- Grid page -->
                <div class="content trave_detail">
                    <div class="container">
                        <div class="row">

                            <div class="span3" id="sidebar">
                                <div class="widget checking_form clearfix">
                                    <form 
                                        action="
                                        
                                        
                                         @if(Sentry::getUser())
                                        
                                         {{ URL::to('booking') }}
                                        
                                         @else
                                        
                                         {{ URL::to('signinpost') }}
                                          
                                         @endif
                                        
                                        "
                                       
                                        
                                        method="post" class="clearfixc">
                                        
                                          <!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
        
                                        <div class="check_detail">
                                            <h4>{{ $entry->HotelSummary->name }}</h4>
                                            <h5>{{ $entry->HotelSummary->countryCode }}</h5>
                                            <div class="stars">
                                                <a href="#" class="active"></a>
                                                <a href="#" class="active"></a>
                                                <a href="#" class="active"></a>
                                                <a href="#"></a>
                                                <a href="#"></a>
                                            </div>
                                        </div>

                                          <div class="location clearfix">
                                            <div class="pull-left clearfix">
                                                <div class="date clearfix">
                                                    <div class="Depart-Date">
                                                        <label>Check in</label>
                                                        <input type="text" name="Location" value="30.01.2013" id="datepicker">
                                                    </div>
                                                    <div>
                                                        <label>Check Out</label>
                                                        <input type="text" name="Location" value="30.01.2013" id="clender">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="check_detail clearfix" >
                                                <p class="first">Single Room <span>138$</span></p>
                                                <p class="two">Double Room <span>250$</span></p>
                                            </div>

                                            <div class="pull-right">
                                                <div class="persons clearfix">
                                                    <div class="ad">
                                                        <label>Adults</label>
                                                        <input type="text" name="Location" value="1" id="spinner">
                                                    </div>
                                                    <div class="ad">
                                                        <label>Children</label>
                                                        <input type="text" name="Location" value="1" id="spinner-two">
                                                    </div>
                                                    <div>
                                                        <label>Senior</label>
                                                        <input type="text" name="Location" value="1" id="spinner-three">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                      
                                        <p class="clearfix">Total Booking <span>{{ $entry->HotelSummary->highRate }}$</span></p>
                                        <div class="search">
                                            <input type="submit" name="search" value="BOOK NOW" >
                                        </div>
                                    </form>
                                </div>
                               
                            </div>

                            <div class="span9 right_content">
                                <div class="carousel_wrap">
                                    <div id="carousel-wrapper">
                                        <div id="carousel_two" class="cool-carousel">
                                            {{--*/ $count = 1; /*--}}
                                            @foreach ($images as $image)
                                            <span id="image{{$count}}" style="background-color: black;"><img style="width:auto; position: absolute;
                                                top: 0; bottom:0; left: 0; right:0;
                                                margin: auto;" src="{{ $image->url}}" alt=""/></span>
                                            {{--*/ $count++; /*--}}
                                            @endforeach
                                           
                                        </div>
                                        <a href="#" class="prev"></a><a href="#" class="next"></a>
                                    </div>

                                    <div class="carousal-bottom">
                                        <div id="thumbs-wrapper">
                                            <div id="thumbs">
                                                 {{--*/ $count = 1; /*--}}
                                            @foreach ($images as $image)
                                           
                                            <a href="#image{{$count}}" {{ ($count == 1 ? ' class="selected"' : '') }} >
                                                <img style="width:auto; position: absolute;
                                                top: 0; bottom:0; left: 0; right:0;
                                                margin: auto;" src="{{ $image->thumbnailUrl}}" alt=""/>
                                            </a>
                                            {{--*/ $count++; /*--}}
                                            @endforeach
                                               
                                            </div>
                                            <a id="prev" href="#"></a>
                                            <a id="next" href="#"></a>
                                        </div>
                                    </div>

                                    <span class="border"></span>
                                </div>

                                <div id="tabs_two">
                                    <ul class="clearfix">
                                        <li><a href="#tabs-1" class="one">Summary</a></li>
                                        <li><a href="#tabs-2" class="two">Details</a></li>
                                        <li><a href="#tabs-3" class="three">Location</a></li>
                                        <li><a href="#tabs-4" class="four">Reviews</a></li>
                                    </ul>
                                    <div id="tabs-1" class="tab clearfix" >
                                        <div class="detail clearfix">
                                            <p>{{ html_entity_decode($entry->HotelDetails->propertyDescription)}}</p>
                                        </div>
                                    </div>
                                    <div id="tabs-2" class="tab clearfix" >
                                        <div class="detail clearfix" >
                                            
                                            
                                          
    
       <ul>
                                                 Country: {{ $entry->HotelSummary->countryCode}}   | 
                        Location Description: {{ $entry->HotelSummary->locationDescription}}   |
                      
                        
                    
                                              
                                            </ul>
    
    
    
                                           
                                        
                                        </div>
                                    </div>
                                    <div id="tabs-3" class="tab clearfix" >
                                        <div class="detail">
                                            <div class="map">
                                                <iframe width="100%" height="360" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Envato+Pty+Ltd,+13%2F2+Elizabeth+Street,+Melbourne+VIC,+Australia&amp;aq=0&amp;oq=envato&amp;sll=37.0625,-95.677068&amp;sspn=39.371738,86.572266&amp;ie=UTF8&amp;hq=Envato+Pty+Ltd,+13%2F2+Elizabeth+Street,&amp;hnear=Melbourne+Victoria,+Australia&amp;t=p&amp;ll=-37.817209,144.961681&amp;spn=0.010849,0.04107&amp;z=15&amp;output=embed"></iframe>
                                            </div>

                                            <h2>Hotel Location</h2>
                                            <p>Feugiat consequat augue pulvinar fusce quis dui diam leo dictumst, fringilla quisque nulla nec blandit lectus aenean lobortis ultrices, fames dolor accumsan ultrices eleifend convallis himenaeos etiam.</p>
                                        </div>
                                    </div>
                                    <div id="tabs-4" class="tab clearfix" >
                                        <div class="detail">
                                            <div class="row">

                                                <div class="span4 our_rating">
                                                    <h2>Your Rating</h2>
                                                    <ul>
                                                        <li class="first">Clear</li>
                                                        <li><a href="#" class="blue_star"></a></li>
                                                        <li><a href="#" class="blue_star"></a></li>
                                                        <li><a href="#" class="blue_star"></a></li>
                                                        <li><a href="#" class="blue_star"></a></li>
                                                        <li><a href="#" class="star"></a></li>
                                                    </ul>

                                                    <ul>
                                                        <li class="first">CLocation</li>
                                                        <li><a href="#" class="blue_star"></a></li>
                                                        <li><a href="#" class="blue_star"></a></li>
                                                        <li><a href="#" class="blue_star"></a></li>
                                                        <li><a href="#" class="star"></a></li>
                                                        <li><a href="#" class="star"></a></li>
                                                    </ul>

                                                    <ul>
                                                        <li class="first">Staff</li>
                                                        <li><a href="#" class="blue_star"></a></li>
                                                        <li><a href="#" class="blue_star"></a></li>
                                                        <li><a href="#" class="blue_star"></a></li>
                                                        <li><a href="#" class="blue_star"></a></li>
                                                        <li><a href="#" class="blue_star"></a></li>
                                                    </ul>

                                                    <ul>
                                                        <li class="first">Service</li>
                                                        <li><a href="#" class="blue_star"></a></li>
                                                        <li><a href="#" class="blue_star"></a></li>
                                                        <li><a href="#" class="blue_star"></a></li>
                                                        <li><a href="#" class="blue_star"></a></li>
                                                        <li><a href="#" class="blue_star"></a></li>
                                                    </ul>

                                                    <ul class="last">
                                                        <li class="first">Comfort</li>
                                                        <li><a href="#" class="blue_star"></a></li>
                                                        <li><a href="#" class="blue_star"></a></li>
                                                        <li><a href="#" class="blue_star"></a></li>
                                                        <li><a href="#" class="blue_star"></a></li>
                                                        <li><a href="#" class="star"></a></li>
                                                    </ul>
                                                    <p><span>4.5/5</span> Rating based on 5 verified Reviews</p>
                                                </div>


                                                <div class="span4">
                                                    <div class="hotdeal">
                                                        <div class="deal-header">
                                                            <h3>Comments</h3>
                                                        </div>

                                                        <div id="vcarousel">
                                                            <ul>
                                                                <li>
                                                                    <figure class="pull-left"><img src="images/hotdeal-pic.png" alt="Pic"></figure>
                                                                    <article class=" clearfix">
                                                                        <div class="hot pull-left">
                                                                            <h5>Emma Thomson</h5>
                                                                            <span>12 minutes ago.</span>
                                                                            <p>Lorem ipsum venenatis donec sociosqu porta </p>
                                                                        </div>
                                                                    </article>
                                                                </li>
                                                                <li>
                                                                    <figure class="pull-left"><img src="images/hotdeal-pic.png" alt="Pic"></figure>
                                                                    <article class=" clearfix">
                                                                        <div class="hot pull-left">
                                                                            <h5>Emma Thomson</h5>
                                                                            <span>12 minutes ago.</span>
                                                                            <p>Lorem ipsum venenatis donec sociosqu porta </p>
                                                                        </div>
                                                                    </article>
                                                                </li>
                                                                <li>
                                                                    <figure class="pull-left"><img src="images/hotdeal-pic.png" alt="Pic"></figure>
                                                                    <article class=" clearfix">
                                                                        <div class="hot pull-left">
                                                                            <h5>Emma Thomson</h5>
                                                                            <span>12 minutes ago.</span>
                                                                            <p>Lorem ipsum venenatis donec sociosqu porta </p>
                                                                        </div>
                                                                    </article>
                                                                </li>
                                                                <li>
                                                                    <figure class="pull-left"><img src="images/hotdeal-pic.png" alt="Pic"></figure>
                                                                    <article class=" clearfix">
                                                                        <div class="hot pull-left">
                                                                            <h5>Emma Thomson</h5>
                                                                            <span>12 minutes ago.</span>
                                                                            <p>Lorem ipsum venenatis donec sociosqu porta </p>
                                                                        </div>
                                                                    </article>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="pull-right">
                                                            <a href="" class="d-down"></a>
                                                            <a href="" class="d-up"></a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- Grid page -->


@stop