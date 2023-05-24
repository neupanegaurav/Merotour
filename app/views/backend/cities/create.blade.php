
{{-- Web site Title --}}
@section('title')
Create a City ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
            	Create a City

            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        <a href="{{ route('cities-management') }}">Cities Management</a>
			         <span class="icon-angle-right"></span>
			    </li>	             
                <li>
		            Create a City			                                    
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

        <div class="well">

            <legend>General Information</legend>

            <!-- Country -->
            <div class="control-group {{ $errors->has('country') ? 'error' : '' }}">
                <label class="control-label" >Destination Country</label>
                <div class="controls">
                    <select name="country">

                    @foreach($countries as $country)
                        <option value="{{ $country->value }}" {{ Input::old('country') == $country->id ? 'selected="selected"' : ''  }}   >{{ $country->value }}</option>
                    @endforeach
                    
                    </select>

                    {{ $errors->first('country', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- City -->
            <div class="control-group {{ $errors->has('city') ? 'error' : '' }}">
                <label class="control-label">City</label>
                <div class="controls">
                    <input type="text" name="city" value="{{ Input::old('city') }}" />
                    {{ $errors->first('city', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Latitude -->
            <div class="control-group {{ $errors->has('latitude') ? 'error' : '' }}">
                <label class="control-label">Latitude</label>
                <div class="controls">
                    <input type="text" name="latitude" value="{{ Input::old('latitude') }}" />
                    {{ $errors->first('latitude', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Longitude -->
            <div class="control-group {{ $errors->has('longitude') ? 'error' : '' }}">
                <label class="control-label">Longitude</label>
                <div class="controls">
                    <input type="text" name="longitude" value="{{ Input::old('longitude') }}" />
                    {{ $errors->first('longitude', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Altitude -->
            <div class="control-group {{ $errors->has('altitude') ? 'error' : '' }}">
                <label class="control-label">Altitude</label>
                <div class="controls">
                    <input type="text" name="altitude" value="{{ Input::old('altitude') }}" />
                    {{ $errors->first('altitude', '<span class="help-inline">:message</span>') }}
                </div>
            </div>          
        </div>	                                                         	

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('cities-management') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Create City</button>
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

