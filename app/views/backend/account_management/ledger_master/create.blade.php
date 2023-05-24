@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Add new Ledger ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Add new Ledger
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Account Management
			                <span class="icon-angle-right"></span>
			            </li>
			            <li>Ledger Master
			                      <span class="icon-angle-right"></span>
			                          
			                            </li>
			            

			                        <li>Add new Ledger
			                                    
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
        

<form class="form-horizontal" method="post" action="" autocomplete="off" enctype="multipart/form-data">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
        
        <div class="pull-left" >
		
			<!-- Product -->
			<div class="control-group {{ $errors->has('product') ? 'error' : '' }}">
				<label class="control-label" for="product">Product</label>
				<div class="controls">
					<input type="text" name="product" id="product" value="{{ Input::old('product') }}" />
					{{ $errors->first('product', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
            <div class="control-group {{ $errors->has('account_group') ? 'error' : '' }}">
				<label class="control-label" for="account_group">Account Group</label>
				<div class="controls">
					<input type="text" name="account_group" id="account_group" value="{{ Input::old('account_group') }}" />
					{{ $errors->first('account_group', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
		
                        
                         <div class="control-group" {{ $errors->has('account_sub_group') ? 'error' : '' }}">
				<label class="control-label" for="account_sub_group">Account Sub Group</label>
				<div class="controls">
					<input type="text" name="account_sub_group" id="account_sub_group" value="{{ Input::old('account_sub_group')}}" />
					{{ $errors->first('account_sub_group', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
                        
            <div class="control-group" {{ $errors->has('account_type') ? 'error' : '' }}">
				<label class="control-label" for="account_type">Account Type</label>
				<div class="controls">
					<input type="text" name="account_type" id="account_type" value="{{ Input::old('account_type') }}" />
					{{ $errors->first('account_type', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group" {{ $errors->has('ledger') ? 'error' : '' }}">
				<label class="control-label" for="ledger">Ledger</label>
				<div class="controls">
					<input type="text" name="ledger" id="ledger" value="{{ Input::old('ledger') }}" />
					{{ $errors->first('ledger', '<span class="help-inline">:message</span>') }}
				</div>
			</div>                                              	

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('ledger-master') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Create Ledger</button>
		</div>
	</div>
        
        
        </div>

        
        
</form>

			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>
         

@stop
