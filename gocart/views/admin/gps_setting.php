<?php echo form_open_multipart(config_item('admin_folder').'/settings/gps_setting');?>

<fieldset>
    <legend><?php echo lang('location_gps_setting');?></legend>

    <div class="row">
        <div class="span6">
            <label><?php echo lang('address');?></label>
            <?php echo form_input(array('name'=>'address', 'class'=>'span12','value'=>set_value('address',$address)));?>
        </div>       
    </div>
    
    <div class="row">
        <div class="span6">
            <label><?php echo lang('gps');?></label>
            <?php echo form_input(array('name'=>'gps', 'class'=>'span12','value'=>set_value('gps',$gps)));?>
            <p>eg : 3.0430916,101.4413921</p>
        </div>       
    </div>
    
     
 </fieldset>

 <input type="submit" class="btn btn-primary" value="<?php echo lang('save');?>" />

</form>

