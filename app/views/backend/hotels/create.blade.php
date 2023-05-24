@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Create new Hotel ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
            	Create new Hotel
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Hotel Tours
			                <span class="icon-angle-right"></span>
			            </li>
			             

			                        <li>
							            Create new Hotel
			                                    
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

		<div class="well">
			<legend>General Information</legend>
			<!-- Name -->
			<div class="control-group {{ $errors->has('name') ? 'error' : '' }}">
				<label class="control-label">Hotel Name</label>
				<div class="controls">
					<input class="span4" type="text" name="name" value="{{ Input::old('name') }}" />
					{{ $errors->first('name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Title -->
			<div class="control-group {{ $errors->has('title') ? 'error' : '' }}">
				<label class="control-label">Hotel Title</label>
				<div class="controls">
					<input class="span4" type="text" name="title" value="{{ Input::old('title') }}" />
					{{ $errors->first('title', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Select Grade -->
            <div class="control-group {{ $errors->has('grade') ? 'error' : '' }}">
                <label class="control-label">Select Grade</label>
                <div class="controls">
                    <select type="text" name="grade" value="{{ Input::old('grade') }}">
                    	<option>1 Star</option>
                        <option>2 Star</option>
                        <option>3 Star</option>
                        <option>4 Star</option>
                        <option>5 Star</option>
                        <option>6 Star</option>
                        <option>7 Star</option>				   
                    </select>
                    {{ $errors->first('grade', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Select Status -->
            <div class="control-group {{ $errors->has('status') ? 'error' : '' }}">
                <label class="control-label">Select Status</label>
                <div class="controls">
                    <select type="text" name="status" id="status" value="{{ Input::old('status') }}">
                        <option value="" selected="selected">Select.....</option>
					    <option value="Superb">Superb</option>
					    <option value="Fabulous">Fabulous</option>
					    <option value="Fantastic">Fantastic</option>
					    <option value="Excellent">Excellent</option>
					    <option value="Very Good">Very Good</option>
					    <option value="Good">Good</option>
					    <option value="Standard">Standard</option>
                    </select>
                    {{ $errors->first('status', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Hotel's Manager -->
            <div class="control-group {{ $errors->has('added_by') ? 'error' : '' }}">
                <label class="control-label">Hotel's Manager</label>
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

            <!-- Select Hotels Group -->
            <div class="control-group {{ $errors->has('hotels_group') ? 'error' : '' }}">
                <label class="control-label">Select Hotels Group</label>
                <div class="controls">
                    <select type="text" name="hotels_group" value="{{ Input::old('hotels_group') }}">
                    	<option>Select a group..</option>
                        <option>Hotels</option>			   
                    </select>
                    {{ $errors->first('hotels_group', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Business Type -->
            <div class="control-group {{ $errors->has('business_type') ? 'error' : '' }}">
                <label class="control-label">Business Type</label>
                <div class="controls">
                    <select type="text" name="business_type" value="{{ Input::old('business_type') }}">
                    	<option>Select a group..</option>
                        <option>Hotels</option>			   
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

            <!-- Select Room Type -->
            <div class="control-group {{ $errors->has('room_type') ? 'error' : '' }}">
                <label class="control-label">Select Room Type</label>
                <div class="controls">
                    <select type="text" name="room_type" value="{{ Input::old('room_type') }}">
                    	<option value="1">One-Bedroom Apartment</option>
					    <option value="2">Two-Bedroom Apartment</option>
					    <option value="3">Studio Apartment with Creek View</option>
					    <option value="4">Executive Two-Bedroom Apartment (5 Adults)</option>
					    <option value="5">Double or Twin Room</option>
					    <option value="6">Triple Room</option>
					    <option value="7">Superior Double (with breakfast)</option>
					    <option value="8">Junior Suites</option>
					    <option value="9">Classic Double or Twin Room</option>
					    <option value="10">Interconnecting Classic Room Prices are per room.</option>
					    <option value="11">One-Bedroom Suite</option>
					    <option value="12">Deluxe Room</option>
					    <option value="13">Double Deluxe Room</option>
					    <option value="14">Royal Platinum Suite</option>
					    <option value="15">Standard Room</option>
					    <option value="16">One-bedroom Executive</option>
					    <option value="17">Studio Premier</option>
					    <option value="18">Executive Suite</option>
					    <option value="19">Extra Bed / Child</option>
					    <option value="20">Presidential Suite</option>
					    <option value="21">Family Room &amp; Twin / Large Superior</option>
					    <option value="22">Garden View Room</option>
					    <option value="23">Ocean View Room</option>
					    <option value="24">Classic Double Room</option>
					    <option value="25">Classic Single Room</option>
					    <option value="26">Superior City View</option>
					    <option value="27">Superior Park View</option>
					    <option value="28">Single</option>
					    <option value="29">Double</option>
					    <option value="30">Guest Rooms</option>
					    <option value="31">Accessible Rooms</option>
                    </select>
                    {{ $errors->first('room_type', '<span class="help-inline">:message</span>') }}
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

			<legend>Showroom Information</legend>

			<div class="control-group {{ $errors->has('country') ? 'error' : '' }}">
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

            <!--Location of Hotel -->
            <div class="control-group {{ $errors->has('location_of_hotel') ? 'error' : '' }}">
				<label class="control-label">Location of Hotel</label>
				<div class="controls">
                    <select type="text" name="location_of_hotel" value="{{ Input::old('location_of_hotel') }}">
                        <option>Please select a country first...</option>
                    </select>					
                {{ $errors->first('location_of_hotel', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!--Hotel Building Name -->
            <div class="control-group {{ $errors->has('building_name') ? 'error' : '' }}">
				<label class="control-label">Hotel Building Name</label>
				<div class="controls">
					<input type="text" name="building_name" value="{{ Input::old('building_name') }}" />
					{{ $errors->first('building_name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!--Hotel Building Number -->
            <div class="control-group {{ $errors->has('building_number') ? 'error' : '' }}">
				<label class="control-label">Hotel Building Number</label>
				<div class="controls">
					<input type="text" name="building_number" value="{{ Input::old('building_number') }}" />
					{{ $errors->first('building_number', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Hotel Telephone -->
            <div class="control-group {{ $errors->has('telephone') ? 'error' : '' }}">
				<label class="control-label">Hotel Telephone</label>
				<div class="controls">
					<input type="text" name="telephone" value="{{ Input::old('telephone') }}" />
					{{ $errors->first('telephone', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Hotel Fax -->
            <div class="control-group {{ $errors->has('fax') ? 'error' : '' }}">
				<label class="control-label">Hotel Fax</label>
				<div class="controls">
					<input type="text" name="fax" value="{{ Input::old('fax') }}" />
					{{ $errors->first('fax', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Hotel's Email Address -->
            <div class="control-group {{ $errors->has('hotels_email_address') ? 'error' : '' }}">
				<label class="control-label">Hotel's Email Address</label>
				<div class="controls">
					<input type="text" name="hotels_email_address" value="{{ Input::old('hotels_email_address') }}" />
					{{ $errors->first('hotels_email_address', '<span class="help-inline">:message</span>') }}
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

			<!-- Address -->
            <div class="control-group {{ $errors->has('address') ? 'error' : '' }}">
				<label class="control-label">Address</label>
				<div class="controls">
					<input type="text" name="address" value="{{ Input::old('address') }}" />
					{{ $errors->first('address', '<span class="help-inline">:message</span>') }}
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

        <div  class="well">
        	<legend>Summary Information</legend>

        	<!-- Distance From Airport-->
        	<div class="control-group {{ $errors->has('distance_from_airport') ? 'error' : '' }}">
                <label class="control-label" for="country">Distance From Airport</label>
                <div class="controls">
                    <input name="distance_from_airport" style="width:160px" type="text" value="{{ Input::old('distance_from_airport') }}"> 
                    {{ $errors->first('distance_from_airport', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Distance From City/Market -->
            <div class="control-group {{ $errors->has('distance_from_city_market') ? 'error' : '' }}">
                <label class="control-label" for="country">Distance From City/Market</label>
                <div class="controls">
                    <input name="distance_from_city_market" style="width:160px" type="text" value="{{ Input::old('distance_from_city_market') }}"> 
                    {{ $errors->first('distance_from_city_market', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Pet Allow -->
            <div class="control-group {{ $errors->has('pet_allow') ? 'error' : '' }}">
                <label class="control-label">Pet Allow</label>
                <div class="controls">
                    <select type="text" name="pet_allow" value="{{ Input::old('pet_allow') }}">
                    	<option>Select..</option>
                        <option>Allowed</option>			   
                        <option>Not Allowed</option>			   
                    </select>
                    {{ $errors->first('pet_allow', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Payment Option -->
            <div class="control-group {{ $errors->has('payment_option') ? 'error' : '' }}">
                <label class="control-label" for="country">Payment Option</label>
                <div class="controls">
                    <input name="payment_option" style="width:160px" type="text" value="{{ Input::old('payment_option') }}"> 
                    {{ $errors->first('payment_option', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
      

            <!-- Internet Information -->
            <div class="control-group {{ $errors->has('internet_information') ? 'error' : '' }}">
                <label class="control-label" for="country">Internet Information</label>
                <div class="controls">
                    <input name="internet_information" style="width:160px" type="text" value="{{ Input::old('internet_information') }}"> 
                    {{ $errors->first('internet_information', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Parking Information -->
            <div class="control-group {{ $errors->has('parking_information') ? 'error' : '' }}">
                <label class="control-label" for="country">Parking Information</label>
                <div class="controls">
                    <input name="parking_information" style="width:160px" type="text" value="{{ Input::old('parking_information') }}"> 
                    {{ $errors->first('parking_information', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

        </div>


      	<div class="well">
            <legend>Price and Payment Information</legend>           

            <!-- Adult Price -->
            <div class="control-group {{ $errors->has('adult_price') ? 'error' : '' }}">
                <label class="control-label" for="country">Adult Price</label>
                <div class="controls">
                    <input type="text" name="adult_price" id="adult_price" value="{{ Input::old('adult_price') }}" />
                    {{ $errors->first('adult_price', '<span class="help-inline">:message</span>') }}
                </div>
            </div> 

            <!-- Child Price -->
            <div class="control-group {{ $errors->has('child_price') ? 'error' : '' }}">
                <label class="control-label" for="country">Child Price</label>
                <div class="controls">
                    <input type="text" name="child_price" id="child_price" value="{{ Input::old('child_price') }}" />
                    {{ $errors->first('child_price', '<span class="help-inline">:message</span>') }}
                </div>
            </div> 

            <!-- Infant Price -->
            <div class="control-group {{ $errors->has('infant_price') ? 'error' : '' }}">
                <label class="control-label" for="country">Infant Price</label>
                <div class="controls">
                    <input type="text" name="infant_price" id="infant_price" value="{{ Input::old('infant_price') }}" />
                    {{ $errors->first('infant_price', '<span class="help-inline">:message</span>') }}
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

        	<legend>Discounts</legend>

            <!-- Discount Percentage (for Agents) -->
        	<div class="control-group">
				<label class="control-label">Discount Percentage (for Agents)</label>
				<div class="controls">
					<input type="text" name="discount_percentage_agents"  value="{{ Input::old('discount_percentage_agents', '0')}}" />
					{{ $errors->first('discount_percentage_agents', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

            <!-- Discount Percentage (for Distributors) -->
			<div class="control-group">
				<label class="control-label">Discount Percentage (for Distributors)</label>
				<div class="controls">
					<input type="text" name="discount_percentage_distributors"  value="{{ Input::old('discount_percentage_distributors', '0')}}" />
					{{ $errors->first('discount_percentage_distributors', '<span class="help-inline">:message</span>') }}
				</div>
			</div> 
        </div>

        <div class="well">

        	<legend>Profile Information</legend>

        	<!-- Information -->
            <div class="control-group {{ $errors->has('information') ? 'error' : '' }}">
                <label class="control-label">Information</label>
                <div class="controls">
                    <textarea class="ckeditor" name="information"> {{ Input::old('information') }}</textarea> 
                    {{ $errors->first('information', '<span class="help-inline">:message</span>') }}
                </div>
            </div> 

            <!-- General Information -->
            <div class="control-group {{ $errors->has('general_information') ? 'error' : '' }}">
                <label class="control-label" for="country">General Information</label>
                <div class="controls">
                    <textarea class="ckeditor" name="general_information"> {{ Input::old('general_information') }}</textarea> 
                    {{ $errors->first('general_information', '<span class="help-inline">:message</span>') }}
                </div>
            </div> 

            <!-- Services -->
            <div class="control-group {{ $errors->has('services') ? 'error' : '' }}">
                <label class="control-label" for="country">Services</label>
                <div class="controls">
                    <textarea class="ckeditor" name="services"> {{ Input::old('services') }}</textarea> 
                    {{ $errors->first('services', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Surroundings Information -->
            <div class="control-group {{ $errors->has('surroundings_information') ? 'error' : '' }}">
                <label class="control-label" for="country">Surroundings Information</label>
                <div class="controls">
                    <textarea class="ckeditor" name="surroundings_information"> {{ Input::old('surroundings_information') }}</textarea> 
                    {{ $errors->first('surroundings_information', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Other Information -->
            <div class="control-group {{ $errors->has('other_information') ? 'error' : '' }}">
                <label class="control-label" for="country">Other Information</label>
                <div class="controls">
                    <textarea class="ckeditor" name="other_information"> {{ Input::old('other_information') }}</textarea> 
                    {{ $errors->first('other_information', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
        </div>
				
		<div class="well">

        	<legend>Policy Information</legend>

        	<!-- Policies -->
            <div class="control-group {{ $errors->has('policies') ? 'error' : '' }}">
                <label class="control-label" for="country">Policies</label>
                <div class="controls">
                    <textarea class="ckeditor" name="policies"> {{ Input::old('policies') }}</textarea> 
                    {{ $errors->first('policies', '<span class="help-inline">:message</span>') }}
                </div>
            </div> 

            <!-- Terms & Condition -->
            <div class="control-group {{ $errors->has('terms_and_conditions') ? 'error' : '' }}">
                <label class="control-label" for="country">Terms &amp; Condition</label>
                <div class="controls">
                    <textarea class="ckeditor" name="terms_and_conditions"> {{ Input::old('terms_and_conditions') }}</textarea> 
                    {{ $errors->first('terms_and_conditions', '<span class="help-inline">:message</span>') }}
                </div>
            </div> 

            <!-- Privacy Policy -->
            <div class="control-group {{ $errors->has('privacy_policy') ? 'error' : '' }}">
                <label class="control-label" for="country">Privacy Policy</label>
                <div class="controls">
                    <textarea class="ckeditor" name="privacy_policy"> {{ Input::old('privacy_policy') }}</textarea> 
                    {{ $errors->first('privacy_policy', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Cancellation Policy -->
            <div class="control-group {{ $errors->has('cancellation_policy') ? 'error' : '' }}">
                <label class="control-label" for="country">Cancellation Policy</label>
                <div class="controls">
                    <textarea class="ckeditor" name="cancellation_policy"> {{ Input::old('cancellation_policy') }}</textarea> 
                    {{ $errors->first('cancellation_policy', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
        </div>

		<div class="well">

			<legend> Hotel Property Options </legend>

			<div class="control-group pull-left {{ $errors->has('ada_accessible') ? 'error' : '' }}">
				<label class="control-label" >ADA Accessible</label>
				<div class="controls">
					<input type="checkbox" name="ada_accessible" />
					{{ $errors->first('ada_accessible', '<span class="help-inline">:message</span>') }}
				</div>
			</div> 

			<div class="control-group pull-left {{ $errors->has('adults_only') ? 'error' : '' }}">
				<label class="control-label" >Adults Only</label>
				<div class="controls">
					<input type="checkbox" name="adults_only" />
					{{ $errors->first('adults_only', '<span class="help-inline">:message</span>') }}
				</div>
			</div> 

			<div class="control-group pull-left {{ $errors->has('airport_shuttle') ? 'error' : '' }}">
				<label class="control-label" >Airport Shuttle</label>
				<div class="controls">
					<input type="checkbox" name="airport_shuttle" />
					{{ $errors->first('airport_shuttle', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('beach_front') ? 'error' : '' }}">
				<label class="control-label" >Beach Front</label>
				<div class="controls">
					<input type="checkbox" name="beach_front" />
					{{ $errors->first('beach_front', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('breakfast') ? 'error' : '' }}">
				<label class="control-label" >Breakfast</label>
				<div class="controls">
					<input type="checkbox" name="breakfast" />
					{{ $errors->first('breakfast', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('business_center') ? 'error' : '' }}">
				<label class="control-label" >Business Center</label>
				<div class="controls">
					<input type="checkbox" name="business_center" />
					{{ $errors->first('business_center', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('business_ready') ? 'error' : '' }}">
				<label class="control-label" >Business Ready</label>
				<div class="controls">
					<input type="checkbox" name="business_ready" />
					{{ $errors->first('business_ready', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('car_rental_counter') ? 'error' : '' }}">
				<label class="control-label" >Car Rental Counter</label>
				<div class="controls">
					<input type="checkbox" name="car_rental_counter" />
					{{ $errors->first('car_rental_counter', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('conventions') ? 'error' : '' }}">
				<label class="control-label" >Conventions</label>
				<div class="controls">
					<input type="checkbox" name="conventions" />
					{{ $errors->first('conventions', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('dataport') ? 'error' : '' }}">
				<label class="control-label" >Dataport</label>
				<div class="controls">
					<input type="checkbox" name="dataport" />
					{{ $errors->first('dataport', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('dining') ? 'error' : '' }}">
				<label class="control-label" >Dining</label>
				<div class="controls">
					<input type="checkbox" name="dining" />
					{{ $errors->first('dining', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('dry_clean') ? 'error' : '' }}">
				<label class="control-label" >Dry Clean</label>
				<div class="controls">
					<input type="checkbox" name="dry_clean" />
					{{ $errors->first('dry_clean', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('eco_certified') ? 'error' : '' }}">
				<label class="control-label" >Eco Certified</label>
				<div class="controls">
					<input type="checkbox" name="eco_certified" />
					{{ $errors->first('eco_certified', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('executive_floors') ? 'error' : '' }}">
				<label class="control-label" >Executive Floors</label>
				<div class="controls">
					<input type="checkbox" name="executive_floors" />
					{{ $errors->first('executive_floors', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('family_plan') ? 'error' : '' }}">
				<label class="control-label" >Family Plan</label>
				<div class="controls">
					<input type="checkbox" name="family_plan" />
					{{ $errors->first('family_plan', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('fitness_center') ? 'error' : '' }}">
				<label class="control-label" >Fitness Center</label>
				<div class="controls">
					<input type="checkbox" name="fitness_center" />
					{{ $errors->first('fitness_center', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('free_local_calls') ? 'error' : '' }}">
				<label class="control-label" >Free Local Calls</label>
				<div class="controls">
					<input type="checkbox" name="free_local_calls" />
					{{ $errors->first('free_local_calls', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('free_parking') ? 'error' : '' }}">
				<label class="control-label" >Free Parking</label>
				<div class="controls">
					<input type="checkbox" name="free_parking" />
					{{ $errors->first('free_parking', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('free_shuttle') ? 'error' : '' }}">
				<label class="control-label" >Free Shuttle</label>
				<div class="controls">
					<input type="checkbox" name="free_shuttle" />
					{{ $errors->first('free_shuttle', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('free_wifi_in_meeting_rooms') ? 'error' : '' }}">
				<label class="control-label" >Free Wifi In Meeting Rooms</label>
				<div class="controls">
					<input type="checkbox" name="free_wifi_in_meeting_rooms" />
					{{ $errors->first('free_wifi_in_meeting_rooms', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('free_wifi_in_public_spaces') ? 'error' : '' }}">
				<label class="control-label" >Free Wifi In Public Spaces</label>
				<div class="controls">
					<input type="checkbox" name="free_wifi_in_public_spaces" />
					{{ $errors->first('free_wifi_in_public_spaces', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('free_wifi_in_rooms') ? 'error' : '' }}">
				<label class="control-label" >Free Wifi In Rooms</label>
				<div class="controls">
					<input type="checkbox" name="free_wifi_in_rooms" />
					{{ $errors->first('free_wifi_in_rooms', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('full_service_spa') ? 'error' : '' }}">
				<label class="control-label" >Full Service Spa</label>
				<div class="controls">
					<input type="checkbox" name="full_service_spa" />
					{{ $errors->first('full_service_spa', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('game_facilities') ? 'error' : '' }}">
				<label class="control-label" >Game Facilities</label>
				<div class="controls">
					<input type="checkbox" name="game_facilities" />
					{{ $errors->first('game_facilities', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('golf') ? 'error' : '' }}">
				<label class="control-label" >Golf</label>
				<div class="controls">
					<input type="checkbox" name="golf" />
					{{ $errors->first('golf', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('govt_safety_fire') ? 'error' : '' }}">
				<label class="control-label" >Govt Safety Fire</label>
				<div class="controls">
					<input type="checkbox" name="govt_safety_fire" />
					{{ $errors->first('govt_safety_fire', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('high_speed_internet') ? 'error' : '' }}">
				<label class="control-label" >High Speed Internet</label>
				<div class="controls">
					<input type="checkbox" name="high_speed_internet" />
					{{ $errors->first('high_speed_internet', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('hypoallergenic_rooms') ? 'error' : '' }}">
				<label class="control-label" >Hypoallergenic Rooms</label>
				<div class="controls">
					<input type="checkbox" name="hypoallergenic_rooms" />
					{{ $errors->first('hypoallergenic_rooms', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('indoor_pool') ? 'error' : '' }}">
				<label class="control-label" >Indoor Pool</label>
				<div class="controls">
					<input type="checkbox" name="indoor_pool" />
					{{ $errors->first('indoor_pool', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('ind_pet_restriction') ? 'error' : '' }}">
				<label class="control-label" >Ind Pet Restriction</label>
				<div class="controls">
					<input type="checkbox" name="ind_pet_restriction" />
					{{ $errors->first('ind_pet_restriction', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('in_room_coffee_tea') ? 'error' : '' }}">
				<label class="control-label" >In Room Coffee Tea </label>
				<div class="controls">
					<input type="checkbox" name="in_room_coffee_tea" />
					{{ $errors->first('in_room_coffee_tea', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('in_room_mini_bar') ? 'error' : '' }}">
				<label class="control-label" >In Room Mini Bar</label>
				<div class="controls">
					<input type="checkbox" name="in_room_mini_bar" />
					{{ $errors->first('in_room_mini_bar', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('in_room_refrigerator') ? 'error' : '' }}">
				<label class="control-label" >In Room Refrigerator</label>
				<div class="controls">
					<input type="checkbox" name="in_room_refrigerator" />
					{{ $errors->first('in_room_refrigerator', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('in_room_safe') ? 'error' : '' }}">
				<label class="control-label" >In Room Safe </label>
				<div class="controls">
					<input type="checkbox" name="in_room_safe" />
					{{ $errors->first('in_room_safe', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('interior_doorways') ? 'error' : '' }}">
				<label class="control-label" >Interior Doorways </label>
				<div class="controls">
					<input type="checkbox" name="interior_doorways" />
					{{ $errors->first('interior_doorways', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('jacuzzi') ? 'error' : '' }}">
				<label class="control-label" >Jacuzzi</label>
				<div class="controls">
					<input type="checkbox" name="jacuzzi" />
					{{ $errors->first('jacuzzi', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('kids_facilities') ? 'error' : '' }}">
				<label class="control-label" >Kids Facilities</label>
				<div class="controls">
					<input type="checkbox" name="kids_facilities" />
					{{ $errors->first('kids_facilities', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('kitchen_facilities') ? 'error' : '' }}">
				<label class="control-label" >Kitchen Facilities</label>
				<div class="controls">
					<input type="checkbox" name="kitchen_facilities" />
					{{ $errors->first('kitchen_facilities', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('meal_service') ? 'error' : '' }}">
				<label class="control-label" >Meal Service</label>
				<div class="controls">
					<input type="checkbox" name="meal_service" />
					{{ $errors->first('meal_service', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('meeting_facilities') ? 'error' : '' }}">
				<label class="control-label" >Meeting Facilities</label>
				<div class="controls">
					<input type="checkbox" name="meeting_facilities" />
					{{ $errors->first('meeting_facilities', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('no_adult_tv') ? 'error' : '' }}">
				<label class="control-label" >No Adult TV</label>
				<div class="controls">
					<input type="checkbox" name="no_adult_tv" />
					{{ $errors->first('no_adult_tv', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('non_smoking') ? 'error' : '' }}">
				<label class="control-label" >Non Smoking</label>
				<div class="controls">
					<input type="checkbox" name="non_smoking" />
					{{ $errors->first('non_smoking', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('outdoor_pool') ? 'error' : '' }}">
				<label class="control-label" >Outdoor Pool</label>
				<div class="controls">
					<input type="checkbox" name="outdoor_pool" />
					{{ $errors->first('outdoor_pool', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('parking') ? 'error' : '' }}">
				<label class="control-label" >Parking</label>
				<div class="controls">
					<input type="checkbox" name="parking" />
					{{ $errors->first('parking', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('pets') ? 'error' : '' }}">
				<label class="control-label" >Pets</label>
				<div class="controls">
					<input type="checkbox" name="pets" />
					{{ $errors->first('pets', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('pool') ? 'error' : '' }}">
				<label class="control-label" >Pool</label>
				<div class="controls">
					<input type="checkbox" name="pool" />
					{{ $errors->first('pool', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('public_transportation_adjacent') ? 'error' : '' }}">
				<label class="control-label" >Public Transportation Adjacent </label>
				<div class="controls">
					<input type="checkbox" name="public_transportation_adjacent" />
					{{ $errors->first('public_transportation_adjacent', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('recreation') ? 'error' : '' }}">
				<label class="control-label" >Recreation</label>
				<div class="controls">
					<input type="checkbox" name="recreation" />
					{{ $errors->first('recreation', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('restricted_room_access') ? 'error' : '' }}">
				<label class="control-label" >Restricted Room Access </label>
				<div class="controls">
					<input type="checkbox" name="restricted_room_access" />
					{{ $errors->first('restricted_room_access', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('room_service') ? 'error' : '' }}">
				<label class="control-label" >Room Service</label>
				<div class="controls">
					<input type="checkbox" name="room_service" />
					{{ $errors->first('room_service', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('room_service_24_hours') ? 'error' : '' }}">
				<label class="control-label" >Room Service 24 Hours</label>
				<div class="controls">
					<input type="checkbox" name="room_service_24_hours" />
					{{ $errors->first('room_service_24_hours', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('rooms_with_balcony') ? 'error' : '' }}">
				<label class="control-label" >Rooms With Balcony </label>
				<div class="controls">
					<input type="checkbox" name="rooms_with_balcony" />
					{{ $errors->first('rooms_with_balcony', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('ski_in_out_property') ? 'error' : '' }}">
				<label class="control-label" >Ski In Out Property</label>
				<div class="controls">
					<input type="checkbox" name="ski_in_out_property" />
					{{ $errors->first('ski_in_out_property', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('smoke_free') ? 'error' : '' }}">
				<label class="control-label" >Smoke Free</label>
				<div class="controls">
					<input type="checkbox" name="smoke_free" />
					{{ $errors->first('smoke_free', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('smoking_rooms_avail') ? 'error' : '' }}">
				<label class="control-label" >Smoking Rooms Avail </label>
				<div class="controls">
					<input type="checkbox" name="smoking_rooms_avail" />
					{{ $errors->first('smoking_rooms_avail', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('tennis') ? 'error' : '' }}">
				<label class="control-label" >Tennis</label>
				<div class="controls">
					<input type="checkbox" name="tennis" />
					{{ $errors->first('tennis', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('water_purification_system') ? 'error' : '' }}">
				<label class="control-label" >Water Purification System</label>
				<div class="controls">
					<input type="checkbox" name="water_purification_system" />
					{{ $errors->first('water_purification_system', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('wheelchair') ? 'error' : '' }}">
				<label class="control-label" >Wheelchair</label>
				<div class="controls">
					<input type="checkbox" name="wheelchair" />
					{{ $errors->first('wheelchair', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('all_inclusive') ? 'error' : '' }}">
				<label class="control-label" >All Inclusive</label>
				<div class="controls">
					<input type="checkbox" name="all_inclusive" />
					{{ $errors->first('all_inclusive', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('apartments') ? 'error' : '' }}">
				<label class="control-label" >Apartments</label>
				<div class="controls">
					<input type="checkbox" name="apartments" />
					{{ $errors->first('apartments', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('bed_breakfast') ? 'error' : '' }}">
				<label class="control-label" >Bed Breakfast</label>
				<div class="controls">
					<input type="checkbox" name="bed_breakfast" />
					{{ $errors->first('bed_breakfast', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('castle') ? 'error' : '' }}">
				<label class="control-label" >Castle</label>
				<div class="controls">
					<input type="checkbox" name="castle" />
					{{ $errors->first('castle', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('economy') ? 'error' : '' }}">
				<label class="control-label" >Economy</label>
				<div class="controls">
					<input type="checkbox" name="economy" />
					{{ $errors->first('economy', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('extended_stay') ? 'error' : '' }}">
				<label class="control-label" >Extended Stay</label>
				<div class="controls">
					<input type="checkbox" name="extended_stay" />
					{{ $errors->first('extended_stay', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('farm') ? 'error' : '' }}">
				<label class="control-label" >Farm</label>
				<div class="controls">
					<input type="checkbox" name="farm" />
					{{ $errors->first('farm', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('first') ? 'error' : '' }}">
				<label class="control-label" >First</label>
				<div class="controls">
					<input type="checkbox" name="first" />
					{{ $errors->first('first', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('luxury') ? 'error' : '' }}">
				<label class="control-label" >Luxury</label>
				<div class="controls">
					<input type="checkbox" name="luxury" />
					{{ $errors->first('luxury', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('moderate') ? 'error' : '' }}">
				<label class="control-label" >Moderate</label>
				<div class="controls">
					<input type="checkbox" name="moderate" />
					{{ $errors->first('moderate', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('motel') ? 'error' : '' }}">
				<label class="control-label" >Motel</label>
				<div class="controls">
					<input type="checkbox" name="motel" />
					{{ $errors->first('motel', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('resort') ? 'error' : '' }}">
				<label class="control-label" >Resort</label>
				<div class="controls">
					<input type="checkbox" name="resort" />
					{{ $errors->first('resort', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('suites') ? 'error' : '' }}">
				<label class="control-label" >Suites</label>
				<div class="controls">
					<input type="checkbox" name="suites" />
					{{ $errors->first('suites', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<br clear="all">
		</div>

		<!-- attractions -->
		<div class="well">

			<legend> Hotel Attractions </legend>

      		<div class="control-group {{ $errors->has('attraction_1') ? 'error' : '' }}">
				<label class="control-label">Hotel Attraction</label>
				<div class="controls">
          		<input type="text" name="attraction_1" style="width:800px;" placeholder="100km from Airport">
					{{ $errors->first('attraction_1', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div id="append_attraction" class="control-group">
				<input type="hidden" id="incr" name="incr" value="1">
				<input type="hidden" id="attractions_json" name="attractions_json" value='["attraction_1"]'>

				<div class="controls">
				<div id="add_attraction" class="btn btn-mini btn-info" style="margin-bottom:12px;">Add More Attractions</div>
				</div>
			</div>
		</div> 
		<!-- /attractions -->
                                               
	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('hotels') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Create Hotel</button>
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

		incr = parseInt($('#incr').val(incr));  

		attractions = ['attraction_1'];		

        $('#add_attraction').click(function(){ 
        	incr++;   
            $('#append_attraction').append('\
            	<div class="control-group" id="attraction_'+incr+'">\
				<label class="control-label">Hotel Attraction</label>\
				<div class="controls">\
                	<input type="text" name="attraction_'+incr+'" style="width:800px;">\
				</div>\
				<button type="button" style="margin-top:-26px;margin-right:-8px;" class="close incr" data-dismiss="alert">×</button>\
			</div>');          
                
            $('#incr').val(incr);  

            attractions.push('attraction_'+incr);
            $newjson = JSON.stringify(attractions);
            $('#attractions_json').val($newjson);
        });

        $("#append_attraction").on('click', 'button.incr', function() {

	    	$parentid = $(this).parent().attr('id');

	    	index = attractions.indexOf($parentid);

	    	if (index > -1) {
			    attractions.splice(index, 1);
			}

	    	$newjson = JSON.stringify(attractions);
            $('#attractions_json').val($newjson);
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
                $('select[name="location_of_hotel"]').html(cities);
            });
        }); 
        // End of Get State/Cities
    });

</script>

<script src="{{asset('ckeditor')}}/ckeditor.js"></script>


@stop
