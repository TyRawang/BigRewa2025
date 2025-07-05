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
    @foreach($messages as $mess)
       <div class="col-sm-4" style="font-size: 14px;line-height: 13px;">
           <div class="box {{ (in_array('UNREAD', $mess->getLabelIds())) ?  'unread-bordered' : '' }}">
              <a href="{{ url('google/mail/details/'.$mess->getId().'/'.str_replace(' ', '-', $mess->getSubject())) }}"><h2> {{ $mess->getSubject() }} </h2> </a>
              <i style="font-size:12px;"><span  class="fa fa-calendar"></span> {{ $mess->getDate() }}</i>
              <h6><span style="font-weight:900; font-size:12px;">{{ $mess->getFromName() . " (" .$mess->getFromEmail().")" }}</span></h6>
              
              <hr>
              
              <?php 
                
                $string =  $mess->getHtmlBody();
                
                $output = explode("<br>", $string);
                
                ?>
              {!! Auth::user()->getMailShortBody($output) !!}
                <hr>
                <div class="text-center">
                    <a class="btn btn-primary btn-lg btn-block" href="{{ url('google/mail/details/'.$mess->getId().'/'.str_replace(' ', '-', $mess->getSubject())) }}"> <i class="fa fa-eye"></i> View</a>
                </div>
        </div>
    </div>
    @endforeach
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
        padding: 20px 10px;
        box-shadow: 0px 2px 18px 5px #bbb7b7;
        margin-bottom:15px;
    }
    
    .cont-bx .box h2 {
        font-size: 15px;
        color: #80b951;
        font-weight: 700;
    }
    .unread-bordered{
        border : 2px solid #d45a5a !important;
    }
</style>
@endsection

@section('customscripts')
@endsection
