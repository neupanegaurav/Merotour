@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Office Management ::
@parent
@stop

{{-- Page content --}}
@section('content')
 
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Manage Branch Offices
            </h3>

            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    System Setup
                            <span class="icon-angle-right"></span>
                        </li>
                          <li>
                   
                    Branch Office Management
                            <span class="icon-angle-right"></span>
                        </li>

                                    <li>Manage Branch Office
                                                
                                        </li>
                                                       
            </ul>
			<!-- END BREADCRUMBS -->

            <!-- BEGIN BREADCRUMBS -->
            <ul class="breadcrumb">                                   
           
                <form action="" method="post">
                                                                     
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 

                    <div class="control-group {{ $errors->has('branch_name') ? 'error' : '' }}" style=" display:inline-block;">
                        <label class="control-label" for="branch_name">Name</label>
                        <div class="controls">
                            <input type="text" name="branch_name" id="branch_name" value="{{ Input::old('branch_name') }}" />
                            {{ $errors->first('branch_name', '<span class="help-inline">:message</span>') }}
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


        <div class="btn-group">
           
            <a class="btn btn-primary" id="add-row" href="{{ route('create/office') }}"><i class="icon-pencil"></i> Add</a>
            
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
			<th class="span2">Name</th>
			<th class="span2">Location</th>
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
				<td>{{ $entry->name }}</td>
				<td>{{ $entry->location }}</td>
				<td>{{ $entry->updated_at->diffForHumans() }}</td>
				<td>{{ $entry->created_at->diffForHumans() }}</td>
				<td>
					<a href="{{ route('edit/office', $entry->id) }}" class="btn btn-mini">@lang('button.edit')</a>

					@if ( ! is_null($entry->deleted_at))
					<a href="{{ route('restore/office', $entry->id) }}" class="btn btn-mini btn-warning">@lang('button.restore')</a>
					@else
					@if (Sentry::getId() !== $entry->id)
					<a href="{{ route('delete/office', $entry->id) }}" class="btn btn-mini btn-danger">@lang('button.delete')</a>
					@else
					<span class="btn btn-mini btn-danger disabled">@lang('button.delete')</span>
					@endif
					@endif
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
