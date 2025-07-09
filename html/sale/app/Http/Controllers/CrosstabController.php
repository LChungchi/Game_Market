<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jangbu; //Eloquent할때만 사용
use App\Models\Product; //Eloquent할때만 사용

class CrosstabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		
		$text1 = $request->input('text1');		// text1값 알아냄 
		if(!$text1) $text1=date("Y");

		$data['text1'] = $text1;
        $data['list'] = $this->getlist($text1);		// 자료 읽기, list로 검색, 연관배열
		
		return view( 'crosstab.index', $data );	// 자료 표시

    }

	public function getlist( $text1)
{
    //$sql = 'select * from jangbuos order by name30';              // Raw Query
    //   $result = DB::select($sql);
	/*
        $result = Jangbu::leftjoin('products', 'jangbus.products_id29', '=', 'products.id')->
		select('jangbus.*', 'products.name29 as product_name29')->
	    where('jangbus.writeday29', '=', $text1 )->
	    orderby('jangbus.id', 'desc')->
	    paginate(5)->appends(['text1'=>$text1]);
	*/
      // Query Builder	
			
	$result = Jangbu::leftjoin('products','jangbus.products_id29','=','products.id')->
    select( 'products.name29 as product_name', 
        DB::raw('sum( if(month(jangbus.writeday29)=1, jangbus.numo29,0) ) as s1,
           sum( if(month(jangbus.writeday29)=2, jangbus.numo29,0) ) as s2,
           sum( if(month(jangbus.writeday29)=3, jangbus.numo29,0) ) as s3,
           sum( if(month(jangbus.writeday29)=4, jangbus.numo29,0) ) as s4,
           sum( if(month(jangbus.writeday29)=5, jangbus.numo29,0) ) as s5,
           sum( if(month(jangbus.writeday29)=6, jangbus.numo29,0) ) as s6,
           sum( if(month(jangbus.writeday29)=7, jangbus.numo29,0) ) as s7,
           sum( if(month(jangbus.writeday29)=8, jangbus.numo29,0) ) as s8,
           sum( if(month(jangbus.writeday29)=9, jangbus.numo29,0) ) as s9,
           sum( if(month(jangbus.writeday29)=10, jangbus.numo29,0) ) as s10,
           sum( if(month(jangbus.writeday29)=11, jangbus.numo29,0) ) as s11,
           sum( if(month(jangbus.writeday29)=12, jangbus.numo29,0) ) as s12 ') )->
    where(DB::raw('year(jangbus.writeday29)'), '=', $text1)->
    where('jangbus.io29', '=', 1)->
    orderby('products.name29')->
    groupby('products.name29')->
    paginate(5)->appends( $text1 );



    // $result = Jangbuo::orderby('name30')->get();                // Eloquent ORM

    return $result;
}

	function getlist_product()
	{
	  $result=Product::orderby('name29')->get();
	  return $result;
	}


	


}
