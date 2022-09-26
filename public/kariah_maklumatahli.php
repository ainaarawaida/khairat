
<link rel="stylesheet" href="<?php echo YOURUN_URL. '/public/css/bootstrap-datepicker.min.css' ; ?>" />
<link rel="stylesheet" href="<?php echo YOURUN_URL. '/public/css/font-awesome.min.css' ; ?>" />



<style>
    .input-group-append {
      cursor: pointer;


    }

    
  .form-control[readonly=""] {
    background-color: #e9ecef;
    opacity: 1;
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
  
$alert = false ; 
$error_alert = false ;  
$type_reg = get_user_meta( get_current_user_id(), 'wp_capabilities', true ) ;
$type_reg = array_keys($type_reg)[0] ;
$status_ahli = get_user_meta( get_current_user_id(), 'stage_daftar', true ) ;
$tarikh_daftar = date("d/m/y", strtotime($check_user[0]->user_registered));  

if(isset($_POST['action']) && $_POST['action'] === 'save_maklumat_ahli' ){
 
   
  $_POST['nama_ahli'] ? (update_user_meta(get_current_user_id(), 'nama_ahli', $_POST['nama_ahli'])) : '' ; 
  $_POST['kad_pengenalan_ahli'] ? update_user_meta(get_current_user_id(), 'kad_pengenalan_ahli', $_POST['kad_pengenalan_ahli']) : '' ; 
  $_POST['email_ahli'] ? update_user_meta(get_current_user_id(), 'email_ahli', $_POST['email_ahli']): '' ; 
  $_POST['tel_ahli'] ? update_user_meta(get_current_user_id(), 'tel_ahli', $_POST['tel_ahli']): '' ; 
  $_POST['alamat_ahli'] ? update_user_meta(get_current_user_id(), 'alamat_ahli', $_POST['alamat_ahli']): '' ; 
  $_POST['select_kariah_name'] ? update_user_meta(get_current_user_id(), 'select_kariah_name', $_POST['select_kariah_name']): '' ; 
  $_POST['select_kariah'] ? update_user_meta(get_current_user_id(), 'select_kariah', $_POST['select_kariah']): '' ; 
  $_POST['no_ahli'] ? update_user_meta(get_current_user_id(), 'no_ahli', $_POST['no_ahli']): '' ; 
  $_POST['type_reg'] ? (update_user_meta(get_current_user_id(), 'wp_capabilities', array($_POST['type_reg'] => 1))) : '' ; 
  $_POST['status_ahli'] ? update_user_meta(get_current_user_id(), 'status_ahli', $_POST['status_ahli']): '' ; 
  $_POST['catatan_ahli'] ? update_user_meta(get_current_user_id(), 'catatan_ahli', $_POST['catatan_ahli']): '' ; 

  $alert = "Maklumat Ahli" ; 
}else{

  $select_kariah_name = $get_select_kariah[0]->post_title ;
  $email_ahli = $check_user[0]->user_email ;
  $nama_ahli = get_user_meta( get_current_user_id(), 'nama_ahli', true ) ;
  $kad_pengenalan_ahli = get_user_meta( get_current_user_id(), 'kad_pengenalan_ahli', true ) ;
  $tel_ahli = get_user_meta( get_current_user_id(), 'tel_ahli', true ) ;
  $alamat_ahli = get_user_meta( get_current_user_id(), 'alamat_ahli', true ) ;
  $no_ahli = get_current_user_id() ;
  
 
  $catatan_ahli =  get_user_meta( get_current_user_id(), 'catatan_ahli', true ) ;

}


if(isset($_POST['action']) && $_POST['action'] === 'save_maklumat_tanggungan_ahli' ){

  $maklumattungganganahli = unserialize(base64_decode($_POST['maklumattungganganahli']));

  
  if($maklumattungganganahli == ''){
    $_POST['jumlah_tanggungan_ahli'] =  1 ; 
  }else if(count($maklumattungganganahli) > 0){
    $_POST['jumlah_tanggungan_ahli'] = count($maklumattungganganahli) + 1 ; 
  }else{
    $_POST['jumlah_tanggungan_ahli'] = 1 ;
  }
  
  $maklumattungganganahli[$_POST['jumlah_tanggungan_ahli']]['nama_tanggungan_ahli'] = $_POST['nama_tanggungan_ahli'] ;
  $maklumattungganganahli[$_POST['jumlah_tanggungan_ahli']]['no_kp_tanggungan_ahli'] = $_POST['no_kp_tanggungan_ahli'] ;
  $maklumattungganganahli[$_POST['jumlah_tanggungan_ahli']]['pertalian_keluarga_ahli'] = $_POST['pertalian_keluarga_ahli'] ;
  $maklumattungganganahli[$_POST['jumlah_tanggungan_ahli']]['tel_tanggungan_ahli'] = $_POST['tel_tanggungan_ahli'] ;

  update_user_meta(get_current_user_id(), 'maklumattungganganahli', $maklumattungganganahli) ; 
  // deb($maklumattungganganahli);exit();

}else{
  $jumlah_tanggungan_ahli = get_user_meta( get_current_user_id(), 'jumlah_tanggungan_ahli', true ) ;
  $maklumattungganganahli = get_user_meta( get_current_user_id(), 'maklumattungganganahli', true ) ;

  if($maklumattungganganahli == ''){
    $maklumattungganganahli = array();
  }
  

}


if(isset($_POST['action']) && $_POST['action'] === 'del_maklumat_tanggungan_ahli' ){
  $maklumattungganganahli = unserialize(base64_decode($_POST['maklumattungganganahli']));

  $maklumattungganganahli = array_filter($maklumattungganganahli, function($var, $key)
  {
    
    if (!array_key_exists($key, $_POST['del_tanggungan'])){
      return($var);
    }
   
  }, ARRAY_FILTER_USE_BOTH ) ;


  update_user_meta(get_current_user_id(), 'maklumattungganganahli', $maklumattungganganahli) ; 
  


}

if(isset($_POST['action']) && $_POST['action'] === 'save_muatnaik_documen' ){
  $alert = false ;  
  $dokumenahli = unserialize(base64_decode($_POST['dokumenahli']));
 
  if($dokumenahli == ''){
    $_POST['jumlahdokumenahli'] = 1 ; 
  }else if(count($dokumenahli) > 0){
    $_POST['jumlahdokumenahli'] = count($dokumenahli) + 1 ; 
  }else{
    $_POST['jumlahdokumenahli'] = 1 ;
  }


  if ( ! function_exists( 'wp_handle_upload' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
  }


  $uploadedfile = $_FILES['jenis_documen'];
  $upload_overrides = array(
    'test_form' => false
  );

  // Allowed image types
  $allowed_image_types = array('image/jpeg','image/png');

  // Maximum size in bytes
  $max_image_size = 1000 * 1000; // 1 MB (approx)

  if(in_array($uploadedfile['type'], $allowed_image_types)
            && $uploadedfile['size'] <= $max_image_size){

    $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

    if ( $movefile && ! isset( $movefile['error'] ) ) {
        $alert = 'File is valid, and was successfully uploaded.' ;  
        
    } else {
      $error_alert = $movefile['error'] ;
    }
  
    $dokumenahli[$_POST['jumlahdokumenahli']]['tajuk_document'] = $_POST['tajuk_document'] ;
    $dokumenahli[$_POST['jumlahdokumenahli']]['jenis_documen'] = $movefile ;
  
    update_user_meta(get_current_user_id(), 'dokumenahli', $dokumenahli) ; 

  }else{

    $error_alert = 'File is Not Valid' ;  
    
    
  }


}else{
  $dokumenahli = get_user_meta( get_current_user_id(), 'dokumenahli', true ) ;

  if($dokumenahli == ''){
    $dokumenahli = array();
  }
  


  // deb($dokumenahli);exit();
}


if(isset($_POST['action']) && $_POST['action'] === 'del_maklumat_dokumenahli' ){
  $dokumenahli = unserialize(base64_decode($_POST['dokumenahli']));

  $dokumenahli = array_filter($dokumenahli, function($var, $key)
  {
    
    if (!array_key_exists($key, $_POST['del_dokumenahli'])){
      

      return($var);
    }else{
      unlink( $var['jenis_documen']['file'] );
    }
   
  }, ARRAY_FILTER_USE_BOTH ) ;



  update_user_meta(get_current_user_id(), 'dokumenahli', $dokumenahli) ; 
  $alert = "File Berjaya Dipadam" ;


}








?>

<div class="container">

<?php if ($alert !== false) { ?>
<div class="row">
  <div class="col">

  <div class="alert alert-primary" role="alert">
  Berjaya Kemaskini <?php echo $alert ; ?>
</div>

  </div>
</div>
<br>
<?php } ?>

<?php if ($error_alert !== false) { ?>
<div class="row">
  <div class="col">

  <div class="alert alert-danger" role="alert">
  <?php echo $error_alert ; ?>
</div>

  </div>
</div>
<br>
<?php } ?>


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
                <input readonly
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
                <input readonly
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
                <select disabled
                  name="type_reg"
                  id="type_reg"
                  class="form-control woocommerce-Input woocommerce-Input--select input-select"
                  required
                >
                  <option <?php echo isset($type_reg) && $type_reg == "pentadbir" ? "selected" : "" ; ?> value="pentadbir">Pentadbir</option>
                  <option <?php echo isset($type_reg) && $type_reg == "ahli" ? "selected" : "" ; ?> value="ahli">Ahli</option>
                  <option <?php echo isset($type_reg) && $type_reg == "asnaf"  ? "selected" : "" ; ?> value="asnaf">Asnaf</option>
                </select>
              </div>
            </div>

            <br />
            <div class="row">
              <div class="col">
                <label>Status Ahli</label>
                <select disabled
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
                  <input readonly type="text" class="form-control" name="tarikh_daftar" id="tarikh_daftar"  value="<?php echo $tarikh_daftar ; ?>"/>
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


          
            <div class="container">
              <form class="" action="" method="post">
                  <div class="row">
                      <div class="col">
                          <label>Nama Tanggungan</label>
                          <input placeholder="Nama Tanggungan" type="text"
                              class="woocommerce-Input woocommerce-Input--text input-text" name="nama_tanggungan_ahli"
                              id="nama_tanggungan_ahli"
                              value=""
                              required />

                              <input placeholder="Jumlah Tanggungan" type="hidden"
                              class="woocommerce-Input woocommerce-Input--text input-text" name="jumlah_tanggungan_ahli"
                              id="jumlah_tanggungan_ahli"
                              value=""
                              />
                      </div>
                      <div class="col">
                          <label>No. KP</label>
                          <input placeholder="" type="number" class="woocommerce-Input woocommerce-Input--text input-text"
                              name="no_kp_tanggungan_ahli" id="no_kp_tanggungan_ahli"
                              value=""
                              min="100000000000"
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
                              <option value="anak">Anak</option>
                              <option value="ibu_bapa">Ibu/Bapa</option>
                              <option value="datuk_nenek">Datuk/Nenek</option>
                              <option value="lain_lain">Lain-lain</option>

                          </select>
                      </div>
                      <div class="col">
                          <label>No. Telefon</label>
                          <input placeholder="No. Tel" type="number" class="woocommerce-Input woocommerce-Input--text input-text"
                              name="tel_tanggungan_ahli" id="tel_tanggungan_ahli"
                              value=""
                              required />

                              <input type="hidden" class="" 
                              name="maklumattungganganahli" id="maklumattungganganahli"
                              value="<?php echo isset($maklumattungganganahli) ? base64_encode(serialize($maklumattungganganahli)) : "" ; ?>"
                              />


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
                </form>
                <br>

                <form class="" action="" method="post">

                  <div class="row">

                      <div class="col">
                      <div class="table-responsive">
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

                              <input type="hidden" class="" 
                              name="maklumattungganganahli" 
                              value="<?php echo isset($maklumattungganganahli) ? base64_encode(serialize($maklumattungganganahli)) : "" ; ?>"
                              />

                                
                                  <?php foreach ($maklumattungganganahli AS $key => $val){ ?> 
                                    <tr>
                                        <th scope="row"><input type="checkbox" name="del_tanggungan[<?php echo $key ; ?>]" id="del_tanggungan[<?php echo $key ; ?>]">  <?php echo $key ; ?></th>
                                        <td><?php echo $val['nama_tanggungan_ahli'] ; ?></td>
                                        <td><?php echo $val['pertalian_keluarga_ahli'] ; ?></td>
                                        <td><?php echo $val['no_kp_tanggungan_ahli'] ; ?></td>
                                        <td><?php echo $val['tel_tanggungan_ahli'] ; ?></td>
                                        <td><?php echo semakumur($val['no_kp_tanggungan_ahli'], 0 ) ; ?></td>
                                        <td><?php echo "" ; ?></td>
                                    </tr>
                                  <?php } ?>

                                

                                
                              </tbody>
                          </table>
                          </div>  <!-- table responsive -->
                      </div>
                  </div>
                  <div class="row">
                    <div class="col">
                         <button type="submit" class="woocommerce-Button button" name="save_change" value="Padam">
                              Padam
                          </button>
                          <input type="hidden" name="action" value="del_maklumat_tanggungan_ahli" />
                    </div>
                  </div>
                </form>

              </div>
         

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
       
       
            <div class="container">

              <form class="" action="" method="post" enctype="multipart/form-data">
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

                                        <input type="hidden" class="" 
                              name="dokumenahli" id="dokumenahli"
                              value="<?php echo isset($dokumenahli) ? base64_encode(serialize($dokumenahli)) : "" ; ?>"
                              />


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

                </form>
                <br>
                <form class="" action="" method="post">
                <div class="row">
                    <div class="col">
                      <div class="table-responsive">
                      <table class="table table-hover table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tajuk Dokumen</th>
                                    <th scope="col">Tarikh Muatnaik</th>
                                    <th scope="col">Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>

                            <input type="hidden" class="" 
                              name="dokumenahli" id="dokumenahli"
                              value="<?php echo isset($dokumenahli) ? base64_encode(serialize($dokumenahli)) : "" ; ?>"
                              />


                              <?php foreach($dokumenahli AS $key => $val){ ?>
                                <tr>
                                <th scope="row"><input type="checkbox" name="del_dokumenahli[<?php echo $key ; ?>]" id="del_dokumenahli[<?php echo $key ; ?>]">  <?php echo $key ; ?></th>
                                        <td><?php echo $val['tajuk_document'] ; ?></td>
                                        <td><?php echo $val['jenis_documen'] ; ?></td>
                                        <td><?php echo "" ; ?></td>
                                       
                                   
                                </tr>
                              <?php } ?>
                               
                            </tbody>
                        </table>
                        </div>  <!-- table responsive -->
                    
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                         <button type="submit" class="woocommerce-Button button" name="save_change" value="Padam">
                              Padam
                          </button>
                          <input type="hidden" name="action" value="del_maklumat_dokumenahli" />
                    </div>
                  </div>
                </form>
            </div>
       


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


<?php


function semakumur($ic_no,$errors){
	// substring IC No to get bday
  if(strlen($ic_no) != 12){
    return 0 ; 
  }
	$date = substr($ic_no, 0, 6);

	// use built-in DateTime object to work with dates
	$date = \DateTime::createFromFormat('ymd', $date);
	$now  = new \DateTime();

	// compare birth date with current date: 
	// if it's bigger bd was in previous century
	if ($date > $now) {
		$date->modify('-100 years');
	}
	//your birthday date
	$bday_date = $date;
	
	$date = new DateTime();
	$interval = $date->diff($bday_date);
	
	//your birthday date
	$bday_date = $bday_date->format('Y-m-d');
	//your current age
	$age = $interval->y;
	return $age ; 
	
	
		
	
}


?>