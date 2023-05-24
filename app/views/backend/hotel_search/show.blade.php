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

        <style type="text/css">
        /********************************************************
            *-*-*-* CAROUSEL *-*-*-*
        *********************************************************/

        .caroufredsel_wrapper { height: 354px !important; }
        .carousel_wrap { position: relative; margin-left: 0px; width: 96.5% }

        #wrapper { width: 470px; float: right; margin: 0px 40px; }

        #carousel-wrapper {position: relative; }

        .carousal-bottom{ background: #ffffff; }
        #carousel_two { position: relative; }

        #carousel-wrapper .caroufredsel_wrapper { height: 311px !important; }

        #carousel_two > span { height: 311px !important; }
        #carousel_two > span img {  width: 100%; height: 100%;}

        .carousel_wrap .next { display: block; width: 55px; height: 108px; top: 139px; position: absolute; right: -16px; background: url("../images/next.png") no-repeat; }

        .carousel_wrap .prev { display: block; width: 55px; height: 108px; top: 139px; position: absolute; left: -16px; background: url("../images/prev.png") no-repeat; }

        #thumbs-wrapper { width: 100%; margin-bottom: 30px; position: relative; }

        #thumbs { overflow: hidden; width: 300px; height: 300px; width: 300px; height: 300px; }

        #carousel_two span, #carousel_two img, #thumbs a, #thumbs img { display: block; float: left; }

        #carousel_two span, #carousel_two a, #thumbs span { position: relative; }

        #thumbs img { border: none; width: 100%; position: absolute; top: 0; left: 0; }

        #carousel_two img { border: none; position: absolute; top: 0; left: 0; }

        #carousel_two img.glare, img.glare { width: 102%; height: auto; }


        #thumbs-wrapper .caroufredsel_wrapper { margin: 0px !important; height: 112px !important; line-height: 112px; }

        #thumbs a { position: relative; }

        #thumbs { padding: 20px 69px 0px; height: 377px !important; }

        #thumbs a {  float: left; width:97px !important; border-radius: 8px; height: 74px !important; margin: 0 10px; overflow: hidden; -webkit-transition: border-color .5s; -moz-transition: border-color .5s; -ms-transition: border-color .5s; transition: border-color .5s; }

        #thumbs a img { height: 100%;  border-radius: 8px;}

        #prev { display: block; width: 61px; height: 112px; position: absolute; top: 0px;  display: block !important;  background: url("../images/crosal-left.png") no-repeat; background-size: 100% 100%; }

        #next { display: block; width: 61px; height: 112px; position: absolute; top: 0px; right: -1px; display: block !important;  background: url("../images/crosal-right.png") no-repeat;  background-size: 100% 100%;}

        #prev { background-position: 0 0; left: 0px; }


        #prev.disabled, #next.disabled { display: block !important; }

        #donate-spacer { height: 100%; }

        #donate { border-top: 1px solid #999; width: 750px; padding: 50px 75px; margin: 0 auto; overflow: hidden; }

        #donate p, #donate form { margin: 0; float: left; }

        #donate p { width: 650px; }

        #donate form { width: 100px; }

        </style>
        

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

			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>
         

@stop


@section('currentpagejs')

<script src="{{ asset('assets/frontend/js/jquery.carouFredSel-6.0.4-packed.js') }}"></script>
<script src="{{ asset('assets/frontend/js/custom.js') }}"></script>


@stop
