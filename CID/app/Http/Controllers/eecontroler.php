<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

class EEControler extends BaseController
{
    use DispatchesJobs, ValidatesRequests;
    
    public function __construct(){
    	$this->middleware('guest');
    }

    public function helloworld(){
    	// return "Hello World";
    	return view('EasterEgg.coelho');
    }
}


