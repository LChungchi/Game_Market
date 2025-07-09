@extends('main')
@section('content')

		<br>
		<div class="alert mycolor1" role="alert">사용자</div>
		
		<div class="row">
			<div class="col-4" align="left">       
			
			<form name="form1" method="post" action="{{ route('member.update', $row->id) }}{{ $tmp }}">
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
				<tr>
					<td class="mycolor2"><font color="red">*</font> 아이디</td>
					<td align="left">
						<div class="d-inline-flex">
							<input  type="text" name="uid" size="20" maxlength="20" value="{{ $row->uid29 }}" class="form-control form-control-sm" >
						</div>
						@error("uid") {{ $message }} @enderror
					</td>
				</tr>
				<tr>
					<td class="mycolor2"><font color="red">*</font> 암호</td>
					<td align="left">
						<div class="d-inline-flex">
							<input  type="text" name="pwd" size="20" maxlength="20" value="{{ $row->pwd29 }}" class="form-control form-control-sm" >
						</div>
							@error("pwd") {{ $message }} @enderror
					</td>
				</tr>
				<?
					$tel1 = trim(substr($row->tel29,0,3));
					$tel2 = trim(substr($row->tel29,3,4));
					$tel3 = trim(substr($row->tel29,7,4));
				?>
				<tr>
					<td class="mycolor2">전화</td>
					<td align="left">
						<div class="d-inline-flex">
							<input  type="text" name="tel1" size="3" maxlength="3" value="{{ $tel1 }}" class="form-control form-control-sm" >-
							<input  type="text" name="tel2" size="4" maxlength="4" value="{{ $tel2 }}" class="form-control form-control-sm" >-
							<input  type="text" name="tel3" size="4" maxlength="4" value="{{ $tel3 }}" class="form-control form-control-sm" >
						</div>
					</td>
				</tr>
				<tr>
					<td class="mycolor2">등급</td>
					<td align="left">
						<div class="d-inline-flex">
						@if($row->rank29==0)
							<input  type="radio" name="rank" value="0" checked>&nbsp;직원&nbsp;&nbsp;
							<input  type="radio" name="rank" value="1" >&nbsp;관리자
						@else
							<input  type="radio" name="rank" value="0" >&nbsp;직원&nbsp;&nbsp;
							<input  type="radio" name="rank" value="1" checked>&nbsp;관리자
						@endif
						</div>
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