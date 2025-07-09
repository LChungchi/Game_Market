<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jangbu; //Eloquent할때만 사용
use App\Models\Product; //Eloquent할때만 사용

class JangbuoController extends Controller
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
		if(!$text1) $text1=date("Y-m-d");

		$data['text1'] = $text1;
        $data['list'] = $this->getlist($text1);		// 자료 읽기, list로 검색, 연관배열
		return view( 'jangbuo.index', $data );	// 자료 표시

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$data['list'] = $this->getlist_product();
		
		$data['tmp'] = $this->qstring();
		
		return view( 'jangbuo.create', $data );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

		$row = new Jangbu; 		// jangbuo 모델변수 row 선언
		
		$this->save_row($request, $row);
		
		$tmp = $this->qstring();

		return redirect('jangbuo' .$tmp);		// 목록화면으로 이동

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$data['tmp'] = $this->qstring();
		
		$data['row'] = Jangbu::leftjoin('products', 'jangbus.products_id29', '=', 'products.id')->
		select('jangbus.*', 'products.name29 as product_name29')->
	    where('jangbus.id', '=', $id)->first();
     //자료 읽기, Eloquent ORM
		return view('jangbuo.show', $data );  //자료 표시
		
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
		$data['list'] = $this->getlist_product();

		$data['tmp'] = $this->qstring();
		
		//$data['row'] = Jangbu::find( $id );	// 자료 찾기
		$data['row'] = Jangbu::leftjoin('products', 'jangbus.products_id29', '=', 'products.id')->
		select('jangbus.*', 'products.name29 as product_name29')->
	    where('jangbus.id', '=', $id)->first();
		return view('jangbuo.edit', $data );	// 수정화면 호출

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
		$row = Jangbu::find( $id ); 		// 자료 찾기
		$this->save_row($request, $row);
		
		$tmp = $this->qstring();
		return redirect('jangbuo' .$tmp);		// 목록화면으로 이동

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
		
		Jangbu::find( $id )->delete();
		
		$tmp = $this->qstring();
		return redirect('jangbuo' .$tmp);

    }
	
	public function getlist( $text1 )
{
    //$sql = 'select * from jangbuos order by name30';              // Raw Query
    //   $result = DB::select($sql);
	
        $result = Jangbu::leftjoin('products', 'jangbus.products_id29', '=', 'products.id')->
		select('jangbus.*', 'products.name29 as product_name29')->
	    where('jangbus.io29', '=', 1)->
	    where('jangbus.writeday29', '=', $text1 )->
	    orderby('jangbus.id', 'desc')->
	    paginate(5)->appends(['text1'=>$text1]);
      // Query Builder	
	
    // $result = Jangbuo::orderby('name30')->get();                // Eloquent ORM

    return $result;
}

	function getlist_product()
	{
	  $result=Product::orderby('name29')->get();
	  return $result;
	}


	public function save_row(Request $request, $row){
		
		$request->validate( [
			'writeday' => 'required|date',
			'products_id' => 'required'

		] ,
		[
			'writeday.required' => '날짜는 필수입력입니다.',
			'products_id.required' => '제품명은 필수입력입니다.',
			'writeday.date' => '날짜형식이 잘못되었습니다.',
		] );

		$row->io29 			= 1;
		$row->writeday29 	= $request->input("writeday");
		$row->products_id29 = $request->input("products_id");
		$row->price29 		= $request->input("price");
		$row->numi29 		= 0;
		$row->numo29		= $request->input("numo");
		$row->prices29 		= $request->input("prices");
		$row->bigo29 		= $request->input("bigo");

		$row->save();			// 저장
	
	}
	
	public function qstring() // 검색한거 저장
{
    $text1 = request("text1") ? request('text1') : "";
    $page = request('page') ? request('page') : "1";
    $tmp = $text1 ? "?text1=$text1&page=$page" : "?page=$page";
    return $tmp;
}


}
