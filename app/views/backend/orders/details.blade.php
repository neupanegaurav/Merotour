@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
View Details ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                View Details
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        View Details
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


        <table class="table table-bordered table-striped">
        	<tbody>
	        	@if(Session::get('account_type') == 'admin')
	        	<tr>
	        		<th> Ordered By</th>
	                <td>
	                    <?php $user = User::where('id', $entry->user_id)->first(); ?>
	                    @if(isset($user))
	                    <a href="{{ route('update/user', $user->id) }}"> {{ $user->first_name .' '. $user->last_name .'('.$user->email.')' }} </a>
	                    @endif
	                </td>
                </tr>
                @endif
        		<tr>
        			<th>Order Category</th>
        			<td>{{ $entry->category_name }}</td>
        		</tr>
        		<tr>
        			<th>Package Name</th>
        			<td>{{ $entry->package_name }}</td>
        		</tr>
        		<tr>
        			<th>Package Id</th>
        			<td>{{ $entry->package_id }}</td>
        		</tr>
        		<tr>
        			<th>Entry date</th>
        		  	<td>{{ $entry->date }}</td>
        		</tr>
        		<tr>
        			<th>Group Size</th>
                    <td>{{ $entry->group_size }}</td>
                </tr>
                <tr>
                	<th>Updated at</th>
                    <td>{{ $entry->updated_at->diffForHumans() }}</td>
                </tr>
                <tr>
                	<th>Created at</th>
                    <td>{{ $entry->created_at->diffForHumans() }}</td>
                </tr>
        	</tbody>
        </table>
        
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('orders') }}">Back</a>
			<button type="submit" class="btn btn-success">Issue Order</button>
		</div>
	</div>

			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>
         


<script src="{{asset('ckeditor')}}/ckeditor.js"></script>

@stop


@section('currentpagejs')

<script type="text/javascript">
	$(document).ready(function() 
	{
		$("#datepickerorder").datepicker(
		{       
          dateFormat: "yy-mm-dd"
        });
	});

</script>


@stop

