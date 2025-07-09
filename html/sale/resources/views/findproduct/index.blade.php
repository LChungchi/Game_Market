@extends('main_nomenu')
@section('content')
<script>
	function find_text()
	{
		  form1.action="{{ route('findproduct.index') }}";
		  form1.submit();
	}
	
	function SendProduct(id, name, price)
	{
		opener.form1.products_id.value = id;
		opener.form1.product_name.value = name;
		opener.form1.price.value = price;
		opener.form1.prices.value = Number(price) * Number(opener.form1.numo.value);
		self.close();
	}
	
</script>
	<br>
	<div class="alert mycolor1" role="alert">제품선택</div>
		
	<form name="form1" action="" >
		<div class="row">
		
			<div class="col-6" align="left">            
				<div class="input-group  input-group-sm">
					<span class="input-group-text">이름</span>
					<input type="text" name="text1" value="{{ $text1 }}" class="form-control" placeholder="찾을 이름?"
					onKeydown="if (event.keyCode == 13) { find_text(); }" >

					<button class="btn mycolor1" type="button"onClick="find_text();"> 검색 </button>
				</div>
			</div>
			
			<div class="col-6" align="right">           
			
			</div>
			
		</div>
	</form>

	<table class="table  table-bordered  table-sm  table-hover mymargin5">
	<tr class="mycolor2">
		<td width="10%">번호</td>
		<td width="20%">구분명</td>
		<td width="30%">제품명</td>
		<td width="20%">단가</td>
		<td width="20%">재고</td>
	</tr>
	
    @foreach ($list as $row)  

    <tr>
		<td>{{ $row->id }}</td>
		<td>{{ $row->gubun_name29 }}</td>
		<td>  <a href="javascript:SendProduct( {{ $row->id }}, '{{ $row->name29 }}', {{ $row->price29 }} );">{{ $row->name29 }}</a></td>
		<td>{{ $row->price29 }}</td>
		<td>{{ $row->jeago29 }}</td>
	</tr>
		@endforeach
	</table>
	
	<div vlass="row">
		<div class="col">
			{{ $list->links('mypagination') }}
		</div>
	</div>


@endsection()