<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function testGoogleMapApi() {
    	return view('test.map');
    }

    public function testZoomImage() {
    	return view('test.zoom');
    }

    public function testJQuery() {
    	return view('test.jquery');
    }
}
