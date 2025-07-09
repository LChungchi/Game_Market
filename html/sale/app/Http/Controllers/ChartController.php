<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jangbu; //Eloquent할때만 사용
use App\Models\Product; //Eloquent할때만 사용

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		
		$text1 = $request->input('text1');		// text1값 알아냄 
		if(!$text1) $text1=date("Y-m-d", strtotime("-1 month"));
		
		$text2 = $request->input('text2');		// text1값 알아냄 
		if(!$text2) $text2=date("Y-m-d");	

		$data['text1'] = $text1;
		$data['text2'] = $text2;
        $list = $this->getlist($text1, $text2);		// 자료 읽기, list로 검색, 연관배열
		
		$str_label="";
		$str_data="";
		foreach($list as $row){
		
			$str_label .="'$row->gubuns_name',";
			$str_data .= $row->cnumo . ',';
		
		}
		
		$data["str_label"] = $str_label;
		$data["str_data"] = $str_data;
		
		return view( 'chart.index', $data );	// 자료 표시

    }

	public function getlist( $text1, $text2)
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
		leftjoin('gubuns','products.gubuns_id29','=','gubuns.id')->
		select('gubuns.name29 as gubuns_name', DB::raw('count(jangbus.numo29) as cnumo') )->
			wherebetween('jangbus.writeday29', array($text1,$text2))->
			where('jangbus.io29','=',1)->
			orderby('cnumo','desc')->
			groupby('gubuns.name29')->
			limit(14)->
			paginate(5)->appends(['text1'=>$text1,'text2'=>$text2]);


    // $result = Jangbuo::orderby('name30')->get();                // Eloquent ORM

    return $result;
}

	function getlist_product()
	{
	  $result=Product::orderby('name29')->get();
	  return $result;
	}


	


}
