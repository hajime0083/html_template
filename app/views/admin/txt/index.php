	<div>
		<h2>小説管理</h2>
		
		<?php
		$mesage = Session::get('message');
		if(!empty($mesage)){
			echo '<div class="mt10">';
			echo "<p class='message'>{$mesage}</p>";
			echo '</div>';
		}	
		?>
		
		<h4 class="mt20">シリーズ管理</h4>
		<div class="mt10">
			<p>シリーズ系の管理をします。小説・イラスト共通です</p>
			<a href="/admin/group/">シリーズ管理</a>
		</div>
		
		<h4 class="mt20">小説新規登録</h4>
		<div class="mt10">
			<a href="/admin/txt/edit/">新規登録</a>
		</div>
		
		<h4 class="mt20">既存小説管理</h4>
		<?php if(!empty($novel_list)){
			echo "<table class='mt10'>";
			echo "<tr>"
			. "<th>タイトル</th>"
			. "<th>ジャンル</th>"
			. "<th>作成日</th>"
			. "</tr>";
			foreach($novel_list as $novel_value){
				echo "<tr>";
				echo "<td><a href='/admin/txt/edit/{$novel_value['id']}'>{$novel_value['title']}</a></td>";
				echo "<td>{$novel_value['genre']}</td>";
				echo "<td>{$novel_value['created_at']}</td>";
				echo "</tr>";
			}
			echo "</table>";
		}else{ ?>
		<p>登録作品はありません</p>
		<?php } ?>
	</div>