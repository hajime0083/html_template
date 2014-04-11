	<div>
		<h2>TOPページコンテンツ管理</h2>
		
		<h4 class="mt20">メインイメージ</h4>
		<p class="mt10">size:800*200</p>
		<?php echo Form::open(array('enctype'=>'multipart/form-data'));?>
		<?php if($main_img){
			echo "<div class='imgLiquid' style='width:400px; height:100px;'><img src='/img/common/main_img.jpg'></div>";
			echo Form::label('del_main_img','削除：');
			echo Form::checkbox('del_main_img',1);
		} ?>
		<?php echo Form::hidden('type','main_img');?>
		<?php echo Form::file('main_img'); ?><br />
		<?php echo Form::submit('画像登録');?>
		<?php echo Form::close();?>
		
		<h4 class="mt20">更新履歴</h4>
		<p>
			更新履歴は最新の<?php echo Config::get('my_config.lastupdate_num'); ?>件までが表示されます(それ以下は省略されます)
		</p>
		
		<div class="mt10">
			<?php echo Form::open();?>
			<?php echo Form::textarea('lastupdate',$lastupdate,array('class'=>'medium')); ?>
			<?php echo Form::hidden('type','lastupdate');?>
			<?php echo Form::submit('更新');?>
			<?php echo Form::close();?>
		</div>
		
		
		<h4 class="mt20">リンク管理</h4>
		<p class="mt10">新規リンク追加</p>
		<?php echo Form::open();?>
		<table>
			<tr>
				<th>サイト名</th>
				<th style="width: 15%;">アドレス</th>
				<th style="width: 15%;">ジャンル</th>
				<th style="width: 18%;">追加</th>
			</tr>
			<tr>
				<td><?php echo Form::text('name'); ?></td>
				<td><?php echo Form::text('url'); ?></td>
				<td><?php echo Form::select('genre_id',$genre_list); ?></td>
				<td><?php echo Form::submit('追加');?></td>
			</tr>
		</table>
		<?php echo Form::hidden('type','link_add');?>
		<?php echo Form::close();?>
		
		<p class="mt10">既存リンク管理</p>
		<div class="mt10">
			<?php if(!empty($link_list)){
				echo Form::open();
			?>
			<table>
				<tr>
					<th>サイト名</th>
					<th>url</th>
					<th>ジャンル</th>
					<th>削除</th>
				</tr>
				<?php foreach($link_list as $link_value){
					echo "<tr>";
					echo '<td>'.Form::text('name['.$link_value->id.']', Input::old('name', $link_value->name)).'</td>';
					echo '<td>'.Form::text('url['.$link_value->id.']', Input::old('url', $link_value->url)).'</td>';
					echo '<td>'.Form::select('genre_id['.$link_value->id.']',$genre_list,array('value'=>$link_value->genre_id)).'</td>';
					echo '<td>'.Form::checkbox('del_flg['.$link_value->id.']',1).'</td>';
					echo "</tr>";
				}
				?>
				<tr>
					<td colspan="4" class="txtR"><?php echo Form::submit('更新');?></td>
				</tr>
			</table>
			<?php 
			echo Form::hidden('type','link_edit');
			echo Form::close();
			}else{ ?>
			<p>登録済みリンクはありません</p>
			<?php } ?>
		</div>
		
	</div>