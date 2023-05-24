@extends('backend/layouts/default')
@section('content')

                    <div class="row-fluid">
  <div class="span12">
    <h3 class="page-title">
      Dashboard
    </h3>
    <!-- BEGIN BREADCRUMBS -->
<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        Dashboard
            </li>
      <div class="pull-right" style="font-size:14px;line-height: 20px;">

                                  <?php 
                                     
                                    $user = Sentry::getUser();
                            
                                    $id = $user->id;

                                    $fund = Funds::where('user_id', $id)->first();
                                    
                                    if (isset($fund)) {                                      
                                    echo '<span style="margin-right:12px;"><strong>Available Balance:</strong> Rs.' . $fund->balance . '</span>';
                                    echo "<span><strong>Credit Balance:</strong> Rs." . $fund->credit_balance . '</span>';                                    
                                    }


                                  ?>
      
                </div> 
    
</ul>
<!-- END BREADCRUMBS -->
  </div>
</div>

<div class="row-fluid">
  <div class="span8">
    <!-- FLot example -->
    <section class="social-box social-bordered">
     
      <div class="body">
        <div id="demo-plot" class="plot">
          
          @foreach($banners as $banner)

          <img src="{{asset('assets/img/uploads/banners/'. $banner->image)}}" /> <br> <br>

          @endforeach
        </div>
      </div>
    </section>
  </div>
  <div class="span4">
    <!-- Feed list example -->
    <section id="feeds" class="feeds social-box social-bordered social-blue">
    <div class="header">
     <!-- BEGIN FEED TITLE  -->
      <h4>
        <i class="icon-th-list"></i>
        <span class="hidden-phone">Notice</span>
      </h4>
     <!-- END FEED TITLE  -->
      <!-- BEGIN TABS TOGGLES -->
      <div class="tools">
        <ul id="myTab" class="nav nav-tabs">
        </ul>
      </div>
      <!-- BEGIN TABS TOGGLES -->
    </div>
    <!-- BEGIN FEED BODY -->
    <div class="body">
        <div class="tab-content">
             
              <!-- BEGIN SYSTEM FEEDS SECTION -->
              <div class="tab-pane fade in system-feeds active" id="system">
                <div class="content">
                 
                    @foreach ($posts as $post)
                      <div class="row">
                            <div class="span11" style="margin-left:62px;">
                                  <!-- Post Title -->
                                  <div class="row">
                                        <div class="span11">
                                              <h4><strong><a href="{{ $post->url() }}">{{ $post->title }}</a></strong></h4>
                                        </div>
                                  </div>

                                  <!-- Post Content -->
                                  <div class="row">
                                        
                                        <div class="span11">
                                              <p>
                                                    {{ htmlspecialchars_decode(Str::limit($post->content, 200))  }}
                                              </p>
                                        </div>
                                  </div>

                                  <!-- Post Footer -->
                                  <div class="row">
                                        <div class="span11">
                                              <p>
                                                    <i class="icon-user"></i> by <span class="muted">Blackeye Travels</span>
                                                    | <i class="icon-calendar"></i> {{ $post->created_at->diffForHumans() }}
                                                    
                                              </p>
                                        </div>
                                  </div>
                            </div>
                      </div>

                      <hr />
                    @endforeach

                    {{ $posts->links() }}
                   
                </div>
              </div>
              <!-- END SYSTEM FEEDS SECTION -->
        </div>
    </div>
    <!-- END FEED BODY -->
</section>  </div>
</div>


@stop
                  



@section('currentpagejs')


   <!-- BEGIN JAVASCRIPT CODES FOR THE CURRENT PAGE -->
        <script src="{{asset('assets/backend/plugins/jquery.fullcalendar/fullcalendar.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery.jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery.jqvmap/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery.jqvmap/data/jquery.vmap.sampledata.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery.flot/jquery.flot.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery.flot/jquery.flot.selection.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery.sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery.justgage/raphael.2.1.0.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery.gritter/jquery.gritter.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/bootstrap.daterangepicker/moment.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/bootstrap.daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery.pulsate/jquery.pulsate.min.js')}}"></script>

    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="/templates/social/assets/backend/plugins/jquery.flot/excanvas.min.js')}}"></script><![endif]-->

    <script src="{{asset('assets/backend/js/dashboard.js')}}"></script>

    <script>
      $(function() {
        var urlAvatar = "{{asset('assets/backend/img/avatar-55.png')}}";
          Dashboard.init({urlAvatar:urlAvatar});
        });
      </script>
    <!-- END JAVASCRIPT CODES FOR THE CURRENT PAGE -->      


@stop