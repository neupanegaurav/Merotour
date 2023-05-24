@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Agent Backend ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">
               Agent Backend
               <div class="pull-right" style="font-size:14px;line-height: 20px;">

                                  <?php 
                                     
                                    $user = Sentry::getUser();
                            
                                    $id = $user->id;

                                    $fund = Funds::where('user_id', $id)->first();
                                    
                                    if (isset($fund)) {
                                    echo "Available Balance: " . $fund->balance . '<br>';
                                    
                                    }
                                    echo 'Credit Limit: ' . $user->credit_limit;

                                  ?>
      
                </div>
            </h3>
            <!-- BEGIN BREADCRUMBS -->
                  <ul class="breadcrumb">
                      <li>
                          <i class="icon-home"></i>
                          Agent Backend
                              </li>
                               
                                                             
                  </ul>
                  <!-- END BREADCRUMBS -->
        </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN DYNAMIC TABLE EXAMPLE -->
        <div class="social-box">
   
    <!-- BEGIN TABLE BODY -->
    <div class="body">
   
        <!-- BEGIN TABLE DATA -->
        @foreach ($posts as $post)
<div class="row" style="margin-left:40px;">
      <div class="span8">
            <!-- Post Title -->
            <div class="row">
                  <div class="span8">
                        <h4><strong><a href="{{ $post->url() }}">{{ $post->title }}</a></strong></h4>
                  </div>
            </div>

            <!-- Post Content -->
            <div class="row">
                  <div class="span2">
                        <a href="{{ $post->url() }}" class="thumbnail"><img src="{{ $post->thumbnail() }}" alt=""></a>
                  </div>
                  <div class="span6">
                        <p>
                              {{ htmlspecialchars_decode(Str::limit($post->content, 200))  }}
                        </p>
                  </div>
            </div>

            <!-- Post Footer -->
            <div class="row">
                  <div class="span8">
                        <p></p>
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



                          <!-- END TABLE DATA -->
                      </div>
                  <!-- END TABLE BODY -->
            </div>        <!-- END DYNAMIC TABLE EXAMPLE -->
    </div>
</div>
         



@stop
