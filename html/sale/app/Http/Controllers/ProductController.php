<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product; //Eloquent할때만 사용
use App\Models\Gubun; //Eloquent할때만 사용
use Image;

class ProductController extends Controller
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
		return view( 'product.index', $data );	// 자료 표시

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$data['list'] = $this->getlist_gubun();
		
		$data['tmp'] = $this->qstring();
		
		return view( 'product.create', $data );

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
		
		
		$row = new Product; 		// product 모델변수 row 선언
		
		$this->save_row($request, $row);
		return redirect('product' .$tmp);		// 목록화면으로 이동

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
		
		$data['row'] = Product::leftjoin('gubuns', 'products.gubuns_id29', '=', 'gubuns.id')->
		select('products.*', 'gubuns.name29 as gubun_name29')->
	    where('products.id', '=', $id)->first();
     //자료 읽기, Eloquent ORM
		return view('product.show', $data );  //자료 표시
		
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
		$data['list'] = $this->getlist_gubun();

		$data['tmp'] = $this->qstring();
		
		$data['row'] = Product::find( $id );	// 자료 찾기
		return view('product.edit', $data );	// 수정화면 호출

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
		$row = Product::find( $id ); 		// 자료 찾기
		$this->save_row($request, $row);
		
		$tmp = $this->qstring();
		return redirect('product' .$tmp);		// 목록화면으로 이동

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
		
		Product::find( $id )->delete();
		
		$tmp = $this->qstring();
		return redirect('product' .$tmp);

    }
	
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

	function getlist_gubun()
	{
	  $result=Gubun::orderby('name29')->get();
	  return $result;
	}


	public function save_row(Request $request, $row){
		
		$request->validate( [
			'gubuns_id'	=> 'required|numeric',
			'name' => 'required|max:20',
			'price' => 'required|numeric'
		] ,
		[
			'gubuns_id.required' => '구분명은 필수입력입니다.',
			'name.required' => '이름은 필수입력입니다.',
			'price.required' => '단가는 필수입력입니다.',
			'name.max' => '20자 이내입니다.',
		] );

		$row->gubuns_id29 = $request->input("gubuns_id");
		$row->name29 = $request->input("name");
		$row->price29 = $request->input("price");
		$row->jeago29 = $request->input("jeago");
		
		//$row->pic29 = $request->input("pic");
		if($request->hasFile('pic')){
			$pic = $request->file('pic');
			$pic_name = $pic->getClientOriginalName();
			$pic->storeAs('public/product_img', $pic_name);
			
			$img=Image::make($pic)
				->resize(null, 200, function($constraint){$constraint->aspectRatio();})
				->save('storage/product_img/thumb/' .$pic_name);
			
			$row->pic29 = $pic_name;
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

	public function jaego()
	{
		
		DB::statement('drop table if exists temps;');
		DB::statement('create table temps(
			id int not null auto_increment,
			products_id29 int,
			jeago29 int default 0,
			primary key(id) );');
		DB::statement('update products set jeago29=0;');
		DB::statement('insert into temps (products_id29, jeago29)
			select products_id29, sum(numi29)-sum(numo29)
			from jangbus
			group by products_id29');
		DB::statement('update products join temps
			on products.id = temps.products_id29
			set products.jeago29 = temps.jeago29;');
		
		return redirect('product');
	}
}
