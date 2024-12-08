<?php
include "basic/admin_header.php";
 
?>

<div class="mainpanel">
<div class="contentpanel">
  
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i>Discipline </a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Discipline</h4>
        </div>
        <form action="../action/adDiscipline.php" method='post'  >
         <div class="panel-body" style='margin-top:10px'>
           <div class="row">
                  <div class="form-group col-md-10">
                       <label class='lbl' for="">Discipline</label>
                       <input type="text" value="" name='discipline'  placeholder="Enter Discipline" class="form-control" />
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
          <h4 class="panel-title" style='color:White'>View Discipline</h4>
        </div>
        <div class="panel-body" style='margin-top:10px'>
             <div class="row">
                <div class="col-md-12">
                <div class="table-responsive">
            <table id="dataTable1" class="table table-bordered table-striped-col">
              <thead>
                <tr>
                    <th>Srno</th>
                    <th>Discipline</th>
                    <th style='width:10%'>Status</th>
                    <th style='width:10%'>Order</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                 $sql = "SELECT * FROM discipline order by order_b";
                 $stmt = $conn->query($sql);
                 $i=1;
                 $rows=$stmt->fetchAll();
                 $cnt=count($rows);
                 for($j=0;$j<$cnt;$j++){
                    $discipline_id=$rows[$j]['discipline_id'];
                    $order_b=$rows[$j]['order_b'];
                    $status=$rows[$j]['status'];
                    $discipline=$rows[$j]['discipline'];
                    if($i==1){
                      $ordr="<a onclick=sort($discipline_id,'DOWN',$order_b) class='btn btn-danger btn-sm'><i class='fa fa-arrow-down'></i></a>";
                     }
                     elseif($i==$cnt){
                       $ordr="<a onclick=sort($discipline_id,'UP',$order_b) class='btn btn-success btn-sm'><i class='fa fa-arrow-up'></i></a></a>";
                     }
                     else{
                       $ordr="<a onclick=sort($discipline_id,'UP',$order_b)  class='btn btn-success btn-sm'><i class='fa fa-arrow-up'></i></a><a onclick=sort($discipline_id,'down',$order_b)  class='btn btn-danger btn-sm'><i class='fa fa-arrow-down'></i></a>";
                     }
                ?>
                      <tr>
                        <td style='width:5%'><?=$i?></td>
                        <td><?=$discipline?></td>
                        <td><?=$status?></td>
                        <td style='text-align:center'><?=$ordr?></td>
                        <td style='width:10%'><a class='btn btn-success btn-sm' onclick="edit_discipline(<?=$discipline_id?>,'<?=$discipline?>','<?=$status?>')"><i class='fa fa-edit'></i></a><a class='btn  btn-danger btn-sm' onclick="delete_discipline(<?=$discipline_id?>)"><i class='fa fa-trash'></i></a></td>
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
        <h4 class="modal-title" id='title'>Edit Discipline</h4>
      </div>
      <div class="modal-body">
      <form action="../action/updateDiscipline.php" method='post' enctype='multipart/form-data'>
         <div class="row">
           <div class="form-group col-md-10">  
                     <input type="hidden" name='discipline_id' id="discipline_id"  value="">
                      <label class='lbl' for="">Discipline</label>
                     <input class='form-control' type="text" name='ediscipline' id='ediscipline'>
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
function edit_discipline(id,dis,status){
    $("#discipline_id").val(id);
    $("#ediscipline").val(dis);
    $("#estatus").val(status)
    $("#myModal").modal('show');
}
function delete_discipline(id){
  if(confirm("Are you sure")){
       burl="../action/deleteDiscipline.php"; 
       $.post(burl,{"id":id},function(data,status){
         window.location.reload();
       });
  }
}

function sort(id,ordr,pos){
  var burl="../action/sortDecipline.php";
  $.post(burl,{"id":id,"ordr":ordr,"order_b":pos},function(data,status){
    window.location.reload();
  });
}


</script>
