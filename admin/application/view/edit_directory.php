<?php
include "basic/admin_header.php";
extract($_REQUEST);
$sql = "select i.*,j.* from issue i LEFT JOIN journals j ON i.journals_id=j.journals_id WHERE i.issue_id=$id";
$stmt = $conn->query($sql);
$row=$stmt->fetchAssociative();
extract($row);

?>


<div class="mainpanel">
<div class="contentpanel">
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i> Edit Journal Directory (Issue)</a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Journal Directory</h4>
        </div>
        <form action="../action/updateDirectory.php" method='post'  enctype='multipart/form-data'>
        <div class="panel-body" style='margin-top:10px'>
        <div class="row">
                <div class="form-group col-md-4">
                    <label class='lbl' for="">Journal Name <span class='req'>*</span></label><br/>
                    <label for=""><?=$name?></label>
                    <input type="hidden" name='id' id='id' value='<?=$issue_id?>'>
                    <input type="hidden" name='year' id='year' value='<?=$year?>'>
                    <input type="hidden" name='month' id='month' value='<?=$month?>'>
                    <input type="hidden" name='abbri' id='abbri' value='<?=$journal_abbri?>'>
                    <input type="hidden" name='journals_id' id='journals_id' value="<?=$journals_id?>">
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Year <span class='req'>*</span></label><br/>
                   <label for=""><?=$year?></label>
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Month <span class='req'>*</span></label><br/>
                    <label for=""><?=get_month($month)?></label>
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Volume <span class='req'>*</span></label><br/>
                    <input required readonly type="text" value="<?=$volume?>" name='volume' id='volume' placeholder="Enter  Volume " class="form-control" />    
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Issue <span class='req'>*</span></label><br/>
                    <input required readonly type="text"  value="<?=$issue?>" name='issue'  id='issue' placeholder="Enter  Issue " class="form-control" />
                </div>

                <div class="form-group col-md-12">
                    <?php
                      $m=$month+1;
                      $url=base_url("PaperDirectory/journal/$journal_abbri/$year/$m/");
                    ?>
                    <label class='lbl' for="">Directory Path <span class='req'>*</span></label><br/>
                    <input readonly  value="<?=$url?>"    class="form-control" />    
                </div>
        </div>
        <div class="row" style='margin-top:10px'>  
                <div class="form-group col-md-12">
                    <label class='lbl' for="">Content</label>
                    <textarea class='form-control' name="content" id="content" cols="30" rows="10"><?=$content?></textarea>
               </div>
        </div>
        <div class="row" style='margin-top:10px'>  
                <div class="form-group col-md-12">
                   <input <?=($is_msgbox==1)?"checked":""?> name='is_msgchk' type="checkbox" onclick='is_chk()' id='is_msgchk' ><label  class='lbl' for="is_msgchk">Message Box</label>
                   <textarea <?=($is_msgbox!=1)?"disabled":""?> class='form-control' name="message_box" id="messsage_box" cols="30" rows="10"><?=$message_box?></textarea>
               </div>
        </div>
        <div class="row" style='margin-top:30px'>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Cover Image</label>
                    <input type="file" name="cover_image"  id="cover_image"  class="form-control"   onchange="getImg(this,cover_img_img,'400','400');" />
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Mode <span class='req'>*</span></label><br/>
                    <input required type="radio" name='chk_mode' id='mode_regular'  <?=($mode=="Regular")?"checked":''?>   value='Regular'><label  for='mode_regular' for="">Regular</label>
                    <input required type="radio" name='chk_mode' id='mode_special'  <?=($mode=="Special")?"checked":''?>   value='Special'><label  for='mode_special' for="">Special</label>
                    <input required type="radio" name='chk_mode' id='mode_mix'      <?=($mode=="Mix")?"checked":''?>   value='Mix'><label  for='mode_mix' for="">Mix</label>
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Message Box Type <span class='req'></span> </label><br/>
                    <?php
                    if($is_msgbox==1){
                    ?>
                    <input class='msgtype' required type="radio" name='chk_type' id='message_regular'    <?=($message_box_type=="Rotate")?"checked":''?>   value='Rotate'><label  for='message_regular' for="">Rotate</label>
                    <input class='msgtype'  required  type="radio" name='chk_type' id='message_special'   <?=($message_box_type=="Fixed")?"checked":''?>  value='Fixed'><label  for='message_special' for="">Fixed</label>
                    <?php
                    }else{
                    ?>
                    <input class='msgtype' disabled   type="radio" name='chk_type' id='message_regular'    <?=($message_box_type=="Rotate")?"checked":''?>   value='Rotate'><label  for='message_regular' for="">Rotate</label>
                    <input class='msgtype' disabled   type="radio" name='chk_type' id='message_special'   <?=($message_box_type=="Fixed")?"checked":''?>  value='Fixed'><label  for='message_special' for="">Fixed</label>
                    <?php
                    }
                    ?>
                </div>

                <div class="form-group col-md-2">
                    <label class='lbl' for="is_discipline">Discipline</label><br/>
                    <input  type="checkbox" name='is_discipline' id='is_discipline' <?=($is_discipline==1)?"checked":""?> value='Yes'><label  for='is_discipline' for="">Yes</label>
                </div>
               
        </div>
        <div class="row">
          <div class="col-md-2">
            <?php
           
        
             if($issue_cover_image!=""){
                $path="../../../PaperDirectory/Journal/$journal_abbri/$year/$m/$issue_cover_image";
             }
             else{
                $path="https://via.placeholder.com/200x200";
             }
            
            ?>
            <img style='width:200px' src="<?=$path?>" alt="" id='cover_img_img'>  
          </div>

       </div>
      <div class="row">
        <div class="col-md-12">
             <hr>
        </div>
      </div>
       <div class="row">
           <div class="col-md-12" style='margin-top:10px'>
           <button   class='btn btn-info'>Update</button>
           </div>
       </div> 
      </div>
    </div><!-- panel -->
    </form>
    </div><!-- col-sm-6 -->
    <!-- ####################################################### -->
  </div><!-- row -->
</div><!-- contentpanel -->
</div><!-- mainpanel -->
</section>
<?php
include "basic/admin_footer.php";
?>
<script>
  function is_chk(){
  isChecked = $("#is_msgchk").is(":checked");
  if(isChecked){
    $("#messsage_box").removeAttr("disabled");
    $(".msgtype").removeAttr("disabled");
  }
  else{
    $(".msgtype").attr("disabled","disabled");
    $("#messsage_box").attr("disabled","disabled");
  }
}
</script>