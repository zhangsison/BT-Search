@extends('app')

@section('title', $keyword .' - torrent DB')

@section('content')
<style type="text/css">
	td {
		padding: 5px;
	}
	.pagination {
		margin: 20px;
		text-align: center;
	}
	.pagination a,span {
		margin-left: 10px;
		font-size: 20px;
	}
	.pagination span {
		background-color: #e0e0e0;
	}
</style>


<h2>结果</h2>
<h3>所有数据:</h3>
<table>
	<tbody>
		@if($list['data'])
			@foreach($list['data'] as $item)
				<tr>
					<td>{{ str_limit($item['name'], 100) }}</td>
					<td>{{ $item['size'] }}</td>
					<td>{{ $item['upload_date'] }}</td>
					<td><a href="{{ $item['magnet'] }}">下载</a></td>
				</tr>
			@endforeach
		@else
			<p>没有找到数据 :(</p>
		@endif
	</tbody>
</table>

<div class="pagination">
	<?php
		if($list['pageTotal'] > 5) {
			if(($page-5) <= 1) { $frontPageCount=1; } else { $frontPageCount = $page-5; }
			for ($i=$frontPageCount; $i < $page; $i++) {
				echo '<a href="javascript:void(0)" onclick="pagination('. $i .')">'. $i .'</a>';
			}
			
			echo '<span class="current">'. $page .'</span>';

			$backPageNumber = $list['pageTotal'] - $page;
			if($backPageNumber > 10) { $backPageNumber=10; }
			for ($i=$page+1; $i < $page+$backPageNumber; $i++) {
				echo '<a href="javascript:void(0)"  onclick="pagination('. $i .')">'. $i .'</a>';
			}
		}
	?>
</div>

<div class="footer">
	<p><a href="{{ action('HomeController@index') }}">torrent DB main page</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="mailto:kslrwang@gmail.com (remove the torrentdb)">Feedback</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://www.kslr.org">Kslr</a> 2016</p>
</div>
<script type="text/javascript">
	function pagination(number) {
		console.info(number);
		var url = '//'+location.host+'/search/{{ $keyword }}_'+number+'.html';
		console.info(url);
		location.href = url;
	}
</script>
@stop