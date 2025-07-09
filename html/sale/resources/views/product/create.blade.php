@extends('main')
@section('content')

		<br>
		<div class="alert mycolor1" role="alert">제품</div>
		
		<div class="row">
			<div class="col-4" align="left">       
			
			<form name="form1" method="post" action="{{ route('product.store') }}{{ $tmp }}" enctype="multipart/form-data">
			@csrf

			<table class="table table-bordered table-sm mymargin5">
			
				<tr>
					<td class="mycolor2"><font color="red">*</font> 구분명</td>
					<td align="left">
						<div class="d-inline-flex">
							<!--<input  type="text" name="gubuns_id" size="20" maxlength="20" value="{{ old('gubuns_id') }}"
							class="form-control form-control-sm" > -->
							<select name="gubuns_id" class="form-select form-control-sm">
								<option value="" selected>선택하세요.</option>
								@foreach ($list as $row)
									@if ( $row->id == old('gubuns_id') )
										<option value="{{ $row->id }}" selected>{{ $row->name29 }}</option>
									@else
										<option value="{{ $row->id }}">{{ $row->name29 }}</option>
									@endif
								@endforeach
							</select>
						</div>
						@error("gubuns_id") {{ $message }} @enderror
					</td>
				</tr>
				<tr>
					<td class="mycolor2"><font color="red">*</font> 제품명</td>
					<td align="left">
						<div class="d-inline-flex">
							<input  type="text" name="name" size="20" maxlength="20" value="{{ old('name') }}" class="form-control form-control-sm" >
						</div>
						@error("name") {{ $message }} @enderror
					</td>
				</tr>
				<tr>
					<td class="mycolor2"><font color="red">*</font> 단가</td>
					<td align="left">
						<div class="d-inline-flex">
							<input  type="text" name="price" size="20" maxlength="20" value="{{ old('price') }}" class="form-control form-control-sm" >
						</div>
						@error("name") {{ $message }} @enderror
					</td>
				</tr>
				<tr>
					<td class="mycolor2"><font color="red">*</font> 재고</td>
					<td align="left">
						<div class="d-inline-flex">
							<input  type="text" name="jeago" size="20" maxlength="20" value="" class="form-control form-control-sm" >
						</div>
					</td>
				</tr>
				<tr>
					<td class="mycolor2"><font color="red">*</font> 사진</td>
					<td align="left">
						<div class="d-inline-flex">
							<input  type="file" name="pic" size="20" maxlength="20" value="" class="form-control form-control-sm" >
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