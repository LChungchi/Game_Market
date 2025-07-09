@extends('main')
@section('content')
<script>
	function find_text()
	{
		  form1.action="{{ route('platform.index') }}";
		  form1.submit();
	}
</script>
	<br>
	<div class="alert mycolor1" role="alert">플랫폼</div>
		
	<form name="form1" action="" >
		<div class="row">
		
			<div class="col-3" align="left">            
				<div class="input-group  input-group-sm">
					<span class="input-group-text">이름</span>
					<input type="text" name="text1" value="{{ $text1 }}" class="form-control" placeholder="찾을 이름?"
					onKeydown="if (event.keyCode == 13) { find_text(); }" >

					<button class="btn mycolor1" type="button"onClick="find_text();"> 검색 </button>
				</div>
			</div>
			
			<div class="col-9" align="right">           
				<a href="{{ route('platform.create') }}{{ $tmp }}" class="btn btn-sm mycolor1">추가</a>
			</div>
			
		</div>
	</form>

	<table class="table  table-bordered  table-sm  table-hover mymargin5" style="background-color:#ffffff">
	<tr class="mycolor2">
		<td width="10%">번호</td>
		<td width="90%">이름</td>
	</tr>
	
    @foreach ($list as $row)  

    <tr>
		<td>{{ $row->id }}</td>
		<td>  <a href="{{ route('platform.show', $row->id) }}{{ $tmp }}">{{ $row->pname }}</a></td>
	</tr>
		@endforeach
	</table>
	
	<div vlass="row">
		<div class="col">
			{{ $list->links('mypagination') }}
		</div>
	</div>


@endsection()