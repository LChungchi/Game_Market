<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Member; //Eloquent할때만 사용

class LoginController extends Controller
{
    
	public function check()
	{
		$uid = request('uid');
		$pwd = request('pwd');
		
		$row = Member::where('uid29','=',$uid)->
					   where('pwd29','=',$pwd)->first();
		if($row){
		
			session()->put('uid',$row->uid29);
			session()->put('rank',$row->rank29);
		
		}
		
		return view('main');
		
	}

	public function logout(){
	
		session()->forget('uid');
		session()->forget('rank');
		
		return view('main');
	}


}
