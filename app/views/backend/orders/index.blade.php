@section('title')
List of Orders :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                {{$order_category}} Orders
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			       {{$order_category}}

                    <span class="icon-angle-right"></span>
			            </li> 
                        <li>
                        Orders
                        </li>                                      		                            
			</ul>
			<!-- END BREADCRUMBS -->

            <!-- BEGIN BREADCRUMBS -->
            <ul class="breadcrumb">                                   
                <form action="" method="post">
                                                                     
                    <!-- CSRF Token -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 

                    <div class="control-group {{ $errors->has('invoice_no') ? 'error' : '' }}" style=" display:inline-block;">
                        <label class="control-label" for="invoice_no">Invoice No.</label>
                        <div class="controls">
                            <input type="text" name="invoice_no" id="invoice_no" value="{{ Input::old('invoice_no') }}" />
                            {{ $errors->first('invoice_no', '<span class="help-inline">:message</span>') }}
                        </div>
                    </div>
  
                    <div class="search" style=" display:inline-block; margin-top:-10px; vertical-align: middle;">
                        <input type="submit" name="search" value="SEARCH" >
                    </div> 
                </form>                                                                              
            </ul>
            <!-- END BREADCRUMBS -->
        </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN DYNAMIC TABLE EXAMPLE -->
        <div class="social-box">
    <div class="header">
    

    <!-- BEGIN TABLE TOOLS -->
    <div class="tools">

    @if(Sentry::getUser()->hasAnyAccess(array('admin', 'packagetours_create')) )

       <div class="btn-group">
           <a class="btn btn-primary" id="add-row" href="{{ route('create_package_tour') }}"><i class="icon-pencil"></i> Add</a>
             
        </div>
    @endif
    </div>
    <!-- END TABLE TOOLS -->

    </div>
    <!-- BEGIN TABLE BODY -->
    <div class="body">
        
       @if ($entries->isEmpty())
    <span>There are currently no orders.</span>
    @endif
    
    @if (!$entries->isEmpty()) 

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>                       
            <th class="span3">Invoice No.</th>

            @if(Session::get('account_type') == 'admin')           
            <th class="span2">Ordered By</th>
            @endif

            <th class="span2">Name</th>
            <th class="span2">For(Date)</th>
            <th class="span1">Total Amount</th>
            <th class="span2">Updated</th>
            <th class="span2">Created</th>
            <th class="{{ Session::get('account_type') == 'admin' ? 'span6' : 'span2' }}"
            >Status</th>
            <th class="span3">@lang('table.actions')</th>
		</tr>
	</thead>
	<tbody>

    <?php
        $user= Sentry::getUser();
    ?>
            
		@foreach ($entries as $entry)

		<tr>
                        <td>
                            #INV {{ $entry->invoice_no }}
                        </td>

                        @if(Session::get('account_type') == 'admin')
                        <td>
                            <?php $user = User::where('id', $entry->user_id)->first(); ?>
                            @if(isset($user))
                            <a href="{{ route('update/user', $user->id) }}"> {{ $user->first_name .' '. $user->last_name .'('.$user->email.')' }} </a>
                            @endif
                        </td>
                        @endif

                        <td><a href="{{ route('edit_package_tour', $entry->package_id) }}"> {{ $entry->package_name }} </a></td>
                        <td>{{ $entry->date }}</td>
                        <td>${{ $entry->amount }}</td>
                        <td>{{ $entry->updated_at->diffForHumans() }}</td>
                        <td>{{ $entry->created_at->diffForHumans() }}</td>
                        @if(Session::get('account_type') == 'admin')
                        <td>
                            <form method="post" action="{{route('status-change', $entry->id)}}">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />       
                            <select name="status" class="pull-left" style="width:175px;">
                                <option {{ $entry->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option {{ $entry->status == 'Payment Processing' ? 'selected' : '' }}>Payment Processing</option>
                                <option {{ $entry->status == 'Order Completed' ? 'selected' : '' }}>Order Completed</option>
                                <option {{ $entry->status == 'Cancel Requested' ? 'selected' : '' }}>Cancel Requested</option>
                                <option {{ $entry->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            <button class="btn-mini btn-success pull-right" type="submit">Change</button> 
                            </form>
                        </td>
                        @else
                       <td>
                           {{ $entry->status }}
                       </td>
                        @endif
			<td>


            @if($entry->status == 'Cancel Requested')
                <a style="margin-bottom:12px;" href="{{ route('approve_order', $entry->id) }}" class="btn btn-mini btn-success">Approve</a>                                                      
                <div id="unapprove" dataid="{{ $entry->id }}"  class="btn btn-mini btn-danger">Unapprove</div>
              
            @else
                <form action="{{ route('order-pdf')}}" method="post" target="_blank" >
                    <!-- CSRF Token -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    
                    <input type="hidden" name="issue_date" value="{{$entry->created_at}}" >
                    <input type="hidden" name="customer_name" value="{{$user->first_name .' '. $user->last_name}}" >
                    <input type="hidden" name="invoice_no" value="{{$entry->invoice_no}}" >
                    <input type="hidden" name="email" value="{{$user->email}}" >
                    <input type="hidden" name="package_type" value="{{$entry->category_name}}" >
                    <input type="hidden" name="package_name" value="{{$entry->package_name}}" >
                    <input type="hidden" name="group_size" value="{{$entry->group_size}}" >
                    <input type="hidden" name="date" value="{{$entry->date}}" >
                    <input type="hidden" name="base_price" value="{{$entry->amount}}" >

                    <button class="btn-mini" type="submit">Download PDF</button>
                </form>

				<a style="margin-top:4px; margin-bottom:4px;" href="{{ route('edit_order', $entry->id) }}" class="btn btn-mini">Edit</a>   

                @if (Session::get('account_type') == 'user' or Session::get('account_type') == 'agent')
                <a style="margin-top:4px; margin-bottom:4px;" href="{{ route('edit_order', $entry->id) }}" class="btn btn-mini btn-danger">Request Cancellation</a>   
                @endif

                <a style="margin-top:4px; margin-bottom:4px;" href="{{ route('details_order', $entry->id) }}" class="btn btn-mini btn-info">View Details</a>                   
                                                  
				<a style="margin-top:4px; margin-bottom:4px;" href="{{ route('delete_order', $entry->id) }}" class="btn btn-mini btn-danger">@lang('button.delete')</a>
            @endif       

			</td>
		</tr>


		@endforeach
	</tbody>
</table>
    {{ $entries->links() }}
@endif

        


			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>


<div class="social-box" style=" width:auto; position:absolute; top:280px; left:400px; display:none;">
    <div class="header">
        Unapprove Message 

        <div class="pull-right">
            <button id="socialboxclose" type="button" class="close">×</button>
        </div>
    </div>
    <div class="body">
        <form class="form-horizontal" method="post" action="{{ route('unapprove_order') }}" autocomplete="off" enctype="multipart/form-data">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <input type="hidden" name="dataid" value="1" />

                  <!-- Description-->
            <div class="control-group {{ $errors->has('message') ? 'error' : '' }}">
                <label class="control-label">Unapprove Message to Customer</label>
                <div class="controls">
                    <textarea type="text" name="message">{{ Input::old('message') }}</textarea>
                    {{ $errors->first('message', '<span class="help-inline">:message</span>') }}
                </div>
            </div>            

        <!-- Form Actions -->
        <div class="control-group">
            <div class="controls">

                <button type="reset" class="btn">Reset</button>

                <button type="submit" class="btn btn-success">Send </button>
            </div>
        </div>   
            
        </form>                          
    </div>
</div>


@stop

@section('currentpagejs')

<script>
    jQuery(document).ready(function() {

        $('#unapprove').click( function(){

            dataid = $(this).attr('dataid');

            $('input[name="dataid"]').val(dataid);

            $('.social-box').show();

            });

        $('#socialboxclose').click( function() {

            $(this).closest(".social-box").hide();

        });

    });
</script>

@stop
