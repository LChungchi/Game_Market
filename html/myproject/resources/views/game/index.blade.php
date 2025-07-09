@extends('main')
@section('content')
<script>
	function find_text()
	{
		  form1.action="{{ route('game.index') }}";
		  form1.submit();
	}
</script>
	<br>
	<div class="alert mycolor1" role="alert">게임</div>
		
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
			
				<a href="{{ route('game.create') }}{{ $tmp }}" class="btn btn-sm mycolor1">추가</a>
				
			</div>
			
		</div>
	</form>

	<table class="table  table-bordered  table-sm  table-hover mymargin5" style="background-color:#ffffff">
	<tr class="mycolor2">
		<td width="20%">이름</td>
		<td width="20%">장르</td>
		<td width="20%">플랫폼</td>
		<td width="20%">가격</td>
		<td width="20%">할인율</td>
		
	</tr>
	
    @foreach ($list as $row)  

    <tr>
		<td><a href="{{ route('game.show', $row->id) }}{{ $tmp }}">{{ $row->gname }}</a></td>
		<td>{{ $row->genre }}</td>
		<td>{{ $row->pname }}</td>
		<td>{{ $row->price }}</td>
		<td>{{ $row->discount }}</td>
	</tr>
		@endforeach
	</table>
	
	<div vlass="row">
		<div class="col">
			{{ $list->links('mypagination') }}
		</div>
	</div>


@endsection()