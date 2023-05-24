@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
FXRate Management ::
@parent
@stop

{{-- Page content --}}
@section('content')
 
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                FX Rate Setting
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    System Setup
                            <span class="icon-angle-right"></span>
                        </li>
                          <li>
                   
                    FX Rate Setting
                            
                        </li>

                                                       
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


        <div class="btn-group">
           
            <a class="btn btn-primary" id="add-row" href="{{ route('create/fxrate') }}"><i class="icon-pencil"></i> Add</a>
            
        </div>
    </div>
    <!-- END TABLE TOOLS -->

    </div>
    <!-- BEGIN TABLE BODY -->
    <div class="body">
       
        <!-- BEGIN TABLE DATA -->
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="editable">
            <!-- BEGIN -->
            <thead>
                <tr>
            <th class="span1">Id</th>
			<th class="span2">Currency</th>
			<th class="span2">ISO Code</th>
            <th class="span2">Symbol</th>
            <th class="span2">Exchange Rate</th>
			<th class="span2">Updated At</th>
			<th class="span2">Created At</th>
			<th class="span2">Actions</th>
                </tr>
            </thead>
            <!-- END -->
            <!-- BEGIN -->
            <tbody>
                           
                           

	@foreach ($entries as $entry)
			<tr>
				<td>{{ $entry->id }}</td>
				<td>{{ $entry->currency }}</td>
				<td>{{ $entry->iso_code }}</td>
                <td>{{ $entry->symbol }}</td>
                <td>{{ $entry->exchange_rate }}</td>
				<td>{{ $entry->updated_at->diffForHumans() }}</td>
				<td>{{ $entry->created_at->diffForHumans() }}</td>
				<td>
					<a href="{{ route('edit/fxrate', $entry->id) }}" class="btn btn-mini">@lang('button.edit')</a>
					
					<a href="{{ route('delete/fxrate', $entry->id) }}" class="btn btn-mini btn-danger">@lang('button.delete')</a>					
					
				</td>
			</tr>
			@endforeach


                        </tbody>
            <!-- END -->
        </table>

        {{ $entries->links() }}


			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>
         

@stop
