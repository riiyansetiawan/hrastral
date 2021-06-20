<?php
/* Quote view
*/
?>
<?php $session = $this->session->userdata('username');?>
<?php $system_setting = $this->Umb_model->read_setting_info(1);?>
<?php
$name_client = $name;
$client_nomor_kontak = $nomor_kontak;
$nama_perusahaan_client = $nama_perusahaan_client;
$client_website_url = $website_url;
$client_alamat_1 = $alamat_1;
$client_alamat_2 = $alamat_2;
//$negara_client = $negaraid;
$client_kota = $kota;
$client_kode_pos = $kode_pos;
$negara = $this->Umb_model->read_info_negara($negaraid);
if(!is_null($negara)){
$negara_client = $negara[0]->nama_negara;
} else {
$negara_client = '--';	
}

?>
<?php $get_animate = $this->Umb_model->get_content_animate();?>
<?php $perusahaan = $this->Umb_model->read_info_setting_perusahaan(1);?>
<?php if($this->session->flashdata('response')):?>
<div class="callout callout-success">
<p><?php echo $this->session->flashdata('response');?></p>
</div>
<?php endif;?>

<div class="card">
<?php $record_convert_quote = $this->Quotes_model->read_info_converted_quote($quote_id);?>
    <?php if ($record_convert_quote < 1) { ?>
<div class="card-header with-elements"> <span class="card-header-title mr-2">&nbsp;</span>
      <div class="card-header-elements ml-md-auto">
      <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary waves-effect waves-light"  data-toggle="modal" data-target=".view-modal-data"  data-quote_id="<?php echo $quote_id; ?>"><span class="fa fa-exchange"></span> <?php echo $this->lang->line('umb_quote_convert_project');?></a>
      <a href="<?php echo site_url('admin/quotes/edit/'.$quote_id);?>" class="btn btn-outline-primary btn-sm waves-effect waves-light"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?php echo $this->lang->line('umb_edit');?></a>
      </div>
    </div>
   <?php } ?> 
  <div class="card-body p-5" id="print_invoice_hr">
    <div class="row">
      <div class="col-sm-6 pb-4">

        <div class="media align-items-center mb-2">
          <div class="media-body text-big font-weight-bold ml-1">
            <?php echo $nama_perusahaan;?>
          </div>
        </div>
        <div class="mb-0"><?php echo $alamat_perusahaan;?></div>
        <div class="mb-0"><?php echo $kode_pos_perusahaan;?>, <?php echo $kota_perusahaan;?>, <?php echo $negara_perusahaan;?></div>
        <div><?php echo $this->lang->line('umb_phone');?>: <?php echo $phone_perusahaan;?></div>
        <div><strong>Attn:</strong> <?php echo $name;?></div>
        <div><strong><?php echo $this->lang->line('umb_project');?>:</strong> <?php echo $nama_project;?></div>
      </div>

      <div class="col-sm-6 text-right pb-4">

        <h6 class="text-big text-large font-weight-bold mb-3">
        <span style="text-transform:uppercase;"><?php echo $this->lang->line('umb_title_quote_hash');?></span> <?php echo $quote_number;?></h6>
        <div class="mb-1"><?php echo $this->lang->line('umb_e_details_tanggal');?>: <strong class="font-weight-semibold"><?php echo $this->Umb_model->set_date_format($quote_tanggal);?></strong></div>
        <div><?php echo $this->lang->line('umb_payment_due');?>: <strong class="font-weight-semibold"><?php echo $this->Umb_model->set_date_format($quote_due_date);?></strong></div>
        <div>
        <?php $_status = '';
		if($status == 0){
			$_status = '<span class="badge badge-warning">'.$this->lang->line('umb_quoted_title').'</span>';
		} else {
			$_status = '<span class="badge badge-success">'.$this->lang->line('umb_quote_invoiced').'</span>';
		}
		echo $_status;
		?>
        </div>

      </div>
    </div>

    <hr class="mb-4">

    <div class="row">
      <div class="col-sm-6 mb-4">

        <div class="font-weight-bold mb-2"><?php echo $this->lang->line('umb_estimate_to');?>:</div>
        <div><?php echo $name_client;?></div>
        <div><?php echo $nama_perusahaan_client;?></div>
        <div><?php echo $client_alamat_1.' '.$client_alamat_2.' '.$client_kota;?></div>
        <div><?php echo $client_nomor_kontak;?></div>
        <div><?php echo $email;?></div>

      </div>
      <div class="col-sm-6 mb-4">

        <div class="font-weight-bold mb-2"><?php echo $this->lang->line('umb_payment_details');?>:</div>
        <table>
          <tbody>
            <tr>
              <td class="pr-3"><?php echo $this->lang->line('umb_total_due');?>:</td>
              <td><strong><?php echo $this->Umb_model->currency_sign($grand_total);?></strong></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="table-responsive mb-4">
      <table class="table m-0">
        <thead>
          <tr>
              <th class="py-3"> # </th>
              <th class="py-3" width="300px"> <?php echo $this->lang->line('umb_title_item');?> </th>
              <th class="py-3"> <?php echo $this->lang->line('umb_title_nilai_pajak');?> </th>
              <th class="py-3"> <?php echo $this->lang->line('umb_title_qty_hrs');?> </th>
              <th class="py-3"> <?php echo $this->lang->line('umb_title_unit_price');?> </th>
              <th class="py-3"> <?php echo $this->lang->line('umb_title_sub_total');?> </th>
            </tr>
        </thead>
        <tbody>
          <?php
			$info_perusahaan = $this->Perusahaan_model->read_informasi_perusahaan($eperusahaan_id);
			$prod = array(); $i=1; foreach($this->Quotes_model->get_quote_items($quote_id) as $_item):?>
            <?php if(!is_null($info_perusahaan)){ ?>
            <tr>
              <td class="py-3"><div class="font-weight-semibold"><?php echo $i;?></div></td>
              <td class="py-3" style="width:"><div class="font-weight-semibold"><?php echo $_item->item_name;?></div></td>
              <td class="py-3"><strong><?php echo $this->Umb_model->perusahaan_currency_sign($_item->item_nilai_pajak,$eperusahaan_id);?></strong></td>
              <td class="py-3"><strong><?php echo $_item->item_qty;?></strong></td>
              <td class="py-3"><strong><?php echo $this->Umb_model->perusahaan_currency_sign($_item->item_unit_price,$eperusahaan_id);?></strong></td>
              <td class="py-3"><strong><?php echo $this->Umb_model->perusahaan_currency_sign($_item->item_sub_total,$eperusahaan_id);?></strong></td>
            </tr>
            <?php } else {?>
            <tr>
              <td class="py-3"><div class="font-weight-semibold"><?php echo $i;?></div></td>
              <td class="py-3" style="width:"><div class="font-weight-semibold"><?php echo $_item->item_name;?></div></td>
              <td class="py-3"><strong><?php echo $this->Umb_model->currency_sign($_item->item_nilai_pajak);?></strong></td>
              <td class="py-3"><strong><?php echo $_item->item_qty;?></strong></td>
              <td class="py-3"><strong><?php echo $this->Umb_model->currency_sign($_item->item_unit_price);?></strong></td>
              <td class="py-3"><strong><?php echo $this->Umb_model->currency_sign($_item->item_sub_total);?></strong></td>
            </tr>
            <?php } ?>
            <?php endforeach;?>
            <tr>
                <td colspan="5" class="text-right py-3">
                  Subtotal:<br>
                  Tax:<br>
                  Discount:<br>
                  <span class="d-block text-big mt-2">Total:</span>
                </td>
                <td class="py-3">
                  <strong><?php echo $this->Umb_model->currency_sign($sub_jumlah_total);?></strong><br>
                  <strong><?php echo $this->Umb_model->currency_sign($total_pajak);?></strong><br>
                  <strong><?php echo $this->Umb_model->currency_sign($total_discount);?></strong><br>
                  <strong class="d-block text-big mt-2"><?php echo $this->Umb_model->currency_sign($grand_total);?></strong>
                </td>
              </tr>
        </tbody>
      </table>
    </div>
    <?php if($quote_note != ''):?>
    <div class="text-muted">
      <strong><?php echo $this->lang->line('umb_note');?>:</strong> <?php echo $quote_note;?>
    </div>
   <?php endif;?> 
  </div>
  <div class="card-footer text-right">
    <a href="javascript:void(0);" class="btn btn-default print-invoice"><i class="ion ion-md-print"></i>&nbsp; <?php echo $this->lang->line('umb_print');?></a>
  </div>
</div>
