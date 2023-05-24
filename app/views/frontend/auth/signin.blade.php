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


                                @if(Request::is('admin'))

                                <h3>Admin Login panel</h3>

                                @elseif(Request::is('agent'))

                                <h3>Agent Login panel</h3>

                                @elseif(Request::is('manager'))

                                <h3>Manager Login panel</h3>

                               @elseif(Request::is('affiliate'))

                                <h3>Affiliate Login panel</h3>

                                @elseif(Request::is('distributor'))

                                <h3>Distributor Login panel</h3>

                                @elseif(Request::is('corporate'))

                                <h3>Corporate Login panel</h3>

                                @else

                                <h3>User Login panel</h3>

                                @endif
                                    
                                    
                                     
                                   
                                </div> <!-- /Top -->

                                <div class="bottom clearfix" style="padding:10px;">
                                    
                                 @if(ApplicationSetting::find(4)->value == 0)

                                	Login Disabled Temporarily. Please check back later.

                                 @else 

                                 	<div class="row">
										<form method="post" action="{{ route('signin') }}" class="form-horizontal">
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
								@endif
                                   
                                </div> <!-- /Bottom -->
                            </div>
                        </div>
                    </div>
                </div>                             
                       

@stop
