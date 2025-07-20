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
        $c_phone = '';
        $c_movingdate1 = '';
        $c_name = '';
        $c_leadInfo = '';
         foreach($output as $string){
            if (strpos($string, 'Email') !== false) {
                $arr_val = explode(':', $string, 2); // Limit to 2 parts to handle cases with multiple colons
                if (isset($arr_val[1])) {
                    $email_part = trim($arr_val[1]);
                    
                    // Check if it's an HTML anchor tag with mailto
                    if (preg_match('/<a[^>]*href=["\']mailto:([^"\']+)["\'][^>]*>([^<]+)<\/a>/', $email_part, $matches)) {
                        $c_email = trim($matches[1]); // Extract email from mailto: link
                    } else {
                        // Strip any HTML tags and get plain text
                        $c_email = trim(strip_tags($email_part));
                    }
                } else {
                    $c_email = '---';
                }
            }

            if (strpos($string, 'Name') !== false) {
                $arr_val = explode(':', $string, 2); // Limit to 2 parts
                if (isset($arr_val[1])) {
                    $name_part = trim($arr_val[1]);
                    // Strip any HTML tags and get plain text
                    $c_name = trim(strip_tags($name_part));
                } else {
                    $c_name = '---';
                }
            }

            if (strpos($string, 'Phone Number') !== false) {
                $arr_val = explode(':', $string, 2); // Limit to 2 parts
                if (isset($arr_val[1])) {
                    $phone_part = trim($arr_val[1]);
                    $c_phone = trim(strip_tags($phone_part));
                } else {
                    $c_phone = '---';
                }
            }   

            if (strpos($string, 'Move Date') !== false) {
                $arr_val = explode(':', $string, 2); // Limit to 2 parts
                if (isset($arr_val[1])) {
                    $movingdate1_part = trim($arr_val[1]);
                    $c_movingdate1 = trim(strip_tags($movingdate1_part));
                } else {
                    $c_movingdate1 = '---';
                }
            }       

            if (strpos($string, 'Lead ID') !== false) {
                $arr_val = explode(':', $string, 2); // Limit to 2 parts
                if (isset($arr_val[1])) {
                    $leadInfo_part = trim($arr_val[1]);
                    $c_leadInfo = trim(strip_tags($leadInfo_part));
                } else {
                    $c_leadInfo = '---';
                }
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
                <div class="form-group  {{ $errors->has('customerPhone') ? 'has-error' : ''}}">
                    <label for="customerPhone" class="col-md-12 control-label">Customer Phone</label>
                    <div class="col-md-12">
                        <input id="customerPhone" type="tel" class="form-control" name="customerPhone" value="{{ $c_phone }}" required>
                        {!! $errors->first('customerPhone', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>                
                <div class="form-group  {{ $errors->has('movingdate1') ? 'has-error' : ''}}">
                    <label for="movingdate1" class="col-md-12 control-label">Moving Date</label>
                    <div class="col-md-12">
                        <input id="movingdate1" type="text" class="form-control" name="movingdate1" value="{{ $c_movingdate1 }}" required>
                        {!! $errors->first('movingdate1', '<p class="help-block">:message</p>') !!}
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
                <div class="form-group  {{ $errors->has('leadInfo') ? 'has-error' : ''}}">
                    <label for="leadInfo" class="col-md-12 control-label">Lead Info</label>
                    <div class="col-md-12">
                        <textarea id="leadInfo" type="text" class="form-control" name="leadInfo" value="{{ $c_leadInfo }}" required>{{ $c_leadInfo }}</textarea>
                        {!! $errors->first('leadInfo', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>                      


                   @if(count($extra_fields) > 0)
                    @foreach($extra_fields as $key => $field)
                    <div class="form-group">
                        <label class="col-md-12 control-label" for="{{ $field->field_name }}">{{ $field->field_name }}</label>
                        
                        @if($field->field1_type != 'null')
                        <div class="col-md-12 ">
                            @if($field->field1_type == 'radio')
                                <div style="margin-bottom: 10px;">
                                    <label style="margin-right: 15px;"><input type="radio" name="extra[value1][{{ $key }}]" value="yes" style="margin-right: 5px;">Yes</label>
                                    <label><input type="radio" name="extra[value1][{{ $key }}]" value="no" style="margin-right: 5px;">No</label>
                                </div>
                            @else
                                @if($field->field_name == 'Scale Fee')
                                <input type="{{ $field->field1_type }}" class="form-control" required="" name="extra[value1][{{ $key }}]" value="Standard" style="margin-bottom: 10px;">								
                                    
                                @elseif($field->field_name == 'Storage')
                                <input type="{{ $field->field1_type }}" class="form-control" required="" name="extra[value1][{{ $key }}]" value="Included" style="margin-bottom: 10px;">		
                                
                                @else
                                <input type="{{ $field->field1_type }}" class="form-control" required="" name="extra[value1][{{ $key }}]" style="margin-bottom: 10px;">		
                                    
                                @endif							
                            @endif
                        </div>
                        @endif

                        <div class="col-md-12 ">
                            @if($field->field_type == 'radio')
                                <div style="margin-bottom: 10px;">
                                    <label style="margin-right: 15px;"><input type="radio" name="extra[value][{{ $key }}]" value="yes" style="margin-right: 5px;">Yes</label>
                                    <label><input type="radio" name="extra[value][{{ $key }}]" value="no" style="margin-right: 5px;">No</label>
                                </div>
                            @else
                                @if($field->field_name == 'Scale Fee')
                                    <input type="{{ $field->field_type }}" class="form-control" required="" name="extra[value][{{ $key }}]" value="50.00">
                                    
                                @else
                                    <input type="{{ $field->field_type }}" class="form-control" required="" name="extra[value][{{ $key }}]">
                                    
                                @endif							
                            @endif
                            <input type="hidden" class="form-control" required="" name="extra[key][{{ $key }}]" value="{{ $field->field_name }}">
                            <input type="hidden" class="form-control" required="" name="extra[type][{{ $key }}]" value="{{ $field->field_type }}">
                            <input type="hidden" class="form-control" required="" name="extra[type1][{{ $key }}]" value="{{ $field->field1_type }}">
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
