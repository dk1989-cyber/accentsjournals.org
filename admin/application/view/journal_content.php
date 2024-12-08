<?php
include "basic/admin_header.php";
 
?>

<div class="mainpanel">
<div class="contentpanel">
  <?php
  extract($_REQUEST);

  $sql = "SELECT jc.*,fm.menu_name,j.journals_id,j.name,j.journal_abbri FROM journal_content jc
  LEFT JOIN front_menu fm ON jc.front_menu_id=fm.front_menu_id
  LEFT JOIN journals j ON jc.journals_id=j.journals_id
  where jc.journals_id='$id' and jc.type='$type'";

 
  $stmt = $conn->query($sql);
  $row=$stmt->fetchAssociative();

  if(is_array($row)){
  extract($row);
  ?>
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i>  <?=$journal_abbri?> -  </a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'><?=$menu_name?> - (<?=$journal_abbri?>)</h4>
        </div>
        <form action="../action/actionJournalContent.php" method='post'  enctype='multipart/form-data'>
         <div class="panel-body" style='margin-top:10px'>
           <div class="row">
               <div class="form-group col-md-12">
                      <label class='lbl' for="">Discription</label>
                    
                      <input type="hidden" name='journals_id' value="<?=$id?>">
                      <input type="hidden" name='type' value="<?=$type?>">
                      <input type="hidden" name='action' value="Edit">
                       <textarea class='form-control' name="discription" id="discription" cols="30" rows="10"><?=$discription?></textarea>
                  </div>         
           </div>
          <div class="row" style='margin-bottom:10px;margin-top:10px'>
                  <div class="form-group col-md-2">
                      <label class='lbl' for="">Image</label>
                      <input  onchange="getImg(this,img_img,'400','400');" type="file" name='img_file'  id='img_file'  class="form-control" />
                  </div>      
          </div>
          <div class="row">
          <?php
            if($image!=""){
                $journal_c="../../../upload/journal_content/$image";
                $img=urlencode($image);
                $lbl="<a style='float:right;font-size:15px;cursor:pointer' onclick=remove_img($id,'$type','$img')><i class='fa fa-times'></i></a>";
            }
            else{
                $journal_c="https://via.placeholder.com/200x200";
                $lbl="";
            }
            ?>
            <div class="col-md-2">
              <?=$lbl?>
              <img style='width:100%' src="<?=$journal_c?>" alt="" id='img_img'>   
            </div>
        </div>
        <div class="row">
          <div class="col-md-12">
              <hr>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12" style='margin-top:10px'>
            <button  class='btn btn-success'><b>UPDATE <?=$menu_name?></b></button>
            <a href="journal_content_grid.php?id=<?=$id?>" class='btn btn-danger'>Back</a>
            </div>
        </div>
       </div><!-- panel -->
      </form>
     </div>
    </div><!-- col-sm-6 -->
  </div><!-- row -->
  <?php
  }else{
    $q="select fm.*,j.* from front_menu fm 
    LEFT JOIN journals j ON fm.journals_id=j.journals_id where fm.type='$type' and 
    j.journals_id='$id'";
    $stmt = $conn->query($q);
    $row=$stmt->fetchAssociative();
    extract($row);  
  ?>
 <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i>  <?=$journal_abbri?> -  </a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'><?=$menu_name?> - (<?=$journal_abbri?>)</h4>
        </div>
        <form action="../action/actionJournalContent.php" method='post'  enctype='multipart/form-data'>
         <div class="panel-body" style='margin-top:10px'>
           <div class="row">
                   <input type="hidden" name='journals_id' value="<?=$id?>">
                   <input type="hidden" name='front_menu_id' value="<?=$front_menu_id?>">
                   <input type="hidden" name='type' value="<?=$type?>">
                   <input type="hidden" name='action' value="ADD">
                  <!-- <div class="form-group col-md-12">
                      <label class='lbl' for="">Title</label>
                      <input type="text" name='title' placeholder="Enter  <?=$menu_name?> " class="form-control" />
                  </div> -->
                  <div class="form-group col-md-12">
                      <label class='lbl' for="">Discription</label>
                       <textarea class='form-control' name="discription" id="discription" cols="30" rows="10"></textarea>
                  </div>         
          </div>
          <div class="row" style='margin-bottom:10px;margin-top:2px'>
                  <div class="form-group col-md-2">
                      <label class='lbl' for="">Image</label>
                      <input  onchange="getImg(this,img_img,'400','400');" type="file" name='img_file'   class="form-control" />
                  </div>      
          </div>
          <div class="row">
            <div class="col-md-2">
              <img style='width:100%' src="https://via.placeholder.com/200x200" alt="" id='img_img'>   
            </div>
        </div>
        <div class="row">
          <div class="col-md-12">
              <hr>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12" style='margin-top:10px'>
            <button  class='btn btn-info'>Add <?=$menu_name?></button>
            <a href="journal_content_grid.php?id=<?=$id?>" class='btn btn-danger'>Back</a>
            </div>
        </div>
       </div><!-- panel -->
      </form>
     </div>
    </div><!-- col-sm-6 -->
  </div><!-- row -->
  <?php
  }
  ?>
</div><!-- contentpanel -->
</div><!-- mainpanel -->
</section>
<?php
include "basic/admin_footer.php";
?> 
<script src="<?=base_url('admin/ckeditor/ckeditor.js')?>" ></script>

<script>
   CKEDITOR.replace( 'discription' );      
    


   function remove_img(id,type,img){

    if(confirm("Are you sure")){
      burl="../ajax/removeContentImg.php";
       $.post(burl,{"id":id,"type":type,"img":img},function(data,status){
        window.location.reload();
      });
  } 
  }

 
   
</script>