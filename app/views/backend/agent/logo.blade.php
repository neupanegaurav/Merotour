@extends('backend/layouts/default')
@section('title')
Agent Logo :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Agent Logo
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    Agent Logo
                       <span class="icon-angle-right"></span>
                        </li>
                         

                                    <li>Agent Logo
                                                
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
                <tr>
                    <td>
                        Change Logo
                    </td>
                    <td>
                        <div style="margin:5px;">Current logo image:<br>
                            <img  src="{{ asset('assets/img/uploads/agents') }}/{{ Input::old('uploaded_picture', $entry->logo) }}">
                        </div>
                        <br>

                        Change logo image: <input type="file" name="uploaded_picture" accept="image/jpg"> <br>
                        <em> Recommended constraints:  width 100px  and height 100px.</em>
                         {{ $errors->first('uploaded_picture', '<span class="help-inline">:message</span>') }}

                        <br>
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
