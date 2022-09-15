
<link rel="stylesheet" href="<?php echo YOURUN_URL. '/public/css/bootstrap-datepicker.min.css' ; ?>" />
<link rel="stylesheet" href="<?php echo YOURUN_URL. '/public/css/font-awesome.min.css' ; ?>" />



<style>
    .input-group-append {
  cursor: pointer;
}

</style>
<?php


global $wpdb ;

$check_user = $wpdb->get_results( 
    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}users WHERE ID =%s", array(get_current_user_id())) 
 );
 
//  deb($check_user[0]->user_email);
 $select_kariah = get_user_meta( get_current_user_id(), 'select_kariah', true ) ;
 $get_select_kariah = $wpdb->get_results( 
    $wpdb->prepare("SELECT post_title FROM {$wpdb->prefix}posts WHERE ID =%s", array($select_kariah)) 
 );
  $select_kariah_name = $get_select_kariah[0]->post_title ;
  $email_ahli = $check_user[0]->user_email ;
  $nama_ahli = get_user_meta( get_current_user_id(), 'nama_ahli', true ) ;
  $kad_pengenalan_ahli = get_user_meta( get_current_user_id(), 'kad_pengenalan_ahli', true ) ;
  $tel_ahli = get_user_meta( get_current_user_id(), 'tel_ahli', true ) ;
  $alamat_ahli = get_user_meta( get_current_user_id(), 'alamat_ahli', true ) ;
  $no_ahli = get_current_user_id() ;
  $type_reg = get_user_meta( get_current_user_id(), 'wp_capabilities', true ) ;
  $status_ahli = get_user_meta( get_current_user_id(), 'stage_daftar', true ) ;
  $tarikh_daftar = date("d/m/y", strtotime($check_user[0]->user_registered));  
  $catatan_ahli =  get_user_meta( get_current_user_id(), 'catatan_ahli', true ) ;

        // deb($check_user[0]->user_registered);
        
if(isset($_POST['action']) && $_POST['action'] === 'save_maklumat_ahli' ){
  deb($_POST);exit();
   
  update_user_meta(get_current_user_id(), 'nama_ahli', $_POST['nama_ahli']) ; 
  update_user_meta(get_current_user_id(), 'kad_pengenalan_ahli', $_POST['kad_pengenalan_ahli']) ; 
  update_user_meta(get_current_user_id(), 'email_ahli', $_POST['email_ahli']) ; 
  update_user_meta(get_current_user_id(), 'tel_ahli', $_POST['tel_ahli']) ; 
  update_user_meta(get_current_user_id(), 'alamat_ahli', $_POST['alamat_ahli']) ; 
  update_user_meta(get_current_user_id(), 'select_kariah_name', $_POST['select_kariah_name']) ; 
  update_user_meta(get_current_user_id(), 'select_kariah', $_POST['select_kariah']) ; 
  update_user_meta(get_current_user_id(), 'no_ahli', $_POST['no_ahli']) ; 
  update_user_meta(get_current_user_id(), 'type_reg', $_POST['type_reg']) ; 
  update_user_meta(get_current_user_id(), 'status_ahli', $_POST['status_ahli']) ; 
  update_user_meta(get_current_user_id(), 'catatan_ahli', $_POST['catatan_ahli']) ; 


}




?>

<div class="container">
  <div class="row">
    <div class="col bg-info p-3">
      
    Akaun ahli mempunyai 3 bahagian iaitu ;
    <br>
1. Maklumat Ahli <br>
2. Maklumat Tanggungan <br>
3. Muatnaik Dokumen <br>

    </div>
   
  </div>
</div>

<div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button
        class="accordion-button"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#collapseOne"
        aria-expanded="true"
        aria-controls="collapseOne"
      >
        Maklumat Ahli :
        <?php echo $nama_ahli ; ?>
      </button>
    </h2>
    <div
      id="collapseOne"
      class="accordion-collapse collapse"
      aria-labelledby="headingOne"
      data-bs-parent="#accordionExample"
    >
      <div class="accordion-body">
        <form class="" action="" method="post">
          <div class="container">
            <div class="row">
              <div class="col">
                <label>Nama Penuh</label>
                <input
                  placeholder="Nama Penuh"
                  type="text"
                  class="woocommerce-Input woocommerce-Input--text input-text"
                  name="nama_ahli"
                  id="nama_ahli"
                  value="<?php echo isset($nama_ahli) ? $nama_ahli : $_POST['nama_ahli'] ; ?>"
                  required
                />
              </div>
              <div class="col">
                <label>No Kad Pengenalan</label>
                <input
                  placeholder=""
                  type="number"
                  class="woocommerce-Input woocommerce-Input--text input-text"
                  name="kad_pengenalan_ahli"
                  id="kad_pengenalan_ahli"
                  value="<?php echo isset($kad_pengenalan_ahli) ? $kad_pengenalan_ahli : $_POST['kad_pengenalan_ahli'] ; ?>"
                  required
                />
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col">
                <label>Emel</label>
                <input
                  readonly
                  placeholder="Email"
                  type="email"
                  class="woocommerce-Input woocommerce-Input--text input-text"
                  name="email_ahli"
                  id="email_ahli"
                  value="<?php echo isset($email_ahli) ? $email_ahli : $_POST['email_ahli'] ; ?>"
                  required
                />
              </div>

              <div class="col">
                <label>Telefon</label>
                <input
                  placeholder="No. Tel"
                  type="number"
                  class="woocommerce-Input woocommerce-Input--text input-text"
                  name="tel_ahli"
                  id="tel_ahli"
                  value="<?php echo isset($tel_ahli) ? $tel_ahli : $_POST['tel_ahli'] ; ?>"
                  required
                />
              </div>
            </div>
            <br />

            <div class="row">
              <div class="col">
                <label>Alamat</label>
                <textarea
                  placeholder="Alamat"
                  class="form-control woocommerce-Input"
                  id="alamat_ahli"
                  name="alamat_ahli"
                  rows="4"
                  cols="50"
                  required
                ><?php echo isset($alamat_ahli) ? $alamat_ahli : $_POST['alamat_ahli'] ; ?></textarea
                >
              </div>

              <div class="col">
                <label>Kariah</label>
                <input
                  readonly
                  type="text"
                  class="woocommerce-Input woocommerce-Input--text input-text"
                  name="select_kariah_name"
                  id="select_kariah_name"
                  value="<?php echo isset($select_kariah_name) ? $select_kariah_name : $_POST['select_kariah_name'] ; ?>"
                />
                <input
                  style="display: none"
                  type="text"
                  class="woocommerce-Input woocommerce-Input--text input-text"
                  name="select_kariah"
                  id="select_kariah"
                  value="<?php echo isset($select_kariah) ? $select_kariah : $_POST['select_kariah'] ; ?>"
                />
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col">
                <label>No Ahli</label>
                <input
                  placeholder=""
                  type="text"
                  class="woocommerce-Input woocommerce-Input--text input-text"
                  name="no_ahli"
                  id="no_ahli"
                  value="<?php echo isset($no_ahli) ? $no_ahli : $_POST['no_ahli'] ; ?>"
                  required
                />
              </div>

              <div class="col">
                <label>Jenis Ahli</label>
                <select
                  name="type_reg"
                  id="type_reg"
                  class="form-control woocommerce-Input woocommerce-Input--select input-select"
                  required
                >
                  <option <?php echo array_key_exists('pentadbir', $type_reg) ? "selected" : "" ; ?> value="pentadbir">Pentadbir</option>
                  <option <?php echo array_key_exists('ahli', $type_reg) ? "selected" : "" ; ?> value="ahli">Ahli</option>
                  <option <?php echo array_key_exists('asnaf', $type_reg) ? "selected" : "" ; ?> value="asnaf">Asnaf</option>
                </select>
              </div>
            </div>

            <br />
            <div class="row">
              <div class="col">
                <label>Status Ahli</label>
                <select
                  name="status_ahli"
                  id="status_ahli"
                  class="form-control woocommerce-Input woocommerce-Input--select input-select"
                  required
                >
                  <option value="1" <?php echo  $status_ahli == '1' ? "selected" : "" ; ?>>Aktif</option>
                  <option value="2" <?php echo  $status_ahli == '2' ? "selected" : "" ; ?> >Tidak Aktif</option>
                </select>
              </div>

              <div class="col">
                <label>Tarikh Daftar</label>
                <div class="input-group date">
                  <input readonly type="text" class="" name="tarikh_daftar" id="tarikh_daftar"  value="<?php echo $tarikh_daftar ; ?>"/>
                  <span class="input-group-append">
                    <span class="input-group-text bg-light d-block">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="25"
                        height="auto"
                        fill="currentColor"
                        class="bi bi-calendar-event-fill"
                        viewBox="0 0 16 16"
                      >
                        <path
                          d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"
                        />
                      </svg>
                    </span>
                  </span>
                </div>
              </div>
            </div>

            <br />
            <div class="row">
              <div class="col">
                <label>Catatan</label>
                <textarea
                  placeholder="Catatan"
                  class="form-control woocommerce-Input"
                  id="catatan_ahli"
                  name="catatan_ahli"
                  rows="4"
                  cols="50"
                  required
                ><?php echo isset($catatan_ahli) ? $catatan_ahli : $_POST['catatan_ahli'] ; ?></textarea
                >
              </div>
            </div>
            <br />
            <div class="row">
              <div class="col">
                <button
                  type="submit"
                  class="woocommerce-Button button"
                  name="save_change"
                  value="Save changes"
                >
                  Save changes
                </button>
                <input type="hidden" name="action" value="save_maklumat_ahli" />
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button
        class="accordion-button collapsed"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#collapseTwo"
        aria-expanded="false"
        aria-controls="collapseTwo"
      >
        Maklumat Tanggungan
      </button>
    </h2>
    <div
      id="collapseTwo"
      class="accordion-collapse collapse"
      aria-labelledby="headingTwo"
      data-bs-parent="#accordionExample"
    >
      <div class="accordion-body">


          <form class="" action="" method="post">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <label>Nama Tanggungan</label>
                        <input placeholder="Nama Tanggungan" type="text"
                            class="woocommerce-Input woocommerce-Input--text input-text" name="nama_tanggungan_ahli"
                            id="nama_tanggungan_ahli"
                            value="<?php echo isset($nama_tanggungan_ahli) ? $nama_tanggungan_ahli : $_POST['nama_tanggungan_ahli'] ; ?>"
                            required />
                    </div>
                    <div class="col">
                        <label>No. KP</label>
                        <input placeholder="" type="number" class="woocommerce-Input woocommerce-Input--text input-text"
                            name="no_kp_tanggungan_ahli" id="no_kp_tanggungan_ahli"
                            value="<?php echo isset($no_kp_tanggungan_ahli) ? $no_kp_tanggungan_ahli : $_POST['no_kp_tanggungan_ahli'] ; ?>"
                            required />
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <label>Pertalian Keluarga</label>
                        <select name="pertalian_keluarga_ahli" id="pertalian_keluarga_ahli"
                            class="form-control woocommerce-Input woocommerce-Input--select input-select" required>
                            <option value="pasangan">Pasangan</option>
                            <option selected value="anak">Anak</option>
                            <option selected value="ibu_bapa">Ibu/Bapa</option>
                            <option selected value="datuk_nenek">Datuk/Nenek</option>
                            <option selected value="lain_lain">Lain-lain</option>

                        </select>
                    </div>
                    <div class="col">
                        <label>No. Telefon</label>
                        <input placeholder="No. Tel" type="number" class="woocommerce-Input woocommerce-Input--text input-text"
                            name="tel_tanggungan_ahli" id="tel_tanggungan_ahli"
                            value="<?php echo isset($tel_tanggungan_ahli) ? $tel_tanggungan_ahli : $_POST['tel_tanggungan_ahli'] ; ?>"
                            required />

                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="woocommerce-Button button" name="save_change" value="Tambah">
                            Tambah
                        </button>
                        <input type="hidden" name="action" value="save_maklumat_tanggungan_ahli" />
                    </div>
                </div>
                <br>
                <div class="row">

                    <div class="col">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Pertalian</th>
                                    <th scope="col">No.KP</th>
                                    <th scope="col">Telefon</th>
                                     <th scope="col">Umur</th>
                                      <th scope="col">Yuran (Bulanan)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                     <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                     <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Larry the Bird</td>
                                    <td>@twitter</td>
                                     <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>


              </div>
          </form>


      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button
        class="accordion-button collapsed"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#collapseThree"
        aria-expanded="false"
        aria-controls="collapseThree"
      >
        Muatnaik Dokumen
      </button>
    </h2>
    <div
      id="collapseThree"
      class="accordion-collapse collapse"
      aria-labelledby="headingThree"
      data-bs-parent="#accordionExample"
    >
      <div class="accordion-body">
       
        <form class="" action="" method="post" enctype="multipart/form-data">
            <div class="container">
                <div class="row">
                    <div class="col">

 <label>Tajuk Dokumen</label>
                        <input placeholder="Tajuk Dokumen" type="text"
                            class="woocommerce-Input woocommerce-Input--text input-text" name="tajuk_document"
                            id="tajuk_document"
                            value="<?php echo isset($tajuk_document) ? $tajuk_document : $_POST['tajuk_document'] ; ?>"
                            required />


                    </div>
                     <div class="col">

 <label>Jenis Dokumen <span class="text-danger">(JPG, PNG, GIF, PDF)</span></label>
                        <input placeholder="Jenis Documen" type="file"
                            class="woocommerce-Input woocommerce-Input--text input-text" name="jenis_documen"
                            id="nama_tanggungan_ahli"
                            value="<?php echo isset($jenis_documen) ? $jenis_documen : $_POST['jenis_documen'] ; ?>"
                            required />


                    </div>
                </div>
                 <br>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="woocommerce-Button button" name="save_change" value="Tambah">
                            Tambah
                        </button>
                        <input type="hidden" name="action" value="save_muatnaik_documen" />
                    </div>
                </div>
                <br>
                 <div class="row">
                    <div class="col">
                      
                    <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tajuk Dokumen</th>
                                    <th scope="col">Tarikh Muatnaik</th>
                                    <th scope="col">Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                   
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                   
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Larry the Bird</td>
                                    <td>@twitter</td>
                                     <td>Mark</td>
                                  
                                </tr>
                            </tbody>
                        </table>

                    
                    </div>
                </div>

            </div>
        </form>


      </div>
    </div>
  </div>
</div>



<script src="<?php echo YOURUN_URL. '/public/js/jquery.min.js' ; ?>"></script>
<script src="<?php echo YOURUN_URL. '/public/js/bootstrap-datepicker.min.js' ; ?>"></script>


<script>

    $(function(){
        // $('#tarikh_daftar').datepicker({ format: 'dd/mm/yy' });
});
</script>