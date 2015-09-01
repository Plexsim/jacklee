<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete');?>');
}
</script>
<div class="btn-group pull-right">
	<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/story/form'); ?>"><i class="icon-plus-sign"></i> <?php echo lang('add_new_story');?></a>	
</div>

<table class="table table-striped">
	<thead>
		<tr>
			<th><?php echo lang('title');?></th>
			<th><?php echo lang('status');?></th>
			<th></th>
		</tr>
	</thead>
	
	
	<?php echo (count($storys) < 1)?'<tr><td style="text-align:center;" colspan="2">'.lang('no_story_or_links').'</td></tr>':''?>
	<?php if($storys):?>
	<tbody>		
		<?php
		$GLOBALS['admin_folder'] = $this->config->item('admin_folder');		
		foreach($storys as $story){			
		?>
		<tr class="gc_row">
			<td>
				<?php echo $story['title']; ?>
			</td>
			<td>
				<?php echo $story['status']; ?>
			</td>
			<td>
				<div class="btn-group pull-right">
					<?php if(!empty($story['url'])): ?>
						<a class="btn" href="<?php echo site_url($GLOBALS['admin_folder'].'/story/link_form/'.$story['id']); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>
						<a class="btn" href="<?php echo $story['url'];?>" target="_blank"><i class="icon-play-circle"></i> <?php echo lang('follow_link');?></a>
					<?php else: ?>						
						<a class="btn" href="<?php echo site_url($GLOBALS['admin_folder'].'/story/form/'.$story['id']); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>						
					<?php endif; ?>
					<a class="btn btn-danger" href="<?php echo site_url($GLOBALS['admin_folder'].'/story/delete/'.$story['id']); ?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> <?php echo lang('delete');?></a>
				</div>
			</td>
		</tr>
		<?php		
		}
		?>
	</tbody>
	<?php endif;?>
</table>