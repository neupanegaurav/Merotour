@extends('backend/layouts/default')
@section('title')
Application Setting :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Application Setting
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    Account Management
                            <span class="icon-angle-right"></span>
                        </li>
                         

                                    <li>Application Setting
                                                
                                        </li>
                                                       
            </ul>
			<!-- END BREADCRUMBS -->
        </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN DYNAMIC TABLE EXAMPLE -->
        <div class="social-box">
    <div class="header">
    

    <!-- BEGIN TABLE TOOLS -->
    <div class="tools">

    </div>
    <!-- END TABLE TOOLS -->

    </div>
    <!-- BEGIN TABLE BODY -->
    <div class="body">     

    <form class="form-horizontal" method="post" action="" autocomplete="off" enctype="multipart/form-data">
            <!-- CSRF Token -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
           
            <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                                
                    <th class="span2">Settings</th>
                    <th class="span2">Options</th>
                    
                </tr>
            </thead>
            <tbody>


         @foreach($entries as $entry)       
                <tr>
                    <td>{{$entry->name}}</td>
                    <td>           
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default">
                                <input type="radio" name="{{$entry->slug}}"  value="1" {{ $entry->value == 1 ? 'checked' : '' }}>
                            Enable 
                            </label>
                            <label class="btn btn-default">
                                <input type="radio" name="{{$entry->slug}}" value="0" {{ $entry->value == 0 ? 'checked' : '' }}>
                            Disable 
                            </label>
                        </div>
                    </td>                          
                </tr>                        
            @endforeach

                <tr>
                    <td>
                        Default Currency
                    </td>
                    <td>
                        <select name="default_currency" style="width:80px;">
                            <option {{ $default_currency->default_currency == 'USD' ? 'selected' : '' }}>USD</option>
                            <option {{ $default_currency->default_currency == 'NPR' ? 'selected' : '' }}>NPR</option>
                            <option {{ $default_currency->default_currency == 'EUR' ? 'selected' : '' }}>EUR</option>
                            <option {{ $default_currency->default_currency == 'INR' ? 'selected' : '' }}>INR</option>
                        </select>
                    </td>
                </tr>

               

                <tr>
                    <td>
                        Change Logo
                    </td>
                    <td>
                        <div style="margin:5px;">Current logo image:<br>
    
                            <img  src="{{ asset('assets/frontend/images') }}/{{ Input::old('uploaded_picture', $logo->image) }}">

                        </div>
                        <br>

                        Change logo image: <input type="file" name="uploaded_picture" accept="image/jpg"> <br>
                        <em> Recommended constraints:  width 100px  and height 100px.</em>
                         {{ $errors->first('uploaded_picture', '<span class="help-inline">:message</span>') }}

                        <br>
                    </td>
                </tr>

                <tr>
                    <td>
                        Phone Number
                    </td>
                    <td>
                        <input type="text" name="phone_number" value="{{Input::old('phone_number', $phone->phone_number )}}">
                    </td>
                </tr>

                <tr>
                    <td>
                        Address
                    </td>
                    <td>
                        <input type="text" name="address" value="{{Input::old('address', $address->address )}}">
                    </td>
                </tr>
              
                
            </tbody>
        </table>

         <button type="submit" class="btn btn-success pull-right" style="margin-bottom:12px;">Save</button>
     <br clear="all">

    </form>

			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>


@stop
