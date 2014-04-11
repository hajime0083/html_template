	<div>
		<h2>オフライン管理</h2>
		
		<?php
		$mesage = Session::get('message');
		if(!empty($mesage)){
			echo '<div class="mt10">';
			echo "<p class='message'>{$mesage}</p>";
			echo '</div>';
		}	
		?>
		<h4 class="mt20">イベント予定</h4>
		<div class="mt10">
			<?php 
			echo Form::open();
			echo Form::textarea('event',$event);
			echo Form::submit('イベント更新');
			echo Form::close();
			?>
		</div>
		
		<h4 class="mt20">在庫管理</h4>
		<div class="mt10">
			<a href="/admin/offline/edit/">新規登録</a>
		</div>
		
		<h4 class="mt20">カテゴリ管理</h4>
		<div class="mt10">
			<a href="/admin/genre/">カテゴリ管理</a>
		</div>
		
		<h4 class="mt20">登録書籍一覧</h4>
		<div class="mt10">
			<?php if(!empty($book_list)){ ?>
			<table>
				<tr>
					<th>タイトル</th>
					<th>ジャンル</th>
					<th>発行日</th>
					<th>編集</th>
					<th>削除</th>
				</tr>
			<?php foreach($book_list as $book_value){
					echo "<tr>";
					echo "<td>{$book_value['title']}</td>";
					echo "<td>{$book_value['genre']}</td>";
					echo "<td>{$book_value['issued_at']}</td>";
					echo "<td><a href='/admin/offline/edit/{$book_value['id']}/'>編集</a></td>";
					echo "<td></td>";
					echo "</tr>";
			} ?>
			</table>	
			<?php }else{ ?>
			<p>登録情報はありません</p>
			<?php } ?>
		</div>
		
	</div>