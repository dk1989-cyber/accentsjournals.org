<?php
include "basic/admin_header.php";
?>


<div class="mainpanel">

<div class="contentpanel">

  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i> View Issue Directory</a></li>
   
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>View Issue Directory</h4>
        </div>
        <div class="panel-body" style='margin-top:10px'>
           <div class="row" style='margin-bottom:20px'>
            <div class="col-md-12">
                <input <?=((isset($_SESSION["c"]))?'checked':'')?> onchange="chk_current();" type="checkbox" name='current' id='current'>
                <label for="current"><b>Show Current Issue Directory</b></label>
            </div>
           </div>
           <div class="row">
                <div class="col-md-12">
                <div class="table-responsive">
            <table  id="dataTable1" class="table table-bordered table-striped-col">
              <thead>
                <tr>     
                    <th>Srno</th>
                    <th>Issue</th>
                    <th>Volume</th>
                    <th>Year</th>
                    <th>Month</th>
                    <th>Journal</th>
                    <th>Status</th>
                    <th style='width:17%'>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
               
                 if(isset($_SESSION["c"])){
                  $sql = "SELECT i.*,j.name,j.journal_abbri,j.doi FROM issue i LEFT JOIN journals j ON i.journals_id=j.journals_id  where i.status='current' order by i.issue_id desc";
                 }
                 else{
                  $sql = "SELECT i.*,j.name,j.journal_abbri,j.doi FROM issue i LEFT JOIN journals j ON i.journals_id=j.journals_id order by i.issue_id desc";
                 }
                 
                 $stmt = $conn->query($sql);
                 $i=1;
                while(($row=$stmt->fetchAssociative())!==false){
                    extract($row);
                ?>
                 <tr>
                   <td><?=$i?></td>
                   <td><?=$issue?></td>
                   <td><?=$volume?></td>
                   <td><?=$year?></td> 
                   <td><?=(is_numeric($month)?get_month($month):$month)?></td>
                   <td><b><?=strtoupper($journal_abbri)?></b></td>
                   <td><?=($status=="Current")?"<span class='label label-success'>Current</span>":"<span class='label label-warning'>Previous</span>"?></td>
                  
                   <?php
                    $m=$month+1;
                    if($status=="Current"){
                      $doi_=urlencode($doi);
                    
                     ?>
                    <td>
                         <a class='btn btn-success btn-sm' href="add_paper.php?journal=<?=$journals_id?>&abbr=<?=$journal_abbri?>&issue=<?=$issue_id?>&doi=<?=$doi_?>"><i class='fa fa-plus'></i></a><a href="edit_directory.php?id=<?=$issue_id?>" class='btn btn-info btn-sm'><i class='fa fa-edit'></i></a><a onclick="delete_directory(<?=$issue_id?>,'<?=$journal_abbri?>',<?=$year?>,<?=$m?>,<?=$journals_id?>);" class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></a>
                         <a href="issue_preview.php?id=<?=$issue_id?>" class='btn btn-info btn-sm'>Preview</a>     
                   </td>
                    <?php
                    }else{
                      $doi_=urlencode($doi);
                    
                   ?>
                  <td>
                         <a class='btn btn-success btn-sm' href="add_paper.php?journal=<?=$journals_id?>&abbr=<?=$journal_abbri?>&issue=<?=$issue_id?>&doi=<?=$doi_?>"><i class='fa fa-plus'></i></a><a href="edit_directory.php?id=<?=$issue_id?>" class='btn btn-info btn-sm'><i class='fa fa-edit'></i></a><a onclick="delete_directory(<?=$issue_id?>,'<?=$journal_abbri?>',<?=$year?>,<?=$m?>,<?=$journals_id?>);" class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></a>
                         <a href="issue_preview.php?id=<?=$issue_id?>" class='btn btn-info btn-sm'>Preview</a>     
                   </td>
                   <?php
                    }
                   ?>
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

function delete_directory(id,abbri,y,m,jid){
  if(confirm('Are you sure you want to delete')){
      burl="../ajax/deleteDirectory.php";
      $.post(burl,{"id":id,"abbri":abbri,"year":y,"month":m,"journals_id":jid},function(data,status){
         
         window.location.reload();
      });
  } 
}


function chk_current(){
  var c;
  if($("#current").prop('checked') == true){
    c=1;
  }
  else{
    c=0;
  }

 
  burl="../ajax/checkCurrent.php";
      $.post(burl,{"c":c},function(data,status){
         window.location.reload();
      });
}
</script>