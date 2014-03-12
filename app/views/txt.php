	<div>
		<h2><?php echo $title; ?></h2>
		<p class="txt_body">
			<?php echo $txt; ?>
		</p>
		<div class="txt_memo">
			<dl>
				<dt>作成：<?php echo $created_at; ?></dt>
				<?php if(!empty($updated_at)){
					echo "最終更新：{$updated_at}";
				}?>
				<dd class="mt10"><?php echo $memo; ?></dd>
			</dl>
			<p><a href="/pictxt/">back</a></p>
		</div>
	</div>