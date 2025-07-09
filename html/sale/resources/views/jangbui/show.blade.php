@extends('main')
@section('content')

	<br>
	<div class="alert mycolor1" role="alert">매입</div>
	<?
		$tel1 = trim(substr($row->tel29,0,3));
		$tel2 = trim(substr($row->tel29,3,4));
		$tel3 = trim(substr($row->tel29,7,4));
		$tel = $tel1 . "-" . $tel2 . "-" . $tel3;
		$rank = $row->rank29==0 ? '직원' : '관리자';
	?>

	
	<div class="row">
		<div class="col-4" align="left">       
		
		<form name="form1" method="post" action="{{ route( 'jangbui.update', $row->id ) }}">
		@csrf
		@method('PATCH')

		<table class="table table-bordered table-sm mymargin5">
			<tr>
				<td width="20%" class="mycolor2"><font color="red">*</font> 날짜</td>
				<td width="80%" align="left">{{ $row->writeday29 }}</td>
			</tr>
			<tr>
				<td class="mycolor2"><font color="red">*</font> 제품명</td>
				<td width="80%" align="left">{{ $row->product_name29 }}</td>
			</tr>
			<tr>
				<td class="mycolor2"> 단가</td>
				<td width="80%" align="left">{{ $row->price29 }}</td>
			</tr>
			<tr>
				<td class="mycolor2"> 수량</td>
				<td width="80%" align="left">{{ $row->numi29 }}</td>
			</tr>
			<tr>
				<td class="mycolor2">금액</td>
				<td width="80%" align="left">{{ $row->prices29 }}</td>
			</tr>
			<tr>
				<td class="mycolor2">비고</td>
				<td width="80%" align="left">{{ $row->bigo29 }}</td>
			</tr>
		<!-- 아이디, 암호, 전화, 등급  행 추가  …!-->
		</table>
			<div class="col-9" align="center">           
				<a href="{{ route( 'jangbui.edit', $row->id ) }}{{ $tmp }}" class="btn btn-sm mycolor1">수정</a>&nbsp;
				<form action="{{ route('jangbui.destroy', $row->id) }}">
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