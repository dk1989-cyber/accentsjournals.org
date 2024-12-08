<?php
include "basic/admin_header.php";
?>


<div class="mainpanel">

<div class="contentpanel">

  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i> Add Journal Directory (Issue)</a></li>
  </ol>
  <div class="row"> 
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Journal Directory</h4>
        </div>
        <form onsubmit=validation(); id='accentform' action="../action/adDirectory.php" method='post'  enctype='multipart/form-data'>
        <div class="panel-body" style='margin-top:10px'>
           <div class="col-md-12">
              <p id='msg' style='color:red'></p>
           </div>
           <div class="row">
                <div class="form-group col-md-4">
                    <label class='lbl' for="">Journal Name <span class='req'>*</span></label>
                    <select onchange="get_months();" required class='form-control' name="journals_id" id="journals_id">
                         <option value="">Please Select Journal</option>
                         <?php
                          $sql = "SELECT * FROM journals";
                          $stmt = $conn->query($sql);
                          $i=1;
                         while(($row=$stmt->fetchAssociative())!==false){
                             extract($row);
                         ?>
                           <option value="<?=$journals_id?>#<?=$journal_abbri?>"><?=$name?> <?=$journal_abbri?></option>
                         <?php
                         }
                         ?>
                       
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Year <span class='req'>*</span></label>
                    <select onchange="get_months();" required class='form-control' name="year" id="year">
                         <option value="">Select Year</option>
                         <?php
                         $last=date('Y', strtotime('+3 years'));
                          for($i=date('Y');$i<=$last;$i++){
                          ?>
                            <option value="<?=$i?>"><?=$i?></option>
                          <?php
                          }
                        ?>  
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Month <span class='req'>*</span></label>
                    <select required class='form-control' name="month" id="month">
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Volume <span class='req'>*</span></label>
                    <input onkeyup="check_volume();" required type="text" name='volume' id='volume' placeholder="Enter  Volume " class="form-control" />    
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Issue <span class='req'>*</span></label>
                    <input readonly required type="text" name='issue'  id='issue' placeholder="Enter  Issue " class="form-control" />
                </div>
        </div>
        <div class="row">  
                <div class="form-group col-md-12">
                    <label class='lbl' for="">Cover Image Content</label>
                    <textarea class='form-control' name="content" id="content" cols="30" rows="10"></textarea>
               </div>
        </div>
        <div class="row" style='margin-top:10px'>  
                <div class="form-group col-md-12">
                    <input name='is_msgchk' type="checkbox" onclick='is_chk()' id='is_msgchk' ><label  class='lbl' for="is_msgchk">Message Box</label>
                    <textarea disabled class='form-control' name="message_box" id="messsage_box" cols="30" rows="10"></textarea>
               </div>
        </div>
        <div class="row" style='margin-top:30px'>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Cover Image</label>
                    <input type="file" name="cover_image"  id="cover_image"  class="form-control"   onchange="getImg(this,cover_img_img,'400','400');" />
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Mode <span class="req">*</span></label><br/>
                    <input required type="radio" name='chk_mode' id='mode_regular' value='Regular'><label  for='mode_regular' for="">Regular</label>
                    <input required type="radio" name='chk_mode' id='mode_special' value='Special'><label  for='mode_special' for="">Special</label>
                    <input required  type="radio" name='chk_mode' id='mode_mix' value='Mix'><label  for='mode_mix' for="">Mix</label>
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Message Box Type <br/>
                    <input disabled  checked class='msgtype'  type="radio" name='chk_type' id='message_regular' value='Rotate'><label  for='message_regular' for="">Rotate</label>
                    <input disabled   class='msgtype'    type="radio" name='chk_type' id='message_special' value='Fixed'><label  for='message_special' for="">Fixed</label>
                </div>

                <div class="form-group col-md-2">
                    <label class='lbl' for="is_discipline">Discipline</label><br/>
                    <input  type="checkbox" name='is_discipline' id='is_discipline' value='Yes'><label  for='is_discipline' for="">Yes</label>
                </div>
        </div>
        <div class="row">
          <div class="col-md-2">
            <img style='width:100%' src="https://via.placeholder.com/200x200" alt="" id='cover_img_img'>  
          </div>
       </div>
      <div class="row">
        <div class="col-md-12">
             <hr>
        </div>
      </div>
       <div class="row">
           <div class="col-md-12" style='margin-top:10px'>
           <button id='btn' disabled  class='btn btn-info'>Submit</button>
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

function validation(){
    $('#btn').attr("disabled","disabled");
}

function get_months(){
   options="";
   journals_id=$("#journals_id").val().split("#")[0];
   year=$("#year").val();
   burl="../ajax/get_months_by_journals.php"; 
   if(journals_id!=""&& year!=""){
    $("#msg").html("");
     $.post(burl,{"journal_id":journals_id,"year":year},function(data,status){
        data=data.trim();
        if(data!="0"){
              sp_data=data.split("-");
              sp_data_=sp_data[0].split(",");
              for(i=0;i<sp_data_.length;i++){
                  
                if(sp_data[1].includes(sp_data_[i])){
                    continue;
                }
                else
                {
                options+="<option value='"+sp_data_[i]+"'>"+get_month(sp_data_[i])+"</option>";
                }
              $("#month").html(options);
              $("#issue").val(sp_data[2]);
          }
        }
        else{
          $("#month").html("<option value=''>There is no month Allocated</option>");
        }
      });
  
   }
   else{
     
       $("#msg").html("Please Select Options: Journals,Year");
   }
}

function check_volume(){
  journals_id=$("#journals_id").val().split("#")[0];
  year=$("#year").val();
  volume=$("#volume").val();
  burl="../ajax/checkVolume.php"; 
  $.post(burl,{"journal_id":journals_id,"year":year,"volume":volume},function(data,status){
     data=data.trim();
     if(data=="0"){
         $("#msg").html("<b>Volume  Duplicacy</b>");
         $("#btn").attr("disabled","disabled");
     }
     else if(data=="2"){
           $("#msg").html("<b>Volume Already Present </b>");
           $("#btn").attr("disabled","disabled");
     }
     else if(data=="1"){
       $("#msg").html("");
       $("#btn").removeAttr("disabled");
     }
   });
}

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