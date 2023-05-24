@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Contact us ::
@parent
@stop

{{-- Page content --}}
@section('content')

<link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/pages/contact.css')}}"/>

<div id="header12">
	<div class="wrapheader">
		<div class="infobox">
			<div class="midbox">
				<h2>Blackeye Travels</h2>
				<div class="address">Main Street, 658, Name Walnut Park, Paris</div>
				<div class="phone">548-8725-524</div>
				<div class="arrow"></div>
				<div class="clear"></div>
				</div>
		</div>
		<img alt="contactmap" src="{{asset('assets/frontend/images/contactmap.jpg')}}">
	</div>
</div>

<div id="content">
		<div class="wrapcontent">
			<div class="left">

				<div class="title">
					<h2>Send us message</h2>
				</div>

				<form method="post" action="">
							<!-- CSRF Token -->
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />

					<table class="sbox">
					<tbody>
						<tr>
							<td><span class="text">Full Name</span></td>
							<td><span class="text">Email Address</span></td>
						</tr>
						<tr>
							<td>
								<!-- Name -->
								<div  class="control-group{{ $errors->first('name', ' error') }}">
									<input  style="width:301px;" type="text" id="name" name="name" class="input-block-level" placeholder="Name">
									{{ $errors->first('name', '<span class="help-block">:message</span>') }}
								</div>							
							</td>
							<td class="last">
								<!-- Email -->
								<div  class="control-group{{ $errors->first('email', ' error') }}">
									<input style="width:301px;" type="text" id="email" name="email" class="input-block-level" placeholder="Email">
									{{ $errors->first('email', '<span class="help-block">:message</span>') }}
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="2"><span class="text">Write message here</span></td>
						</tr>
						<tr>
							<td class="last" colspan="2">
								<!-- Description -->
								<div  class="control-group{{ $errors->first('description', ' error') }}">
									<textarea rows="6" id="description" name="description" class="input-block-level" placeholder="Message"></textarea>
									{{ $errors->first('description', '<span class="help-block">:message</span>') }}
								</div>
							</td>
						</tr>

						<tr>
							<td>
								<!-- Captcha -->
								<div class="control-group{{ $errors->first('recaptcha_response_field', ' error') }}">
									<label class="control-label" >Captcha</label>
									<div class="controls">
										{{Form::captcha()}}				
										{{ $errors->first('recaptcha_response_field', '<span class="help-block">:message</span>') }}
									</div>
								</div>
							</td>
						</tr>

					</tbody>

					</table>

					<input class="sendbtn" type="submit" name="send" value="Send">
				</form>

			</div>

			<div class="right">
				<div class="box">
					<div class="top">
						<h2>Contact Us</h2>
					</div>
					<div class="mid">
						<ul>
							<li>Address<div class="subli">Main Street, 658 Name Walnut Park, Paris</div></li>
							<li>Phone<div class="subli">548-8725-524</div></li>
							<li>Email Address<div class="subli">info@blackeyetravels.com</div></li>
							<li>Website<div class="subli">www.blackeyetravels.com</div></li>
						</ul>
					</div>
				</div>			
			</div>
		<div class="clear"></div>
		</div>
</div> <!-- /Content -->


                                
@stop