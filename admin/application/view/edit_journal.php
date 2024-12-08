<?php
include "basic/admin_header.php";

extract($_REQUEST);
$sql = "SELECT * FROM journals where journals_id='$id'";
$stmt = $conn->query($sql);
$row=$stmt->fetchAssociative();
extract($row);
?>
<div class="mainpanel">
<div class="contentpanel">
  <ol class="breadcrumb breadcrumb-quirk">
    <li><a href="" ><i class="fa fa-home mr5"></i> Edit Journal</a></li>
  </ol>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-heading" style='background-color:#259dab'>
          <h4 class="panel-title" style='color:White'>Edit Journal</h4>
        </div>
        <form onsubmit="return validation();" action="../action/updateJournal.php" method='post'  enctype='multipart/form-data'>
        <div class="panel-body" style='margin-top:10px'>
            <div class="row">
              <div class="col-md-12">
                  <ul class='msg'></ul>
              </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label class='lbl' for="">Journal Name <span class='req'>*</span></label>
                    <input type="hidden" name='id' value="<?=$id?>">
                    <input type="text" required value="<?=$name?>" name='name' placeholder="Enter  Journal Name" class="form-control" />
                </div>
                <div class="form-group col-md-3">
                    <label class='lbl' for="">Journal Abbreviation <span class='req'>*</span></label>
                    <input type="text" required name='journal_abbri' value="<?=$journal_abbri?>" readonly placeholder="Enter  Journal Abbriviation" class="form-control" />
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">ISSN(P)</label>
                    <input type="text"   name='issnprint' id='issnprint' value="<?=$issnprint?>" placeholder="Enter  Issn Print" class="form-control" />
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">ISSN(O)</label>
                    <input type="text"   name='issnonline'  id='issnonline'  value="<?=$issnonline?>"  placeholder="Enter  Issn Online" class="form-control" />
                </div>
        </div>
        <div class="row">
                <div class="form-group col-md-12">
                    <label class='lbl' for="">DOI <span class='req'>*</span></label>
                    <input type="text" required name='doi' value="<?=$doi?>"   placeholder="Enter  Doi" class="form-control" />
                </div>
               
                <div class="form-group col-md-12">
                    <label class='lbl' for="">About Journal <span class='req'>*</span></label>
                    <textarea class='form-control' required    name="journal_about" id="journal_about" cols="30" rows="10"><?=$journal_about?></textarea>
                </div>
        </div>
         
        <div class="row" style='margin-top:10px'>
                <div class="form-group col-md-2">
                    <label class='lbl' for=""> Logo</label>
                    <input  onchange="getImg(this,img_journal_logo,'400','400');" type="file" name='journal_logo'   class="form-control" />
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Cover Page</label>
                    <input  onchange="getImg(this,img_cover_page,'400','400');" type="file" name='cover_page'  class="form-control" />
                </div>

                <div class="form-group col-md-2">
                    <label class='lbl' for="">Starting Year  <span class='req'>*</span></label>
                    <select required class='form-control' name="starting_year" id="starting_year">
                        <option value="">Year</option>
                       
                        <option value="">Year</option>
                        <?php
                        for($i=2011;$i<=2025;$i++){
                        ?>
                          <option value="<?=$i?>" <?=($i==$starting_year)?'selected':''?>><?=$i?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-2">
                    <label class='lbl' for="">Curent Year  <span class='req'>*</span></label>
                    <select onchange='search_uploaded_month()' required class='form-control' name="current_year" id="current_year">
                        <option value="">Year</option>
                        <?php
                        for($i=date('Y');$i<=date('Y',strtotime('+5 years'));$i++){
                        ?>
                          <option <?=($i==$current_year)?'selected':''?> value="<?=$i?>"><?=$i?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Frequency <span class='req'>*</span></label>
                    <select onchange="search_uploaded_month();" class='form-control' name="frequency" id="frequency">
                         <option value="">Select</option>
                          <?php
                           $sql = "SELECT * FROM frequency";
                           $stmt = $conn->query($sql);
                           $i=1;
                           while(($row2=$stmt->fetchAssociative())!==false){
                           ?>
                            <option <?=($frequency==$row2['frequency_id'])?"selected":""?>  value="<?=$row2['frequency_id']?>-<?=$row2['no']?>"><?=$row2['frequency']?></option>
                          <?php
                          }
                         ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label class='lbl' for="">Month <span class="req">*</span></label>
                    <select onkeyup="chkReadonlyItem();" name='months[]'   required  data-dropdown-css-class="select2-purple"  data-placeholder="Select Month"   multiple name="journals[]"   id="months" class="form-control select2">
                            <?php
                            for($i=0;$i<12;$i++){   
                               ?>
                             <option value="<?=$i?>"><?=get_month($i)?></option>
                            <?php
                            }
                           ?>
                    </select>
                    <span id='m_error' style='color:red;font-weight:bold'></span>
                </div>
                
        </div>
        <div class="row">
          <div class="col-md-2">
            <?php
            if($journal_logo!=""){
                $journal_logo="../../../upload/$journal_logo";
            }
            else{
                $journal_logo="https://via.placeholder.com/200x200";
            }

            if($cover_image!=""){
                $cover_image="../../../upload/$cover_image";
            }
            else{
                $cover_image="https://via.placeholder.com/200x200";
            }

            ?>
            <img style='width:100%' src="<?=$journal_logo?>" alt="" id='img_journal_logo'>   
          </div>
          <div class="col-md-2">
            <img  style='width:100%'  src="<?=$cover_image?>" alt="" id='img_cover_page'>  
          </div>
       </div>
      <div class="row">
        <div class="col-md-12">
             <hr>
        </div>
      </div>
       <div class="row">
           <div class="col-md-12" style='margin-top:10px'>
           <button  class='btn btn-info'>Update Journal</button>
           </div>
       </div>
     </div>
     </div><!-- panel -->
     </div>
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
  issnb=false;
  imgb=false;
  fqb=false;
  li="";
  issnp=$("#issnprint").val();
  issno=$("#issnonline").val();
  cover_image="<?=$cover_image?>";
  journal_logo="<?=$journal_logo?>";

  frq=$("#frequency").val();
  spl=frq.split("-");
  no=spl[1];
  count = $("#months").find(":selected").length;

  if(issnp!=""||issno!=""){
   issnb=true;
  }
  else{
    li+="<li style='color:red'>Please Fill at least One ISSN Number Either ISSN(P) or ISSN(O)</li>";
    issnb=false;
  }

  if(cover_image!=""||journal_logo!=""){
    imgb=true;
  }
  else{
    li+="<li style='color:red'>Please upload Cover Page or Logo</li>";
    imgb=false;
  }

  if(count!=no){
    li+="<li style='color:red'>Please Select Any "+no+" Month</li>";
    $("#m_error").html("Please Select Any "+no+" Month");
    imgb=false;
  }
  else{
    imgb=true;
  }

  $(".msg").html(li);
  tt=Boolean(imgb*issnb*imgb);
  return tt;
 }

arr=[];
$(document).ready(function() {
    $('#months').select2({
       tags: true,
      tokenSeparators: [',', ' ']
    });
    $('#months').on('select2:unselecting', function(event) {
       var d = event.params.args.data.id;
       if(arr.includes(d)){
           event.preventDefault(); 
          // $("#months").select2().val([d]).trigger("change");
         }
     }); 
    search_uploaded_month();
});

function search_uploaded_month(){
  arr=[];
  $('#months').val(null).trigger('change');
  starting_year=$("#starting_year").val();
  no=$("#frequency").val().split("-")[1];
  journal_id="<?=$id?>";
  burl="../ajax/checkUploadedeMonth.php"; 
   $.post(burl,{"journal_id":journal_id,"year":starting_year},function(data,status){
     data=data.trim();
     if(data.includes(",")){
       d_=data.split(",");
       l=(d_.length>=no)?no:d_.length;
       for(var i=0;i<l;i++){
         if(d_[i]!=""){
           arr.push(d_[i]);
         }
      }
     }
     else{
      l=data;
      arr.push(l);
     }
     <?php
     if($months!=""){
     ?>
      months="<?=$months?>";
      $("#months").select2().val(arr).trigger("change");
      $("#months").select2().val([<?=$months?>]).trigger("change");
     <?php
     }else{
     ?>
     $("#months").select2().val(arr).trigger("change");
     <?php
     }
     ?>
   });
}


</script>