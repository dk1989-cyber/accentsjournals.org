<?php
include "basic/admin_header.php";
 
?>

<div class="mainpanel">
<div class="contentpanel">
  
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i>Article Type</a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Article Type</h4>
        </div>
        <form action="../action/adArticleType.php" method='post'  enctype='multipart/form-data'>
         <div class="panel-body" style='margin-top:10px'>
           <div class="row">
                  <div class="form-group col-md-10">
                       <label class='lbl' for="">Title</label>
                       <input type="text" value="" name='article_type'  placeholder="Enter Article Type" class="form-control" />
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
          <h4 class="panel-title" style='color:White'>View Article Type</h4>
        </div>
        <div class="panel-body" style='margin-top:10px'>
             <div class="row">
                <div class="col-md-12">
                <div class="table-responsive">
            <table id="dataTable1" class="table table-bordered table-striped-col">
              <thead>
                <tr>
                    <th>Sr.no</th>
                    <th>Article Type</th>
                    <th style='width:8%'>Order By</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                 $sql = "SELECT * FROM article_type order by `order_b` ";
                 $stmt = $conn->query($sql);
                 $i=1;
                while(($row=$stmt->fetchAssociative())!==false){
                    $cnt=count($row)-1;
                    extract($row);
                    if($i==1){
                     $ordr="<a onclick=sort($article_type_id,'DOWN',$order_b) class='btn btn-danger btn-sm'><i class='fa fa-arrow-down'></i></a>";
                    }
                    elseif($i==$cnt){
                      $ordr="<a onclick=sort($article_type_id,'UP',$order_b) class='btn btn-success btn-sm'><i class='fa fa-arrow-up'></i></a></a>";
                    }
                    else{
                      $ordr="<a onclick=sort($article_type_id,'UP',$order_b)  class='btn btn-success btn-sm'><i class='fa fa-arrow-up'></i></a><a onclick=sort($article_type_id,'DOWN',$order_b)  class='btn btn-danger btn-sm'><i class='fa fa-arrow-down'></i></a>";
                    }
                ?>
                      <tr>
                        <td style='width:5%'><?=$i?></td>
                        <td><?=$article_type?></td>
                        <td style='text-align:center'><?=$ordr?></td>
                        <td style='width:10%'><?=$status?></td>
                        <td style='width:10%'><a class='btn btn-success btn-sm' onclick="edit_article_type(<?=$article_type_id?>,'<?=$article_type?>','<?=$status?>')"><i class='fa fa-edit'></i></a><a class='btn btn-sm btn-danger' onclick="delete_article_type(<?=$article_type_id?>)"><i class='fa fa-trash'></i></a></td>
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
        <h4 class="modal-title" id='title'>Edit Article Type</h4>
      </div>
      <div class="modal-body">
      <form action="../action/updateArticleType.php" method='post' enctype='multipart/form-data'>
         <div class="row">
           <div class="form-group col-md-10">  
                     <input type="hidden" name='article_type_id' id="article_type_id"  value="">
                      <label class='lbl' for="">Article Type</label>
                     <input class='form-control' type="text" name='earticle_type' id='earticle_type'>
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
function edit_article_type(id,article,status){
    $("#article_type_id").val(id);
    $("#earticle_type").val(article);
    $("#estatus").val(status)
    $("#myModal").modal('show');
}
function delete_article_type(id){
  if(confirm("Are you sure")){
       burl="../action/deleteArticleType.php"; 
       $.post(burl,{"id":id},function(data,status){
         window.location.reload();
       });
  }
}

function sort(id,ordr,pos){
  var burl="../action/sortArticleType.php";
  $.post(burl,{"id":id,"ordr":ordr,"order_b":pos},function(data,status){
   window.location.reload();
  });
}
 
</script>
