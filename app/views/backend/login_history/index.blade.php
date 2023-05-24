@extends('backend/layouts/default')
@section('title')
Login History :: @parent
@stop

@section('content')

<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
                Login History
            </h3>
            <!-- BEGIN BREADCRUMBS -->
            <ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    Reports
                            <span class="icon-angle-right"></span>
                        </li>
                         

                                    <li>Login History
                                                
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
    
    <table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
                        
                        <th class="span2">Id</th>
                        <th class="span2">User</th>
                        <th class="span2">IP Address</th>
                        <th class="span2">Logged in at</th>
        </tr>
    </thead>
    <tbody>

    @foreach($entries as $entry)
        
        <tr>
            <td>{{$entry->id}}</td>
            <td>
                <?php $user = User::where('id', $entry->user_id)->first(); ?>
                @if(isset($user))
                <a href="{{ route('update/user', $user->id) }}"> {{ $user->first_name .' '. $user->last_name .'('.$user->email.')' }} </a>
                @endif
            </td>

            <td>
                {{$entry->ip_address}}
            </td>

            <td>{{$entry->created_at}}</td>             
        </tr>

    @endforeach
        
    </tbody>
</table>

        {{ $entries->links() }}


                    <!-- END TABLE DATA -->
                </div>
                <!-- END TABLE BODY -->
        </div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>


@stop
