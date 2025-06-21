@extends('layouts.app')
@section('content')

<style>
    .smtp-container {
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
    
    .control-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
        font-size: 14px;
        letter-spacing: 0.5px;
        text-transform: capitalize;
    }
    
    .form-group {
        margin-bottom: 25px !important;
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border: none;
        border-radius: 8px;
        padding: 12px 25px;
        font-size: 14px;
        font-weight: 600;
        color: white;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
    }
    
    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
        background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
        color: white;
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
    
    .google-section {
        background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
        border: 2px solid #e1e8ed;
        border-radius: 12px;
        padding: 30px;
        margin-bottom: 30px;
        text-align: center;
    }
    
    .google-section h4 {
        color: #2c3e50;
        margin-bottom: 20px;
        font-weight: 600;
    }
    
    .divider-section {
        text-align: center;
        margin: 30px 0;
        position: relative;
    }
    
    .divider-section::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 2px;
    }
    
    .divider-text {
        background: white;
        padding: 0 20px;
        color: #2c3e50;
        font-weight: 600;
        border: 2px solid #e1e8ed;
        border-radius: 50px;
        display: inline-block;
        position: relative;
        z-index: 1;
    }
    
    .smtp-status {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        border: 2px solid #28a745;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 30px;
    }
    
    .smtp-status h5 {
        color: #155724;
        font-weight: 600;
        margin-bottom: 20px;
    }
    
    .table {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 0;
    }
    
    .table td {
        padding: 15px;
        border-top: 1px solid #dee2e6;
        vertical-align: middle;
    }
    
    .table td:first-child {
        font-weight: 600;
        color: #2c3e50;
        background: #f8f9fa;
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
    
    .smtp-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        margin-bottom: 30px;
        text-align: center;
    }
    
    .smtp-header h3 {
        margin: 0;
        font-size: 20px;
        font-weight: 600;
    }
    
    .smtp-header p {
        margin: 5px 0 0 0;
        opacity: 0.9;
        font-size: 14px;
    }
    
    @media (max-width: 768px) {
        .main-content {
            padding: 25px 20px;
            margin: 0 10px;
        }
        
        .smtp-container {
            padding: 10px 0;
        }
        
        .google-section {
            padding: 20px;
        }
        
        .smtp-status {
            padding: 20px;
        }
    }
</style>

<home :user="user" inline-template>
    <div class="smtp-container">
        <div class="container">
            <!-- Application Dashboard -->
            <div class="row justify-content-center">
                @include('left_bar')
                <div class="col-md-9">
                    <div class="panel panel-default dashboard-panel">
                        <div class="panel-heading">📧 SMTP Configuration</div>
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
                    
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="main-content">
                                <div class="smtp-header">
                                    <h3>Email Server Configuration</h3>
                                    <p>Configure your SMTP settings for sending emails</p>
                                </div>

                                @if(!Auth::user()->checkGoogleSMTP() && !Auth::user()->checkCustomSMTP())
                                    <div class="google-section">
                                        <h4><i class="fa fa-google"></i> Quick Setup with Google</h4>
                                        <p style="color: #6c757d; margin-bottom: 20px;">Connect your Google account for easy email configuration</p>
                                        <a class="btn btn-danger" href="{{ url('/oauth/gmail') }}">
                                            <i class="fa fa-google"></i> Login With Google
                                        </a>
                                    </div>
                                    
                                    <div class="divider-section">
                                        <span class="divider-text">OR</span>
                                    </div>
                                @endif 

                                @if(Auth::user()->checkGoogleSMTP())
                                    <div class="smtp-status">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h5><i class="fa fa-check-circle"></i> Google SMTP Enabled</h5>
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <a href="#" data-href="{{ url('remove-google-account') }}" class="btn btn-danger btn-sm remove-smtp-acc">
                                                    <i class="fa fa-trash"></i> Remove Account
                                                </a>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered" style="width: 100%">
                                                    <tr>
                                                        <td>Google Account:</td>
                                                        <td>{{ Auth::user()->checkGoogleSMTP()->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Access Token:</td>
                                                        <td style="word-break: break-all;">{{ Auth::user()->checkGoogleSMTP()->access_token }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <form class="form-horizontal" method="POST" action="{{ route('save_smpt_settings') }}">
                                        {{ csrf_field() }}
                                        
                                        <div class="smtp-header" style="margin-bottom: 30px;">
                                            <h4 style="margin: 0;"><i class="fa fa-cog"></i> Custom SMTP Configuration</h4>
                                            <p style="margin: 5px 0 0 0; opacity: 0.9; font-size: 14px;">Enter your email server details</p>
                                        </div>

                                        <div class="form-group {{ $errors->has('driver') ? 'has-error' : ''}}">
                                            <label for="driver" class="col-md-12 control-label">Mail Driver</label>
                                            <div class="col-md-12">
                                                <input id="driver" type="text" class="form-control" name="driver" placeholder="smtp" required value="{{ ($customData) ? $customData->driver : '' }}">
                                                {!! $errors->first('driver', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->has('host') ? 'has-error' : ''}}">
                                            <label for="host" class="col-md-12 control-label">SMTP Host</label>
                                            <div class="col-md-12">
                                                <input id="host" type="text" class="form-control" name="host" placeholder="e.g., smtp.gmail.com" required value="{{ ($customData) ? $customData->host : '' }}">
                                                {!! $errors->first('host', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->has('port') ? 'has-error' : ''}}">
                                            <label for="port" class="col-md-12 control-label">SMTP Port</label>
                                            <div class="col-md-12">
                                                <input id="port" type="number" class="form-control" name="port" placeholder="587" required value="{{ ($customData) ? $customData->port : '' }}">
                                                {!! $errors->first('port', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
                                            <label for="username" class="col-md-12 control-label">SMTP Username</label>
                                            <div class="col-md-12">
                                                <input id="username" type="email" class="form-control" name="username" placeholder="Enter your email address" required value="{{ ($customData) ? $customData->username : '' }}">
                                                {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->has('pwd') ? 'has-error' : ''}}">
                                            <label for="pwd" class="col-md-12 control-label">SMTP Password</label>
                                            <div class="col-md-12">
                                                <input id="pwd" type="password" class="form-control" name="pwd" placeholder="Enter your password or app password" required value="{{ ($customData) ? $customData->pwd : '' }}">
                                                {!! $errors->first('pwd', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->has('fromname') ? 'has-error' : ''}}">
                                            <label for="fromname" class="col-md-12 control-label">From Name</label>
                                            <div class="col-md-12">
                                                <input id="fromname" type="text" class="form-control" name="fromname" placeholder="Your Name or Company Name" required value="{{ ($customData) ? $customData->fromname : '' }}">
                                                {!! $errors->first('fromname', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->has('encryption') ? 'has-error' : ''}}">
                                            <label for="encryption" class="col-md-12 control-label">Encryption</label>
                                            <div class="col-md-12">
                                                <input id="encryption" type="text" class="form-control" name="encryption" placeholder="tls or ssl" required value="{{ ($customData) ? $customData->encryption : '' }}">
                                                {!! $errors->first('encryption', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                                    <i class="fa fa-save"></i> Save SMTP Configuration
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</home>
@endsection

@section('customscripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('body').on('click', '.remove-smtp-acc', function(e){
            e.preventDefault();
            if (confirm("Are you sure you want to remove this SMTP account?")) {
                var delete_url = $(this).data('href');
                window.location.href = delete_url;
            }
        });
    });
</script>
@endsection