@extends('main')
@section('content')

		<br>
		<div class="alert mycolor1" role="alert">구분</div>
		
		<div class="row">
			<div class="col-4" align="left">       
			
			<form name="form1" method="post" action="{{ route('gubun.update', $row->id) }}{{ $tmp }}">
			@csrf
			@method('PATCH')

			<table class="table table-bordered table-sm mymargin5">
				<tr>
					<td class="mycolor2" style="vertical-alignLmiddle">번호</td>
					<td align="left">{{ $row->id }}
					</td>
				</tr>
				<tr>
					<td class="mycolor2"><font color="red">*</font> 이름</td>
					<td align="left">
						<div class="d-inline-flex">
							<input  type="text" name="name" size="20" maxlength="20" value="{{ $row->name29 }}" class="form-control form-control-sm" >
						</div>
						@error("name") {{ $message }} @enderror
					</td>
				</tr>
			<!-- 아이디, 암호, 전화, 등급  행 추가  …!-->
			</table>
				<div class="col-9" align="center">           
					<input type="submit" value="저장" class="btn btn-sm mycolor1">&nbsp;
					<input type="button" value="이전화면" class="btn btn-sm mycolor1" onclick="history.back();">
				</div>
				<!-- 수정,삭제,저장,이전버튼  … -->
			</div>
			</form>


    </div>
@endsection()