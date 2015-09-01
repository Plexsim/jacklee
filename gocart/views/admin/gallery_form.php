<?php 
	$f_image		= array('name'=>'image', 'id'=>'image');
?>


<?php echo form_open_multipart($this->config->item('admin_folder').'/gallery/form/'.$id); ?>

<div class="tabbable">
	
	<div class="tab-content">
		<div class="tab-pane active" id="content_tab">
			<fieldset>
				<label for="title"><?php echo lang('title');?></label>
				<?php
				$data	= array('name'=>'title', 'value'=>set_value('title', $title), 'class'=>'span12');
				echo form_input($data);
				?>
				
				<!--label for="content"><?php echo lang('content');?></label>
				<?php
				$data	= array('name'=>'content', 'class'=>'redactor' ,'value'=>set_value('content', $content));
				echo form_textarea($data);
				?>
				-->
				
				<label for="sequence"><?php echo lang('sequence');?></label>
				<?php
				$data	= array('name'=>'sequence', 'value'=>set_value('sequence', $sequence), 'class'=>'span3');
				echo form_input($data);
				?>
								
				<label for="status"><?php echo lang('status');?> </label>
				<?php
			 	$options = array(	 'Enable'		=> lang('enable')
									,'Disable'		=> lang('disable')
									);
				echo form_dropdown('status', $options, set_value('status',$status));
				?>
				</br>
				<?php echo form_upload($f_image); ?>
				<?php if($id && $image != ''):?>
					<div style="text-align:center; padding:5px; border:1px solid #ccc;"><img src="<?php echo gallery_img($image);?>" alt="current"/><br/><?php echo lang('current_file');?></div>
				<?php endif;?>		
			</fieldset>
		</div>
				
	</div>
</div>

<div class="form-actions">
	<button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
</div>	
</form>