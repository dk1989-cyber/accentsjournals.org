<?php
include "basic/admin_header.php";
?>


<div class="mainpanel">

<div class="contentpanel">

  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i> View Paper</a></li>
   
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>View Paper</h4>
        </div>
        <div class="panel-body" style='margin-top:10px'>
        <table id="dataTable1" class="table table-bordered table-striped-col">
              <thead>
                
                <tr>
                    <th>Sr.no.</th>
                    <th>Paper Title</th>
                    <th>Authors</th>
                    <th>Accepted Date</th>
                    <th>Issue</th>
                    <th>Journal</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $q="select jp.*,i.*,j.journal_abbri from journalpaper jp 
                left join issue i on jp.issue_id=i.issue_id
                left join journals j on i.journals_id=j.journals_id order by jp.journalpaper_id desc";
                $stmt = $conn->query($q);
                $i=1;
                while(($row=$stmt->fetchAssociative())!==false){
                  extract($row);
                ?>
                 <tr>
                   <td><?=$i?></td>
                   <td><?=$title?></td>
                   <td><?=$no_authors?></td>
                   <td><?=$accepted_date?></td>
                   <td><?=$volume?>(<?=$issue?>)</td>
                   <td><?=$journal_abbri?></td>
                   <td><a class='btn btn-success btn-sm' href="edit_paper.php?id=<?=$journalpaper_id?>"><i class='fa fa-edit'></i></a><a class='btn btn-danger btn-sm' onclick="delPaper(<?=$journalpaper_id?>)" ><i class='fa fa-trash'></i></a></td>
                 </tr>
                 <?php
                 $i=$i+1;
                }
                 ?>
              </tbody>
            </table>
       </div>
      </div><!-- panel -->   
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

function delPaper(id,abbri,y,m){
  if(confirm('Are you sure you want to delete')){
      burl="../action/deletePaper.php";
      $.post(burl,{"id":id,"abbri":abbri,"year":y,"month":m},function(data,status){
         window.location.reload();
      });
  } 
}

</script>
