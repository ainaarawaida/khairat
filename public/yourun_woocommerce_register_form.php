<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
    <label for="type_reg"><?php esc_html_e( 'Type Registration', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
    <select name="type_reg" id="type_reg" class="form-control woocommerce-Input woocommerce-Input--select input-select" required>
        <option value="pentadbir">Daftar Pentadbir</option>
        <option value="ahli">Daftar Ahli</option>
    </select>

</p>


<?php 
global $wpdb ;

$select_kariah = $wpdb->get_results( 
    $wpdb->prepare("SELECT ID,post_name,post_title FROM {$wpdb->prefix}posts WHERE post_type =%s", array('yourun_page_name')) 
 );

?>

<p id="p_select_kariah" class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
    <label for="select_kariah"><?php esc_html_e( 'Kariah', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
    <select name="select_kariah" id="select_kariah" class="form-control woocommerce-Input woocommerce-Input--select input-select" required>
        <option></option>
        <?php foreach($select_kariah AS $key => $val ) { ?>
        <option value="<?php echo $val->ID ; ?>"><?php echo ($val->post_title) ; ?> </option>
      
        <?php } ?> 
    </select>

</p>

<!-- Styles -->

<link rel="stylesheet" href="<?php echo YOURUN_URL. '/public/css/select2.min.css' ; ?>" />
<link rel="stylesheet" href="<?php echo YOURUN_URL. '/public/css/select2-bootstrap-5-theme.min.css' ; ?>" />


<!-- Scripts -->
<script src="<?php echo YOURUN_URL. '/public/js/jquery.slim.min.js' ; ?>"></script>
<script src="<?php echo YOURUN_URL. '/public/js/select2.min.js' ; ?>"></script>

<script>


document.addEventListener("DOMContentLoaded", function(){
            let ele = document.querySelector("#type_reg") ;
          
            if(ele.value == 'ahli'){
                    document.querySelector("#p_select_kariah").style.display = 'block' ;
                    document.querySelector("#select_kariah").setAttribute('required','');
                    // document.querySelector("#p_select_kariah").required = true ;
                   }else{
                
                    document.querySelector("#p_select_kariah").style.display = 'none' ;
                    document.querySelector("#select_kariah").removeAttribute('required');
                    // document.querySelector("#p_select_kariah").required = false ;
                   }


            ele.addEventListener("change", function(e){
                   if(e.target.value == 'ahli'){
                    document.querySelector("#p_select_kariah").style.display = 'block' ;
                    document.querySelector("#select_kariah").setAttribute('required','');
                    // document.querySelector("#p_select_kariah").required = true ;
                   }else{
                    document.querySelector("#p_select_kariah").style.display = 'none' ;
                    document.querySelector("#select_kariah").removeAttribute('required');
                    // document.querySelector("#p_select_kariah").required = false ;
                   }
                   
                  
                
                
            });

         
           
        
    });


$( '#select_kariah' ).select2( {
    theme: 'bootstrap-5'
} );
</script>