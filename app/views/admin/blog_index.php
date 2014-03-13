	<div>
		<h2>BLOG記事編集</h2>
		<div class="mt10">
			<a href="/admin/blog/edit/">新規登録</a>
		</div>
		
		<h4 class="mt20">ブログカテゴリ管理</h4>
		<div class="mt10">
			<a href="/admin/blog/category/">ブログカテゴリ管理</a>
		</div>
		
		<h4 class="mt20">投稿済記事一覧</h4>
		<div class="mt10">
			<?php if(!empty($blog_list)){ ?>
			<table>
				<tr>
					<th>タイトル</th>
					<th>投稿日</th>
					<th>カテゴリ</th>
					<th>編集</th>
					<th>削除</th>
				</tr>
			<?php foreach($blog_list as $blog_value){
					echo "<tr>";
					echo "<td>{$blog_value['title']}</td>";
					echo "<td>{$blog_value['genre']}</td>";
					echo "<td>{$blog_value['created_at']}</td>";
					echo "<td><a href='/admin/blog/edit/{$blog_value['id']}/'>編集</a></td>";
					echo "<td></td>";
					echo "</tr>";
			} ?>
			</table>	
			<?php }else{ ?>
			<p>投稿記事はありません</p>
			<?php } ?>
		</div>
		
		<h4 class="mt20">下書き記事一覧</h4>
		<div class="mt10">
			<?php if(!empty($draftblog_list)){?>
			<?php }else{ ?>
			<p>下書き記事はありません</p>
			<?php } ?>
		</div>
		
	</div>