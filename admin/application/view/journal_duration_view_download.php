<?php
include "basic/admin_header.php";
 
 

?>

<div class="mainpanel">
<div class="contentpanel">
  <?php
  extract($_REQUEST);
  $sql = "SELECT * FROM journals where journals_id='$journals_id'";
  $stmt = $conn->query($sql);
  $row=$stmt->fetchAssociative();
  extract($row);
  
  ?>
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i> Range Duration <?=$journal_abbri?>   </a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'><?=$name?>  (<?=$journal_abbri?>)</h4>
        </div>
        <form action="../action/updateJournalRangeDuration.php" method='post'  >
         <div class="panel-body" style='margin-top:10px'>
           <div class="row" style='padding:10px'>
                   <div class="form-group col-md-2">
                    <input type="hidden" name='id' value="<?=$journals_id?>">
                   <label class='lbl' style='margin-top:25px;font-size:18px' for="">View Range :</label>
                  </div>   
                  <div class="form-group col-md-3" >
                      <label class='lbl' for="">From</label>
                      <input class='form-control' type="date" value="<?=date('Y-m-d',strtotime($view_range_from))?>" name='view_range_from' >
                  </div>   

                  <div class="form-group col-md-3">
                      <label class='lbl' for="">To</label>
                      <input  class='form-control' type="date" name='view_range_to'  value="<?=date('Y-m-d',strtotime($view_range_to))?>" >
                  </div>   
             </div>

               <div class="row" style='padding:10px'>>
                   <div class="form-group col-md-2">
                      <label class='lbl' style='margin-top:25px;font-size:18px' for="">Download Range :</label>
                  </div>   
                  <div class="form-group col-md-3">
                      <label class='lbl' for="">From</label>
                      <input class='form-control' type="date" name='download_range_from' value="<?=date('Y-m-d',strtotime($download_range_from))?>"  >
                  </div>   

                  <div class="form-group col-md-3">
                      <label class='lbl' for="">To</label>
                      <input  class='form-control' type="date" name='download_range_to'  value="<?=date('Y-m-d',strtotime($download_range_to))?>"  >
                  </div>   
             </div>
             <div class="form-group col-md-6">
                    <label class='lbl' for="">Latest Information<span class='req'>*</span></label>
                    <textarea  required class='form-control' name="latest_info" id="latest_info" cols="30" rows="10"><?=$latest_info?></textarea>
                </div>

                <div class="form-group col-md-6">
                    <label class='lbl' for="">Article Press Information<span class='req'>*</span></label>
                    <textarea  required class='form-control' name="article_press_info" id="article_press_info" cols="30" rows="10"><?=$article_press_info?></textarea>
                </div>

                <div class="form-group col-md-6">
                    <label class='lbl' for="">Most Downloaded Information<span class='req'>*</span></label>
                    <textarea  required class='form-control' name="most_download_info" id="most_download_info" cols="30" rows="10"><?=$most_download_info?></textarea>
                </div>

                <div class="form-group col-md-6">
                    <label class='lbl' for="">Most View Information<span class='req'>*</span></label>
                    <textarea  required class='form-control' name="most_view_info" id="most_view_info" cols="30" rows="10"><?=$most_view_info?></textarea>
                </div>

                <div class="form-group col-md-12">
                    <label class='lbl' for="">Most Cite Information<span class='req'>*</span></label>
                    <textarea  required class='form-control' name="most_cite_info" id="most_cite_info" cols="30" rows="10"><?=$most_cite_info?></textarea>
                </div>
         <div class="row">
          <div class="col-md-12">
              <hr>
          </div>
          <div class="col-md-12" style='margin-top:10px;'>
            <button  class='btn btn-success'><b>UPDATE  </b></button>
            <a href="dashboard.php" class='btn btn-danger'>Back</a>
            </div>
        </div>
         
       </div><!-- panel -->
      </form>
     </div>
    </div><!-- col-sm-6 -->
  </div><!-- row -->
 
</div><!-- contentpanel -->
</div><!-- mainpanel -->
</section>
<?php
include "basic/admin_footer.php";
?> 
 