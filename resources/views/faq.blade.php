@extends('layouts.app')



@section('content')

<section class="accordion-section clearfix mt-3" aria-label="Question Accordions">
  <div class="container">
  
	  <h2>Frequently Asked Questions </h2>
	  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		<div class="panel panel-default">
		  <div class="panel-heading p-3 mb-3" role="tab" id="heading0">
			<h3 class="panel-title">
			  <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse0" aria-expanded="true" aria-controls="collapse0">
				What are the benefits of Solodev CMS?
			  </a>
			</h3>
		  </div>
		  <div id="collapse0" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading0">
			<div class="panel-body px-3 mb-4">
			  <p>With Solodev CMS, you and your visitors will benefit from a finely-tuned technology stack that drives the highest levels of site performance, speed and engagement - and contributes more to your bottom line. Our users fell in love with:</p>
			  <ul>
				<li>Light speed deployment on the most secure and stable cloud infrastructure available on the market.</li>
				<li>Scalability – pay for what you need today and add-on options as you grow.</li>
				<li>All of the bells and whistles of other enterprise CMS options but without the design limitations - this CMS simply lets you realize your creative visions.</li>
				<li>Amazing support backed by a team of Solodev pros – here when you need them.</li>
			  </ul>
			</div>
		  </div>
		</div>
		
		<div class="panel panel-default">
		  <div class="panel-heading p-3 mb-3" role="tab" id="heading1">
			<h3 class="panel-title">
			  <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
				How easy is it to build a website with Solodev CMS?
			  </a>
			</h3>
		  </div>
		  <div id="collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1">
			<div class="panel-body px-3 mb-4">
			  <p>Building a website is extremely easy. With a working knowledge of HTML and CSS you will be able to have a site up and running in no time.</p>
			</div>
		  </div>
		</div>
		
		<div class="panel panel-default">
		  <div class="panel-heading p-3 mb-3" role="tab" id="heading2">
			<h3 class="panel-title">
			  <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" aria-controls="collapse2">
				What is the uptime for Solodev CMS?
			  </a>
			</h3>
		  </div>
		  <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
			<div class="panel-body px-3 mb-4">
			  <p>Using Amazon AWS technology which is an industry leader for reliability you will be able to experience an uptime in the vicinity of 99.95%.</p>
			</div>
		  </div>
		</div>
		
		<div class="panel panel-default">
		  <div class="panel-heading p-3 mb-3" role="tab" id="heading3">
			<h3 class="panel-title">
			  <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="true" aria-controls="collapse3">
				Can Solodev CMS handle multiple websites for my company?
			  </a>
			</h3>
		  </div>
		  <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
			<div class="panel-body px-3 mb-4">
			  <p>Yes, Solodev CMS is built to handle the needs of any size company. With our Multi-Site Management, you will be able to easily manage all of your websites.</p>
			</div>
		  </div>
		</div>
	  </div>
  
  </div>
</section>

@endsection
@section('customcss')
<style type="text/css">
	h2 {
    font-family: Arial, Verdana;
    font-weight: 800;
    font-size: 2.5rem;
    color: #091f2f;
    text-align: center;
    margin: 40px;
    text-transform: uppercase;
}
.accordion-section .panel-default > .panel-heading {
    border: 0;
    background: #fff;
    padding: 0;
}
.accordion-section .panel-default .panel-title a {
    display: block;
    font-style: italic;
    font-size: 1.5rem;
}
.accordion-section .panel-default .panel-title a:after {
    font-family: 'FontAwesome';
    font-style: normal;
    font-size: 3rem;
    content: "\f106";
    color: #1f7de2;
    float: right;
    margin-top: -12px;
}
.accordion-section .panel-default .panel-title a.collapsed:after {
    content: "\f107";
}
.accordion-section .panel-default .panel-body {
    font-size: 1.2rem;
}
</style>
@endsection