@extends('layouts.app')

@section('content')

<style>
    .password-container {
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
    
    .password-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        margin-bottom: 30px;
        text-align: center;
    }
    
    .password-header h3 {
        margin: 0;
        font-size: 20px;
        font-weight: 600;
    }
    
    .password-header p {
        margin: 5px 0 0 0;
        opacity: 0.9;
        font-size: 14px;
    }
    
    .security-info {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 25px;
        border-left: 4px solid #667eea;
    }
    
    .security-info h5 {
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .security-info p {
        margin: 0;
        color: #6c757d;
        font-size: 14px;
        line-height: 1.5;
    }
    
    @media (max-width: 768px) {
        .main-content {
            padding: 25px 20px;
            margin: 0 10px;
        }
        
        .password-container {
            padding: 10px 0;
        }
    }
</style>

<home :user="user" inline-template>
    <div class="password-container">
        <div class="container">
            <!-- Application Dashboard -->
            <div class="row justify-content-center">
                @include('left_bar')
                <div class="col-md-9">
                    <div class="panel panel-default dashboard-panel">
                        <div class="panel-heading">🔒 Password & Security</div>
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
                                <div class="password-header">
                                    <h3>Update Password</h3>
                                    <p>Ensure your account is using a long, random password to stay secure</p>
                                </div>

                                <div class="security-info">
                                    <h5><i class="fa fa-shield"></i> Security Tips</h5>
                                    <p>Use a strong password with at least 8 characters, including uppercase, lowercase, numbers, and special characters. Avoid using personal information or common words.</p>
                                </div>

                                <form class="form-horizontal" method="POST" action="{{ route('password.update') }}">
                                    {{ csrf_field() }}
                                    @method('PUT')
                                    
                                    <div class="form-group {{ $errors->has('current_password') ? 'has-error' : ''}}">
                                        <label for="current_password" class="col-md-12 control-label">Current Password</label>
                                        <div class="col-md-12">
                                            <input id="current_password" type="password" class="form-control" name="current_password" placeholder="Enter your current password..." required autocomplete="current-password">
                                            {!! $errors->first('current_password', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                                        <label for="password" class="col-md-12 control-label">New Password</label>
                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control" name="password" placeholder="Enter your new password..." required autocomplete="new-password">
                                            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : ''}}">
                                        <label for="password_confirmation" class="col-md-12 control-label">Confirm New Password</label>
                                        <div class="col-md-12">
                                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Confirm your new password..." required autocomplete="new-password">
                                            {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                                <i class="fa fa-save"></i> Save Password
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

@section('customscripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        // Password strength indicator could be added here
        $('#password').on('input', function() {
            // Add password strength validation if needed
        });
    });
</script>
@endsection 