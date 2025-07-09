<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Game; //Eloquent할때만 사용
use App\Models\platform; //Eloquent할때만 사용
use App\Models\Publisher; //Eloquent할때만 사용
use Image;

class GameController extends Controller
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
		return view( 'game.index', $data );	// 자료 표시

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$data['list'] = $this->getlist_platform();
		$data['list1'] = $this->getlist_publisher();
		
		$data['tmp'] = $this->qstring();
		
		return view( 'game.create', $data );

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
		
		
		$row = new Game; 		// game 모델변수 row 선언
		
		$this->save_row($request, $row);
		return redirect('game' .$tmp);		// 목록화면으로 이동

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
		
		$data['row'] = Game::leftjoin('platforms', 'games.platform_id', '=', 'platforms.id')->
		leftjoin('publishers', 'games.publisher_id', '=', 'publishers.id')->
		select('games.*', 'platforms.pname as pname', 'publishers.publishers_name as publishers_name')->
	    where('games.id', '=', $id)->first();

     //자료 읽기, Eloquent ORM
		return view('game.show', $data );  //자료 표시
		
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
		$data['list'] = $this->getlist_platform();
		$data['list1'] = $this->getlist_publisher();

		$data['tmp'] = $this->qstring();
		
		$data['row'] = Game::find( $id );	// 자료 찾기
		return view('game.edit', $data );	// 수정화면 호출

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
		$row = Game::find( $id ); 		// 자료 찾기
		$this->save_row($request, $row);
		
		$tmp = $this->qstring();
		return redirect('game' .$tmp);		// 목록화면으로 이동

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
		
		Game::find( $id )->delete();
		
		$tmp = $this->qstring();
		return redirect('game' .$tmp);

    }
	
	public function getlist( $text1 )
{
    //$sql = 'select * from games order by name30';              // Raw Query
    //   $result = DB::select($sql);
	
		$result = Game::leftjoin('platforms', 'games.platform_id', '=', 'platforms.id')->
		select('games.*', 'platforms.pname as pname')->
	    where('games.gname', 'like', '%' . $text1 . '%')->
	    orderby('games.gname', 'asc')->
	    paginate(5)->appends(['text1'=>$text1]);
		
        //$result = Game::where('gname', 'like', '%' . $text1 . '%')->orderby('gname','asc')->
		//paginate(5)->appends( ['text1' => $text1] );      // Query Builder

      // Query Builder
	
    // $result = Game::orderby('name30')->get();                // Eloquent ORM

    return $result;
}

	function getlist_platform()
	{
	  $result=platform::orderby('pname')->get();
	  return $result;
	}
	
	function getlist_publisher()
	{
	  $result=Publisher::orderby('publishers_name')->get();
	  return $result;
	}



	public function save_row(Request $request, $row){
		
		$request->validate( [
		
			
			'genre' => 'required|max:20',
			'rated' => 'required|max:10',
			'gname' => 'required',
			'platform_id'	=> 'required',
			'publisher_id'	=> 'required',
			'price' => 'required|numeric',
			'release' => 'required'
		] ,
		[
			'genre.required' => '장르는 필수입력입니다.',
			'rated.required' => '이용가는 필수입력입니다.',
			'gname.required' => '이름은 필수입력입니다.',
			'platform_id.required' => '플랫폼은 필수입력입니다.',
			'publisher_id.required' => '퍼블리셔는 필수입력입니다.',
			'price.required' => '단가는 필수입력입니다.',
			'release.required' => '발매일은 필수입력입니다.',
			'genre.max' => '20자 이내입니다.',
			'rated.max' => '10자 이내입니다.'
		] );
		
		$row->genre = $request->input("genre");
		$row->rated = $request->input("rated");
		$row->gname = $request->input("gname");
		$row->platform_id = $request->input("platform_id");
		$row->publisher_id = $request->input("publisher_id");
		$row->price = $request->input("price");
		$row->information = $request->input("information");
		$row->release = $request->input("release");
		$row->new = $request->input("new");
		$row->sale = $request->input("sale");
		$row->hit = $request->input("hit");
		$row->discount = $request->input("discount");
		
		//$row->pic29 = $request->input("pic");
		if($request->hasFile('pic1')){
			$pic1 = $request->file('pic1');
			$pic1_name = $pic1->getClientOriginalName();
			$pic1->storeAs('public/game_img', $pic1_name);
			
			$row->pic1 = $pic1_name;
		}
		if($request->hasFile('pic2')){
			$pic2 = $request->file('pic2');
			$pic2_name = $pic2->getClientOriginalName();
			$pic2->storeAs('public/game_img', $pic2_name);
			
			$row->pic2 = $pic2_name;
		}
		
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
