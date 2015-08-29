<?php

// This controller works as the main class/main controller.
// As the code grows it will be created one specific controller for each page

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function about(){
 
    	//First approach
    	// $name = 'Guilherme Borges Oliveira';
    	//returning view with date $name 
    	// return view('pages.about')->with('name',$name);
    	
    	//Another approach
    	// $data = [];
    	// return view('pages.about',$data);
    	return view('pages.about')->with([
    		'first' => 'Guilherme',
    		'last' => 'Oliveira'
    		]);
    }

    public function index(){
    	$data =[];
    	$data['pagina'] = 'index';
    	return view('pages.index',$data);
    }

	public function capitulo(){
		$data =[];
		$data['pagina'] = 'capitulo';
		return view('pages.capitulo',$data);
	}

	public function doencas(){
		$data =[];
		$data['pagina'] = 'doencas';
		return view('pages.doencas',$data);
	}

	public function especifica(){
		$data =[];
		$data['pagina'] = 'especifica';
		return view('pages.especifica',$data);
	}
}
