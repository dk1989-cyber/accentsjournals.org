<?php
include "basic/admin_header.php";
 
?>

<div class="mainpanel">
<div class="contentpanel">
  
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i>Feedback Enquiry</a></li>
  </ol>
 
   <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>View Feedback Enquiry </h4>
        </div>
        <div class="panel-body" style='margin-top:10px'>
             <div class="row">
                <div class="col-md-12">
                <div class="table-responsive">
            <table id="dataTable1" class="table table-bordered table-striped-col">
              <thead>
                <tr>
                    <th style='width:6%'>Srno</th>
                    <th style='width:10%'>Name</th>
                    <th style='width:10%'>Contact</th>
                    <th style='width:10%'>Email</th>
                    <th style='width:10%'>Company</th>
                    <th style='width:10%'>Country</th>
                    <th  >Comment</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                 $sql = "SELECT * FROM feedback";
                 $stmt = $conn->query($sql);
                 $i=1;
                 while(($row=$stmt->fetchAssociative())!==false){
                    extract($row);
                ?>
                      <tr>
                        <td><?=$i?></td>
                        <td><?=$name?></td>
                        <td><?=$mobile?></td>
                        <td><?=$email?></td>
                        <td><?=$company?></td>
                        <td><?=$country?></td>
                        <td><?=$comment?></td>
                        <td><a class='btn btn-danger btn-sm' onclick="delete_feedback(<?=$feedback_id?>)"><i class='fa fa-trash'></i></a></td>
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
  </div><!-- row -->
</div><!-- contentpanel -->
</div><!-- mainpanel -->
</section>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id='title'>Edit Department </h4>
      </div>
      <div class="modal-body">
      <form action="../action/updateDepartment.php" method='post' enctype='multipart/form-data'>
         <div class="row">
           <div class="form-group col-md-10">  
                     <input type="hidden" name='department_id' id="department_id"  value="">
                      <label class='lbl' for="">Department</label>
                     <input class='form-control' type="text" name='edepeartment' id='edepeartment'>
           </div> 
           
           <div class="form-group col-md-2">
                      <label class='lbl' for="">Status</label>
                      <select class='form-control' name="estatus" id="estatus">
                            <option value="Enable">Enable</option>
                            <option value="Disable">Disable</option>
                      </select>
           </div>      
          <div  class="form-group col-md-12" style='margin-bottom:10px;margin-top:2px'>
             <button class='btn btn-info'>Update</button>             
          </div> 
         </div>
         </form>
      </div>
      
    </div>

  </div>
</div>
<?php
include "basic/admin_footer.php";
?>
<script>
 
function delete_feedback(id){
  if(confirm("Are you sure")){
       burl="../action/deleteFeedback.php"; 
       $.post(burl,{"id":id},function(data,status){
         window.location.reload();
       });
  }
}

 
</script>
