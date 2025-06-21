<?php

namespace App\Http\Controllers;

class WelcomeController extends Controller
{
    /**
     * Show the application splash screen.
     *
     * @return Response
     */
    public function show()
    {
        return view('welcome');
    }
    public function about_us()
    {
        return view('about_us');
    }
    public function faq()
    {
        return view('faq');
    }
    public function testimonial()
    {
        return view('testimonial');
    }
    public function privacy_policy()
    {
        return view('privacy_policy');
    }
    public function contact_us()
    {
        return view('contact_us');
    }
}
