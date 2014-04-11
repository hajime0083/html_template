	<div>
		<h2>BLOG記事編集</h2>
		<h4 class="mt20">記事管理</h4>
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
					<th>カテゴリ</th>
					<th>公開日</th>
					<th>編集</th>
					<th>削除</th>
				</tr>
			<?php foreach($blog_list as $blog_value){
					echo "<tr>";
					echo "<td><a href='/blog/{$blog_value['id']}/' target='_blank'>{$blog_value['title']}</a></td>";
					echo "<td>{$blog_value['genre']}</td>";
					echo "<td>{$blog_value['created_at']}</td>";
					echo "<td><a href='/admin/blog/edit/{$blog_value['id']}/'>編集</a></td>";
					echo "<td></td>";
					echo "</tr>";
			} ?>
			</table>
			<p class="mt10"><a href="/admin/blog/list">もっと見る</a></p>
			<?php }else{ ?>
			<p>投稿記事はありません</p>
			<?php } ?>
		</div>
		
		<h4 class="mt20">下書き記事一覧</h4>
		<div class="mt10">
			<?php if(!empty($draftblog_list)){?>
			<table>
				<tr>
					<th>タイトル</th>
					<th>カテゴリ</th>
					<th>投稿日</th>
					<th>編集</th>
					<th>削除</th>
				</tr>
			<?php foreach($draftblog_list as $draftblog_value){
					echo "<tr>";
					echo "<td>{$draftblog_value['title']}</td>";
					echo "<td>{$draftblog_value['genre']}</td>";
					echo "<td>{$draftblog_value['created_at']}</td>";
					echo "<td><a href='/admin/blog/edit/{$draftblog_value['id']}/'>編集</a></td>";
					echo "<td></td>";
					echo "</tr>";
			} ?>
			</table>
			<p class="mt10"><a href="/admin/blog/draftlist">もっと見る</a></p>
			<?php }else{ ?>
			<p>下書き記事はありません</p>
			<?php } ?>
		</div>
		
	</div>