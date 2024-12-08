<?php
include "basic/admin_header.php";
?>


<div class="mainpanel">
<div class="contentpanel">
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i> View Article in Press </a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Article In Press</h4>
        </div>
        <div class="panel-body" style='margin-top:10px'>
        <table id="dataTable1" class="table table-bordered table-striped-col">
              <thead>
                <tr>
                    <th>Sr.no.</th>
                    <th>Paper Title</th>
                    <th>Authors</th>
                    <th>Accepted Date</th>
                    <th>Journal</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $q="select jp.*,j.journal_abbri,j.journals_id from press_paper jp 
                left join journals j on jp.journals_id=j.journals_id order by jp.press_paper_id desc";
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
                   <td><?=$journal_abbri?></td>
                   <td><a class='btn btn-success btn-sm' href="edit_press_paper.php?id=<?=$press_paper_id?>"><i class='fa fa-edit'></i></a><a class='btn btn-danger btn-sm' onclick="delPaper(<?=$press_paper_id?>,'<?=$journal_abbri?>')" ><i class='fa fa-trash'></i></a><a class='btn btn-sm btn-warning' onclick="move_to_issue(<?=$press_paper_id?>,<?=$journals_id?>)">Move</a></td>
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
  </div><!-- row -->
</div><!-- contentpanel -->
</div><!-- mainpanel -->


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id='title'>Move to Issue</h4>
      </div>
      <div class="modal-body">
        <form   action="../action/moveToIssue.php"  method='post' >
             <div class='row'>
                 <div class='col-md-9'>
                    <input type='hidden' name='id' id='id' />
                    <select name='issue_id' id='issue_id' class='form-control'>
                        <option></option>
                    </select>
                 </div> 
                 <div class='col-md-2'>
                    <button class='btn btn-success'>Confirm</button>
                </div> 
             </div>
        </form>
      </div> 
    </div>
  </div>
</div>

</section>

<?php
include "basic/admin_footer.php";
?>
<script>
$(document).ready(function() {
  'use strict';
  $('#dataTable1').DataTable();
});

function delPaper(id,abbri){
  if(confirm('Are you sure you want to delete')){
      burl="../action/deletePressPaper.php";
      $.post(burl,{"id":id,"abbri":abbri},function(data,status){
         window.location.reload();
      });
  } 
}


function move_to_issue(id,jid){
   burl="../ajax/get_journals_issue_by_jid.php";
   $.post(burl,{"id":jid},function(data,status){
       $("#issue_id").html(data); 
       $("#id").val(id);
       $("#myModal").modal('show');
   }); 
}



</script>
