@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Tour Package Update ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Tour Package Update
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Package Tours
			                <span class="icon-angle-right"></span>
			            </li>
			             

			                        <li>Tour Package Update
			                                    
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
        
    <div class="pull-left">

        <div class="well">

            <legend>General Information</legend>

            <!-- Name -->
            <div class="control-group {{ $errors->has('name') ? 'error' : '' }}">
                <label class="control-label" for="name">Name</label>
                <div class="controls">
                    <input type="text" name="name" id="name" value="{{ Input::old('name', $entry->name) }}" />
                    {{ $errors->first('name', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Tours Title -->
            <div class="control-group {{ $errors->has('title') ? 'error' : '' }}">
                <label class="control-label">Tours Title</label>
                <div class="controls">
                    <input type="text" name="title" id="title" value="{{ Input::old('title', $entry->title) }}" />
                    {{ $errors->first('title', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Organized By -->
            <div class="control-group {{ $errors->has('organized_by') ? 'error' : '' }}">
                <label class="control-label">Organized By</label>
                <div class="controls">
                    <input type="text" name="organized_by" id="organized_by" value="{{ Input::old('organized_by', $entry->organized_by) }}" />
                    {{ $errors->first('organized_by', '<span class="help-inline">:message</span>') }}
                </div>
            </div>           

            <!-- Select Group -->
            <div class="control-group {{ $errors->has('package_group') ? 'error' : '' }}">
                <label class="control-label">Select Group</label>
                <div class="controls">
                    <select type="text" name="package_group" value="{{ Input::old('package_group', $entry->package_group) }}">
                        <option>Domestic Tours</option>
                        <option>International Tours</option>
                    </select>
                    {{ $errors->first('package_group', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Type -->
            <div class="control-group {{ $errors->has('type') ? 'error' : '' }}">
                <label class="control-label">Type</label>
                <div class="controls">
                    <select type="text" name="type" id="type" value="{{ Input::old('type', $entry->type) }}">
                    </select>
                    {{ $errors->first('type', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
            

            <!-- Select category -->
            <div class="control-group {{ $errors->has('category') ? 'error' : '' }}">
                <label class="control-label">Select Category From Category Tree :</label>
                <div class="controls">
                    <select type="text" name="category" value="{{ Input::old('category', $entry->category) }}">
                    </select>
                    {{ $errors->first('category', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Short Description -->
            <div class="control-group {{ $errors->has('short_description') ? 'error' : '' }}">
                <label class="control-label">Short Description</label>
                <div class="controls">
                    <input type="text" name="short_description" value="{{ Input::old('short_description', $entry->short_description) }}" />
                    {{ $errors->first('short_description', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
                    
            <!-- Description -->
            <div class="control-group {{ $errors->has('description') ? 'error' : '' }}">
                <label class="control-label" for="description">Description</label>
                <div class="controls">

                    <textarea class="span7 ckeditor" name="description" rows="10">{{ Input::old('description', $entry->description) }}</textarea>
                    
                    {{ $errors->first('description', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
            
        </div>
		

        <div class="well">

            <legend>Picture Upload</legend>

                <div class="control-group {{ $errors->has('uploaded_file') ? 'error' : '' }}">
                    <label class="control-label" for="description">Default Image</label>
                    <div class="controls">
                        <div style="margin:5px;"> 
                            <img style="width:160px; height:160px;" src="{{ asset('assets/img/uploads/package_tours') }}/{{ Input::old('uploaded_file', $entry->photo) }}">
                        </div>
                        <input type="file" name="uploaded_file">
                        {{ $errors->first('uploaded_file', '<span class="help-inline">:message</span>') }}
                    </div>
                </div>

                <div id="append" class="control-group">
                    
                    <div class="controls">
                    <div id="add_new" class="btn btn-success">Add More Images</div>
                    </div>

                    <?php 
                        $multiple_images_array = [];
                    ?>

                    @foreach($multiple_images as $multiple_image)

                    <div class="control-group" id="{{ $multiple_image->image_guid }}">
                        <label class="control-label">Extra Image</label>
                        <div class="controls">

                            <div style="margin:5px;"> <img src="{{ asset('assets/img/uploads/package_tours') }}/{{ Input::old('uploaded_file', $multiple_image->thumb) }}"></div>

                        <input type="file" name="uploaded_file_{{ $multiple_image->image_guid }}">
                        </div>
                        <button type="button" style="margin-top:-26px;margin-right:-8px;" class="close" data-dismiss="alert">×</button>
                    </div>

                    <?php array_push($multiple_images_array, $multiple_image->image_guid ); ?>
                    @endforeach

                </div>

                <input type="hidden" id="multiple_images_json" name="multiple_images_json" value='{{ json_encode($multiple_images_array) }}'>
                <input type="hidden" id="multiple_images_delete_json" name="multiple_images_delete_json" value=''>
            
        </div>

        <div class="well">
            <legend>Price and Payment Information</legend>           

            <!-- Adult Price -->
            <div class="control-group {{ $errors->has('adult_price') ? 'error' : '' }}">
                <label class="control-label" for="country">Adult Price</label>
                <div class="controls">
                    <input type="text" name="adult_price" id="adult_price" value="{{ Input::old('adult_price', $entry->adult_price) }}" />
                    {{ $errors->first('adult_price', '<span class="help-inline">:message</span>') }}
                </div>
            </div> 

            <!-- Child Price -->
            <div class="control-group {{ $errors->has('child_price') ? 'error' : '' }}">
                <label class="control-label" for="country">Child Price</label>
                <div class="controls">
                    <input type="text" name="child_price" id="child_price" value="{{ Input::old('child_price', $entry->child_price) }}" />
                    {{ $errors->first('child_price', '<span class="help-inline">:message</span>') }}
                </div>
            </div> 

            <!-- Infant Price -->
            <div class="control-group {{ $errors->has('infant_price') ? 'error' : '' }}">
                <label class="control-label" for="country">Infant Price</label>
                <div class="controls">
                    <input type="text" name="infant_price" id="infant_price" value="{{ Input::old('infant_price', $entry->infant_price) }}" />
                    {{ $errors->first('infant_price', '<span class="help-inline">:message</span>') }}
                </div>
            </div> 

            <!-- Price Type -->
            <div class="control-group {{ $errors->has('price_type') ? 'error' : '' }}">
                <label class="control-label" for="country">Price Type</label>
                <div class="controls">
                    <select type="text" name="price_type">
                    <option value="per_package" {{ Input::old('price_type', $entry->price_type) == 'per_package' ? 'selected="selected"' : ''  }} >Per package</option>
                    <option value="per_person" {{ Input::old('price_type', $entry->price_type) == 'per_person' ? 'selected="selected"' : ''  }}> Per person</option>
                    </select>
                    {{ $errors->first('price_type', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Payment Description -->
            <div class="control-group {{ $errors->has('payment_description') ? 'error' : '' }}">
                <label class="control-label" for="country">Payment Description</label>
                <div class="controls">
                    <textarea name="payment_description"> {{ Input::old('payment_description', $entry->payment_description) }}</textarea> 
                    {{ $errors->first('payment_description', '<span class="help-inline">:message</span>') }}
                </div>
            </div>        
            
        </div>


        <div class="well">
            <legend>Primary Information</legend>

            <!-- Country -->
            <div class="control-group {{ $errors->has('country') ? 'error' : '' }}">
                <label class="control-label" for="country">Destination Country</label>
                <div class="controls">
                    <select name="country">

                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ Input::old('country', $entry->country) == $country->id ? 'selected="selected"' : ''  }} >{{ $country->value }}</option>
                    @endforeach
                    </select>

                    {{ $errors->first('country', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- State -->
            <div class="control-group {{ $errors->has('state') ? 'error' : '' }}">
                <label class="control-label">Destination State</label>
                <div class="controls">
                    <select name="state">
                    @foreach($cities as $city)
                        <option {{ Input::old('state', $entry->state) == $city->city ? 'selected="selected"' : ''  }} >{{ $city->city }}</option>
                    @endforeach
                    </select>

                    {{ $errors->first('state', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Area/City -->
            <div class="control-group {{ $errors->has('area_city') ? 'error' : '' }}">
                <label class="control-label">Destination Area/City</label>
                <div class="controls">
                    <select name="area_city">
                    @foreach($cities as $city)
                        <option {{ Input::old('state', $entry->area_city) == $city->city ? 'selected="selected"' : ''  }} >{{ $city->city }}</option>
                    @endforeach
                    </select>

                    {{ $errors->first('area_city', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group {{ $errors->has('postal_code') ? 'error' : '' }}">
                <label class="control-label">Destination Postal Code</label>
                <div class="controls">
                    <input type="text" name="postal_code" value="{{ Input::old('postal_code', $entry->postal_code )}}" />
                    {{ $errors->first('postal_code', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group {{ $errors->has('duration') ? 'error' : '' }}">
                <label class="control-label" for="country">Duration of Tour</label>
                <div class="controls">
                    <input type="text" name="duration" id="duration" value="{{ Input::old('duration', $entry->duration) }}" />
                    {{ $errors->first('duration', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group {{ $errors->has('number_of_rating') ? 'error' : '' }}">
                <label class="control-label"> Number of Rating (1-5 in number)</label>
                <div class="controls">
                    <input type="text" name="number_of_rating" value="{{ Input::old('number_of_rating', $entry->number_of_rating) }}" />
                    {{ $errors->first('number_of_rating', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group {{ $errors->has('tour_code') ? 'error' : '' }}">
                <label class="control-label"> Tour Code</label>
                <div class="controls">
                    <input type="text" name="tour_code" value="{{ Input::old('tour_code', $entry->tour_code) }}" />
                    {{ $errors->first('tour_code', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group {{ $errors->has('nights') ? 'error' : '' }}">
                <label class="control-label"> No. of Nights</label>
                <div class="controls">
                    <input type="text" name="nights" value="{{ Input::old('nights', $entry->nights) }}" />
                    {{ $errors->first('nights', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group {{ $errors->has('days') ? 'error' : '' }}">
                <label class="control-label"> No. of Days</label>
                <div class="controls">
                    <input type="text" name="days" value="{{ Input::old('days', $entry->days) }}" />
                    {{ $errors->first('days', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group {{ $errors->has('transportation') ? 'error' : '' }}">
                <label class="control-label" for="country">Transportation</label>
                <div class="controls">
                    <textarea name="transportation"> {{ Input::old('transportation', $entry->transportation) }}</textarea> 
                    {{ $errors->first('transportation', '<span class="help-inline">:message</span>') }}
                </div>
            </div> 

        </div>

        <div class="well">
            <legend>Feature Information</legend>
            

            <div class="control-group {{ $errors->has('start_city') ? 'error' : '' }}">
                <label class="control-label">Start City</label>
                <div class="controls">
                    <input type="text" name="start_city" value="{{ Input::old('start_city', $entry->start_city) }}" />
                    {{ $errors->first('start_city', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group {{ $errors->has('end_city') ? 'error' : '' }}">
                <label class="control-label">End City</label>
                <div class="controls">
                    <input type="text" name="end_city" value="{{ Input::old('end_city', $entry->end_city) }}" />
                    {{ $errors->first('end_city', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group {{ $errors->has('visiting_cities') ? 'error' : '' }}">
                <label class="control-label">Visiting Cities</label>
                <div class="controls">
                    <input type="text" name="visiting_cities" value="{{ Input::old('visiting_cities', $entry->visiting_cities) }}" />
                    {{ $errors->first('visiting_cities', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group {{ $errors->has('schedules_operating') ? 'error' : '' }}">
                <label class="control-label">Schedules / Operating</label>
                <div class="controls">
                    <input type="text" name="schedules_operating" value="{{ Input::old('schedules_operating', $entry->schedules_operating) }}" />
                    {{ $errors->first('schedules_operating', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group {{ $errors->has('sightseeing') ? 'error' : '' }}">
                <label class="control-label">Sightseeing</label>
                <div class="controls">
                    <input type="text" name="sightseeing" value="{{ Input::old('sightseeing', $entry->sightseeing) }}" />
                    {{ $errors->first('sightseeing', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group {{ $errors->has('no_of_accommodates') ? 'error' : '' }}">
                <label class="control-label">Number of Accommodates</label>
                <div class="controls">
                    <input type="text" name="no_of_accommodates" value="{{ Input::old('no_of_accommodates', $entry->no_of_accommodates) }}" />
                    {{ $errors->first('no_of_accommodates', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group {{ $errors->has('multilingual_guide_tape') ? 'error' : '' }}">
                <label class="control-label">Multilingual guide tape</label>
                <div class="controls">
                    <input type="text" name="multilingual_guide_tape" value="{{ Input::old('multilingual_guide_tape', $entry->multilingual_guide_tape) }}" />
                    {{ $errors->first('multilingual_guide_tape', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group {{ $errors->has('pick_up_service') ? 'error' : '' }}">
                <label class="control-label">Pick-up service</label>
                <div class="controls">
                    <input type="text" name="pick_up_service" value="{{ Input::old('pick_up_service', $entry->pick_up_service) }}" />
                    {{ $errors->first('pick_up_service', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group {{ $errors->has('supplementary_room_addon_facilities') ? 'error' : '' }}">
                <label class="control-label">Supplementary Room addon facilities</label>
                <div class="controls">
                    <input type="text" name="supplementary_room_addon_facilities" value="{{ Input::old('supplementary_room_addon_facilities', $entry->supplementary_room_addon_facilities) }}" />
                    {{ $errors->first('supplementary_room_addon_facilities', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group {{ $errors->has('drop_off_service') ? 'error' : '' }}">
                <label class="control-label">Drop-off service</label>
                <div class="controls">
                    <input type="text" name="drop_off_service" value="{{ Input::old('drop_off_service', $entry->drop_off_service) }}" />
                    {{ $errors->first('drop_off_service', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group {{ $errors->has('entertainments') ? 'error' : '' }}">
                <label class="control-label">Entertainments</label>
                <div class="controls">
                    <input type="text" name="entertainments" value="{{ Input::old('entertainments', $entry->entertainments) }}" />
                    {{ $errors->first('entertainments', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group {{ $errors->has('view_location_type') ? 'error' : '' }}">
                <label class="control-label">View | Location Type</label>
                <div class="controls">
                    <input type="text" name="view_location_type" value="{{ Input::old('view_location_type', $entry->view_location_type) }}" />
                    {{ $errors->first('view_location_type', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

        </div>

        <div class="well">
            <legend>Itinerary Information</legend>

            <div class="control-group {{ $errors->has('itinerary_title') ? 'error' : '' }}">
                <label class="control-label">Itinerary Title</label>
                <div class="controls">
                    <input type="text" name="itinerary_title" value="{{ Input::old('itinerary_title', $entry->itinerary_title) }}" />
                    {{ $errors->first('itinerary_title', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group {{ $errors->has('detailed_itinerary') ? 'error' : '' }}">
                <label class="control-label" for="country">Detailed Itinerary</label>
                <div class="controls">
                    <textarea class="ckeditor" name="detailed_itinerary"> {{ Input::old('detailed_itinerary', $entry->detailed_itinerary) }}</textarea> 
                    {{ $errors->first('detailed_itinerary', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
            
        </div>

        <div class="well">
            <legend>Information of Availabilities</legend>

            <div class="control-group {{ $errors->has('stock') ? 'error' : '' }}">
                <label class="control-label" for="country">Stock</label>
                <div class="controls">
                    <input name="stock" style="width:160px" type="text" value="{{ Input::old('stock', $entry->stock) }}"> 
                    {{ $errors->first('stock', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group {{ $errors->has('effective_from') ? 'error' : '' }}">
                <label class="control-label" for="country">Effective From </label>
                <div class="controls">
                    <input name="effective_from" type="text" value="{{ Input::old('effective_from', $entry->effective_from) }}" id="datepicker1" class="ui-datepicker">                 
                    {{ $errors->first('effective_from', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group {{ $errors->has('expire_on') ? 'error' : '' }}">
                <label class="control-label" for="country">Expire On</label>
                <div class="controls">
                    <input name="expire_on" id="datepicker2" style="width:160px" type="text" value="{{ Input::old('expire_on', $entry->expire_on) }}"> 
                    {{ $errors->first('expire_on', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
            
        </div>

        <div class="well">
            <legend>Other Informations</legend>

            <!-- Google Map -->
            <div class="control-group {{ $errors->has('google_map') ? 'error' : '' }}">
                <label class="control-label">Google Map</label>
                <div class="controls">

                    <textarea class="span7 ckeditor" name="google_map" rows="10">{{ Input::old('google_map', $entry->google_map) }}</textarea>
                    
                    {{ $errors->first('google_map', '<span class="help-inline">:message</span>') }}
                </div>
            </div> 

            <!-- Tour Highlights -->
            <div class="control-group {{ $errors->has('tour_highlights') ? 'error' : '' }}">
                <label class="control-label">Tour Highlights</label>
                <div class="controls">

                    <textarea class="span7 ckeditor" name="tour_highlights" rows="10">{{ Input::old('tour_highlights', $entry->tour_highlights) }}</textarea>
                    
                    {{ $errors->first('tour_highlights', '<span class="help-inline">:message</span>') }}
                </div>
            </div> 

            <!-- Tour Policies -->
            <div class="control-group {{ $errors->has('tour_policies') ? 'error' : '' }}">
                <label class="control-label">Tour Policies</label>
                <div class="controls">

                    <textarea class="span7 ckeditor" name="tour_policies" rows="10">{{ Input::old('tour_policies', $entry->tour_policies) }}</textarea>
                    
                    {{ $errors->first('tour_policies', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Terms and Conditions-->
            <div class="control-group {{ $errors->has('terms_and_conditions') ? 'error' : '' }}">
                <label class="control-label">Terms and Conditions</label>
                <div class="controls">

                    <textarea class="span7 ckeditor" name="terms_and_conditions" rows="10">{{ Input::old('terms_and_conditions', $entry->terms_and_conditions) }}</textarea>
                    
                    {{ $errors->first('terms_and_conditions', '<span class="help-inline">:message</span>') }}
                </div>
            </div>  

        </div>

        <div class="well">

            <legend>Discounts</legend>

            <!-- Discount Percentage (for Agents) -->
            <div class="control-group">
                <label class="control-label">Discount Percentage (for Agents)</label>
                <div class="controls">
                    <input type="text" name="discount_percentage_agents"  value="{{ Input::old('discount_percentage_agents', $entry->discount_percentage_agents)}}" />
                    {{ $errors->first('discount_percentage_agents', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Discount Percentage (for Distributors) -->
            <div class="control-group">
                <label class="control-label">Discount Percentage (for Distributors)</label>
                <div class="controls">
                    <input type="text" name="discount_percentage_distributors"  value="{{ Input::old('discount_percentage_distributors', $entry->discount_percentage_distributors)}}" />
                    {{ $errors->first('discount_percentage_distributors', '<span class="help-inline">:message</span>') }}
                </div>
            </div> 
        </div>			                                    
                            	

    	<!-- Form Actions -->
    	<div class="control-group">
    		<div class="controls">
    			<a class="btn btn-link" href="{{ route('package_tours') }}">Back</a>

    			<button type="reset" class="btn">Reset</button>

    			<button type="submit" class="btn btn-success">Edit Package</button>
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

@section('currentpagejs')

<style>
/* css for timepicker */
.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
.ui-timepicker-div dl { text-align: left; }
.ui-timepicker-div dl dt { float: left; clear:left; padding: 0 0 0 5px; }
.ui-timepicker-div dl dd { margin: 0 10px 10px 45%; }
.ui-timepicker-div td { font-size: 90%; }
.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }

.ui-timepicker-rtl{ direction: rtl; }
.ui-timepicker-rtl dl { text-align: right; padding: 0 5px 0 0; }
.ui-timepicker-rtl dl dt{ float: right; clear: right; }
.ui-timepicker-rtl dl dd { margin: 0 45% 10px 10px; }
</style>

<script src="{{asset('assets/backend/js/jquery-ui-timepicker-addon.js')}}"></script>

<script>
    function S4() {
        return (((1+Math.random())*0x10000)|0).toString(16).substring(1); 

    }

    function guid() {
        guid_generate = (S4() + S4() + "-" + S4() + "-4" + S4().substr(0,3) + "-" + S4() + "-" + S4() + S4() + S4()).toLowerCase();
        return guid_generate;
    } 

    jQuery(document).ready(function() {

        multiple_images_json = $('#multiple_images_json').val();

        multiple_images_array = JSON.parse(multiple_images_json);

        multiple_images_delete_array = [];

        $('#add_new').click(function(){  

            generated_guid = guid();

            $('#append').append('\
                <div class="control-group" id="'+generated_guid+'">\
                <label class="control-label">Extra Image</label>\
                <div class="controls">\
                    <input type="file" name="uploaded_file_'+generated_guid+'">\
                </div>\
                <button type="button" style="margin-top:-26px;margin-right:-8px;" class="close" data-dismiss="alert">×</button>\
            </div>\
                '); 

            multiple_images_array.push(generated_guid); 

            $newjson = JSON.stringify(multiple_images_array);

            $('#multiple_images_json').val($newjson);
        });

        $('#append').on('click', 'button', function() {

         delete_guid = $(this).parent().attr('id');

         index = multiple_images_array.indexOf(delete_guid);

            if (index > -1) {
                multiple_images_array.splice(index, 1);
            }

        newjson = JSON.stringify(multiple_images_array);

        $('#multiple_images_json').val(newjson);


        multiple_images_delete_array.push(delete_guid);

        deletejson = JSON.stringify(multiple_images_delete_array);

        $('#multiple_images_delete_json').val(deletejson);
           
        });   

        $( "#datepicker1" ).datetimepicker({       
          dateFormat: "yy-mm-dd",
          timeFormat: "HH:mm:ss"
        });

        $( "#datepicker2" ).datetimepicker({       
          dateFormat: "yy-mm-dd",
          timeFormat: "HH:mm:ss"
        });

        // Get State/Cities

        $('select[name="country"]').change(function() {

            country = $('option:selected', this).text();

            url = "<?php echo route('home'); ?>";

            $.get( url + "country/" + country, function(data2) {
                //$( ".result" ).html( data );
                //alert(JSON.stringify(data2));
              
                cities = '';
              
                Array.prototype.forEach.call(data2, function(data2) {
                    cities += '<option>' + data2.city + '</option>';
                });

                //alert(cities);                  
                
                $('select[name="state"]').html(cities);
                $('select[name="area_city"]').html(cities);
              
                //alert("Load was performed.");
            });
        }); 
        // End of Get State/Cities


    });


</script>

<script src="{{asset('ckeditor')}}/ckeditor.js"></script>

@stop