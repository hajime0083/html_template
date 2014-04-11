	<div>
		<h2>シリーズ管理</h2>
		
		<?php
		$mesage = Session::get('message');
		if(!empty($mesage)){
			echo '<div class="mt10">';
			echo "<p class='message'>{$mesage}</p>";
			echo '</div>';
		}	
		?>
		
		<p class="mt10">
			登録されているシリーズを管理します。(小説・イラスト共通)<br />
		</p>
		
		<h4 class="mt20">新規シリーズ追加</h4>
		<div class="mt10">
			<?php echo Form::open();?>
			<table>
				<tr>
					<th>シリーズカテゴリ名</th>
					<th>シリーズ説明</th>
					<th>並び順</th>
					<th style="width: 18%;">表示/非表示</th>
				</tr>
				<tr>
					<td><?php echo Form::text('name'); ?></td>
					<td><?php echo Form::text('memo'); ?></td>
					<td><?php echo Form::text('order'); ?></td>
					<td><?php echo Form::checkbox('active_flg', Group::ACTIVE_FLG_YES,TRUE); ?></td>
				</tr>
				<tr>
					<td colspan="4" class="txtR"><?php echo Form::submit('追加');?></td>
				</tr>
			</table>
			<?php
			echo Form::hidden('type','add');
			echo Form::close();
			?>
			
		</div>
		
		<h4 class="mt20">既存シリーズ管理</h4>
		<div class="mt10">
			<?php if(!empty($group_list)){
				echo Form::open();
			?>
			<table>
				<tr>
					<th>id</th>
					<th>シリーズカテゴリ名</th>
					<th>シリーズ説明</th>
					<th>並び順</th>
					<th style="width: 18%;">表示/非表示</th>
				</tr>
				<?php foreach($group_list as $group_value){
					echo "<tr>";
					echo "<td>{$group_value->id}</td>";
					echo '<td>'.Form::text('name['.$group_value->id.']', Input::old('name', $group_value->name)).'</td>';
					echo '<td>'.Form::text('memo['.$group_value->id.']', Input::old('memo', $group_value->memo)).'</td>';
					echo '<td>'.Form::text('order['.$group_value->id.']', Input::old('order', $group_value->order)).'</td>';
					echo '<td>'.Form::checkbox('active_flg['.$group_value->id.']', Group::ACTIVE_FLG_YES,($group_value->active_flg == Group::ACTIVE_FLG_YES ) ? TRUE : FALSE).'</td>';
					echo "</tr>";
				}
				?>
				<tr>
					<td colspan="5" class="txtR"><?php echo Form::submit('更新');?></td>
				</tr>
			</table>
			<?php 
			echo Form::hidden('type','mod');
			echo Form::close();
			}else{ ?>
			<p>登録済みカテゴリはありません</p>
			<?php } ?>

	</div>
</div>