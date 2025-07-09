@extends('layouts.app')

@section('content')
<home :user="user" inline-template>
    <div class="container">
        <!-- Application Dashboard -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <!-- <div class="panel-heading">Dashboard</div> -->
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(session()->has('success_message'))
                            <div class="alert alert-success">
                                {{ session()->get('success_message') }}
                            </div>
                        @endif

                        @if(session()->has('error_message'))
                            <div class="alert alert-danger">
                                {{ session()->get('error_message') }}
                            </div>
                        @endif

                        <!-- You are logged in! -->
                    </div>
                </div>
            </div>
        </div>



{{--         Form for email--}}

<div class="row cont-bx">
    @if(count($messages) > 0)
    
    <!-- Pagination Info -->
    <div class="col-sm-12 mb-3">
        <div class="pagination-info" style="background: #f8f9fa; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
            <!-- <strong>Total emails found:</strong> {{ isset($resultSizeEstimate) ? $resultSizeEstimate : 'Loading...' }} -->
            <span class="pull-right">Showing {{ count($messages) }} emails per page</span>
        </div>
    </div>
    
    @foreach($messages as $mess)
       <div class="col-sm-4" style="font-size: 14px;line-height: 13px;">
           <div class="box {{ (in_array('UNREAD', $mess->getLabelIds())) ?  'unread-bordered' : '' }}">
              
              <!-- Email Header -->
              <div class="box-header">
                  <a href="{{ url('google/mail/details/'.$mess->getId().'/'.str_replace(' ', '-', $mess->getSubject())) }}">
                      <h2>{{ $mess->getSubject() }}</h2>
                  </a>
              </div>
              
              <!-- Email Meta Info -->
              <div class="email-meta">
                  <i style="font-size:12px;"><span class="fa fa-calendar"></span> {{ $mess->getDate() }}</i>
                  <h6><span style="font-weight:900; font-size:12px;">{{ $mess->getFromName() . " (" .$mess->getFromEmail().")" }}</span></h6>
              </div>
              
              <hr style="margin: 10px 0;">
              
              <!-- Email Content Preview -->
              <div class="box-content">
                  <?php 
                    $string =  $mess->getHtmlBody();
                    $output = explode("<br>", $string);
                  ?>
                  <div class="email-preview">
                      {!! Auth::user()->getMailShortBody($output) !!}
                  </div>
              </div>
              
              <!-- Email Footer -->
              <div class="box-footer">
                  <hr style="margin: 10px 0;">
                  <div class="text-center">
                      <a class="btn btn-primary btn-lg btn-block" href="{{ url('google/mail/details/'.$mess->getId().'/'.str_replace(' ', '-', $mess->getSubject())) }}"> 
                          <i class="fa fa-eye"></i> View
                      </a>
                  </div>
              </div>
              
           </div>
       </div>
    @endforeach
    
    <!-- Pagination Controls -->
    <div class="col-sm-12">
        <nav aria-label="Gmail pagination">
            <ul class="pagination justify-content-center" style="margin-top: 30px;">
                @if(isset($currentPageToken) && $currentPageToken)
                    <li class="page-item">
                        <a class="page-link" href="{{ url('google-inbox') }}" aria-label="First">
                            <span aria-hidden="true">&laquo;&laquo; First</span>
                        </a>
                    </li>
                @endif
                
                @if(isset($nextPageToken) && $nextPageToken)
                    <li class="page-item">
                        <a class="page-link" href="{{ url('google-inbox') }}?pageToken={{ $nextPageToken }}" aria-label="Next">
                            <span aria-hidden="true">Next &raquo;</span>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">No more emails</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
    
    @else
    <div class="col-sm-12">
        <h1 class="text-center">No Mail Found</h1>
    </div>
    @endif
</div>
    </div>
</home>
@endsection
@section('customcss')
<style>
    .cont-bx .box {
        background: #FFF;
        border: 2px solid #bbb7b7;
        padding: 15px;
        box-shadow: 0px 2px 18px 5px #bbb7b7;
        margin-bottom: 15px;
        height: 350px !important; /* Force fixed height */
        max-height: 350px !important; /* Prevent growth */
        min-height: 350px !important; /* Prevent shrinking */
        display: flex;
        flex-direction: column;
        overflow: hidden;
        transition: all 0.3s ease;
        border-radius: 8px;
        position: relative;
    }
    
    .cont-bx .box:hover {
        transform: translateY(-5px);
        box-shadow: 0px 4px 25px 8px rgba(187, 183, 183, 0.4);
        border-color: #80b951;
    }
    
    /* Fixed Header Section */
    .box-header {
        height: 45px !important; /* Strict fixed height */
        max-height: 45px !important;
        min-height: 45px !important;
        overflow: hidden;
        margin-bottom: 8px;
        flex-shrink: 0;
    }
    
    .cont-bx .box h2 {
        font-size: 14px !important;
        color: #80b951;
        font-weight: 700;
        margin: 0 !important;
        padding: 0 !important;
        height: 45px !important; /* Match header height */
        max-height: 45px !important;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        line-height: 1.6 !important;
        text-overflow: ellipsis;
        word-wrap: break-word;
        hyphens: auto;
    }
    
    .box-header a {
        text-decoration: none;
        display: block;
        height: 45px;
        overflow: hidden;
    }
    
    /* Fixed Meta Section */
    .email-meta {
        height: 40px !important; /* Strict fixed height */
        max-height: 40px !important;
        min-height: 40px !important;
        font-size: 11px;
        color: #666;
        margin-bottom: 8px;
        overflow: hidden;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    
    .email-meta i {
        font-size: 11px !important;
        line-height: 1.2;
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .email-meta h6 {
        margin: 2px 0 0 0 !important;
        font-size: 11px !important;
        font-weight: 900;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        line-height: 1.2;
    }
    
    /* Fixed HR */
    .box hr {
        margin: 8px 0 !important;
        height: 1px;
        flex-shrink: 0;
    }
    
    /* Fixed Content Section */
    .box-content {
        height: 130px !important; /* Strict fixed height */
        max-height: 130px !important;
        min-height: 130px !important;
        overflow: hidden;
        margin-bottom: 8px;
        flex-shrink: 0;
    }
    
    .box-content .email-preview {
        height: 130px !important; /* Match content height */
        max-height: 130px !important;
        overflow: hidden;
        font-size: 12px !important;
        line-height: 1.3 !important;
        display: -webkit-box;
        -webkit-line-clamp: 10;
        -webkit-box-orient: vertical;
        text-overflow: ellipsis;
        word-wrap: break-word;
        margin: 0;
        padding: 0;
    }
    
    /* Fixed Footer Section */
    .box-footer {
        height: 50px !important; /* Strict fixed height */
        max-height: 50px !important;
        min-height: 50px !important;
        margin-top: auto;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }
    
    .box-footer hr {
        margin: 4px 0 8px 0 !important;
    }
    
    .box-footer .text-center {
        height: 38px;
        display: flex;
        align-items: center;
    }
    
    .box-footer .btn {
        font-size: 12px !important;
        padding: 6px 12px !important;
        height: 32px !important;
        line-height: 1.2 !important;
        width: 100%;
    }
    
    /* Unread styling */
    .unread-bordered {
        border: 2px solid #d45a5a !important;
        position: relative;
    }
    
    .unread-bordered::before {
        content: "NEW";
        position: absolute;
        top: -2px;
        right: -2px;
        background: #d45a5a;
        color: white;
        font-size: 9px;
        font-weight: bold;
        padding: 3px 6px;
        border-radius: 0 8px 0 8px;
        z-index: 10;
    }
    
    .unread-bordered:hover {
        border-color: #c44444 !important;
    }
    
    /* Ensure equal height columns */
    .cont-bx .col-sm-4 {
        display: flex;
        margin-bottom: 20px;
        align-items: stretch;
    }
    
    .cont-bx .col-sm-4 .box {
        width: 100%;
    }
    
    /* Pagination Styles */
    .pagination-info {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        border: 1px solid #dee2e6;
        font-size: 14px;
    }
    
    .pagination {
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 2px 8px 2px rgba(0,0,0,0.1);
    }
    
    .pagination .page-link {
        color: #80b951;
        border-color: #80b951;
        padding: 8px 16px;
        margin: 0 5px;
        border-radius: 5px;
    }
    
    .pagination .page-link:hover {
        background-color: #80b951;
        color: white;
        border-color: #80b951;
    }
    
    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #fff;
        border-color: #dee2e6;
    }
    
    /* Mobile Responsive */
    @media (max-width: 768px) {
        .cont-bx .box {
            height: 320px !important;
            max-height: 320px !important;
            min-height: 320px !important;
            padding: 12px;
        }
        
        .box-header {
            height: 40px !important;
            max-height: 40px !important;
            min-height: 40px !important;
        }
        
        .cont-bx .box h2 {
            height: 40px !important;
            max-height: 40px !important;
            font-size: 13px !important;
        }
        
        .email-meta {
            height: 35px !important;
            max-height: 35px !important;
            min-height: 35px !important;
        }
        
        .box-content {
            height: 110px !important;
            max-height: 110px !important;
            min-height: 110px !important;
        }
        
        .box-content .email-preview {
            height: 110px !important;
            max-height: 110px !important;
            -webkit-line-clamp: 8;
            font-size: 11px !important;
        }
        
        .box-footer {
            height: 45px !important;
            max-height: 45px !important;
            min-height: 45px !important;
        }
        
        .pagination-info .pull-right {
            float: none !important;
            display: block;
            margin-top: 10px;
        }
        
        .pagination {
            padding: 10px;
        }
        
        .pagination .page-link {
            padding: 6px 12px;
            font-size: 12px;
        }
    }
    
    @media (max-width: 576px) {
        .cont-bx .box {
            height: 280px !important;
            max-height: 280px !important;
            min-height: 280px !important;
            padding: 10px;
        }
        
        .box-header {
            height: 35px !important;
            max-height: 35px !important;
            min-height: 35px !important;
        }
        
        .cont-bx .box h2 {
            height: 35px !important;
            max-height: 35px !important;
            font-size: 12px !important;
        }
        
        .email-meta {
            height: 30px !important;
            max-height: 30px !important;
            min-height: 30px !important;
        }
        
        .box-content {
            height: 90px !important;
            max-height: 90px !important;
            min-height: 90px !important;
        }
        
        .box-content .email-preview {
            height: 90px !important;
            max-height: 90px !important;
            -webkit-line-clamp: 6;
            font-size: 10px !important;
        }
        
        .box-footer {
            height: 40px !important;
            max-height: 40px !important;
            min-height: 40px !important;
        }
    }
    
    /* Force text truncation for any overflow */
    .cont-bx .box * {
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
</style>
@endsection

@section('customscripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add loading indicator for pagination links
    const paginationLinks = document.querySelectorAll('.pagination .page-link');
    
    paginationLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            if (!this.parentElement.classList.contains('disabled')) {
                // Show loading indicator
                const loadingHtml = `
                    <div id="loading-overlay" style="
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background: rgba(255,255,255,0.8);
                        z-index: 9999;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        font-size: 18px;
                    ">
                        <div style="text-align: center;">
                            <div class="spinner-border text-success" role="status" style="width: 3rem; height: 3rem;">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div style="margin-top: 15px; color: #80b951; font-weight: bold;">
                                Loading emails...
                            </div>
                        </div>
                    </div>
                `;
                document.body.insertAdjacentHTML('beforeend', loadingHtml);
            }
        });
    });
    
    // Auto-refresh indicator for real-time updates (optional)
    const refreshButton = document.createElement('button');
    refreshButton.innerHTML = '<i class="fa fa-refresh"></i> Refresh';
    refreshButton.className = 'btn btn-success btn-sm';
    refreshButton.style.cssText = 'position: fixed; bottom: 20px; right: 20px; z-index: 1000; border-radius: 25px; padding: 10px 20px;';
    refreshButton.addEventListener('click', function() {
        window.location.reload();
    });
    
    // Add refresh button to page
    document.body.appendChild(refreshButton);
});
</script>
@endsection
