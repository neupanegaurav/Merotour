@extends('backend/layouts/default')
@section('title')
Ledger Master :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Ledger Master
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    Account Management
                            <span class="icon-angle-right"></span>
                        </li>
                         

                                    <li>Ledger Master
                                                
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
        <div class="btn-group">
            <a class="btn btn-primary" id="add-row" href="{{route('create/ledger')}}"><i class="icon-pencil"></i> Add</a>            
        </div>
    </div>
    <!-- END TABLE TOOLS -->

    </div>
    <!-- BEGIN TABLE BODY -->
    <div class="body">     
    
    <table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
                        
                        <th class="span2">SN</th>
            <th class="span2">Product</th>
                        <th class="span2">Account group</th>
                        <th class="span2">Account Sub group</th>
                        <th class="span2">Account Type</th>
            <th class="span2">Ledger</th>
            <th class="span3">@lang('table.actions')</th>
        </tr>
    </thead>
    <tbody>

    @foreach($entries as $entry)
        
        <tr>
            <td>{{$entry->id}}</td>
            <td>{{$entry->product}}</td>
            <td>{{$entry->account_group}}</td>
            <td>{{$entry->account_sub_group}}</td>
            <td>{{$entry->account_type}}</td>
            <td>{{$entry->ledger}}</td>
                     
            <td>
                <a href="{{ route('edit/ledger', $entry->id) }}" class="btn btn-mini">Edit</a>    
                                        
                 <a href="#" class="btn btn-mini btn-danger">@lang('button.delete')</a>                     
            </td>
        </tr>

    @endforeach
        
    </tbody>
</table>

        


			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>


@stop
