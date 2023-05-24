@extends('backend/layouts/default')
@section('title')
Retrive PNR :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Retrive PNR
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    Airlines
                          
                </li>
                         
               
                                                       
            </ul>
			<!-- END BREADCRUMBS -->

        </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN DYNAMIC TABLE EXAMPLE -->
        <div class="social-box" style="display:inline-block; width:1126px;">           

    <div class="header">
    

    <!-- BEGIN TABLE TOOLS -->
    <div class="tools">

    
       
    </div>
    <!-- END TABLE TOOLS -->

    </div>
    <!-- BEGIN TABLE BODY -->
    <div class="body"> 

                       
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th class="span1">Id</th>
                <th class="span2">Agent Name</th>
                <th class="span2">Contact Name</th>
                <th class="span2">Sector</th>
                <th class="span2">Booked On</th>
                <th class="span2">@lang('table.actions')</th>
            </tr>
        </thead>
        <tbody>
            @if($entries->count() >= 1)
            @foreach($entries as $entry)
            <tr>
                <td>{{ $entry->id }}</td>
                <td>
                @if(Sentry::getUserProvider()->findById($entry->user_id)->inGroup(Sentry::getGroupProvider()->findById(3)))
                {{ Sentry::getUserProvider()->findById($entry->user_id)->first_name .", ". Sentry::getUserProvider()->findById($entry->user_id)->last_name }}
               <?php $type = 'B2B'; ?>
                @else

                Blackeye Travels Pvt. Ltd

                <?php $type = 'B2C'; ?>

                @endif

                </td>
                <td>{{ $entry->contact_name }}</td>
                <td>{{ $entry->departure .'-'. $entry->arrival }}</td>
                <td>{{ $entry->created_at }}</td>
                <td>
                <form method="post" action="{{route('post/retrive-pnr', $entry->id)}}">
                    <!-- CSRF Token -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    
                    <input type="hidden" name="pnr_no" value="{{$entry->pnr_no}}">

                    <?php
                    $passenger = DomesticPassengerDetails::where('pnr_no', $entry->pnr_no)->first();
                    ?>

                    <input type="hidden" name="ticket_no" value="<?php if(isset($passenger->ticket_no)) {echo $passenger->ticket_no;}?>" >

                    <button type="submit" class="btn btn-mini">Retrive PNR</button>
                
                </form>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="5">No results</td>
            </tr>
            @endif
        </tbody>
    </table>     

                                                      

			        <!-- END TABLE DATA -->
	</div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>


@stop
