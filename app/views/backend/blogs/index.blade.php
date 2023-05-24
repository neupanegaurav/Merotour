@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
News Management ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                News Management
            </h3>
            <!-- BEGIN BREADCRUMBS -->
			<ul class="breadcrumb">
			    <li>
			        <i class="icon-home"></i>
			        General Settings
			                <span class="icon-angle-right"></span>
			            </li>
			                        <li>News Management
			                                    
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
           <a class="btn btn-primary" id="add-row" href="{{ route('create/blog') }}"><i class="icon-pencil"></i> Add</a>
             
        </div>
    
    </div>
    <!-- END TABLE TOOLS -->

    </div>
    <!-- BEGIN TABLE BODY -->
    <div class="body">
        
        <table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th class="span6">News title</th>
			<th class="span2">@lang('admin/blogs/table.comments')</th>
			<th class="span2">@lang('admin/blogs/table.created_at')</th>
			<th class="span2">@lang('table.actions')</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($posts as $post)
		<tr>
			<td>{{ $post->title }}</td>
			<td>{{ $post->comments()->count() }}</td>
			<td>{{ $post->created_at->diffForHumans() }}</td>
			<td>
				<a href="{{ route('update/blog', $post->id) }}" class="btn btn-mini">@lang('button.edit')</a>
				<a href="{{ route('delete/blog', $post->id) }}" class="btn btn-mini btn-danger">@lang('button.delete')</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

{{ $posts->links() }}

        


			        <!-- END TABLE DATA -->
			    </div>
		    	<!-- END TABLE BODY -->
		</div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>


@stop