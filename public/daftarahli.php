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



if(isset($_POST['action']) && $_POST['action'] === 'save_pendaftaran_ahli' ){
   
    update_user_meta(get_current_user_id(), 'select_kariah_name', $_POST['select_kariah_name']) ; 
    update_user_meta(get_current_user_id(), 'select_kariah', $_POST['select_kariah']) ; 
    update_user_meta(get_current_user_id(), 'nama_ahli', $_POST['nama_ahli']) ; 
    update_user_meta(get_current_user_id(), 'first_name', $_POST['nama_ahli']) ; 
    
    update_user_meta(get_current_user_id(), 'kad_pengenalan_ahli', $_POST['kad_pengenalan_ahli']) ; 
    update_user_meta(get_current_user_id(), 'tel_ahli', $_POST['tel_ahli']) ; 
    update_user_meta(get_current_user_id(), 'email_ahli', $_POST['email_ahli']) ; 
    update_user_meta(get_current_user_id(), 'alamat_ahli', $_POST['alamat_ahli']) ; 
    update_user_meta(get_current_user_id(), 'select_kariah', $_POST['select_kariah']) ; 
    update_user_meta(get_current_user_id(), 'stage_daftar', 1) ; 
}




?>

<?php 
 $kariah_name = $_POST['kariah_name'] ; 
 $alamat_kariah = $_POST['alamat_kariah'] ?? get_post_meta( $check_author_site_name[0]->ID, 'alamat_kariah', true ) ; 
 $site_page_url = $_POST['site_page_url'] ; 

 if($_POST['action']){
    ?>
        <div class="woocommerce-notices-wrapper">
            <ul class="woocommerce-message" role="alert">
                    <li data-id="account_first_name">
                    <strong>Successul Update</strong> <a href="<?php echo get_home_url()."/my-account/maklumatahli"; ?>">View Dashboard</a> </li>
            </ul>
        </div>

    <?php 
    } ?>

<h3 class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-file-earmark-person-fill" viewBox="0 0 16 16">
  <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm2 5.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-.245S4 12 8 12s5 1.755 5 1.755z"/>
</svg>&nbsp;PENDAFTARAN AHLI</h3>
<br>
<form class="woocommerce-EditAccountForm edit-account" action="" method="post">

<div class="container">
    <div class="row">
        <div class="col">
        
                <label><h4>Kariah</h4></label>
                <input readonly type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="select_kariah_name" id="select_kariah_name" value="<?php echo isset($select_kariah_name) ? $select_kariah_name : $_POST['select_kariah_name'] ; ?>"> 
                <input style="display:none;" type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="select_kariah" id="select_kariah" value="<?php echo isset($select_kariah) ? $select_kariah : $_POST['select_kariah'] ; ?>"> 
        
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
        
                <label><h4>Maklumat Ahli</h4></label>
                <input placeholder="Nama" type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="nama_ahli" id="nama_ahli" value="<?php echo isset($nama_ahli) ? $nama_ahli : $_POST['nama_ahli'] ; ?>" required> 
        
        </div>
    </div>

    <br>
  <div class="row">
    <div class="col">
    
                <input placeholder="No. Kad Pengenalan" type="number" class="woocommerce-Input woocommerce-Input--text input-text" name="kad_pengenalan_ahli" id="kad_pengenalan_ahli" value="<?php echo isset($kad_pengenalan_ahli) ? $kad_pengenalan_ahli : $_POST['kad_pengenalan_ahli'] ; ?>" required> 
        
    </div>
    <div class="col">
    
                <input placeholder="No. Tel" type="number" class="woocommerce-Input woocommerce-Input--text input-text" name="tel_ahli" id="tel_ahli" value="<?php echo isset($tel_ahli) ? $tel_ahli : $_POST['tel_ahli'] ; ?>" required> 
        
    </div>
   
  </div>
  <br>
  <div class="row">
        <div class="col">
                <input readonly placeholder="Email" type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email_ahli" id="email_ahli" value="<?php echo isset($email_ahli) ? $email_ahli : $_POST['email_ahli'] ; ?>" required> 
        
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






