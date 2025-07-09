@extends('main')
@section('content')

	<br>
	<div class="alert mycolor1" role="alert">퍼블리셔</div>


	
	<div class="row">
		<div class="col-4" align="left">       
		
		<form name="form1" method="post" action="{{ route( 'publisher.update', $row->id ) }}">
		@csrf
		@method('PATCH')

		<table class="table table-bordered table-sm mymargin5" style="background-color:#ffffff">
			<tr>
				<td width="20%" class="mycolor2"> 번호</td>
				<td width="80%" align="left">{{ $row->id }}</td>
			</tr>
			<tr>
				<td class="mycolor2"><font color="red">*</font> 퍼블리셔이름</td>
				<td width="80%" align="left">{{ $row->publishers_name }}</td>
			</tr>
			<tr>
				<td class="mycolor2"><font color="red">*</font> 퍼블리셔주소</td>
				<td width="80%" align="left">{{ $row->publishers_address }}</td>
			</tr>
			<tr>
				<td class="mycolor2"><font color="red">*</font> 개발사이름</td>
				<td width="80%" align="left">{{ $row->dev_name }}</td>
			</tr>
			<tr>
				<td class="mycolor2"><font color="red">*</font> 개발사주소</td>
				<td width="80%" align="left">{{ $row->dev_address }}</td>
			</tr>
		<!-- 아이디, 암호, 전화, 등급  행 추가  …!-->
		</table>
			<div class="col-9" align="center">           
				<a href="{{ route( 'publisher.edit', $row->id ) }}{{ $tmp }}" class="btn btn-sm mycolor1">수정</a>&nbsp;
				<form action="{{ route('publisher.destroy', $row->id) }}">
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