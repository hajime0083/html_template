	<div>
		<h2>ブログカテゴリ管理</h2>
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
				echo Form::hidden('type', 'mod');
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
		
		<h4 class="mt20">カテゴリ新規登録</h4>
		<div class="mt10">
			<?php echo Form::open();?>
			<table>
				<tr>
					<th>カテゴリ名</th>
					<th style="width: 15%;">並び順</th>
					<th style="width: 18%;">表示/非表示</th>
				</tr>
				<?php 
					echo "<tr>";
					echo '<td>'.Form::text('name', Input::old('name', '')).'</td>';
					echo '<td>'.Form::text('order', Input::old('order', '')).'</td>';
					echo '<td>'.Form::checkbox('active_flg', BlogGenre::ACTIVE_FLG_YES,TRUE).'</td>';
					echo "</tr>";
					echo Form::hidden('type', 'add');
				?>
				<tr>
					<td colspan="3" class="txtR"><?php echo Form::submit('新規登録');?></td>
				</tr>
			</table>
			<?php echo Form::close();?>
		</div>
	</div>