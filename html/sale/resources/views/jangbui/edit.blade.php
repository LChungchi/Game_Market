@extends('main')
@section('content')

		<br>
		<div class="alert mycolor1" role="alert">매입</div>
		<script>
			$(function(){
					$("#writeday").datetimepicker({
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
		<div class="row">
			<div class="col-4" align="left">       
			
			<form name="form1" method="post" action="{{ route('jangbui.update', $row->id) }}{{ $tmp }}" enctype="multipart/form-data">
			@csrf
			@method('PATCH')

			<table class="table table-bordered table-sm mymargin5">
				<tr>
					<td class="mycolor2"><font color="red">*</font> 날짜</td>
					<td align="left">
						<div class="d-inline-flex">
							<div class="input-group input-group-sm date" id="writeday">
							<input  type="text" name="writeday" size="10" maxlength="20" value="{{ $row->writeday }}" class="form-control form-control-sm" >
							<div class="input-group-text">
								<div class="input-group-addon">
									<i class="far fa-calendar-alt fa-lg"></i>
								</div>
							</div>
							</div>
						</div>
						@error("writeday") {{ $message }} @enderror
					</td>
					
				</tr>
				<tr>
					<td class="mycolor2"><font color="red">*</font> 제품명</td>
					<td align="left">
						<div class="d-inline-flex">
							<input type="hidden" name="products_id" value="{{ old('products_id')}}">
							<select name="sel_products_id" class="form-select form-control-sm" onchange="select_product();">
								<option value="" selected>선택하세요.</option>
								@foreach ($list as $row1)
								<?
									$t1="$row1->id^^$row1->price29";
									$t2="$row1->name29($row1->price29)";
								?>
									@if ( $row1->id == $row->products_id )
										<option value="{{ $t1 }}" selected>{{ $t2 }}</option>
									@else
										<option value="{{ $t1 }}">{{ $t2 }}</option>
									@endif
								@endforeach
							</select>
						</div>
						@error("products_id") {{ $message }} @enderror
					</td>
				</tr>
				<tr>
					<td class="mycolor2"> 단가</td>
					<td align="left">
						<div class="d-inline-flex">
							<input  type="text" name="price" size="20" maxlength="20" value="{{ $row->price29 }}" 
							class="form-control form-control-sm" onChange="cal_prices();">
						</div>
					</td>
				</tr>
				<tr>
					<td class="mycolor2"> 수량</td>
					<td align="left">
						<div class="d-inline-flex">
							<input  type="text" name="numi" size="20" maxlength="20" value="{{ $row->numi29 }}" 
							class="form-control form-control-sm" onChange="cal_prices();">
						</div>
					</td>
				</tr>
				<tr>
					<td class="mycolor2"> 금액</td>
					<td align="left">
						<div class="d-inline-flex">
							<input  type="text" name="prices" size="20" maxlength="20" value="{{ $row->prices29 }}" 
							class="form-control form-control-sm" readonly>
						</div>
					</td>
				</tr>
				<tr>
					<td class="mycolor2"> 비고</td>
					<td align="left">
						<div class="d-inline-flex">
							<input  type="text" name="bigo" size="20" maxlength="20" value="{{ $row->bigo29 }}" 
							class="form-control form-control-sm" >
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