<?php
include "basic/admin_header.php";
 
?>

<div class="mainpanel">
<div class="contentpanel">
  
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i>Designation</a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Designation</h4>
        </div>
        <form action="../action/adDesignation.php" method='post'  enctype='multipart/form-data'>
         <div class="panel-body" style='margin-top:10px'>
           <div class="row">
                  <div class="form-group col-md-10">
                       <label class='lbl' for="">Designation</label>
                       <input type="text" value="" name='designation'  placeholder="Enter Designation" class="form-control" />
                  </div>
                  <div class="form-group col-md-2">
                       <label class='lbl' for="">Status</label>
                       <select class='form-control' name="status" id="status">
                           <option value="Enable">Enable</option>
                           <option value="Disable">Disable</option>
                       </select>
                  </div>
          </div>
         
          
        <div class="row">
          <div class="col-md-12">
              <hr>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12" style='margin-top:10px'>
           
            <a href="#" class='btn btn-danger'>Back</a>
            <button  class='btn btn-info'><b>Add</b></button>
            </div>
        </div>
       </div><!-- panel -->
      </form>
     </div>
    </div><!-- col-sm-6 -->
  </div><!-- row -->
  <?php

  ?>
   <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>View Designation </h4>
        </div>
        <div class="panel-body" style='margin-top:10px'>
             <div class="row">
                <div class="col-md-12">
                <div class="table-responsive">
            <table id="dataTable1" class="table table-bordered table-striped-col">
              <thead>
                <tr>
                    <th style='width:6%'>Srno</th>
                    <th>Designation</th>
                    <th style='width:10%'>Status</th>
                    <th style='width:10%'>Order</th>
                    <th style='width:10%'>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                 $sql = "SELECT * FROM designation order by order_b";
                 $stmt = $conn->query($sql);
                 $i=1;
                 $rows=$stmt->fetchAll();
                 $cnt=count($rows);
                 for($j=0;$j<$cnt;$j++){
                    $designation_id=$rows[$j]['designation_id'];
                    $order_b=$rows[$j]['order_b'];
                    $status=$rows[$j]['status'];
                    $designation=$rows[$j]['designation'];
                    if($i==1){
                      $ordr="<a onclick=sort($designation_id,'DOWN',$order_b) class='btn btn-danger btn-sm'><i class='fa fa-arrow-down'></i></a>";
                     }
                     elseif($i==$cnt){
                       $ordr="<a onclick=sort($designation_id,'UP',$order_b) class='btn btn-success btn-sm'>$i<i class='fa fa-arrow-up'></i></a></a>";
                     }
                     else{
                       $ordr="<a onclick=sort($designation_id,'UP',$order_b)  class='btn btn-success btn-sm'><i class='fa fa-arrow-up'></i></a><a onclick=sort($designation_id,'down',$order_b)  class='btn btn-danger btn-sm'><i class='fa fa-arrow-down'></i></a>";
                     }
                ?>
                      <tr>
                        <td><?=$i?></td>
                        <td><?=$designation?></td>
                        <td><?=$status?></td>
                        <td><?=$ordr?></td>
                        <td><a onclick="edit_designation(<?=$designation_id?>,'<?=$designation?>','<?=$status?>')">Edit</a><a onclick="delete_designation(<?=$designation_id?>)">Delete</a></td>
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
        <h4 class="modal-title" id='title'>Edit Designation </h4>
      </div>
      <div class="modal-body">
      <form action="../action/updateDesignation.php" method='post' enctype='multipart/form-data'>
         <div class="row">
           <div class="form-group col-md-10">  
                     <input type="hidden" name='designation_id' id="designation_id"  value="">
                      <label class='lbl' for="">designation</label>
                     <input class='form-control' type="text" name='edesignation' id='edesignation'>
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
function edit_designation(id,dep,status){
    $("#designation_id").val(id);
    $("#edesignation").val(dep);
    $("#estatus").val(status)
    $("#myModal").modal('show');
}

function delete_designation(id){
  if(confirm("Are you sure")){
       burl="../action/deleteDesignation.php"; 
       $.post(burl,{"id":id},function(data,status){
         window.location.reload();
       });
  }
}

function sort(id,ordr,pos){
  var burl="../action/sortdesignation.php";
  $.post(burl,{"id":id,"ordr":ordr,"order_b":pos},function(data,status){
   window.location.reload();
  });
}
</script>
