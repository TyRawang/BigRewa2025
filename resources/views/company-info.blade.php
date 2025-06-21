@extends('layouts.app')

@section('content')

<style>
    .company-info-container {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 20px 0;
    }
    
    .dashboard-panel {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border: none;
        margin-bottom: 30px;
    }
    
    .panel-heading {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px 30px;
        font-size: 24px;
        font-weight: 600;
        text-align: center;
        border-radius: 12px 12px 0 0;
        margin: 0;
        border: none;
    }
    
    .panel-body {
        padding: 25px 30px !important;
    }
    
    .main-content {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border: none;
        padding: 40px 50px;
        margin-top: 20px;
    }
    
    .form-control {
        border: 2px solid #e1e8ed;
        border-radius: 8px;
        padding: 12px 16px;
        font-size: 14px;
        line-height: 1.5;
        background-color: #fff;
        color: #2c3e50;
        transition: all 0.3s ease;
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
        min-height: 120px;
    }
    
    .control-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
        font-size: 14px;
        letter-spacing: 0.5px;
    }
    
    .form-group {
        margin-bottom: 25px !important;
    }
    
    .btn-primary {
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
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        color: white;
    }
    
    .btn-primary:active {
        transform: translateY(0);
    }
    
    .logo-section {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 25px;
        border: 2px dashed #e1e8ed;
        text-align: center;
    }
    
    .logo-preview {
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border: 2px solid #e1e8ed !important;
    }
    
    .file-input {
        margin-top: 15px;
    }
    
    .alert {
        border-radius: 8px;
        border: none;
        padding: 15px 20px;
        margin-bottom: 20px;
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
    
    .has-error .form-control {
        border-color: #e74c3c;
    }
    
    .help-block {
        color: #e74c3c;
        font-size: 12px;
        margin-top: 5px;
        font-weight: 500;
    }
    
    .company-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        margin-bottom: 30px;
        text-align: center;
    }
    
    .company-header h3 {
        margin: 0;
        font-size: 20px;
        font-weight: 600;
    }
    
    .company-header p {
        margin: 5px 0 0 0;
        opacity: 0.9;
        font-size: 14px;
    }
    
    .form-divider {
        border: none;
        height: 2px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        margin: 30px 0;
        border-radius: 2px;
    }
    
    @media (max-width: 768px) {
        .main-content {
            padding: 25px 20px;
            margin: 0 10px;
        }
        
        .company-info-container {
            padding: 10px 0;
        }
        
        .logo-section {
            padding: 15px;
        }
    }
</style>

<home :user="user" inline-template>
    <div class="company-info-container">
        <div class="container">
            <!-- Application Dashboard -->
            <div class="row justify-content-center">
                @include('left_bar')
                <div class="col-md-9">
                    <div class="panel panel-default dashboard-panel">
                        <div class="panel-heading">🏢 Company Information</div>
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
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-content">
                                <div class="company-header">
                                    <h3>Manage Company Details</h3>
                                    <p>Update your company information and branding</p>
                                </div>

                                <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="{{ route('save_company_info') }}">
                                    {{ csrf_field() }}
                                    
                                    <div class="logo-section">
                                        <div class="row">
                                            <div class="col-md-3 text-center">
                                                @if($companyData)
                                                    <img class="logo-preview" style="height: 100px; width:90px;" src="{{ url('uploads/'.$companyData->logo) }}">
                                                @else
                                                    <div class="logo-preview" style="height: 100px; width:90px; background: #f8f9fa; display: flex; align-items: center; justify-content: center; color: #6c757d;">
                                                        <i class="fa fa-image" style="font-size: 24px;"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group {{ $errors->has('logo') ? 'has-error' : ''}}">
                                                    <label for="logo" class="col-md-12 control-label">Company Logo</label>
                                                    <div class="col-md-12">
                                                        <input id="logo" type="file" name="logo" class="file-input">
                                                        {!! $errors->first('logo', '<p class="help-block">:message</p>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="form-divider">

                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                        <label for="name" class="col-md-12 control-label">Company Name</label>
                                        <div class="col-md-12">
                                            @if((old('name')))
                                                <input id="name" type="text" class="form-control" name="name" placeholder="Enter company name..." value="{{ (old('name')) ? old('name') : '' }}">
                                            @else
                                                <input id="name" type="text" class="form-control" name="name" placeholder="Enter company name..." value="{{ ($companyData) ? $companyData->name : '' }}">
                                            @endif
                                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                                        <label for="email" class="col-md-12 control-label">Email Address</label>
                                        <div class="col-md-12">
                                            @if(old('email'))
                                                <input id="email" type="email" class="form-control" name="email" placeholder="Enter email address..." value="{{ (old('email')) ? old('email') : '' }}">
                                            @else
                                                <input id="email" type="email" class="form-control" name="email" placeholder="Enter email address..." value="{{ ($companyData) ? $companyData->email : '' }}">
                                            @endif
                                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('mobile') ? 'has-error' : ''}}">
                                        <label for="mobile" class="col-md-12 control-label">Mobile Number</label>
                                        <div class="col-md-12">
                                            @if(old('mobile'))
                                                <input id="mobile" type="tel" class="form-control" name="mobile" placeholder="Enter mobile number..." value="{{ (old('mobile')) ? old('mobile') : '' }}">
                                            @else
                                                <input id="mobile" type="tel" class="form-control" name="mobile" placeholder="Enter mobile number..." value="{{ ($companyData) ? $companyData->mobile : '' }}">
                                            @endif
                                            {!! $errors->first('mobile', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('toll_free_no') ? 'has-error' : ''}}">
                                        <label for="toll_free_no" class="col-md-12 control-label">Toll Free Number</label>
                                        <div class="col-md-12">
                                            @if(old('toll_free_no'))
                                                <input id="toll_free_no" type="tel" class="form-control" name="toll_free_no" placeholder="Enter toll free number..." value="{{ (old('toll_free_no')) ? old('toll_free_no') : '' }}">
                                            @else
                                                <input id="toll_free_no" type="tel" class="form-control" name="toll_free_no" placeholder="Enter toll free number..." value="{{ ($companyData) ? $companyData->toll_free_no : '' }}">
                                            @endif
                                            {!! $errors->first('toll_free_no', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('website') ? 'has-error' : ''}}">
                                        <label for="website" class="col-md-12 control-label">Website URL</label>
                                        <div class="col-md-12">
                                            @if(old('website'))
                                                <input id="website" type="url" class="form-control" name="website" placeholder="Enter website URL..." value="{{ (old('website')) ? old('website') : '' }}">
                                            @else
                                                <input id="website" type="url" class="form-control" name="website" placeholder="Enter website URL..." value="{{ ($companyData) ? $companyData->website : '' }}">
                                            @endif
                                            {!! $errors->first('website', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                                        <label for="address" class="col-md-12 control-label">Company Address</label>
                                        <div class="col-md-12">
                                            @if(old('address'))
                                                <input id="address" type="text" class="form-control" name="address" placeholder="Enter company address..." value="{{ (old('address')) ? old('address') : '' }}">
                                            @else
                                                <input id="address" type="text" class="form-control" name="address" placeholder="Enter company address..." value="{{ ($companyData) ? $companyData->address : '' }}">
                                            @endif
                                            {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('company_info') ? 'has-error' : ''}}">
                                        <label for="company_info" class="col-md-12 control-label">Company Description</label>
                                        <div class="col-md-12">
                                            @if(old('company_info'))
                                                <textarea id="company_info" class="form-control" name="company_info" placeholder="Enter detailed company information..." required>{{ (old('company_info')) ? old('company_info') : '' }}</textarea>
                                            @else
                                                <textarea id="company_info" class="form-control" name="company_info" placeholder="Enter detailed company information..." required>{{ ($companyData) ? $companyData->company_info : '' }}</textarea>
                                            @endif
                                            {!! $errors->first('company_info', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                                <i class="fa fa-save"></i> Save Company Information
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</home>

@endsection

@section('customcss')

<style type="text/css">

   .help-block{

      color: red;

      font-weight: 500;

      font-size: 13px;

   }

</style>

@endsection

@section('customscripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

<script type="text/javascript">

   $(function(){

      CKEDITOR.config.toolbarGroups = [

          { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },

          { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },

          { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },

          { name: 'forms' },

          '/',

          { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },

          { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ] },

          { name: 'links' },

          { name: 'insert' },

          '/',

          { name: 'styles' },

          { name: 'colors' },

          { name: 'tools' },

          { name: 'others' },

          { name: 'about' }

      ];

       CKEDITOR.replace('company_info');

   });

</script>

@endsection