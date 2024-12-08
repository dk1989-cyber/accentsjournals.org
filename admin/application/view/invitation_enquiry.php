<?php
include "basic/admin_header.php";

?>
<div class="mainpanel">
<div class="contentpanel">

  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i>  </a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Invitation Query  </h4>
        </div>
      
         <div class="panel-body" style='margin-top:10px'>
          <div class="row">
                <div class="col-md-12">
                <div class="table-responsive">
                    <table id="dataTable1" class="table table-bordered table-striped-col">
                        <thead>
                            <tr>
                                <th>Serial No. </th>
                                <th>Title</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM invitation";
                            $stmt = $conn->query($sql);
                            $i=1;
                            while(($row=$stmt->fetchAssociative())!==false){
                                extract($row);
                            ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=$title?></td>
                                    <td><?=$first_name ." ".$middle_name." ".$last_name?></td>
                                    <td><?=$department?></td>
                                    <td><?=$position?></td>
                                    <td><a class='btn btn-success btn-sm' href="invitation_query_detail.php?id=<?=$invitation_id?>">View Detail</a><a onclick="delete_invitation(<?=$invitation_id?>);" class='btn btn-danger btn-sm'><i class='fa fa-times'></i></a></td>
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
          <div class="row">
            <div class="col-md-12" style='margin-top:10px'>
             <a onclick="history.back();" class='btn btn-danger'>Back</a>
            </div>
          </div>
       </div><!-- panel -->
     </div>
    </div><!-- col-sm-6 -->
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

function delete_invitation(id){
  if(confirm("Are you sure")){
       burl="../action/deleteAction.php"; 
       $.post(burl,{"id":id,"tab":"invitation"},function(data,status){
         window.location.reload();
       });
  }
}

</script>