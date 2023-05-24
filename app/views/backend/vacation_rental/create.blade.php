@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Create Vacation Rental ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
            	Create Vacation Rental
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Vacation Rental
			        <span class="icon-angle-right"></span>
			    </li>
			             
                <li>
		            Create Vacation Rental                           
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

                            <!--  Vacation Rental Name -->
                            <div class="control-group {{ $errors->has('name') ? 'error' : '' }}">
                                <label class="control-label"> Vacation Rental Name</label>
                                <div class="controls">
                                    <input type="text" name="name" value="{{ Input::old('name') }}" />
                                    {{ $errors->first('name', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!--  Vacation Rental Title -->
                            <div class="control-group {{ $errors->has('title') ? 'error' : '' }}">
                                <label class="control-label"> Vacation Rental Title</label>
                                <div class="controls">
                                    <input type="text" name="title" value="{{ Input::old('title') }}" />
                                    {{ $errors->first('title', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Vacation Rental's Manager -->
                            <div class="control-group {{ $errors->has('added_by') ? 'error' : '' }}">
                                <label class="control-label">Vacation Rental's Manager</label>
                                <div class="controls">
                                    <select type="text" name="added_by" value="{{ Input::old('added_by') }}">
                                        <option>1 Manager</option>
                                        <option>2 Manager</option>
                                        <option>3 Star</option>
                                        <option>4 Star</option>
                                    </select>
                                    {{ $errors->first('added_by', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                             <!-- Select Vacation Rental Group -->
                            <div class="control-group {{ $errors->has('vacation_rentals_group') ? 'error' : '' }}">
                                <label class="control-label">Select Vacation Rental Group</label>
                                <div class="controls">
                                    <select type="text" name="vacation_rentals_group" value="{{ Input::old('vacation_rentals_group') }}">
                                        <option>Select a group..</option>
                                        <option>Vacation Rentals</option>            
                                    </select>
                                    {{ $errors->first('vacation_rentals_group', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Business Type -->
                            <div class="control-group {{ $errors->has('business_type') ? 'error' : '' }}">
                                <label class="control-label">Business Type</label>
                                <div class="controls">
                                    <select type="text" name="business_type" value="{{ Input::old('business_type') }}">
                                        <option>Select a group..</option>
                                        <option>Vacation Rentals</option>            
                                    </select>
                                    {{ $errors->first('business_type', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Select Category From Category Tree -->
                            <div class="control-group {{ $errors->has('category_tree') ? 'error' : '' }}">
                                <label class="control-label">Select Category From Category Tree</label>
                                <div class="controls">
                                    <select type="text" name="category_tree" value="{{ Input::old('category_tree') }}">
                                        <option>Select a group..</option>
                                        <option>Hotels</option>            
                                    </select>
                                    {{ $errors->first('category_tree', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Short Description -->
                            <div class="control-group {{ $errors->has('short_description') ? 'error' : '' }}">
                                <label class="control-label">Short Description</label>
                                <div class="controls">
                                    <input type="text" name="short_description" value="{{ Input::old('short_description') }}" />
                                    {{ $errors->first('short_description', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>
                            
                            <!-- Description -->
                            <div class="control-group {{ $errors->has('description') ? 'error' : '' }}">
                                <label class="control-label" for="description">Description</label>
                                <div class="controls">

                                    <textarea class="span7 ckeditor" name="description" rows="10">{{ Input::old('description') }}</textarea>
                                    
                                    {{ $errors->first('description', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>
                            
                        </div>

                        <div class="well">
                            <legend>Picture Upload</legend>

                            <div class="control-group {{ $errors->has('uploaded_file') ? 'error' : '' }}">
                                <label class="control-label" for="description">Default Image</label>
                                <div class="controls">
                                    <input type="file" name="uploaded_file">
                                    {{ $errors->first('uploaded_file', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <div id="append" class="control-group">
                                <input type="hidden" id="multiple_images_json" name="multiple_images_json" value=''>
                                <div class="controls">
                                <div id="add_new" class="btn btn-success">Add More Images</div>
                                </div>
                            </div>
                        </div>


                		<div class="well">
                            <legend>Payment Information</legend>

                            <!-- Rent / Price -->
                            <div class="control-group" {{ $errors->has('rent_price') ? 'error' : '' }}">
                                <label class="control-label">Rent / Price</label>
                                <div class="controls">
                                    <input type="text" name="rent_price" value="{{ Input::old('rent_price') }}" />
                                    {{ $errors->first('rent_price', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Strickthrow Price -->
                            <div class="control-group" {{ $errors->has('strickthrow_price') ? 'error' : '' }}">
                                <label class="control-label">Strickthrow Price</label>
                                <div class="controls">
                                    <input type="text" name="strickthrow_price" value="{{ Input::old('strickthrow_price') }}" />
                                    {{ $errors->first('strickthrow_price', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Payment Description -->
                            <div class="control-group {{ $errors->has('payment_description') ? 'error' : '' }}">
                                <label class="control-label" for="country">Payment Description</label>
                                <div class="controls">
                                    <textarea class="ckeditor" name="payment_description"> {{ Input::old('payment_description') }}</textarea> 
                                    {{ $errors->first('payment_description', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div> 
                        </div>

                        <div class="well">
                            <legend>Address Information</legend>

                            <div class="control-group" {{ $errors->has('country') ? 'error' : '' }}">
                                <label class="control-label" for="country">Country</label>
                                <div class="controls">
                                    <select name="country">

                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ Input::old('country') == $country->id ? 'selected="selected"' : ''  }}   >{{ $country->value }}</option>
                                    @endforeach
                                    </select>

                                    {{ $errors->first('country', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- State -->
                            <div class="control-group {{ $errors->has('state') ? 'error' : '' }}">
                                <label class="control-label">State</label>
                                <div class="controls">
                                    <select type="text" name="state" value="{{ Input::old('state') }}">
                                        <option>Please select a country first...</option>
                                    </select>
                                    {{ $errors->first('state', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Select an Area or City -->
                            <div class="control-group {{ $errors->has('area_city') ? 'error' : '' }}">
                                <label class="control-label">Select an Area or City</label>
                                <div class="controls">
                                    <select type="text" name="area_city" value="{{ Input::old('area_city') }}">
                                        <option>Please select a country first...</option>
                                    </select>
                                    {{ $errors->first('area_city', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Post Code -->
                            <div class="control-group {{ $errors->has('post_code') ? 'error' : '' }}">
                                <label class="control-label">Post Code</label>
                                <div class="controls">
                                    <input type="text" name="post_code" value="{{ Input::old('post_code') }}" />
                                    {{ $errors->first('post_code', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Property Name -->
                            <div class="control-group {{ $errors->has('property_name') ? 'error' : '' }}">
                                <label class="control-label">Property Name</label>
                                <div class="controls">
                                    <input type="text" name="property_name" value="{{ Input::old('property_name') }}" />
                                    {{ $errors->first('property_name', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Plot or Holding Number -->
                            <div class="control-group {{ $errors->has('plot_holding_number') ? 'error' : '' }}">
                                <label class="control-label">Plot or Holding Number</label>
                                <div class="controls">
                                    <input type="text" name="plot_holding_number" value="{{ Input::old('plot_holding_number') }}" />
                                    {{ $errors->first('plot_holding_number', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Number of Stars (1-5 in number) -->
                            <div class="control-group {{ $errors->has('number_of_stars') ? 'error' : '' }}">
                                <label class="control-label">Number of Stars (1-5 in number)</label>
                                <div class="controls">
                                    <input type="text" name="number_of_stars" value="{{ Input::old('number_of_stars') }}" />
                                    {{ $errors->first('number_of_stars', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- View/Location Type -->
                            <div class="control-group {{ $errors->has('view_location_type') ? 'error' : '' }}">
                                <label class="control-label">View/Location Type</label>
                                <div class="controls">
                                    <input type="text" name="view_location_type" value="{{ Input::old('view_location_type') }}" />
                                    {{ $errors->first('view_location_type', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Number of Accommodates -->
                            <div class="control-group {{ $errors->has('number_of_accommodates') ? 'error' : '' }}">
                                <label class="control-label">Number of Accommodates</label>
                                <div class="controls">
                                    <input type="text" name="number_of_accommodates" value="{{ Input::old('number_of_accommodates') }}" />
                                    {{ $errors->first('number_of_accommodates', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Property Size in Square Feet (sqft): -->
                            <div class="control-group {{ $errors->has('property_size_sq_ft') ? 'error' : '' }}">
                                <label class="control-label">Property Size in Square Feet (sqft):</label>
                                <div class="controls">
                                    <input type="text" name="property_size_sq_ft" value="{{ Input::old('property_size_sq_ft') }}" />
                                    {{ $errors->first('property_size_sq_ft', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="control-group {{ $errors->has('address') ? 'error' : '' }}">
                                <label class="control-label" for="country">Address</label>
                                <div class="controls">
                                    <textarea class="ckeditor" name="address"> {{ Input::old('address') }}</textarea> 
                                    {{ $errors->first('address', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div> 

                        </div>

                        <div class="well">
                            <legend>Feature Information</legend>

                            <!-- Number of Rooms -->
                            <div class="control-group {{ $errors->has('number_of_rooms') ? 'error' : '' }}">
                                <label class="control-label">Number of Rooms</label>
                                <div class="controls">
                                    <input type="text" name="number_of_rooms" value="{{ Input::old('number_of_rooms') }}" />
                                    {{ $errors->first('number_of_rooms', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Number of Bed Rooms -->
                            <div class="control-group {{ $errors->has('number_of_bed_rooms') ? 'error' : '' }}">
                                <label class="control-label">Number of Bed Rooms</label>
                                <div class="controls">
                                    <input type="text" name="number_of_bed_rooms" value="{{ Input::old('number_of_bed_rooms') }}" />
                                    {{ $errors->first('number_of_bed_rooms', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Number of Bath Rooms -->
                            <div class="control-group {{ $errors->has('number_of_bath_rooms') ? 'error' : '' }}">
                                <label class="control-label">Number of Bath Rooms</label>
                                <div class="controls">
                                    <input type="text" name="number_of_bath_rooms" value="{{ Input::old('number_of_bath_rooms') }}" />
                                    {{ $errors->first('number_of_bath_rooms', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Minimum Stay(in nights) -->
                            <div class="control-group {{ $errors->has('minimum_stay_nights') ? 'error' : '' }}">
                                <label class="control-label">Minimum Stay(in nights)</label>
                                <div class="controls">
                                    <input type="text" name="minimum_stay_nights" value="{{ Input::old('minimum_stay_nights') }}" />
                                    {{ $errors->first('minimum_stay_nights', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Sleeps -->
                            <div class="control-group {{ $errors->has('sleeps') ? 'error' : '' }}">
                                <label class="control-label">Sleeps</label>
                                <div class="controls">
                                    <input type="text" name="sleeps" value="{{ Input::old('sleeps') }}" />
                                    {{ $errors->first('sleeps', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Gusts -->
                            <div class="control-group {{ $errors->has('gusts') ? 'error' : '' }}">
                                <label class="control-label">Gusts</label>
                                <div class="controls">
                                    <input type="text" name="gusts" value="{{ Input::old('gusts') }}" />
                                    {{ $errors->first('gusts', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Garden -->
                            <div class="control-group {{ $errors->has('garden') ? 'error' : '' }}">
                                <label class="control-label">Garden</label>
                                <div class="controls">
                                    <input type="text" name="garden" value="{{ Input::old('garden') }}" />
                                    {{ $errors->first('garden', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Conservatory -->
                            <div class="control-group {{ $errors->has('conservatory') ? 'error' : '' }}">
                                <label class="control-label">Conservatory</label>
                                <div class="controls">
                                    <input type="text" name="conservatory" value="{{ Input::old('conservatory') }}" />
                                    {{ $errors->first('conservatory', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Garage -->
                            <div class="control-group {{ $errors->has('garage') ? 'error' : '' }}">
                                <label class="control-label">Garage</label>
                                <div class="controls">
                                    <input type="text" name="garage" value="{{ Input::old('garage') }}" />
                                    {{ $errors->first('garage', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Distance from Airport (in KM) -->
                            <div class="control-group {{ $errors->has('distance_from_airport') ? 'error' : '' }}">
                                <label class="control-label">Distance from Airport (in KM)</label>
                                <div class="controls">
                                    <input type="text" name="distance_from_airport" value="{{ Input::old('distance_from_airport') }}" />
                                    {{ $errors->first('distance_from_airport', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Distance from Rail (in KM) -->
                            <div class="control-group {{ $errors->has('distance_from_rail') ? 'error' : '' }}">
                                <label class="control-label">Distance from Rail (in KM)</label>
                                <div class="controls">
                                    <input type="text" name="distance_from_rail" value="{{ Input::old('distance_from_rail') }}" />
                                    {{ $errors->first('distance_from_rail', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Distance from Market (in KM) -->
                            <div class="control-group {{ $errors->has('distance_from_market') ? 'error' : '' }}">
                                <label class="control-label">Distance from Market (in KM)</label>
                                <div class="controls">
                                    <input type="text" name="distance_from_market" value="{{ Input::old('distance_from_market') }}" />
                                    {{ $errors->first('distance_from_market', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Distance from City (in KM) -->
                            <div class="control-group {{ $errors->has('distance_from_city') ? 'error' : '' }}">
                                <label class="control-label">Distance from City (in KM)</label>
                                <div class="controls">
                                    <input type="text" name="distance_from_city" value="{{ Input::old('distance_from_city') }}" />
                                    {{ $errors->first('distance_from_city', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Entertainments -->
                            <div class="control-group {{ $errors->has('entertainments') ? 'error' : '' }}">
                                <label class="control-label">Entertainments</label>
                                <div class="controls">
                                    <input type="text" name="entertainments" value="{{ Input::old('entertainments') }}" />
                                    {{ $errors->first('entertainments', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Reception -->
                            <div class="control-group {{ $errors->has('reception') ? 'error' : '' }}">
                                <label class="control-label">Reception</label>
                                <div class="controls">
                                    <input type="text" name="reception" value="{{ Input::old('reception') }}" />
                                    {{ $errors->first('reception', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Kitchen -->
                            <div class="control-group {{ $errors->has('kitchen') ? 'error' : '' }}">
                                <label class="control-label">Kitchen</label>
                                <div class="controls">
                                    <input type="text" name="kitchen" value="{{ Input::old('kitchen') }}" />
                                    {{ $errors->first('kitchen', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                        </div>

                        <div class="well">
                            <legend>Brochure Information</legend>
                            
                            <!-- Brochure Title -->
                            <div class="control-group {{ $errors->has('brochure_title') ? 'error' : '' }}">
                                <label class="control-label">Brochure Title</label>
                                <div class="controls">
                                    <input type="text" name="brochure_title" value="{{ Input::old('brochure_title') }}" />
                                    {{ $errors->first('brochure_title', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Brochure Description -->
                            <div class="control-group {{ $errors->has('brochure_description') ? 'error' : '' }}">
                                <label class="control-label"> Brochure Description</label>
                                <div class="controls">
                                    <textarea class="span7 ckeditor" name="brochure_description" rows="10">{{ Input::old('brochure_description') }}</textarea>
                                    {{ $errors->first('brochure_description', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                        </div>

                        <div class="well">
                            <legend>Information of Availabilities</legend>

                            <!-- Stock -->
                            <div class="control-group {{ $errors->has('stock') ? 'error' : '' }}">
                                <label class="control-label" for="country">Stock</label>
                                <div class="controls">
                                    <input name="stock" style="width:160px" type="text" value="{{ Input::old('stock') }}"> 
                                    {{ $errors->first('stock', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Effective From -->
                            <div class="control-group {{ $errors->has('effective_from') ? 'error' : '' }}">
                                <label class="control-label" for="country">Effective From </label>
                                <div class="controls">
                                    <input name="effective_from" type="text" value="{{ Input::old('effective_from') }}" id="datepicker1" class="ui-datepicker">                 
                                    {{ $errors->first('effective_from', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Expire On -->
                            <div class="control-group {{ $errors->has('expire_on') ? 'error' : '' }}">
                                <label class="control-label" for="country">Expire On</label>
                                <div class="controls">
                                    <input name="expire_on" id="datepicker2" style="width:160px" type="text" value="{{ Input::old('expire_on') }}"> 
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

                                    <textarea class="span7 ckeditor" name="google_map" rows="10">{{ Input::old('google_map') }}</textarea>
                                    
                                    {{ $errors->first('google_map', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div> 

                            <!-- Additional Features -->
                            <div class="control-group {{ $errors->has('additional_features') ? 'error' : '' }}">
                                <label class="control-label">Additional Features</label>
                                <div class="controls">

                                    <textarea class="span7 ckeditor" name="additional_features" rows="10">{{ Input::old('additional_features') }}</textarea>
                                    
                                    {{ $errors->first('additional_features', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Rental Policies -->
                            <div class="control-group {{ $errors->has('rental_policies') ? 'error' : '' }}">
                                <label class="control-label">Rental Policies</label>
                                <div class="controls">

                                    <textarea class="span7 ckeditor" name="rental_policies" rows="10">{{ Input::old('rental_policies') }}</textarea>
                                    
                                    {{ $errors->first('rental_policies', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="control-group {{ $errors->has('terms_and_conditions') ? 'error' : '' }}">
                                <label class="control-label">Terms and Conditions</label>
                                <div class="controls">

                                    <textarea class="span7 ckeditor" name="terms_and_conditions" rows="10">{{ Input::old('terms_and_conditions') }}</textarea>
                                    
                                    {{ $errors->first('terms_and_conditions', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>           

                        </div>
                				                           

                    	<div class="well">

                            <legend>Discounts</legend>

                            <div class="control-group">
                                <label class="control-label">Discount Percentage (for Agents)</label>
                                <div class="controls">
                                    <input type="text" name="discount_percentage_agents"  value="{{ Input::old('discount_percentage_agents', '0')}}" />
                                    {{ $errors->first('discount_percentage_agents', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Discount Percentage (for Distributors)</label>
                                <div class="controls">
                                    <input type="text" name="discount_percentage_distributors"  value="{{ Input::old('discount_percentage_distributors', '0')}}" />
                                    {{ $errors->first('discount_percentage_distributors', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div> 
                        </div>



                    	<!-- Form Actions -->
                    	<div class="control-group">
                    		<div class="controls">
                    			<a class="btn btn-link" href="{{ route('package_tours') }}">Back</a>

                    			<button type="reset" class="btn">Reset</button>

                    			<button type="submit" class="btn btn-success">Create Vacation Rental</button>
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


        multiple_images_array = [];

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

        $( "#datepicker1" ).datetimepicker({       
          dateFormat: "yy-mm-dd",
          timeFormat: "HH:mm:ss"
        });

        $( "#datepicker2" ).datetimepicker({       
          dateFormat: "yy-mm-dd",
          timeFormat: "HH:mm:ss"
        });

        // Get State/Cities
        url = "<?php echo route('home'); ?>";

        country = $('select[name="country"] option:selected').text();
        
        $.get( url + "country/" + country, function(data2) {
              
                cities = '';
              
                Array.prototype.forEach.call(data2, function(data2) {
                    cities += '<option>' + data2.city + '</option>';
                });
                
                $('select[name="state"]').html(cities);
                $('select[name="area_city"]').html(cities);             
        });


        $('select[name="country"]').change(function() {

            country = $('option:selected', this).text();

            url = "<?php echo route('home'); ?>";

            $.get( url + "country/" + country, function(data2) {

                cities = '';
              
                Array.prototype.forEach.call(data2, function(data2) {
                    cities += '<option>' + data2.city + '</option>';
                });
                
                $('select[name="state"]').html(cities);
                $('select[name="area_city"]').html(cities);
            });
        }); 
        // End of Get State/Cities

    });


</script>

<script src="{{asset('ckeditor')}}/ckeditor.js"></script>


@stop             
              