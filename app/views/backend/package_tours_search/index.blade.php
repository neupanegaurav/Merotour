@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Package Tours Search ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Package Tours Search
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Package Tours Search
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
        

       <div id="tabs-4" class="tab clearfix" style="width:450px;" >
            <div class="detail">
                <form action="{{URL::route('searchbox1')}}" method="post">
                 
                    <div class="trip" style="display:block; height:20px;">
                        
                    </div>
                    
                    <!-- CSRF Token -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 
                    <input type="hidden" name="backend" value="1" /> 


                    <div class="location clearfix">
                        <div class="pull-left">
                            <label>Country</label>
                            <select name="country" id="country_id_T" class="medium">
                                <option value="1">Afghanistan</option><option value="2">Åland Islands</option><option value="3">Albania</option><option value="4">Algeria</option><option value="5">American Samoa</option><option value="6">Andorra</option><option value="7">Angola</option><option value="8">Anguilla</option><option value="9">Antarctica</option><option value="10">Antigua and Barbuda</option><option value="11">Argentina</option><option value="12">Armenia</option><option value="13">Aruba</option><option value="14">Australia</option><option value="15">Austria</option><option value="16">Azerbaijan</option><option value="17">Bahamas</option><option value="18">Bahrain</option><option value="19">Bangladesh</option><option value="20">Barbados</option><option value="21">Belarus</option><option value="22">Belgium</option><option value="23">Belize</option><option value="24">Benin</option><option value="25">Bermuda</option><option value="26">Bhutan</option><option value="27">Bolivia</option><option value="28">Bosnia and Herzegovina</option><option value="29">Botswana</option><option value="30">Bouvet Island</option><option value="31">Brazil</option><option value="32">British Indian Ocean territory</option><option value="33">Brunei Darussalam</option><option value="34">Bulgaria</option><option value="35">Burkina Faso</option><option value="36">Burundi</option><option value="37">Cambodia</option><option value="38">Cameroon</option><option value="39">Canada</option><option value="40">Cape Verde</option><option value="41">Cayman Islands</option><option value="42">Central African Republic</option><option value="43">Chad</option><option value="44">Chile</option><option value="45">China</option><option value="46">Christmas Island</option><option value="47">Cocos (Keeling) Islands</option><option value="48">Colombia</option><option value="49">Comoros</option><option value="50">Congo</option><option value="53">Cook Islands</option><option value="54">Costa Rica</option><option value="56">Croatia (Hrvatska)</option><option value="57">Cuba</option><option value="58">Cyprus</option><option value="59">Czech Republic</option><option value="52">Democratic Republic</option><option value="60">Denmark</option><option value="61">Djibouti</option><option value="62">Dominica</option><option value="63">Dominican Republic</option><option value="64">East Timor</option><option value="65">Ecuador</option><option value="66">Egypt</option><option value="67">El Salvador</option><option value="68">Equatorial Guinea</option><option value="69">Eritrea</option><option value="70">Estonia</option><option value="71">Ethiopia</option><option value="72">Falkland Islands</option><option value="73">Faroe Islands</option><option value="74">Fiji</option><option value="75">Finland</option><option value="76">France</option><option value="77">French Guiana</option><option value="78">French Polynesia</option><option value="79">French Southern Territories</option><option value="80">Gabon</option><option value="81">Gambia</option><option value="82">Georgia</option><option value="83">Germany</option><option value="84">Ghana</option><option value="85">Gibraltar</option><option value="86">Greece</option><option value="87">Greenland</option><option value="88">Grenada</option><option value="89">Guadeloupe</option><option value="90">Guam</option><option value="91">Guatemala</option><option value="92">Guinea</option><option value="93">Guinea-Bissau</option><option value="94">Guyana</option><option value="95">Haiti</option><option value="96">Heard and McDonald Islands</option><option value="97">Honduras</option><option value="98">Hong Kong</option><option value="99">Hungary</option><option value="100">Iceland</option><option value="101">India</option><option value="102">Indonesia</option><option value="103">Iran</option><option value="104">Iraq</option><option value="105">Ireland</option><option value="106">Israel</option><option value="107">Italy</option><option value="55">Ivoire (Ivory Coast)</option><option value="108">Jamaica</option><option value="109">Japan</option><option value="110">Jordan</option><option value="111">Kazakhstan</option><option value="112">Kenya</option><option value="113">Kiribati</option><option value="114">Korea (north)</option><option value="115">Korea (south)</option><option value="116">Kuwait</option><option value="117">Kyrgyzstan</option><option value="118">Lao People's Democratic Republic</option><option value="119">Latvia</option><option value="120">Lebanon</option><option value="121">Lesotho</option><option value="122">Liberia</option><option value="123">Libyan Arab Jamahiriya</option><option value="124">Liechtenstein</option><option value="125">Lithuania</option><option value="126">Luxembourg</option><option value="127">Macao</option><option value="128">Macedonia</option><option value="129">Madagascar</option><option value="130">Malawi</option><option value="131">Malaysia</option><option value="132">Maldives</option><option value="133">Mali</option><option value="134">Malta</option><option value="135">Marshall Islands</option><option value="136">Martinique</option><option value="137">Mauritania</option><option value="138">Mauritius</option><option value="139">Mayotte</option><option value="140">Mexico</option><option value="141">Micronesia</option><option value="142">Moldova</option><option value="143">Monaco</option><option value="144">Mongolia</option><option value="145">Montserrat</option><option value="146">Morocco</option><option value="147">Mozambique</option><option value="148">Myanmar</option><option value="149">Namibia</option><option value="150">Nauru</option><option value="151">Nepal</option><option value="152">Netherlands</option><option value="153">Netherlands Antilles</option><option value="154">New Caledonia</option><option value="155">New Zealand</option><option value="156">Nicaragua</option><option value="157">Niger</option><option value="158">Nigeria</option><option value="159">Niue</option><option value="160">Norfolk Island</option><option value="161">Northern Mariana Islands</option><option value="162">Norway</option><option value="163">Oman</option><option value="164">Pakistan</option><option value="165">Palau</option><option value="166">Palestinian Territories</option><option value="167">Panama</option><option value="168">Papua New Guinea</option><option value="169">Paraguay</option><option value="170">Peru</option><option value="171">Philippines</option><option value="172">Pitcairn</option><option value="173">Poland</option><option value="174">Portugal</option><option value="175">Puerto Rico</option><option value="176">Qatar</option><option value="177">Reacute union</option><option value="178">Romania</option><option value="179">Russian Federation</option><option value="180">Rwanda</option><option value="181">Saint Helena</option><option value="182">Saint Kitts and Nevis</option><option value="183">Saint Lucia</option><option value="184">Saint Pierre and Miquelon</option><option value="185">Saint Vincent and the Grenadines</option><option value="186">Samoa</option><option value="187">San Marino</option><option value="188">Sao Tome and Principe</option><option value="189">Saudi Arabia</option><option value="190">Senegal</option><option value="191">Serbia and Montenegro</option><option value="192">Seychelles</option><option value="193">Sierra Leone</option><option value="194">Singapore</option><option value="195">Slovakia</option><option value="196">Slovenia</option><option value="197">Solomon Islands</option><option value="198">Somalia</option><option value="199">South Africa</option><option value="200">South Georgia and the South Sandwich Islands</option><option value="51">South Sudan</option><option value="201">Spain</option><option value="202">Sri Lanka</option><option value="203">Sudan</option><option value="204">Suriname</option><option value="205">Svalbard and Jan Mayen Islands</option><option value="206">Swaziland</option><option value="207">Sweden</option><option value="208">Switzerland</option><option value="209">Syria</option><option value="210">Taiwan</option><option value="211">Tajikistan</option><option value="212">Tanzania</option><option value="213">Thailand</option><option value="214">Togo</option><option value="215">Tokelau</option><option value="216">Tonga</option><option value="217">Trinidad and Tobago</option><option value="218">Tunisia</option><option value="219">Turkey</option><option value="220">Turkmenistan</option><option value="221">Turks and Caicos Islands</option><option value="222">Tuvalu</option><option value="223">Uganda</option><option value="224">Ukraine</option><option value="225" selected="selected">United Arab Emirates</option><option value="226">United Kingdom</option><option value="227">United States of America</option><option value="228">Uruguay</option><option value="229">Uzbekistan</option><option value="230">Vanuatu</option><option value="231">Vatican City(Holy See)</option><option value="232">Venezuela</option><option value="233">Vietnam</option><option value="234">Virgin Islands (British)</option><option value="235">Virgin Islands (US)</option><option value="236">Wallis and Futuna Islands</option><option value="237">Western Sahara</option><option value="238">Yemen</option><option value="239">Zaire</option><option value="240">Zambia</option><option value="241">Zimbabwe</option> 
                            </select>
                        </div>
                        <div class="pull-right">
                            <label class="dst">Activities</label>
                            <input type="text" name="activities" >
                        </div>
                    </div>
                    

                    <div class="location clearfix">

                        <div class="pull-left">
                           
                            <label style="background:none;">Duration</label>
                            <input type="text" name="features" >
                       
                            
                        </div>
                        <div class="pull-right">
                            <div class="personss">
                                <div class="ad">
                                    <label>Area</label>
                                    <input type="text" name="area" >
                                </div>
                            
                            </div>
                        </div>
                    </div>

                    <div class="search">
                        <input type="submit" name="search" value="SEARCH" >
                    </div>
                </form>
            </div>
        </div>

			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>
         

@stop


@section('currentpagejs')

 <script type="text/javascript">
     $(document).ready(function() {

        $("#domestic").on('click', function() {
    
            $("#h4").text('Domestic Package Tours Search');
            
            $(".sectorFromIntl").hide();
            $("#sectorFrom").show();

            $(".sectorToIntl").hide();
            $("#sectorTo").show();

            $(".flight_date_intl").hide();
            $(".flight_date").show();

            $(".return_date_intl").hide();
            $(".return_date").show();

            $("#flight_form").attr("action", "{{URL::route('flightsearch')}}" );

            
    
        });
            
    
        $("#international").on('click', function() {
    
            $("#h4").text('International Package Tours Search');

            $("#sectorFrom").hide();
            $(".sectorFromIntl").show();

            $("#sectorTo").hide();
            $(".sectorToIntl").show();

            $(".flight_date").hide();
            $(".flight_date_intl").show();

            $(".return_date").hide();
            $(".return_date_intl").show();

            $("#flight_form").attr("action", "{{URL::route('flightsearchintl')}}" );

    
        });

        
     
        


    }); //Onload


</script>

@stop
