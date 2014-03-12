	<div>
		<?php foreach($pictxt_list as $pictxt_value){ 
			$chk_first = $pictxt_list;
			$class = '';
			if(reset($pictxt_list) !== $pictxt_value){
				$class = ' class="mt10"';
			}
		?>
		<h2<?php echo $class;?>><?php echo $pictxt_value['genre_name']; ?></h2>
		
		<?php if(isset($pictxt_value['img'])){ ?>
		<div class="mt10">
			<h4>IMG</h4>
			<dl>
				<?php foreach($pictxt_value['img'] as $img_id => $img_value){ ?>
				<dt>
					<a href="/pic/<?php echo $img_id; ?>/">
						<?php echo $img_value['title']; ?>
					</a>
				</dt>
				<?php } ?>
			</dl>
		</div>
		<?php } ?>
		
		<?php if(isset($pictxt_value['txt'])){ ?>
		<div class="mt10">
			<h4>TXT</h4>
			<dl>
				<?php foreach($pictxt_value['txt'] as $txt_id => $txt_value){ ?>
				<dt>
					<a href="/txt/<?php echo $txt_id; ?>/">
						<?php echo $txt_value['title']; ?>
					</a>
				</dt>
				<?php } ?>
			</dl>
		</div>
		<?php } ?>
		
		<?php } ?>
	</div>