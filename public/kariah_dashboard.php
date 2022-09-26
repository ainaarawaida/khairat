
<?php

// global $wpdb ;

// $check_author_site_name = $wpdb->get_results( 
//     $wpdb->prepare("SELECT ID,post_name,post_title FROM {$wpdb->prefix}posts WHERE post_type =%s AND post_author = %d", array('yourun_page_name', get_current_user_id())) 
//  );

$alert = false ; 
// deb($senarai_nama);exit();

if(isset($_POST['action']) && $_POST['action'] == 'save_stage_daftar'){
    update_user_meta($_POST['id'], 'stage_daftar', $_POST['stage_daftar']) ; 

    if($_POST['stage_daftar'] == '2'){
        $alert = "Permohonan Pendaftaran Ahli ini telah berjaya diterima" ;
    }else{
        $alert = "Permohonan Pendaftaran Ahli ini telah berjaya ditolak" ;
    }
   
}

if($_POST['action']){
    ?>
        <div class="woocommerce-notices-wrapper">
            <ul class="woocommerce-message" role="alert">
                    <li data-id="account_first_name">
                    <strong>Successul Update</strong>  <?php echo $alert ; ?> </li>
            </ul>
        </div>

    <?php 
    } 

 
$senarai_nama = $wpdb->get_results( 
    $wpdb->prepare("SELECT a.*, 
    b.meta_value as select_kariah, 
    c.meta_value as nama_ahli ,
    d.meta_value as tel_ahli ,
    e.meta_value as kad_pengenalan_ahli ,
    f.meta_value as email_ahli ,
    g.meta_value as alamat_ahli,
    h.meta_value as stage_daftar
   
    
    FROM {$wpdb->prefix}users a 
    LEFT JOIN {$wpdb->prefix}usermeta b ON a.ID = b.user_id 
    LEFT JOIN {$wpdb->prefix}usermeta c ON a.ID = c.user_id 
    LEFT JOIN {$wpdb->prefix}usermeta d ON a.ID = d.user_id 
    LEFT JOIN {$wpdb->prefix}usermeta e ON a.ID = e.user_id 
    LEFT JOIN {$wpdb->prefix}usermeta f ON a.ID = f.user_id 
    LEFT JOIN {$wpdb->prefix}usermeta g ON a.ID = g.user_id 
    LEFT JOIN {$wpdb->prefix}usermeta h ON a.ID = h.user_id 

    where b.meta_key = 'select_kariah'
    AND c.meta_key = 'nama_ahli'
    AND d.meta_key = 'tel_ahli'
    AND e.meta_key = 'kad_pengenalan_ahli'
    AND f.meta_key = 'email_ahli'
    AND g.meta_key = 'alamat_ahli'
    AND h.meta_key = 'stage_daftar'
    

    AND h.meta_value = '1'
    AND b.meta_value = '".$check_author_site_name[0]->ID."' ") 
 );



?>

<link rel="stylesheet" href="<?php echo YOURUN_URL.'/public/css/jquery.dataTables.min.css'   ; ?>">
    <link rel="stylesheet" href="<?php echo YOURUN_URL.'/public/css/buttons.dataTables.min.css'   ; ?>">
    <link rel="stylesheet" href="<?php echo YOURUN_URL.'/public/css/fixedHeader.dataTables.min.css'   ; ?>">


<div class="container">

<div class="row">
    <div class="col">
      
       <h4>Kariah Dashboard : <?php echo $check_author_site_name[0]->post_title ; ?></h4>

    </div>
</div>

  <div class="row">
    <div class="col">
      
        <div class="card text-center bg-primary text-light">

        
            <div class="card-header">
                <b>Jumlah Bayaran (RM)</b> 
            </div>
            <div class="card-footer text-light">
                110.00
            </div>
        </div>

    </div>
    <div class="col">
      
        <div class="card text-center bg-danger text-light">
            <div class="card-header ">
                <b>Jumlah Tunggakan (RM)</b> 
            </div>
            <div class="card-footer">
                110.00
            </div>
        </div>


    </div>
   
  </div>
  <br>
  <div class="row">
    <div class="col">
      
        <div class="card text-center bg-success text-light">

        
            <div class="card-header">
                <b>Permohonan Baru </b> 
            </div>
            <div class="card-footer text-light">
                110.00
            </div>
        </div>

    </div>
    <div class="col">
      
        <div class="card text-center bg-warning text-light">
            <div class="card-header ">
                <b>Ahli Berdaftar (Aktif)</b> 
            </div>
            <div class="card-footer">
                110.00
            </div>
        </div>


    </div>
   
  </div>


  <br>
  <div class="row">
    <div class="col bg-secondary bg-gradient rounded-3 p-2 text-light">
        <span class="">
        Setiap pendaftaran permohonan ahli melalui sistem akan disenaraikan di ruangan ini untuk diluluskan/ditolak oleh Pentadbir sistem. 
        
        </span>
    </div>
  </div>
  <br><br>

    <div class="row">
        <div class="col">
        
        
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button bg-info text-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                       <b>Pendaftaran Online </b> 
                    </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                        

                            <table id="example" class="display" style="width:90%;padding-top:30px;margin: 0 0;">
                                <thead>
                                    <tr>
                                        <th>Tarikh Daftar</th>
                                        <th>Nama</th>
                                        <th>Kariah</th>
                                        <th>Telefon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($senarai_nama as $key => $val){  ?>
                                    <tr>
                                        <td><?php echo date('d-m-Y', strtotime($val->user_registered)); ?></td>
                                        <td><?php echo ($val->nama_ahli); ?></td>
                                        <td><?php echo ($check_author_site_name[0]->post_title); ?></td>
                                        <td><?php echo ($val->tel_ahli); ?></td>
                                        <td><button id="action-detail" data-detail="<?php echo base64_encode(json_encode($val)) ; ?>" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
</svg>
                                        </button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <th>Tarikh Daftar</th>
                                        <th>Nama</th>
                                        <th>Kariah</th>
                                        <th>Telefon</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>

                        
                        </div>
                    </div>
                </div>
                
                
            </div>



        </div>
    </div>




</div>


<!-- Modal -->
<div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Adakah permohonan ini diluluskan ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

            <form action="" id="md-stage_daftarform" method="post">
                <input type="hidden" name="stage_daftar" id="md-stage_daftar" value="">
                <input type="hidden" name="id" id="md-id_ahli" value="save_stage_daftar">
                <input type="hidden" name="action" value="save_stage_daftar">
                <button type="button" id="lulus-button" class="btn btn-primary">Lulus</button>
                <button type="button" id="tidaklulus-button" class="btn btn-danger">Tidak</button>
            </form>
           
        </div>


      <div class="modal-body">
        
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                
                <tbody>
                <tr>
                    <th scope="row">Nama</th>
                    <td><span id="md-nama_ahli"></span></td>
                </tr>
                <tr>
                    <th scope="row">Tarikh Permohonan</th>
                    <td><span id="md-user_registered"></span></td>
                </tr>
                <tr>
                    <th scope="row">Kad Pengenalan</th>
                    <td><span id="md-kad_pengenalan_ahli"></span></td>
                </tr>
                <tr>
                    <th scope="row">No. Telefon</th>
                    <td><span id="md-tel_ahli"></span></td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td><span id="md-user_email"></span></td>
                </tr>
                <tr>
                    <th scope="row">Alamat Rumah</th>
                    <td><span id="md-alamat_ahli"></span></td>
                </tr>
                <tr>
                    <th scope="row">Kariah</th>
                    <td scope="row"><?php echo ($check_author_site_name[0]->post_title); ?></td>
                </tr>
               
                    
                </tbody>
            </table>
            </div>  <!-- table responsive -->

<h5 class="modal-title" id="staticBackdropLabel">Maklumat Yuran</h5>
            <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">Bil.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">No. KP </th>
                        <th scope="col">Umur</th>
                        <th scope="col">Yuran</th>
                        <th scope="col">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td>MUSTAFA BIN MOHAMAD</td>
                    <td>MUSTAFA BIN MOHAMAD</td>
                    <td>MUSTAFA BIN MOHAMAD</td>
                    <td>MUSTAFA BIN MOHAMAD</td>
                    <td>MUSTAFA BIN MOHAMAD</td>
                    <td>MUSTAFA BIN MOHAMAD</td>
                </tr>
                <tr>
                <td>MUSTAFA BIN MOHAMAD</td>
                    <td>MUSTAFA BIN MOHAMAD</td>
                    <td>MUSTAFA BIN MOHAMAD</td>
                    <td>MUSTAFA BIN MOHAMAD</td>
                    <td>MUSTAFA BIN MOHAMAD</td>
                    <td>MUSTAFA BIN MOHAMAD</td>
                </tr>
                <tr>
                <td>MUSTAFA BIN MOHAMAD</td>
                    <td>MUSTAFA BIN MOHAMAD</td>
                    <td>MUSTAFA BIN MOHAMAD</td>
                    <td>MUSTAFA BIN MOHAMAD</td>
                    <td>MUSTAFA BIN MOHAMAD</td>
                    <td>MUSTAFA BIN MOHAMAD</td>
                </tr>
               
                </tbody>
            </table>
            </div>  <!-- table responsive -->

      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
      </div>
    </div>
  </div>
</div>



<script type="text/javascript" src="<?php echo YOURUN_URL.'/public/js/jquery-3.5.1.js'   ; ?>"></script>
<script type="text/javascript" src="<?php echo YOURUN_URL.'/public/js/jquery.dataTables.min.js'   ; ?>"></script>
<script type="text/javascript" src="<?php echo YOURUN_URL.'/public/js/dataTables.buttons.min.js'   ; ?>"></script>
<script type="text/javascript" src="<?php echo YOURUN_URL.'/public/js/jszip.min.js'   ; ?>"></script>
<script type="text/javascript" src="<?php echo YOURUN_URL.'/public/js/pdfmake.min.js'   ; ?>"></script>
<script type="text/javascript" src="<?php echo YOURUN_URL.'/public/js/vfs_fonts.js'   ; ?>"></script>
<script type="text/javascript" src="<?php echo YOURUN_URL.'/public/js/buttons.html5.min.js'   ; ?>"></script>
<script type="text/javascript" src="<?php echo YOURUN_URL.'/public/js/buttons.print.min.js'   ; ?>"></script>
<script type="text/javascript" src="<?php echo YOURUN_URL.'/public/js/dataTables.fixedHeader.min.js'   ; ?>"></script>


<script>

    console.log(document.querySelector("#action-detail"));
if(document.querySelector("#action-detail") != null){
    document.querySelector("#action-detail").addEventListener ("click", function() {

    var passdata = JSON.parse(atob(this.getAttribute("data-detail")));
    document.querySelector("#md-nama_ahli").innerHTML = passdata.nama_ahli;
    document.querySelector("#md-user_registered").innerHTML = passdata.user_registered;
    document.querySelector("#md-kad_pengenalan_ahli").innerHTML = passdata.kad_pengenalan_ahli;
    document.querySelector("#md-tel_ahli").innerHTML = passdata.tel_ahli;
    document.querySelector("#md-user_email").innerHTML = passdata.user_email;
    document.querySelector("#md-alamat_ahli").innerHTML = passdata.alamat_ahli;
    document.querySelector("#md-stage_daftar").value = passdata.stage_daftar;
    document.querySelector("#md-id_ahli").value = passdata.ID;






    });

}



document.querySelector("#lulus-button").addEventListener ("click", function() {
    document.querySelector("#md-stage_daftar").value = '2';
    document.querySelector("#md-stage_daftarform").submit();

});


document.querySelector("#tidaklulus-button").addEventListener ("click", function() {
    document.querySelector("#md-stage_daftar").value = '3';
    document.querySelector("#md-stage_daftarform").submit();

});



$(document).ready(function() {

    $('#example').DataTable( {
        oLanguage: {
          "sSearch": "Carian"
        },
        scrollX: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print', 'pageLength'
        ],
        orderCellsTop: true,
       
    } );




    //table 2
    // Setup - add a text input to each footer cell
       
        $('#example2').DataTable( {
            oLanguage: {
            "sSearch": "Carian"
            },
            scrollX: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'pageLength'
            ],
            orderCellsTop: true,
        } );


} );


</script>