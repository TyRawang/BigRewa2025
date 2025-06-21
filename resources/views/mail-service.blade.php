@extends('layouts.app')

<style>
    /* Modern form styling */
    .mail-service-container {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 20px 0;
    }
    
    .form-panel {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: none;
        overflow: hidden;
        margin-top: 0;
    }
    
    .form-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 25px 30px;
        margin: 0;
        font-size: 24px;
        font-weight: 600;
        text-align: center;
        border-radius: 12px 12px 0 0;
    }
    
    .form-body {
        padding: 40px 50px !important;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: white;
    }
    
    .form-group {
        margin-bottom: 25px !important;
    }
    
    .control-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
        font-size: 14px;
        letter-spacing: 0.5px;
    }
    
    .form-control {
        border: 2px solid #e1e8ed;
        border-radius: 8px;
        padding: 12px 16px;
        font-size: 14px;
        line-height: 1.5;
        transition: all 0.3s ease;
        background-color: #fff;
        color: #2c3e50;
    }
    
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
        background-color: #fff;
    }
    
    .form-control:hover {
        border-color: #bdc3c7;
    }
    
    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }
    
    /* Radio button styling */
    .radio-group {
        display: flex;
        gap: 20px;
        margin-top: 8px;
    }
    
    .radio-group label {
        display: flex;
        align-items: center;
        font-weight: 400;
        color: #2c3e50;
        cursor: pointer;
        margin-bottom: 0;
    }
    
    .radio-group input[type="radio"] {
        margin-right: 8px;
        transform: scale(1.2);
    }
    
    /* Submit button styling */
    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 8px;
        padding: 15px 30px;
        font-size: 16px;
        font-weight: 600;
        color: white;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
    }
    
    .btn-submit:active {
        transform: translateY(0);
    }
    
    /* Alert styling */
    .alert {
        border-radius: 8px;
        border: none;
        padding: 15px 20px;
        margin-bottom: 25px;
        font-weight: 500;
    }
    
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-left: 4px solid #28a745;
    }
    
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-left: 4px solid #dc3545;
    }
    
    /* Error styling */
    .has-error .form-control {
        border-color: #e74c3c;
    }
    
    .help-block {
        color: #e74c3c;
        font-size: 12px;
        margin-top: 5px;
        font-weight: 500;
    }
    
    /* Extra fields styling */
    .extra-field-section {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin: 25px 0;
        border-left: 4px solid #667eea;
    }
    
    .extra-field-title {
        color: #667eea;
        font-weight: 600;
        margin-bottom: 15px;
    }
    
    /* Moving date fields */
    .moving-date-group {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-top: 10px;
    }
    
    @media (max-width: 768px) {
        .moving-date-group {
            grid-template-columns: 1fr;
        }
        
        .form-body {
            padding: 30px 25px !important;
        }
        
        .radio-group {
            flex-direction: column;
            gap: 10px;
        }
        
        .mail-service-container {
            padding: 10px 0;
        }
    }
    
    /* Dashboard panel styling */
    .dashboard-panel {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }
    
    .dashboard-panel .panel-body {
        padding: 20px;
    }
    
    /* Remove any default container padding that might cause white strips */
    .container, .container-fluid {
        padding-left: 15px;
        padding-right: 15px;
    }
    
    /* Ensure no white background bleeds through */
    body {
        background: transparent;
    }
</style>

@section('content')

<home :user="user" inline-template>

    <div class="mail-service-container">

        <!-- Application Dashboard -->
        @if (session('status') || session()->has('success_message') || session()->has('error_message'))
        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="panel panel-default dashboard-panel">

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
        @endif







{{--         Form for email--}}



<div class="row justify-content-center">

    <div class="col-md-10">

        <div class="form-panel">
        
            <div class="form-header">
                📧 Send Quote Email
            </div>

            <div class="form-body">

                <form class="form-horizontal" method="GET" action="{{ route('send_ticket_mail') }}">

                    {{ csrf_field() }}

                    <?php 

                        if(count($errors) > 0){

                            // print_r($errors);die; 

                        }

                    ?>



                    <!-- <div class="form-group">

                        <label for="leadsProInfo" class="col-md-4 control-label" >Leads Pro Info</label>

                        <div class="col-md-6">

                            <textarea style="width: 540px; height: 400px;"id="leadsProInfo" type="text" class="form-control" name="leadsProInfo" v-on:input="populateForm($event.target.value)" required autofocus></textarea>

                        </div>

                    </div> -->

                    <div class="form-group  {{ $errors->has('subject') ? 'has-error' : ''}}">

                        <label for="subject" class="col-md-12 control-label">Subject</label>

                        <div class="col-md-12">

                            <input id="subject" type="text" class="form-control" name="subject" required value="{{ (old('subject')) ? old('subject') : 'Quote For Your Upcoming Move' }}">

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

                            <input id="customerName" type="text" class="form-control" name="customerName" value="{{  old('customerName') }}" required>

                            {!! $errors->first('customerName', '<p class="help-block">:message</p>') !!}

                        </div>

                    </div>

                    <div class="form-group  {{ $errors->has('customerEmail') ? 'has-error' : ''}}">

                        <label for="customerEmail" class="col-md-12 control-label">Customer Email</label>

                        <div class="col-md-12">

                            <input id="customerEmail" type="email" class="form-control" name="customerEmail" value="{{  old('customerEmail') }}" required>

                            {!! $errors->first('customerEmail', '<p class="help-block">:message</p>') !!}

                        </div>

                    </div>

                    <div class="form-group  {{ $errors->has('customerPhone') ? 'has-error' : ''}}">

                        <label for="customerPhone" class="col-md-12 control-label">Customer Phone Number</label>

                        <div class="col-md-12">

                            <input id="customerPhone" type="text" class="form-control" name="customerPhone" value="{{  old('customerPhone') }}" required>

                            {!! $errors->first('customerPhone', '<p class="help-block">:message</p>') !!}

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
                    <div class="extra-field-section">
                        <div class="extra-field-title">Additional Services</div>
                        @foreach($extra_fields as $key => $field)
                        <div class="form-group">
                            <label class="col-md-12 control-label" for="{{ $field->field_name }}">{{ $field->field_name }}</label>

    						@if($field->field1_type != 'null')
                            <div class="col-md-12 ">
                                @if($field->field1_type == 'radio')
                                    <div class="radio-group">
                                        <label><input type="radio" name="extra[value1][{{ $key }}]" value="yes">Yes</label>
                                        <label><input type="radio" name="extra[value1][{{ $key }}]" value="no">No</label>
                                    </div>
                                @else
    								@if($field->field_name == 'Scale Fee')
    								<input type="{{ $field->field1_type }}" class="form-control" required="" name="extra[value1][{{ $key }}]" value="Standard">								
    									
    								@elseif($field->field_name == 'Storage')
    								<input type="{{ $field->field1_type }}" class="form-control" required="" name="extra[value1][{{ $key }}]" value="Included">		
    								
    								@else
    								<input type="{{ $field->field1_type }}" class="form-control" required="" name="extra[value1][{{ $key }}]">		
    									
    								@endif							
                            @endif
    						</div>
    						@endif

    						<br/>
                            <div class="col-md-12 ">
                                @if($field->field_type == 'radio')
                                    <div class="radio-group">
                                        <label><input type="radio" name="extra[value][{{ $key }}]" value="yes">Yes</label>
                                        <label><input type="radio" name="extra[value][{{ $key }}]" value="no">No</label>
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
                    </div>
                    @endif

                    <div class="form-group  {{ $errors->has('movingdate') ? 'has-error' : ''}}">

                        <label for="movingdate1" class="col-md-12 control-label">Possible Moving Dates</label>

                        <div class="moving-date-group">
                            <div>
                                <input id="movingdate1" type="text" class="form-control" name="movingdate1" required value="{{ (old('movingdate1')) ? old('movingdate1') : '' }}" placeholder="First preferred date">
                                {!! $errors->first('movingdate1', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div>
                                <input id="movingdate2" type="text" class="form-control" name="movingdate2" required value="{{ (old('movingdate2')) ? old('movingdate2') : 'N.A.' }}" placeholder="Alternative date">
                                {!! $errors->first('movingdate2', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>					
                        
                    </div>

                    <div class="form-group  {{ $errors->has('leadInfo') ? 'has-error' : ''}}">

                        <label for="leadInfo" class="col-md-12 control-label">Lead Information</label>

                        <div class="col-md-12">

							<textarea rows = "5" cols = "60" name = "leadInfo" id="leadInfo" class="form-control" placeholder="Enter additional lead information here...">{{ (old('leadInfo')) ? old('leadInfo') : '' }}</textarea>

                            {!! $errors->first('leadInfo', '<p class="help-block">:message</p>') !!}

                        </div>
                        
                    </div>


                    <div class="form-group">

                        <div class="col-md-12">

                            <button type="submit" class="btn btn-submit btn-lg btn-block">Send Quote Email</button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

    </div>

</home>

@endsection

@section('customscripts')

<script>
    window.addEventListener('load', function () {
        // Plain JavaScript to replace Vue.js functionality
        
        // Global variables to store form data
        let leadsInfo = '';
        let lead = '';
        let array = '';
        let arry = '';
        
        let movingInfo = {
            leadId: '',
            cName: '',
            pNumber: '',
            email: '',
            movingFromCountry: '',
            movingFromState: '',
            movingFromCity: '',
            movingFromZip: '',
            movingToCountry: '',
            movingToState: '',
            movingToCity: '',
            movingToZip: '',
            moveDate: '',
            moveSize: '',
            storageDuration: '',
            carTransport: '',
            vehicleYear: '',
            vehicleMake: '',
            vehicleModel: ''
        };

        // Function to populate form (equivalent to Vue's populateForm method)
        function populateForm(pass) {
            arry = pass.split('\n');
            
            movingInfo.cName = parseLeads(arry[1]);
            movingInfo.email = parseLeads(arry[3]);
            movingInfo.movingFromCity = parseLeads(arry[7]);
            movingInfo.movingToCity = parseLeads(arry[12]);
            
            // Update form fields if they exist
            updateFormFields();
        }

        // Function to parse leads (equivalent to Vue's parseLeads method)
        function parseLeads(a) {
            var b = a.split(':'); 
            var c = b[1];
            return c; 
        }

        // Function to update form fields with parsed data
        function updateFormFields() {
            // Update customer name field
            const customerNameField = document.getElementById('customerName');
            if (customerNameField && movingInfo.cName) {
                customerNameField.value = movingInfo.cName;
            }
            
            // Update customer email field
            const customerEmailField = document.getElementById('customerEmail');
            if (customerEmailField && movingInfo.email) {
                customerEmailField.value = movingInfo.email;
            }
            
            // You can add more field updates here as needed
        }

        // Make populateForm function globally available if needed
        window.populateForm = populateForm;
    });
</script>

@endsection

