<?php 
	$f_image		= array('name'=>'wife_image', 'id'=>'wife_image');
?>

<?php echo form_open_multipart(config_item('admin_folder').'/settings/wife_setting');?>

<fieldset>
    <legend><?php echo lang('wife_setting');?></legend>

    <div class="row">
        <div class="span6">
            <label><?php echo lang('wife_name');?></label>
            <?php echo form_input(array('name'=>'wife_name', 'class'=>'span12','value'=>set_value('wife_name',$wife_name)));?>
        </div>       
    </div>
    
    <div class="row">
        <div class="span6">
            <label><?php echo lang('wife_description');?></label>
            <?php echo form_input(array('name'=>'wife_description', 'class'=>'span12','value'=>set_value('wife_description',$wife_description)));?>           
        </div>       
    </div>
    
    <div class="row">
        <div class="span6">
            <label><?php echo lang('image');?></label>
            <?php echo form_upload($f_image); ?>
			<?php if($wife_image != ''):?>
				<div style="text-align:center; padding:5px; border:1px solid #ccc;"><img src="<?php echo gallery_img($wife_image);?>" alt="current"/><br/><?php echo lang('current_file');?></div>
			<?php endif;?>
        </div>       
    </div>
     
    		
     
 </fieldset>

 <input type="submit" class="btn btn-primary" value="<?php echo lang('save');?>" />

</form>

