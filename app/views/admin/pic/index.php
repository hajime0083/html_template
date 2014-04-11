	<div>
		<h2>イラスト管理</h2>
		
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
		
		<h4 class="mt20">イラスト新規登録</h4>
		<div class="mt10">
			<a href="/admin/pic/edit/">新規登録</a>
		</div>
		
		<h4 class="mt20">既存イラスト管理</h4>
		<?php if(!empty($illust_list)){
			echo "<table class='mt10'>";
			echo "<tr>"
			. "<th>タイトル</th>"
			. "<th>ジャンル</th>"
			. "<th>作成日</th>"
			. "</tr>";
			foreach($illust_list as $illust_value){
				echo "<tr>";
				echo "<td><a href='/admin/pic/edit/{$illust_value['id']}'>{$illust_value['title']}</a></td>";
				echo "<td>{$illust_value['genre']}</td>";
				echo "<td>{$illust_value['created_at']}</td>";
				echo "</tr>";
			}
			echo "</table>";
		}else{ ?>
		<p>登録作品はありません</p>
		<?php } ?>
	</div>