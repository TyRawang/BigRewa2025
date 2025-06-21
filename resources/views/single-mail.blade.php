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
                {!! $message->getHtmlBody() !!}
            </div>
        </div>
       
   </div>
    <?php          
        $string =  $message->getHtmlBody();
        $output = explode("<br>", $string);
        $c_email = '';
        $c_name = '';
         foreach($output as $string){
            if (strpos($string, 'Email') !== false) {
                $arr_val = explode(':', $string);
                $c_email = (isset($arr_val[1])) ? $arr_val[1] : '---';
            }

            if (strpos($string, 'Name') !== false) {
                $arr_val = explode(':', $string);
                $c_name = (isset($arr_val[1])) ? $arr_val[1] : '---';
            }
         }
    ?>
   <div class="col-lg-6" style="border-right:1px solid #DDD">
        <!--<form class="form-horizontal" method="POST" action="{{ url('mail_reply') }}" style="width: 100%;top: 122px;border: 2px solid #DDD;padding: 20px;border-radius: 50px;box-shadow: 0px 0px 22px 6px #DDD;">-->
                
           <form class="form-horizontal" method="GET" action="{{ route('send_ticket_mail') }}" style="width: 100%;top: 122px;border: 2px solid #DDD;padding: 20px;border-radius: 50px;box-shadow: 0px 0px 22px 6px #DDD;">      
                {{ csrf_field() }}
                
                <div class="form-group">
                        <h3 class="text-center">Reply</h3>
                </div>
                
                <div class="form-group">
                      <hr>
                      <p>Email : <b>{{ $c_email }}</b><small> | <i>  ({{ $message->getDate() }})</i></small></p>
                      <p>subject : <b>{{ $message->getSubject() }}</b></p>
                      <hr>
                </div>
                
                <div class="form-group  {{ $errors->has('email') ? 'has-error' : ''}}" style="display:none;">
                    <label for="email" class="col-md-12 control-label">Email</label>
                    <div class="col-md-12">
                        <input id="email" type="text" readonly="readonly" class="form-control" name="email" required autofocus value="{{ $message->getFromEmail() }}">
                        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group  {{ $errors->has('subject') ? 'has-error' : ''}}">
                    <label for="subject" class="col-md-12 control-label">Subject</label>
                    <div class="col-md-12">
                        <input id="subject" type="text" class="form-control" name="subject" required autofocus value="">
                        {!! $errors->first('subject', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                
                <div class="form-group  {{ $errors->has('employeeName') ? 'has-error' : ''}}">
                    <label for="employeeName" class="col-md-12 control-label">Employee Name</label>
                    <div class="col-md-12">
                        <input id="employeeName" type="text" class="form-control" name="employeeName" required autofocus value="{{  old('employeeName') }}">
                        {!! $errors->first('employeeName', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                
                <div class="form-group  {{ $errors->has('customerName') ? 'has-error' : ''}}">
                    <label for="customerName" class="col-md-12 control-label">Customer Name</label>
                    <div class="col-md-12">
                        <input id="customerName" type="text" class="form-control" name="customerName" value="{{  $c_name }}" required>
                        {!! $errors->first('customerName', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group  {{ $errors->has('customerEmail') ? 'has-error' : ''}}">
                    <label for="customerEmail" class="col-md-12 control-label">Customer Email</label>
                    <div class="col-md-12">
                        <input id="customerEmail" type="email" class="form-control" name="customerEmail" value="{{ $c_email }}" required>
                        {!! $errors->first('customerEmail', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                
                <div class="form-group  {{ $errors->has('estimatedWeight') ? 'has-error' : ''}}">
                    <label for="estimatedWeight" class="col-md-12 control-label">Estimated Weight</label>
                    <div class="col-md-12">
                        <input id="estimatedWeight" type="number" class="form-control" name="estimatedWeight" value="{{  old('estimatedWeight') }}" required >
                        {!! $errors->first('estimatedWeight', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group  {{ $errors->has('costPerPound') ? 'has-error' : ''}}">
                    <label for="costPerPound" class="col-md-12 control-label">Cost Per Pound</label>
                    <div class="col-md-12">
                        <input id="costPerPound" type="decimal" class="form-control" name="costPerPound"  value="{{  old('costPerPound') }}" required >
                        {!! $errors->first('costPerPound', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                   @if(count($extra_fields) > 0)
                    @foreach($extra_fields as $key => $field)
                    <div class="form-group">
                        <label class="col-md-12 control-label" for="{{ $field->field_name }}">{{ $field->field_name }}</label>
                        <div class="col-md-12 ">
                            @if($field->field_type == 'radio')
                                  <label><input type="radio" check
                                   name="extra[value][{{ $key }}]" value="yes">Yes</label>
                                   <label><input type="radio"  check
                                   name="extra[value][{{ $key }}]" value="no">No</label>
                            @else
                            <input type="{{ $field->field_type }}" class="form-control" required="" name="extra[value][{{ $key }}]">

                            @endif
                            <input type="hidden" class="form-control" required="" name="extra[key][{{ $key }}]" value="{{ $field->field_name }}">
                            <input type="hidden" class="form-control" required="" name="extra[type][{{ $key }}]" value="{{ $field->field_type }}">
                        </div>
                    </div>
                    @endforeach
                @endif


                <!--<div class="form-group  {{ $errors->has('message') ? 'has-error' : ''}}">-->
                <!--    <label for="message" class="col-md-12 control-label">Message </label>-->
                <!--    <div class="col-md-12">-->
                <!--        <textarea id="message" type="text" class="form-control" name="message" required  row="5"></textarea>-->
                <!--        {!! $errors->first('message', '<p class="help-block">:message</p>') !!}-->
                <!--    </div>-->
                <!--</div>-->
				
                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Reply</button>
                    </div>
                </div>
            </form>
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
