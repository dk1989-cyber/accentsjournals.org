<?php
include "basic/admin_header.php";
 
?>

<div class="mainpanel">
<div class="contentpanel">
  
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i> Menu</a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Menu</h4>
        </div>
        <form action="../action/adFrontTempMenu.php" method='post'  enctype='multipart/form-data'>
         <div class="panel-body" style='margin-top:10px'>
           <div class="row">
                  <div class="form-group col-md-3">
                       <label class='lbl' for="">Menu Name</label>
                       <input type="text" value="" name='menu_name'  placeholder="Enter Menu Name" class="form-control" />
                  </div>

                  <div class="form-group col-md-9">
                       <label class='lbl' for="">Menu Url Front</label>
                       <input type="text" value="" name='menu_url'  placeholder="Enter Menu Url" class="form-control" />
                  </div>

                  <div class="form-group col-md-8">
                       <label class='lbl' for="">Menu Url Backend</label>
                       <input type="text" value="" name='menu_url_back'  placeholder="Enter Menu Backend Url" class="form-control" />
                  </div>

                  <div class="form-group col-md-2">
                       <label class='lbl' for="">Manu Type</label>
                       <select class='form-control' name="menu_type" id="menu_type">
                           <option value="GENERAL">GENERAL</option>
                           <option value="SPECIAL">SPECIAL</option>
                       </select>
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
          <h4 class="panel-title" style='color:White'>View Menu </h4>
        </div>
        <div class="panel-body" style='margin-top:10px'>
             <div class="row">
                <div class="col-md-12">
             <div class="table-responsive">
            <table id="dataTable1" class="table table-bordered table-striped-col">
              <thead>
                <tr>
                    <th>Sr.no</th>
                    <th>Menu </th>
                    <th>Front Url </th>
                    <th>Back Url</th>
                    <th style='width:8%'>Order By</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                 $sql = "SELECT * FROM temp_front_menu order by `order_b` ";
                 $stmt = $conn->query($sql);
                 $i=1;
                 $rows=$stmt->fetchAll();
                 $cnt=count($rows);
                 for($j=0;$j<$cnt;$j++){   
                    $temp_front_menu_id=$rows[$j]["temp_front_menu_id"];
                    $order_b=$rows[$j]["order_b"];
                    $menu_name=$rows[$j]["menu_name"];
                    $menu_url=$rows[$j]["menu_url"];
                    $menu_url_back=$rows[$j]["menu_url_back"];
                    $status=$rows[$j]["status"];
                    $menu_type=$rows[$j]["menu_type"];
  
                    if($i==1){
                     $ordr="<a onclick=sort($temp_front_menu_id,'DOWN',$order_b) class='btn btn-danger btn-sm'><i class='fa fa-arrow-down'></i></a>";
                    }
                    elseif($i==$cnt){
                      $ordr="<a onclick=sort($temp_front_menu_id,'UP',$order_b) class='btn btn-success btn-sm'><i class='fa fa-arrow-up'></i></a></a>";
                    }
                    else{
                      $ordr="<a onclick=sort($temp_front_menu_id,'UP',$order_b)  class='btn btn-success btn-sm'><i class='fa fa-arrow-up'></i></a><a onclick=sort($temp_front_menu_id,'DOWN',$order_b)  class='btn btn-danger btn-sm'><i class='fa fa-arrow-down'></i></a>";
                    }
                    ?>
                      <tr>
                        <td style='width:5%'><?=$i?></td>
                        <td><?=$menu_name?></td>
                        <td><?=$menu_url?></td>
                        <td><?=$menu_url_back?></td>
                        <td style='text-align:center'><?=$ordr?></td>
                        <td style='width:10%'><?=$status?></td>
                        <td style='width:10%'><a class='btn btn-success btn-sm' onclick="edit_menu(<?=$temp_front_menu_id?>,'<?=$menu_name?>','<?=$menu_url?>','<?=$menu_url_back?>','<?=$order_b?>','<?=$status?>','<?=$menu_type?>')"><i class='fa fa-edit'></i></a><a class='btn btn-sm btn-danger' onclick="delete_menu(<?=$temp_front_menu_id?>)"><i class='fa fa-trash'></i></a></td>
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
        <h4 class="modal-title" id='title'>Edit  Menu</h4>
      </div>
      <div class="modal-body">
      <form action="../action/updateFrontTempemenu.php" method='post' enctype='multipart/form-data'>
         <div class="row">
           <div class="form-group col-md-6">  
                     <input type="hidden" name='temp_front_menu_id' id="temp_front_menu_id"  value="">
                      <label class='lbl' for=""> Menu Name</label>
                     <input class='form-control' type="text" name='emenu_name' id='emenu_name'>
           </div> 
           <div class="form-group col-md-2">  
                      <label class='lbl' for=""> Order</label>
                     <input class='form-control' type="text" name='eorder_b' id='eorder_b'>
           </div> 
           <div class="form-group col-md-2">
                      <label class='lbl' for="">Status</label>
                      <select class='form-control' name="estatus" id="estatus">
                            <option value="Enable">Enable</option>
                            <option value="Disable">Disable</option>
                      </select>
           </div> 
           <div class="form-group col-md-2">
                       <label class='lbl' for="">Manu Type</label>
                       <select class='form-control' name="emenu_type" id="emenu_type">
                           <option value="GENERAL">GENERAL</option>
                           <option value="SPECIAL">SPECIAL</option>
                       </select>
            </div> 
           <div class="form-group col-md-12">  
                      <label class='lbl' for=""> Menu Url</label>
                     <input class='form-control' type="text" name='emenu_url' id='emenu_url'>
           </div>
           <div class="form-group col-md-12">  
                      <label class='lbl' for=""> Menu Url Backend</label>
                     <input class='form-control' type="text" name='emenu_url_back' id='emenu_url_back'>
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
function edit_menu(id,menu,url,url_back,order_b,status,menu_type){
    $("#temp_front_menu_id").val(id);
    $("#emenu_name").val(menu);
    $("#emenu_url").val(url);
    $("#emenu_url_back").val(url_back)
    $("#eorder_b").val(order_b);
    $("#emenu_type").val(menu_type);
    $("#estatus").val(status)
    $("#myModal").modal('show');
}
function delete_menu(id){
  if(confirm("Are you sure")){
       burl="../action/deleteFrontTempMenu.php"; 
       $.post(burl,{"id":id},function(data,status){
         window.location.reload();
       });
  }
}


function sort(id,ordr,pos){
  var burl="../action/sortFrontTempMenu.php";
  $.post(burl,{"id":id,"ordr":ordr,"order_b":pos},function(data,status){
   window.location.reload();
  });
}
 
$(document).ready(function() {
  'use strict';
  $('#dataTable1').DataTable();
});

</script>
