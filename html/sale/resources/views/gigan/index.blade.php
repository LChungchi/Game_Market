@extends('main')
@section('content')
<script>
	function find_text()
	{
		  form1.action="{{ route('gigan.index') }}";
		  form1.submit();
		  
	}
	$(function(){
		$("#text1").datetimepicker({
			locale:"ko",
			format:"YYYY-MM-DD",
		});
		$("#text2").datetimepicker({
			locale:"ko",
			format:"YYYY-MM-DD",
		});
		
		$("#text1").on("change.datetimepicker",function(e){ find_text(); });
		$("#text2").on("change.datetimepicker",function(e){ find_text(); });
		
	});
	
	function make_excel()
	{
		form1.action="{{ url('gigan/excel') }}";
		form1.submit();
	}      
   

</script>
	<br>
	<div class="alert mycolor1" role="alert">기간별 매출입 현황</div>
		
	<form name="form1" action="" >
		<div class="row">	
			<div class="col-12" align="left">   
				
				<div class="d-inline-flex">
				<div class="input-group  input-group-sm date" id="text1">
				
					<span class="input-group-text">날짜</span>
					<input type="text" name="text1" size="10" value="{{ $text1 }}" class="form-control" 
					onKeydown="if (event.keyCode == 13) { find_text(); }" >
					<span class="input-group-text">
						<div class="input-group-addon">
							<i class="far fa-calendar-alt fa-lg"></i>
						</div>
					</span>
				</div>
				</div>
				-
				<div class="d-inline-flex">
				<div class="input-group  input-group-sm date" id="text2">
				
					<input type="text" name="text2" size="10" value="{{ $text2 }}" class="form-control" 
					onKeydown="if (event.keyCode == 13) { find_text(); }" >
					<span class="input-group-text">
						<div class="input-group-addon">
							<i class="far fa-calendar-alt fa-lg"></i>
						</div>
					</span>
				</div>
				</div>
				&nbsp;
				<div class="d-inline-flex">
				<div class="input-group  input-group-sm date">
				<span class="input-group-text">제품명</span>
					<select name="text3" class="form-select form-select-sm" onchange="find_text();" >
						<option value="0" selected> 전체 </option>
						@foreach ($list_product as $row)
							@if ( $row->id == $text3 )
								<option value='{{ $row->id }}' selected>{{ $row->name29 }}</option>
							@else
								<option value='{{ $row->id }}'>{{ $row->name29 }}</option>
							@endif
						@endforeach
					</select>
				</div>
				</div>
				<div class="d-inline-flex">
					<input type="button" value="EXCEL" class="form-control btn btn-sm mycolor1" onClick="if(confirm('엑셀파일로 저장할까요?')) make_excel();">
				</div>
			</div>
		</div>
	</form>

	<table class="table  table-bordered  table-sm  table-hover mymargin5">
	<tr class="mycolor2">
		<td width="15%">날짜</td>
		<td width="25%">제품명</td>
		<td width="10%">단가</td>
		<td width="10%">매입수량</td>
		<td width="10%">매출수량</td>
		<td width="15%">금액</td>
		<td width="15%">비고</td>
	</tr>
	
    @foreach ($list as $row)  
<?
	$numi=$row->numi29 ? number_format($row->numi29):"";
	$numo=$row->numo29 ? number_format($row->numo29):"";


?>
    <tr>
		<td>{{ $row->writeday29 }}</td>
		<td align="left"> {{ $row->product_name }} </td>
		<td align="right"> {{ number_format($row->price29) }}</td>
		<td align="right" class="mycolor3">{{ $numi }}</td>
		<td align="right" class="mycolor3">{{ $numo }}</td>
		<td align="right">{{ number_format($row->prices29) }}</td>
		<td align="left">{{ $row->bigo29 }}</td>
	</tr>
		@endforeach
	</table>
	
	<div vlass="row">
		<div class="col">
			{{ $list->links('mypagination') }}
		</div>
	</div>


@endsection()