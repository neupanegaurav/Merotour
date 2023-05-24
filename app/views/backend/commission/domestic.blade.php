@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Domestic Commission ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Domestic Commission
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        Account
			                <span class="icon-angle-right"></span>
			            </li>
			             
			                        <li>Domestic Commission
			                                    
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

	<!-- Tabs -->
	<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-agent" data-toggle="tab">Agent</a></li>
			<li><a href="#tab-distributor" data-toggle="tab">Distributor</a></li>
	</ul>

	<!-- General tab -->
		<form class="form-horizontal" method="post" action="" autocomplete="off">
				<!-- CSRF Token -->
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />       
				

        <!-- Tabs Content -->
	<div class="tab-content">
		
		<div class="tab-pane active" id="tab-agent">

			<h4> Agent </h4>

				
				<table class="table table-bordered table-striped table-hover">
            		<thead>
		            	<tr>
		                                
		                                <th class="span2">
		                                <img style="width:40px; height:auto; vertical-align:middle;" src="{{asset('assets/img/buddha.jpg')}}" >
		                                Buddha Air
		                                </th>
		                                                  
		                </tr>
		                <tr>                               
		                                <th class="span2" rowspan="2">Sector</th>
		                                <th class="span2" colspan="6">Booking Class</th>
		                    
		                </tr>
		                <tr>                               
		                                <th class="span2">Y</th>
		                                <th class="span2">A</th>
		                                <th class="span2">B</th>
		                                <th class="span2">D</th>
		                                <th class="span2">C</th>
		                                <th class="span2">E</th>
		                    
		                </tr>
		            </thead>
            		<tbody>

            		@foreach($agent_buddha as $buddha)
            			<tr>
		                    <td>{{$buddha->sector_name}}</td>
		                    <td>
		                    	<div class="control-group{{ $errors->first('agent_buddha_'.$buddha->sector.'_y', ' error') }}">
									<div>
										<input style="width:100px;" type="text" name="agent_buddha_{{$buddha->sector}}_y" value="{{Input::old('agent_buddha_'.$buddha->sector.'_y', $buddha->y)}}" />
										{{ $errors->first('agent_buddha_'.$buddha->sector.'_y', '<span class="help-block">:message</span>') }}
									</div>
								</div>                    	
		                    </td>  

		                    <td>
		                    	<div class="control-group{{ $errors->first('agent_buddha_'.$buddha->sector.'_a', ' error') }}">
									<div>
										<input style="width:100px;" type="text" name="agent_buddha_{{$buddha->sector}}_a" value="{{Input::old('agent_buddha_'.$buddha->sector.'_a', $buddha->a)}}" />
										{{ $errors->first('agent_buddha_'.$buddha->sector.'_a', '<span class="help-block">:message</span>') }}
									</div>
								</div>                    	
		                    </td>


		                    <td>
		                    	<div class="control-group{{ $errors->first('agent_buddha_'.$buddha->sector.'_b', ' error') }}">
									<div>
										<input style="width:100px;" type="text" name="agent_buddha_{{$buddha->sector}}_b" value="{{Input::old('agent_buddha_'.$buddha->sector.'_b', $buddha->b)}}" />
										{{ $errors->first('agent_buddha_'.$buddha->sector.'_b', '<span class="help-block">:message</span>') }}
									</div>
								</div>
		                    </td>
		                    <td>
		                    	<div class="control-group{{ $errors->first('agent_buddha_'.$buddha->sector.'_d', ' error') }}">
									<div>
										<input style="width:100px;" type="text" name="agent_buddha_{{$buddha->sector}}_d" value="{{Input::old('agent_buddha_'.$buddha->sector.'_d', $buddha->d)}}" />
										{{ $errors->first('agent_buddha_'.$buddha->sector.'_d', '<span class="help-block">:message</span>') }}
									</div>
								</div> 	
		                    </td>
		                    <td>
		                    	<div class="control-group{{ $errors->first('agent_buddha_'.$buddha->sector.'_c', ' error') }}">
									<div>
										<input style="width:100px;" type="text" name="agent_buddha_{{$buddha->sector}}_c" value="{{Input::old('agent_buddha_'.$buddha->sector.'_c', $buddha->c)}}" />
										{{ $errors->first('agent_buddha_'.$buddha->sector.'_c', '<span class="help-block">:message</span>') }}
									</div>
								</div>	
		                    </td>

		                    <td>
		                    	<div class="control-group{{ $errors->first('agent_buddha_'.$buddha->sector.'_e', ' error') }}">
									<div>
										<input style="width:100px;" type="text" name="agent_buddha_{{$buddha->sector}}_e" value="{{Input::old('agent_buddha_'.$buddha->sector.'_e', $buddha->e)}}" />
										{{ $errors->first('agent_buddha_'.$buddha->sector.'_e', '<span class="help-block">:message</span>') }}
									</div>
								</div>
		                    </td>   
		                    
		                </tr>
            		@endforeach

		                
		            </tbody>
        		</table>

        		<style type="text/css">

        			#yeti td:nth-child(2), #yeti td:nth-child(3) { background-color: #F2DCDB; }
        			#yeti td:nth-child(4) { background-color: #FFFFCC; }
        			#yeti td:nth-child(5) { background-color: #D8E4BC; }



        		</style>

        		<table id="yeti" class="table table-bordered table-striped table-hover">
            		<thead>
		            	<tr>
		                                
		                                <th class="span2">Yeti Air</th>
		                                                  
		                </tr>
		                <tr>                               
		                                <th class="span2" rowspan="3">Sector</th>
		                                <th class="span2" colspan="10">Booking Class</th>
		                    
		                </tr>
		                <tr>                               
		                                <th class="span2" colspan="2" style="background-color: #F2DCDB;">Normal(N)</th>
		                                <th class="span2" rowspan="2" style="background-color: #FFFFCC;">Yellow(Y)</th>
		                                <th class="span2" rowspan="2" style="background-color: #D8E4BC;">Green(G)</th>
		                                <th class="span2" rowspan="2">Flanker(F)</th>
		                                <th class="span2" rowspan="2">Special(S)</th>
		                                <th class="span2" rowspan="2">Hotel(H)</th>
		                                <th class="span2" rowspan="2">Early(E)</th>
		                                <th class="span2" rowspan="2">Oscar(O)</th>
		                                <th class="span2" rowspan="2">Victor(V)</th>
		                    
		                </tr>
		                <tr>
  							<th class="span1" style="background-color: #F2DCDB;">NPR</th>
		                   	<th class="span1" style="background-color: #F2DCDB;">USD</th>		       
		                               
		                </tr>
		            </thead>
            		<tbody>

            		@foreach($agent_yeti as $yeti)

		                <tr>
		                    <td>{{$yeti->sector_name}}</td>
		                    <td><!-- N NPR -->
		                    	<div class="control-group{{ $errors->first('agent_yeti_'.$yeti->sector.'_n', ' error') }}">
									<div>
										<input style="width:40px;" type="text" name="{{ 'agent_yeti_'.$yeti->sector.'_n'}}" value="{{Input::old('agent_yeti_'.$yeti->sector.'_n', $yeti->n)}}" />
										{{ $errors->first('agent_yeti_'.$yeti->sector.'_n', '<span class="help-block">:message</span>') }}
									</div>
								</div>                    	
		                    </td> 

		                    <td><!-- N USD -->
		                    	<div class="control-group{{ $errors->first('agent_yeti_'.$yeti->sector.'_n_usd', ' error') }}">
									<div>
										<input style="width:40px;" type="text" name="{{ 'agent_yeti_'.$yeti->sector.'_n_usd'}}" value="{{Input::old('agent_yeti_'.$yeti->sector.'_n_usd', $yeti->n_usd)}}" />
										{{ $errors->first('agent_yeti_'.$yeti->sector.'_n_usd', '<span class="help-block">:message</span>') }}
									</div>
								</div>                    	
		                    </td>  

		                    <td><!-- Y -->
		                    	<div class="control-group{{ $errors->first('agent_yeti_'.$yeti->sector.'_y', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'agent_yeti_'.$yeti->sector.'_y'}}" value="{{Input::old('agent_yeti_'.$yeti->sector.'_y', $yeti->y)}}" />
										{{ $errors->first('agent_yeti_'.$yeti->sector.'_y', '<span class="help-block">:message</span>') }}
									</div>
								</div>                    	
		                    </td>


		                    <td><!-- G -->
		                    	<div class="control-group{{ $errors->first('agent_yeti_'.$yeti->sector.'_g', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'agent_yeti_'.$yeti->sector.'_g'}}" value="{{Input::old('agent_yeti_'.$yeti->sector.'_g', $yeti->g)}}" />
										{{ $errors->first('agent_yeti_'.$yeti->sector.'_g', '<span class="help-block">:message</span>') }}
									</div>
								</div>
		                    </td>
		                    <td><!-- F -->
		                    	<div class="control-group{{ $errors->first('agent_yeti_'.$yeti->sector.'_f', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'agent_yeti_'.$yeti->sector.'_f'}}" value="{{Input::old('agent_yeti_'.$yeti->sector.'_f', $yeti->f)}}" />
										{{ $errors->first('agent_yeti_'.$yeti->sector.'_f', '<span class="help-block">:message</span>') }}
									</div>
								</div> 	
		                    </td>
		                    <td><!-- S -->
		                    	<div class="control-group{{ $errors->first('agent_yeti_'.$yeti->sector.'_s', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'agent_yeti_'.$yeti->sector.'_s'}}" value="{{Input::old('agent_yeti_'.$yeti->sector.'_s', $yeti->s)}}" />
										{{ $errors->first('agent_yeti_'.$yeti->sector.'_s', '<span class="help-block">:message</span>') }}
									</div>
								</div>	
		                    </td>

		                    <td><!-- H -->
		                    	<div class="control-group{{ $errors->first('agent_yeti_'.$yeti->sector.'_h', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'agent_yeti_'.$yeti->sector.'_h'}}" value="{{Input::old('agent_yeti_'.$yeti->sector.'_h', $yeti->h)}}" />
										{{ $errors->first('agent_yeti_'.$yeti->sector.'_h', '<span class="help-block">:message</span>') }}
									</div>
								</div>
		                    </td>

		                    <td><!-- E -->
		                    	<div class="control-group{{ $errors->first('agent_yeti_'.$yeti->sector.'_e', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'agent_yeti_'.$yeti->sector.'_e'}}" value="{{Input::old('agent_yeti_'.$yeti->sector.'_e', $yeti->e)}}" />
										{{ $errors->first('agent_yeti_'.$yeti->sector.'_e', '<span class="help-block">:message</span>') }}
									</div>
								</div>
		                    </td> 

		                    <td><!-- O -->
		                    	<div class="control-group{{ $errors->first('agent_yeti_'.$yeti->sector.'_o', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'agent_yeti_'.$yeti->sector.'_o'}}" value="{{Input::old('agent_yeti_'.$yeti->sector.'_o', $yeti->o)}}" />
										{{ $errors->first('agent_yeti_'.$yeti->sector.'_o', '<span class="help-block">:message</span>') }}
									</div>
								</div>
		                    </td> 

		                    <td><!-- V -->
		                    	<div class="control-group{{ $errors->first('agent_yeti_'.$yeti->sector.'_v', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'agent_yeti_'.$yeti->sector.'_v'}}" value="{{Input::old('agent_yeti_'.$yeti->sector.'_v', $yeti->v)}}" />
										{{ $errors->first('agent_yeti_'.$yeti->sector.'_v', '<span class="help-block">:message</span>') }}
									</div>
								</div>
		                    </td>    
		                    
		                </tr>
		                @endforeach 

		                
		            </tbody>
        		</table>	


        		<table class="table table-bordered table-striped table-hover">
            		<thead>
		            	<tr>
		                                
		                                <th class="span2">Tara Air</th>
		                                                  
		                </tr>
		                <tr>                               
		                                <th class="span2" rowspan="2">Sector</th>
		                                <th class="span2" colspan="6">Commission</th>
		                    
		                </tr>
		                <tr>                               
		                                <th class="span2">NPR</th>
		                                <th class="span2">USD</th>
		                                <th class="span2">INR</th>
		                </tr>
		            </thead>



		            <tbody>

		            @foreach($agent_tara as $tara)

			            <tr>
			            	<td>
			            		{{$tara->sector_from}} - {{$tara->sector_to}}
			            	</td>

			            	<td>

			            		<div class="control-group{{ $errors->first('agent_tara_'.$tara->sector.'_npr', ' error') }}">
										<div>
											<input style="width:60px;" type="text" name="{{ 'agent_tara_'.$tara->sector.'_npr'}}" value="{{Input::old('agent_tara_'.$tara->sector.'_npr', $tara->npr)}}" />
											{{ $errors->first('agent_tara_'.$tara->sector.'_npr', '<span class="help-block">:message</span>') }}
										</div>
									</div>

			            	</td>
			            	<td>

			            		<div class="control-group{{ $errors->first('agent_tara_'.$tara->sector.'_usd', ' error') }}">
										<div>
											<input style="width:60px;" type="text" name="{{ 'agent_tara_'.$tara->sector.'_usd'}}" value="{{Input::old('agent_tara_'.$tara->sector.'_usd', $tara->usd)}}" />
											{{ $errors->first('agent_tara_'.$tara->sector.'_usd', '<span class="help-block">:message</span>') }}
										</div>
									</div>
			            		
			            	</td>

			            	<td>

			            		<div class="control-group{{ $errors->first('agent_tara_'.$tara->sector.'_inr', ' error') }}">
										<div>
											<input style="width:60px;" type="text" name="{{ 'agent_tara_'.$tara->sector.'_inr'}}" value="{{Input::old('agent_tara_'.$tara->sector.'_inr', $tara->inr)}}" />
											{{ $errors->first('agent_tara_'.$tara->sector.'_inr', '<span class="help-block">:message</span>') }}
										</div>
									</div>
			            		
			            	</td>
			            </tr>

		            @endforeach
		            	
		            </tbody>
		            </table>

		            <table id="simrik" class="table table-bordered table-striped table-hover">
            		<thead>
		            	<tr>
		                                
	                        <th class="span2">
	                        	<img style="width:40px; height:auto; vertical-align:middle;" src="{{asset('assets/img/simrik.jpg')}}" >Simrik Air
	                        </th>
		                                                  
		                </tr>
		                <tr>                               
                            <th class="span2" rowspan="3">Sector</th>
                            <th class="span2" colspan="10">Booking Class</th>
		                    
		                </tr>
		                <tr>                               
                            <th class="span2" colspan="2">Y</th>
                            <th class="span2" rowspan="2">A</th>
                            <th class="span2" rowspan="2">B</th>
                            <th class="span2" rowspan="2">C</th>
                            <th class="span2" rowspan="2">D</th>
                            <th class="span2" rowspan="2">E</th>
		                                    
		                </tr>
		                <tr>
  							<th class="span1" style="background-color: #F2DCDB;">NPR</th>
		                   	<th class="span1" style="background-color: #F2DCDB;">USD</th>		       		                               
		                </tr>
		            </thead>
            		<tbody>

            		@foreach($agent_simrik as $simrik)

		                <tr>
		                    <td>{{$simrik->sector_name}}</td>
		                    <td><!-- Y NPR -->
		                    	<div class="control-group{{ $errors->first('agent_simrik_'.$simrik->sector.'_y', ' error') }}">
									<div>
										<input style="width:40px;" type="text" name="{{ 'agent_simrik_'.$simrik->sector.'_y'}}" value="{{Input::old('agent_simrik_'.$simrik->sector.'_y', $simrik->y)}}" />
										{{ $errors->first('agent_simrik_'.$simrik->sector.'_y', '<span class="help-block">:message</span>') }}
									</div>
								</div>                    	
		                    </td> 

		                    <td><!-- Y USD -->
		                    	<div class="control-group{{ $errors->first('agent_simrik_'.$simrik->sector.'_y_usd', ' error') }}">
									<div>
										<input style="width:40px;" type="text" name="{{ 'agent_simrik_'.$simrik->sector.'_y_usd'}}" value="{{Input::old('agent_simrik_'.$simrik->sector.'_y_usd', $simrik->y_usd)}}" />
										{{ $errors->first('agent_simrik_'.$simrik->sector.'_y_usd', '<span class="help-block">:message</span>') }}
									</div>
								</div>                    	
		                    </td>  

		                    <td><!-- A -->
		                    	<div class="control-group{{ $errors->first('agent_simrik_'.$simrik->sector.'_a', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'agent_simrik_'.$simrik->sector.'_a'}}" value="{{Input::old('agent_simrik_'.$simrik->sector.'_a', $simrik->a)}}" />
										{{ $errors->first('agent_simrik_'.$simrik->sector.'_a', '<span class="help-block">:message</span>') }}
									</div>
								</div>                    	
		                    </td>


		                    <td><!-- B -->
		                    	<div class="control-group{{ $errors->first('agent_simrik_'.$simrik->sector.'_b', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'agent_simrik_'.$simrik->sector.'_b'}}" value="{{Input::old('agent_simrik_'.$simrik->sector.'_b', $simrik->b)}}" />
										{{ $errors->first('agent_simrik_'.$simrik->sector.'_b', '<span class="help-block">:message</span>') }}
									</div>
								</div>
		                    </td>
		                    <td><!-- C -->
		                    	<div class="control-group{{ $errors->first('agent_simrik_'.$simrik->sector.'_c', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'agent_simrik_'.$simrik->sector.'_c'}}" value="{{Input::old('agent_simrik_'.$simrik->sector.'_c', $simrik->c)}}" />
										{{ $errors->first('agent_simrik_'.$simrik->sector.'_c', '<span class="help-block">:message</span>') }}
									</div>
								</div> 	
		                    </td>
		                    <td><!-- D -->
		                    	<div class="control-group{{ $errors->first('agent_simrik_'.$simrik->sector.'_d', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'agent_simrik_'.$simrik->sector.'_d'}}" value="{{Input::old('agent_simrik_'.$simrik->sector.'_d', $simrik->d)}}" />
										{{ $errors->first('agent_simrik_'.$simrik->sector.'_d', '<span class="help-block">:message</span>') }}
									</div>
								</div>	
		                    </td>

		                    <td><!-- E -->
		                    	<div class="control-group{{ $errors->first('agent_simrik_'.$simrik->sector.'_e', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'agent_simrik_'.$simrik->sector.'_e'}}" value="{{Input::old('agent_simrik_'.$simrik->sector.'_e', $simrik->e)}}" />
										{{ $errors->first('agent_simrik_'.$simrik->sector.'_e', '<span class="help-block">:message</span>') }}
									</div>
								</div>
		                    </td> 
		                    
		                </tr>
		                @endforeach 

		                
		            </tbody>
        		</table>

					
		</div>
		<div class="tab-pane active" id="tab-distributor">
			<h4> Distributor </h4>
			
				<table class="table table-bordered table-striped table-hover">
            		<thead>
		            	<tr>
		                                
		                                <th class="span2">
		                                <img style="width:40px; height:auto; vertical-align:middle;" src="{{asset('assets/img/buddha.jpg')}}" >
		                                Buddha Air
		                                </th>
		                                                  
		                </tr>
		                <tr>                               
		                                <th class="span2" rowspan="2">Sector</th>
		                                <th class="span2" colspan="6">Booking Class</th>
		                    
		                </tr>
		                <tr>                               
		                                <th class="span2">Y</th>
		                                <th class="span2">A</th>
		                                <th class="span2">B</th>
		                                <th class="span2">D</th>
		                                <th class="span2">C</th>
		                                <th class="span2">E</th>
		                    
		                </tr>
		            </thead>
            		<tbody>

            		@foreach($distributor_buddha as $buddha)
            			<tr>
		                    <td>{{$buddha->sector_name}}</td>
		                    <td>
		                    	<div class="control-group{{ $errors->first('distributor_buddha_'.$buddha->sector.'_y', ' error') }}">
									<div>
										<input style="width:100px;" type="text" name="distributor_buddha_{{$buddha->sector}}_y" value="{{Input::old('distributor_buddha_'.$buddha->sector.'_y', $buddha->y)}}" />
										{{ $errors->first('distributor_buddha_'.$buddha->sector.'_y', '<span class="help-block">:message</span>') }}
									</div>
								</div>                    	
		                    </td>  

		                    <td>
		                    	<div class="control-group{{ $errors->first('distributor_buddha_'.$buddha->sector.'_a', ' error') }}">
									<div>
										<input style="width:100px;" type="text" name="distributor_buddha_{{$buddha->sector}}_a" value="{{Input::old('distributor_buddha_'.$buddha->sector.'_a', $buddha->a)}}" />
										{{ $errors->first('distributor_buddha_'.$buddha->sector.'_a', '<span class="help-block">:message</span>') }}
									</div>
								</div>                    	
		                    </td>


		                    <td>
		                    	<div class="control-group{{ $errors->first('distributor_buddha_'.$buddha->sector.'_b', ' error') }}">
									<div>
										<input style="width:100px;" type="text" name="distributor_buddha_{{$buddha->sector}}_b" value="{{Input::old('distributor_buddha_'.$buddha->sector.'_b', $buddha->b)}}" />
										{{ $errors->first('distributor_buddha_'.$buddha->sector.'_b', '<span class="help-block">:message</span>') }}
									</div>
								</div>
		                    </td>
		                    <td>
		                    	<div class="control-group{{ $errors->first('distributor_buddha_'.$buddha->sector.'_d', ' error') }}">
									<div>
										<input style="width:100px;" type="text" name="distributor_buddha_{{$buddha->sector}}_d" value="{{Input::old('distributor_buddha_'.$buddha->sector.'_d', $buddha->d)}}" />
										{{ $errors->first('distributor_buddha_'.$buddha->sector.'_d', '<span class="help-block">:message</span>') }}
									</div>
								</div> 	
		                    </td>
		                    <td>
		                    	<div class="control-group{{ $errors->first('distributor_buddha_'.$buddha->sector.'_c', ' error') }}">
									<div>
										<input style="width:100px;" type="text" name="distributor_buddha_{{$buddha->sector}}_c" value="{{Input::old('distributor_buddha_'.$buddha->sector.'_c', $buddha->c)}}" />
										{{ $errors->first('distributor_buddha_'.$buddha->sector.'_c', '<span class="help-block">:message</span>') }}
									</div>
								</div>	
		                    </td>

		                    <td>
		                    	<div class="control-group{{ $errors->first('distributor_buddha_'.$buddha->sector.'_e', ' error') }}">
									<div>
										<input style="width:100px;" type="text" name="distributor_buddha_{{$buddha->sector}}_e" value="{{Input::old('distributor_buddha_'.$buddha->sector.'_e', $buddha->e)}}" />
										{{ $errors->first('distributor_buddha_'.$buddha->sector.'_e', '<span class="help-block">:message</span>') }}
									</div>
								</div>
		                    </td>   
		                    
		                </tr>
            		@endforeach

		                
		            </tbody>
        		</table>

        		<style type="text/css">

        			#yeti td:nth-child(2), #yeti td:nth-child(3) { background-color: #F2DCDB; }
        			#yeti td:nth-child(4) { background-color: #FFFFCC; }
        			#yeti td:nth-child(5) { background-color: #D8E4BC; }



        		</style>

        		<table id="yeti" class="table table-bordered table-striped table-hover">
            		<thead>
		            	<tr>
		                                
		                                <th class="span2">Yeti Air</th>
		                                                  
		                </tr>
		                <tr>                               
		                                <th class="span2" rowspan="3">Sector</th>
		                                <th class="span2" colspan="10">Booking Class</th>
		                    
		                </tr>
		                <tr>                               
		                                <th class="span2" colspan="2" style="background-color: #F2DCDB;">Normal(N)</th>
		                                <th class="span2" rowspan="2" style="background-color: #FFFFCC;">Yellow(Y)</th>
		                                <th class="span2" rowspan="2" style="background-color: #D8E4BC;">Green(G)</th>
		                                <th class="span2" rowspan="2">Flanker(F)</th>
		                                <th class="span2" rowspan="2">Special(S)</th>
		                                <th class="span2" rowspan="2">Hotel(H)</th>
		                                <th class="span2" rowspan="2">Early(E)</th>
		                                <th class="span2" rowspan="2">Oscar(O)</th>
		                                <th class="span2" rowspan="2">Victor(V)</th>
		                    
		                </tr>
		                <tr>
  							<th class="span1" style="background-color: #F2DCDB;">NPR</th>
		                   	<th class="span1" style="background-color: #F2DCDB;">USD</th>		       
		                               
		                </tr>
		            </thead>
            		<tbody>

            		@foreach($distributor_yeti as $yeti)

		                <tr>
		                    <td>{{$yeti->sector_name}}</td>
		                    <td><!-- N NPR -->
		                    	<div class="control-group{{ $errors->first('distributor_yeti_'.$yeti->sector.'_n', ' error') }}">
									<div>
										<input style="width:40px;" type="text" name="{{ 'distributor_yeti_'.$yeti->sector.'_n'}}" value="{{Input::old('distributor_yeti_'.$yeti->sector.'_n', $yeti->n)}}" />
										{{ $errors->first('distributor_yeti_'.$yeti->sector.'_n', '<span class="help-block">:message</span>') }}
									</div>
								</div>                    	
		                    </td> 

		                    <td><!-- N USD -->
		                    	<div class="control-group{{ $errors->first('distributor_yeti_'.$yeti->sector.'_n_usd', ' error') }}">
									<div>
										<input style="width:40px;" type="text" name="{{ 'distributor_yeti_'.$yeti->sector.'_n_usd'}}" value="{{Input::old('distributor_yeti_'.$yeti->sector.'_n_usd', $yeti->n_usd)}}" />
										{{ $errors->first('distributor_yeti_'.$yeti->sector.'_n_usd', '<span class="help-block">:message</span>') }}
									</div>
								</div>                    	
		                    </td>  

		                    <td><!-- Y -->
		                    	<div class="control-group{{ $errors->first('distributor_yeti_'.$yeti->sector.'_y', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'distributor_yeti_'.$yeti->sector.'_y'}}" value="{{Input::old('distributor_yeti_'.$yeti->sector.'_y', $yeti->y)}}" />
										{{ $errors->first('distributor_yeti_'.$yeti->sector.'_y', '<span class="help-block">:message</span>') }}
									</div>
								</div>                    	
		                    </td>


		                    <td><!-- G -->
		                    	<div class="control-group{{ $errors->first('distributor_yeti_'.$yeti->sector.'_g', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'distributor_yeti_'.$yeti->sector.'_g'}}" value="{{Input::old('distributor_yeti_'.$yeti->sector.'_g', $yeti->g)}}" />
										{{ $errors->first('distributor_yeti_'.$yeti->sector.'_g', '<span class="help-block">:message</span>') }}
									</div>
								</div>
		                    </td>
		                    <td><!-- F -->
		                    	<div class="control-group{{ $errors->first('distributor_yeti_'.$yeti->sector.'_f', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'distributor_yeti_'.$yeti->sector.'_f'}}" value="{{Input::old('distributor_yeti_'.$yeti->sector.'_f', $yeti->f)}}" />
										{{ $errors->first('distributor_yeti_'.$yeti->sector.'_f', '<span class="help-block">:message</span>') }}
									</div>
								</div> 	
		                    </td>
		                    <td><!-- S -->
		                    	<div class="control-group{{ $errors->first('distributor_yeti_'.$yeti->sector.'_s', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'distributor_yeti_'.$yeti->sector.'_s'}}" value="{{Input::old('distributor_yeti_'.$yeti->sector.'_s', $yeti->s)}}" />
										{{ $errors->first('distributor_yeti_'.$yeti->sector.'_s', '<span class="help-block">:message</span>') }}
									</div>
								</div>	
		                    </td>

		                    <td><!-- H -->
		                    	<div class="control-group{{ $errors->first('distributor_yeti_'.$yeti->sector.'_h', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'distributor_yeti_'.$yeti->sector.'_h'}}" value="{{Input::old('distributor_yeti_'.$yeti->sector.'_h', $yeti->h)}}" />
										{{ $errors->first('distributor_yeti_'.$yeti->sector.'_h', '<span class="help-block">:message</span>') }}
									</div>
								</div>
		                    </td>

		                    <td><!-- E -->
		                    	<div class="control-group{{ $errors->first('distributor_yeti_'.$yeti->sector.'_e', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'distributor_yeti_'.$yeti->sector.'_e'}}" value="{{Input::old('distributor_yeti_'.$yeti->sector.'_e', $yeti->e)}}" />
										{{ $errors->first('distributor_yeti_'.$yeti->sector.'_e', '<span class="help-block">:message</span>') }}
									</div>
								</div>
		                    </td> 

		                    <td><!-- O -->
		                    	<div class="control-group{{ $errors->first('distributor_yeti_'.$yeti->sector.'_o', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'distributor_yeti_'.$yeti->sector.'_o'}}" value="{{Input::old('distributor_yeti_'.$yeti->sector.'_o', $yeti->o)}}" />
										{{ $errors->first('distributor_yeti_'.$yeti->sector.'_o', '<span class="help-block">:message</span>') }}
									</div>
								</div>
		                    </td> 

		                    <td><!-- V -->
		                    	<div class="control-group{{ $errors->first('distributor_yeti_'.$yeti->sector.'_v', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'distributor_yeti_'.$yeti->sector.'_v'}}" value="{{Input::old('distributor_yeti_'.$yeti->sector.'_v', $yeti->v)}}" />
										{{ $errors->first('distributor_yeti_'.$yeti->sector.'_v', '<span class="help-block">:message</span>') }}
									</div>
								</div>
		                    </td>    
		                    
		                </tr>
		                @endforeach 

		                
		            </tbody>
        		</table>	


        		<table class="table table-bordered table-striped table-hover">
            		<thead>
		            	<tr>
		                                
		                                <th class="span2">Tara Air</th>
		                                                  
		                </tr>
		                <tr>                               
		                                <th class="span2" rowspan="2">Sector</th>
		                                <th class="span2" colspan="6">Commission</th>
		                    
		                </tr>
		                <tr>                               
		                                <th class="span2">NPR</th>
		                                <th class="span2">USD</th>
		                                <th class="span2">INR</th>
		                </tr>
		            </thead>



		            <tbody>

		            @foreach($distributor_tara as $tara)

			            <tr>
			            	<td>
			            		{{$tara->sector_from}} - {{$tara->sector_to}}
			            	</td>

			            	<td>

			            		<div class="control-group{{ $errors->first('distributor_tara_'.$tara->sector.'_npr', ' error') }}">
										<div>
											<input style="width:60px;" type="text" name="{{ 'distributor_tara_'.$tara->sector.'_npr'}}" value="{{Input::old('distributor_tara_'.$tara->sector.'_npr', $tara->npr)}}" />
											{{ $errors->first('distributor_tara_'.$tara->sector.'_npr', '<span class="help-block">:message</span>') }}
										</div>
									</div>

			            	</td>
			            	<td>

			            		<div class="control-group{{ $errors->first('distributor_tara_'.$tara->sector.'_usd', ' error') }}">
										<div>
											<input style="width:60px;" type="text" name="{{ 'distributor_tara_'.$tara->sector.'_usd'}}" value="{{Input::old('distributor_tara_'.$tara->sector.'_usd', $tara->usd)}}" />
											{{ $errors->first('distributor_tara_'.$tara->sector.'_usd', '<span class="help-block">:message</span>') }}
										</div>
									</div>
			            		
			            	</td>

			            	<td>

			            		<div class="control-group{{ $errors->first('distributor_tara_'.$tara->sector.'_inr', ' error') }}">
										<div>
											<input style="width:60px;" type="text" name="{{ 'distributor_tara_'.$tara->sector.'_inr'}}" value="{{Input::old('distributor_tara_'.$tara->sector.'_inr', $tara->inr)}}" />
											{{ $errors->first('distributor_tara_'.$tara->sector.'_inr', '<span class="help-block">:message</span>') }}
										</div>
									</div>
			            		
			            	</td>
			            </tr>

		            @endforeach
		            	
		            </tbody>
		            </table>

		            <table id="simrik" class="table table-bordered table-striped table-hover">
            		<thead>
		            	<tr>
		                                
	                        <th class="span2">
	                        	<img style="width:40px; height:auto; vertical-align:middle;" src="{{asset('assets/img/simrik.jpg')}}" >Simrik Air
	                        </th>
		                                                  
		                </tr>
		                <tr>                               
                            <th class="span2" rowspan="3">Sector</th>
                            <th class="span2" colspan="10">Booking Class</th>
		                    
		                </tr>
		                <tr>                               
                            <th class="span2" colspan="2">Y</th>
                            <th class="span2" rowspan="2">A</th>
                            <th class="span2" rowspan="2">B</th>
                            <th class="span2" rowspan="2">C</th>
                            <th class="span2" rowspan="2">D</th>
                            <th class="span2" rowspan="2">E</th>
		                                    
		                </tr>
		                <tr>
  							<th class="span1" style="background-color: #F2DCDB;">NPR</th>
		                   	<th class="span1" style="background-color: #F2DCDB;">USD</th>		       		                               
		                </tr>
		            </thead>
            		<tbody>

            		@foreach($distributor_simrik as $simrik)

		                <tr>
		                    <td>{{$simrik->sector_name}}</td>
		                    <td><!-- Y NPR -->
		                    	<div class="control-group{{ $errors->first('distributor_simrik_'.$simrik->sector.'_y', ' error') }}">
									<div>
										<input style="width:40px;" type="text" name="{{ 'distributor_simrik_'.$simrik->sector.'_y'}}" value="{{Input::old('distributor_simrik_'.$simrik->sector.'_y', $simrik->y)}}" />
										{{ $errors->first('distributor_simrik_'.$simrik->sector.'_y', '<span class="help-block">:message</span>') }}
									</div>
								</div>                    	
		                    </td> 

		                    <td><!-- Y USD -->
		                    	<div class="control-group{{ $errors->first('distributor_simrik_'.$simrik->sector.'_y_usd', ' error') }}">
									<div>
										<input style="width:40px;" type="text" name="{{ 'distributor_simrik_'.$simrik->sector.'_y_usd'}}" value="{{Input::old('distributor_simrik_'.$simrik->sector.'_y_usd', $simrik->y_usd)}}" />
										{{ $errors->first('distributor_simrik_'.$simrik->sector.'_y_usd', '<span class="help-block">:message</span>') }}
									</div>
								</div>                    	
		                    </td>  

		                    <td><!-- A -->
		                    	<div class="control-group{{ $errors->first('distributor_simrik_'.$simrik->sector.'_a', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'distributor_simrik_'.$simrik->sector.'_a'}}" value="{{Input::old('distributor_simrik_'.$simrik->sector.'_a', $simrik->a)}}" />
										{{ $errors->first('distributor_simrik_'.$simrik->sector.'_a', '<span class="help-block">:message</span>') }}
									</div>
								</div>                    	
		                    </td>


		                    <td><!-- B -->
		                    	<div class="control-group{{ $errors->first('distributor_simrik_'.$simrik->sector.'_b', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'distributor_simrik_'.$simrik->sector.'_b'}}" value="{{Input::old('distributor_simrik_'.$simrik->sector.'_b', $simrik->b)}}" />
										{{ $errors->first('distributor_simrik_'.$simrik->sector.'_b', '<span class="help-block">:message</span>') }}
									</div>
								</div>
		                    </td>
		                    <td><!-- C -->
		                    	<div class="control-group{{ $errors->first('distributor_simrik_'.$simrik->sector.'_c', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'distributor_simrik_'.$simrik->sector.'_c'}}" value="{{Input::old('distributor_simrik_'.$simrik->sector.'_c', $simrik->c)}}" />
										{{ $errors->first('distributor_simrik_'.$simrik->sector.'_c', '<span class="help-block">:message</span>') }}
									</div>
								</div> 	
		                    </td>
		                    <td><!-- D -->
		                    	<div class="control-group{{ $errors->first('distributor_simrik_'.$simrik->sector.'_d', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'distributor_simrik_'.$simrik->sector.'_d'}}" value="{{Input::old('distributor_simrik_'.$simrik->sector.'_d', $simrik->d)}}" />
										{{ $errors->first('distributor_simrik_'.$simrik->sector.'_d', '<span class="help-block">:message</span>') }}
									</div>
								</div>	
		                    </td>

		                    <td><!-- E -->
		                    	<div class="control-group{{ $errors->first('distributor_simrik_'.$simrik->sector.'_e', ' error') }}">
									<div>
										<input style="width:60px;" type="text" name="{{ 'distributor_simrik_'.$simrik->sector.'_e'}}" value="{{Input::old('distributor_simrik_'.$simrik->sector.'_e', $simrik->e)}}" />
										{{ $errors->first('distributor_simrik_'.$simrik->sector.'_e', '<span class="help-block">:message</span>') }}
									</div>
								</div>
		                    </td> 
		                    
		                </tr>
		                @endforeach 

		                
		            </tbody>
        		</table>

					
		</div>
		                      	
	</div>

	<!-- Form Actions -->
					<div class="control-group">
						<div class="controls">
							<a class="btn btn-link" href="{{route('flight-commission')}}">Back</a>

							<button type="reset" class="btn">Reset</button>

							<button type="submit" class="btn btn-success">Save</button>
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

<script type="text/javascript">

    $(document).ready(function() {

    
        $("#datepick1").datepicker({       
              dateFormat: "dd-mm-yy"
            });
        $("#datepick2").datepicker({       
              dateFormat: "dd-mm-yy"
            });
        $("#datepick3").datepicker({       
              dateFormat: "dd-mm-yy"
            });

    });

</script>



@stop

