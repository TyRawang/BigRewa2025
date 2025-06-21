@extends('layouts.app')

@section('content')

<section id="intro" class="clearfix">

   <div class="container d-flex h-100">

      <div class="row justify-content-center align-self-center">

         <div class="col-md-6 intro-info order-md-first order-last">

            <h1 class="list">Rapid Solutions<br>for Your <span>Business!</span></h1>

            <div><a href="/register" class="btn-get-started scrollto">Try Us</a></div>

         </div>

         <div class="col-md-6 intro-img order-md-last order-first"><img src="{{ url('images/logo/intro-img.svg') }}" width="40%" alt="Big Rewa Background Image" class="img-fluid" style="float: right;"></div>

      </div>

   </div>

</section>

@endsection