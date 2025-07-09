<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jangbu; //Eloquent할때만 사용
use App\Models\Product; //Eloquent할때만 사용

require "../vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


class GiganController extends Controller
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
		
		$text3 = $request->input('text3');		// text1값 알아냄 
		if(!$text3) $text3=0; 	

		$data['text1'] = $text1;
		$data['text2'] = $text2;
		$data['text3'] = $text3;
        $data['list'] = $this->getlist($text1, $text2, $text3);		// 자료 읽기, list로 검색, 연관배열
		
		$data['list_product'] = $this->getlist_product();
		
		return view( 'gigan.index', $data );	// 자료 표시

    }

	public function getlist( $text1, $text2, $text3 )
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
	if ($text3==0)       // 제품이 전체인 경우
    $result = Jangbu::leftjoin('products','jangbus.products_id29','=','products.id')->
        select('jangbus.*','products.name29 as product_name')->
             wherebetween( 'jangbus.writeday29', array($text1,$text2) )->
           orderby('jangbus.id','desc')->
           paginate(5)->appends( ['text1'=>$text1,'text2'=>$text2,'text3'=>$text3] );
	else
    $result = Jangbu::leftjoin('products','jangbus.products_id29','=','products.id')->
        select('jangbus.*','products.name29 as product_name')->
             wherebetween( 'jangbus.writeday29', array($text1,$text2) )->
             where('jangbus.products_id29', "=", $text3)->
           orderby('jangbus.id','desc')->
            paginate(5)->appends( ['text1'=>$text1,'text2'=>$text2,'text3'=>$text3] );

    // $result = Jangbuo::orderby('name30')->get();                // Eloquent ORM

    return $result;
}

	function getlist_product()
	{
	  $result=Product::orderby('name29')->get();
	  return $result;
	}

	public function getlist_all( $text1, $text2, $text3 )
	{
		if ($text3==0)    // 제품이 전체인 경우
			$result = Jangbu::leftjoin('products','jangbus.products_id29','=','products.id')->
				select('jangbus.*','products.name29 as product_name')->
					wherebetween('jangbus.writeday29', array($text1,$text2))->
					orderby('jangbus.id','desc')->get();
		else
			$result = Jangbu::leftjoin('products','jangbus.products_id29','=','products.id')->
				select('jangbus.*','products.name29 as product_name')->
					wherebetween('jangbus.writeday29', array($text1,$text2))->
					where('jangbus.products_id29',"=",$text3)->
					orderby('jangbus.id','desc')->get();
		return $result;
	}


	public function excel()
	{
		$text1=request('text1');
		$text2=request('text2');
		$text3=request('text3');
		
		$list = $this->getlist_all($text1, $text2, $text3);
		
		$sheet = new Spreadsheet(); 

		$sheet->getActiveSheet()->getColumnDimension("A")->setWidth(12); // 각 칼럼 (너비)
		$sheet->getActiveSheet()->getColumnDimension("B")->setWidth(25);
		$sheet->getActiveSheet()->getColumnDimension("C")->setWidth(12);
		$sheet->getActiveSheet()->getColumnDimension("D")->setWidth(12);
		$sheet->getActiveSheet()->getColumnDimension("E")->setWidth(12);
		$sheet->getActiveSheet()->getColumnDimension("F")->setWidth(12);
		$sheet->getActiveSheet()->getColumnDimension("G")->setWidth(12);

		$sheet->getActiveSheet()->getStyle("A")->getAlignment()->setHorizontal("center");   // 각 칼럼 (정렬)
		$sheet->getActiveSheet()->getStyle("B")->getAlignment()->setHorizontal("left");
		$sheet->getActiveSheet()->getStyle("C:F")->getAlignment()->setHorizontal("right");
		$sheet->getActiveSheet()->getStyle("G")->getAlignment()->setHorizontal("left");

		$sheet->setActiveSheetIndex(0)->setCellValue("A1", "매출입장");      // 제목 (글자 크기, 굵게)
		$sheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(13);
		$sheet->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

		$sheet->setActiveSheetIndex(0)->setCellValue("G1", "기간: " . $text1 . " - " . $text2);   // 기간 (정렬)
		$sheet->getActiveSheet()->getStyle("G1")->getAlignment()->setHorizontal("right");
		
		
		// 2행 : 헤더 가운데 정렬
		$sheet->getActiveSheet()->getStyle("A2:G2")->getAlignment()->setHorizontal("center");
		// 헤더 배경색(밝은 회색)
		$sheet->getActiveSheet()->getStyle("A2:G2")->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFCCCCCC');
		// 헤더 글자 출력
		$sheet->setActiveSheetIndex(0)
			->setCellValue("A2", "날짜")
			->setCellValue("B2", "제품명")
			->setCellValue("C2", "단가")
			->setCellValue("D2", "매입수량")
			->setCellValue("E2", "매출수량")
			->setCellValue("F2", "금액")
			->setCellValue("G2", "비고");

		$i=3;
		foreach ( $list as $row )    // 3행부터 자료 출력
		{
			$sheet->setActiveSheetIndex(0)
				->setCellValue("A$i",$row->writeday29)
				->setCellValue("B$i",$row->product_name)
				->setCellValue("C$i",$row->price29 ? $row->price29 : "")
				->setCellValue("D$i",$row->numi29 ? $row->numi29 : "")
				->setCellValue("E$i",$row->numo29 ? $row->numo29 : "")
				->setCellValue("F$i",$row->prices29 ? $row->prices29 : "")
				->setCellValue("G$i",$row->bigo29);
			$i++;
		}
		$sheet->setActiveSheetIndex(0);
		$fname="매출입장($text1 - $text2).xlsx";     // 파일이름 생성
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml. sheet");
		header("Content-Disposition: attachment;filename=$fname");
		header("Cache-Control: max-age=0");
		$writer = IOFactory::createWriter($sheet, "Xlsx"); // xlsx형식
		$writer->save("php://output");


	}


}
