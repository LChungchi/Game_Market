@extends('main')
@section('content')

	<br>
	<div class="alert mycolor1" role="alert">제품</div>

	<?
		$tel1 = trim(substr($row->tel29,0,3));
		$tel2 = trim(substr($row->tel29,3,4));
		$tel3 = trim(substr($row->tel29,7,4));
		$tel = $tel1 . "-" . $tel2 . "-" . $tel3;
		$rank = $row->rank29==0 ? '직원' : '관리자';
	?>
	
	<div class="row">
		<div class="col-4" align="left">       
		
		<form name="form1" method="post" action="{{ route( 'product.update', $row->id ) }}">
		@csrf
		@method('PATCH')

		<table class="table table-bordered table-sm mymargin5">
			<tr>
				<td width="20%" class="mycolor2"> 번호</td>
				<td width="80%" align="left">{{ $row->id }}</td>
			</tr>
			<tr>
				<td class="mycolor2"><font color="red">*</font> 구분명</td>
				<td width="80%" align="left">{{ $row->gubun_name29 }}</td>
			</tr>
			<tr>
				<td class="mycolor2"><font color="red">*</font> 제품명</td>
				<td width="80%" align="left">{{ $row->name29 }}</td>
			</tr>
			<tr>
				<td class="mycolor2"><font color="red">*</font> 단가</td>
				<td width="80%" align="left">{{ $row->price29 }}</td>
			</tr>
			<tr>
				<td class="mycolor2">재고</td>
				<td width="80%" align="left">{{ $row->jeago29 }}</td>
			</tr>
			<tr>
				<td class="mycolor2">사진</td>
				<td width="80%" align="left"><b>파일이름</b> : <?=$row->pic29 ?> <br>
				</div><br>

					@if($row->pic29)     
					   <img src="{{ asset('/storage/product_img/' . $row->pic29) }}"
							 width="200" class="img-fluid img-thumbnail margin5">
					@else                   
						<img src=" " width="200" class="img-fluid img-thumbnail margin5">
					@endif
				</td>
			</tr>
		<!-- 아이디, 암호, 전화, 등급  행 추가  …!-->
		</table>
			<div class="col-9" align="center">           
				<a href="{{ route( 'product.edit', $row->id ) }}{{ $tmp }}" class="btn btn-sm mycolor1">수정</a>&nbsp;
				<form action="{{ route('product.destroy', $row->id) }}">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-sm mycolor1" 
							  onClick="return confirm('삭제할까요 ?');">삭제</button> &nbsp;
				</form>
				<input type="button" value="이전화면" class="btn btn-sm mycolor1" onclick="history.back();">
			</div>
			<!-- 수정,삭제,저장,이전버튼  … -->
		</div>
		</form>


    </div>
@endsection()