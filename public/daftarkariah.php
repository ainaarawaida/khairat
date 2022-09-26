<?php


global $wpdb ;

$check_author_site_name = $wpdb->get_results( 
    $wpdb->prepare("SELECT ID,post_name,post_title FROM {$wpdb->prefix}posts WHERE post_type =%s AND post_author = %d", array('yourun_page_name', get_current_user_id())) 
 );
 

 $error = false ;

if(isset($_POST['action']) && $_POST['action'] === 'save_site_details' && $_POST['site_page_url'] !== '' && $_POST['kariah_name'] !== ''){

    $check_exist_site_name = $wpdb->get_results( 
        $wpdb->prepare("SELECT ID,post_author FROM {$wpdb->prefix}posts WHERE post_type =%s AND post_name = %s", array('yourun_page_name', $_POST['site_page_url'])) 
     );

   
     if(!$check_exist_site_name){ 
       
        $my_post = array(
            'post_title'    => wp_strip_all_tags( $_POST['kariah_name'] ),
            'post_content'  => '',
            'post_status'   => 'publish',
            'post_author'   => get_current_user_id(),
            'post_type' => 'yourun_page_name',
            'post_name' => $_POST['site_page_url']
        );
        
        if($check_author_site_name){
            $my_post['ID'] = $check_author_site_name[0]->ID;
            wp_update_post( $my_post );
          

        }else{
            // Insert the post into the database
            $my_post['ID'] =  wp_insert_post( $my_post );
          
        }
      

    }else{

        $error = true ;
        if($check_author_site_name){
            if($check_author_site_name[0]->post_name ===  $_POST['site_page_url']){
                $error = false ;
            }

            $my_post['ID'] = $check_author_site_name[0]->ID;
            wp_update_post( $my_post );
          

        }
       
        
    }
    update_post_meta($my_post['ID'], 'alamat_kariah', $_POST['alamat_kariah']) ; 
    update_user_meta(get_current_user_id(), 'stage_daftar', 1) ; 
    update_user_meta(get_current_user_id(), 'jenis_ahli', 3) ; 
    


}

if(isset($_POST['action']) && $_POST['action'] === 'save_site_details' && ($_POST['site_page_url'] === '' || $_POST['kariah_name'] === '')){
    $error = true ;
}



?>

<?php 
 $kariah_name = $_POST['kariah_name'] ; 
 $alamat_kariah = $_POST['alamat_kariah'] ?? get_post_meta( $check_author_site_name[0]->ID, 'alamat_kariah', true ) ; 
 $site_page_url = $_POST['site_page_url'] ; 

 if($_POST['kariah_name']){
    if($error === true){ 
        
    ?>
        <div class="woocommerce-notices-wrapper">
            <ul class="woocommerce-error" role="alert">
                <li data-id="account_first_name">
                <strong>Site Page URL</strong> is taken. Please use other URL		</li>
            </ul>
        </div>

    <?php 
    }else{
        ?>
        <div class="woocommerce-notices-wrapper">
            <ul class="woocommerce-message" role="alert">
                    <li data-id="account_first_name">
                    <strong>Successul Update</strong>	 <a href="<?php echo get_home_url()."/my-account"; ?>">Lihat Dashboard Kariah</a> </li>
            </ul>
        </div>

    <?php 


    }
    } ?>



<form class="woocommerce-EditAccountForm edit-account" action="" method="post">

    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">  
		<label for="kariah_name">Nama Kariah&nbsp;<span class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="kariah_name" id="kariah_name" value="<?php echo isset($kariah_name) ? $kariah_name : $check_author_site_name[0]->post_title ; ?>" required> 
	</p>
	<div class="clear"></div>

    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">  
		<label for="kariah_name">Alamat Kariah&nbsp;<span class="required">*</span></label>
		<textarea class="form-control woocommerce-Input" id="alamat_kariah" name="alamat_kariah" rows="4" cols="50" required><?php echo isset($alamat_kariah) ? $alamat_kariah : "" ; ?></textarea>
    
    </p>
	<div class="clear"></div>

    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<label for="site_page_url">Site Page URL&nbsp;<span class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="site_page_url" id="site_page_url" value="<?php echo isset($site_page_url) ? $site_page_url : $check_author_site_name[0]->post_name ; ?>" required> 
        <span><em><?php echo home_url()."/". (isset($site_page_url) ? $site_page_url : (($check_author_site_name[0]->post_name != '') ? $check_author_site_name[0]->post_name : '[Your_Site_Page_URL]')) ;  ?></em></span>
	</p>
	<div class="clear"></div>
	
	
	
	<p>
    <button type="submit" class="woocommerce-Button button" name="submit_site_details" value="Save changes">Save changes</button>
		<input type="hidden" name="action" value="save_site_details">
	</p>

	</form>





<script>

</script>
