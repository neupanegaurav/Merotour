@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Developer Sign in ::
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

                                <h2>Developer Portal</h2>                                                                    
                                                
                                </div> <!-- /Top -->

                                <div class="bottom clearfix well pull-left" style="width: 400px; padding:10px;">
                                    
                                    <legend>Login</legend>

                                 	<div class="row">
										<form method="post" action="{{ route('developer-signin') }}" class="form-horizontal">
											<!-- CSRF Token -->
											<input type="hidden" name="_token" value="{{ csrf_token() }}" />

											<!-- Email -->
											<div class="control-group{{ $errors->first('email', ' error') }}">
												<label class="control-label" for="email">Email</label>
												<div class="controls">
													<input type="text" name="email" id="email" value="{{ Input::old('email') }}" />
													{{ $errors->first('email', '<span class="help-block">:message</span>') }}
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

											<!-- Remember me -->
											<div class="control-group">
												<div class="controls">
												<label class="checkbox">
													<input type="checkbox" name="remember-me" id="remember-me" value="1" /> Remember me
												</label>
												</div>
											</div>

											

											<!-- Form actions -->
											<div class="control-group">
												<div class="controls">
													<a class="btn" href="{{ route('home') }}">Cancel</a>

													<button type="submit" class="btn">Sign in</button>

													<a href="{{ route('forgot-password') }}" class="btn btn-link">I forgot my password</a>
												</div>
											</div>
										</form>
									</div>
                                   
                                </div> <!-- /Bottom -->

                                <div class="bottom clearfix well pull-right" style="width: 500px; padding:10px;">
                                    
                                    <legend>Register</legend>

                                    <div class="row">
                                            <form method="post" action="{{ route('developer-signup') }}" class="form-horizontal" autocomplete="off">
                                                <!-- CSRF Token -->
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                              <input type="hidden" name="isagent" value="true" />


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
                                                        

                                                        <button type="submit" class="btn">Sign up</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                   
                                </div> <!-- /Bottom -->

                            </div>

                        </div>
                    </div>
                </div>                             
                       

@stop
