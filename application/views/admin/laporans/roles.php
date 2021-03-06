<?php
/* tugass report view
*/
?>
<?php $session = $this->session->userdata('username');?>
<?php $_tugass = $this->Timesheet_model->get_tugass();?>
<?php $get_animate = $this->Umb_model->get_content_animate();?>
<div class="row">
    <div class="col-md-12 <?php echo $get_animate;?>">
        <div class="ui-bordered px-4 pt-4 mb-4">
        <input type="hidden" id="user_id" value="0" />
        <?php $attributes = array('name' => 'roles_report', 'id' => 'roles_report', 'autocomplete' => 'off', 'class' => 'add form-hrm');?>
		<?php $hidden = array('euser_id' => $session['user_id']);?>
        <?php echo form_open('admin/laporans/roles_report', $attributes, $hidden);?>
        <?php
			$data = array(
			  'name'        => 'user_id',
			  'id'          => 'user_id',
			  'type'        => 'hidden',
			  'value'   	   => $session['user_id'],
			  'class'       => 'form-control',
			);
            echo form_input($data);
            ?>
          <div class="form-row">
          <div class="col-md mb-3">
              <label class="form-label"><?php echo $this->lang->line('umb_hr_report_user_roles');?></label>
              <select class="form-control" name="role_id" id="role_id" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('umb_hr_report_user_roles');?>" required>
                <option value="0"><?php echo $this->lang->line('umb_hr_laporans_roles_all');?></option>
                <?php foreach($all_user_roles as $user_role) {?>
                <option value="<?php echo $user_role->role_id?>"><?php echo $user_role->role_name?></option>
                <?php } ?>
              </select>
            </div>            
            <div class="col-md col-xl-2 mb-4">
              <label class="form-label d-none d-md-block">&nbsp;</label>
              <button type="submit" class="btn btn-secondary btn-block"><?php echo $this->lang->line('umb_get');?></button>
            </div>
          </div>
          <?php echo form_close(); ?>
        </div>
    </div>
</div>
<div class="row m-b-1 <?php echo $get_animate;?>">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header with-elements"> <span class="card-header-title mr-2"><strong><?php echo $this->lang->line('umb_hr_laporan_user_roles_laporan');?></strong></span> </div>
      <div class="card-body">
        <div class="box-datatable table-responsive">
          <table class="datatables-demo table table-striped table-bordered" id="umb_table">
            <thead>
              <tr>
                <th><?php echo $this->lang->line('umb_karyawans_id');?></th>
                <th><?php echo $this->lang->line('umb_karyawans_full_name');?></th>
                <th><?php echo $this->lang->line('left_perusahaan');?></th>
                <th><?php echo $this->lang->line('dashboard_email');?></th>
                <th><?php echo $this->lang->line('umb_karyawan_role');?></th>
                <th><?php echo $this->lang->line('umb_penunjukan');?></th>
                <th><?php echo $this->lang->line('dashboard_umb_status');?></th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
