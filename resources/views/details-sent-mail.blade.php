@extends('layouts.app')

@section('content')

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



<div class="row justify-content-center" style="background: #fff; padding:25px;">
   <div class="col-lg-6"  style="border-right:1px solid #DDD">
        <div class="panel-body ">
            <div>
                <a href="#"><h2> {{ $data->subject }} </h2> </a>
                  <i style="font-size:12px;"><span  class="fa fa-calendar"></span> {{ date('d-m-y', strtotime($data->created_at)) }}</i>
                  <h6><span style="font-weight:900; font-size:12px;">{{ $data->customerName . " (" .$data->customerEmail.")" }}</span></h6>
               
                  <hr>
                  <p> Estimated Weight :  {{ $data->estimatedWeight }} </p> 
                  <p> Cost Per Pound :  {{ $data->costPerPound }}</p>
                  <p> Total :  {{ $data->total }}</p>
                  <p> Final Total :  {{ $data->final_amount }}</p>
              <hr>
                
            </div>
        </div>
       
   </div>
  
   <div class="col-lg-6" style="border-right:1px solid #DDD">


        @if($data->status == 2 || $data->status == 3)

        @if($data->status == 2)

            <h1 style="text-align: center;margin-top: 100px;color: green;font-weight: 900;font-size: 70px;">Accepted</h1>

        @else

            <h1 style="text-align: center;margin-top: 100px;color: red;font-weight: 900;font-size: 70px;">Rejected</h1>
        @endif

        @else
                
           <form class="form-horizontal" method="post" action="{{ url('update_send_mail_status') }}" style="width: 100%;top: 122px;border: 2px solid #DDD;padding: 20px;border-radius: 50px;box-shadow: 0px 0px 22px 6px #DDD;">      
                {{ csrf_field() }}
                
                <div class="form-group">
                    <h3 class="text-center">Update Status</h3>
                </div>

                <div class="form-group col-md-12">
                    <label for="status">Status</label>
                    <br>
                     <label style="font-weight: 600;margin-right: 10px"><input @if($data->status == 0) checked="checked" @endif value="0" type="radio" name="status">Sent</label>
                    <label style="font-weight: 600; margin-right: 10px"><input @if($data->status == 1) checked="checked" @endif  value="1" type="radio" name="status">Waiting</label>
                    <label style="font-weight: 600; margin-right: 10px"><input @if($data->status == 2) checked="checked" @endif  value="2" type="radio" name="status">Accepted</label>
                    <label style="font-weight: 600; margin-right: 10px"><input @if($data->status == 3) checked="checked" @endif  value="3" type="radio" name="status">Rejected</label>
                    <label style="font-weight: 600; margin-right: 10px"><input @if($data->status == 4) checked="checked" @endif  value="4" type="radio" name="status">Negotiate</label>
                </div>

                <div class="col-md-12 info-box" style="display: none;">

                     <div class="form-group">
                        <label for="final_amount">Final Cost</label>
                        <input type="text" name="final_amount" id="final_amount" class="form-control">
                    </div>
                </div> 

                <input type="hidden" name="id" id="id" value="{{ $data->id }}">
                 <div class="form-group col-md-12">
                    <label for="note">Note</label>
                    <textarea name="note" id="note" class="form-control" rows="5"></textarea>
                </div>

                
                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                    </div>
                </div>
            </form>

        @endif
   </div>
</div>
    </div>
@endsection
@section('customcss')
<style>
    body{
        padding:0px !important;
        
    }
</style>
@endsection
@section('customscripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(function(){
        $('body').on('change', 'input[name="status"]', function(){
            var status = $(this).val();
            if(status == 2){
                $('.info-box').show();
            }else{
                $('.info-box').hide();
            }
        });

    });
</script>
@endsection
