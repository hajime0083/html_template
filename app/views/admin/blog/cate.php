	<div>
		<h2>ブログカテゴリ管理</h2>
		
		<?php
		$mesage = Session::get('message');
		if(!empty($mesage)){
			echo '<div class="mt10">';
			echo "<p class='message'>{$mesage}</p>";
			echo '</div>';
		}	
		?>
		
		<p class="mt10">
			ブログに登録されているカテゴリを管理します。<br />
			非表示にしたカテゴリに結びついている記事は表示されなくなるため注意してください。<br />
			<a href="/admin/blog/">BLOG管理</a>
		</p>
		
		<h4 class="mt20">カテゴリ既存管理</h4>
		<div class="mt10">
			<?php if(!empty($genre_list)){
				echo Form::open();
			?>
			<table>
				<tr>
					<th>id</th>
					<th>カテゴリ名</th>
					<th style="width: 15%;">並び順</th>
					<th style="width: 18%;">表示/非表示</th>
				</tr>
				<?php foreach($genre_list as $genre_value){
					echo "<tr>";
					echo "<td>{$genre_value->id}</td>";
					echo '<td>'.Form::text('name['.$genre_value->id.']', Input::old('name', $genre_value->name)).'</td>';
					echo '<td>'.Form::text('order['.$genre_value->id.']', Input::old('order', $genre_value->order)).'</td>';
					echo '<td>'.Form::checkbox('active_flg['.$genre_value->id.']', BlogGenre::ACTIVE_FLG_YES,( $genre_value->active_flg == BlogGenre::ACTIVE_FLG_YES ) ? TRUE : FALSE).'</td>';
					echo "</tr>";
				}
				?>
				<tr>
					<td colspan="4" class="txtR"><?php echo Form::submit('更新');?></td>
				</tr>
			</table>
			<?php 
			echo Form::close();
			}else{ ?>
			<p>登録済みカテゴリはありません</p>
			<?php } ?>
		</div>

	</div>