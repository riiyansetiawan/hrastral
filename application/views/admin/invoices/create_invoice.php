<?php
// Create Invoice Page

$system_setting = $this->Umb_model->read_setting_info(1);
?>
<?php $get_animate = $this->Umb_model->get_content_animate();?>

<div class="row <?php echo $get_animate;?>">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header with-elements"> <span class="card-header-title mr-2"><strong><?php echo $this->lang->line('umb_create_invoice');?></strong></span> </div>
      <div class="card-body" aria-expanded="true" style="">
        <div class="row m-b-1">
          <div class="col-md-12">
            <?php $attributes = array('name' => 'create_invoice', 'id' => 'umb-form', 'autocomplete' => 'off', 'class' => 'form');?>
            <?php $hidden = array('user_id' => 0);?>
            <?php echo form_open('admin/invoices/create_new_invoice', $attributes, $hidden);?>
            <?php $info_inv = client_info_invoice_terakhir(); $linv = $info_inv + 1;?>
            <div class="bg-white">
              <div class="box-block">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="tanggal_invoice"><?php echo $this->lang->line('umb_nomor_invoice');?></label>
                      <input class="form-control" placeholder="<?php echo $this->lang->line('umb_nomor_invoice');?>" name="nomor_invoice" type="text" value="INV-<?php echo '000'.$linv;?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="project"><?php echo $this->lang->line('umb_project');?></label>
                      <select class="form-control" name="project" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('umb_project');?>">
                        <?php foreach($all_projects->result() as $project) {?>
                          <option value="<?php echo $project->project_id?>"><?php echo $project->title?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="tanggal_invoice"><?php echo $this->lang->line('umb_tanggal_invoice');?></label>
                      <input class="form-control date" placeholder="<?php echo $this->lang->line('umb_tanggal_invoice');?>" readonly="readonly" name="tanggal_invoice" type="text" value="">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="tanggal_jatoh_tempo_invoice"><?php echo $this->lang->line('umb_tanggal_jatoh_tempo_invoice');?></label>
                      <input class="form-control date" placeholder="<?php echo $this->lang->line('umb_tanggal_jatoh_tempo_invoice');?>" readonly="readonly" name="tanggal_jatoh_tempo_invoice" type="text" value="">
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="hrastral-item-values">
                        <div data-repeater-list="items">
                          <div data-repeater-item="">
                            <div class="row item-row">
                              <div class="form-group mb-1 col-sm-12 col-md-3">
                                <label for="item_name"><?php echo $this->lang->line('umb_title_item');?></label>
                                <br>
                                <input type="text" class="form-control item_name" name="item_name[]" id="item_name" placeholder="Nama Item">
                              </div>
                              <div class="form-group mb-1 col-sm-12 col-md-2">
                                <label for="type_pajak"><?php echo $this->lang->line('umb_invoice_type_pajak');?></label>
                                <br>
                                <select class="form-control type_pajak" name="type_pajak[]" id="type_pajak" data-plugin="select_hrm">
                                  <!--<option pajak-type="0" pajak-rate="0" value="0"><?php echo $this->lang->line('umb_performance_none');?></option>-->
                                  <?php foreach($all_pajaks as $_pajak){?>
                                    <?php
                                    if($_pajak->type=='percentage') {
                                     $_type_pajak = $_pajak->rate.'%';
                                   } else {
                                     $_type_pajak = $this->Umb_model->currency_sign($_pajak->rate);
                                   }
                                   ?>
                                   <option pajak-type="<?php echo $_pajak->type;?>" pajak-rate="<?php echo $_pajak->rate;?>" value="<?php echo $_pajak->pajak_id;?>"> <?php echo $_pajak->name;?> (<?php echo $_type_pajak;?>)</option>
                                 <?php } ?>
                               </select>
                             </div>
                             <div class="form-group mb-1 col-sm-12 col-md-1">
                              <label for="umb_title_nilai_pajak"><?php echo $this->lang->line('umb_title_nilai_pajak');?></label>
                              <br>
                              <input type="text" readonly="readonly" class="form-control pajak-nilai-item" name="nilai_pajak_item[]" value="0" />
                            </div>
                            <div class="form-group mb-1 col-sm-12 col-md-1">
                              <label for="qty_hrs" class="cursor-pointer"><?php echo $this->lang->line('umb_title_qty_hrs');?></label>
                              <br>
                              <input type="text" class="form-control qty_hrs" name="qty_hrs[]" id="qty_hrs" value="1">
                            </div>
                            <div class="skin skin-flat form-group mb-1 col-sm-12 col-md-2">
                              <label for="unit_price"><?php echo $this->lang->line('umb_title_unit_price');?></label>
                              <br>
                              <input class="form-control unit_price" type="text" name="unit_price[]" value="0" id="unit_price" />
                            </div>
                            <div class="form-group mb-1 col-sm-12 col-md-2">
                              <label for="profession"><?php echo $this->lang->line('umb_title_sub_total');?></label>
                              <input type="text" class="form-control sub-total-item" readonly="readonly" name="sub_total_item[]" value="0" />
                              <!-- <br>-->
                              <p style="display:none" class="form-control-static"><span class="jumlah-html">0</span></p>
                            </div>
                            <div class="form-group col-sm-12 col-md-1 text-xs-center mt-2">
                              <label for="profession">&nbsp;</label>
                              <br>
                              <button type="button" class="btn icon-btn btn-xs btn-danger waves-effect waves-light remove-invoice-item" data-repeater-delete=""> <span class="fa fa-trash"></span></button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="item-list"></div>
                    <div class="form-group overflow-hidden1">
                      <div class="col-xs-12">
                        <button type="button" data-repeater-create="" class="btn btn-primary" id="add-invoice-item"> <i class="fa fa-plus"></i> <?php echo $this->lang->line('umb_title_add_item');?></button>
                      </div>
                    </div>
                    <?php
                    $ar_sc = explode('- ',$system_setting[0]->default_currency_symbol);
                    $sc_show = $ar_sc[1];
                    ?>
                    <input type="hidden" class="items-sub-total" name="items_sub_total" value="0" />
                    <input type="hidden" class="items-pajak-total" name="items_pajak_total" value="0" />
                    <div class="row">
                      <div class="col-md-7 col-sm-12 text-xs-center text-md-left">&nbsp; </div>
                      <div class="col-md-5 col-sm-12">
                        <div class="table-responsive">
                          <table class="table">
                            <tbody>
                              <tr>
                                <td><?php echo $this->lang->line('umb_title_sub_total2');?></td>
                                <td class="text-xs-right"><?php echo $sc_show;?> <span class="sub_total">0</span></td>
                              </tr>
                              <tr>
                                <td><?php echo $this->lang->line('umb_title_pajak_c');?></td>
                                <td class="text-xs-right"><?php echo $sc_show;?> <span class="pajak_total">0</span></td>
                              </tr>
                              <tr>
                                <td colspan="2" style="border-bottom:1px solid #dddddd; padding:0px !important; text-align:left"><table class="table table-bordered">
                                  <tbody>
                                    <tr>
                                      <td width="30%" style="border-bottom:1px solid #dddddd; text-align:left"><strong><?php echo $this->lang->line('umb_type_discount');?></strong></td>
                                      <td style="border-bottom:1px solid #dddddd; text-align:center"><strong><?php echo $this->lang->line('umb_discount');?></strong></td>
                                      <td style="border-bottom:1px solid #dddddd; text-align:left"><strong><?php echo $this->lang->line('umb_jumlah_discount');?></strong></td>
                                    </tr>
                                    <tr>
                                      <td><div class="form-group">
                                        <select name="type_discount" class="form-control type_discount">
                                          <option value="1"> <?php echo $this->lang->line('umb_flat');?></option>
                                          <option value="2"> <?php echo $this->lang->line('umb_percent');?></option>
                                        </select>
                                      </div></td>
                                      <td align="right"><div class="form-group">
                                        <input style="text-align:right" type="text" name="angka_discount" class="form-control angka_discount" value="0" data-valid-num="required">
                                      </div></td>
                                      <td align="right"><div class="form-group">
                                        <input type="text" style="text-align:right" readonly="" name="jumlah_discount" value="0" class="jumlah_discount form-control">
                                      </div></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                              </tr>
                              <input type="hidden" class="fgrand_total" name="fgrand_total" value="0" />
                              <tr>
                                <td><?php echo $this->lang->line('umb_grand_total');?></td>
                                <td class="text-xs-right"><?php echo $sc_show;?> <span class="grand_total">0</span></td>
                              </tr>
                            </tbody>
                            
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="form-group col-xs-12 mb-2 file-repeaters"> </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <label for="catatan_invoice"><?php echo $this->lang->line('umb_catatan_invoice');?></label>
                        <textarea name="catatan_invoice" class="form-control"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="invoice-footer">
                <div class="row">
                  <div class="col-md-7 col-sm-12">
                    <h6>Terms &amp; Condition</h6> 
                    <p><?php echo $system_setting[0]->invoice_terms_condition;?></p>
                  </div>
                  <div class="col-md-5 col-sm-12 text-xs-center">
                    <button type="submit" name="invoice_submit" class="btn btn-primary pull-right my-1" style="margin-right: 5px;"><i class="fas fa-check-square"></i> <?php echo $this->lang->line('umb_submit_invoice');?></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php echo form_close(); ?> </div>
        </div>
      </div>
    </div>
  </div>
</div>
