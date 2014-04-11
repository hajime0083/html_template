	<div>
		<h2>BLOG記事編集</h2>
		
		<h4 class="mt20">投稿済記事一覧</h4>
		<p><a href='/admin/blog/'>戻る</a></p>
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
			
			<div class="pager">
				<?php echo $paginator->links();?>
			</div>
			<?php }else{ ?>
			<p>投稿記事はありません</p>
			<?php } ?>
		</div>	
	</div>