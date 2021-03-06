<?php
$session = $this->session->userdata('username');
$currency = $this->Umb_model->currency_sign(0);
?>
<?php $system = $this->Umb_model->read_setting_info(1);?>
<?php $get_animate = $this->Umb_model->get_content_animate();?>
<div class="box mb-4 <?php echo $get_animate;?>">
  <div class="box-header with-border">
    <h3 class="box-title"> <?php echo $this->lang->line('umb_acc_statement_period');?> </h3>
  </div>
  <div class="box-body">
    <?php $attributes = array('name' => 'laporan_accounting', 'id' => 'hrm-form', 'autocomplete' => 'off');?>
    <?php $hidden = array('re_user_id' => $session['user_id']);?>
    <?php echo form_open('admin/accounting/laporan_accounting', $attributes, $hidden);?>
    <?php
    $data = array(
      'name'        => 'user_id',
      'id'          => 'user_id',
      'type'        => 'hidden',
      'value'       => $session['user_id'],
      'class'       => 'form-control',
    );
    echo form_input($data);
    ?>
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $session['user_id'];?>">
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <input class="form-control date" placeholder="<?php echo $this->lang->line('umb_e_details_frm_date');?>" readonly id="from_date" name="from_date" type="text" value="<?php echo date('Y-m-d')?>">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input class="form-control date" placeholder="<?php echo $this->lang->line('umb_e_details_to_date');?>" readonly id="to_date" name="to_date" type="text" value="<?php echo date('Y-m-d')?>">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('umb_get');?></button>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?> 
  </div>
</div>
<div class="box <?php echo $get_animate;?>">
  <div class="box-header with-border">
    <h3 class="box-title"><?php echo $this->lang->line('umb_acc_ledger_accounts');?></h3>
  </div>
  <div class="box-body">
    <div class="box-datatable table-responsive">
      <table class="datatables-demo table table-striped table-bordered" id="umb_table">
        <input type="hidden" id="current_currency" value="<?php $curr = explode('0',$currency); echo $curr[0];?>" />
        <thead>
          <tr>
            <th><?php echo $this->lang->line('umb_e_details_tanggal');?></th>
            <th><?php echo $this->lang->line('umb_type');?></th>
            <th><?php echo $this->lang->line('umb_description');?></th>
            <th><?php echo $this->lang->line('umb_acc_credit');?></th>
            <th><?php echo $this->lang->line('umb_acc_debit');?></th>
            <th><?php echo $this->lang->line('umb_acc_saldo');?></th>
          </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot id="get_footer">
        </tfoot>
      </table>
    </div>
  </div>
</div>
