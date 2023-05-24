@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
{{$entry->title}} ::
@parent
@stop

{{-- Page content --}}
@section('content')
<style>
    #maincont {background: #fff; margin-top:20px; padding:5px;}
    table strong {font-size:14px;}
    table thead td {background:none;}
    td img {float:left; margin-right:10px; width:170px; height:115px;}
    a:hover {text-decoration:none;}
    td p {color: rgb(102, 102, 102);}
     
</style>




<!-- Grid page -->
                <div class="content booking_wrap">
                    <div>
                        <div>
                            <div>
                                <div class="top" style="padding:10px;">
                                    
                                    <h3>{{$entry->title}}</h3>
                                    
                                </div><!-- /Top -->

                                <div class="bottom clearfix" style="padding:10px;">
    


                           
                            <p>{{html_entity_decode($entry->content)}}</p>



                
                                </div> <!-- /Bottom -->
                            </div>
                        </div>
                    </div>
                </div>

                                
    
       
    
  
                              
                              
                       

@stop
