@extends('main')
@section('content')

		<br>
		<div class="alert mycolor1" role="alert">제품</div>
		
		<div class="row">
			<div class="col-4" align="left">       
			
			<form name="form1" method="post" action="{{ route('product.update', $row->id) }}{{ $tmp }}" enctype="multipart/form-data">
			@csrf
			@method('PATCH')

			<table class="table table-bordered table-sm mymargin5">
				<tr>
					<td class="mycolor2" style="vertical-alignLmiddle">번호</td>
					<td align="left">{{ $row->id }}
					</td>
				</tr>
				<tr>
					<td class="mycolor2"><font color="red">*</font> 구분명</td>
					<td align="left">
						<div class="d-inline-flex">
							<!-- <input  type="text" name="gubuns_id" size="20" maxlength="20" value="{{ $row->gubuns_id29 }}" 
							class="form-control form-control-sm" > -->
							<select name="gubuns_id" class=" form-select form-control-sm">
								<option value="" selected>선택하세요.</option>
								@foreach ($list as $row1)
									@if ( $row->gubuns_id == $row1->id )
										<option value="{{ $row1->id }}" selected>{{ $row1->name29 }}</option>
									@else
										<option value="{{ $row1->id }}">{{ $row1->name29 }}</option>
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
							<input  type="text" name="name" size="20" maxlength="20" value="{{ $row->name29 }}" class="form-control form-control-sm" >
						</div>
						@error("name") {{ $message }} @enderror
					</td>
				</tr>
				<tr>
					<td class="mycolor2"><font color="red">*</font> 단가</td>
					<td align="left">
						<div class="d-inline-flex">
							<input  type="text" name="price" size="20" maxlength="20" value="{{ $row->price29 }}" class="form-control form-control-sm" >
						</div>
						@error("price") {{ $message }} @enderror
					</td>
				</tr>
				<tr>
					<td class="mycolor2"> 재고</td>
					<td align="left">
						<div class="d-inline-flex">
							<input  type="text" name="jeago" size="20" maxlength="20" value="{{ $row->jeago29 }}" class="form-control form-control-sm" >
						</div>
					</td>
				</tr>
				<tr>
					<td class="mycolor2"> 사진</td>
					<td align="left">
						<div class="d-inline-flex">
							<input  type="file" name="pic" size="20" maxlength="20" value="" class="form-control form-control-sm" >
						</div>
						<br><br><b>파일이름</b> : {{ $row->pic29 }} <br>
						@if($row->pic29)     
						   <img src="{{ asset('stroage/product_img/' . $row->pic29) }}"
								 width="200" class="img-fluid img-thumbnail margin5">
						@else                  
							<img src=" " width="200" class="img-fluid img-thumbnail margin5">
						@endif
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