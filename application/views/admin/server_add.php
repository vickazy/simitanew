 
 <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Admin
        <small>Add Server</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Admin</a></li>
        <li class="active">Add Server</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
         

          <!-- Form Element sizes -->
          <div class="box box-success">
		   <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>admin/action_server_add" enctype="multipart/form-data">
				
            <div class="box-header with-border">
              <h3 class="box-title">Add Server</h3>
            </div>
            <div class="box-body">
						<div class="col-lg-10">
                            <div class="form-group">
                                <label for="id_merek" class="col-sm-3 control-label">Merk Server</label>
                                <div class="col-sm-5">
								 <select class="form-control select2" name="id_merek" style="width: 100%;">
									
											<option selected="selected"> -- Pilih Merek -- </option>
													<?php foreach ($list_merek_server->result_array() as $data) { ?>
													<option value="<?php echo $data['id_merek']; ?>"><?php echo $data['merek']; ?></option>
													<?php 
													}
													?>
									</select>  </div>
                            </div>
                        </div>
						<br><br><br>
						<div class="col-lg-10">
                            <div class="form-group">
                                <label for="keterangan" class="col-sm-3 control-label">Keterangan</label>
                                <div class="col-sm-5">
								 <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Input Keterangan.." required/>
                                </div>
                            </div>
                        </div>
						<br><br><br>
						<div class="col-lg-10">
                            <div class="form-group">
                   
                                <label for="ip_address" class="col-sm-3 control-label">IP Address</label>
                                <div class="col-sm-5">
								 <div class="input-group">
									  <div class="input-group-addon">
										<i class="fa fa-laptop"></i>
									  </div>
									  <input type="text" id="ip_address" name="ip_address" class="form-control" data-inputmask="'alias': 'ip'" data-mask>
									</div>
							</div>
                            </div>
												
                        </div>
						<br><br><br>
						<div class="col-lg-10">
                            <div class="form-group">
                                <label for="username" class="col-sm-3 control-label">Username</label>
                                <div class="col-sm-5">
								 <input type="text" class="form-control" id="username" name="username" placeholder="Input Username.."/>
                                </div>
                            </div>
                        </div>
						<br><br><br>
						<div class="col-lg-10">
                            <div class="form-group">
                                <label for="password" class="col-sm-3 control-label">Password</label>
                                <div class="col-sm-5">
								 <input type="text" class="form-control" id="password" name="password" placeholder="Input Password.."/>
                                </div>
                            </div>
                        </div>
						<br><br><br>
						<div class="col-lg-10">
                            <div class="form-group">
                                <label for="nama_pengguna" class="col-sm-3 control-label">Pengguna</label>
                                <div class="col-sm-5">
								 <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" placeholder="Input Nama Pengguna.." required/>
                                </div>
                            </div>
                        </div>
						<br><br><br>
						<div class="col-lg-10">
                                <div class="form-group">
                                    <label for="kantor_induk" class="col-sm-3 control-label">Kantor Induk</label>
                                    <div class="col-sm-5">
                                        <select class="form-control select2" id="kantor_induk" name="kantor_induk" style="width: 100%;">
                                            <option selected="selected" value=""> -- Pilih Kantor Induk -- </option>
                                            <?php
                                            foreach ($hasil as $value) {
                                                echo "<option value='$value->id_kantor_induk'>$value->nama_kantor_induk</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <label for="unit_level2" class="col-sm-3 control-label">Unit Level 2</label>
                                    <div class="col-sm-5">
                                        <select class="form-control select2" name="unit_level2" id="unit_level2" style="width: 100%;" >
                                            <option selected="selected" value=""> -- Pilih Unit Level 2 -- </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <label for="unit_level3" class="col-sm-3 control-label">Unit Level 3</label>
                                    <div class="col-sm-5">
                                        <select class="form-control select2" name="unit_level3" id="unit_level3" style="width: 100%;">
                                            <option selected="selected" value=""> -- Pilih Unit Level 3 -- </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
						<br><br><br>
						<div class="col-lg-10">
                            <div class="form-group">
                                <label for="tahun" class="col-sm-3 control-label">Tahun</label>
                                <div class="col-sm-5">
								  <select class="form-control select2" name="tahun" id="tahun" style="width: 100%;">
									
											<option selected="selected"> -- Pilih Tahun -- </option>
													<option value="2010">2010</option>
													<option value="2011">2011</option>
													<option value="2012">2012</option>
													<option value="2013">2013</option>
													<option value="2014">2014</option>
													<option value="2015">2015</option>
													<option value="2016">2016</option>
													<option value="2017">2017</option>
													<option value="2018">2018</option>
													<option value="2019">2019</option>
													<option value="2020">2020</option>
													
									</select> </div>
                            </div>
                        </div>
						<br><br><br>
						
						
						
            </div>
            <!-- /.box-body -->
			<div class="box-footer">
                        <div class="pull-center">
						
                            <a href="<?php echo base_url(); ?>admin/server_view" class="btn btn-danger">Kembali</a>
                            <button type="reset" class="btn btn-warning">Ulangi</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
					 </form>
          </div>
          <!-- /.box -->
					
        </div>
        
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->