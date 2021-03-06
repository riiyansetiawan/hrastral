<?php
/* tugas List view
*/
?>
<?php $session = $this->session->userdata('client_username');?>
<?php $get_animate = $this->Umb_model->get_content_animate();?>
<?php $project = $this->Project_model->get_projects_client($session['client_id']); ?>
<div class="card mb-4 <?php echo $get_animate;?>">
  <div id="accordion">
    <div class="card-header with-elements"> <span class="card-header-title mr-2"><strong><?php echo $this->lang->line('umb_add_new');?></strong> <?php echo $this->lang->line('umb_tugas');?></span>
      <div class="card-header-elements ml-md-auto"> <a class="text-dark collapsed" data-toggle="collapse" href="#add_form" aria-expanded="false">
        <button type="button" class="btn btn-xs btn-primary"> <span class="ion ion-md-add"></span> <?php echo $this->lang->line('umb_add_new');?></button>
        </a> </div>
    </div>
    <div id="add_form" class="collapse add-form <?php echo $get_animate;?>" data-parent="#accordion" style="">
      <div class="card-body">
        <?php $attributes = array('name' => 'add_tugas', 'id' => 'umb-form', 'autocomplete' => 'off');?>
        <?php $hidden = array('user_id' => $session['client_id']);?>
        <?php echo form_open('client/tugass/add_tugas', $attributes, $hidden);?>
        <div class="bg-white">
          <div class="box-block">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nama_tugas"><?php echo $this->lang->line('dashboard_umb_title');?></label>
                  <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_umb_title');?>" name="nama_tugas" type="text" value="">
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="start_date"><?php echo $this->lang->line('umb_start_date');?></label>
                      <input class="form-control date" placeholder="<?php echo $this->lang->line('umb_start_date');?>" readonly name="start_date" type="text" value="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="end_date"><?php echo $this->lang->line('umb_end_date');?></label>
                      <input class="form-control date" placeholder="<?php echo $this->lang->line('umb_end_date');?>" readonly name="end_date" type="text" value="">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="jam_tugas" class="control-label"><?php echo $this->lang->line('umb_estimated_hour');?></label>
                      <input class="form-control" placeholder="<?php echo $this->lang->line('umb_estimated_hour');?>" name="jam_tugas" type="text" value="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group" id="ajax_project">
                      <label for="ajax_project" class="control-label"><?php echo $this->lang->line('umb_project');?></label>
                      <select class="form-control" name="project_id" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('umb_project');?>">
                        <option value=""></option>
                        <?php foreach($project->result() as $eproject) {?>
                        <option value="<?php echo $eproject->project_id?>"> <?php echo $eproject->title;?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="description"><?php echo $this->lang->line('umb_description');?></label>
                  <textarea class="form-control textarea" placeholder="<?php echo $this->lang->line('umb_description');?>" name="description" cols="30" rows="5" id="description"></textarea>
                </div>
              </div>
            </div>
            <div class="form-actions box-footer">
              <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo $this->lang->line('umb_save');?> </button>
            </div>
          </div>
        </div>
        <?php echo form_close(); ?> </div>
    </div>
  </div>
</div>
<div class="card <?php echo $get_animate;?>">
  <div class="card-header with-elements"> <span class="card-header-title mr-2"><strong><?php echo $this->lang->line('umb_list_all');?></strong> <?php echo $this->lang->line('umb_worksheets');?></span> </div>
  <div class="card-body">
    <div class="box-datatable table-responsive">
      <table class="datatables-demo table table-striped table-bordered" id="umb_table">
        <thead>
          <tr>
            <th><?php echo $this->lang->line('dashboard_umb_title');?></th>
            <th><?php echo $this->lang->line('umb_project');?></th>
            <th><?php echo $this->lang->line('umb_end_date');?></th>
            <th><?php echo $this->lang->line('dashboard_umb_status');?></th>            
            <th><?php echo $this->lang->line('dashboard_umb_progress');?></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
