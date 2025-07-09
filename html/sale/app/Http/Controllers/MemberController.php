<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Member; //Eloquent할때만 사용

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if(session()->get("rank")!=1) return redirect("/");
		
		$data['tmp'] = $this->qstring();
		
		$text1 = request('text1');		// text1값 알아냄 
		$data['text1'] = $text1;

        $data['list'] = $this->getlist($text1);		// 자료 읽기, list로 검색, 연관배열
		return view( 'member.index', $data );	// 자료 표시

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
		
		return view( 'member.create', $data );

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
		
		$row = new Member; 		// member 모델변수 row 선언
		
		$this->save_row($request, $row);
		return redirect('member' .$tmp);		// 목록화면으로 이동

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
		
        $data['row'] =Member::find($id);     //자료 읽기, Eloquent ORM
		return view('member.show', $data );  //자료 표시
		
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
		
		$data['row'] = Member::find( $id );	// 자료 찾기
		return view('member.edit', $data );	// 수정화면 호출

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
		$row = Member::find( $id ); 		// 자료 찾기
		$this->save_row($request, $row);
		
		$tmp = $this->qstring();
		return redirect('member' .$tmp);		// 목록화면으로 이동

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
		
		Member::find( $id )->delete();
		
		$tmp = $this->qstring();
		return redirect('member' .$tmp);

    }
	
	public function getlist( $text1 )
{
    //$sql = 'select * from members order by name30';              // Raw Query
    //   $result = DB::select($sql);
	
    $result = Member::where('name29', 'like', '%' . $text1 . '%')->orderby('name29','asc')->paginate(5)->appends( ['text1' => $text1] );      // Query Builder
	
    // $result = Member::orderby('name30')->get();                // Eloquent ORM

    return $result;
}

	public function save_row(Request $request, $row){
		
		$request->validate( [
			'uid' => 'required|max:20',
			'pwd' => 'required|max:20',
			'name' => 'required|max:20',
		] ,
		[
			'uid.required'  => '아이디는 필수입력입니다.',
			'pwd.required' => '암호는 필수입력입니다.',
			'name.required' => '이름은 필수입력입니다.',
			'uid.max'  => '20자 이내입니다.',
			'pwd.max' => '20자 이내입니다.',
			'name.max' => '20자 이내입니다.',
		] );

		$tel1= $request->input("tel1");
		$tel2= $request->input("tel2");
		$tel3= $request->input("tel3");
		$tel = sprintf("%-3s%-4s%-4s", $tel1, $tel2, $tel3);	// 전화번호 합치기
		
		$row->uid29 = $request->input("uid");	// 값 입력 
		$row->pwd29 = $request->input("pwd");
		$row->name29 = $request->input("name");
		$row->tel29 = $tel;
		$row->rank29 = $request->input("rank");
		
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
