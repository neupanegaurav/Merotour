@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Account Sign in ::
@parent
@stop

{{-- Page content --}}
@section('content')


   <!-- Grid page -->
                <div class="content booking_wrap">
                    <div>
                        <div>
                            <div>
                                <div class="top" style="padding:10px;">
                                    
                                    
                                     <h3>Sign up</h3>
                                   
                                </div> <!-- /Top -->

                                <div class="bottom clearfix" style="padding:10px;">
                                    
                                    @if(ApplicationSetting::find(4)->value == 0)

                                	Login Disabled Temporarily. Please check back later.

                                	 @else 
	                                    <div class="row">
											<form method="post" action="{{ route('signup') }}" class="form-horizontal" autocomplete="off">
												<!-- CSRF Token -->
												<input type="hidden" name="_token" value="{{ csrf_token() }}" />

												<!-- First Name -->
												<div class="control-group{{ $errors->first('first_name', ' error') }}">
												<label class="control-label" for="first_name">First Name</label>
													<div class="controls">
														<input type="text" name="first_name" id="first_name" value="{{ Input::old('first_name') }}" />
														{{ $errors->first('first_name', '<span class="help-block">:message</span>') }}
													</div>
												</div>

												<!-- Last Name -->
												<div class="control-group{{ $errors->first('last_name', ' error') }}">
													<label class="control-label" for="last_name">Last Name</label>
													<div class="controls">
														<input type="text" name="last_name" id="last_name" value="{{ Input::old('last_name') }}" />
														{{ $errors->first('last_name', '<span class="help-block">:message</span>') }}
													</div>
												</div>

												<!-- Email -->
												<div class="control-group{{ $errors->first('email', ' error') }}">
													<label class="control-label" for="email">Email</label>
													<div class="controls">
														<input type="text" name="email" id="email" value="{{ Input::old('email') }}" />
														{{ $errors->first('email', '<span class="help-block">:message</span>') }}
													</div>
												</div>

												<!-- Email Confirm -->
												<div class="control-group{{ $errors->first('email_confirm', ' error') }}">
													<label class="control-label" for="email_confirm">Confirm Email</label>
													<div class="controls">
														<input type="text" name="email_confirm" id="email_confirm" value="{{ Input::old('email_confirm') }}" />
														{{ $errors->first('email_confirm', '<span class="help-block">:message</span>') }}
													</div>
												</div>

												<!-- Password -->
												<div class="control-group{{ $errors->first('password', ' error') }}">
													<label class="control-label" for="password">Password</label>
													<div class="controls">
														<input type="password" name="password" id="password" value="" />
														{{ $errors->first('password', '<span class="help-block">:message</span>') }}
													</div>
												</div>

												<!-- Password Confirm -->
												<div class="control-group{{ $errors->first('password_confirm', ' error') }}">
													<label class="control-label" for="password_confirm">Confirm Password</label>
													<div class="controls">
														<input type="password" name="password_confirm" id="password_confirm" value="" />
														{{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}
													</div>
												</div>


												<!-- Captcha -->
												<div class="control-group{{ $errors->first('recaptcha_response_field', ' error') }}">
													<label class="control-label" >Captcha</label>
													<div class="controls">
														{{Form::captcha()}}				
														{{ $errors->first('recaptcha_response_field', '<span class="help-block">:message</span>') }}
													</div>
												</div>

												<!-- Form actions -->
												<div class="control-group">
													<div class="controls">
														<a class="btn" href="{{ route('home') }}">Cancel</a>

														<button type="submit" class="btn">Sign up</button>
													</div>
												</div>
											</form>
										</div>
									@endif
                                   
                                </div> <!-- /Bottom -->
                            </div>
                        </div>
                    </div>
                </div>

                                
    
       
    
  
                              
                              
                       

@stop
