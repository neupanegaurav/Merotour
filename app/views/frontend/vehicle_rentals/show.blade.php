@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Vacation Rentals ::
@parent
@stop

{{-- Page content --}}
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/jslider-theme/jslider-slider.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/pages/bookdetail.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/carouselfred.css') }}" />

    <div class="wrapcontent">
            <div class="left">
                <div class="box">
                    <div class="topbox">
                        <div class="title"><h2>SEARCH FILTER</h2></div>
                        <div class="reset"><a onclick="resetall()" href="#">Reset All</a></div>
                        <div class="clear"></div>
                    </div>
                    <div class="midbox">
                    
                        <h3>Price Range</h3>
                        <div id="themesl"><div id="price-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" aria-disabled="false"><div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 10%; width: 65%;"></div><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 10%;"></a><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 75%;"></a></div></div>
                        <div class="slide-result">
                            <input disabled="" class="amount1" type="text" id="pr1">
                            <input disabled="" class="amount2" type="text" id="pr2" value="$ 1500">
                            <div class="clear"></div>
                        </div>
                        
                        <h3>Star Rating</h3>
                        <div id="themesl"><div id="star-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" aria-disabled="false"><div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min" style="width: 50%;"></div><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 50%;"></a></div></div>
                        <div class="slide-result">
                            <div class="rated"><div class="stars three"></div></div>
                            <input disabled="" class="amount2" type="text" id="sr" value="15 Ratings">
                            <div class="clear"></div>
                        </div>
                        
                        <h3>User Rating</h3>
                        <div id="themesl"><div id="user-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" aria-disabled="false"><div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min" style="width: 60%;"></div><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 60%;"></a></div></div>
                        <div class="slide-result">
                            <div class="urated"><div class="bullets three"></div></div>
                            <input disabled="" class="amount2" type="text" id="ur" value="30 Users">
                            <div class="clear"></div>
                        </div>
                        
                        <h3>Accommodation Type</h3>
                        <table class="sbox">
                            <tbody><tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue checked" style="position: relative;"><input class="lightblue" type="radio" name="accommodation" value="1" id="ac1" checked="checked" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">Apartments<span class="no">(39)</span></div></td></tr>
                            <tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue" style="position: relative;"><input class="lightblue" type="radio" name="accommodation" value="2" id="ac2" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">Hotel<span class="no">(20)</span></div></td></tr>
                            <tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue" style="position: relative;"><input class="lightblue" type="radio" name="accommodation" value="3" id="ac3" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">Guest House<span class="no">(56)</span></div></td></tr>
                            <tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue" style="position: relative;"><input class="lightblue" type="radio" name="accommodation" value="4" id="ac4" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">Village Points<span class="no">(13)</span></div></td></tr>
                            <tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue" style="position: relative;"><input class="lightblue" type="radio" name="accommodation" value="5" id="ac5" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">House<span class="no">(27)</span></div></td></tr>
                            <tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue" style="position: relative;"><input class="lightblue" type="radio" name="accommodation" value="6" id="ac6" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">Motels<span class="no">(09)</span></div></td></tr>
                        </tbody></table>
                        
                        <h3 id="loct">Location</h3>
                        <table class="sbox">
                            <tbody><tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue checked" style="position: relative;"><input class="lightblue" type="radio" name="location" value="1" id="lc1" checked="checked" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">Thailand<span class="no">(15)</span></div></td></tr>
                            <tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue" style="position: relative;"><input class="lightblue" type="radio" name="location" value="2" id="lc2" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">Middle East<span class="no">(20)</span></div></td></tr>
                            <tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue" style="position: relative;"><input class="lightblue" type="radio" name="location" value="3" id="lc3" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">Hong Kong<span class="no">(32)</span></div></td></tr>
                            <tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue" style="position: relative;"><input class="lightblue" type="radio" name="location" value="4" id="lc4" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">Chicago<span class="no">(13)</span></div></td></tr>
                            <tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue" style="position: relative;"><input class="lightblue" type="radio" name="location" value="5" id="lc5" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">Las Vegas<span class="no">(05)</span></div></td></tr>
                            <tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue" style="position: relative;"><input class="lightblue" type="radio" name="location" value="6" id="lc6" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">Washington<span class="no">(14)</span></div></td></tr>
                        </tbody></table>
                        <a class="moreopt" id="morelc" href="#loct">+ 5 More Options</a>
                        <div id="locmore" class="locmore">
                        <table class="sbox">
                            <tbody><tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue" style="position: relative;"><input class="lightblue" type="radio" name="location" value="7" id="lc7" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">Wolfsburg<span class="no">(07)</span></div></td></tr>
                            <tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue" style="position: relative;"><input class="lightblue" type="radio" name="location" value="8" id="lc8" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">Dubai<span class="no">(21)</span></div></td></tr>
                            <tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue" style="position: relative;"><input class="lightblue" type="radio" name="location" value="9" id="lc9" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">Barcelona<span class="no">(19)</span></div></td></tr>
                            <tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue" style="position: relative;"><input class="lightblue" type="radio" name="location" value="10" id="lc10" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">London<span class="no">(08)</span></div></td></tr>
                            <tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue" style="position: relative;"><input class="lightblue" type="radio" name="location" value="11" id="lc11" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">San Juan<span class="no">(03)</span></div></td></tr>
                        </tbody></table>
                        </div>
                        <a class="moreopt" id="lesslc" href="#loct">- 5 More Options</a>
                        
                        <h3>Facilities</h3>
                        <table class="sbox">
                            <tbody><tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue checked" style="position: relative;"><input class="lightblue" type="radio" name="facilities" value="1" id="fc1" checked="checked" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">Full Cooking<span class="no">(39)</span></div></td></tr>
                            <tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue" style="position: relative;"><input class="lightblue" type="radio" name="facilities" value="2" id="fc2" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">Some Cooking<span class="no">(20)</span></div></td></tr>
                            <tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue" style="position: relative;"><input class="lightblue" type="radio" name="facilities" value="4" id="fc4" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">Dance Club<span class="no">(13)</span></div></td></tr>
                            <tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue" style="position: relative;"><input class="lightblue" type="radio" name="facilities" value="5" id="fc5" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">Swimming Pool<span class="no">(100)</span></div></td></tr>
                            <tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue" style="position: relative;"><input class="lightblue" type="radio" name="facilities" value="6" id="fc6" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">Playing Areas<span class="no">(28)</span></div></td></tr>
                            <tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue" style="position: relative;"><input class="lightblue" type="radio" name="facilities" value="7" id="fc7" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">Cafes<span class="no">(45)</span></div></td></tr>
                        </tbody></table>
                        
                        <h3>View Hotels on a Map</h3>
                        <table class="sbox">
                            <tbody><tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue checked" style="position: relative;"><input class="lightblue" type="radio" name="onmap" value="1" id="mp1" checked="checked" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">Show Selected Hotel</div></td></tr>
                            <tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue" style="position: relative;"><input class="lightblue" type="radio" name="onmap" value="2" id="mp2" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">Show All Hotels</div></td></tr>
                        </tbody></table>
                        
                        <h3>Additional Search Options</h3>
                        <table class="sbox">
                            <tbody><tr><td><div class="text opt">Flight Type</div></td></tr>
                            <tr><td>
                                <div class="flight"><select id="flight" name="flight" class="s-hidden">
                                    <option value="">No Preference</option>
                                    <option value="1">Belle Air</option>
                                    <option value="2">B&amp;H Airlines</option>
                                    <option value="3">Smart Wings</option>
                                    <option value="4">Avies</option>
                                    <option value="4">Travel Air</option>
                                    <option value="5">Phoenix Air</option>
                                </select><div class="styleflight">No Preference</div><ul class="flightoptions" style="display: none;"><li rel="">No Preference</li><li rel="1">Belle Air</li><li rel="2">B&amp;H Airlines</li><li rel="3">Smart Wings</li><li rel="4">Avies</li><li rel="4">Travel Air</li><li rel="5">Phoenix Air</li></ul></div></td>
                            </tr>
                        </tbody></table>
                        
                        <table class="sbox">
                            <tbody><tr><td><div class="text opt">Preferred Airline</div></td></tr>
                            <tr><td>
                                <div class="airline"><select id="airline" name="airline" class="s-hidden">
                                    <option value="">No Preference</option>
                                    <option value="1">Belle Air</option>
                                    <option value="2">B&amp;H Airlines</option>
                                    <option value="3">Smart Wings</option>
                                    <option value="4">Avies</option>
                                    <option value="4">Travel Air</option>
                                    <option value="5">Phoenix Air</option>
                                </select><div class="styleairline">No Preference</div><ul class="airlineoptions" style="display: none;"><li rel="">No Preference</li><li rel="1">Belle Air</li><li rel="2">B&amp;H Airlines</li><li rel="3">Smart Wings</li><li rel="4">Avies</li><li rel="4">Travel Air</li><li rel="5">Phoenix Air</li></ul></div></td>
                            </tr>
                        </tbody></table>
                        
                        <div class="search"><input type="submit" name="searchnow" class="searchnow" value="Search Now"></div>
                        
                    <div class="clear"></div>
                    </div>
                </div>
            </div>
            
            <div class="right">
                <div class="title">
                    <h2>{{ $entry->name }}</h2>
                </div>
                
                <!-- start of #gallery -->

                <div class="carousel_wrap">
                                        <div id="carousel-wrapper">
                                            <div id="carousel_two" class="cool-carousel">
                                                <span id="image1">
                                                    <img style="width:auto; position: absolute;
                                                        top: 0; bottom:0; left: 0; right:0;
                                                        margin: auto;" src="{{asset('assets/img/uploads/vehicle_rentals/'.$entry->photo)}}" alt=""/>
                                                </span>

                                                <?php 
                                                    $extra_images = MultipleImages::where('category_name', 'Vehicle Rentals')
                                                                        ->where('product_id', $entry->id)
                                                                        ->get();
                                                    $extra_images_count = 2;
                                                ?>   
                                                
                                                @foreach($extra_images as $image)
                                                <span id="image{{$extra_images_count}}">
                                                <img style="width:auto; position: absolute;
                                                    top: 0; bottom:0; left: 0; right:0;
                                                    margin: auto;"src="{{asset('assets/img/uploads/vehicle_rentals/'.$image->name)}}" alt="" /></span>
                                                <?php $extra_images_count++;  ?>
                                                @endforeach
                                            </div>
                                            <a href="#" class="prev"></a><a href="#" class="next"></a>
                                        </div>

                                        <div class="carousal-bottom">
                                            <div id="thumbs-wrapper">
                                                <div id="thumbs">
                                                <?php $extra_images_count = 2; ?>
                                                <a href="#image1" class="selected"><img src="{{asset('assets/img/uploads/vehicle_rentals/'.$entry->thumb)}}"  alt="" /></a>

                                                @foreach($extra_images as $image)
                                                    <a href="#image{{$extra_images_count}}"><img src="{{ asset('assets/img/uploads/vehicle_rentals/'.$image->thumb)}}"  alt="" /></a>
                                                <?php $extra_images_count++;  ?>

                                                
                                                @endforeach

                                                </div>
                                                <a id="prev" href="#"></a>
                                                <a id="next" href="#"></a>
                                            </div>
                                        </div>

                                        <span class="border"></span>
                                    </div>
                <!-- end of #gallery -->
                
                <div class="info1">
                    <div class="subtitle"> {{ $entry->name }} </div>
                    <div class="clear"></div>
                    <div class="address">Area: {{ $entry->area }}</div>
                </div>
                
                <div class="ratings">
                    <div class="uratings"><span class="text">User Rating</span><div class="bullets three"></div><span class="countrates">30 Users</span></div>
                    <div class="sratings"><div class="stars five"></div><span class="countrates">+ 10 Ratings</span> | <a href="#">Write Review</a></div>
                    <div class="clear"></div>
                </div>
                
                <div class="info2">
                    <div class="left">

                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d50000.25310577982!2d{{ isset($city->longitude) ? $city->longitude : ''}}!3d{{ isset($city->latitude) ? $city->latitude : ''}}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1407089338193" width="350" height="300" frameborder="0" style="border:0"></iframe>
                    
                    </div>
                    
                    <?php $account_type = Session::get('account_type'); ?>

                    @if($account_type == 'agent' and !empty($entry->discount_percentage_agents))
                        <div class="right">                           
                            <?php $currency = Session::get('currency'); ?>
                            @if($currency == 'usd')
                            <div class="price">
                                <span class="price dollar">$ </span> 
                                {{$entry->cost - (($entry->discount_percentage_agents/100) * $entry->cost )}}
                            </div>
                            <div class="discount">
                                Normal Price: 
                                <span class="cut">${{ $entry->cost }}</span>
                                <br>
                                {{$entry->discount_percentage_agents}}% Agent discount
                            </div>

                            @elseif ($currency == 'npr')
                            <span class="price dollar">NPR</span>             
                            <?php $npr_cost = ceil($entry->cost * FXRate::where('iso_code', 'USD')->first()->exchange_rate); ?>
                                {{$npr_cost - (($entry->discount_percentage_agents/100) * $npr_cost )}}
                            <div class="discount">
                                Normal Price: 
                                <span class="cut">NPR {{ $npr_cost }}</span>
                                <br>
                                {{$entry->discount_percentage_agents}}% Agent discount
                            </div>
                            @endif  
                        </div>
                        @elseif($account_type == 'distributor' and !empty($entry->discount_percentage_distributors))
                            <div class="right">                           
                                <?php $currency = Session::get('currency'); ?>
                                @if($currency == 'usd')
                                <div class="price">
                                    <span class="price dollar">$ </span> 
                                    {{$entry->cost - (($entry->discount_percentage_distributors/100) * $entry->cost )}}
                                </div>
                                <div class="discount">
                                    Normal Price: 
                                    <span class="cut">${{ $entry->cost }}</span>
                                    <br>
                                    {{$entry->discount_percentage_distributors}}% Agent discount
                                </div>

                                @elseif($currency == 'npr')
                                <span class="price dollar">NPR</span>             
                                <?php $npr_cost = ceil($entry->cost * FXRate::where('iso_code', 'USD')->first()->exchange_rate); ?>
                                    {{$npr_cost - (($entry->discount_percentage_distributors/100) * $npr_cost )}}
                                <div class="discount">
                                    Normal Price: 
                                    <span class="cut">NPR {{ $npr_cost }}</span>
                                    <br>
                                    {{$entry->discount_percentage_distributors}}% Agent discount
                                </div>
                                @endif  
                            </div>
                        @else
                            <div class="right">                           
                                <?php $currency = Session::get('currency'); ?>
                                @if($currency == 'usd')

                                <div class="price">
                                    <table class="table" style="width:290px;">
                                        <thead>
                                            <tr><th>Name</th><th>Amount</th> <th> Quantity</th></tr>
                                        </thead>
                                        <tbody>
                                            <tr><td>Price Per Day</td> <td> $ <span id="price_per_day">{{ $entry->price_per_day }}</span> </td><td><input type="text" name="total_days" style="width:40px;"></td></tr>
                                            <tr><td>Price Per Hour</td> <td> $ <span id="price_per_hour">{{ $entry->price_per_hour }}</span> </td><td><input type="text" name="total_hours" style="width:40px;"></td></tr>
                                            <tr><td>Price Per Km</td> <td> $ <span id="price_per_km">{{ $entry->price_per_km }}</span> </td><td><input type="text" name="total_kms" style="width:40px;"></td></tr>
                                            <tr><td colspan="2">Total</td><td> <span id="order_total"></span> </td></tr>
                                        </tbody>
                                    </table>
                                </div>

                                @elseif ($currency == 'npr')

                                <?php 
                                    $npr_price_per_day = ceil($entry->price_per_day * FXRate::where('iso_code', 'USD')->first()->exchange_rate); 
                                    $npr_price_per_hour = ceil($entry->price_per_hour * FXRate::where('iso_code', 'USD')->first()->exchange_rate); 
                                    $npr_price_per_km = ceil($entry->price_per_km * FXRate::where('iso_code', 'USD')->first()->exchange_rate); 
                                ?>

                                <div class="price" style="padding: 20px 0 0 4px;">
                                    <table class="table" style="width:301px;">
                                        <thead>
                                            <tr><th>Name</th><th>Amount</th> <th> Quantity</th></tr>
                                        </thead>
                                        <tbody>
                                            <tr><td>Price Per Day</td> <td> NPR <span id="price_per_day">{{ $npr_price_per_day }}</span> </td><td><input type="text" name="total_days" style="width:40px;"></td></tr>
                                            <tr><td>Price Per Hour</td> <td> NPR <span id="price_per_hour">{{ $npr_price_per_hour }}</span> </td><td><input type="text" name="total_hours" style="width:40px;"></td></tr>
                                            <tr><td>Price Per Km</td> <td> NPR <span id="price_per_km">{{ $npr_price_per_km }}</span> </td><td><input type="text" name="total_kms" style="width:40px;"></td></tr>
                                            <tr><td colspan="2">Total  <span class="pull-right"> NPR </span></td><td><span id="order_total"></span> </td></tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                @endif  
                            </div>
                    @endif
                    <div class="clear"></div>
                </div>
                
                <div class="bottom">
                    
                    <?php 
                        $todaysDate = strtotime(date("Y-m-d H:i:s")); 
                        $effective_from = strtotime($entry->effective_from);
                        $expire_on = strtotime($entry->expire_on); 
                    ?>

                    @if ($entry->stock <= 0)

                        <div class="right" style="margin-top: 200px;">
                           <div style="padding-top:12px;" name="booknow" class="booknow" > Out of stock. </div>         
                        </div>

                    @elseif($todaysDate >= $expire_on)

                        <div class="right" style="margin-top: 200px;">
                           <div style="padding-top:12px;" name="booknow" class="booknow" > Expired. </div>         
                        </div>

                    @elseif($todaysDate < $effective_from)

                        <div class="right" style="margin-top: 200px;">
                           <div style="padding-top:12px;" name="booknow" class="booknow" > Unavailable. </div>         
                        </div>

                    @else        

                        <div class="right" style="margin-top: 200px;">
                            <a href="{{route('vehicle-order', $entry->id )}}" style="padding-top:12px;" name="booknow" class="booknow" > Book Now </a>
                        </div>

                    @endif

                    <div class="clear"></div>
                </div>

                <br clear="all">

                <div class="desc" style="margin-top: 12px;">

                    <div class="well">

                        <legend>Short Description</legend>

                        {{ $entry->short_description }}
                        
                    </div>

                    <div class="well">

                        <legend>Description</legend>

                        {{ html_entity_decode($entry->description)}}

                    </div>

                    <div class="well">

                        <legend> Vehicle Info </legend>

                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr><td>Vehicle Name</td><td>{{ $entry->name }}</td></tr>
                                <tr><td>Type of Service</td><td>{{ $entry->type_of_service }}</td></tr>
                                <tr><td>Vehicle Type</td><td>{{ $entry->vehicle_type }}</td></tr>
                                <tr><td>Enabled</td><td>{{ $entry->enabled }}</td></tr>                                 
                            </tbody>
                        </table> 
                    </div>

                    <div class="well">

                        <legend> Price Information </legend>

                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr><td>Price Per Day</td><td>{{ $entry->price_per_day }}</td></tr>
                                <tr><td>Price Per Hour</td><td>{{ $entry->price_per_hour }}</td></tr>
                                <tr><td>Price Per Km</td><td>{{ $entry->price_per_km }}</td></tr>                                 
                            </tbody>
                        </table> 
                    </div>

                    <div class="well">

                        <legend> Address Information </legend>

                        <table class="table table-bordered table-striped">
                            <tbody>
                                <?php $country = Country::where('id', $entry->country)->first(); ?>
                                <tr><td>Destination Country</td><td>{{ isset($country) ? $country->value : '' }}</td></tr>
                                <tr><td>State</td><td>{{ $entry->state }}</td></tr>
                                <tr><td>Destination Area/City</td><td>{{ $entry->area_city }}</td></tr>
                            </tbody>
                        </table> 
                    </div>

                    <div class="well">

                        <legend> Feature Information </legend>

                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr><td>Passengers</td><td>{{ $entry->passengers }}</td></tr>
                                <tr><td>Laege Suitcase</td><td>{{ $entry->large_suitcase }}</td></tr>
                                <tr><td>Small Suitcase</td><td>{{ $entry->small_suitcase }}</td></tr>
                                <tr><td>Amenities</td><td>{{ $entry->amenities }}</td></tr>
                            </tbody>
                        </table> 
                    </div>

                    <div class="well">

                        <legend>Information of Availabilities</legend>

                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr><td>Stock</td><td>{{ $entry->stock }}</td></tr>
                                <tr><td>Effective From</td><td>{{ $entry->effective_from }}</td></tr>
                                <tr><td>Expire On</td><td>{{ $entry->expire_on }}</td></tr>
                               
                            </tbody>
                        </table>
                    
                    </div>

                </div>

                <div id="comments">
                    <h2> Comments </h2>

                    @foreach($product_comments as $comment)
                        <?php $user = User::find($comment->user_id);  ?>
                        <div class="comment-block">
                            <p> {{ $user->first_name . ', ' . $user->last_name }} </p>
                            <p> {{ $comment->created_at->diffForHumans() }}</p>
                            <p> {{ html_entity_decode($comment->content) }} </p>
                        </div>
                    @endforeach
                    
                    <h3>Post your comment below:</h3> 
                    <span>(You must be logged in to comment.)</span>

                    <div id="commentarea">
                        <form method="post" action="" style="">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="product_type" value="Vehicle Rentals" >
                            <input type="hidden" name="id" value="{{$entry->id}}" >

                            <textarea name="content" ></textarea>

                            <button type="submit" class="btn btn-success"> Submit</button>

                        </form>
                    </div>
                </div>
                
                
            </div>
            <div class="clear"></div>
    </div>


@stop

@section('customjs')

    <script src="{{ asset('assets/frontend/js/jquery.carouFredSel-6.0.4-packed.js') }}"></script>



    <script type="text/javascript">
        
    jQuery(document).ready(function() { 

        $('#carousel_two').carouFredSel({
            responsive: true,
            circular: false,
            auto: false,
            items: {
                visible: 1,
                width: 200,
                height: '56%'
            },
            prev: '.prev',
            next: '.next',
            scroll: {
                fx: 'fade'
            }
        });

        $('#thumbs').carouFredSel({
            responsive: true,
            circular: false,
            infinite: false,
            auto: false,
            prev: '#prev',
            next: '#next',
            items: {
                visible: {
                    min: 2,
                    max: 6
                }

            }
        });

        $('#thumbs a').click(function() {
            $('#carousel_two').trigger('slideTo', '#' + this.href.split('#').pop() );
            $('#thumbs a').removeClass('selected');
            $(this).addClass('selected');
            return false;
        });

        booknowurl = $('.booknow').attr('href');

        $('input[name="total_days"], input[name="total_hours"], input[name="total_kms"]').each(function() {
           var elem = $(this);

           // Save current value of element
           elem.data('oldVal', elem.val());

           // Look for changes in the value
           elem.bind("propertychange keyup input paste", function(event){
              // If value has changed...
              if (elem.data('oldVal') != elem.val()) {

                // Updated stored value
               elem.data('oldVal', elem.val());

               //Grab the latest values
               total_days = parseInt($('input[name="total_days"]').val() || 0);

               total_hours = parseInt($('input[name="total_hours"]').val() || 0);

               total_kms = parseInt($('input[name="total_kms"]').val() || 0);

               $('.booknow').attr('href', booknowurl + '?total_days=' + total_days + '&total_hours=' + total_hours + '&total_kms=' + total_kms);

               price_per_day = parseInt($('#price_per_day').text() || 0);

               price_per_hour = parseInt($('#price_per_hour').text() || 0);

               price_per_km = parseInt($('#price_per_km').text() || 0);

               total_price_per_day = (price_per_day) * (total_days);
               total_price_per_hour = (price_per_hour) * (total_hours);
               total_price_per_km = (price_per_km) * (total_kms);              

                // Do action
                $('#order_total').text(total_price_per_day + total_price_per_hour + total_price_per_km );
             }
           });

        });


    });


</script>


@stop
