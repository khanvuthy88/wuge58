<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
class LanguageController extends Controller
{
    public function langSwitcher($request)
    {
    	Session::put('locale',$request);
    	$session=Session::get('locale');
    	return $session;
    }
}
