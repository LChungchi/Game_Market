<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Gubun; //Eloquent할때만 사용
use Response;

class AjaxController extends Controller
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
		return view( 'ajax.index', $data );	// 자료 표시

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		$tmp = $this->qstring();
		
		$row = new Gubun; 		// gubun 모델변수 row 선언
		
		$this->save_row($request, $row);
		return response()->json($row);		// 목록화면으로 이동

    }

    public function update(Request $request, $id)
    {
        //
		$row = Gubun::find( $id ); 		// 자료 찾기
		$this->save_row($request, $row);
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
		
		Gubun::find( $id )->delete();

    }
	
	public function getlist( $text1 )
{
    //$sql = 'select * from gubuns order by name30';              // Raw Query
    //   $result = DB::select($sql);
	
    $result = Gubun::where('name29', 'like', '%' . $text1 . '%')->orderby('name29','asc')->paginate(5)->appends( ['text1' => $text1] );      // Query Builder
	
    // $result = Gubun::orderby('name30')->get();                // Eloquent ORM

    return $result;
}

	public function save_row(Request $request, $row){
		
		$request->validate( [
			'name' => 'required|max:20'
		] ,
		[
			'name.required' => '이름은 필수입력입니다.',
			'name.max' => '20자 이내입니다.',
		] );

		$row->name29 = $request->input("name");
		
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
