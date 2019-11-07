<?php

namespace App\Http\Controllers;
use App\YeuCau;
use Illuminate\Http\Request;

class YeuCauController extends Controller
{

    public function getYeucau(){
    	if (Auth::check() == 'Admin') {
	    	$yeucau = YeuCau::orderBy('created_at','desc')->get();
	    	return view('admin.yeucau', compact('yeucau'));
    	}
		else return redirect('home');
    }
}
