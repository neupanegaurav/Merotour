@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Hotels ::
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
                                                        margin: auto;" src="{{asset('assets/img/uploads/hotels/'.$entry->photo)}}" alt=""/>
                                                </span>

                                                <?php 
                                                    $extra_images = MultipleImages::where('category_name', 'Package Tours')
                                                                        ->where('product_id', $entry->id)
                                                                        ->get();
                                                    $extra_images_count = 2;
                                                ?>   
                                                
                                                @foreach($extra_images as $image)
                                                <span id="image{{$extra_images_count}}">
                                                <img style="width:auto; position: absolute;
                                                    top: 0; bottom:0; left: 0; right:0;
                                                    margin: auto;"src="{{asset('assets/img/uploads/hotels/'.$image->name)}}" alt="" /></span>
                                                <?php $extra_images_count++;  ?>
                                                @endforeach
                                            </div>
                                            <a href="#" class="prev"></a><a href="#" class="next"></a>
                                        </div>

                                        <div class="carousal-bottom">
                                            <div id="thumbs-wrapper">
                                                <div id="thumbs">
                                                <?php $extra_images_count = 2; ?>
                                                <a href="#image1" class="selected"><img src="{{asset('assets/img/uploads/hotels/'.$entry->thumb)}}"  alt="" /></a>

                                                @foreach($extra_images as $image)
                                                    <a href="#image{{$extra_images_count}}"><img src="{{ asset('assets/img/uploads/hotels/'.$image->thumb)}}"  alt="" /></a>
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
                        <ul>
                            <li class="room">Standard Room: <span class="color">2 Rooms With Bath</span></li>
                            <li class="people">1 - 2 People: 
                            <span class="color">
                            <?php $currency = Session::get('currency'); ?>
                            @if($currency == 'usd')
                            ${{$entry->cost}}

                            @elseif ($currency == 'npr')
                            <?php $npr_cost = ceil($entry->cost * FXRate::where('iso_code', 'USD')->first()->exchange_rate); ?>
                            NPR {{ $npr_cost }}

                            @endif
                            </span>
                            </li>
                            <li class="wishlist"><a href="#">Add to Wishlist</a></li>
                            <li class="viewmap"><a class="md-trigger" data-modal="modal-viewmap" href="#">View on Map</a></li>
                        </ul>
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
                                <table class="table" style="width:256px;">
                                    <thead>
                                        <tr><th>Name</th><th>Per Person</th> <th> Quantity</th></tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>Adult Price</td> <td> $ <span id="adult_price_per_person">{{ $entry->adult_price }}</span> </td><td><input type="text" name="total_adults" style="width:40px;"></td></tr>
                                        <tr><td>Child Price</td> <td> $ <span id="child_price_per_person">{{ $entry->child_price }}</span> </td><td><input type="text" name="total_children" style="width:40px;"></td></tr>
                                        <tr><td>Infant Price</td> <td> $ <span id="infant_price_per_person">{{ $entry->infant_price }}</span> </td><td><input type="text" name="total_infants" style="width:40px;"></td></tr>
                                        <tr><td colspan="2">Total</td><td> <span id="order_total"></span> </td></tr>
                                    </tbody>
                                </table>
                            </div>

                            @elseif ($currency == 'npr')

                            <?php 
                                $npr_adult_price = ceil($entry->adult_price * FXRate::where('iso_code', 'USD')->first()->exchange_rate); 
                                $npr_child_price = ceil($entry->child_price * FXRate::where('iso_code', 'USD')->first()->exchange_rate); 
                                $npr_infant_price = ceil($entry->infant_price * FXRate::where('iso_code', 'USD')->first()->exchange_rate); 
                            ?>

                            <div class="price">
                                <table class="table">
                                    <tbody>
                                        <tr><td>Adult Price</td> <td> NPR.  {{ $entry->adult_price }}</td></tr>
                                        <tr><td>Child Price</td> <td> NPR. {{ $entry->child_price }}</td></tr>
                                        <tr><td>Infant Price</td> <td> NPR. {{ $entry->infant_price }}</td></tr>
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

                        <div class="right">
                           <div style="padding-top:12px;" name="booknow" class="booknow" > Out of stock. </div>         
                        </div>

                    @elseif($todaysDate >= $expire_on)

                        <div class="right">
                           <div style="padding-top:12px;" name="booknow" class="booknow" > Expired. </div>         
                        </div>

                    @elseif($todaysDate < $effective_from)

                        <div class="right">
                           <div style="padding-top:12px;" name="booknow" class="booknow" > Unavailable. </div>         
                        </div>

                    @else        

                        <div class="right">
                        <a href="{{route('hotel-order', $entry->id )}}" style="padding-top:12px;" name="booknow" class="booknow" > Book Now </a>
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

                        <legend> General Information </legend>

                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr><td>Name</td><td>{{ $entry->name }}</td></tr>
                                <tr><td>Title</td><td>{{ $entry->title }}</td></tr>
                                <tr><td>Grade</td><td>{{ $entry->grade }}</td></tr>
                                <tr><td>Status</td><td>{{ $entry->status }}</td></tr>
                                <tr><td>Hotel's Manager</td><td>{{ $entry->added_by }}</td></tr>
                                <tr><td>Hotel's Group</td><td>{{ $entry->hotels_group }}</td></tr>       
                                <tr><td>Business Type</td><td>{{ $entry->business_type }}</td></tr>       
                                <tr><td>Category Tree</td><td>{{ $entry->category_tree }}</td></tr>       
                                <tr><td>Room Type</td><td>{{ $entry->room_type }}</td></tr>       
                            </tbody>
                        </table> 
                    </div>

                    <div class="well">

                        <legend> Showroom Information </legend>

                        <table class="table table-bordered table-striped">
                            <tbody>
                                <?php $country = Country::where('id', $entry->country)->first(); ?>
                                <tr><td>Destination Country</td><td>{{ isset($country) ? $country->value : '' }}</td></tr>
                                <tr><td>Destination State</td><td>{{ $entry->state }}</td></tr>
                                <tr><td>Destination Area/City</td><td>{{ $entry->area_city }}</td></tr>
                                <tr><td>Location of Hotel</td><td>{{ $entry->location_of_hotel }}</td></tr>
                                <tr><td>Hotel Building Name</td><td>{{ $entry->building_name }}</td></tr>
                                <tr><td>Hotel Building Number</td><td>{{ $entry->building_number }}</td></tr>       
                                <tr><td>Hotel Telephone</td><td>{{ $entry->telephone }}</td></tr>       
                                <tr><td>Hotel Fax</td><td>{{ $entry->fax }}</td></tr>       
                                <tr><td>Hotel's Email Address</td><td>{{ $entry->hotels_email_address }}</td></tr>       
                                <tr><td>Post Code</td><td>{{ $entry->post_code }}</td></tr>       
                                <tr><td>Address</td><td>{{ $entry->address }}</td></tr>       
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

                    <div class="well">

                        <legend>Summary Information</legend>

                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr><td>Distance from Airport</td><td>{{ $entry->distance_from_airport }}</td></tr>
                                <tr><td>Distance from City/Market</td><td>{{ $entry->distance_from_city_market }}</td></tr>
                                <tr><td>Pet Allow</td><td>{{ $entry->pet_allow }}</td></tr>
                                <tr><td>Payment Option</td><td>{{ $entry->payment_option }}</td></tr>
                                <tr><td>Internet Information</td><td>{{ $entry->internet_information }}</td></tr>
                                <tr><td>Parking Information</td><td>{{ $entry->parking_information }}</td></tr>
                               
                            </tbody>
                        </table>
                    
                    </div>

                    <div class="well">

                        <legend>Summary Information</legend>

                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr><td>Distance from Airport</td><td>{{ $entry->distance_from_airport }}</td></tr>
                                <tr><td>Distance from City/Market</td><td>{{ $entry->distance_from_city_market }}</td></tr>
                                <tr><td>Pet Allow</td><td>{{ $entry->pet_allow }}</td></tr>
                                <tr><td>Payment Option</td><td>{{ $entry->payment_option }}</td></tr>
                                <tr><td>Internet Information</td><td>{{ $entry->internet_information }}</td></tr>
                                <tr><td>Parking Information</td><td>{{ $entry->parking_information }}</td></tr>
                               
                            </tbody>
                        </table>
                    
                    </div>

                    <div class="well">

                        <legend> Price and Payment Information </legend>

                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr><td>Adult Price</td><td>{{ $entry->adult_price }}</td></tr>
                                <tr><td>Child Price</td><td>{{ $entry->child_price }}</td></tr>
                                <tr><td>Infant Price</td><td>{{ $entry->infant_price }}</td></tr>
                                <tr><td>Price Type</td><td>{{ $entry->price_type }}</td></tr>
                                <tr><td>Payment Description</td><td>{{ html_entity_decode($entry->payment_description) }}</td></tr>
                            </tbody>
                        </table>
                        
                    </div>

                    <div class="well">

                        <legend>Profile Information</legend>

                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr><td colspan="2">Information</td></tr>
                                <tr><td colspan="2">{{ html_entity_decode($entry->information) }}</td></tr>
                                <tr><td colspan="2">General Information</td></tr>
                                <tr><td colspan="2">{{ html_entity_decode($entry->general_information) }}</td></tr>
                                <tr><td colspan="2">Services</td></tr>
                                <tr><td colspan="2">{{ html_entity_decode($entry->services) }}</td></tr>
                                <tr><td colspan="2">Surroundings Information</td></tr>
                                <tr><td colspan="2">{{ html_entity_decode($entry->surroundings_information) }}</td></tr>
                                <tr><td colspan="2">Other Information</td></tr>
                                <tr><td colspan="2">{{ html_entity_decode($entry->other_information) }}</td></tr>
                            </tbody>
                        </table>
                    
                    </div>

                    <div class="well">

                        <legend>Policy Information</legend>

                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr><td colspan="2">Policies</td></tr>
                                <tr><td colspan="2">{{ html_entity_decode($entry->policies) }}</td></tr>
                                <tr><td colspan="2">Terms &amp; Conditions</td></tr>
                                <tr><td colspan="2">{{ html_entity_decode($entry->terms_and_conditions) }}</td></tr>
                                <tr><td colspan="2">Privacy Policy</td></tr>
                                <tr><td colspan="2">{{ html_entity_decode($entry->privacy_policy) }}</td></tr>
                                <tr><td colspan="2">Cancellation Policy</td></tr>
                                <tr><td colspan="2">{{ html_entity_decode($entry->cancellation_policy) }}</td></tr>
                            </tbody>
                        </table>
                    
                    </div>

                    <div class="well">

                        <legend>Hotel Property Options</legend>

                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr><td>ADA Accessible</td><td>{{ $entry->ada_accessible == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Adults Only</td><td>{{ $entry->adults_only == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Airport Shuttle</td><td>{{ $entry->airport_shuttle == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Beach Front</td><td>{{ $entry->beach_front == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Breakfast</td><td>{{ $entry->breakfast == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Business Center</td><td>{{ $entry->business_center == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Business Ready</td><td>{{ $entry->business_ready == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Car Rental Counter</td><td>{{ $entry->car_rental_counter == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Conventions</td><td>{{ $entry->conventions == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Dataport</td><td>{{ $entry->data_port == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Dining</td><td>{{ $entry->dining == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Dry Clean</td><td>{{ $entry->dry_clean == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Eco Certified</td><td>{{ $entry->eco_certified == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Executive Floors</td><td>{{ $entry->executive_floors == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Family Plan</td><td>{{ $entry->family_plan == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Fitness Center</td><td>{{ $entry->fitness_center == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Free Local Calls</td><td>{{ $entry->free_local_calls == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Free Parking</td><td>{{ $entry->free_parking == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Free Shuttle</td><td>{{ $entry->free_shuttle == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Free Wifi In Meeting Rooms</td><td>{{ $entry->free_wifi_in_meeting_rooms == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Free Wifi In Public Spaces</td><td>{{ $entry->free_wifi_in_public_spaces == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Free Wifi In Rooms</td><td>{{ $entry->free_wifi_in_rooms == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Full Service Spa</td><td>{{ $entry->full_service_spa == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Game Facilities</td><td>{{ $entry->game_facilities == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Golf</td><td>{{ $entry->golf == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Govt Safety Fire</td><td>{{ $entry->govt_safety_fire == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>High Speed Internet</td><td>{{ $entry->high_speed_internet == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Hypoallergenic Rooms</td><td>{{ $entry->hypoallergenic_rooms == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Indoor Pool</td><td>{{ $entry->indoor_pool == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Ind Pet Restriction</td><td>{{ $entry->ind_pet_restriction == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>In Room Coffee Tea</td><td>{{ $entry->in_room_coffee_tea == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>In Room Mini Bar</td><td>{{ $entry->in_room_mini_bar == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>In Room Refrigerator</td><td>{{ $entry->in_room_refrigerator == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>In Room Safe</td><td>{{ $entry->in_room_safe == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Interior Doorways</td><td>{{ $entry->interior_doorways == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Jacuzzi</td><td>{{ $entry->jacuzzi == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Kids Facilities</td><td>{{ $entry->kids_facilities == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Kitchen Facilities</td><td>{{ $entry->kitchen_facilities == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Meal Service</td><td>{{ $entry->meal_service == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Meeting Facilties</td><td>{{ $entry->meeting_facilities == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>No Adult TV</td><td>{{ $entry->no_adult_tv == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Non Smoking</td><td>{{ $entry->non_smoking == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Outdoor Pool</td><td>{{ $entry->outdoor_pool == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Parking</td><td>{{ $entry->parking == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Pets</td><td>{{ $entry->pets == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Pool</td><td>{{ $entry->pool == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Public Transportaton Adjacent</td><td>{{ $entry->public_transportation_adjacent == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Recreation</td><td>{{ $entry->recreation == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Restricted Room Access</td><td>{{ $entry->restricted_room_access == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Room Service</td><td>{{ $entry->room_service == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Room Service 24 Hours</td><td>{{ $entry->room_service_24_hours == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Rooms With Balcony</td><td>{{ $entry->rooms_with_balcony == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Ski In Out Property</td><td>{{ $entry->ski_in_out_property == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Smoke Free</td><td>{{ $entry->smoke_free == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Smoking Rooms Avail</td><td>{{ $entry->smoking_rooms_avail == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Tennis</td><td>{{ $entry->tennis == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Water Purification System</td><td>{{ $entry->water_purification_system == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Wheelchair</td><td>{{ $entry->wheelchair == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>All Inclusive</td><td>{{ $entry->all_inclusive == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Apartments</td><td>{{ $entry->apartments == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Bed Breakfast</td><td>{{ $entry->bed_breakfast == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Castle</td><td>{{ $entry->castle == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Economy</td><td>{{ $entry->economy == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Extended Stay</td><td>{{ $entry->extended_stay == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Farm</td><td>{{ $entry->farm == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>First</td><td>{{ $entry->first == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Luxury</td><td>{{ $entry->luxury == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Moderate</td><td>{{ $entry->moderate == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Motel</td><td>{{ $entry->motel == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Resort</td><td>{{ $entry->resort == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr>
                                <tr><td>Suites</td><td>{{ $entry->suites == 1 ? '<strong>Yes</strong>' : 'No'}}</td></tr> 
                            </tbody>
                        </table>
                    </div>

                    <div class="wall">
                        <legend>Hotel Attractions</legend>
                        <?php 
                        $attraction_array = json_decode($entry->attractions); 
                        ?>
                        @foreach($attraction_array as $key => $value)
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr><td class="span1">{{ $key+1 }}</td><td>{{ $value }}</td></tr>
  
                                </tbody>
                            </table>
                        @endforeach
                    </div>
  
                </div> <!-- /.desc -->

                <div id="comments" class="well">
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
                            <input type="hidden" name="product_type" value="Hotels" >
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

        $('input[name="total_adults"], input[name="total_children"], input[name="total_infants"]').each(function() {
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
               total_adults = parseInt($('input[name="total_adults"]').val() || 0);

               total_children = parseInt($('input[name="total_children"]').val() || 0);

               total_infants = parseInt($('input[name="total_infants"]').val() || 0);

               $('.booknow').attr('href', booknowurl + '?adults=' + total_adults + '&children=' + total_children + '&infants=' + total_infants );

               adult_price = parseInt($('#adult_price_per_person').text() || 0);

               child_price = parseInt($('#child_price_per_person').text() || 0);

               infant_price = parseInt($('#infant_price_per_person').text() || 0);

               total_adult_price = (adult_price) * (total_adults);
               total_child_price = (child_price) * (total_children);
               total_infant_price = (infant_price) * (total_infants);              

                // Do action
                $('#order_total').text(total_adult_price + total_child_price + total_infant_price);
             }
           });

        });


    });


</script>


@stop
