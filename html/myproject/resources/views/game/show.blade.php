@extends('main')
@section('content')

	<br>
	<div class="alert mycolor1" role="alert">게임</div>
	
	<div class="row">
		<div class="col-4" align="left">       
		
		<form name="form1" method="post" action="{{ route( 'game.update', $row->id ) }}">
		@csrf
		@method('PATCH')
		<?
		if($row['new']==1){
			$icon_new = "New";
		}
		else
			$icon_new = "";
		
		if ($row['hit']==1){
			$icon_hit = "Hit";
		}
		else
			$icon_hit = "";
		if($row['sale']==1){
			$icon_sale = "Sale";
		}
		else
			$icon_sale = "";

		?>
		<table class="table table-bordered table-sm mymargin5" style="background-color:#ffffff">
			<tr>
				<td width="20%" class="mycolor2"> 번호</td>
				<td width="80%" align="left">{{ $row->id }}</td>
			</tr>
			<tr>
				<td class="mycolor2"><font color="red">*</font> 장르</td>
				<td width="80%" align="left">{{ $row->genre }}</td>
			</tr>
			<tr>
				<td class="mycolor2"><font color="red">*</font> 이용가</td>
				<td width="80%" align="left">{{ $row->rated }}</td>
			</tr>
			<tr>
				<td class="mycolor2"><font color="red">*</font> 게임이름</td>
				<td width="80%" align="left">{{ $row->gname }}</td>
			</tr>
			<tr>
				<td class="mycolor2"><font color="red">*</font> 플랫폼</td>
				<td width="80%" align="left">{{ $row->pname }}</td>
			</tr>
			<tr>
				<td class="mycolor2"><font color="red">*</font> 퍼블리셔</td>
				<td width="80%" align="left">{{ $row->publishers_name }}</td>
			</tr>
			<tr>
				<td class="mycolor2"><font color="red">*</font> 가격</td>
				<td width="80%" align="left">{{ $row->price }}</td>
			</tr>
			<tr>
				<td class="mycolor2">게임설명</td>
				<td width="80%" align="left">{{ $row->information }}</td>
			</tr>
			<tr>
				<td class="mycolor2"><font color="red">*</font> 발매일</td>
				<td width="80%" align="left">{{ $row->release }}</td>
			</tr>
			<tr>
				<td class="mycolor2"><font color="red">*</font> new sale hit</td>
				<td width="80%" align="left">{{ $icon_new }} {{ $icon_hit }} {{ $icon_sale }}</td>

			</tr>
			<tr>
				<td class="mycolor2"><font color="red">*</font> 할인율</td>
				<td width="80%" align="left">{{ $row->discount }}</td>
			</tr>
			<tr>
				<td class="mycolor2">사진1</td>
				<td width="80%" align="left"><b>파일이름</b> : <?=$row->pic1 ?> <br>
				</div><br>

					@if($row->pic1)     
					   <img src="{{ asset('/storage/game_img/' . $row->pic1) }}"
							 width="200" class="img-fluid img-thumbnail margin5">
					@else                   
						<img src=" " width="200" class="img-fluid img-thumbnail margin5">
					@endif
				</td>
			</tr>
			<tr>
				<td class="mycolor2">사진2</td>
				<td width="80%" align="left"><b>파일이름</b> : <?=$row->pic2 ?> <br>
				</div><br>

					@if($row->pic2)     
					   <img src="{{ asset('/storage/game_img/' . $row->pic2) }}"
							 width="200" class="img-fluid img-thumbnail margin5">
					@else                   
						<img src=" " width="200" class="img-fluid img-thumbnail margin5">
					@endif
				</td>
			</tr>
		<!-- 아이디, 암호, 전화, 등급  행 추가  …!-->
		</table>
			<div class="col-9" align="center">           
				<a href="{{ route( 'game.edit', $row->id ) }}{{ $tmp }}" class="btn btn-sm mycolor1">수정</a>&nbsp;
				<form action="{{ route('game.destroy', $row->id) }}">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-sm mycolor1" 
							  onClick="return confirm('삭제할까요 ?');">삭제</button> &nbsp;
				</form>
				<input type="button" value="이전화면" class="btn btn-sm mycolor1" onclick="history.back();">
			</div>
			<!-- 수정,삭제,저장,이전버튼  … -->
		</div>
		</form>


    </div>
@endsection()