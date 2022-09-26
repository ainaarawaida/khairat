<?php

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
    -- AND h.meta_value = '2'
    AND b.meta_value = '".$check_author_site_name[0]->ID."' ") 
 );

//  deb($senarai_nama);

?>

<link rel="stylesheet" href="<?php echo YOURUN_URL.'/public/css/jquery.dataTables.min.css'   ; ?>">
    <link rel="stylesheet" href="<?php echo YOURUN_URL.'/public/css/buttons.dataTables.min.css'   ; ?>">
    <link rel="stylesheet" href="<?php echo YOURUN_URL.'/public/css/fixedHeader.dataTables.min.css'   ; ?>">

<div class="container">
  <div class="row">
    <div class="col">
    <h4><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
  <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
  <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
  <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
</svg> Senarai Ahli Tidak Aktif</h4>
    </div>
   
  </div>
  <br>
  <div class="row">
    <div class="col bg-secondary bg-gradient rounded-3 p-2 text-light">
    Semua ahli yang berdaftar dan telah diluluskan akan dipaparkan dibahagian ini.
Pentadbir perlu klik edit untuk melihat perincian ahli, bayaran, tanggungan dan faedah khairat yang diterima. 
    </div>
   
  </div>
  <br>
  <div class="row text-end">
    <div class="col">
    <a href="<?php echo home_url().'/my-account/?luqpage=kariah_senaraiahli&kariah_daftarahli=1' ; ?>" type="button" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
</svg>  Daftar Ahli</a>
    <a href="<?php echo home_url().'/my-account/?luqpage=kariah_senaraiahli&kariah_senaraiahlixaktif='.$check_author_site_name[0]->ID ; ?>" type="button" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
</svg>  Senarai Ahli Tidak Aktif</a>
    </div>
   
  </div>

  <br>
  <div class="row justify-content-end">
    <div class="col">
    <table id="example" class="display" style="width:90%;padding-top:30px;margin: 0 0;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>No Ahli</th>
                                        <th>Nama</th>
                                        <th>No IC</th>
                                        <th>Kariah</th>
                                        <th>Telefon</th>
                                        <th>Status</th>
                                        <th>Kemaskini</th>
                                        <th>Tunggakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($senarai_nama as $key => $val){  ?>
                                    <tr>
                                        <td><?php echo $key; ?></td>
                                        <td><?php echo ($val->ID); ?></td>
                                        <td><?php echo ($val->nama_ahli); ?></td>
                                        <td><?php echo ($val->kad_pengenalan_ahli); ?></td>
                                        <td><?php echo ($check_author_site_name[0]->post_title); ?></td>
                                        <td><?php echo ($val->tel_ahli); ?></td>
                                        <td><?php echo ($val->stage_daftar); ?></td>
                                        <td><a href="<?php echo home_url().'/my-account/?luqpage=kariah_senaraiahli&kariah_senaraiahli_edit='.$val->ID ; ?>" type="button" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                            </a>
                                                
                                                <button data-detail="<?php echo base64_encode(json_encode($val)) ; ?>" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                                </svg>
                                            </button>
                                        </td>

                                       
                                        
                                        
                                        <td><button data-detail="<?php echo base64_encode(json_encode($val)) ; ?>" type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-diamond" viewBox="0 0 16 16">
                                        <path d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.482 1.482 0 0 1 0-2.098L6.95.435zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z"/>
                                        <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                                        </svg>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>No Ahli</th>
                                        <th>Nama</th>
                                        <th>No IC</th>
                                        <th>Kariah</th>
                                        <th>Telefon</th>
                                        <th>Status</th>
                                        <th>Kemaskini</th>
                                        <th>Tunggakan</th>
                                    </tr>
                                </tfoot>
                            </table>
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



} );


</script>