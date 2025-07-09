<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product; //Eloquent할때만 사용
use App\Models\Gubun; //Eloquent할때만 사용

class FindproductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$data['tmp'] = $this->qstring();
		
		$text1 = request('text1');		// text1값 알아냄 
		$data['text1'] = $text1;

        $data['list'] = $this->getlist($text1);		// 자료 읽기, list로 검색, 연관배열
		return view( 'findproduct.index', $data );	// 자료 표시

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  
	public function getlist( $text1 )
{
    //$sql = 'select * from products order by name30';              // Raw Query
    //   $result = DB::select($sql);
	
        $result = Product::leftjoin('gubuns', 'products.gubuns_id29', '=', 'gubuns.id')->
		select('products.*', 'gubuns.name29 as gubun_name29')->
	    where('products.name29', 'like', '%' . $text1 . '%')->
	    orderby('products.name29', 'asc')->
	    paginate(5)->appends(['text1'=>$text1]);
      // Query Builder
	
    // $result = Product::orderby('name30')->get();                // Eloquent ORM

    return $result;
}

	
	public function qstring() // 검색한거 저장
{
    $text1 = request("text1") ? request('text1') : "";
    $page = request('page') ? request('page') : "1";
    $tmp = $text1 ? "?text1=$text1&page=$page" : "?page=$page";
    return $tmp;
}


}
