
<link rel="stylesheet" href="<?php echo YOURUN_URL. '/public/css/bootstrap-datepicker.min.css' ; ?>" />
<link rel="stylesheet" href="<?php echo YOURUN_URL. '/public/css/font-awesome.min.css' ; ?>" /><?php

global $wpdb ;

 $check_author_site_name = $wpdb->get_results( 
    $wpdb->prepare("SELECT ID,post_name,post_title FROM {$wpdb->prefix}posts WHERE post_type =%s AND post_author = %d", array('yourun_page_name', get_current_user_id())) 
 );
 $select_kariah = $check_author_site_name[0]->ID ;
 $select_kariah_name = $check_author_site_name[0]->post_title ;
 $alert = false ; 
 $error = false ;
 $errorpass = false ; 
 $erroric = false ; 
if(isset($_POST['action']) && $_POST['action'] === 'save_pendaftaran_ahli' ){

    if($_POST['password'] !== $_POST['password_temp']){
        $error = "Kata Laluan anda tidak seragam. Sila pastikan pengulangan kata laluan adalah sama" ; 
        $errorpass = true ; 
    }

   
    if($error === false){
        $chec_create = wp_create_user( $_POST['kad_pengenalan_ahli'], $_POST['password'], $_POST['email_ahli'] );
       
        if($chec_create->errors['existing_user_login']){
            $error = "Kad Pengenalan ahli ini telah berdaftar" ; 
            $erroric = true ; 
        }else if($chec_create->errors['existing_user_email']){
            $error = "Email ini telah berdaftar" ; 
            $erroric = true ; 
        }else{
           
            update_user_meta($chec_create, 'select_kariah_name', $_POST['select_kariah_name']) ; 
            update_user_meta($chec_create, 'select_kariah', $_POST['select_kariah']) ; 
            update_user_meta($chec_create, 'nama_ahli', $_POST['nama_ahli']) ; 
            update_user_meta($chec_create, 'first_name', $_POST['nama_ahli']) ; 
            
            update_user_meta($chec_create, 'kad_pengenalan_ahli', $_POST['kad_pengenalan_ahli']) ; 
            update_user_meta($chec_create, 'tel_ahli', $_POST['tel_ahli']) ; 
            update_user_meta($chec_create, 'email_ahli', $_POST['email_ahli']) ; 
            update_user_meta($chec_create, 'alamat_ahli', $_POST['alamat_ahli']) ; 
            update_user_meta($chec_create, 'select_kariah', $_POST['select_kariah']) ; 
            update_user_meta($chec_create, 'stage_daftar', 2) ; 
            update_user_meta($chec_create, 'jenis_ahli', $_POST['jenis_ahli']) ; 
            $_POST['type_reg'] ? (update_user_meta($chec_create, 'wp_capabilities', array($_POST['type_reg'] => 1))) : '' ; 
    
            $alert = "Berjaya daftar ahli" ; 
        }
       
    }


    
}




?>

<?php 
 $kariah_name = $_POST['kariah_name'] ; 
 $alamat_kariah = $_POST['alamat_kariah'] ?? get_post_meta( $check_author_site_name[0]->ID, 'alamat_kariah', true ) ; 
 $site_page_url = $_POST['site_page_url'] ; 

 if($alert !== false ){
    ?>
        <div class="woocommerce-notices-wrapper">
            <ul class="woocommerce-message" role="alert">
                    <li data-id="account_first_name">
                    <strong><?php echo $alert ; ?></strong> <a href="<?php echo get_home_url()."/my-account/?luqpage=kariah_senaraiahli"; ?>">Lihat Senarai Ahli</a> </li>
            </ul>
        </div>

    <?php 
    } 

 if($error !== false ){
    ?>
        <div class="woocommerce-notices-wrapper">
            <ul class="woocommerce-error" role="alert">
                    <li data-id="account_first_name">
                    <strong><?php echo $error ; ?></strong> </li>
            </ul>
        </div>

    <?php 
    } ?>

<div>
<div class="row">
    <div class="col-sm-8">
    <h3 class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-file-earmark-person-fill" viewBox="0 0 16 16">
  <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm2 5.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-.245S4 12 8 12s5 1.755 5 1.755z"/>
</svg>&nbsp;Pendaftaran Ahli Kariah : <?php echo  $select_kariah_name ; ?></h3>

    </div>
    <div class="col-sm-4 text-end">
       <!-- tree  -->
    </div>
</div>
</div>

<br>
<form class="woocommerce-EditAccountForm edit-account" action="" method="post">

<div class="container">
    <div class="row">
        <div class="col">
        
                <label><h6>Kariah</h6></label>
                <input readonly type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="select_kariah_name" id="select_kariah_name" value="<?php echo isset($select_kariah_name) ? $select_kariah_name : $_POST['select_kariah_name'] ; ?>"> 
                <input style="display:none;" type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="select_kariah" id="select_kariah" value="<?php echo isset($select_kariah) ? $select_kariah : $_POST['select_kariah'] ; ?>"> 
        
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
        
                <label><h6>Nama</h6></label>
                <input placeholder="Nama" type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="nama_ahli" id="nama_ahli" value="<?php echo isset($nama_ahli) ? $nama_ahli : $_POST['nama_ahli'] ; ?>" required> 
        
        </div>

        <div class="col">
                <label>Jenis Ahli</label>
                <select
                  name="type_reg"
                  id="type_reg"
                  class="form-control woocommerce-Input woocommerce-Input--select input-select"
                  required
                >
                <option <?php echo isset($type_reg) && $type_reg == "ahli" ? "selected" : "" ; ?> value="ahli">Ahli</option>
                <option <?php echo isset($type_reg) && $type_reg == "asnaf"  ? "selected" : "" ; ?> value="asnaf">Asnaf</option>
                  <option <?php echo isset($type_reg) && $type_reg == "pentadbir" ? "selected" : "" ; ?> value="pentadbir">Pentadbir</option>
                 
                </select>
              </div>
    </div>

    <br>
    <div class="row">
    <div class="col">
                <label><h6>Kata Laluan</h6></label>
                <input placeholder="Kata Laluan" min="100000000000" type="password" class="<?php echo $errorpass ? 'is-invalid' : '' ; ?> woocommerce-Input woocommerce-Input--text input-text" name="password" id="password" value="" required> 
        
    </div>
    <div class="col">
                <label><h6>Masukkan Semula Katalaluan</h6></label>
                <input placeholder="Masukkan Semula Katalaluan" type="password" class="<?php echo $errorpass ? 'is-invalid' : '' ; ?> woocommerce-Input woocommerce-Input--text input-text" name="password_temp" id="password_temp" value="" required> 
        
    </div>
   
  </div>
  <br>

  <div class="row">
    <div class="col">
                <label><h6>No. Kad Pengenalan</h6></label>
                <input placeholder="No. Kad Pengenalan" min="100000000000" type="number" class="<?php echo $erroric ? 'is-invalid' : '' ; ?> woocommerce-Input woocommerce-Input--text input-text" name="kad_pengenalan_ahli" id="kad_pengenalan_ahli" value="<?php echo isset($kad_pengenalan_ahli) ? $kad_pengenalan_ahli : $_POST['kad_pengenalan_ahli'] ; ?>" required> 
        
    </div>
    <div class="col">
                    <label><h6>No. Tel</h6></label>
                <input placeholder="No. Tel" type="number" class="woocommerce-Input woocommerce-Input--text input-text" name="tel_ahli" id="tel_ahli" value="<?php echo isset($tel_ahli) ? $tel_ahli : $_POST['tel_ahli'] ; ?>" required> 
        
    </div>
   
  </div>
  <br>
  <div class="row">
        <div class="col">
        <label><h6>Email</h6></label>
                <input placeholder="Email" type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email_ahli" id="email_ahli" value="<?php echo isset($email_ahli) ? $email_ahli : $_POST['email_ahli'] ; ?>" required> 
        
        </div>
        <div class="col">
                        <label><h6>Tarikh Daftar</h6></label>
                        <div class="input-group date" id="tarikh_daftar_div">
                        <input placeholder="Tarikh Daftar" type="text" class="form-control" name="tarikh_daftar" id="tarikh_daftar"  value="<?php echo isset($_POST['tarikh_daftar']) ? $_POST['tarikh_daftar'] : date("d/m/y") ; ?>"/>
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

    <br>
    <div class="row">
        <div class="col">
            <textarea placeholder="Alamat" class="form-control woocommerce-Input" id="alamat_ahli" name="alamat_ahli" rows="4" cols="50" required><?php echo isset($alamat_ahli) ? $alamat_ahli : $_POST['alamat_ahli'] ; ?></textarea>
    
        </div>
    </div>

    <br>

</div>
	
	
	
	<p>
    <button type="submit" class="woocommerce-Button button" name="submit_site_details" value="Save changes">Save changes</button>
		<input type="hidden" name="action" value="save_pendaftaran_ahli">
	</p>

	</form>




    <script src="<?php echo YOURUN_URL. '/public/js/jquery.min.js' ; ?>"></script>
<script src="<?php echo YOURUN_URL. '/public/js/bootstrap-datepicker.min.js' ; ?>"></script>


<script>

    $(function(){
        $('#tarikh_daftar_div').datepicker({ format: 'dd/mm/yy' });
});
</script>





