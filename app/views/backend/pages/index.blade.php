@extends('backend/layouts/default')

@section('title')
List of Pages:: @parent
@stop

@section('content')
@section('content')
@include('backend.administration.sidebar')


<div id="right_section">
    
    <div id="right_header">
	<h3>
		Pages

		<div class="pull-right">
			<a href="{{ route('create_page') }}" class="btn btn-small btn-info"><i class="icon-plus-sign icon-white"></i> Create page</a>
		</div>
</h3>
        </div>

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
                        <th class="span2">Name</th>
                        <th class="span2">Title</th>
			<th class="span3">Content</th>
                        <th class="span2">Created_at</th>
			<th class="span2">Updated at</th>
			<th class="span3">@lang('table.actions')</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($entries as $entry)
		<tr>
                        <td>{{ $entry->slug }}</td>
                        <td>{{ $entry->title }}</td>
			<td>{{ html_entity_decode(Str::words($entry->content, 10))}}</td>
                        <td>{{ $entry->created_at->diffForHumans()}}</td>
                        <td>{{ $entry->updated_at->diffForHumans()}}</td>
                     
			<td>
				<a href="{{ route('edit_page', $entry->id) }}" class="btn btn-mini">Edit</a>
                                <a href="{{ route('delete_page', $entry->id) }}" class="btn btn-mini btn-danger">@lang('button.delete')</a>
                                
				
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

{{ $entries->links() }}

</div>

@stop
