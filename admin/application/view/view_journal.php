<?php
include "basic/admin_header.php";
?>


<div class="mainpanel">

<div class="contentpanel">

  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i> View Journal</a></li>
   
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>View Journal</h4>
        </div>
        <div class="panel-body" style='margin-top:10px'>
             <div class="row">
                <div class="col-md-12">
                <div class="table-responsive">
            <table id="dataTable1" class="table table-bordered table-striped-col">
              <thead>
                <tr>
                    <th>Serial No. </th>
                    <th style='width:10%'>Logo</th>
                    <th>Journal Name</th>
                    <th>Journal Abbreviation</th>
                    <th>ISSN(P)</th>
                    <th>ISSN(O)</th>
                    <th style='width:12%'>Starting Year</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                 $sql = "SELECT * FROM journals";
                 $stmt = $conn->query($sql);
                 $i=1;
                while(($row=$stmt->fetchAssociative())!==false){
                    extract($row);
                ?>
                      <tr>
                        <td><?=$i?></td>
                        <td><img style='width:100%' src="<?=base_url('upload/')?><?=$journal_logo?>"/></td>
                        <td><?=$name?></td>

                        <td style='width:10%'><?=$journal_abbri?></td>
                        <td><?="P:".$issnprint?></td>
                        <td><?="O:".$issnonline?></td>
                        <td><?=$starting_year?></td>
                       
                        <td><a class='btn btn-info btn-sm' href="edit_journal.php?id=<?=$journals_id?>"><i class='fa fa-edit'></i></a><a class='btn btn-danger btn-sm' onclick="delete_journal(<?=$journals_id?>)"><i class='fa fa-trash'></i></a></td>
                      </tr>
                 <?php
                 $i=$i+1;
                 }
                 ?>
              </tbody>
            </table>
          </div>
                </div>
             </div>
        </div>
      </div>
 
  
 
 
    
    </div><!-- col-sm-6 -->

    <!-- ####################################################### -->

    
  </div><!-- row -->

</div><!-- contentpanel -->
</div><!-- mainpanel -->


</section>

<?php
include "basic/admin_footer.php";
?>
<script>
$(document).ready(function() {
  'use strict';
  $('#dataTable1').DataTable();
});

function delete_journal(id){
  if(confirm('Are you sure you want to delete')){
      burl="../action/deleteJournal.php";
      $.post(burl,{"id":id},function(data,status){
         window.location.reload();
      });
  } 
}
</script>