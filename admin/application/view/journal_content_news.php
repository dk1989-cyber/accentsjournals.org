<?php
include "basic/admin_header.php";
 
?>

<div class="mainpanel">
<div class="contentpanel">
  <?php
  extract($_REQUEST);
  $sql = "SELECT * FROM journals where journals_id='$id'";
  $stmt = $conn->query($sql);
  $row=$stmt->fetchAssociative();
  extract($row);


  ?>
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i>  <?=$journal_abbri?> - News  </a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>News  (<?=$journal_abbri?>)</h4>
        </div>
        <form action="../action/addJournalContentNews.php" method='post'  enctype='multipart/form-data'>
         <div class="panel-body" style='margin-top:10px'>
           <div class="row">
                  <div class="form-group col-md-12">
                       <label class='lbl' for="">Title</label>
                       <input type="hidden" name='id' value="<?=$id?>">
                      <input type="text" value="" name='title'  placeholder="Enter  Title" class="form-control" />
                  </div>
                  <div class="form-group col-md-12">
                      <label class='lbl' for="">Discription</label>
                       <textarea class='form-control' name="discription" id="discription" cols="30" rows="10"></textarea>
                  </div>         
          </div>
          <div class="row" style='margin-bottom:10px;margin-top:2px'>
                  <div class="form-group col-md-2">
                      <label class='lbl' for="">Image</label>
                      <input  onchange="getImg(this,news_img,'400','400');" type="file" name='news_file'   class="form-control" />
                  </div>      
          </div>
          <div class="row">
          <?php
              $journal_c="https://via.placeholder.com/200x200";
             
            ?>
            <div class="col-md-2">
              <img style='width:100%' src="<?=$journal_c?>" alt="" id='news_img'>   
            </div>
        </div>
        <div class="row">
          <div class="col-md-12">
              <hr>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12" style='margin-top:10px'>
            <button  class='btn btn-info'><b>Add News </b></button>
            <a href="journal-content-grid.php?id=<?=$id?>" class='btn btn-danger'>Back</a>
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
          <h4 class="panel-title" style='color:White'>View News of <?=$name?></h4>
        </div>
        <div class="panel-body" style='margin-top:10px'>
             <div class="row">
                <div class="col-md-12">
                <div class="table-responsive">
            <table id="dataTable1" class="table table-bordered table-striped-col">
              <thead>
                <tr>
                    <th>Logo</th>
                    <th>Title</th>
                    <th>News Discription</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                 $sql = "SELECT * FROM journals_news where journals_id='$id'";
                 $stmt = $conn->query($sql);
                 $i=1;
                while(($row=$stmt->fetchAssociative())!==false){
                    extract($row);
                ?>
                      <tr>
                        <td><?=$i?></td>
                        <td><?=$title?></td>
                        <td><?=$discription?></td>
                        <td><?=$created?></td>
                        <td><a class='btn btn-success' onclick="edit_news('<?=$journals_news_id?>')"><i class='fa fa-edit'></i></a><a class='btn btn-danger' onclick="delete_news(<?=$journals_news_id?>)"><i class='fa fa-times'></i></a></td>
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
        <h4 class="modal-title" id='title'>Edit News</h4>
      </div>
      <div class="modal-body">
      <form action="../action/updateJournalContentNews.php" method='post' enctype='multipart/form-data'>
         <div class="row">
           <div class="form-group col-md-12">
                    <input type="hidden" name='id' value="<?=$id?>">
                    <input type="hidden" name='journals_news_id' id="journals_news_id"  value="">
                    <input type="hidden" name='type' value="<?=$type?>">
                    <input type="hidden" name='t' value="<?=$t?>">
                      <label class='lbl' for="">Title</label>
                      <input class='form-control' type="text" name='etitle' id='etitle'>
           </div> 
           <div class="form-group col-md-12">
                      <label class='lbl' for="">Discription</label>
                       <textarea class='form-control' name="ediscription" id="ediscription" cols="30" rows="10"></textarea>
           </div> 
           <div class="form-group col-md-12">
                      <label class='lbl' for="">Image</label>
                      <input  onchange="getImg(this,enews_img,'400','400');" type="file" name='enews_file'   class="form-control" />
           </div>      
           <div class="form-group col-md-12">
                    <img src="" id='enews_img' style="width:300px" alt="">
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
function edit_news(id){
   burl="../ajax/get_journals_news.php"; 
   $.post(burl,{"id":id},function(data,status){
    obj=JSON.parse(data);
    $("#etitle").val(obj['title']);
    $("#ediscription").val(obj['discription']);
    $("#journals_news_id").val(id);
    if(obj['image']!=""){
        $("#enews_img").attr("src","../../../upload/journal_content/news/"+obj["image"]);
    }
    else{
        $("#enews_img").attr("src","https://via.placeholder.com/200x200");
    }
    $("#myModal").modal('show');
   }); 
}

function delete_news(id){
  if(confirm("Are you sure")){
       burl="../action/deleteNews.php"; 
       $.post(burl,{"id":id},function(data,status){
         window.location.reload();
       });
  }
}
</script>
