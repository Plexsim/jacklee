<?php 
	$f_image		= array('name'=>'husband_image', 'id'=>'husband_image');
?>

<?php echo form_open_multipart(config_item('admin_folder').'/settings/husband_setting');?>

<fieldset>
    <legend><?php echo lang('husband_setting');?></legend>

    <div class="row">
        <div class="span6">
            <label><?php echo lang('husband_name');?></label>
            <?php echo form_input(array('name'=>'husband_name', 'class'=>'span12','value'=>set_value('husband_name',$husband_name)));?>
        </div>       
    </div>
    
    <div class="row">
        <div class="span6">
            <label><?php echo lang('husband_description');?></label>
            <?php echo form_input(array('name'=>'husband_description', 'class'=>'span12','value'=>set_value('husband_description',$husband_description)));?>           
        </div>       
    </div>
    
    <div class="row">
        <div class="span6">
            <label><?php echo lang('image');?></label>
            <?php echo form_upload($f_image); ?>
			<?php if($husband_image != ''):?>
				<div style="text-align:center; padding:5px; border:1px solid #ccc;"><img src="<?php echo gallery_img($husband_image);?>" alt="current"/><br/><?php echo lang('current_file');?></div>
			<?php endif;?>
        </div>
    </div>         		
     
</fieldset>

 <input type="submit" class="btn btn-primary" value="<?php echo lang('save');?>" />

</form>

