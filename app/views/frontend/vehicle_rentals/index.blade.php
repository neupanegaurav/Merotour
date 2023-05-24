@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Vehicle Rentals ::
@parent
@stop

{{-- Page content --}}
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/pages/deals.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/jslider-theme/jslider-slider.css') }}">



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
                        
                        <h3>Discount %</h3>
                        <div id="themesl"><div id="discount-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" aria-disabled="false"><div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min" style="width: 60%;"></div><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 60%;"></a></div></div>
                        <div class="slide-result">
                            <input disabled="" class="amount1" type="text" id="dr" value="60 %">
                            <input disabled="" class="amount2" type="text" value="100 %">
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
                        
                        <h3>View Deals on a Map</h3>
                        <table class="sbox">
                            <tbody><tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue checked" style="position: relative;"><input class="lightblue" type="radio" name="onmap" value="1" id="mp1" checked="checked" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">Show Selected Deal</div></td></tr>
                            <tr><td><div class="radiobtn"><div class="iradio_minimal-lightblue" style="position: relative;"><input class="lightblue" type="radio" name="onmap" value="2" id="mp2" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></div><div class="text">Show All Deals</div></td></tr>
                        </tbody></table>
                        
                        <h3>Additional Search Options</h3>
                        <table class="sbox">
                            <tbody><tr><td><div class="text opt">Deals Type</div></td></tr>
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
                            <tbody><tr><td><div class="text opt">Preferred Deals</div></td></tr>
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
                <div class="top">
                    <div class="banner"><span class="text">Trips Giving You Best Deals Ever, Get upto <span class="color">60% Off</span> on Travel</span></div>
                    <div class="title">
                        <h2>Vehicle Rentals</h2>
                    </div>
                    <div class="sortby">
                        <div class="text">Sort By</div>
                            <div class="sortby"><select id="sortby" name="sortby" class="s-hidden">
                                <option value="1">Price</option>
                                <option value="2">Location</option>
                                <option value="3">Star Ratings</option>
                                <option value="4">User Ratings</option>
                                <option value="5">Time</option>
                                <option value="6">Discount</option>
                                <option value="7">Boughts</option>
                            </select><div class="stylesortby">Price</div><ul class="sortbyoptions" style="display: none;"><li rel="1">Price</li><li rel="2">Location</li><li rel="3">Star Ratings</li><li rel="4">User Ratings</li><li rel="5">Time</li><li rel="6">Discount</li><li rel="7">Boughts</li></ul></div>
                    </div>
                    <div class="clear"></div>
                </div>
                
                <form action="http://theme.vezi-online.net/tripsbooking/bookdetail.html" method="POST">
                
                @foreach ($entries as $entry)

                <div class="box">
                    <div class="left">
                        <div class="image"><a href="{{ route('vehicle-show', $entry->id) }}"><img style="width:136px; height:auto;" src="{{ asset('assets/img/uploads/vehicle_rentals/' . $entry->photo) }}"></a></div>
                        <div class="title"><a href="{{ route('vehicle-show', $entry->id) }}">{{$entry->name}}</a></div>
                        <div class="ratings"><div class="stars three"></div><div class="starsno">5 Star Ratings</div></div>
                        <div class="desc">{{ Str::words(html_entity_decode($entry->short_description), 18);}}<span class="more"><a href="{{ route('vehicle-show', $entry->id) }}">More</a></span></div>
                        <div class="rateinfo">
                                <div class="urated">
                                    <span class="text">User Rating</span>
                                    <div class="bullets three"></div>
                                    <span class="viewby">{{$entry->country}}</span>
                                </div>
                            </div>
                        <div class="clear"></div>
                    </div>
                    <div class="right">
                        
                            <?php $currency = Session::get('currency'); ?>

                            @if($currency == 'usd')
                            <div class="price">
                                <span class="price dollar">$ </span> 
                                {{$entry->cost}}
                            </div>
                            <div class="oldprice">
                                Old Price: 
                                <span class="cut">${{ $entry->cost +5 }}</span>
                            </div>

                            @elseif ($currency == 'npr')
                            <span class="price dollar">NPR</span> 
                            <?php $npr_cost = ceil($entry->cost * FXRate::where('iso_code', 'USD')->first()->exchange_rate) ?>
                           {{ $npr_cost }}
                            <div class="oldprice">
                                Old Price: 
                                <span class="cut">NPR {{ $npr_cost + 500 }}</span>
                            </div>
                            @endif  

                    </div>
                    <div class="clear"></div>
                    <div class="bottom">
                        <div class="left">
                            <ul>
                                <li class="time">Time Left: <span class="color">12 Hours</span></li>
                                <li class="discount">Discount: <span class="color">60%</span></li>
                                <li class="bought">Bought: <span class="color">809</span></li>
                                <li class="viewmap"><a class="md-trigger" data-modal="modal-viewmap1" href="#">View on Map</a></li>
                            </ul>
                        </div>
                        <div class="right">
                            <a href="{{route('vacation-order', $entry->id )}}" name="buydeal" class="buydeal" > Book Now </a>
                        </div>
                    <div class="clear"></div>
                    </div>
                </div>
                @endforeach
                
                </form>

            <div style="margin-top:56px;">
             {{ $entries->links() }}
            </div>
        
            </div>
            <div class="clr"></div>
    </div>


@stop
