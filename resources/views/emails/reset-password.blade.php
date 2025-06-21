@include('emails.template.header') 
<!-- center part starts here-->
<p class="p-class" style="color: #000000; font-family: Arial, Helvetica, sans-serif; font-size: 13px; margin: 0 0 .75em 0;"><strong>Hello! </strong></p>

<div style="height:5px"></div>
<p>
   You are receiving this email because we received a password reset request for your account.
</p>

<div style="height:5px"></div>
<p>
  <a href="{{ $reset_url }}">Reset Password</a>
</p>

<div style="height:5px"></div>
<p>
 This password reset link will expire in 60 minutes.
 <br>
 If you did not request a password reset, no further action is required.
</p>
<div style="height:10px"></div>

<div>
	<i>Thanks & Regards</i>
	<br>
	<i>{{ Config::get('app.name') }}</i>
</div>
<div style="height:5px"></div>
<div style="border-top: 2px solid #DDD; font-size: 12px;">
	
If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser: <a href="{{ $reset_url }}">{{ $reset_url }}</a>
</div>

@include('emails.template.footer') 