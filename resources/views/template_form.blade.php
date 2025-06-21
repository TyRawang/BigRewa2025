@extends('layouts.app')

@section('content')

<style>
    .template-form-container {
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
    
    .form-panel {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border: none;
        overflow: hidden;
        margin-top: 20px;
    }
    
    .form-body {
        padding: 50px 60px !important;
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
        min-height: 120px;
    }
    
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
        width: 100%;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        color: white;
    }
    
    .btn-submit:active {
        transform: translateY(0);
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
    
    .badges {
        background: #667eea;
        color: #fff;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        margin: 2px;
        display: inline-block;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .badges:hover {
        background: #5a67d8;
        transform: translateY(-1px);
    }
    
    .badges:nth-child(2n+1) {
        background: #28a745;
    }
    
    .badges:nth-child(2n+1):hover {
        background: #218838;
    }
    
    .badges:nth-child(3n+1) {
        background: #dc3545;
    }
    
    .badges:nth-child(3n+1):hover {
        background: #c82333;
    }
    
    .token-info {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        border-left: 4px solid #667eea;
    }
    
    .token-info p {
        margin: 0;
        color: #6c757d;
        font-size: 13px;
    }
    
    @media (max-width: 768px) {
        .form-body {
            padding: 30px 25px !important;
        }
        
        .template-form-container {
            padding: 10px 0;
        }
        
        .col-md-8 {
            margin: 0 10px;
        }
    }
</style>

<home :user="user" inline-template>
    <div class="template-form-container">
        <div class="container">
            <!-- Application Dashboard -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="panel panel-default dashboard-panel">
                        <div class="panel-heading">📝 Email Template Form</div>
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
                </div>
            </div>

            <!-- Template Form -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="form-panel">
                        <div id="#app" class="form-body">
                            <form class="form-horizontal" method="post" action="{{ route('save_template') }}">
                                {{ csrf_field() }}
                                
                                <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                    <label for="title" class="col-md-12 control-label">Template Title</label>
                                    <div class="col-md-12">
                                        <input id="title" type="text" class="form-control" name="title" required value="{{ ($data) ? $data->title : '' }}" placeholder="Enter template title...">
                                        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>  

                                <div class="form-group {{ $errors->has('email_template_token') ? 'has-error' : ''}}">
                                    <label for="email_template_token" class="col-md-12 control-label">Email Template Token</label>
                                    <div class="col-md-12">
                                        <input id="email_template_token" type="text" class="form-control" name="email_template_token" required value="{{ ($data) ? $data->email_template_token : '' }}" placeholder="Enter unique token...">
                                        {!! $errors->first('email_template_token', '<p class="help-block">:message</p>') !!}
                                    </div>
                                    <div class="token-info">
                                        <p><strong>Note:</strong> The token should be unique and will be used to identify this template in the system.</p>
                                    </div>
                                </div>

                                @if($data)
                                    <input type="hidden" name="template_id" id="template_id" value="{{ $data->id }}">
                                @else
                                    <input type="hidden" name="template_id" id="template_id" value="0">
                                @endif

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-submit">
                                            <i class="fa fa-save"></i> {{ $data ? 'Update Template' : 'Create Template' }}
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
</home>

@endsection

@section('customcss')
<style type="text/css">
    #cke_32, #cke_17, #cke_37, #cke_70, #cke_24, #cke_89, #cke_91{
        display: none !important;
    }
</style>
@endsection

@section('customscripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
   $(function(){
       CKEDITOR.replace('description');
   });
</script>
@endsection