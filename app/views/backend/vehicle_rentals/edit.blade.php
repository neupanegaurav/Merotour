@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Edit Vehicle Rental ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
           
            	Edit Vehicle Rental
 

            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Vehicle Rental
			        <span class="icon-angle-right"></span>
			    </li>			             

                <li>
		          Edit Vehicle Rental                          
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
                            <legend>Vehicle Info</legend>

                            <!-- Vehicle Name -->
                            <div class="control-group {{ $errors->has('name') ? 'error' : '' }}">
                                <label class="control-label" for="name">Vehicle Name</label>
                                <div class="controls">
                                    <input type="text" name="name" id="name" value="{{ Input::old('name', $entry->name) }}" />
                                    {{ $errors->first('name', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Type of Service -->
                            <div class="control-group {{ $errors->has('type_of_service') ? 'error' : '' }}">
                                <label class="control-label">Type of Service</label>
                                <div class="controls">
                                    <select type="text" name="type_of_service">
                                        <option value="Ride TO the airport" {{ Input::old('type_of_service', $entry->type_of_service) == 'Ride TO the airport' ? 'selected="selected"' : ''  }}>Ride TO the airport</option>
                                        <option value="Ride FROM the airport" {{ Input::old('type_of_service', $entry->type_of_service) == 'Ride FROM the airport' ? 'selected="selected"' : ''  }} >Ride FROM the airport</option>
                                        <option value="Hourly Service" {{ Input::old('type_of_service', $entry->type_of_service) == 'Hourly Service' ? 'selected="selected"' : ''  }} >Hourly Service</option>
                                        <option value="Door to Door Service" {{ Input::old('type_of_service', $entry->type_of_service) == 'Door to Door Service' ? 'selected="selected"' : ''  }} >Door to Door Service</option>
                                        <option value="Long Distance Service" {{ Input::old('type_of_service', $entry->type_of_service) == 'Long Distance Service' ? 'selected="selected"' : ''  }}>Long Distance Service</option>
                                    </select>
                                    {{ $errors->first('type_of_service', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Vehicle Type -->
                            <div class="control-group {{ $errors->has('vehicle_type') ? 'error' : '' }}">
                                <label class="control-label">Vehicle Type</label>
                                <div class="controls">
                                    <select type="text" name="vehicle_type">
                                        <option value="Green_Traveler_Collection" {{ Input::old('vehicle_type', $entry->vehicle_type) == 'Green_Traveler_Collection' ? 'selected="selected"' : ''  }}>Green Traveler Collection</option>
                                        <option value="Fun_Collection" {{ Input::old('vehicle_type', $entry->vehicle_type) == 'Fun_collection' ? 'selected="selected"' : ''  }}>Fun Collection</option>
                                        <option value="Prestige_Collection" {{ Input::old('vehicle_type', $entry->vehicle_type) == 'Prestige_Collection' ? 'selected="selected"' : ''  }}>Prestige Collection</option>
                                   </select>
                                    {{ $errors->first('vehicle_type', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Enabled -->
                            <div class="control-group {{ $errors->has('enabled') ? 'error' : '' }}">
                                <label class="control-label">Enabled</label>
                                <div class="controls">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-default">
                                            <input type="radio" name="enabled" value="1" {{ Input::old('enabled', $entry->enabled) == 1 ? 'checked="checked"' : '' }}>
                                        Yes 
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="enabled" value="0" {{ Input::old('enabled', $entry->enabled) == 0 ? 'checked="checked"' : '' }}>
                                        No 
                                        </label>
                                    </div> 
                                    {{ $errors->first('enabled', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <div class="control-group {{ $errors->has('short_description') ? 'error' : '' }}">
                                <label class="control-label">Short Description</label>
                                <div class="controls">
                                    <input type="text" name="short_description" value="{{ Input::old('short_description', $entry->short_description) }}" />
                                    {{ $errors->first('short_description', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>
                                        
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

                                     <div style="margin:5px;"> <img style="width:160px; height:160px;" src="{{ asset('assets/img/uploads/vehicle_rentals') }}/{{ Input::old('uploaded_file', $entry->photo) }}"></div>

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

                                        <div style="margin:5px;"> <img src="{{ asset('assets/img/uploads/vehicle_rentals') }}/{{ Input::old('uploaded_file', $multiple_image->thumb) }}"></div>

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
                            <legend>Price Information</legend>

                            <!--Price Per Day -->
                            <div class="control-group {{ $errors->has('price_per_day') ? 'error' : '' }}">
                                <label class="control-label">Price Per Day</label>
                                <div class="controls">
                                    <input type="text" name="price_per_day" value="{{ Input::old('price_per_day', $entry->price_per_day) }}" />
                                    {{ $errors->first('price_per_day', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!--Price Per Hour -->
                            <div class="control-group {{ $errors->has('price_per_hour') ? 'error' : '' }}">
                                <label class="control-label">Price Per Hour</label>
                                <div class="controls">
                                    <input type="text" name="price_per_hour" value="{{ Input::old('price_per_hour', $entry->price_per_hour) }}" />
                                    {{ $errors->first('price_per_hour', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!--Price Per Km -->
                            <div class="control-group {{ $errors->has('price_per_km') ? 'error' : '' }}">
                                <label class="control-label">Price Per Km</label>
                                <div class="controls">
                                    <input type="text" name="price_per_km" value="{{ Input::old('price_per_km', $entry->price_per_km) }}" />
                                    {{ $errors->first('price_per_km', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>
                           
                        </div>

                        <div class="well">

                            <legend>Address Information</legend>

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

                            <!-- Vehicle From -->
                            <div class="control-group {{ $errors->has('vehicle_from') ? 'error' : '' }}">
                                <label class="control-label">Vehicle From</label>
                                <div class="controls">
                                    <select type="text" name="vehicle_from">
                                        @foreach($cities as $city)
                                            <option {{ Input::old('vehicle_from', $entry->vehicle_from) == $city->city ? 'selected="selected"' : ''  }} >{{ $city->city }}</option>
                                        @endforeach
                                    </select>
                                    {{ $errors->first('vehicle_from', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!-- Vehicle To -->
                            <div class="control-group {{ $errors->has('vehicle_to') ? 'error' : '' }}">
                                <label class="control-label">Vehicle To</label>
                                <div class="controls">
                                    <select type="text" name="vehicle_to">
                                        @foreach($cities as $city)
                                            <option {{ Input::old('vehicle_to', $entry->vehicle_to) == $city->city ? 'selected="selected"' : ''  }} >{{ $city->city }}</option>
                                        @endforeach
                                    </select>
                                    {{ $errors->first('vehicle_to', '<span class="help-inline">:message</span>') }}
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

                        </div>



                        <div class="well">

                            <legend>Feature Information</legend>

                            <!--Passengers -->
                            <div class="control-group {{ $errors->has('passengers') ? 'error' : '' }}">
                                <label class="control-label">Passengers</label>
                                <div class="controls">
                                    <input type="text" name="passengers" value="{{ Input::old('passengers', $entry->passengers) }}" />
                                    {{ $errors->first('passengers', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!--Laege Suitcase -->
                            <div class="control-group {{ $errors->has('large_suitcase') ? 'error' : '' }}">
                                <label class="control-label">Laege Suitcase</label>
                                <div class="controls">
                                    <input type="text" name="large_suitcase" value="{{ Input::old('large_suitcase', $entry->large_suitcase) }}" />
                                    {{ $errors->first('large_suitcase', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!--Small Suitcase -->
                            <div class="control-group {{ $errors->has('small_suitcase') ? 'error' : '' }}">
                                <label class="control-label">Small Suitcase</label>
                                <div class="controls">
                                    <input type="text" name="small_suitcase" value="{{ Input::old('small_suitcase', $entry->small_suitcase) }}" />
                                    {{ $errors->first('small_suitcase', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <!--Amenities -->
                            <div class="control-group">
                                <label class="control-label">Amenities</label>
                                <div class="controls">

                                    <input type="checkbox" name="automatic_transmission" {{ ((Input::old('automatic_transmission') == 'on') or ($entry->automatic_transmission)) == 1 ? 'checked="checked"' : ''  }} >Automatic Transmission 
                                    <input type="checkbox" name="air_conditioning" {{ ((Input::old('air_conditioning') == 'on') or ($entry->air_conditioning == 1)) ? 'checked="checked"' : ''  }}>Air Conditioning
                                    <input type="checkbox" name="sixteen_km_per_liters" {{ ((Input::old('sixteen_km_per_liters') == 'on') or ($entry->sixteen_km_per_liters == 1)) ? 'checked="checked"' : ''  }}>16 km/liters  

                                </div>
                            </div>
                                    
                        </div>

                        <div class="well">
                            <legend>Information of Availabilities</legend>

                            <div class="control-group {{ $errors->has('stock') ? 'error' : '' }}">
                                <label class="control-label" >Stock</label>
                                <div class="controls">
                                    <input name="stock" style="width:160px" type="text" value="{{ Input::old('stock', $entry->stock) }}"> 
                                    {{ $errors->first('stock', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <div class="control-group {{ $errors->has('effective_from') ? 'error' : '' }}">
                                <label class="control-label" >Effective From </label>
                                <div class="controls">
                                    <input name="effective_from" type="text" value="{{ Input::old('effective_from', $entry->effective_from) }}" id="datepicker1" class="ui-datepicker">                 
                                    {{ $errors->first('effective_from', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

                            <div class="control-group {{ $errors->has('expire_on') ? 'error' : '' }}">
                                <label class="control-label" >Expire On</label>
                                <div class="controls">
                                    <input name="expire_on" id="datepicker2" style="width:160px" type="text" value="{{ Input::old('expire_on', $entry->expire_on) }}"> 
                                    {{ $errors->first('expire_on', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>
                            
                        </div>

                        <div class="well">
                            <legend>Discounts</legend>

                            <div class="control-group">
                                <label class="control-label">Discount Percentage (for Agents)</label>
                                <div class="controls">
                                    <input type="text" name="discount_percentage_agents"  value="{{ Input::old('discount_percentage_agents', $entry->discount_percentage_agents)}}" />
                                    {{ $errors->first('discount_percentage_agents', '<span class="help-inline">:message</span>') }}
                                </div>
                            </div>

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
                                <a class="btn btn-link" href="{{ route('vehicle_rentals') }}">Back</a>

                                <button type="reset" class="btn">Reset</button>

                                <button type="submit" class="btn btn-success">Edit Vehicle Rental</button>
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

        // Get State/Cities on change
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