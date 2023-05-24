@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Vacation Rental Search ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Vacation Rental Search
            </h3>
            <!-- BEGIN BREADCRUMBS -->
            <ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    Vacation Rental Search
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

                <style>
                #maincont {background: #fff; margin-top:20px; padding:5px;}
                table strong {font-size:14px;}
                table thead td {background:none;}
                td div {float:left;}
                td img { float:left; margin-right:10px; width:170px; height:115px;}
                a:hover {text-decoration:none;}
                td p {color: rgb(102, 102, 102);}
                 
                </style>
               
                <!-- BEGIN TABLE DATA -->
                
                <div class="top" style="padding:10px;">                                   
                    <h3>Search Results for "{{$q}}"</h3>
                </div><!-- /Top -->

                <div class="bottom clearfix" style="padding:10px;">

                @if ($entries->isEmpty())
                    <span>Sorry, no results were found. Please try another search.</span>
                @endif
                    
                   
                @if (!$entries->isEmpty()) 

                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            @foreach ($entries as $entry)
                            <tr>
                                <td>
                                    <img src="{{asset('assets/img/uploads/vacation_rentals')}}/{{ $entry->photo }}" >
                                    
                                    <h3><a href="{{ route('hotel-show', $entry->id) }}" >{{ $entry->name }}</a></h3>
                                    <p>
                                        Country: {{ $entry->country}}   | 
                                        Area: {{ $entry->area}}   |
                                        Activities: {{ $entry->activities}}   |
                                        Duration: {{ $entry->duration}}  |
                                        Difficulty: {{ $entry->difficulty}} 
                                        
                                        <br>
                                        {{ html_entity_decode(Str::words($entry->description, 10)) }}
                                    </p> 
                                </td>
                                <td>
                                    <style type="text/css">
                                        .right {
                                        float: left;
                                        height: 181px;
                                        padding: 0 15px 0 0;
                                        width: 150px;
                                        }
                                        .price {
                                        color: #8ab112;
                                        font-size: 36px;
                                        font-weight: 800;
                                        text-align: center;
                                        padding: 45px 0 0 15px;
                                        position: relative;
                                        margin-bottom: 8px;
                                        }
                                        .oldprice {
                                        text-align: center;
                                        color: #ec5223;
                                        font-size: 13px;
                                        font-weight: 300;
                                        padding: 0 0 0 30px;
                                        }
                                        .oldprice .cut {
                                        text-decoration: line-through;
                                        }                                    
                                    </style>

                                    <?php $account_type = Session::get('account_type'); ?>

                                    @if($account_type == 'agent' and !empty($entry->discount_percentage_agents))
                                        <div class="right">                           
                                            <?php $currency = Session::get('currency'); ?>
                                            @if($currency == 'usd')
                                            <div class="price">
                                                <span class="price dollar">$ </span> 
                                                {{$entry->cost - (($entry->discount_percentage_agents/100) * $entry->cost )}}
                                            </div>
                                            <div class="oldprice">
                                                Normal Price: 
                                                <span class="cut">${{ $entry->cost }}</span>
                                                <br>
                                                {{$entry->discount_percentage_agents}}% Agent discount
                                            </div>

                                            @elseif ($currency == 'npr')
                                            <span class="price dollar">NPR</span>             
                                            <?php $npr_cost = ceil($entry->cost * FXRate::where('iso_code', 'USD')->first()->exchange_rate) ?>
                                                {{$npr_cost - (($entry->discount_percentage_agents/100) * $npr_cost )}}
                                            <div class="oldprice">
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
                                                <div class="oldprice">
                                                    Normal Price: 
                                                    <span class="cut">${{ $entry->cost }}</span>
                                                    <br>
                                                    {{$entry->discount_percentage_distributors}}% Agent discount
                                                </div>

                                                @elseif($currency == 'npr')
                                                <span class="price dollar">NPR</span>             
                                                <?php $npr_cost = ceil($entry->cost * FXRate::where('iso_code', 'USD')->first()->exchange_rate) ?>
                                                    {{$npr_cost - (($entry->discount_percentage_distributors/100) * $npr_cost )}}
                                                <div class="oldprice">
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
                                    @endif  
                                </td>                                
                            </tr>
                            @endforeach
                        </thead>
                    </table>

                    {{ $entries->links() }}
                @endif                
                                
                 <!-- END TABLE DATA -->
            </div> <!-- END TABLE BODY -->
        </div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>
         

@stop