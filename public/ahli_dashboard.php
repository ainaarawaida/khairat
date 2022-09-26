


<link rel="stylesheet" href="<?php echo YOURUN_URL.'/public/css/jquery.dataTables.min.css'   ; ?>">
    <link rel="stylesheet" href="<?php echo YOURUN_URL.'/public/css/buttons.dataTables.min.css'   ; ?>">
    <link rel="stylesheet" href="<?php echo YOURUN_URL.'/public/css/fixedHeader.dataTables.min.css'   ; ?>">


<div class="container">

<div class="row">
    <div class="col">
      
       <h4>Dashboard</h4>

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


  <br><br>

    <div class="row">
        <div class="col">
        
        
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button bg-info text-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                       <b>Rekod Bayaran</b> 
                    </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                        

                            <table id="example" class="display" style="width:90%;padding-top:30px;margin: 0 0;">
                                <thead>
                                    <tr>
                                        <th>Yuran</th>
                                        <th>Catatan</th>
                                        <th>Status</th>
                                        <th>Jumlah (RM)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $result = array(); foreach($result as $key => $val){  ?>
                                    <tr>
                                        <td><?php echo ($val->namasyarikat); ?></td>
                                        <td><?php echo ($val->alamat); ?></td>
                                        <td><?php echo ($val->phone1); ?></td>
                                        <td><?php echo ($val->phone2); ?></td>
                                        <td></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Yuran</th>
                                        <th>Catatan</th>
                                        <th>Status</th>
                                        <th>Jumlah (RM)</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>

                        
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed bg-info text-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                       <b>Rekod Penerimaan Sumbangan Khairat</b> 
                    </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse text-light" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        

                        <table id="example2" class="display" style="width:90%;padding-top:30px;margin: 0 0;">
                                    <thead>
                                        <tr>
                                            <th>Yuran</th>
                                            <th>Catatan</th>
                                            <th>Status</th>
                                            <th>Jumlah (RM)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $result = array(); foreach($result as $key => $val){  ?>
                                        <tr>
                                            <td><?php echo ($val->namasyarikat); ?></td>
                                            <td><?php echo ($val->alamat); ?></td>
                                            <td><?php echo ($val->phone1); ?></td>
                                            <td><?php echo ($val->phone2); ?></td>
                                            <td></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Yuran</th>
                                            <th>Catatan</th>
                                            <th>Status</th>
                                            <th>Jumlah (RM)</th>
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