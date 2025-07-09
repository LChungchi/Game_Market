@extends('main')
@section('content')
<script>
$(function(){
		$("#release").datetimepicker({
			locale:"ko",
			format:"YYYY-MM-DD",
			defaultDate:moment()
		});
	});
	
	function select_product()
	{
		var str;
		str = form1.sel_products_id.value;
		if(str==""){
			form1.products_id.value="";
			form1.price.value="";
			form1.prices.value="";
		}
		else{
			str=str.split("^^");
			form1.products_id.value=str[0];
			form1.price.value=str[1];
			form1.prices.value=Number(form1.price.value) * Number(form1.numi.value);
		}
	}
		
	function cal_prices(){
		form1.prices.value=Number(form1.price.value) * Number(form1.numi.value);
		form1.bigo.focus();
	}
</script>
		<br>
		<div class="alert mycolor1" role="alert">게임</div>
		
		<div class="row">
			<div class="col-4" align="left">       
			
			<form name="form1" method="post" action="{{ route('game.store') }}{{ $tmp }}" enctype="multipart/form-data">
			@csrf

			<table class="table table-bordered table-sm mymargin5" style="background-color:#ffffff">
			
				<tr>
					<td class="mycolor2"><font color="red">*</font> 장르</td>
					<td align="left">
						<div class="d-inline-flex">
							<input  type="text" name="genre" size="20" maxlength="20" value="{{ old('genre') }}" class="form-control form-control-sm" >
						</div>
						@error("genre") {{ $message }} @enderror
					</td>
				</tr>
				<tr>
					<td class="mycolor2"><font color="red">*</font> 이용가</td>
					<td align="left">
						<div class="d-inline-flex">
							<input  type="text" name="rated" size="10" maxlength="10" value="{{ old('rated') }}" class="form-control form-control-sm" >
						</div>
						@error("rated") {{ $message }} @enderror
					</td>
				</tr>
				<tr>
					<td class="mycolor2"><font color="red">*</font> 게임이름</td>
					<td align="left">
						<div class="d-inline-flex">
							<input  type="text" name="gname" size="20" maxlength="255" value="{{ old('gname') }}" class="form-control form-control-sm" >
						</div>
						@error("gname") {{ $message }} @enderror
					</td>
				</tr>
				<tr>
					<td class="mycolor2"><font color="red">*</font> 플랫폼</td>
					<td align="left">
						<div class="d-inline-flex">
							<!--<input  type="text" name="gubuns_id" size="20" maxlength="20" value="{{ old('gubuns_id') }}"
							class="form-control form-control-sm" > -->
							<select name="platform_id" class="form-select form-control-sm">
								<option value="" selected>선택하세요.</option>
								@foreach ($list as $row)
									@if ( $row->id == old('platform_id') )
										<option value="{{ $row->id }}" selected>{{ $row->pname }}</option>
									@else
										<option value="{{ $row->id }}">{{ $row->pname }}</option>
									@endif
								@endforeach
							</select>
						</div>
						@error("platform_id") {{ $message }} @enderror
					</td>
				</tr>
				<tr>
					<td class="mycolor2"><font color="red">*</font> 퍼블리셔</td>
					<td align="left">
						<div class="d-inline-flex">
							<!--<input  type="text" name="gubuns_id" size="20" maxlength="20" value="{{ old('gubuns_id') }}"
							class="form-control form-control-sm" > -->
							<select name="publisher_id" class="form-select form-control-sm">
								<option value="" selected>선택하세요.</option>
								@foreach ($list1 as $row)
									@if ( $row->id == old('publisher_id') )
										<option value="{{ $row->id }}" selected>{{ $row->publishers_name }}</option>
									@else
										<option value="{{ $row->id }}">{{ $row->publishers_name }}</option>
									@endif
								@endforeach
							</select>
						</div>
						@error("publisher_id") {{ $message }} @enderror
					</td>
				</tr>
				<tr>
					<td class="mycolor2"><font color="red">*</font> 가격</td>
					<td align="left">
						<div class="d-inline-flex">
							<input  type="text" name="price" size="20" maxlength="20" value="{{ old('price') }}" class="form-control form-control-sm" >
						</div>
						@error("price") {{ $message }} @enderror
					</td>
				</tr>
				<tr>
					<td class="mycolor2"><font color="red"></font> 게임설명</td>
					<td align="left">
						<div class="d-inline-flex">
							<input  type="text" name="information" size="20" maxlength="255" value="{{ old('information') }}" class="form-control form-control-sm" >
						</div>
					</td>
				</tr>
				<tr>
					<td class="mycolor2"><font color="red">*</font> 발매일</td>
					<td align="left">
						<div class="d-inline-flex">
							<div class="input-group input-group-sm date" id="release">
							<input  type="text" name="release" size="10" maxlength="20" value="{{ old('release') }}" class="form-control form-control-sm" >
							<div class="input-group-text">
								<div class="input-group-addon">
									<i class="far fa-calendar-alt fa-lg"></i>
								</div>
							</div>
							</div>
						</div>
						@error("release") {{ $message }} @enderror
					</td>
				</tr>
				<tr>
					<td class="mycolor2"><font color="red"></font> new sale hit</td>
					<td align="left">
						<div class="d-inline-flex">

						<input type='checkbox' name='new' value='0'>new
						<input type='checkbox' name='sale' value='1'>sale
						<input type='checkbox' name='hit' value='2'>hit

						</div>
					</td>
				</tr>
				<tr>
					<td class="mycolor2"><font color="red"></font> 할인율</td>
					<td align="left">
						<div class="d-inline-flex">
							<input  type="text" name="discount" size="20" maxlength="20" value="{{ old('discount') }}" class="form-control form-control-sm" >
						</div>
					</td>
				</tr>
				<tr>
					<td class="mycolor2"><font color="red"></font> 사진</td>
					<td align="left">
						<div class="d-inline-flex">
							<input  type="file" name="pic1" size="20" maxlength="255" value="" class="form-control form-control-sm" >
						</div>
					</td>
				</tr>
				<tr>
					<td class="mycolor2"><font color="red"></font> 사진</td>
					<td align="left">
						<div class="d-inline-flex">
							<input  type="file" name="pic2" size="20" maxlength="255" value="" class="form-control form-control-sm" >
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