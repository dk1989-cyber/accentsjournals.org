 
<?php
session_start();
require_once '../../../vendor/autoload.php';
require_once "../../../config/config.php";
extract($_REQUEST);
$cnt=$authors;
$desig_array=array();
$dep_array=array();

if($type=="add"){
$sql3 = "SELECT * FROM department  order by order_b";
$stmt = $conn->query($sql3);
$i=1;
while(($row=$stmt->fetchAssociative())!==false){
    extract($row);
    array_push($dep_array,array("department_id"=>$department_id,"department"=>$department));

}

$sql4 = "SELECT * FROM designation order by order_b";
$stmt = $conn->query($sql4);
$i=1;
while(($row=$stmt->fetchAssociative())!==false){
    extract($row);
    array_push($desig_array,array("designation_id"=>$designation_id,"designation"=>$designation));
}
for($i=1;$i<=$cnt;$i++){
?>
<div class="row" style='padding:10px;border:1px solid black;margin:10px;background-color:#efefef;'>
   <div class="col-md-12"  style="margin-left:-5px;margin-bottom:10px">
      <label class='btn btn-success btn-sm lb-button' onclick="set_corresponding(<?=$i?>,<?=$cnt?>)" id="lbl_cor_<?=$i?>" style='margin-left:5px' for="is_corresponding_<?=$i?>">    <input <?=($i==1)?"checked":"disabled"?> type="checkbox" class='corresponding' id='is_corresponding_<?=$i?>' name="is_corresponding[]"/> Is Corresponding</label>
   </div>
   <div class="col-md-3" style='margin-bottom:5px'>
        <label class='lbl' for="">First Name <span style='color:red' class='error'>*</span></label>
        <input autocomplete="off" type="text" name='first_name[]' id='first_name_<?=$i?>' placeholder="Enter  First Name" class="form-control names" />
        <label id='error_first_name_<?=$i?>'></label>
   </div>
   <div class="col-md-3"  style='margin-bottom:5px'>
        <label class='lbl' for="">Middle Name</label>
        <input autocomplete="off" type="text" name='middle_name[]' id='middle_name_<?=$i?>' placeholder="Enter  Middle Name" class="form-control names" />
        <label id='error_middle_name_<?=$i?>'></label>
   </div>
   <div class="col-md-3"  style='margin-bottom:5px'>
        <label class='lbl' for="">Last Name</label>
        <input autocomplete="off" type="text" name='last_name[]' id='last_name_<?=$i?>' placeholder="Enter  Last Name" class="form-control names" />
        <label id='error_last_name_<?=$i?>'></label>
   </div>
   <div class="col-md-3" style='margin-bottom:25px'>
   <label class='lbl' for="">Designation</label>
        <select class='form-control' name="designation[]" id="designation_<?=$i?>">
         <?php
           for($k=0;$k<count($desig_array);$k++){
            ?>
           <option <?=($designation_id==$desig_array[$k]["designation_id"])?"checked":""?>  value="<?=$desig_array[$k]["designation_id"]?>"><?=$desig_array[$k]["designation"]?></option>
            <?php
           }
         ?>
      </select>
   </div>
   <div class="col-md-3"  style='margin-bottom:5px'>
        <label class='lbl' for="">Department</label>
        <select class='form-control' name="department[]" id="department_<?=$i?>">
         <?php
           for($k=0;$k<count($dep_array);$k++){
            ?>
           <option value="<?=$dep_array[$k]["department_id"]?>"><?=$dep_array[$k]["department"]?></option>
            <?php
           }
         ?>
         </select>
   </div>
   <div class="col-md-3"  style='margin-bottom:5px'>
        <label class='lbl' for="">Orcid</label>
        <input type="text" name='orcid[]'   placeholder="Enter  Orcid " class="form-control" />
   </div>
   <div class="col-md-3"  style='margin-bottom:5px'>
        <label class='lbl' for="">University <span style='color:red' class='error'>*</span> <a onclick='show_modal(<?=$i?>);'><i class='fa fa-plus'></i>Add University</a></label>
        <select required  class='form-control univerlist select' name="university[]" id="university_<?=$i?>">
        </select>
   </div>
   <div class="col-md-3"  style='margin-bottom:5px'>
        <label class='lbl' for="">Affilation </label>
        <input class='form-control'  type="text" name="affilation[]" id="affilation_<?=$i?>">
   </div>
   <div class="col-md-12"  style='margin-bottom:5px'>
        <label class='lbl' for="">Scopus Id</label>
        <input type="text"  name='scopus_id[]' placeholder="Enter Scopus Id" class="form-control" />
   </div>
   <div class="col-md-12"  style='margin-bottom:5px'>
        <label class='lbl' for="">Email <span id="email_req_<?=$i?>" style='color:red' class='error'></span> </label>
        <input type="text" id="email_<?=$i?>"  name='email[]' placeholder="Enter Email" class="form-control" />
   </div>
</div>
<?php
}
}
else{

$sql3 = "SELECT * FROM department order by order_b";
$stmt = $conn->query($sql3);
$i=1;
while(($row=$stmt->fetchAssociative())!==false){
    extract($row);
    array_push($dep_array,array("department_id"=>$department_id,"department"=>$department));
}

$sql4 = "SELECT * FROM designation order by order_b";
$stmt = $conn->query($sql4);
 
while(($row=$stmt->fetchAssociative())!==false){
    extract($row);
    array_push($desig_array,array("designation_id"=>$designation_id,"designation"=>$designation));
}

if($p=="paper"){
$q="select * from authornamesjp where journalpaper_id='$jp_id'";
}
else{
     $q="select * from authornamespp where press_paper_id='$jp_id'"; 
}
//echo $q;
$stmt = $conn->query($q);
$i=1;
$universel_array=array();
while(($row=$stmt->fetchAssociative())!==false){

     extract($row);
     array_push($universel_array,$university_id);
     if($is_corresponding==1){
          $btn="btn-success";
          $chk="checked";
          $disabled="";
          $req_sim="*";
          $req="required='required'";
     }
     else{
          $btn="btn-default";
          $chk="";
          $disabled="disabled='disabled'";
          $req_sim="";
          $req="";
     }


?>
<div class="row" style='padding:10px;border:1px solid black;margin:10px;background-color:#efefef;'>
   <div class="col-md-12"  style="margin-left:-5px;margin-bottom:10px">
      <label <?=$disabled?> class='btn <?=$btn?>  btn-sm lb-button' onclick="set_corresponding(<?=$i?>,<?=$cnt?>)" id="lbl_cor_<?=$i?>" style='margin-left:5px' for="is_corresponding_<?=$i?>">  <input <?=$chk?>  <?=$disabled?> type="checkbox" class='corresponding' id='is_corresponding_<?=$i?>' name="is_corresponding[]"/> Is Corresponding </label>
   </div>
   <div class="col-md-3" style='margin-bottom:5px'>
        <label class='lbl' autocomplete="off" for="">First Name  <span style='color:red' class='error'>*</span></label>
        <input required type="text" name='first_name[]' value="<?=$firstname?>" id='first_name_<?=$i?>' placeholder="Enter  First Name" class="form-control names" />
        <label id='error_first_name_<?=$i?>'></label>
   </div>
   <div class="col-md-3"  style='margin-bottom:5px'>
        <label class='lbl' for="">Middle Name</label>
        <input  type="text" autocomplete="off" name='middle_name[]'  value="<?=$middlename?>" id='middle_name_<?=$i?>' placeholder="Enter  Middle Name" class="form-control names" />
        <label id='error_middle_name_<?=$i?>'></label>
   </div>
   <div class="col-md-3"  style='margin-bottom:5px'>
        <label class='lbl' for="">Last Name </label>
        <input   type="text" autocomplete="off" name='last_name[]' value="<?=$lastname?>" id='last_name_<?=$i?>' placeholder="Enter  Last Name" class="form-control names" />
        <label id='error_last_name_<?=$i?>'></label>
   </div>
   <div class="col-md-3"  style='margin-bottom:25px'>
        <label class='lbl' for="">Designation</label>
        <select class='form-control' name="designation[]" id="designation_<?=$i?>">
         <?php
           for($k=0;$k<count($desig_array);$k++){
            ?>
           <option <?=($designation_id==$desig_array[$k]["designation_id"])?"selected":""?>  value="<?=$desig_array[$k]["designation_id"]?>"><?=$desig_array[$k]["designation"]?></option>
            <?php
           }
         ?>
         </select>
   </div>
   <div class="col-md-3"  style='margin-bottom:5px'>
        <label class='lbl' for="">Department</label>
        <select class='form-control' name="department[]" id="department_<?=$i?>">
         <?php
           for($k=0;$k<count($dep_array);$k++){
            ?>
           <option <?=($department_id==$dep_array[$k]["department_id"])?"selected":""?>  value="<?=$dep_array[$k]["department_id"]?>"><?=$dep_array[$k]["department"]?></option>
            <?php
           }
         ?>
         </select>
   </div>
   <div class="col-md-3"  style='margin-bottom:5px'>
        <label class='lbl' for="">Orcid</label>
        <input type="text" name='orcid[]' value="<?=$orcid?>"   placeholder="Enter  Orcid " class="form-control" />
   </div>
 
   <div class="col-md-3"  style='margin-bottom:5px'>
        <label class='lbl' for="">University <span style='color:red' class='error'>*</span><a onclick='show_modal(<?=$i?>);'><i class='fa fa-plus'></i>Add University</a></label>
        <select required class='form-control univerlist select' name="university[]" id="university_<?=$i?>">
        </select>
   </div>
   <div class="col-md-3"  style='margin-bottom:5px'>
        <label class='lbl' for="">Affilation </label>
        <input class='form-control' type="text" name="affilation[]" id="affilation_<?=$i?>" value="<?=$affilation?>"  >
   </div>
   <div class="col-md-12"  style='margin-bottom:5px'>
        <label class='lbl' for="">Scopus Id</label>
        <input type="text"  name='scopus_id[]' value="<?=$scoupus_id?>" placeholder="Enter Scopus Id" class="form-control" />
   </div>
   <div class="col-md-12"  style='margin-bottom:5px'>
        <label class='lbl' for="">Email <span id="email_req_<?=$i?>" style='color:red' class='error'><?=$req_sim?></span></label>
        <input type="text" id="email_<?=$i?>" <?=$req?>  value="<?=$email?>"  name='email[]' value="<?=$email?>" placeholder="Enter Email" class="form-control" />
   </div>
</div>
<?php
$i=$i+1;
}
$imploe=implode(",",$universel_array);
?>
<input type="hidden" name='unisellist' id='unisellist' value="<?=$imploe?>">
<?php
for(;$i<=$cnt;$i++){
?>
<div class="row" style='padding:10px;border:1px solid black;margin:10px;background-color:#efefef;'>
   <div class="col-md-12"  style="margin-left:-5px;margin-bottom:10px">
      <label class='btn btn-success btn-sm lb-button' onclick="set_corresponding(<?=$i?>,<?=$cnt?>)" id="lbl_cor_<?=$i?>" style='margin-left:5px' for="is_corresponding_<?=$i?>">  <input type="checkbox" class='corresponding' id='is_corresponding_<?=$i?>' name="is_corresponding[]"/> Is Corresponding</label>
   </div>
   <div class="col-md-3" style='margin-bottom:5px'>
        <label class='lbl' for="">First Name <span class='req'>*</span></label>
        <input required autocomplete="off" type="text" name='first_name[]' id='first_name_<?=$i?>' placeholder="Enter  First Name" class="form-control names" />
        <label id='error_first_name_<?=$i?>'></label>
   </div>
   <div class="col-md-3"  style='margin-bottom:5px'>
        <label class='lbl' for="">Middle Name</label>
        <input type="text" autocomplete="off" name='middle_name[]' id='middle_name_<?=$i?>' placeholder="Enter  Middle Name" class="form-control names" />
        <label id='error_middle_name_<?=$i?>'></label>
   </div>
   <div class="col-md-3"  style='margin-bottom:5px'>
        <label class='lbl' for="">Last Name <span class='req'>*</span></label>
        <input required  autocomplete="off" type="text" name='last_name[]' id='last_name_<?=$i?>' placeholder="Enter  Last Name" class="form-control names" />
        <label id='error_last_name_<?=$i?>'></label>
   </div>
   <div class="col-md-3"  style='margin-bottom:25px'>
        <label class='lbl' for="">Designation </label>
          <select class='form-control' name="designation[]" id="designation_<?=$i?>">
           <option value="">Select</option>
          <?php
            for($k=0;$k<count($desig_array);$k++){
               ?>
                <option value="<?=$desig_array[$k]["designation_id"]?>"><?=$desig_array[$k]["designation"]?></option>
               <?php
            }
          ?>    
        </select>
   </div>
   <div class="col-md-3"  style='margin-bottom:5px'>
        <label class='lbl' for="">Department</label>
        <select class='form-control' name="department[]" id="department_<?=$i?>">
         <?php
           for($k=0;$k<count($dep_array);$k++){
            ?>
              <option value="<?=$dep_array[$k]["department_id"]?>"><?=$dep_array[$k]["department"]?></option>
            <?php
             }
         ?>
         </select>
   </div>
   <div class="col-md-3"  style='margin-bottom:5px'>
        <label class='lbl' for="">Orcid</label>
        <input type="text" name='orcid[]'   placeholder="Enter  Orcid " class="form-control" />
   </div>
   <div class="col-md-3"  style='margin-bottom:5px'>
        <label class='lbl' for="">University <span class="req">*</span> <a onclick='show_modal(<?=$i?>);'><i class='fa fa-plus'></i>Add University</a></label>
        <select required  class='form-control univerlist select' name="university[]" id="university_<?=$i?>">
        </select>
   </div>
   <div class="col-md-3"  style='margin-bottom:5px'>
        <label class='lbl' for="">Affilation </label>
        <input class='form-control'  type="text" name="affilation[]" id="affilation_<?=$i?>">
   </div>
   <div class="col-md-12"  style='margin-bottom:5px'>
        <label class='lbl' for="">Scopus Id</label>
        <input type="text"  name='scopus_id[]' placeholder="Enter Scopus Id" class="form-control" />
   </div>

   <div class="col-md-12"  style='margin-bottom:5px'>
        <label class='lbl' for="">Email <span id="email_req_<?=$i?>" style='color:red' class='error'></span></label>
        <input type="text"  name='email[]' id="email_<?=$i?>" placeholder="Enter  Email Id" class="form-control" />
   </div>
   
</div>
<?php
}
}
?>
<script>
     function set_corresponding(i,count){
         t= $("#is_corresponding_"+i).is(':disabled');
          if (t){
               //alert('Button Disabled')
          }   
          else{
                    isChecked = $("#is_corresponding_"+i).is(":checked");
                    if(isChecked){
                         for(k=1;k<=count;k++){
                         console.log(i);
                              if(k!=i){
                                   $("#is_corresponding_"+k).attr("checked", false);
                                   $("#is_corresponding_"+k).attr("disabled", true);
                                   $("#lbl_cor_"+k).removeClass("btn-success");
                                   $("#lbl_cor_"+k).addClass("btn-default");
                                   $("#lbl_cor_"+k).attr("disabled", true);
                                   $("#email_req_"+k).html("");
                                   $("#email_"+k).attr("required", false);
                              }
                              else{
                                   $("#email_req_"+i).html("*");
                                   $("#email_"+i).attr("required", "required");
                              }
                         }
                    }
                    else{
                         $(".corresponding").removeAttr("disabled");
                         $(".lb-button").addClass("btn-success");
                         $(".lb-button").removeAttr("disabled");

                         $("#email_req_"+i).html("");
                         $("#email_"+i).removeAttr("required");
                       }
             }
          }



 $(document).ready(function(){
  $('.select').select2({
       placeholder: 'Select an option'
   });
});
</script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
       

