<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\platform; //Eloquent할때만 사용

class PlatformController extends Controller
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
		return view( 'platform.index', $data );	// 자료 표시

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$data['tmp'] = $this->qstring();
		
		return view( 'platform.create', $data );

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
		$tmp = $this->qstring();
		
		$row = new platform; 		// platform 모델변수 row 선언
		
		$this->save_row($request, $row);
		return redirect('platform' .$tmp);		// 목록화면으로 이동

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
		
        $data['row'] =platform::find($id);     //자료 읽기, Eloquent ORM
		return view('platform.show', $data );  //자료 표시
		
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
		$data['tmp'] = $this->qstring();
		
		$data['row'] = platform::find( $id );	// 자료 찾기
		return view('platform.edit', $data );	// 수정화면 호출

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
		$row = platform::find( $id ); 		// 자료 찾기
		$this->save_row($request, $row);
		
		$tmp = $this->qstring();
		return redirect('platform' .$tmp);		// 목록화면으로 이동

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
		
		platform::find( $id )->delete();
		
		$tmp = $this->qstring();
		return redirect('platform' .$tmp);

    }
	
	public function getlist( $text1 )
{
    //$sql = 'select * from platforms order by name30';              // Raw Query
    //   $result = DB::select($sql);
	
    $result = platform::where('pname', 'like', '%' . $text1 . '%')->orderby('pname','asc')->paginate(5)->appends( ['text1' => $text1] );      // Query Builder
	
    // $result = Platform::orderby('name30')->get();                // Eloquent ORM

    return $result;
}

	public function save_row(Request $request, $row){
		
		$request->validate( [
			'pname' => 'required|max:20'
		] ,
		[
			'pname.required' => '이름은 필수입력입니다.',
			'pname.max' => '20자 이내입니다.',
		] );

		$row->pname = $request->input("pname");
		
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
