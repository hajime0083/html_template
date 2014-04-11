	<div>
		<h2>メインコンテンツ管理</h2>
		
		<?php
		$mesage = Session::get('message');
		if(!empty($mesage)){
			echo '<div class="mt10">';
			echo "<p class='message'>{$mesage}</p>";
			echo '</div>';
		}	
		?>
		
		<h4 class="mt20">テキストコンテンツ登録</h4>
		<div class="mt10">
			<a href="/admin/main/picedit/">新規登録</a>
		</div>
		
		<h4 class="mt20">イラストコンテンツ登録</h4>
		<div class="mt10">
			<a href="/admin/main/txtedit/">新規登録</a>
		</div>
		
		<h4 class="mt20">登録コンテンツ一覧</h4>
		<div class="mt10">
			<?php if(!empty($cont_list)){ ?>
			<table>
				<tr>
					<th>タイトル</th>
					<th>ジャンル</th>
					<th>公開日</th>
					<th>タイプ</th>
					<th>編集</th>
					<th>削除</th>
				</tr>
			<?php foreach($cont_list as $cont_value){
					echo "<tr>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td><a href='/admin/offline/edit//'>編集</a></td>";
					echo "<td></td>";
					echo "</tr>";
			} ?>
			</table>	
			<?php }else{ ?>
			<p>登録情報はありません</p>
			<?php } ?>
		</div>
		
	</div>