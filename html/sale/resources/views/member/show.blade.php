@extends('main')
@section('content')

	<br>
	<div class="alert mycolor1" role="alert">사용자</div>
	<?
		$tel1 = trim(substr($row->tel29,0,3));
		$tel2 = trim(substr($row->tel29,3,4));
		$tel3 = trim(substr($row->tel29,7,4));
		$tel = $tel1 . "-" . $tel2 . "-" . $tel3;
		$rank = $row->rank29==0 ? '직원' : '관리자';
	?>

	
	<div class="row">
		<div class="col-4" align="left">       
		
		<form name="form1" method="post" action="{{ route( 'member.update', $row->id ) }}">
		@csrf
		@method('PATCH')

		<table class="table table-bordered table-sm mymargin5">
			<tr>
				<td width="20%" class="mycolor2"> 번호</td>
				<td width="80%" align="left">{{ $row->id }}</td>
			</tr>
			<tr>
				<td class="mycolor2"><font color="red">*</font> 이름</td>
				<td width="80%" align="left">{{ $row->name29 }}</td>
			</tr>
			<tr>
				<td class="mycolor2"><font color="red">*</font> 아이디</td>
				<td width="80%" align="left">{{ $row->uid29 }}</td>

			</tr>
			<tr>
				<td class="mycolor2"><font color="red">*</font> 암호</td>
				<td width="80%" align="left">{{ $row->pwd29 }}</td>
			</tr>
			<tr>
				<td class="mycolor2">전화</td>
				<td width="80%" align="left">{{ $tel }}</td>
			</tr>
			<tr>
				<td class="mycolor2">등급</td>
				<td width="80%" align="left">{{ $rank }}</td>
			</tr>
		<!-- 아이디, 암호, 전화, 등급  행 추가  …!-->
		</table>
			<div class="col-9" align="center">           
				<a href="{{ route( 'member.edit', $row->id ) }}{{ $tmp }}" class="btn btn-sm mycolor1">수정</a>&nbsp;
				<form action="{{ route('member.destroy', $row->id) }}">
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