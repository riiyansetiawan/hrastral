<?php $result = $this->Perusahaan_model->ajax_perusahaan_info_departments($perusahaan_id);?>
<?php $system = $this->Umb_model->read_setting_info(1);?>
<div class="form-group" id="ajx_department">
  <label for="penunjukan"><?php echo $this->lang->line('umb_hr_main_department');?></label>
  <select class="select2" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('umb_select_department');?>" name="department_id" id="aj_subdepartments" >
    <option value=""></option>
    <?php foreach($result as $deparment) {?>
    <option value="<?php echo $deparment->department_id?>"><?php echo $deparment->nama_department?></option>
    <?php } ?>
  </select>
</div>
<?php
//}
?>
<?php if($system[0]->is_active_sub_departments=='yes'){?>
<script type="text/javascript">
$(document).ready(function(){
	$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' });
	// get sub departments
	jQuery("#aj_subdepartments").change(function(){
		jQuery.get(base_url+"/get_sub_departments/"+jQuery(this).val(), function(data, status){
			jQuery('#subdepartment_ajax').html(data);
		});
	});
});
</script>
<?php } else {?>
<script type="text/javascript">
$(document).ready(function(){
// get designations
jQuery("#aj_subdepartments").change(function(){
	jQuery.get(base_url+"/is_penunjukan/"+jQuery(this).val(), function(data, status){
		jQuery('#penunjukan_ajax').html(data);
	});
});
$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' });
});
</script>
<?php } ?>