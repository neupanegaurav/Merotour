@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Hotels Update ::
@parent
@stop

{{-- Content --}}
@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Hotel Update
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Hotels
	                <span class="icon-angle-right"></span>
	            </li>
			             
                <li>
                	Hotel Update                           
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
					<input class="span4" type="text" name="name" value="{{ Input::old('name', $entry->name) }}" />
					{{ $errors->first('name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Title -->
			<div class="control-group {{ $errors->has('title') ? 'error' : '' }}">
				<label class="control-label">Hotel Title</label>
				<div class="controls">
					<input class="span4" type="text" name="title" value="{{ Input::old('title', $entry->title) }}" />
					{{ $errors->first('title', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Select Grade -->
            <div class="control-group {{ $errors->has('grade') ? 'error' : '' }}">
                <label class="control-label">Select Grade</label>
                <div class="controls">
                    <select type="text" name="grade" value="{{ Input::old('grade', $entry->grade) }}">
						<option {{ Input::old('grade', $entry->grade) == '1 Star' ? 'selected="selected"' : ''  }}>1 Star</option>
						<option {{ Input::old('grade', $entry->grade) == '2 Star' ? 'selected="selected"' : ''  }}>2 Star</option>
						<option {{ Input::old('grade', $entry->grade) == '3 Star' ? 'selected="selected"' : ''  }}>3 Star</option>
						<option {{ Input::old('grade', $entry->grade) == '4 Star' ? 'selected="selected"' : ''  }}>4 Star</option>
						<option {{ Input::old('grade', $entry->grade) == '5 Star' ? 'selected="selected"' : ''  }}>5 Star</option>
						<option {{ Input::old('grade', $entry->grade) == '6 Star' ? 'selected="selected"' : ''  }}>6 Star</option>				   
						<option {{ Input::old('grade', $entry->grade) == '7 Star' ? 'selected="selected"' : ''  }}>7 Star</option>
                    </select>
                    {{ $errors->first('grade', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Select Status -->
            <div class="control-group {{ $errors->has('status') ? 'error' : '' }}">
                <label class="control-label">Select Status</label>
                <div class="controls">
                    <select type="text" name="status" id="status" value="{{ Input::old('status') }}">
					    <option value="Superb" {{ Input::old('status', $entry->status) == 'Suberb' ? 'selected="selected"' : ''  }} >Superb</option>
					    <option value="Fabulous" {{ Input::old('status', $entry->status) == 'Fabulous' ? 'selected="selected"' : ''  }}>Fabulous</option>
					    <option value="Fantastic" {{ Input::old('status', $entry->status) == 'Fantastic' ? 'selected="selected"' : ''  }}>Fantastic</option>
					    <option value="Excellent" {{ Input::old('status', $entry->status) == 'Excellent' ? 'selected="selected"' : ''  }}>Excellent</option>
					    <option value="Very Good" {{ Input::old('status', $entry->status) == 'Very Good' ? 'selected="selected"' : ''  }}>Very Good</option>
					    <option value="Good" {{ Input::old('status', $entry->status) == 'Good' ? 'selected="selected"' : ''  }}>Good</option>
					    <option value="Standard" {{ Input::old('status', $entry->status) == 'Standard' ? 'selected="selected"' : ''  }}>Standard</option>
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
                    	<option value="1"  {{ Input::old('room_type', $entry->room_type) == '1' ? 'selected="selected"' : ''  }}>One-Bedroom Apartment</option>
					    <option value="2"  {{ Input::old('room_type', $entry->room_type) == '2' ? 'selected="selected"' : ''  }}>Two-Bedroom Apartment</option>
					    <option value="3"  {{ Input::old('room_type', $entry->room_type) == '3' ? 'selected="selected"' : ''  }}>Studio Apartment with Creek View</option>
					    <option value="4"  {{ Input::old('room_type', $entry->room_type) == '4' ? 'selected="selected"' : ''  }}>Executive Two-Bedroom Apartment (5 Adults)</option>
					    <option value="5"  {{ Input::old('room_type', $entry->room_type) == '5' ? 'selected="selected"' : ''  }}>Double or Twin Room</option>
					    <option value="6"  {{ Input::old('room_type', $entry->room_type) == '6' ? 'selected="selected"' : ''  }}>Triple Room</option>
					    <option value="7"  {{ Input::old('room_type', $entry->room_type) == '7' ? 'selected="selected"' : ''  }}>Superior Double (with breakfast)</option>
					    <option value="8"  {{ Input::old('room_type', $entry->room_type) == '8' ? 'selected="selected"' : ''  }}>Junior Suites</option>
					    <option value="9"  {{ Input::old('room_type', $entry->room_type) == '9' ? 'selected="selected"' : ''  }}>Classic Double or Twin Room</option>
					    <option value="10" {{ Input::old('room_type', $entry->room_type) == '10' ? 'selected="selected"' : ''  }}>Interconnecting Classic Room Prices are per room.</option>
					    <option value="11" {{ Input::old('room_type', $entry->room_type) == '11' ? 'selected="selected"' : ''  }}>One-Bedroom Suite</option>
					    <option value="12" {{ Input::old('room_type', $entry->room_type) == '12' ? 'selected="selected"' : ''  }}>Deluxe Room</option>
					    <option value="13" {{ Input::old('room_type', $entry->room_type) == '13' ? 'selected="selected"' : ''  }}>Double Deluxe Room</option>
					    <option value="14" {{ Input::old('room_type', $entry->room_type) == '14' ? 'selected="selected"' : ''  }}>Royal Platinum Suite</option>
					    <option value="15" {{ Input::old('room_type', $entry->room_type) == '15' ? 'selected="selected"' : ''  }}>Standard Room</option>
					    <option value="16" {{ Input::old('room_type', $entry->room_type) == '16' ? 'selected="selected"' : ''  }}>One-bedroom Executive</option>
					    <option value="17" {{ Input::old('room_type', $entry->room_type) == '17' ? 'selected="selected"' : ''  }}>Studio Premier</option>
					    <option value="18" {{ Input::old('room_type', $entry->room_type) == '18' ? 'selected="selected"' : ''  }}>Executive Suite</option>
					    <option value="19" {{ Input::old('room_type', $entry->room_type) == '19' ? 'selected="selected"' : ''  }}>Extra Bed / Child</option>
					    <option value="20" {{ Input::old('room_type', $entry->room_type) == '20' ? 'selected="selected"' : ''  }}>Presidential Suite</option>
					    <option value="21" {{ Input::old('room_type', $entry->room_type) == '21' ? 'selected="selected"' : ''  }}>Family Room &amp; Twin / Large Superior</option>
					    <option value="22" {{ Input::old('room_type', $entry->room_type) == '22' ? 'selected="selected"' : ''  }}>Garden View Room</option>
					    <option value="23" {{ Input::old('room_type', $entry->room_type) == '23' ? 'selected="selected"' : ''  }}>Ocean View Room</option>
					    <option value="24" {{ Input::old('room_type', $entry->room_type) == '24' ? 'selected="selected"' : ''  }}>Classic Double Room</option>
					    <option value="25" {{ Input::old('room_type', $entry->room_type) == '25' ? 'selected="selected"' : ''  }}>Classic Single Room</option>
					    <option value="26" {{ Input::old('room_type', $entry->room_type) == '26' ? 'selected="selected"' : ''  }}>Superior City View</option>
					    <option value="27" {{ Input::old('room_type', $entry->room_type) == '27' ? 'selected="selected"' : ''  }}>Superior Park View</option>
					    <option value="28" {{ Input::old('room_type', $entry->room_type) == '28' ? 'selected="selected"' : ''  }}>Single</option>
					    <option value="29" {{ Input::old('room_type', $entry->room_type) == '29' ? 'selected="selected"' : ''  }}>Double</option>
					    <option value="30" {{ Input::old('room_type', $entry->room_type) == '30' ? 'selected="selected"' : ''  }}>Guest Rooms</option>
					    <option value="31" {{ Input::old('room_type', $entry->room_type) == '31' ? 'selected="selected"' : ''  }}>Accessible Rooms</option>
                    </select>
                    {{ $errors->first('room_type', '<span class="help-inline">:message</span>') }}
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

                         <div style="margin:5px;"> <img style="width:160px; height:160px;" src="{{ asset('assets/img/uploads/hotels') }}/{{ Input::old('uploaded_file', $entry->photo) }}"></div>

                        <input type="file" name="uploaded_file">
                        {{ $errors->first('uploaded_file', '<span class="help-inline">:message</span>') }}
                    </div>
                </div>

                <div id="append" class="control-group">
                    <input type="hidden" id="inc" name="inc" value="0">
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

                            <div style="margin:5px;"> <img src="{{ asset('assets/img/uploads/hotels') }}/{{ Input::old('uploaded_file', $multiple_image->thumb) }}"></div>

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

			<legend>Showroom Information</legend>

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
                        <option {{ Input::old('area_city', $entry->area_city) == $city->city ? 'selected="selected"' : ''  }} >{{ $city->city }}</option>
                    @endforeach
                    </select>

                    {{ $errors->first('area_city', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!--Location of Hotel -->
            <div class="control-group {{ $errors->has('location_of_hotel') ? 'error' : '' }}">
				<label class="control-label">Location of Hotel</label>
				<div class="controls">

                <select name="location_of_hotel">
                    @foreach($cities as $city)
                        <option {{ Input::old('location_of_hotel', $entry->location_of_hotel) == $city->city ? 'selected="selected"' : ''  }} >{{ $city->city }}</option>
                    @endforeach
                </select>
					{{ $errors->first('location_of_hotel', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!--Hotel Building Name -->
            <div class="control-group {{ $errors->has('building_name') ? 'error' : '' }}">
				<label class="control-label">Hotel Building Name</label>
				<div class="controls">
					<input type="text" name="building_name" value="{{ Input::old('building_name', $entry->building_name) }}" />
					{{ $errors->first('building_name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!--Hotel Building Number -->
            <div class="control-group {{ $errors->has('building_number') ? 'error' : '' }}">
				<label class="control-label">Hotel Building Number</label>
				<div class="controls">
					<input type="text" name="building_number" value="{{ Input::old('building_number', $entry->building_number) }}" />
					{{ $errors->first('building_number', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Hotel Telephone -->
            <div class="control-group {{ $errors->has('telephone') ? 'error' : '' }}">
				<label class="control-label">Hotel Telephone</label>
				<div class="controls">
					<input type="text" name="telephone" value="{{ Input::old('telephone', $entry->telephone) }}" />
					{{ $errors->first('telephone', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Hotel Fax -->
            <div class="control-group {{ $errors->has('fax') ? 'error' : '' }}">
				<label class="control-label">Hotel Fax</label>
				<div class="controls">
					<input type="text" name="fax" value="{{ Input::old('fax', $entry->fax) }}" />
					{{ $errors->first('fax', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Hotel's Email Address -->
            <div class="control-group {{ $errors->has('hotels_email_address') ? 'error' : '' }}">
				<label class="control-label">Hotel's Email Address</label>
				<div class="controls">
					<input type="text" name="hotels_email_address" value="{{ Input::old('hotels_email_address', $entry->hotels_email_address) }}" />
					{{ $errors->first('hotels_email_address', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Post Code -->
            <div class="control-group {{ $errors->has('post_code') ? 'error' : '' }}">
				<label class="control-label">Post Code</label>
				<div class="controls">
					<input type="text" name="post_code" value="{{ Input::old('post_code', $entry->post_code) }}" />
					{{ $errors->first('post_code', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Address -->
            <div class="control-group {{ $errors->has('address') ? 'error' : '' }}">
				<label class="control-label">Address</label>
				<div class="controls">
					<input type="text" name="address" value="{{ Input::old('address', $entry->address) }}" />
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
                    <input name="stock" style="width:160px" type="text" value="{{ Input::old('stock', $entry->stock) }}"> 
                    {{ $errors->first('stock', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Effective From -->
            <div class="control-group {{ $errors->has('effective_from') ? 'error' : '' }}">
                <label class="control-label" for="country">Effective From </label>
                <div class="controls">
                    <input name="effective_from" type="text" value="{{ Input::old('effective_from', $entry->effective_from) }}" id="datepicker1" class="ui-datepicker">                 
                    {{ $errors->first('effective_from', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Expire On -->
            <div class="control-group {{ $errors->has('expire_on') ? 'error' : '' }}">
                <label class="control-label" for="country">Expire On</label>
                <div class="controls">
                    <input name="expire_on" id="datepicker2" style="width:160px" type="text" value="{{ Input::old('expire_on', $entry->expire_on) }}"> 
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
                    <input name="distance_from_airport" style="width:160px" type="text" value="{{ Input::old('distance_from_airport', $entry->distance_from_airport) }}"> 
                    {{ $errors->first('distance_from_airport', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Distance From City/Market -->
            <div class="control-group {{ $errors->has('distance_from_city_market') ? 'error' : '' }}">
                <label class="control-label" for="country">Distance From City/Market</label>
                <div class="controls">
                    <input name="distance_from_city_market" style="width:160px" type="text" value="{{ Input::old('distance_from_city_market', $entry->distance_from_city_market) }}"> 
                    {{ $errors->first('distance_from_city_market', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Pet Allow -->
            <div class="control-group {{ $errors->has('pet_allow') ? 'error' : '' }}">
                <label class="control-label">Pet Allow</label>
                <div class="controls">
                    <select type="text" name="pet_allow" value="{{ Input::old('pet_allow') }}">
                        <option {{ Input::old('pet_allow', $entry->pet_allow) == 'Allowed' ? 'selected="selected"' : ''  }} >Allowed</option>			   
                        <option {{ Input::old('pet_allow', $entry->pet_allow) == 'Not Allowed' ? 'selected="selected"' : ''  }} >Not Allowed</option>			   
                    </select>
                    {{ $errors->first('pet_allow', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Payment Option -->
            <div class="control-group {{ $errors->has('payment_option') ? 'error' : '' }}">
                <label class="control-label" for="country">Payment Option</label>
                <div class="controls">
                    <input name="payment_option" style="width:160px" type="text" value="{{ Input::old('payment_option', $entry->payment_option) }}"> 
                    {{ $errors->first('payment_option', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
      

            <!-- Internet Information -->
            <div class="control-group {{ $errors->has('internet_information') ? 'error' : '' }}">
                <label class="control-label" for="country">Internet Information</label>
                <div class="controls">
                    <input name="internet_information" style="width:160px" type="text" value="{{ Input::old('internet_information',$entry->internet_information) }}"> 
                    {{ $errors->first('internet_information', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Parking Information -->
            <div class="control-group {{ $errors->has('parking_information') ? 'error' : '' }}">
                <label class="control-label" for="country">Parking Information</label>
                <div class="controls">
                    <input name="parking_information" style="width:160px" type="text" value="{{ Input::old('parking_information, $entry->parking_information') }}"> 
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

            <!-- Payment Description -->
            <div class="control-group {{ $errors->has('payment_description') ? 'error' : '' }}">
                <label class="control-label" for="country">Payment Description</label>
                <div class="controls">
                    <textarea class="ckeditor" name="payment_description"> {{ Input::old('payment_description', $entry->payment_description) }}</textarea> 
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

        <div class="well">

        	<legend>Profile Information</legend>

        	<!-- Information -->
            <div class="control-group {{ $errors->has('information') ? 'error' : '' }}">
                <label class="control-label">Information</label>
                <div class="controls">
                    <textarea class="ckeditor" name="information"> {{ Input::old('information', $entry->information) }}</textarea> 
                    {{ $errors->first('information', '<span class="help-inline">:message</span>') }}
                </div>
            </div> 

            <!-- General Information -->
            <div class="control-group {{ $errors->has('general_information') ? 'error' : '' }}">
                <label class="control-label" for="country">General Information</label>
                <div class="controls">
                    <textarea class="ckeditor" name="general_information"> {{ Input::old('general_information', $entry->general_information) }}</textarea> 
                    {{ $errors->first('general_information', '<span class="help-inline">:message</span>') }}
                </div>
            </div> 

            <!-- Services -->
            <div class="control-group {{ $errors->has('services') ? 'error' : '' }}">
                <label class="control-label" for="country">Services</label>
                <div class="controls">
                    <textarea class="ckeditor" name="services"> {{ Input::old('services', $entry->services) }}</textarea> 
                    {{ $errors->first('services', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Surroundings Information -->
            <div class="control-group {{ $errors->has('surroundings_information') ? 'error' : '' }}">
                <label class="control-label" for="country">Surroundings Information</label>
                <div class="controls">
                    <textarea class="ckeditor" name="surroundings_information"> {{ Input::old('surroundings_information', $entry->surroundings_information) }}</textarea> 
                    {{ $errors->first('surroundings_information', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Other Information -->
            <div class="control-group {{ $errors->has('other_information') ? 'error' : '' }}">
                <label class="control-label" for="country">Other Information</label>
                <div class="controls">
                    <textarea class="ckeditor" name="other_information"> {{ Input::old('other_information', $entry->other_information) }}</textarea> 
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
                    <textarea class="ckeditor" name="policies"> {{ Input::old('policies', $entry->policies) }}</textarea> 
                    {{ $errors->first('policies', '<span class="help-inline">:message</span>') }}
                </div>
            </div> 

            <!-- Terms & Condition -->
            <div class="control-group {{ $errors->has('terms_and_conditions') ? 'error' : '' }}">
                <label class="control-label" for="country">Terms &amp; Condition</label>
                <div class="controls">
                    <textarea class="ckeditor" name="terms_and_conditions"> {{ Input::old('terms_and_conditions', $entry->terms_and_conditions) }}</textarea> 
                    {{ $errors->first('terms_and_conditions', '<span class="help-inline">:message</span>') }}
                </div>
            </div> 

            <!-- Privacy Policy -->
            <div class="control-group {{ $errors->has('privacy_policy') ? 'error' : '' }}">
                <label class="control-label" for="country">Privacy Policy</label>
                <div class="controls">
                    <textarea class="ckeditor" name="privacy_policy"> {{ Input::old('privacy_policy', $entry->privacy_policy) }}</textarea> 
                    {{ $errors->first('privacy_policy', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <!-- Cancellation Policy -->
            <div class="control-group {{ $errors->has('cancellation_policy') ? 'error' : '' }}">
                <label class="control-label" for="country">Cancellation Policy</label>
                <div class="controls">
                    <textarea class="ckeditor" name="cancellation_policy"> {{ Input::old('cancellation_policy', $entry->cancellation_policy) }}</textarea> 
                    {{ $errors->first('cancellation_policy', '<span class="help-inline">:message</span>') }}
                </div>
            </div>
        </div>

		<div class="well">

			<legend> Hotel Property Options </legend>

			<div class="control-group pull-left {{ $errors->has('ada_accessible') ? 'error' : '' }}">
				<label class="control-label" >ADA Accessible</label>
				<div class="controls">
					<input type="checkbox" name="ada_accessible" {{ $entry->ada_accessible == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('ada_accessible', '<span class="help-inline">:message</span>') }}
				</div>
			</div> 

			<div class="control-group pull-left {{ $errors->has('adults_only') ? 'error' : '' }}">
				<label class="control-label" >Adults Only</label>
				<div class="controls">
					<input type="checkbox" name="adults_only" {{ $entry->adults_only == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('adults_only', '<span class="help-inline">:message</span>') }}
				</div>
			</div> 

			<div class="control-group pull-left {{ $errors->has('airport_shuttle') ? 'error' : '' }}">
				<label class="control-label" >Airport Shuttle</label>
				<div class="controls">
					<input type="checkbox" name="airport_shuttle" {{ $entry->airport_shuttle == 1 ? 'checked="checked"' : '' }}  />
					{{ $errors->first('airport_shuttle', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('beach_front') ? 'error' : '' }}">
				<label class="control-label" >Beach Front</label>
				<div class="controls">
					<input type="checkbox" name="beach_front" {{ $entry->beach_front == 1 ? 'checked="checked"' : '' }}  />
					{{ $errors->first('beach_front', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('breakfast') ? 'error' : '' }}">
				<label class="control-label" >Breakfast</label>
				<div class="controls">
					<input type="checkbox" name="breakfast" {{ $entry->breakfast == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('breakfast', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('business_center') ? 'error' : '' }}">
				<label class="control-label" >Business Center</label>
				<div class="controls">
					<input type="checkbox" name="business_center" {{ $entry->business_center == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('business_center', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('business_ready') ? 'error' : '' }}">
				<label class="control-label" >Business Ready</label>
				<div class="controls">
					<input type="checkbox" name="business_ready" {{ $entry->business_ready == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('business_ready', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('car_rental_counter') ? 'error' : '' }}">
				<label class="control-label" >Car Rental Counter</label>
				<div class="controls">
					<input type="checkbox" name="car_rental_counter" {{ $entry->car_rental_counter == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('car_rental_counter', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('conventions') ? 'error' : '' }}">
				<label class="control-label" >Conventions</label>
				<div class="controls">
					<input type="checkbox" name="conventions" {{ $entry->conventions == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('conventions', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('dataport') ? 'error' : '' }}">
				<label class="control-label" >Dataport</label>
				<div class="controls">
					<input type="checkbox" name="dataport" {{ $entry->dataport == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('dataport', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('dining') ? 'error' : '' }}">
				<label class="control-label" >Dining</label>
				<div class="controls">
					<input type="checkbox" name="dining" {{ $entry->dining == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('dining', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('dry_clean') ? 'error' : '' }}">
				<label class="control-label" >Dry Clean</label>
				<div class="controls">
					<input type="checkbox" name="dry_clean" {{ $entry->dry_clean == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('dry_clean', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('eco_certified') ? 'error' : '' }}">
				<label class="control-label" >Eco Certified</label>
				<div class="controls">
					<input type="checkbox" name="eco_certified" {{ $entry->eco_certified == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('eco_certified', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('executive_floors') ? 'error' : '' }}">
				<label class="control-label" >Executive Floors</label>
				<div class="controls">
					<input type="checkbox" name="executive_floors" {{ $entry->executive_floors == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('executive_floors', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('family_plan') ? 'error' : '' }}">
				<label class="control-label" >Family Plan</label>
				<div class="controls">
					<input type="checkbox" name="family_plan" {{ $entry->family_plan == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('family_plan', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('fitness_center') ? 'error' : '' }}">
				<label class="control-label" >Fitness Center</label>
				<div class="controls">
					<input type="checkbox" name="fitness_center" {{ $entry->fitness_center == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('fitness_center', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('free_local_calls') ? 'error' : '' }}">
				<label class="control-label" >Free Local Calls</label>
				<div class="controls">
					<input type="checkbox" name="free_local_calls" {{ $entry->free_local_calls == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('free_local_calls', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('free_parking') ? 'error' : '' }}">
				<label class="control-label" >Free Parking</label>
				<div class="controls">
					<input type="checkbox" name="free_parking" {{ $entry->free_parking == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('free_parking', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('free_shuttle') ? 'error' : '' }}">
				<label class="control-label" >Free Shuttle</label>
				<div class="controls">
					<input type="checkbox" name="free_shuttle" {{ $entry->free_shuttle == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('free_shuttle', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('free_wifi_in_meeting_rooms') ? 'error' : '' }}">
				<label class="control-label" >Free Wifi In Meeting Rooms</label>
				<div class="controls">
					<input type="checkbox" name="free_wifi_in_meeting_rooms" {{ $entry->free_wifi_in_meeting_rooms == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('free_wifi_in_meeting_rooms', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('free_wifi_in_public_spaces') ? 'error' : '' }}">
				<label class="control-label" >Free Wifi In Public Spaces</label>
				<div class="controls">
					<input type="checkbox" name="free_wifi_in_public_spaces" {{ $entry->free_wifi_in_public_spaces == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('free_wifi_in_public_spaces', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('free_wifi_in_rooms') ? 'error' : '' }}">
				<label class="control-label" >Free Wifi In Rooms</label>
				<div class="controls">
					<input type="checkbox" name="free_wifi_in_rooms" {{ $entry->free_wifi_in_rooms == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('free_wifi_in_rooms', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('full_service_spa') ? 'error' : '' }}">
				<label class="control-label" >Full Service Spa</label>
				<div class="controls">
					<input type="checkbox" name="full_service_spa" {{ $entry->full_service_spa == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('full_service_spa', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('game_facilities') ? 'error' : '' }}">
				<label class="control-label" >Game Facilities</label>
				<div class="controls">
					<input type="checkbox" name="game_facilities" {{ $entry->game_facilities == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('game_facilities', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('golf') ? 'error' : '' }}">
				<label class="control-label" >Golf</label>
				<div class="controls">
					<input type="checkbox" name="golf" {{ $entry->golf == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('golf', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('govt_safety_fire') ? 'error' : '' }}">
				<label class="control-label" >Govt Safety Fire</label>
				<div class="controls">
					<input type="checkbox" name="govt_safety_fire" {{ $entry->govt_safety_fire == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('govt_safety_fire', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('high_speed_internet') ? 'error' : '' }}">
				<label class="control-label" >High Speed Internet</label>
				<div class="controls">
					<input type="checkbox" name="high_speed_internet" {{ $entry->high_speed_internet == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('high_speed_internet', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('hypoallergenic_rooms') ? 'error' : '' }}">
				<label class="control-label" >Hypoallergenic Rooms</label>
				<div class="controls">
					<input type="checkbox" name="hypoallergenic_rooms" {{ $entry->hypoallergenic_rooms == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('hypoallergenic_rooms', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('indoor_pool') ? 'error' : '' }}">
				<label class="control-label" >Indoor Pool</label>
				<div class="controls">
					<input type="checkbox" name="indoor_pool" {{ $entry->indoor_pool == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('indoor_pool', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('ind_pet_restriction') ? 'error' : '' }}">
				<label class="control-label" >Ind Pet Restriction</label>
				<div class="controls">
					<input type="checkbox" name="ind_pet_restriction" {{ $entry->ind_pet_restriction == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('ind_pet_restriction', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('in_room_coffee_tea') ? 'error' : '' }}">
				<label class="control-label" >In Room Coffee Tea </label>
				<div class="controls">
					<input type="checkbox" name="in_room_coffee_tea" {{ $entry->in_room_coffee_tea == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('in_room_coffee_tea', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('in_room_mini_bar') ? 'error' : '' }}">
				<label class="control-label" >In Room Mini Bar</label>
				<div class="controls">
					<input type="checkbox" name="in_room_mini_bar" {{ $entry->in_room_mini_bar == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('in_room_mini_bar', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('in_room_refrigerator') ? 'error' : '' }}">
				<label class="control-label" >In Room Refrigerator</label>
				<div class="controls">
					<input type="checkbox" name="in_room_refrigerator" {{ $entry->in_room_refrigerator == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('in_room_refrigerator', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('in_room_safe') ? 'error' : '' }}">
				<label class="control-label" >In Room Safe </label>
				<div class="controls">
					<input type="checkbox" name="in_room_safe" {{ $entry->in_room_safe == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('in_room_safe', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('interior_doorways') ? 'error' : '' }}">
				<label class="control-label" >Interior Doorways </label>
				<div class="controls">
					<input type="checkbox" name="interior_doorways" {{ $entry->interior_doorways == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('interior_doorways', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('jacuzzi') ? 'error' : '' }}">
				<label class="control-label" >Jacuzzi</label>
				<div class="controls">
					<input type="checkbox" name="jacuzzi" {{ $entry->jacuzzi == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('jacuzzi', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('kids_facilities') ? 'error' : '' }}">
				<label class="control-label" >Kids Facilities</label>
				<div class="controls">
					<input type="checkbox" name="kids_facilities" {{ $entry->kids_facilities == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('kids_facilities', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('kitchen_facilities') ? 'error' : '' }}">
				<label class="control-label" >Kitchen Facilities</label>
				<div class="controls">
					<input type="checkbox" name="kitchen_facilities" {{ $entry->kitchen_facilities == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('kitchen_facilities', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('meal_service') ? 'error' : '' }}">
				<label class="control-label" >Meal Service</label>
				<div class="controls">
					<input type="checkbox" name="meal_service" {{ $entry->meal_service == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('meal_service', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('meeting_facilities') ? 'error' : '' }}">
				<label class="control-label" >Meeting Facilities</label>
				<div class="controls">
					<input type="checkbox" name="meeting_facilities" {{ $entry->meeting_facilities == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('meeting_facilities', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('no_adult_tv') ? 'error' : '' }}">
				<label class="control-label" >No Adult TV</label>
				<div class="controls">
					<input type="checkbox" name="no_adult_tv" {{ $entry->no_adult_tv == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('no_adult_tv', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('non_smoking') ? 'error' : '' }}">
				<label class="control-label" >Non Smoking</label>
				<div class="controls">
					<input type="checkbox" name="non_smoking" {{ $entry->non_smoking == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('non_smoking', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('outdoor_pool') ? 'error' : '' }}">
				<label class="control-label" >Outdoor Pool</label>
				<div class="controls">
					<input type="checkbox" name="outdoor_pool" {{ $entry->outdoor_pool == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('outdoor_pool', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('parking') ? 'error' : '' }}">
				<label class="control-label" >Parking</label>
				<div class="controls">
					<input type="checkbox" name="parking" {{ $entry->parking == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('parking', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('pets') ? 'error' : '' }}">
				<label class="control-label" >Pets</label>
				<div class="controls">
					<input type="checkbox" name="pets" {{ $entry->pets == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('pets', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('pool') ? 'error' : '' }}">
				<label class="control-label" >Pool</label>
				<div class="controls">
					<input type="checkbox" name="pool" {{ $entry->pool == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('pool', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('public_transportation_adjacent') ? 'error' : '' }}">
				<label class="control-label" >Public Transportation Adjacent </label>
				<div class="controls">
					<input type="checkbox" name="public_transportation_adjacent" {{ $entry->public_transporation_adjacent == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('public_transportation_adjacent', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('recreation') ? 'error' : '' }}">
				<label class="control-label" >Recreation</label>
				<div class="controls">
					<input type="checkbox" name="recreation" {{ $entry->recreation == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('recreation', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('restricted_room_access') ? 'error' : '' }}">
				<label class="control-label" >Restricted Room Access </label>
				<div class="controls">
					<input type="checkbox" name="restricted_room_access" {{ $entry->restricted_room_access == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('restricted_room_access', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('room_service') ? 'error' : '' }}">
				<label class="control-label" >Room Service</label>
				<div class="controls">
					<input type="checkbox" name="room_service" {{ $entry->room_service == 1 ? 'checked="checked"' : '' }}  />
					{{ $errors->first('room_service', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('room_service_24_hours') ? 'error' : '' }}">
				<label class="control-label" >Room Service 24 Hours</label>
				<div class="controls">
					<input type="checkbox" name="room_service_24_hours" {{ $entry->room_service_24_hours == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('room_service_24_hours', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('rooms_with_balcony') ? 'error' : '' }}">
				<label class="control-label" >Rooms With Balcony </label>
				<div class="controls">
					<input type="checkbox" name="rooms_with_balcony" {{ $entry->rooms_with_balcony == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('rooms_with_balcony', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('ski_in_out_property') ? 'error' : '' }}">
				<label class="control-label" >Ski In Out Property</label>
				<div class="controls">
					<input type="checkbox" name="ski_in_out_property" {{ $entry->ski_in_out_property == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('ski_in_out_property', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('smoke_free') ? 'error' : '' }}">
				<label class="control-label" >Smoke Free</label>
				<div class="controls">
					<input type="checkbox" name="smoke_free" {{ $entry->smoke_free == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('smoke_free', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('smoking_rooms_avail') ? 'error' : '' }}">
				<label class="control-label" >Smoking Rooms Avail </label>
				<div class="controls">
					<input type="checkbox" name="smoking_rooms_avail" {{ $entry->smoking_rooms_avail == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('smoking_rooms_avail', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('tennis') ? 'error' : '' }}">
				<label class="control-label" >Tennis</label>
				<div class="controls">
					<input type="checkbox" name="tennis" {{ $entry->tennis == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('tennis', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('water_purification_system') ? 'error' : '' }}">
				<label class="control-label" >Water Purification System</label>
				<div class="controls">
					<input type="checkbox" name="water_purification_system" {{ $entry->water_purification_system == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('water_purification_system', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('wheelchair') ? 'error' : '' }}">
				<label class="control-label" >Wheelchair</label>
				<div class="controls">
					<input type="checkbox" name="wheelchair" {{ $entry->wheelchair == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('wheelchair', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('all_inclusive') ? 'error' : '' }}">
				<label class="control-label" >All Inclusive</label>
				<div class="controls">
					<input type="checkbox" name="all_inclusive" {{ $entry->all_inclusive == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('all_inclusive', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('apartments') ? 'error' : '' }}">
				<label class="control-label" >Apartments</label>
				<div class="controls">
					<input type="checkbox" name="apartments" {{ $entry->apartments == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('apartments', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('bed_breakfast') ? 'error' : '' }}">
				<label class="control-label" >Bed Breakfast</label>
				<div class="controls">
					<input type="checkbox" name="bed_breakfast" {{ $entry->bed_breakfast == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('bed_breakfast', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('castle') ? 'error' : '' }}">
				<label class="control-label" >Castle</label>
				<div class="controls">
					<input type="checkbox" name="castle" {{ $entry->castle == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('castle', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('economy') ? 'error' : '' }}">
				<label class="control-label" >Economy</label>
				<div class="controls">
					<input type="checkbox" name="economy" {{ $entry->economy == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('economy', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('extended_stay') ? 'error' : '' }}">
				<label class="control-label" >Extended Stay</label>
				<div class="controls">
					<input type="checkbox" name="extended_stay" {{ $entry->extended_stay == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('extended_stay', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('farm') ? 'error' : '' }}">
				<label class="control-label" >Farm</label>
				<div class="controls">
					<input type="checkbox" name="farm" {{ $entry->farm == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('farm', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('first') ? 'error' : '' }}">
				<label class="control-label" >First</label>
				<div class="controls">
					<input type="checkbox" name="first" {{ $entry->first == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('first', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('luxury') ? 'error' : '' }}">
				<label class="control-label" >Luxury</label>
				<div class="controls">
					<input type="checkbox" name="luxury" {{ $entry->luxury == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('luxury', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('moderate') ? 'error' : '' }}">
				<label class="control-label" >Moderate</label>
				<div class="controls">
					<input type="checkbox" name="moderate" {{ $entry->moderate == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('moderate', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('motel') ? 'error' : '' }}">
				<label class="control-label" >Motel</label>
				<div class="controls">
					<input type="checkbox" name="motel" {{ $entry->motel == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('motel', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('resort') ? 'error' : '' }}">
				<label class="control-label" >Resort</label>
				<div class="controls">
					<input type="checkbox" name="resort" {{ $entry->resort == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('resort', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<div class="control-group pull-left {{ $errors->has('suites') ? 'error' : '' }}">
				<label class="control-label" >Suites</label>
				<div class="controls">
					<input type="checkbox" name="suites" {{ $entry->suites == 1 ? 'checked="checked"' : '' }} />
					{{ $errors->first('suites', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<br clear="all">
		</div>

		<!-- attractions -->
		<div class="well">

			<legend> Hotel Attractions </legend>

      		

			<div id="append_attraction" class="control-group">
                    <?php 
                    $attraction_array = json_decode($entry->attractions); 
                    $count = count($attraction_array);   
                    $attractions_index = [];
                    foreach($attraction_array as $key => $value) {
                    	array_push($attractions_index, 'attraction_'. ($key+1));
                    }           
                    ?>
                    <input type="hidden" id="incr" name="incr" value="{{ $count }}">
                    <input type="hidden" id="attractions_json" name="attractions_json" value='{{ json_encode($attractions_index) }}'>

                    <div class="controls">
                    <div id="add_attraction" class="btn btn-mini btn-info" style="margin-bottom:12px;">Add More Attractions</div>
                    </div>

                    @if($count > 0)
	                    @foreach($attraction_array as $key => $value)
	                        <div class="control-group {{ $errors->has('attraction_' . ($key+1)) ? 'error' : '' }}">
	                            <label class="control-label">Hotel Attraction</label>
	                            <div class="controls">
	                            <input type="text" name="attraction_{{($key+1)}}" value="{{ Input::old('attraction_' . ($key+1), $value) }}" style="width:800px;">
	                                {{ $errors->first('attraction_' . ($key+1), '<span class="help-inline">:message</span>') }}
	                            </div>
	                        </div>
	                    @endforeach

                	@else
                		<div class="control-group {{ $errors->has('attraction_1') ? 'error' : '' }}">
							<label class="control-label">Hotel Attraction</label>
							<div class="controls">
			          		<input type="text" name="attraction_1" style="width:800px;" placeholder="100km from Airport">
								{{ $errors->first('attraction_1', '<span class="help-inline">:message</span>') }}
							</div>
						</div>
	                @endif
                </div>
		</div> 
		<!-- /attractions -->
                                               
	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('hotels') }}">Back</a>

			<button type="reset" class="btn">Reset</button>

			<button type="submit" class="btn btn-success">Edit Hotel</button>
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

        attractions_json = $('#attractions_json').val();

        attractions_array = JSON.parse(attractions_json);

        if(attractions_array.length > 0) {
        	attractions = attractions_array;
        } else {
        	attractions = ['attraction_1'];
        }

        incr = parseInt($('#incr').val());  			

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

	    	parentid = $(this).parent().attr('id');

	    	index = attractions.indexOf(parentid);

	    	if (index > -1) {
			    attractions.splice(index, 1);
			}

	    	newjson = JSON.stringify(attractions);
            $('#attractions_json').val(newjson);
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
                $('select[name="location_of_hotel"]').html(cities);
              
                //alert("Load was performed.");
            });
        }); 
        // End of Get State/Cities

    });
</script>

<script src="{{asset('ckeditor')}}/ckeditor.js"></script>


@stop